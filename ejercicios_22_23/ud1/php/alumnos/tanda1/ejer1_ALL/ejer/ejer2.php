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
       //	Crea un array con las temperaturas de varios días de un mes y lo muestra Calcula la media (sin utilizar un bucle) y visualízala de 2 maneras: redondeada y truncada Visualiza las 5 temperaturas más bajas y las 5 más altas     (Dispones de las funciones array_sum, count, sort, rsort, ………)
       $array1 = array("20","21","34","43","24");

        $suma= array_sum($array1);
        $media=$suma/count($array1);
        echo(" la media es (redondeado): ".round($media));
        echo("<br>");
        echo(" la media es (trunkado): ".round($media,2));
        echo("<br>");
        echo("las 5 temperaturas mas bajas son:  ");
        sort($array1);
        for ($i=0; $i < 5 ; $i++) { 
            echo($array1[$i]);echo("  ");
        }
        echo("<br>");
        echo("las 5 temperaturas mas altas son:  ");
        rsort($array1);
        for ($i=0; $i < 5 ; $i++) { 
            echo($array1[$i]);echo("  ");
        }
        echo("<br>");
        
        

    ?>
</body>
</html>