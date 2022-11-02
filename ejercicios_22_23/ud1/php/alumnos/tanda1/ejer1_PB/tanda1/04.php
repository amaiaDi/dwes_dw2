<?php

    function tablaImagenes($arrayRutas) {
        $array = array_unique($arrayRutas);
        $longitud = count($array);
        $filas = round($longitud / 3);
        $sobras = $longitud % 3;
        $j = 0;
        
        for ($i=0; $i < $filas; $i++) { 
            echo '<tr>';
            $a = 1;
            while ($a <= 3) {
                echo '<td style="border: 2px solid black; padding: 10px"><a href="' . $array[$j] . '"><img src="' . $array[$j] . '" width=300 height=300></a></td>';
                $a++;
                $j++;
            }
            echo '</tr>';
        }
        
        
        if ($sobras > 0) {
            for ($i=0; $i < $sobras; $i++) { 
                echo '<tr>';
            $a = 1;
            if ($sobras > 3) {
                while ($a <= 3) {
                    echo '<td style="border: 2px solid black; padding: 10px"><a href="' . $array[$j] . '"><img src="' . $array[$j] . '" width=300 height=300></a></td>';
                    $a++;
                    $j++;
                }
            } else {
                while ($a <= $sobras) {
                    echo '<td style="border: 2px solid black; padding: 10px"><a href="' . $array[$j] . '"><img src="' . $array[$j] . '" width=300 height=300></a></td>';
                    $a++;
                    $j++;
                }
            }
            echo '</tr>';
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
</head>
<body>
    <table style="margin: auto; border: 2px solid black; border-collapse: collapse">
        <caption style="font-size: 20px; border: 2px solid black"><strong>Tabla con imágenes</strong></caption>
        <?php
            $array = array('imagenes/1.jfif', 'imagenes/2.jpg', 'imagenes/3.webp', 'imagenes/4.jfif', 'imagenes/5.jpg', 'imagenes/6.jpg', 'imagenes/7.jfif', 'imagenes/3.webp');
            tablaImagenes($array);
        ?>
    </table>
</body>
</html>