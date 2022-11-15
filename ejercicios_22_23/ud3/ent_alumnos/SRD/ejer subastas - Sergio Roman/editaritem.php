<?php
    require('header.php');
    if(isset($_GET['id']))
    {
        $_SESSION['id_item'] = $_GET['id'];
    }
    $id_item = $_SESSION['id_item'];

    $consultaItemSQL = "SELECT * FROM items where id = $id_item;";
    $resulItemSQL = mysqli_query($conn, $consultaItemSQL);
    $item = mysqli_fetch_assoc($resulItemSQL);
    
    $consultaPujasSQL = "SELECT count(*) FROM pujas where id_item = $id_item";
    $resulPujasSQL = mysqli_query($conn, $consultaPujasSQL);
    $cantpujas = mysqli_fetch_assoc($resulPujasSQL);

    $sw = 0;
    if(isset($_POST['bajar'])){
        $precioExtra = $_POST['precio'];
        $precioPartida = $item['preciopartida'];
        $precioActualizado = intval($precioPartida) - intval($precioExtra);
        $updatePrecioPartidaSQL = "UPDATE items SET preciopartida = $precioActualizado where id = $id_item;";
        mysqli_query($conn, $updatePrecioPartidaSQL);
        $sw = 1;
    }
    else if(isset($_POST['subir'])){
        $precioExtra = $_POST['precio'];
        $precioPartida = $item['preciopartida'];
        $precioActualizado = intval($precioPartida) + intval($precioExtra);
        $updatePrecioPartidaSQL = "UPDATE items SET preciopartida = $precioActualizado where id = $id_item;";
        mysqli_query($conn, $updatePrecioPartidaSQL);
        $sw = 1;
    }
    else if(isset($_POST['hora'])){
        $fechafin = strtotime('+1 hour', strtotime($item['fechafin']));
        $date = date('Y-m-d H:i:00', $fechafin);
        $updateFechaSQL = "UPDATE items SET fechafin = '$date' where id = $id_item;";
        mysqli_query($conn, $updateFechaSQL);
        $sw = 1;
    }
    else if(isset($_POST['dia'])){
        $fechafin = strtotime('+1 day', strtotime($item['fechafin']));
        $date = date('Y-m-d H:i:00', $fechafin);
        $updateFechaSQL = "UPDATE items SET fechafin = '$date' where id = $id_item;";
        mysqli_query($conn, $updateFechaSQL);
        $sw = 1;
    }
    else if(isset($_POST['imgSubir'])){
        $consultaIdSQL = "SELECT max(id) FROM imagenes";
        $resulIdSQL = mysqli_query($conn, $consultaIdSQL);
        $maxId = mysqli_fetch_assoc($resulIdSQL);
        $id = $maxId['max(id)'] + 1;
        $imgConExtension = $_FILES['examinar']['name']; 
        $longitud = strlen($imgConExtension)-4; 
        $img = substr($imgConExtension, 0, $longitud);
        $extension = substr($imgConExtension, $longitud);
        
        $consultaImgExistente = "SELECT imagen FROM imagenes where imagen = '$img';";
        $resulImgExistente = mysqli_query($conn, $consultaImgExistente);

        if($resulImgExistente != null){
            $consultaImagenes = "SELECT imagen FROM imagenes ORDER BY imagen ASC";
            $imagenes = mysqli_query($conn, $consultaImagenes);
            $cont = 1;
            $imagenAInsertar = $img;
            foreach($imagenes as $im){
                if(substr($im['imagen'], 0, strlen($im['imagen'])-4) == $imagenAInsertar){
                    if($cont < 10){
                        $imagenAInsertar = $img . "_0" .$cont;
                        $cont++;
                    }
                    else{
                        $imagenAInsertar = $img . "_" .$cont;
                        $cont++;
                    }
                }
            }
        }

        print_r($imagenAInsertar);
        $imagenAInsertar = $imagenAInsertar . $extension;
        $insertImgSQL = "INSERT INTO imagenes values($id, $id_item, '$imagenAInsertar')";     
        mysqli_query($conn, $insertImgSQL);
        $temp_name = $_FILES['examinar']['tmp_name'];
        move_uploaded_file($temp_name, "C:/wamp/www/dwes/ud3/ejer subastas - Sergio Roman/assets/img/$imagenAInsertar");
        $sw = 1;
    }
    else if(isset($_GET['img'])){
        $imagenABorrar = $_GET['img'];
        $borrarIMG = "DELETE FROM imagenes where imagen = '$imagenABorrar';";
        mysqli_query($conn, $borrarIMG);
        unlink("assets/img/$imagenABorrar");
    }

    if($sw == 1){
        $consultaItemSQL = "SELECT * FROM items where id = $id_item;";
        $resulItemSQL = mysqli_query($conn, $consultaItemSQL);
        $item = mysqli_fetch_assoc($resulItemSQL); 
        
        $consultaPujasSQL = "SELECT count(*) FROM pujas where id_item = $id_item";
        $resulPujasSQL = mysqli_query($conn, $consultaPujasSQL);
        $cantpujas = mysqli_fetch_assoc($resulPujasSQL);
    }

    echo "<h1>" . $item['nombre'] . "</h1>";
    echo "<table>";
        if($cantpujas['count(*)'] == 0)
        {
            echo "<tr>
                <form action='editaritem.php?id=$id_item' method='post'>";
            echo "<td><strong>Precio de salida: </strong>" . $item['preciopartida'] . "€</td>
                    <td><input type='number' name='precio'><input type='submit' name='bajar' value='BAJAR'><input type='submit' name='subir' value='SUBIR'></td>";
            echo "</form>
                </tr>"; 
        }
        echo "<tr>
            <form action='editaritem.php?id=$id_item' method='post'>
                <td><strong>Fecha fin para pujar: </strong>" . $item['fechafin'] . "</td>
                <td><input type='submit' name='hora' value='POSPONER 1 HORA'><input type='submit' name='dia' value='POSPONER 1 DIA'></td>
            </form>
            </tr>";
    echo "</table>";

    $consultaImagenSQL = "SELECT imagen FROM imagenes where id_item = $id_item;";
    $resulImagenSQL = mysqli_query($conn, $consultaImagenSQL);
    $img = mysqli_fetch_assoc($resulImagenSQL);
    echo "<h1>Imagenes actuales</h1>";
    if($img != null){
        echo "<table>";
        foreach($resulImagenSQL as $imagen){
            echo "<tr>";
            echo "<td><img src='assets/img/" . $imagen['imagen'] . "' alt='img' width='100'></td><td><a href='editaritem?img=" . $imagen['imagen'] . "&id=$id_item'>[BORRAR]</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    else{
        echo "<p>No hay imagenes del item</p>";
    }
    echo "<br>";
    echo "<table>";
    ?> <form action='<?php echo "editaritem.php?id=$id_item";?>' method='post' enctype='multipart/form-data'><?php
                echo "<tr>
                    <td>Imagen a subir</td>
                    <td><input type='file' name='examinar'></td>
                </tr>
                <tr>
                    <td colspan=2><input type='submit' name='imgSubir' value='Subir'></td>
                </tr>
            </form>
        </table>";
    require('pie.php');
?>