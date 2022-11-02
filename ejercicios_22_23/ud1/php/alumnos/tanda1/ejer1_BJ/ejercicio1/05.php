<?php
function cine($nombre){
    $persona1=array("Jose","Spider man", "Iron man","Thor","Hulk","FaF","Cars");
    $persona2=array("Juan","Ant man", "Super man","Iron man","Cars 2","Iron man 2","Electro");
    $peliculas=array($persona1,$persona2);
    $cont=0;
    foreach($peliculas as $persona){
        foreach($persona as $pel){
            if($pel===$nombre){
                $cont++;
            }
        }
        $uno=rand(1,count($persona)-1);
        $dos=rand(1,count($persona)-1);
        echo $persona[0]." = ". $persona[$uno]." y ". $persona[$dos];
        echo '<br>';   
    }
    return $cont;

}

$resultado=cine("Iron man");
echo $resultado." personas tienen la pelicula Iron man como favorita";
?>