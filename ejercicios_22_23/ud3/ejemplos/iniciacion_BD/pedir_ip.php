<?php
    //incluir fichero de configuracion y de metodos d gestion de Base de datos
    include_once("config.php");
    include_once("gestionBD_ip.php");
    include_once("funciones.php");

    //Crear conexion BD
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    mysqli_select_db($conn, DB_DATABASE);

    $nombreCliente="";

    if(isset($_POST["selectCliente"])){
        if(!empty($_POST["cliente"])){
            $nombreCliente=$_POST["cliente"];
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante - Hacer pedido</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">

        <h1> Restaurante - Pedidos</h1>  
        <h3> Cliente: <?php echo $nombreCliente;?></h3> 
        
    </form>

    <!-- FORMULARIO PARA SUBIR FICHEROS -->
    <form action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data" method="post">

    <?php
            $resultado= fncConsultarTabla($conn,SQL_BUSCAR_ALIMENTOS);
            
            if (isset($resultado)){ 
        ?>
                <h3> Datos de tabla de Alimentos</h3>
                <table>
                    <tr><td>Selección</td><td>Nombre</td><td>Precio</td><td>Tipo</td><td>Fecha</td><td>Imagen</td></tr>
                <?php
                    //Recogida de datos a mostrar, incluido fichero BLOB
                    while($fila = mysqli_fetch_assoc($resultado)){ 
                        echo "<tr>";
                        echo "<td><input type='radio' name='alimento' value='".$fila['id']."' ".fncIsChecked($fila['id'],'alimentos')."></td>";
                        echo "<td>".$fila['nombre']."</td><td>".$fila['precio']."</td><td>".$fila['tipo']."</td><td>".$fila['fecha']."</td>";
                        echo "<td><img src='data:image/jpeg;base64,".base64_encode($fila['fichero'])." '/></td>";
                        echo "</tr>";
                    }      
            
                ?>
                </table>
        <?php } ?>


    </form>

</body>
</html>