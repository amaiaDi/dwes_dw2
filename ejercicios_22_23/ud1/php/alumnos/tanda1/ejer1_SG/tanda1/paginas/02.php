<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>
<body>
    <main>
        <?php
            /*2.	Crea un array con las temperaturas de varios días de un mes y lo muestra 
            Calcula la media (sin utilizar un bucle) y visualízala de 2 maneras: redondeada y truncada
            Visualiza las 5 temperaturas más bajas y las 5 más altas*/
            $temperaturasMes = array(23.4,25.5,35.9,30,20,15.2,16,19,24);
            echo "<p> Las temperaturas del mes:";
            foreach ($temperaturasMes as $temperatura) {
                echo $temperatura . "°C ";
            }
            echo "</p>";
            $sumaTemp = array_sum($temperaturasMes);
            $cantTemp = count($temperaturasMes);
            echo "<p> La Media (redondeada): " .   (round($sumaTemp / $cantTemp)) . "°C </p>";
            echo "<p> La Media (truncada): ". (floor($sumaTemp / $cantTemp)) ."°C </p>";
            sort($temperaturasMes,SORT_NUMERIC);
            $nums;
            echo "<p>Las temperatuas mas bajas del mes: ";
            foreach ($temperaturasMes as $i => $temperatura) {
                if($i <5)
                    echo $temperatura . "°C ";
                if($i == count($temperaturasMes)-5)
                    echo "</p><p>Las temperatuas mas altas del mes: ";
                if($i >= count($temperaturasMes)-5)
                    echo $temperatura . "°C ";
            }
            echo "</p>";
        ?>
    </main>
</body>
</html>