<?php
    require('header.php');
    
    echo "<h1>Subastas a punto de vencer</h1>";
    echo "<form action='publi.php' method='post'>
        <table>
        <tr>
            <th>ITEM</th>
            <th>VENCE EN</th>
            <th>ANUNCIANTE</th>
            <th>TIPO</th>
            <th></th>
        </tr>";

    $fechaActual = date('Y-m-d H:i:00', time());
    $fechaActual3dias = strtotime('+3 day', strtotime($fechaActual));
    $fechaActual3dias = date('Y-m-d H:i:00', $fechaActual3dias);

    $consultaPubli = "SELECT * FROM items where fechafin between '$fechaActual' and '$fechaActual3dias'";
    $resulPubli = mysqli_query($conn, $consultaPubli);

    if(!isset($_SESSION['email'])){
        $_SESSION['email'] = [];
    }
    if(!isset($_SESSION['web'])){
        $_SESSION['web'] = [];
    }

    foreach($resulPubli as $publi){
        $id_item = $publi['id'];
        $fechafin = new DateTime($publi['fechafin']);
        $fechaActual = new DateTime(date('Y-m-d H:i:00'));
        $diff = $fechaActual -> diff($fechafin);
        $consultaPujasSQL = "SELECT count(*) FROM pujas where id_item = $id_item";
        $resulPujasSQL = mysqli_query($conn, $consultaPujasSQL);
        $pujas = mysqli_fetch_assoc($resulPujasSQL);

        $consultaPrecioMaxSQL = "SELECT max(cantidad) FROM pujas where id_item = $id_item";
        $resulPrecioMaxSQL = mysqli_query($conn, $consultaPrecioMaxSQL);
        $precioMax = mysqli_fetch_assoc($resulPrecioMaxSQL);

        if($pujas['count(*)'] == 0 || $precioMax['max(cantidad)'] <= $publi['preciopartida'] + $publi['preciopartida'] * 0.10){
            echo "<tr>
            <td>" . $publi['nombre'] . "</td>
            <td>" . intval($diff -> h + (intval($diff ->d * 24))) . " horas</td>
            <td><input type='text' name='anunciante$id_item'></td>
            <td><input type='radio' name='radio' value='Email'>Email <input type='radio' name='radio' value='Web'>Web</td>
            <td><button type='submit' name='añadir' value='$id_item'>Añadir</button></td>
            <tr>";
        }
    }
    echo "</table>
        </form>";

    if(isset($_POST['añadir'])){
        $id_item = $_POST['añadir'];
        if(isset($_POST["anunciante$id_item"])){
            if(isset($_POST['radio']) && $_POST['radio'] == 'Email'){
                array_push($_SESSION['email'], [$_POST["anunciante$id_item"], "http://127.0.0.1/dwes/ud3/ejer%20subastas%20-%20Sergio%20Roman/itemdetalles.php?id=$id_item"]);
            }
            else if(isset($_POST['radio']) && $_POST['radio'] == 'Web'){
                $consultaSQL = "SELECT descripcion FROM items where id = $id_item";
                $resul = mysqli_query($conn, $consultaSQL);
                $descripcion = mysqli_fetch_assoc($resul);
                array_push($_SESSION['web'], [$_POST["anunciante$id_item"], $descripcion['descripcion']]);
            }
        }
    }

    if(count($_SESSION['email']) > 0 || count($_SESSION['web']) > 0){
        echo "<h3><a href='publi.php?enviar'>ENVIAR ANUNCIOS</a></h3>";
    }

    if(isset($_GET['enviar'])){
        if(count($_SESSION['web']) > 0){
            $file = fopen("web.txt", "a+");
            foreach ($_SESSION['web'] as $arrWeb) {
                fwrite($file, $arrWeb[0] . ' ' . $arrWeb[1]);
                fwrite($file, "\n");
            }
            fclose($file);
        }
        if(count($_SESSION['email']) > 0){
            foreach ($_SESSION['email'] as $arrEmail) {
                $enlace = $arrEmail[1];
                $email = $arrEmail[0];
                        $mens = <<< MAIL
                            Hola. Haz clic en el siguiente enlace para ver los detalles del item subastado:
                            $enlace 
                            Gracias
                            MAIL;

                mail($email,"Registro en 127.0.0.1", $mens, "From:sergioromandom@gmail.com");
            }
        }
        $_SESSION['email'] = [];
        $_SESSION['web'] = [];
    }
    require('pie.php');
?>