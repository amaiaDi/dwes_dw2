<?php

    $ciudades = array("Vitoria", "Bilbao", "Donosti", "Miranda", "Vitoria", "Eibar", "Donosti", "Zaragoza", "Sevilla", "Barcelona");
    $no_repetidos = array_unique($ciudades);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
</head>
<body>
    <h1>Listado de ciudades</h1>
    <ol>
        <?php
            foreach ($no_repetidos as $ciudad) {
                echo "<li>" . $ciudad . "</li>";
            }
        ?>
    </ol>
</body>
</html>