<?php

    //1.1 14th September 22, Wednesday
    date_default_timezone_set("Europe/Madrid");
    echo date("jS F y, l");
    echo '<br>';
?>
<?php
    //1.2 fecha
    $fecha1= new DateTime(date("Y-m-d"));
    $fecha2= new DateTime("2022-12-31");
    $diff = $fecha1->diff($fecha2);
    echo $diff->days . ' dias';
    echo '<br>';
?>
<?php
    //1.3 Array de palabras
    $array = [ 1 => "hola",2 => "que", 3=> "tal", 4=>"estas"];
    foreach($array as $ar) {
        echo $ar ." ";
    }
    echo '<br>';
?>
<?php
    //1.4 eñes
    $cadena = "Mi abuela era italiana y amasaba los mejores ñoquis y Ñoquis";
    $cadena = str_replace("Ñ", "gn", $cadena);
    $resultado = str_replace("ñ", "gn", $cadena);
    echo $resultado;
    echo '<br>';
?>
<?php
    //1.5 array con n numeros
    function numeros($n, $limite1, $limite2){
        $array1=array();
        for($i=0;$i<$n;$i++){
           $array1[$i]=rand($limite1, $limite2);
        }
       return $array1;
    }

    $arr=numeros(5, 0, 10);
    foreach($arr as $a){
        echo $a." ";
    }
    echo '<br>';
?>
<?php
    function cifrar($frase){
        $arr = array("A"=>"20", "H"=>"9R", "M"=>"abcd"); 
        
        return strtr($frase,$arr);
    }

    $resultado=cifrar("HOLA AMO");
    echo $resultado;
?>