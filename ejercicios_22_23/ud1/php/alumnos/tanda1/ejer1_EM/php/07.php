<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/06.css">
    <title>Ejercicio 7 | Edgar Martínez Palmero</title>
</head>
<body>
    <h1>Ejercicio 7</h1>
    <?php
      $handle = fopen("../txt/webs.txt", "r");
      while (!feof($handle)) {
        $linea = fgets($handle);
        $partes = preg_split('/\s+/', $linea);
        echo "<a href='{$partes[0]}' target='_blank'>{$partes[1]}</a><br>";
      }
      fclose($handle);
    ?>
</body>
</html>