<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2 | Edgar Martínez Palmero</title>
</head>
<body>
    <h1>Ejercicio 2</h1>
    <?php
        // Crear array '$tempe' y mostrarlo
        $tempe = array(22, 31, 30, 31, 28, 27.6, 26.8, 23.5);
        echo '<p>Temperaturas: ';
        verArray($tempe);
        echo '</p>';
        // Calcular la media
        $suma = array_sum($tempe);
        $long = count($tempe);
        $media = $suma/$long;
        echo '<p>La media de las temperaturas redondeada ha sido de '.round($media).'ºC</p>';
        echo '<p>La media de las temperaturas truncada ha sido de '.round($media, 0).'ºC</p>';
        
        // Visualizar las 5 temperaturas más altas
        rsort($tempe, 5);
        echo '<p>Temperaturas más altas: ';
        verArray(array_slice($tempe, 0, 4));
        echo '</p>';

        // Visualizar las 5 temperaturas más bajas
        sort($tempe, 5);
        echo '<p>Temperaturas más bajas: ';
        verArray(array_slice($tempe, 0, 4));
        echo '</p>';

        // Función para ver array de temperaturas
        function verArray($arr) {
            foreach($arr as $valor) {
                echo $valor.'ºC, ';
            }
        }
    ?>
</body>
</html>