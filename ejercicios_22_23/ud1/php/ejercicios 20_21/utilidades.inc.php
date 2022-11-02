<?php

    define("PIII",3.14);
    
    $finCoronavirus="2020/11/15";
    
    function bisiesto($anio){
        if ($anio%400==0
            || ($anio%4==0 && $anio%100!=0))
            return true;        
        return false;
    }
    
    function dibujarTitulo($titulo){        
        echo "<h2>".strtoupper($titulo)."</h2>";
        echo "<hr/>";
    }





?>
