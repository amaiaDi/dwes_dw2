<?php
    require("cabecera.php");
    $_SESSION['pagina_anterior'] =  $_SERVER["REQUEST_URI"];
    if(isset($_GET['id_item'])){
        $id_item = $_GET['id_item'];
        $precio_salida = precioMaximo($id_item);
        $fecha_fin = fechaFinPuja($id_item);
        setlocale (LC_TIME, "es_ES.UTF-8");
        $fecha_fin = date("d/M/Y H:i",strtotime($fecha_fin));
    }
    if(isset($_POST['bajar']) || isset($_POST['subir'])){
        $cantidad = $_POST['cantidad'];
        if(isset($_POST['bajar'])) $nuevo = modificarPrecio($id_item, $cantidad, $precio_salida, "bajar");
        if(isset($_POST['subir'])) $nuevo = modificarPrecio($id_item, $cantidad, $precio_salida, "subir"); 
        header("Location: editaritem.php?id_item=$id_item");
    }
    if(isset($_POST['posponer_hora']) || isset($_POST['posponer_dia'])){
        if(isset($_POST['posponer_hora'])) $tipo = "hour";
        if(isset($_POST['posponer_dia'])) $tipo = "day";
        $mensaje_control = posponer($tipo, $id_item);
        header("Location: editaritem.php?id_item=$id_item");
    }
    if(isset($_GET['borrar_img'])){
        $ruta = $_GET['borrar_img'];
        eliminarImagenBBDD($ruta);
        eliminarImagenLocal($ruta);
    }
    if(isset($_POST['subir_imagen'])){
        echo "entra<br>";
        if(isset($_FILES)){
            $nombre_img = $_FILES['archivo_imagen']['name'];
            $nombre_nuevo = nombreImagen($nombre_img, $id_item);
            $ruta = "C:/wamp/www/dwes/ud3 - BBDD/subastas/img/" . $nombre_nuevo;
            move_uploaded_file($_FILES['archivo_imagen']['tmp_name'], $ruta);
            insertarImagen($id_item, $nombre_nuevo);
            header("Location: editaritem.php?id_item=$id_item");
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Item</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Editar Item</h1>
    <h2>Nombre item</h2>
    <table>
    <?php
        // if(isset($mensaje_control)) echo $mensaje_control;
        if(cantidadPujas($id_item) == 0){
    ?>
        <tr>
            <td>Precio de salida: <?php echo $precio_salida;?> €</td>
            <td>
                <form action=<?php echo "editaritem.php?id_item=$id_item";?> method="post">
                    <input type="text" name="cantidad">
                    <input type="submit" value="BAJAR" name="bajar">
                    <input type="submit" value="SUBIR" name="subir">
                </form>
            </td>
        </tr>
    <?php
        }
    ?>
        <tr>
            <td>Fecha fin para pujar: <?php echo $fecha_fin;?></td>
            <td>
                <form action=<?php echo "editaritem.php?id_item=$id_item";?> method="post">
                    <input type="submit" value="POSPONER 1 HORA" name="posponer_hora">
                    <input type="submit" value="POSPONER 1 DIA" name="posponer_dia">
                </form>
            </td>
        </tr>
    </table>
    <h2>Imagenes actuales</h2>
    <table>
        <tr>
            <?php 
                $arr_img = obtenerImagenes($id_item);
                if(count($arr_img) == 0){
                    echo "<td>No hay imágenes del ítem</td>";
                }
                else{
                    foreach($arr_img as $img){
                        $ruta_img = substr($img, strpos($img,'/')+1);
                        // echo "$ruta_img<br>";
                        echo "<tr><td><img src='$img' class='imagen'/></td>
                                <td><a href='editaritem.php?id_item=$id_item&borrar_img=$ruta_img'>[BORRAR]</a></td></tr>";
                    }
                }
            ?>
        </tr>
    </table>
    <?php 
    ?>
    <table>
        <form action='<?php echo "editaritem.php?id_item=$id_item";?>' method="post" enctype="multipart/form-data">
            <tr>
                <td>Imagen a subir</td>
                <td><input type="file" name="archivo_imagen"></td>
            </tr>
            <tr>
                <td><input type="submit" value="Subir" name="subir_imagen"></td>
            </tr>
        </form>
    </table>
    <?php require("pie.php"); ?>

</body>
</html>