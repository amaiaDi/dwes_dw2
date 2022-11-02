<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        
            //date:formatea fecha
            //time: timestamp actual
            //strtotime: convierte String a timestamp
        
            echo "<p>Hoy es " . date("d/m/Y");
            echo "<p>Hoy es " . date("d/m/Y", time());
        
            //Dias transcurridos sin venir a clase: 9 Mar 2020
                        
            $strComienzo="2020/03/09";
            $tComienzo=strtotime($strComienzo);
            $tActual=time();
            
            $difDias=(int)(($tActual - $tComienzo)/(60*60*24));
            
            echo "<p>Dias en casa desde 09/03/2020: $difDias";
            
            //Qué hora era hace 10 minutos
            
           // date_default_timezone_set("Europe/Madrid");
            $tActual=time();
            $tHace10Min=$tActual-(10*60);
            echo "<p>Hace 10 minutos eran las " .date("H:i", $tHace10Min);
            
            
            //Minutos que faltan para ir a casa
            
            $strSalida="14:30";            
            $tSalida=strtotime($strSalida);
            $tActual=time();            
            $minutosDif=(int)(($tSalida - $tActual)/60);
            echo "<p>Faltan $minutosDif minutos para salir";
            
            ?>
    </body>
</html>
