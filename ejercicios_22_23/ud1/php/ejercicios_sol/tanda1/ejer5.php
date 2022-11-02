<!-- 5.	Crear una Función
o	Recibe un nombre de película y devuelve cuántas personas la tienen entre sus favoritas
o	Muestra, por cada persona, 2 de sus películas favoritas al azar -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EJERCICIO 5</title>

    <?php
        include 'funciones.php';
    ?>
</head>
<body>
    <?php

        // Define un array de arrays, representando cada posición/fila una correspondencia de nombre de persona con sus películas preferidas
        $peliculasPersonas=array("mikel"=>array("Pinocho", "El rey Leon", "La sirenita", "Alicia en el pais de las maravillas"),
        "ander"=>array("Avatar", "La guerra de las galaxias", "Los juegos del hambre", "El señor de los anillos"),
        "gorka"=>array("Fast and furious", "Spiderman", "Superman", "Ironman"));

        fncNombrePeliculaPorPersona($peliculasPersonas);
        fncMostrarPeliculasFavoritasPersona();
        
    ?>
</body>
</html>