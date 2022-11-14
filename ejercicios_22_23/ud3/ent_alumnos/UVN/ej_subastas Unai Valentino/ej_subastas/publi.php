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

    //Arrays para email y web
    if(!isset($_SESSION['arrEmail']) && !isset($_SESSION['arrWeb'])){
        $_SESSION['arrEmail'] = [];
        $_SESSION['arrWeb'] = [];
    }

    $fechaActual = date("Y-m-d H:i");
    $fechaActual3Dias = new DateTime(date("Y-m-d H:i"));
    $fechaActual3Dias -> modify('+3 day');
    $fecha3 = $fechaActual3Dias -> format("Y-m-d H:i");

    $consultaItem = "SELECT * FROM items WHERE fechafin between '$fechaActual' and '$fecha3';";
    $respuestaItem = mysqli_query($conn, $consultaItem);

    foreach($respuestaItem as $item){
        $itemId = $item['id'];

        //Calculo la diferencia de fechas
        $fechafin = new DateTime($item['fechafin']);
        $fechaActual = new DateTime(date("Y-m-d H:i:00"));
        $diff = $fechaActual -> diff($fechafin);
        //Consultas
        $consultaPujas = "SELECT count(*) FROM pujas where id_item = $itemId;";
        $resultPujas = mysqli_query($conn, $consultaPujas);
        $pujas = mysqli_fetch_assoc($resultPujas);

        $consultaPrecio = "SELECT max(cantidad) FROM pujas where id_item = $itemId;";
        $resultPrecio = mysqli_query($conn, $consultaPrecio);
        $precio = mysqli_fetch_assoc($resultPrecio);

        if($pujas['count(*)'] == 0 || $precio['max(cantidad)'] <= $item['preciopartida'] + ($item['preciopartida'] * 0.10)){
            echo "<tr>
                    <td>".ucfirst($item['nombre'])."</td>
                    <td>". intval($diff -> h + intval($diff -> d * 24))." horas</td>
                    <td><input type='text' name='anunciante$itemId'></td>
                    <td><input type='radio' name='tipo' value='Email'>Email <input type='radio' name='tipo' value='Web'>Web</td>
                    <td><button type='submit' value='$itemId' name='add'>Añadir</button></td>
                </tr>";
        }

    }
    echo "</table></from>";

    //Guardo los anunciantes y el tipo en su array
    if(isset($_POST['add'])){
        $id = $_POST['add'];
        if(isset($_POST["anunciante$id"]) && isset($_POST['tipo'])){
            $consultaItemVen = "SELECT descripcion FROM items WHERE id = $id;";
            $respuestaItemVen = mysqli_query($conn, $consultaItemVen);
            $itemVen = mysqli_fetch_assoc($respuestaItemVen);

            if($_POST['tipo'] == 'Email'){
                $direccion = "http://127.0.0.1/dwes/ud3/ej_subastas/itemdetalles.php?id=$id";
                array_push($_SESSION['arrEmail'], [$_POST["anunciante$id"], $direccion]);
            }
            else{
                array_push($_SESSION['arrWeb'], [$_POST["anunciante$id"], $itemVen['descripcion']]);
            }
            echo "<h3><a href='publi.php?anuncios=true'>ENVIAR ANUNCIOS</a></h3>";
        }
    }

    if(isset($_GET['anuncios'])){
        //Enviar email
        if(count($_SESSION['arrEmail']) > 0){
            
            foreach($_SESSION['arrEmail'] as $arrEmail){
                $email = $arrEmail[0];
                $enlace = $arrEmail[1];
                $msg =<<<MAIL
                    Hola. Haz click en el siguiente enlace para ver los detalles del item a punto de vencer:
                    $enlace
                    Gracias.
                MAIL;
                mail($email, "Detalles del item a punto de vencer", $msg, "From:unaivalentinonieva@gmail.com");
            }
        }
    
        //Escribir web
        if(count($_SESSION['arrWeb']) > 0){
            $fp = fopen("ficheros/webAnunciantes.txt", "a+");

            foreach($_SESSION['arrWeb'] as $web){
                $linea = $web[0]." ".$web[1]."\n";
                fwrite($fp, $linea);
            }
            fclose($fp);
        }
        $_SESSION['arrEmail'] = [];
        $_SESSION['arrWeb'] = [];
    }

    require('pie.php');
?>
