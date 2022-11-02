<?php

    function mostrarTabla($array) {
        $numeroColumnas = 0;
        $horaInicio = 0;
        $minInicio = 0;
        $horaFin = 0;
        $minFin = 0;
        $intervalo = 0;
        $color = 0;
        foreach ($array as $key => $valor) {
            if (is_numeric($key)) {
                $numeroColumnas++;
            } else {
                if (is_numeric($valor)) {
                    $intervalo = $valor;
                } else {
                    if (strcmp($key, 'comienzo') === 0) {
                        $tiempos = explode(':', $valor);
                        $horaInicio = intval($tiempos[0]);
                        $minInicio = intval($tiempos[1]);
                    } else {
                        $tiempos = explode(':', $valor);
                        $horaFin = intval($tiempos[0]);
                        $minFin = intval($tiempos[1]);
                    }
                }
            }
        }

        echo '<table style="border: 2px solid black"><tr>';
        for ($i=0; $i <= $numeroColumnas; $i++) { 
            if ($i == 0) {
                echo '<th style="border: 2px solid black"></th>';
            } else {
                echo '<th style="border: 2px solid black">' . $array[$i-1] . '</th>';
            }
        }

        echo '</tr>';

        while ($horaInicio <= $horaFin) {
            if ($horaInicio < $horaFin) {
                if ($minInicio < 10) {
                    if ($color == 1) {
                        echo '<tr style="background: lightgrey"><td style="border: 2px solid black">' . $horaInicio . ':0' . $minInicio . '</td>';
                    } else {
                        echo '<tr><td style="border: 2px solid black">' . $horaInicio . ':' . $minInicio . '0</td>';
                    }
                } else {
                    if ($color == 1) {
                        echo '<tr style="background: lightgrey"><td style="border: 2px solid black">' . $horaInicio . ':' . $minInicio . '</td>';
                    } else {
                        echo '<tr><td style="border: 2px solid black">' . $horaInicio . ':' . $minInicio . '</td>';
                    }
                }

                for ($i=0; $i < $numeroColumnas; $i++) { 
                    echo '<td style="border: 2px solid black"></td>';
                }
                echo '</tr>';
                if ($color == 0) {
                    $color=1;
                } else {
                    $color=0;
                }
            } else if ($horaInicio == $horaFin && $minInicio <= $minFin) {
                

                if ($minInicio < 10) {
                    if ($color == 1) {
                        echo '<tr style="background: lightgrey"><td style="border: 2px solid black">' . $horaInicio . ':0' . $minInicio . '</td>';
                    } else {
                        echo '<tr><td style="border: 2px solid black">' . $horaInicio . ':' . $minInicio . '0</td>';
                    }
                } else {
                    if ($color == 1) {
                        echo '<tr style="background: lightgrey"><td style="border: 2px solid black">' . $horaInicio . ':' . $minInicio . '</td>';
                    } else {
                        echo '<tr><td style="border: 2px solid black">' . $horaInicio . ':' . $minInicio . '</td>';
                    }
                }
                
                for ($i=0; $i < $numeroColumnas; $i++) { 
                    echo '<td style="border: 2px solid black"></td>';
                }
                echo '</tr>';
                if ($color == 0) {
                    $color=1;
                } else {
                    $color=0;
                }
            }

            $minInicio += $intervalo;
            while ($minInicio > 59) {
                $horaInicio++;
                $minInicio -= 60;
            }
        }
        echo '</table>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
</head>
<body>
    <h1>Tabla con horarios</h1>
    <?php
        $array = array('Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab', 'Dom', 'comienzo' => '8:00', 'fin' => '15:00', 'intervalo' => 5); //Entre los 25 y 55 petan
        mostrarTabla($array);
    ?>
</body>
</html>
