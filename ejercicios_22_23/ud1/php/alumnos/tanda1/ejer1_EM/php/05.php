<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5 | Edgar Martínez Palmero</title>
</head>
<body>
    <h1>Ejercicio 5</h1>
    <?php
      function pelis($nomPeli){
        // Declaración de variables
        $contPeliFav = 0;
        $peliculas = array ( 
          "edgar" => array ("Top Gun", "El gran showman", "El Caballero Oscuro", "Endgame"),
          "yrazu" => array ("Top Gun", "Interestellar", "Mision Imposible"),
          "juan" => array ("Bolt", "Toy Story", "Garra"),
          "garrido" => array("El gran showman", "Spider-Man: Un nuevo universo", "Joker"),
          "santi" => array("Joker", "Scott Pilgrim contra el mundo", "Spider-Man: Un nuevo universo")
        );
        // Bucle para recorrer las peliculas y contar la cantidad de personas que tienen como pelicula favoita $nomPeli
        foreach ($peliculas as $persona => $arrPelis) {
          foreach ($arrPelis as $peli) {
            if ($peli == $nomPeli) 
              $contPeliFav++;
          }
        }
        // Mensaje con la cantidad de personas que tienen como pelicula favoita $nomPeli
        echo "<p>Hay {$contPeliFav} persona/s a las que le gusta {$nomPeli}</p>";

        // Bucle para mostrar dos peliculas random de cada persona
        foreach ($peliculas as $persona => $arrPelis) {
          echo ucfirst($persona).": ";
          $randomAnt = -5;
          $random = -5;
          for ($i=0; $i < 2; $i++) { 
            // Validar random para que no se repita la pelicula
            while ($random == $randomAnt) {
              $random = random_int(0, count($arrPelis)-1);
            }
            if ($i == 0)
              echo "{$arrPelis[$random]}, ";
            else
              echo "{$arrPelis[$random]}";
            
            $randomAnt = $random;
          }
          echo "<br>";
        }
      }
      // Llamada a la función pelis
      pelis('Top Gun');
    ?>
</body>
</html>