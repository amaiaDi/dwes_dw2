<?php

    define('DIRIMG', 'imagenes/');

    

    function cuantasImag($ruta) {
        $files = glob($ruta ."*" );
        $filecount = 0;
        if( $files ) {
            $filecount = count($files);
        }
        return $filecount;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar cantidad</title>
</head>
<body>
    <form action="eval_imag.php" method="post">
        <p>
            <label for="seleccionar">¿Cuántas imágenes deseas ver?</label>
            <select name="cantidad" id="cantidad">
                <?php
                    for ($i=2; $i <= cuantasImag(DIRIMG); $i++) { 
                        echo '<option name="cantidad" value="' . $i . '">' . $i . '</option>';
                    }
                ?>
            </select>
        </p>
        <button type="submit" name="ver">VER IMÁGENES</button>
    </form>
</body>
</html>