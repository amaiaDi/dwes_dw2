<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>07</title>
</head>
<body>
    <?php
        $handle = fopen("fichero.txt", "r");
        while (!feof($handle)) 
        {
            $linea = fgets($handle);
            $enlace = substr($linea, 0, (strpos($linea,',')));
            $nombre = substr($linea, (strpos($linea,','))+1);
            echo "<a href='$enlace'>$nombre</a><br>";
        }
        fclose($handle);
    ?>

</body>
</html>