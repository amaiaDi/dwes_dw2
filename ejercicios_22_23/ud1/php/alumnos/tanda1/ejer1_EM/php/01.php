<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 | Edgar Martínez Palmero</title>
</head>
<body>
    <h1>Ejercicio 1</h1>
    <?php
        // 1.1 Fecha Actual
        echo "Fecha de hoy: ".date("dS F Y, l");
        
        // 1.2 Días para fin de año
        $fecha_hoy = new DateTime(date("Y-m-d"));
        $fecha_fin = new DateTime(date("Y"."-12-31"));
        $diff = $fecha_hoy->diff($fecha_fin);
        echo '<p>Faltan '.$diff->days.' días para fin de año</p>';
        
        // 1.3 Frase a partir de los elemento de un array
        $arr = array('otro', 'El', 'día', 'fui', 'Pamplona', 'a');
        $frase = $arr[1].' '.$arr[0].' '.$arr[2].' '.$arr[3].' '.$arr[5].' '.$arr[4];
        echo '<p>'.$frase.'</p>';

        // 1.4 Reemplazar ñ por gn
        define("FRA", 'La niña aliñaba la cena');
        $FraGn = str_replace('ñ', 'gn', FRA);
        echo '<p>'.$FraGn.'</p>';

        // 1.5 Función que devuelve un array con números aleatorios
        function random($n, $limite1, $limite2) {
            $arr =array();
            for ($i=0; $i < $n; $i++) { 
                $arr[] = rand($limite1, $limite2);
            }
            return $arr;
        }
        // Probrar la función
        $arrRandom = random(5, 0, 10);
        echo '<p>';
        foreach ($arrRandom as &$valor) {
            echo $valor.' ';
        }
        echo '</p>';

        // 1.6 Función que recibe una cadena y la devuelve cifrada.
        function cifrar($texto) {
            define(
                'CLAVES', array(
                    "A" => 21, "E" => 33, "I" => 58, "O" => 78, "U" => 89
            ));
            return strtr($texto, CLAVES);
        }
        // Probrar la función
        echo '<p>';
        echo cifrar('EUFORIA'); 
        echo '</p>';
    ?>
</body>
</html>