<?php

    function mostrarPeliculas($nombrePelicula) {
        $array = array('Pepe' => array('El padrino', 'El mago de oz'),
                    'Rosa' => array('Ciudadano Kane', 'Cadena perpetua'),
                    'Juan' => array('Pulp Fiction', 'Casablanca', 'El padrino 2'),
                    'Adrián' => array('E.T., el extraterrestre', 'El padrino'),
                    'Jose' => array('El mago de oz', 'Ciudadano Kane', 'Cadena perpetua'),
                    'Sonia' => array('Pulp Fiction', 'E.T., el extraterrestre'));

        $cont_personas = 0;

        foreach ($array as $peliculas) {
            if (in_array($nombrePelicula, $peliculas)) {
                $cont_personas++;
            }
        }

        echo '<br><h2>Películas favoritas de la gente</h2>';

        foreach ($array as $persona => $peliculas) {
            if (count($peliculas)>2) {
                $azar = array_rand(($peliculas), 2);
                echo '<p>Las películas favoritas de ' . $persona . ' son: ' . $peliculas[$azar[0]] . ' y ' . $peliculas[$azar[1]];
            } else {
                echo '<p>Las películas favoritas de ' . $persona . ' son: ';
                foreach ($peliculas as $pelicula) {
                    echo $pelicula . '; ';
                }
                echo '</p>';
            }
        }

        return $cont_personas;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5</title>
</head>
<body>
    <h1>Ejercicio de películas</h1>
    <?php
        echo '<p>Hay ' . mostrarPeliculas('El padrino') . ' personas que tienen a "El padrino" como película favorita</p>';
    ?>
</body>
</html>