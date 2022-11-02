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
    $arrTemperaturas = array(17,24,23,27,35,7,14);
    /*Array original recorrido*/
    foreach ($arrTemperaturas as $clave) {
        print $clave." ";
    }
    echo("<br>");
    /*operaciones*/
    $suma = array_sum($arrTemperaturas);
    $media = $suma/count($arrTemperaturas);
    echo("La media redoneada es ".round($media));
    echo("<br>");
    echo("La media truncada es ".round($media,2));
    echo("<br>");
    /**Ordenar ascendentemente */
    sort($arrTemperaturas);
    for ($i=0; $i < 5; $i++) { 
        echo($arrTemperaturas[$i]." ");
    }
    echo("<br>");
    /**Ordenar descendentemente */
    rsort($arrTemperaturas);
    for ($i=0; $i < 5; $i++) { 
        echo($arrTemperaturas[$i]." ");
    }

     ?>
</body>
</html>