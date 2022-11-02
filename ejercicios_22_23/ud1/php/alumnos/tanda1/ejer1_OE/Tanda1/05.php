<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio5</title>
</head>
<body>
    <?php
        /*Función que:
            - Define un array de arrays, representando cada posición/fila una correspondencia de nombre de persona con sus películas preferidas
            - Recibe un nombre de película y devuelve cuántas personas la tienen entre sus favoritas
            - Muestra, por cada persona, 2 de sus películas favoritas al azar
        */
        
        function tieneEntreFav($pelicula){
            $personas = ["Pedro" => ["Peli1", "Peli2", "Peli4"], "Juan"=> ["Peli5", "Peli6", "Peli2"], "Lucas"=> ["Peli3", "Peli1", "Peli6"], "Tego"=> ["Peli4", "Peli2", "Peli9"]];
            $count = 0;
            foreach ($personas as $peliculas) {
                 if (in_array($pelicula, $peliculas))
                    $count++;
            }
            return $count;
        }
        echo tieneEntreFav("Peli2");
    ?>
</body>
</html>