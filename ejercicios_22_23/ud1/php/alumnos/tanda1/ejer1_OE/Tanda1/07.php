<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio7</title>
</head>
<body>
    <?php
        $handle = fopen("url.txt", "r");
        while (!feof($handle)) {
                $linea = fgets($handle);
                $partes = explode(" ", $linea);
                echo ("<a target='_blank' href=$partes[0]>$partes[1]</a><br>");
            }
        fclose($handle);
    ?>
</body>
</html>