<?php
    $array=array("Madrid","Paris","Londres","Madrid","Amsterdam","Roma","Venecia","Paris","Oslo","Londres");
    $sinrep=array_unique($array);
    echo "Las ciudades introducidas son:".'<br>'; 

    foreach($sinrep as $sin){
        echo $sin." ";
    }
?>