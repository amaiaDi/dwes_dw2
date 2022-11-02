<?php

    function rutas_imag($ruta) {
        $files = glob($ruta ."*" );
        $n = $_POST['cantidad'];
        $files2 = array_rand($files, $n);
        for ($i=0; $i < count($files2); $i++) { 
            $files2[$i] = 'imagenes/' . (intval($files2[$i])+1) . '.jpg';
        }

        return $files2;
    }

    if (isset($_POST['enviar'])) {
        if (!empty($_POST['casillas'])) {
            dibujarSeleccionadas();
            $ip_add = $_SERVER['REMOTE_ADDR'];
            $array_imagenes = $_POST['casillas'];
            
            $file = fopen("usuario_imagenes.txt", "a");
            fwrite($file, $ip_add . ': ');
            foreach ($array_imagenes as $imagen) {
                fwrite($file, $imagen . '\t');
            }
            fwrite($file, PHP_EOL);
            fclose($file);
        } else {
            dibujarNoSeleccionadas();
        }  
    }

    if (isset($_POST['ver'])) {

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluar imágenes</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

        <table style="border: 2px solid black; padding: 10px;">
            <?php
                $array = rutas_imag('imagenes/');
                for ($i=0; $i < count($array); $i++) {
                    echo '<tr><td><img src="' . $array[$i] . '" alt="' . $array[$i] . '" width=250 height=100 /></td><td><input type="checkbox" name="casillas[]" value="' . $array[$i] . '" />Me gusta</td></tr>';
                }
            ?>
        </table>
        
        <button type="submit" name="enviar" style="margin-top: 10px;">ENVIAR VALORACIONES</button>

    </form>
</body>
</html>

<?php
    }

    function dibujarSeleccionadas() {
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Evaluar imágenes</title>
        </head>
        <body>
            <p>Gracias por tu envío</p>
            <a href="selec_cantidad.php">Haz click aquí para volver al Inicio</a>
        </body>
        </html>';
    }

    function dibujarNoSeleccionadas() {
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Evaluar imágenes</title>
        </head>
        <body>
            <p>Sentimos que no le haya gustado ninguna</p>
            <a href="selec_cantidad.php">Haz click aquí para volver al Inicio</a>
        </body>
        </html>';
    }

?>