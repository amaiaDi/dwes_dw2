<?php
    //incluir fichero de configuracion y de metodos d gestion de Base de datos
    include_once("config.php");
    include_once("gestionBD_ip.php");

    //Crear conexion BD
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    mysqli_select_db($con, DB_DATABASE);

    $arrayInfoAlimento=array();

    // Comprobamos si el campo de nombre está vacio, si no está vacio lo incluimos en el array para pasar al metodo
    if(isset($_POST['nombreAlimento']) ){
        if (!empty($_POST['nombreAlimento'])){
            $arrayInfoAlimento['nombreAlimento']=$_POST['nombreAlimento'];
            $nombreAlimento=$_POST['nombreAlimento'];
        }  
    }

    // Comprobamos si el campo de precio está vacio, si no está vacio lo incluimos en el array para pasar al metodo
    if(isset($_POST['precioAlimento']) ){
        if (!empty($_POST['precioAlimento'])){
            $arrayInfoAlimento['precioAlimento']=$_POST['precioAlimento'];
            $precioAlimento=$_POST['precioAlimento'];
        }   
    }

    // Comprobamos si el campo de precio está vacio, si no está vacio lo incluimos en el array para pasar al metodo
    if(isset($_POST['tipoAlimento']) ){
        if (!empty($_POST['tipoAlimento'])){
            $arrayInfoAlimento['tipoAlimento']=$_POST['tipoAlimento'];
            $tipoAlimento=$_POST['tipoAlimento'];
        }  
    }

    // Comprobamos si el campo de precio está vacio, si no está vacio lo incluimos en el array para pasar al metodo
    if(isset($_POST['consultaTipoAlimento']) ){
        if (!empty($_POST['consultaTipoAlimento'])){
            $consultaTipoAlimento=$_POST['consultaTipoAlimento'];
        }else{
            $consultaTipoAlimento="primero";
        }
    }else{
        $consultaTipoAlimento="primero";
    }

    //Llamamos al metodo de crear Tabla Alimento si viene del boton
    if(isset($_POST['insertarNuevo'])){

        if(empty($nombreAlimento)){
            //Si está vacio mostramos mensaje de error
            $errorNombreAlimento=ERROR_NOMBRE_ALIMENTO;
        }  
        if(empty($precioAlimento)){
            //Si está vacio mostramos mensaje de error
            $errorPrecioAlimento=ERROR_PRECIO_ALIMENTO;
        } 
        if(empty($tipoAlimento)){
            //Si está vacio mostramos mensaje de error
            $errorTipoAlimento=ERROR_TIPO_ALIMENTO;
        }  
        // Si los mensajes de error estan vacios es que tenemos datos para la inserción del nuevo elemento
        if(empty($errorNombreAlimento) && empty($errorTipoAlimento) && empty($errorPrecioAlimento)){
            fncInsertarNuevoAlimento($con, DB_TABLA_ALIMENTO, $arrayInfoAlimento);
            $tipoAlimento="";
            $precioAlimento="";
            $nombreAlimento="";
        }
    }

    //Llamamos al metodo de crear Tabla Alimento si viene del boton
    if(isset($_POST['crearTablaAlimento'])){
        fncBorrarYCrearTabla($con, DB_TABLA_ALIMENTO,SQL_CREATE_TABLE_ALIMENTOS);
    }

     //Llamamos al metodo de crear Tabla Clientes si viene del boton
     if(isset($_POST['crearTablaClientes'])){
        fncBorrarYCrearTabla($con, DB_TABLA_CLIENTES,SQL_CREATE_TABLE_CLIENTES);
    }

     //Llamamos al metodo de crear Tabla cliente si viene del boton
     if(isset($_POST['crearTablaPedidos'])){
        fncBorrarYCrearTabla($con, DB_TABLA_PEDIDOS,SQL_CREATE_TABLE_PEDIDOS);
    }

    //Llamamos al metodo de crear Tabla Alimento si viene del boton
    if(isset($_POST['actualizarCampoFecha'])){
        fncActualizarCampoFecha($con, DB_TABLA_ALIMENTO);
    }

    //Metodo para redireccionar mediante enlace Index_IP, ademas se desconecta la sesion
    if(isset($_GET["ira"])){
        header("Location:".$_GET["ira"]);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css" type="text/css"/>
    <title>Creación y gestión de Base de Datos Restaurante</title>
</head>
<body>
    
    <form method="post" action="crearBd.php">
        <h1> Restaurante - Información Alimentos</h1>   
        <div>
            <div class="izquierda">
                <h3> Nuevo Alimento</h3>

                <table>
                    <tr>
                        <td>  Nombre:  </td>
                        <td >  <input type="text" name=nombreAlimento value='<?php echo $nombreAlimento; ?>'></input> <?php echo $errorNombreAlimento;?></td>
                    </tr>
                    <tr>
                        <td>  Precio : </td>
                        <td >  <input type="text" name=precioAlimento value='<?php echo $precioAlimento; ?>'></input> <?php echo $errorPrecioAlimento;?></td>
                    </tr>
                    <tr>
                        <td>  Tipo :  </td>
                        <td>  
                            <select name="tipoAlimento">
                                <option value="primero" <?php (!empty($tipoAlimento) && $tipoAlimento!='primero')?'selected':'' ?>>Primero</option>
                                <option value="segundo" <?php (!empty($tipoAlimento) && $tipoAlimento!='segundo')?'selected':'' ?>>Segundo</option>
                                <option value="postre" <?php (!empty($tipoAlimento) && $tipoAlimento!='postre')?'selected':'' ?>>Postre</option>
                            </select>    
                            <?php echo $errorTipoAlimento;?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" name="insertarNuevo" value="Insertar Nuevo"></td>
                    </tr>
                </table>
            </div>
            <div class="derecha">
                <?php
                    $resultado= fncConsultarTabla($con,SQL_BUSCAR_ALIMENTOS);
                    
                    if (isset($resultado)){ 
                ?>
                    <h3> Datos de tabla de Alimentos</h3>
                    <table>
                        <tr><td>Nombre</td><td>Precio</td><td>Tipo</td><td>Fecha</td></tr>
                    <?php

                        while($fila = mysqli_fetch_assoc($resultado)){ 
                            echo "<tr><td>".$fila['nombre']."</td><td>".$fila['precio']."</td><td>".$fila['tipo']
                            ."</td><td>".$fila['fecha']."</td></tr>";
                        }      
                
                    ?>
                    </table>
                <?php } ?>
            </div>
        </div>
        
        <h3> Acciones sobre Base de Datos</h3>
        <table>
            <tr>
                <td colspan="4" class="error"><strong> <?php echo $mensajeUsuario; ?></strong></td>
            </tr>
            <tr>
                <td><input type="submit" name="crearTablaAlimento" value="Crear Tabla Alimento"></td>
                <td><input type="submit" name="crearTablaClientes" value="Crear Tabla Clientes"></td>
                <td><input type="submit" name="crearTablaPedidos" value="Crear Tabla Pedidos"></td>
                <td><input type="submit" name="actualizarCampoFecha" value="Actualizar Campo Fecha"></td>     
            </tr>
            <tr>
                <td><a href='<?php echo $_SERVER['PHP_SELF']."?ira=index_ip.php";?>'> Acceso a Index IP</td>
                <td><a href='<?php echo $_SERVER['PHP_SELF']."?ira=index_ioo.php";?>'> Acceso a Index IOO</td>
                <td colspan="2"><a href='<?php echo $_SERVER['PHP_SELF']."?ira=mostrarFicheros_ioo.php";?>'> Acceso a Mostrar Ficheros IP</td>
            </tr>
        </table>
        <!--Tabla a mostrar cuando se pulsa el boton consultar alimentos baratos -->
        <div>
            <div class="derecha">
            <h3> Consultar alimentos Baratos</h3>
                <table>
                    <tr>
                        <td><input type="submit" name="consultarAlimentosBaratos" value="Consultar alimentos Baratos"></td>
                    </tr>
                </table>
                <?php
                    if(isset($_POST['consultarAlimentosBaratos'])){
                        
                        $resultado=fncConsultarTabla($con, SQL_BUSCAR_ALIMENTOS_MENOR_MEDIA);
                        if (isset($resultado)){ 
                ?>
                        <h3> Datos de tabla de Alimentos Baratos</h3>
                        <table>
                            <tr><td>Nombre</td><td>Precio</td><td>Tipo</td><td>Fecha</td></tr>
                        <?php

                            while($fila = mysqli_fetch_assoc($resultado)){ 
                                echo "<tr><td>".$fila['nombre']."</td><td>".$fila['precio']."</td><td>".$fila['tipo']
                                ."</td><td>".$fila['fecha']."</td></tr>";
                            }      
                        ?>
                        </table>
                <?php 
                        }
                        
                    }
                ?>
            </div>
            <div class="izquierda">
                <!--Tabla a mostrar cuando se pulsa el boton consultar alimentos por tipo -->
                <h3> Consultar alimentos por tipo</h3>
                <table>
                    <tr>
                        <td colspan="2" class="error"><strong> <?php echo $mensajeAlimentosPorTipo; ?></strong></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="radio" name="consultaTipoAlimento" value="primero" <?php echo (!empty($consultaTipoAlimento) && $consultaTipoAlimento=='primero')? 'checked':''; ?>>Primero</input>
                            <input type="radio" name="consultaTipoAlimento" value="segundo" <?php echo (!empty($consultaTipoAlimento) && $consultaTipoAlimento=='segundo')? 'checked':''; ?>>Segundo</input>
                            <input type="radio" name="consultaTipoAlimento" value="postre" <?php echo (!empty($consultaTipoAlimento) && $consultaTipoAlimento=='postre')? 'checked':''; ?>>Postre</input>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="consultarAlimenetosPorTipo" value="Consultar alimentos Por Tipo"></td>
                    </tr>
                </table>
                <?php
                    if(isset($_POST['consultarAlimenetosPorTipo'])){
                        
                        $arrayBindVariables=array();
                        array_push($arrayBindVariables,$_POST['consultaTipoAlimento']);

                        $resultado=fncConsultarTablaCon1BindVariable($con, SQL_BUSCAR_ALIMENTOS_TIPO_BIND, $arrayBindVariables ,"s");
                        if (isset($resultado)){ 
                ?>
                        <h3> Datos de tabla de Alimentos</h3>
                        <table>
                            <tr><td>Nombre</td><td>Precio</td><td>Tipo</td><td>Fecha</td></tr>
                        <?php

                            while($fila = mysqli_fetch_assoc($resultado)){ 
                                echo "<tr><td>".$fila['nombre']."</td><td>".$fila['precio']."</td><td>".$fila['tipo']
                                ."</td><td>".$fila['fecha']."</td></tr>";
                            }      
                        ?>
                        </table>
                        <?php }
                        
                        }?>
            </div>
        </div>
    </form>
</body>
</html>