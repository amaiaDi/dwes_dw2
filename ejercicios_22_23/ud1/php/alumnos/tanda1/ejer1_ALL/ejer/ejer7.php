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
        $handle = fopen("prueba.txt", "r");
        while (!feof($handle)) {
            $linea = fgets($handle);
            $nombre=explode(" ",$linea);
            echo("<a href=$nombre[0] target='_blank'>$nombre[1]</a>");
            echo("<br>");
        }
        fclose($handle);

       
    ?>

</body>
</html>
