<?php
    class Pedido {  
        function mostrar(){  
        return "<td>" . $this->id . "</td><td>" . $this->id_cliente . "</td><td>" . $this->preciototal . "</td>"; 
    }  
    }  

    //incluir fichero de configuracion y de metodos d gestion de Base de datos
    include_once("config.php");
    include_once("gestionBD_ioo.php");
    include_once("funciones.php");

    //Crear conexion BD
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS);   
    if(!$conn->select_db(DB_DATABASE)) die ($conn->error);  

    $nombreCliente="";
    $fichero="";

    if(isset($_POST["selectCliente"])){
        if(!empty($_POST["cliente"])){
            $nombreCliente=$_POST["cliente"];
        }
    }

    if(isset($_POST['porcentajePrecio']) && !empty($_POST['porcentajePrecio'])){
        $porcentajePrecio=$_POST['porcentajePrecio'];
    }
    
    if(isset($_POST['nombreAlimento']) && !empty($_POST['nombreAlimento'])){
        $nombreAlimento=$_POST['nombreAlimento'];
    }

    //guardar imagen en base de datos al elegir un alimento de un combo
    if(isset($_POST['guardarFichero'])){
        if(isset ($_POST['imagenAlimentos']) && !empty($_POST['imagenAlimentos'])){
            
            $revisar = getimagesize($_FILES["cargaFichero"]["tmp_name"]);
            
            if($revisar !== false){
                fncGuardarFicheroBLOBBindVariables($conn, SQL_UPDATE_IMAGEN_ALIMENTO_BIND , $_FILES,$_POST['imagenAlimentos'] );
            }else{
                $mensajeErrorImagen=ERROR_IMAGEN_NO_ADECUADA;
            }
        }else{
            $mensajeErrorImagen=ERROR_SELECCION_IMAGEN;
        }
    }

    //guardar imagen en base de datos al elegir un alimento de un combo
    if(isset($_POST['incrementarValor'])){
        $valor=" (PRECIO * (1+(".$_POST['porcentajePrecio']."/100)))";
        fncInsertarModificarTabla($conn, SQL_UPDATE_PRECIO_ALIMENTOS.$valor);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css" type="text/css"/>
    <title>Restaurante - Mostrar Datos</title>
</head>
<body>
    
<h1> Restaurante - Mostrar Datos</h1> 

    <div>
        <div class="izquierda">
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                <!--
                INCREMENTAR LOS PRECIOS
                -	Caja de texto (para porcentaje) + submit  Para incrementar el precio de todos los alimentos de la tabla en el porcentaje indicado
                -->
                <div>
                    <?php
                        $resultado="";

                        if(isset($_POST['buscarAlimento']) && !empty($nombreAlimento)){
                            $sql=SQL_BUSCAR_ALIMENTO_LIKE_NOMBRE."('%$nombreAlimento%')";
                            $resultado=fncConsultarTabla($conn,$sql);
                        }else{
                            $resultado= fncConsultarTabla($conn,SQL_BUSCAR_ALIMENTOS);
                        }
                    //Visualizacion de alimentos con metodo fetch_assoc
                    if (isset($resultado)){ 
                    ?>
                        <h3> Datos de tabla de Alimentos</h3>
                        <table>
                            <tr><td>Nombre</td><td>Precio</td><td>Tipo</td><td>Fecha</td><td>Imagen</td></tr>
                        <?php
                            //Recogida de datos a mostrar, incluido fichero BLOB
                            while($fila = $resultado -> fetch_assoc()){ 
                                echo "<tr>";
                                echo "<td>".$fila['nombre']."</td><td>".$fila['precio']."</td><td>".$fila['tipo']."</td><td>".$fila['fecha']."</td>";
                                echo "<td><img src='data:image/jpeg;base64,".base64_encode($fila['fichero'])." '/></td>";
                                echo "</tr>";
                            }      
                        ?>
                        </table>
                <?php } ?>

                </div>
            </form>

        </div>
        <div class="derecha">
            <!-- FORMULARIO PARA SUBIR FICHEROS -->
            <form action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data" method="post">
            <div>
                    <h3> Incrementar precios de Alimentos</h3>
                    <p> Porentaje de precio a subir </p>
                    <input type="text" name="porcentajePrecio" value="<?php echo $porcentajePrecio;?>"></input>
                    <input type="submit" name="incrementarValor" value="Incrementar valor"/>
                </div>
                <!--
                CONSULTAS VARIAS
                -	Caja de texto (para patrón de nombre ) + submit  Para visualizar en una tabla todos los alimentos cuyo nombre se atenga a ese patrón ( con like ‘%....... %’). Utilizando fetch_assoc
                -	Submit  Para visualizar todos los clientes que tienen algún pedido. Utilizando fetch_array
                -	Submit Para visualizar todos los pedidos (id, nombrecliente, total). Utilizando fetch_object 
                -->
                <div>
                    <h3> Consulta datos de Alimentos</h3>
                    <p> Patron de nombre de alimento  a buscar </p>
                    <input type="text" name="nombreAlimento" value="<?php echo $nombreAlimento;?>"/>
                    <input type="submit" name="buscarAlimento" value="Buscar Alimento"/>
                    <input type="submit" name="visualizarClientes" value="Ver Clientes"/>
                    <input type="submit" name="visualizarPedidos" value="Ver Pedidos"/>

                    <?php 
                        //Visualizacion de clientes con metodo fetch_array
                        if(isset($_POST['visualizarClientes'])){

                            $resultado= fncConsultarTabla($conn,SQL_BUSCAR_CLIENTES);
                            
                            if (isset($resultado)){ 
                                echo "<h3> Datos Cliente</h3>";
                                echo "<table>";
                                echo "<tr><td>Nombre</td></tr>";
                                //Recogida de datos a mostrar, incluido fichero BLOB
                                while($fila = $resultado -> fetch_array(MYSQLI_ASSOC )){ 
                                    echo "<tr>";
                                    echo "<td>".$fila['nombre']."</td>";
                                    echo "</tr>";
                                }      
                                echo "</table>";
                            }
                        }

                    ?>

                    <?php 
                        //Visualizacion de pedidos con metodo fetch_object
                        if(isset($_POST['visualizarPedidos'])){

                            $resultado= fncConsultarTabla($conn,SQL_BUSCAR_PEDIDOS);
                            
                            if (isset($resultado)){ 
                                echo "<h3> Datos Pedidos</h3>";
                                echo "<table>";
                                echo "<tr><td>Nombre</td></tr>";
                                //Recogida de datos a mostrar, incluido fichero BLOB
                                while(($objeto  = $resultado->fetch_object('Pedido')) ){ 
                                    echo "<tr>";
                                    echo $objeto->mostrar();
                                    echo "</tr>";
                                }      
                                echo "</table>";
                            }
                        }

                    ?>
                </div>
            
                <!--    VER IMAGEN DE UN BLOB
                -	Select con todos los alimentos + submit  Para visualizar la imagen del alimento seleccionado  
                -->
                <div>
                    <h3> Visualizar imagen de  Alimentos</h3>
                    <select name="alimentos">  
                        <?php
                            $resultado=fncConsultarTabla($conn, SQL_BUSCAR_ALIMENTOS);

                            while($fila = $resultado -> fetch_assoc()){ 
                                echo "<option value='".$fila['id']."'".fncIsSelected($fila['id'], 'alimentos').">".$fila['nombre']."</option>";
                                if(fncIsSelected($fila['id'], 'alimentos')=='selected'){
                                    $fichero=$fila['fichero'];
                                }
                            }  
                        ?>  
                    </select>
                    <?php
                        if(isset($_POST['visualizarImagen']) && !empty($fichero)){
                            echo "<img src='data:image/jpeg;base64,".base64_encode($fichero)."'/>";
                            echo "</br>";
                        }else{
                            echo "No hay imagen para mostrar";
                        }
                    ?>
                    <input type="submit" name="visualizarImagen" value="Ver imagen"/>

                </br>
                </div>
                <!--
                -	Select con todos los alimentos +  input de tipo file  (para coger imagen de alimento) 
                + submit  Para guardar en el blob la imagen que se indique, para el alimento elegido
                Si ya tiene imagen se modifica
                -->
                <h3> Guardar imagen de  Alimento</h3>
                <select name="imagenAlimentos">  
                    <?php
                        $resultado=fncConsultarTabla($conn, SQL_BUSCAR_ALIMENTOS);

                        while($fila = $resultado -> fetch_assoc()){ 
                            echo "<option value='".$fila['id']."'".fncIsChecked($fila['id'], 'alimentos').">".$fila['nombre']."</option>";
                        }     
                    ?>  
                </select>
                <input type="file" name="cargaFichero" />
                </br>
                <input type="submit" name="guardarFichero" value="Guardar Fichero"/>

            </form>
        </div>
    </div>
</body>
</html>