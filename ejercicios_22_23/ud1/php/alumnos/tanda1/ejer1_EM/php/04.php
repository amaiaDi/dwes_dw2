<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4 | Edgar Martínez Palmero</title>
</head>
<body>
    <h1>Ejercicio 4</h1>
    <?php
        // Array con las imagenes
        $imagenes = array(
            '../img/naughtyDog.jpg',
            '../img/tlou.jpg',
            '../img/joel.jpg',
            '../img/ellie.jpg',
            '../img/dina.jpg',
            '../img/uncharted.jpg',
            '../img/nathan.jpg',
            '../img/sully.jpg'
        );
        // Llamada a la función
        imgATabla($imagenes);
        
        // Funcion que pasa un array de imágenes a una tabla con x filas y 3 columnas
        function imgATabla($arr) {
            echo '<table>';
                $cont = 0;
                foreach($arr as $valor) {
                    if ($cont%3 == 0) {
                        echo '</tr>';
                        echo '<tr>';
                    }
                    echo '<td>';
                    echo '<a href="'.$valor.'" target="_blank"><img src="'.$valor.'"width=310 height=250></a>';
                    echo '</td>';
                    $cont++;
                }
            if ($cont%3 == 0) {
                echo '</tr>';
            }
            echo '</table>';
        }
    ?>
</body>
</html>