<?php 
//Definir matriz y Crear función
function cuantosTienenEstaPeli ($nombrePeli){
    $arrayPersonas = array(
        "Dani" => array ("La undécima", "Tiburón", "Bob Esponja", "Una canción para mi madre"),
        "Llarena" => array ("Cuando quedé segundo en los cars", "Bob Esponja", "Tiburón", "Los pinguinos de madagascar"),
        "Txipi" => array ("Tiburón", "La Txipineta y el Modelo E-R", "Las tuplas de la verdad", "Apuñálame III", "Como suspender a tus alumnos X")
    );



    $suma=0;
    //Para usar este for, cambiar los nombres por indices
    // for($i=0;$i<sizeof($arrayPersonas);$i++){
    //     for($j=0;$j<sizeof($arrayPersonas[$i]);$j++){
    //         if($arrayPersonas[$i][$j]==$nombrePeli){
    //             $suma++;
    //         }
    //     }
    // }

    //Contar misma peli
    foreach($arrayPersonas as $nombre){
        foreach($nombre as $peli){
                if($peli==$nombrePeli){
                    $suma++;
                }
        }
    }

    //Mostrar 2 pelis aleatorias por persona
    foreach($arrayPersonas as $nombre=> $valor){
        $p = array_rand($valor,2);
        echo $nombre.", peli 1: ". $valor[$p[0]]."<br>";
        echo $nombre.", peli 2: ". $valor[$p[1]]."<br>";
    }


return $suma;
}
?>

<?php 
//Buscar peli
$peli="La undécima";
echo "La pelicula ".$peli." la tienen ".cuantosTienenEstaPeli($peli)." personas";
?>