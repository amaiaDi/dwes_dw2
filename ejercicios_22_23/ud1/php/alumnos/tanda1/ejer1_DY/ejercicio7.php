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
        $handle = fopen("fichero.txt", "r");
        while(!feof($handle)){
            $linea = fgets($handle);
            $palabra = substr($linea, strpos($linea,' '),strlen($linea));
            $URL = substr($linea, 0, strpos($linea,' '));
            echo("<a href='$URL'> $palabra</a> <br>");
        }
        fclose($handle);
     ?>
</body>
</html>