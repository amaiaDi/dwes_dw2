<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php
        /*$handle = fopen("fichero.txt", "r");
        while (!feof($handle)) {
            $linea = fgets($handle);
            echo "<a href='$linea'>$linea</a><br>";
        }
        fclose($handle);*/

        $handle = fopen("fichero.txt", "r");
        while (!feof($handle)) {
            $linea = fgets($handle);
            $direccion=strstr($linea, " ",true);
            $nombre = strstr($linea, " ");
            echo "<a href='$direccion'>$nombre</a><br>";
        }
        fclose($handle);
    ?>
</body>
</html>