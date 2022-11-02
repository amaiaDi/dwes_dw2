<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio2</title>
</head>
<body>
    <?php
        //Crea un array con las temperaturas de varios días de un mes y lo muestra 
        //Calcula la media (sin utilizar un bucle) y visualízala de 2 maneras: redondeada y truncada
        //Visualiza las 5 temperaturas más bajas y las 5 más altas
        //(Dispones de las funciones array_sum, count, sort, rsort, ………)

        $temperaturas = [15,17,22,16,16,18,19,18,18,19,20,21,14];
        echo nl2br(round(array_sum($temperaturas)/count($temperaturas),2) ."\n");
        echo nl2br(floor(array_sum($temperaturas)/count($temperaturas)) ."\n");
        rsort($temperaturas);
        echo nl2br("Temperaturas ordenadas de mayor a menos" ."\n");
        echo $temperaturas[0] ."\t" .$temperaturas[1] ."\t" .$temperaturas[2] ."\t" .$temperaturas[3] ."\t" .$temperaturas[4] .":";
        sort($temperaturas);
        echo nl2br("\n"."Temperaturas ordenas de menor a mayor"."\n");
        echo $temperaturas[0] ."\t" .$temperaturas[1] ."\t" .$temperaturas[2] ."\t" .$temperaturas[3] ."\t" .$temperaturas[4];
    ?>

</body>
</html>