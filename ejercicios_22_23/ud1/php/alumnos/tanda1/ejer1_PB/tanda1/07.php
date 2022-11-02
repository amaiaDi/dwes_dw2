<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7</title>
</head>
<body>
    <h1>Ejercicio con url's</h1>
    <?php
        $handle = fopen("links.txt", "r");
        while (!feof($handle)) {
            $linea = fgets($handle);
            $datos = explode(';', $linea);
            echo '<p><a href="' . $datos[0] . '">' . $datos[1] . '</a></p>';   
        }
        fclose($handle);
    ?>
</body>
</html>