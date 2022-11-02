<?php


function peliculasFavoritas($nombre_pelicula){
    $arr_persona_peliculas = array(
        "Paco" => ["Gru","La vida de Brian","No mires arriba"],
        "Ane" => ["Gladiator","Spiderman","Los Vengadores"],
        "Kepa" => ["Star Wars","Gladiator","Gru","Los pájaros","Miedo"],
        "Maite" => ["Gladiator","Star Wars","Gru","La vida es bella"],
        "Lola" => ["Gladiator","Star Trek","La vida es bella"]
    );
    $arr_personas = array_keys($arr_persona_peliculas);
    $numero = 0;
    foreach($arr_personas as $person){
        foreach($arr_persona_peliculas[$person] as $peli){
            if($nombre_pelicula == $peli){
                $numero++;
            }
        }
        
    }
    echo $numero . ' personas tienen como película favorita "' . $nombre_pelicula . '"<br/><br/>';

    foreach($arr_personas as $person){
        $pel1 = rand(0,count($arr_persona_peliculas[$person])-1);
        $pel2 = rand(0,count($arr_persona_peliculas[$person])-1);
        while($pel1 == $pel2){
            $pel2 = rand(0,count($arr_persona_peliculas[$person])-1);
        }
        echo $person . ' - ' . $arr_persona_peliculas[$person][$pel1] . ' y ' .
        $arr_persona_peliculas[$person][$pel2] . '<br/>';
    }
}

peliculasFavoritas('La vida es bella');

?>