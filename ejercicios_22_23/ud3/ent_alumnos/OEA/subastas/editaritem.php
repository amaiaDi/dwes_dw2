<?php
    require("cabecera.php");
    $error = "";
    /*if(isset($_POST['id']))
        $id = $_POST['id'];
    else
        $id = $_GET['id'];*/
    $id="4";
    if(isset($_POST['botbajar']) || isset($_POST['botsubir'])){
        if(isset($_POST['botbajar']))
            $cantidad = -$_POST['cantidad'];
        else
            $cantidad = $_POST['cantidad'];
        $actualizarPrecio = "UPDATE items SET preciopartida= (preciopartida+".$cantidad.") WHERE id ='".$id."'";
        $resultadoActualizarPrecio = mysqli_query($con, $actualizarPrecio);  
        if(mysqli_errno($con)) die(mysqli_error($con));
    }
    if(isset($_POST['botsubirimg'])){
        $insertImg = "INSERT INTO imagenes (id_item,imagen) VALUES ('".$id."','".$_POST['img']."')"; 
        $resultadoInsertImg = mysqli_query($con, $insertImg);  
        if(mysqli_errno($con)) die(mysqli_error($con)); 
    }
    if(isset($_GET['imgBorrar'])){
        $deleteImg = "DELETE FROM imagenes WHERE id='".$_GET['imgBorrar']."'"; 
        $resultadoDeleteImg = mysqli_query($con, $deleteImg);  
        if(mysqli_errno($con)) die(mysqli_error($con));
    }
    $sql = "SELECT * FROM items WHERE id='".$id."'";
    $resultado = mysqli_query($con,$sql);
    if(!$resultado)
        echo mysqli_error($con);
    while($fila = mysqli_fetch_assoc($resultado)){
        //Nombre
        $nombre = $fila['nombre'];
        //Precio actual
        $precio = $fila['preciopartida'];
        //FechaFin
        $fechafin = $fila['fechafin'];
    }
    if(isset($_POST['botposponer1hora']) || isset($_POST['botposponer1dia'])){
        if(isset($_POST['botposponer1hora']))
            $fecha = date("Y-m-d H:i:s",strtotime($fechafin."+ 1 hours"));
        else
            $fecha = date("Y-m-d",strtotime($fechafin."+ 1 days"));
        $actualizarFechaFin = "UPDATE items SET fechafin='".$fecha."' WHERE id ='".$id."'";
        $resultadoActualizarFechaFin = mysqli_query($con, $actualizarFechaFin);  
        if(mysqli_errno($con)) die(mysqli_error($con));
    }
    function imagnesItem($con, $id_item){
        $tieneImg = "false";
        $sql = "SELECT * FROM imagenes WHERE id_item='".$id_item."'";
        $resultado = mysqli_query($con,$sql);
        if(!$resultado)
        echo mysqli_error($con);
        echo "<table>";
            while($fila = mysqli_fetch_assoc($resultado)){
                echo "<tr>";
                    echo "<td>".$fila['imagen']."</td>";
                    echo "<td><a href='?imgBorrar=".$fila['id']."'>[BORRAR]</a></td>";
                    $tieneImg = "true";
                echo "</tr>";
            }
        echo "</table>";
        if($tieneImg == "false")
                echo "No hay imágenes del item";
    }
    function tienePujas($con, $id){
        $consultaNumPujas = "SELECT count(*) FROM pujas WHERE ".$id." = id_item";
        $resultadoNumPujas = mysqli_query($con, $consultaNumPujas);
        $pujas = mysqli_fetch_assoc($resultadoNumPujas);
        if($pujas['count(*)']>0)
            return true;
        else
            return false;
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
    <h1><?php echo $nombre; ?></h1>
    <?php echo "<p style='color:red;'>".$error."</p>" ?>
    <table>
        <?php if(tienePujas($con, $id)==false){ ?>
            <tr>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="hidden" name=id value="<?php echo $id;?>">
                    <td><b>Precio de salida: </b><?php echo $precio.DB_MONEDA;?></td>
                    <td><input type="number" name="cantidad" required><input type="submit" name="botbajar" value="BAJAR"><input type="submit" name="botsubir" value="SUBIR"></td>
                </form>
            </tr>
        <?php } ?>
        <tr>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name=id value="<?php echo $id;?>">
            <td><b>Fecha fin para pujar: </b><?php echo $fechafin;?></td>
            <td><input type="submit" name="botposponer1hora" value="POSPONER 1 HORA"><input type="submit" name="botposponer1dia" value="POSPONER 1 DIA"></td>
        </form>
        </tr>
    </table>
    <h2>Imagenes actuales</h2>
    <?php imagnesItem($con, $id); ?>
    <table>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <tr>
                <input type="hidden" name=id value="<?php echo $id;?>">
                <td>Imagen a subir</td>
                <td><input type="text" name="img" required></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="botsubirimg" value="Subir"></td>
            </tr>
        </form>
    </table>
</body>
</html>