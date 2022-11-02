<?php
    //incluir fichero de configuracion y de metodos d gestion de Base de datos
    include_once("config.php");
    include_once("gestionBD_ip.php");

    //Crear conexion BD
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    mysqli_select_db($con, DB_DATABASE);

    $contadorSeleccionado=0;

    function fndOptionSelected($opcion){

        global $contadorSeleccionado;

        if(isset($_POST['cliente']) && !empty($_POST['cliente']) ){
            if($_POST['cliente']==$opcion){
                return "selected";
            }else{
                $contadorSeleccionado++;
            }     
        }else{
            if($contadorSeleccionado==0){
                $contadorSeleccionado++;
                return "selected";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante - Seleccionar Cliente - IP</title>
</head>
<body>
    <form action="<?php echo RUTA_PEDIDOS_IOO?>" method="post">

    <h1> Restaurante - Información Alimentos</h1>  
    <h3> Clientes</h3> 
    <select name="cliente" id="cliente">
        <?php
            $resultado=fncConsultarTabla($con, SQL_BUSCAR_CLIENTES);

            while($fila = $resultado->fetch_assoc()){ 
                echo "<option value='".$fila['nombre']."'".fndOptionSelected($fila['nombre'])." >".$fila['nombre']."</option>";
            }     
        ?>  
    </select>
    <input type="submit" name="selectCliente" value="Seleccionar Cliente">  
    </form>
</body>
</html>