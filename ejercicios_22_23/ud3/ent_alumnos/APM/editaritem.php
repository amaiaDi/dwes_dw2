<?php require "cabecera.php";
    $_SESSION['link'] = $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    //VALIDACION DE ITEM USUARIO
    $id = $_GET['item'];
    $user = isset($_SESSION['user']) ? $_SESSION['user'] : -1;
    $sql = "select id from items where id_user = $user and id = $id";
    $resultado = $conn->query($sql);
    if($conn->errno) die($conn->error);
    $fila = $resultado -> fetch_assoc();
    if (isset($fila['id'])):
?>
<div>
    <?php //EDICION DE PRECIO Y FECHA
        //BAJAR CANTIDAD PRECIO
        if (isset($_POST['bajar'])) {
            $cambio = $_POST['bajsub'];
            $cantidad = $_POST['cantidad'];
            $total = $cantidad - $cambio;
            $sql = "update items set preciopartida = '$total' where id = '$id'";
            $resultado = $conn->query($sql);
            if($conn->errno) die($conn->error);
        }

        //SUBIR CANTIDAD PRECIO
        if (isset($_POST['subir'])) {
            $cambio = $_POST['bajsub'];
            $cantidad = $_POST['cantidad'];
            $total = $cantidad + $cambio;
            $sql = "update items set preciopartida = '$total' where id = '$id'";
            $resultado = $conn->query($sql);
            if($conn->errno) die($conn->error);
        }

        //POSPONER 1 HORA
        if (isset($_POST['1h'])) {
            $sql = "update items set fechafin = date_add(fechafin, interval 1 hour) where id = '$id'";
            $resultado = $conn->query($sql);
            if($conn->errno) die($conn->error);
        }

        //POSPONER 1 DIA
        if (isset($_POST['1d'])) {
            $sql = "update items set fechafin = date_add(fechafin, interval 1 day) where id = '$id'";
            $resultado = $conn->query($sql);
            if($conn->errno) die($conn->error);
        } 

        $sql = "select *, (select count(id) from pujas where id_item = it.id) as pujascount from items it where it.id = $id";
        $resultado = $conn->query($sql);
        if($conn->errno) die($conn->error);
        $fila = $resultado -> fetch_assoc();
        echo "<h2>" . $fila['nombre'] ."</h2>";
        echo "<table id='editar'>";
        $fecha = strtotime($fila['fechafin']);
        if ($fila['pujascount']==0) {
            echo "<form action='editaritem.php?item=$id' method='post'>
            <tr>
                <td><strong>Precio de salida:</strong> " . $fila['preciopartida'] . "€ </td>
                <td>
                    <input type='hidden' name='cantidad' value=" . $fila['preciopartida'] .">
                    <input type='text' name='bajsub' id='bajsub'>
                    <input type=submit name='bajar' value='BAJAR' id='bajar'>
                    <input type=submit name='subir' value='SUBIR' id='subir'>
                </td>
            </tr>
            </form>";
        }
        echo "<form action='editaritem.php?item=$id' method='post'>
        <tr>
            <td><strong>Fecha fin para pujar:</strong> " . date("d/M/o g:iA",$fecha) . "</td>
            <td>
                <input type='hidden' name='1hv' value=" . date("g",$fecha) .">
                <input type=submit name='1h' value='POSPONER 1 HORA' id='1h'>
                <input type='hidden' name='1dv' value=" . date("d",$fecha) .">
                <input type=submit name='1d' value='POSPONER 1 DIA' id='1d'>
            </td>
        </tr>
        </form>";

        echo "</table>";
    ?>

    <h2>IMAGENES ACTUALES</h2>

    <?php //VISUALIZAR IMAGENES
        $sql = "select *,(select count(*) from imagenes where id_item = $id) as cont from imagenes where id_item = $id";
        $resultado = $conn->query($sql);
        if($conn->errno) die($conn->error);
        $fila = $resultado -> fetch_assoc();
        if ($fila==null) echo "<p>No hay imagenes</p>";
        else {
            echo "<table>";
            do {
                $imagen = $img . $fila['imagen'];
                $idimg = $fila['id'];
                echo "<tr><td><img src='$imagen'></td><td><a href='editaritem.php?item=$id&elim=$idimg'>[BORRAR]</a></td></tr>";
            } while ($fila = $resultado -> fetch_assoc());
            echo "</table>";
        }
    ?>

    <?php //ELIMINAR IMAGENES
        if (isset($_GET['elim'])) {
            $elimid = $_GET['elim'];
            $itemid = $_GET['item'];
            $sql = "select im.id, imagen 
                from imagenes im 
                where exists (
                    select * from items it
                    where it.id = '$itemid'
                    and it.id_user = '$user'
                )
                and im.id = '$elimid'";
            if($conn->errno) die($conn->error);
            $resultado = $conn->query($sql);
            $fila = $resultado -> fetch_assoc();
            $eliminar = $fila['id'];
            $path = $_SERVER['DOCUMENT_ROOT'] . "/subastas/" . $img . $fila['imagen'];
            unlink($path);
            $sql = "delete from imagenes where id = '$eliminar'";
            if($conn->errno) die($conn->error);
            $resultado = $conn->query($sql);
            header("Location: editaritem.php?item=$id");
        }
    ?>

    <br>

    <div> <!-- FORMULARIO PARA SUBIR IMG -->
        <form action="editaritem.php?item=<?=$id?>" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Imagen a subir</td>
                    <td><input type="file" id="img" name="img"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Subir Imagen" name="subirimg"></td>
                </tr>
            </table>
        </form>
    </div>

    <?php //AÑADIR IMAGENES
        if (isset($_POST['subirimg'])) {
            $img = basename(generarCadenaRad(8).$_FILES["img"]["name"]);
            $target_file = "img/" . $img;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["img"]["tmp_name"]);
            if($check !== false) {
                move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
                $sql = "insert into imagenes (`id_item`,`imagen`) values ('$id','$img')";
                $resultado = $conn->query($sql);
                if($conn->errno) die($conn->error);
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
            header("Location: editaritem.php?item=$id");
        }
    ?>
</div>
<?php else : ?>
    <h2>ESTE ITEM NO ES TUYO NO PUEDES EDITARLO</h2>
<?php endif ; require "pie.php"; ?>