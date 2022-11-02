<?php
    $temperatura= array(10,25,15,14,20,20,19,3,9,30);
    $suma=array_sum($temperatura);
    $suma=$suma/count($temperatura);
    echo "la media es: ".round($suma);
    echo '<br>';
    echo "la media es: ".floor($suma);
    echo '<br>';
    rsort($temperatura);
    $ascendente=array_slice($temperatura,0,5);
    echo "las 5 temperaturas mas altas son:";
    foreach($ascendente as $asce){
        echo $asce." ";
    }
    echo '<br>';
    
    sort($temperatura);
    $descendente=array_slice($temperatura,0,5);
    echo "las 5 temperaturas mas bajas son:";
    foreach($descendente as $desc){
        echo $desc." ";
    }
?>