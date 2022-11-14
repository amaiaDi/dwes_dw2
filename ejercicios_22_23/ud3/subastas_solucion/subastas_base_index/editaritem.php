<?php
    /**
     * Pagina editar item que se carga en el centro, en el div main
     */

    //Cagamos la estructura de la pagina de cabecera
    require("cabecera.php");
    //Establece la información de la ultima pagina visitada.Cargamos la de la pagina a la que accedemos porque será la anteior al movernos a la siguiente
    $_SESSION['pagina_anterior'] =  $_SERVER["REQUEST_URI"];

    //Comprobamos si estamos recibiendo en la peticion GET el elemento de id_item y recuperamos la información de BD para mostrarsela al usuario
    if(isset($_GET['id_item'])){
        $id_item = $_GET['id_item'];
        //Obtenemos el nombre del item en base al id para mostrarlo por pantalla
        $nombreItem= getNombreItem($id_item);
        //Obtenemos el precio maximo de puja en base al id de item
        $precio_salida = getPrecioMaximo($id_item);
        //Obtenemos la fecha de vencimiento de la puja en base al id de item
        $fecha_fin = getFechaFinPuja($id_item);

        //Aplicamos formato a la fecha de vencimiento a mostrar por pantalla
        setlocale (LC_TIME, "es_ES.UTF-8");
        $fecha_fin = date("d/M/Y H:i",strtotime($fecha_fin));
    }

    //Comprobamos si existe el elemento bajar o subir enviado desde el formulario dentro de la variable POST
    if(isset($_POST['bajar']) || isset($_POST['subir'])){
        $cantidad = $_POST['cantidad'];
        if(isset($_POST['bajar'])) $nuevo = modificarPrecio($id_item, $cantidad, $precio_salida, "bajar");
        if(isset($_POST['subir'])) $nuevo = modificarPrecio($id_item, $cantidad, $precio_salida, "subir"); 
        header("Location: editaritem.php?id_item=$id_item");
    }

    //si se ha pulsado posponer_hora o posponer_dia
    if(isset($_POST['posponer_hora']) || isset($_POST['posponer_dia'])){
        if(isset($_POST['posponer_hora'])) $tipo = "hour";
        if(isset($_POST['posponer_dia'])) $tipo = "day";
        $mensaje_control = posponer($tipo, $id_item);
        header("Location: editaritem.php?id_item=$id_item");
    }

    //Enlace borrar imagen. Primero de BD y si se borra adecuadamente de la carpeta local
    if(isset($_GET['borrar_img'])){
        $ruta = $_GET['borrar_img'];
        if( eliminarImagenBBDD($ruta)){
            eliminarImagenLocal($ruta);
        }  
    }

    //Si se ha pulsado subir imagen 
    if(isset($_POST['subir_imagen'])){
        //Si hay contenido en la variable FILES con los datos del nuevo fichero
        if(isset($_FILES)){
            // Obtenemos el nombre del fichero
            $nombre_img = $_FILES['archivo_imagen']['name'];
            //buscamos ese nombre, si ya existe uno para el mismo item modificamos el nombre añadiendole un patron numerico detras
            $nombre_nuevo = getNombreImagen($nombre_img, $id_item);
            // obtenemos ruta del fichero, guardamos la ruta en BD y redireccionamos a editar item cargando el item de nuevo
            $ruta = obtenerRutaFichero()."/img/" . $nombre_nuevo;
            move_uploaded_file($_FILES['archivo_imagen']['tmp_name'], $ruta);
            insertarImagen($id_item, $nombre_nuevo);
            header("Location: editaritem.php?id_item=$id_item");
        }
    }
?>

    <h1><?=TITULO_EDITAR_ITEM?></h1>
    <h2><?=$nombreItem?></h2>
    <table>
    <?php
        // if(isset($mensaje_control)) echo $mensaje_control;
        if(getCantidadPujas($id_item) == 0){
    ?>
        <tr>
            <td><?=TEXTO_PRECIO_SALIDA?>: <?php echo $precio_salida;?> €</td>
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
            <td><?=TEXTO_FECHA_FIN_PARA_PUJAR?>: <?php echo $fecha_fin;?></td>
            <td>
                <form action=<?php echo "editaritem.php?id_item=$id_item";?> method="post">
                    <input type="submit" value="POSPONER 1 HORA" name="posponer_hora">
                    <input type="submit" value="POSPONER 1 DIA" name="posponer_dia">
                </form>
            </td>
        </tr>
    </table>
    <h2><?=TEXTO_IMAGENES_ACTUALES?></h2>
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
    <div class="msg-rojo"><?php if(isset($errores)) echo $errores;?></div>
<?php require("pie.php"); ?>
