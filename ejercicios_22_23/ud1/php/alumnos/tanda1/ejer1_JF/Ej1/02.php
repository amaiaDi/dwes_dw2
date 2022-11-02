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

    // Crea un array con las temperaturas de varios días de un mes y lo muestra 
    // Calcula la media (sin utilizar un bucle) y visualízala de 2 maneras: redondeada y truncada
    // Visualiza las 5 temperaturas más bajas y las 5 más altas
    
    $temp=[8,14,24,35,5,7,14,21,22,42,17,28,33];
    echo nl2br(round(array_sum($temp)/count($temp),2)."\n");
    echo nl2br(floor(array_sum($temp)/count($temp))."\n");
    rsort($temp);
    echo nl2br("Temperatura de mayor a menor" . "\n");
    echo ($temp[0] ."\t".$temp[1] ."\t".$temp[2] ."\t".$temp[3] ."\t".$temp[4] ."\t");
    echo ('<br>');
    sort($temp);
    echo nl2br("Temperatura de menor a mayor" . "\n");
    echo ($temp[0] ."\t".$temp[1] ."\t".$temp[2] ."\t".$temp[3] ."\t".$temp[4] ."\t");
    ?>
    
</body>
</html>