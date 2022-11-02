<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<body>
    <p>Fecha actual:
    <?php
    
        $fecha = getdate();
        echo $fecha["mday"] . "th " . $fecha["month"] . " " . $fecha["year"] . ", " . $fecha["weekday"] . "</p>";

        $numDia = intval($fecha["yday"]);
        $numDia = 365 - $numDia;
        echo "<p>Quedan " . $numDia . " días para que termine el año</p>";

        $palabras = ["Esto", "es", "una", "frase", "en", "un", "array"];
        echo "<p>";
        foreach ($palabras as $palabra) {
            echo $palabra . " ";
        }
        echo "</p>";

        $cadena = "ñañeñiñoñu";
        echo "Si cambiamos la Ñ por GN la palabra " . $cadena . " sería ";
        $cadena = str_replace("ñ", "gn", $cadena);
        echo $cadena . "</p>";

        function numsAleatorios($n, $limite1, $limite2) {
            $cont = 1;
            $aleatorio=0;
            $arrayAleatorios = array();
            while ($cont <= $n) {
                $aleatorio = rand($limite1, $limite2);
                array_push($arrayAleatorios, $aleatorio);
                $cont++;
            }
            return $arrayAleatorios;
        }
        $array = numsAleatorios(5, 10, 100);
        echo "<p>Los valores del array de números aleatorios son: ";
        foreach ($array as $valor) {
            echo $valor . " ";
        }
        echo "</p>";

        function cadenaCifrada($palabra) {
            $palabra = str_replace('A', 'V', $palabra);
            $palabra = str_replace('E', '3', $palabra);
            $palabra = str_replace('I', '1', $palabra);
            $palabra = str_replace('O', '0', $palabra);
            $palabra = str_replace('U', '¡', $palabra);
            $palabraCifrada = $palabra;
            return $palabraCifrada;
        }
        $palabra = "MURCIELAGO";
        echo "<p>La palabra " . $palabra . " se encuentra cifrada como " . cadenaCifrada($palabra) . "</p>";
    ?>
</body>
</html>