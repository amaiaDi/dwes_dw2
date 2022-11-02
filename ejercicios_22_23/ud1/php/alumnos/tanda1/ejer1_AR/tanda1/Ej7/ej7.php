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
        $handle = fopen("../utils/urls.txt", "r");
        while (!feof($handle)) {
            $linea = fgets($handle);

            $contenido = explode(';',$linea);

            echo "<a href='".$contenido[0]."'>".$contenido[1]."</a><br>";

         }
        fclose($handle);
    ?>

</body>
</html>