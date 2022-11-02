<?php
define("USER_FAV_FILMS", 
[
    "Pepa" => ["Hot Shots", "Kung Fury", "Terminator", "Blade Runner"],
    "Pepe" => ["The Thing", "Jungla de Cristal", "Terminator", "UP"],
    "Pepín" => ["Alien El Octavo Pasajero", "The Thing", "Blood Machines"]
]);

function getFilmCount($input_film)
{
    $contMatchesFound=0;
    foreach(USER_FAV_FILMS as $favFilms)
    {
        foreach($favFilms as $film)
        {
            if(strtoupper($input_film)==strtoupper($film))
                $contMatchesFound++;
        }
    }
    return $contMatchesFound;
}

function getRandFavFilms()
{
    $txtHtml="<h4>DOS PELÍCULAS FAVORITAS DE CADA USUARIO:</h4>";
    foreach(USER_FAV_FILMS as $user => $favFilms)
    {
        $txtHtml.="<p>".$user." - ";
        shuffle($favFilms);
        for($i=0; $i<count($favFilms) && $i<2; $i++)
        {
            if($i==0)
                $txtHtml.=$favFilms[$i];
            else
                $txtHtml.=", ".$favFilms[$i];
        }
        $txtHtml.="</p>";
    }
    echo $txtHtml;
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
    <?php
        echo "<p>".getFilmCount("Rambo")." persona(s) tienen Rambo en su lista de películas favoritas.</p>";
        echo "<p>".getFilmCount("Kung Fury")." persona(s) tienen Kung Fury en su lista de películas favoritas.</p>";
        echo "<p>".getFilmCount("The Thing")." persona(s) tienen The Thing en su lista de películas favoritas.</p>";
        
        getRandFavFilms();
    ?>
</body>
</html>