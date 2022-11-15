<?php
    require('header.php');
    if(!isset($_SESSION['user']))
    {
        $_SESSION['pagina'] = 'newitem.php';
        header('Location: login.php');
    }
    if(isset($_POST['nuevoItem']))
    {
        $sw = true;
        $dia = $_POST['dia'];
        $mes = $_POST['mes'];
        $anio = $_POST['año'];
        $hora = $_POST['hora'];
        $minutos = $_POST['minutos'];
        $dateActual = strtotime(date('Y-m-d H:i:00', time()));
        $dateEntrada = strtotime(date("$anio-$mes-$dia $hora:$minutos:00"));
        $cat = $_POST['categorias'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['textarea'];
        $precio = $_POST['precio'];
        echo "<h1>Añade nuevo item</h1>";
        if($dateEntrada <= $dateActual)
        {
            $sw = false;
            echo "<p style='font-size:20px; color:red'>La fecha tiene que ser MAYOR que la actual</p>";
        }
        if(!is_numeric($precio))
        {
            $sw = false;
            echo "<p style='font-size:20px; color:red'>El precio tiene que ser un NUMERO</p>";
        }
        if($sw == true)
        {
            $consultaIdSQL = "SELECT max(id) FROM items";
            $resulIdSQL = mysqli_query($conn, $consultaIdSQL);
            $maxId = mysqli_fetch_assoc($resulIdSQL);
            $id = $maxId['max(id)'] + 1;

            $consultaIdCategoriaSQL = "SELECT id FROM categorias where categoria = '$cat'";
            $resulIdCategoriaSQL = mysqli_query($conn, $consultaIdCategoriaSQL);
            $idCategoria = mysqli_fetch_assoc($resulIdCategoriaSQL);
            $idCat = $idCategoria['id'];

            $idUser = $_SESSION['id'];
            $date = date("$anio-$mes-$dia $hora:$minutos:00");
            $insertarItem = "INSERT INTO items values('$id', '$idCat', '$idUser', '$nombre', $precio, '$descripcion', '$date')";
            mysqli_query($conn, $insertarItem);
            header("Location: editaritem.php?id=$id");
        }
    }
    $consultaCategoriasSQL = "SELECT categoria FROM categorias;";
    $resulCategoriasSQL = mysqli_query($conn, $consultaCategoriasSQL);
    echo "<form action='newitem.php' method='post'>
        <table>
            <tr>
                <td>Categoria</td>";
                echo "<td>
                    <select name=categorias>";
                    foreach ($resulCategoriasSQL as $categoria){
                        $cat = $categoria['categoria'];
                        echo "<option value='$cat'>$cat</option>";
                    }
                echo "</td>";
            echo "</tr>
            <tr>
                <td>Nombre</td>
                <td><input type='text' name='nombre' required></td>
            </tr>
            <tr>
                <td>Descripción</td>
                <td><textarea style='resize: none; overflow-y: scroll;'name='textarea' rows='10' cols='40' required></textarea></td>
            </tr>
            <tr>
                <td>Fecha de fin para pujas</td>
                <td>
                    <table>
                        <tr>
                            <td>Dia</td>
                            <td>Mes</td>
                            <td>Año</td>
                            <td>Hora</td>
                            <td>Minutos</td>
                        </tr>
                        <tr>";
                        echo "<td>
                        <select name=dia>";
                        for($c = 1; $c < 32; $c++){
                            echo "<option value='$c'>$c</option>";
                        }
                    echo "</td>";
                    echo "<td>
                        <select name=mes>";
                        for($c = 1; $c < 13; $c++){
                            echo "<option value='$c'>$c</option>";
                        }
                    echo "</td>";
                    echo "<td>
                        <select name=año>";
                        for($c = date('Y'); $c < date('Y')+6; $c++){
                            echo "<option value='$c'>$c</option>";
                        }
                    echo "</td>";
                    echo "<td>
                        <select name=hora>";
                        for($c = 0; $c < 24; $c++){
                            echo "<option value='$c'>$c</option>";
                        }
                    echo "</td>";
                    echo "<td>
                        <select name=minutos>";
                        for($c = 0; $c < 60; $c++){
                            echo "<option value='$c'>$c</option>";
                        }
                    echo "</td>";
                    echo "</tr>
                    </table>
                </td>";
            echo "</tr>
            <tr>
                <td>Precio</td>
                <td><input type='text' name='precio' required>€</td>
            </tr>
            <tr>
                <td colspan=2><input style='width: 50em' type='submit' name='nuevoItem' value='Enviar!'></td>
            </tr>
        </table>
    </form>";
    require('pie.php');
?>