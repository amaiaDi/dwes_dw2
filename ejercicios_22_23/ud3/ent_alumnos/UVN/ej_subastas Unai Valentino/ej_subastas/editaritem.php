<?php
    require('header.php');
    
    $itemId = $_GET['id'];
    
    $consultaItem = "SELECT * FROM items WHERE id = $itemId";
    $resultadoItem = mysqli_query($conn, $consultaItem);
    $item = mysqli_fetch_assoc($resultadoItem);
    echo "<h1>".ucfirst($item['nombre'])."</h1>";

    if(isset($_POST['cantidad'])){
        if(isset($_POST['bajar'])){
            $nuevoPrecio = $item['preciopartida'] - $_POST['cantidad'];
            $updateItem = "UPDATE items SET preciopartida = $nuevoPrecio WHERE id = $itemId;";
            mysqli_query($conn, $updateItem);
        }
        else if(isset($_POST['subir'])){
            $nuevoPrecio = $item['preciopartida'] + $_POST['cantidad'];
            $updateItem = "UPDATE items SET preciopartida = $nuevoPrecio WHERE id = $itemId;";
            mysqli_query($conn, $updateItem);
        }
    }
    if(isset($_POST['hora'])){
        $fecha = new DateTime($item['fechafin']);
        $fecha -> modify("+ 1 hours");
        $nuevaFecha = $fecha -> format("Y-m-d H:i");
        $updateItem = "UPDATE items SET fechafin = '$nuevaFecha' WHERE id = $itemId;";
        mysqli_query($conn, $updateItem);
    }
    if(isset($_POST['dia'])){
        $fecha = new DateTime($item['fechafin']);
        $fecha -> modify("+ 1 day");
        $nuevaFecha = $fecha -> format("Y-m-d H:i");
        $updateItem = "UPDATE items SET fechafin = '$nuevaFecha' WHERE id = $itemId;";
        mysqli_query($conn, $updateItem);
    }

    $url = $_SERVER["REQUEST_URI"];
    
    //Repito la consulta para mostrar la actualizacion
    $resultadoItem = mysqli_query($conn, $consultaItem);
    $item = mysqli_fetch_assoc($resultadoItem);
    $precioPartida = $item['preciopartida'];
    $fechafin = $item['fechafin'];

    $consultaPujas = "SELECT count(*) FROM pujas WHERE id_item = $itemId;";
    $respuestaPujas = mysqli_query($conn, $consultaPujas);
    $cantPujas = mysqli_fetch_assoc($respuestaPujas);

    echo "<table>";

        if($cantPujas['count(*)'] == 0){
            echo "<tr>
                    <form action='$url' method='post'>
                        <td><strong>Precio de salida: </strong>$precioPartida €</td>
                        <td><input type='number' name='cantidad'><input type='submit' value='BAJAR' name='bajar'><input type='submit' value='SUBIR' name='subir'></td>
                    </form>
                </tr>";
        }
        echo "<tr>
                <form action='$url' method='post'>
                    <td><strong>Fecha fin para pujar: </strong>$fechafin</td>
                    <td><input type='submit' value='POSPONER 1 HORA' name='hora'><input type='submit' value='POSPONER 1 DIA' name='dia'></td>
                </form>
            </tr>
        </table>";

    echo "<h1>Imagenes actuales</h1>";
    
    if(isset($_POST['subir'])){
        if(isset($_FILES['examinar'])){
            //Nombre y tipo del archivo subido
            $nombreImg = $_FILES['examinar']['name'];
            $tipoImg = substr($nombreImg, strpos($nombreImg, '.')+1);
            $nombreImg = substr($nombreImg, 0, strpos($nombreImg, '.'));

            //Comprobar todos los nombres de las imagenes
            $arrNomImg = [];
            $consultaImg = "SELECT imagen FROM imagenes;";
            $respuestaImg = mysqli_query($conn, $consultaImg);
            foreach($respuestaImg as $img){
                array_push($arrNomImg, substr($img['imagen'], 0, strpos($img['imagen'], '.')));
            }
            //Cambiar nombre hasta uno que no esté
            $cont = 1;
            $nombreImg1 = $nombreImg;
            while(in_array($nombreImg1, $arrNomImg)){
                $nombreImg1 = $nombreImg;
                if($cont < 10){
                    $nombreImg1 .='_0'.$cont;
                }
                else{
                    $nombreImg1 .='_'.$cont;
                }
                $cont++;
            }
            //Miro cual es el ultimo id y guardo la imagen en la bdd
            $consultaUltimoId = "SELECT MAX(id) FROM imagenes;";
            $respuestaUltimoId = mysqli_query($conn, $consultaUltimoId);
            $ultimoId = mysqli_fetch_assoc($respuestaUltimoId);
            $nuevoId = $ultimoId['MAX(id)'] + 1;

            $insertarImagen = "INSERT INTO imagenes VALUES ($nuevoId, $itemId, '$nombreImg1.$tipoImg');";
            mysqli_query($conn, $insertarImagen);

            //Guardar imagen en la carpeta
            move_uploaded_file($_FILES['examinar']['tmp_name'], "img/$nombreImg1.$tipoImg");
        }
    }

    //Borrar imagen
    if(isset($_GET['borrar'])){
        $rutaImg = "img/" . $_GET['borrar'];
        unlink($rutaImg);
        $borrarImg = "DELETE FROM imagenes WHERE imagen = '".$_GET['borrar']."';";
        mysqli_query($conn, $borrarImg);
    }

    //Comprobar si hay imagenes
    $consultaImgCant = "SELECT count(*) FROM imagenes WHERE id_item = $itemId;";
    $respuestaImgCant = mysqli_query($conn, $consultaImgCant);
    $imagenCant = mysqli_fetch_assoc($respuestaImgCant);

    if($imagenCant['count(*)'] == 0){
        echo "<p>No hay imágenes del item</p>";
    }
    else{
        echo "<table>";
        $consultaImg = "SELECT imagen FROM imagenes WHERE id_item = $itemId;";
        $respuestaImg = mysqli_query($conn, $consultaImg);
        foreach($respuestaImg as $img){
            echo "<tr>
                    <td><img src='img/".$img['imagen']."' width='150'></td>
                    <td><p><a href='editaritem.php?id=$itemId&borrar=".$img['imagen']."'>[BORRAR]</a></p>
                </td></tr>";
        }
        echo "</table><br>";

    }
    echo "<form action='$url' method='post' enctype='multipart/form-data'>
            <table>
                <tr>
                    <td>Imagen a subir</td>
                    <td><input type='file' name='examinar'></td>
                </tr>
                <tr>
                    <td colspan='2'><input type='submit' value='Subir' name='subir'></td>
                </tr>
            </table>
        </form>";



    require('pie.php');
?>
