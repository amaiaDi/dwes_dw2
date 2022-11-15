<?php
    require("cabecera.php");
    if(isset($_SESSION['usuario']))
        $_SESSION['ultimaPagina'] = $_SERVER["REQUEST_URI"];
    $error = "";
    if(isset($_POST['id']))
    $id = $_POST['id'];
    else
        $id = $_GET['id'];
    $sql = "SELECT * FROM items WHERE id='".$id."'";
    $resultado = mysqli_query($con,$sql);
    if(!$resultado)
        echo mysqli_error($con);
    while($fila = mysqli_fetch_assoc($resultado)){
        //Nombre
        $nombre = $fila['nombre'];
        //Número de pujas hoy
        $hoy = date('Y-m-d');
        $consultaNumPujasHoy = "SELECT count(*) FROM pujas WHERE ".$id." = id_item && fecha ='".$hoy."'";
        $resultadoNumPujasHoy = mysqli_query($con, $consultaNumPujasHoy);
        $pujasHoy = mysqli_fetch_assoc($resultadoNumPujasHoy);
        //Número de pujas
        $consultaNumPujas = "SELECT count(*) FROM pujas WHERE ".$id." = id_item";
        $resultadoNumPujas = mysqli_query($con, $consultaNumPujas);
        $pujas = mysqli_fetch_assoc($resultadoNumPujas);
        //Precio actual
        $consultaMaxCantidad = "SELECT MAX(cantidad) FROM pujas WHERE ".$id." = id_item";
        $resultadoMaxCantidad = mysqli_query($con, $consultaMaxCantidad);
        $precioMax = mysqli_fetch_assoc($resultadoMaxCantidad);
        $precio = $precioMax['MAX(cantidad)'];
        if(empty($precio))
            $precio = $fila['preciopartida'];
        //FechaFin
        $fechafin = $fila['fechafin'];
        //Descripcion
        $descripcion = $fila['descripcion'];
        //Imagenes
        $consultaImg = "SELECT imagen FROM imagenes WHERE ".$id." = id_item";
        $resultadoImg= mysqli_query($con, $consultaImg);
        $img = mysqli_fetch_assoc($resultadoImg);
        if(empty($img['imagen']))
            $imagen = "NO IMAGEN";
        else
            $imagen = $img['imagen'];
    }
    if(isset($_POST['botpuja'])){
        if($_POST['puja'] <= $precio)
            $error = "Puja muy baja!";
        else{
            if($pujasHoy['count(*)'] > 2)
                $error = "Límite de 3 pujas por día";
            else{
                $sql = "INSERT INTO pujas (id_item,id_user,cantidad,fecha) VALUES ('".$id."','".$_SESSION['id']."','".$_POST['puja']."','".$hoy."')";
                $resultado = mysqli_query($con, $sql); 
                if(mysqli_errno($con)) die(mysqli_error($con));
            }
        }
    }
    function historialSubastado($id_item, $con){
        $sql = "SELECT cantidad, username FROM pujas, usuarios WHERE id_item='".$id_item."' && usuarios.id=id_user ORDER BY fecha DESC, pujas.id DESC";
        $resultado = mysqli_query($con,$sql);
        if(!$resultado)
            echo mysqli_error($con);
        while($fila = mysqli_fetch_assoc($resultado)){
            echo "<li>".$fila['username']."- ".$fila['cantidad']."</li>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo DB_TITULO." Item detalles"; ?></title>
</head>
<body>
    <h1><?php $nombre; ?></h1>
    <p>
        <b>Número de pujas: </b><?php echo $pujas['count(*)']; ?>
         - <b>Precio actual: </b><?php echo $precio.DB_MONEDA; ?>
         - <b>Fecha fin para pujar: </b><?php echo $fechafin; ?>
    </p>
    <p><?php echo $imagen; ?></p>
    <p><?php echo $descripcion; ?></p>
    <h2>Pujas por este item</h2>
    <?php if(isset($_SESSION['usuario'])){ ?>
        <p>Añade tu puja en el cuadro inferior</p>
        <table>
            <tr>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="hidden" name=id value="<?php echo $id;?>">
                    <td><input type="text" name="puja" required></td>
                    <td><input type="submit" name="botpuja" value="¡Puja!"><?php echo "<p style='color:red;'>".$error."</p>" ?></td>
                </form>
            </tr>
        </table>
        <h2>Historial de la puja</h2>
        <ul>
            <?php historialSubastado($id, $con); ?>
        </ul>
    <?php }else {?>
        <p>Para pujar, debes autentificarte <b><a href="login.php?url=<?php echo $_SERVER["REQUEST_URI"]; ?>">aquí</a></b></p>
    <?php } require("pie.php"); ?>
</body>
</html>