<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Item</title>
    <link rel="stylesheet" href="./css/stylesheet.css">
</head>
<body>
    <?php 
        include "config.php"; 
        $nombre_Foro = NOMBRE_FORO;
        session_start();
        require "cabecera.php";
    ?>
    <div id="container">
        <?php
            if(isset($_GET["item"])){
                $id = $_GET["item"];
                $sql_validar_user = "SELECT id_user id FROM items WHERE id = $id";
                $result = $conn -> query($sql_validar_user);
                if($conn -> errno) die($conn);
                $fila = $result -> fetch_assoc();
                if(intval($fila["id"])!= intval($_SESSION["id_usuario"])){
                    header("Location: index.php");
                    return;
                }
            }else{
                header("Location: index.php");
                return;
            }
            //sacar el item
            $sql_item = "SELECT *,(SELECT count(id) FROM pujas WHERE id = $id) cant_pujas FROM items WHERE id = $id";
            $resultado = $conn -> query($sql_item);
            if($conn -> errno) die($conn);
            $item = $resultado -> fetch_assoc();
            $cambiar_precio = esCambioPrecio($item["preciopartida"]);
            //cambiar precio
            /*if(strcmp($cambiar_precio,"bajar")==0 || strcmp($cambiar_precio,"subir")==0){
                $cambiar_precio = cambiarPrecio($conn,$item["preciopartida"],$_POST["cambiar_precio"],$id,false);
                if(strcmp($cambiar_precio,"") == 0)
                    header("Location: editaritem.php?item=$id");
            }*/
            //cambiar fecha
            $cambio_fecha = esCambiarFecha();
            if(strcmp($cambio_fecha,"")!=0){
                $fecha = date_create($item["fechafin"]);
                if(strcmp($cambio_fecha,"hora")!=0)
                    date_add($fecha,date_interval_create_from_date_string("1 days"));
                else
                    date_add($fecha,date_interval_create_from_date_string("1 hours"));
                cambiarFecha($conn,date_format($fecha,"Y-m-d H:i:s"),$id);
                header("Location: editaritem.php?item=$id");
            }
        ?>
        <section>
            <form action="" method="post" enctype="multipart/form-data">
                <h2><?php echo $item["nombre"] ?></h2>
                <article>
                    <table>
                        <?php if($item["cant_pujas"] == 0):?>
                            <?php echo $cambiar_precio?>
                            <tr>
                                <td><b>Precio de salida: </b><?php echo $item["preciopartida"]?> €</td>
                                <td>
                                    <input type="text" name="cambiar_precio" id="cambiar_precio">
                                    <input type="submit" name="bajar_precio" value="BAJAR">
                                    <input type="submit" name="subir_precio" value="SUBIR">
                                </td>
                            </tr>
                        <?php endif;?>
                        <tr>
                            <td><b>Fecha fin para pujar: </b><?php echo date_format(date_create($item["fechafin"])," d/m/Y H:i:s") ?></td>
                            <td><input type="submit" name="aumentar_hora" value="POSPONER 1 HORA"><input type="submit" name="aumentar_dia" value="POSPONER 1 DIA"></td>
                        </tr>
                    </table>
                </article>
                <h2>Imagenes actuales</h2>
                <article>
                    <?php 
                        $sql_cant_imagenes = "SELECT COUNT(imagen) cant FROM imagenes WHERE id_item = $id";
                        $resul_cant = $conn -> query($sql_cant_imagenes);
                        if($conn -> errno) die($conn -> error); 
                        $cant = ($resul_cant -> fetch_assoc())["cant"];
                        if($cant >0) :
                    ?>
                        <?php
                            if(isset($_GET["borrar_img"])){
                                $id_img = $_GET["borrar_img"];
                                $resul_img = buscarImagen($conn,$id,$id_img);
                                $imagen = $resul_img -> fetch_assoc();
                                $sql_borrar_img = "DELETE FROM `imagenes` WHERE id = $id_img";
                                $borrado = $conn -> query($sql_borrar_img);
                                if($conn -> errno) die($conn -> error);
                                if(!unlink(IMAGENES . "/" . $imagen["img"]))
                                    echo "<p>La imagen no a podido borrarse</p>";
                            }
                            $resul_imagenes = buscarImagen($conn,$id);
                            while($fila_imagen = $resul_imagenes -> fetch_assoc()){
                                echo "<table><tr>";
                                echo "<td><img src='". IMAGENES . "/" . $fila_imagen["img"] ."' alt='". $fila_imagen["img"] ."' width='150rem'></td>";
                                echo "<td><a href='editaritem.php?item=$id&borrar_img=". $fila_imagen["id"] ."'>[BORRAR]</a></td>";
                                echo "</tr></table>";
                            }
                        ?>
                    <?php else: ?>
                        <span>No hay imagenes del item.</span>
                    <?php endif ?>
                    <?php 
                        if(isset($_POST["subir"])){
                            $archivo = $_FILES["subir_imagen"]["name"];
                            if(isset($archivo) && $archivo != ""){
                                $ext = substr($archivo,strrpos($archivo,".")+1);
                                if(strcmp($ext,"jpg") != 0 && strcmp($ext,"png") != 0)
                                    echo "<p>Extencion no valida</p>";
                                else{
                                    $temp = $_FILES["subir_imagen"]["tmp_name"];
                                    if(move_uploaded_file($temp,IMAGENES . "/".$archivo)){
                                        subirImagen($conn,$archivo,$id);
                                        header("Location: editaritem.php?item=$id");
                                    }else
                                        echo "<p>a ocurrido un error inesperado</p>";
                                }
                            }
                        }
                    ?>
                    <table>
                        <tr>
                            <td>Imagen a subir</td>
                            <td><input type="file" name="subir_imagen" id="subir_imagen"></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" name="subir" value="Subir"></td>
                        </tr>
                    </table>
                </article>
            </form>
        </section>
        <?php 
            function esCambioPrecio($precio){
                if(isset($_POST["bajar_precio"])){
                    if(empty($_POST["cambiar_precio"]) || $precio <= $_POST["cambiar_precio"]){
                        return "<p>Tienes que poner un valor valido en para poder bajar el precio</p>";
                    }else
                        return "bajar";
                }
                if(isset($_POST["subir_precio"])){
                    if(empty($_POST["subir_precio"]) || $precio >= $_POST["cambiar_precio"]){
                        return "<p>Tienes que poner un valor valido en para poder subir el precio</p>";
                    }else
                        return "subir";
                }
                return "";
            }

            function cambiarPrecio($conn,$precio_actual,$precio_nuevo,$id_item,$esSubir){
                $precio_nuevo = $esSubir ? $precio_actual + $precio_nuevo : $precio_actual - $precio_nuevo;
                if($precio_nuevo <=0)
                    return "<p>Daria 0 o un valor negativo</p>";
                $sql_cambiar_precio = "UPDATE items SET preciopartida = $precio_nuevo WHERE id = $id_item";
                $valido = $conn -> query($sql_cambiar_precio);
                if($conn -> errno) die($conn -> error);
                return "";
            }

            function esCambiarFecha(){
                if(isset($_POST["aumentar_hora"])){
                    return "hora";
                }
                if(isset($_POST["aumentar_dia"])){
                    return "dia";
                }
                return "";
            }

            function cambiarFecha($conn,$fecha,$id_item){
                $sql_cambiar_fecha = "UPDATE items SET fechafin = '$fecha' WHERE id = $id_item";
                $valido = $conn -> query($sql_cambiar_fecha);
                if($conn -> errno) die($conn -> error);
            }

            function subirImagen($conn,$archivo,$id_item){
                $sql_aniadir_imagen = "INSERT INTO `imagenes`(`id_item`, `imagen`) VALUES ('$id_item','$archivo')";
                $valido = $conn -> query($sql_aniadir_imagen);
                if($conn -> errno) die($conn -> error);
            }

            function buscarImagen($conn,$id_item,$id_img = -1){
                $sql_imagenes = "SELECT id, imagen img FROM imagenes WHERE id_item = $id_item";
                if($id_img != -1){
                    $sql_imagenes = $sql_imagenes . " AND id = $id_img";
                }
                $resul_imagenes = $conn -> query($sql_imagenes);
                if($conn -> errno) die($conn);
                return $resul_imagenes;
            }
        ?>
    </div>
</body>
</html>