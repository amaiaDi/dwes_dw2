<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>
<body>
    <h1>Muestra de algunas temperaturas del mes de Agosto</h1>

    <p>
        <?php
            $temperaturas = array(20, 21, 22, 23, 24, 25, 26, 25, 11, 34, 5, 30);
            foreach ($temperaturas as $valor) {
                echo $valor . "ºC ";
            }
        ?>
    </p>

    <p>
        <?php
            $suma=array_sum($temperaturas);
            $media=count($temperaturas);
            $media=$suma/$media;
            echo "La media de todas las temperaturas es de " . $media . "ºC, si la redondeamos sería " . round($media) . "ºC y si truncamos sería " . floor($media) . "ºC";
        ?>
    </p>

    <p>
        Las 5 temperaturas más bajas son 
        <?php
            sort($temperaturas);
            $i = 1;
            while ($i <= 5) {
                echo $temperaturas[$i-1] . "ºC ";
                $i++;
            }
        ?>
    </p>

    <p>
        Las 5 temperaturas más altas son 
        <?php
            rsort($temperaturas);
            $i = 1;
            while ($i <= 5) {
                echo $temperaturas[$i-1] . "ºC ";
                $i++;
            }
        ?>
    </p>

</body>
</html>