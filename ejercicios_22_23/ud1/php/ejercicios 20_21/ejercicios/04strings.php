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
        
                $cad="Hola que tal";
                
                echo "<p>Cadena en MAYUSC </p>";        
                echo "<p> Cadena de " . strlen($cad) . " caracateres</p>";
                echo "<p>" . strtoupper($cad) . "</p>";
                
                
                echo "<p>Cadena diseccionada </p>";
                $partes=explode(" ",$cad);
                foreach ($partes as $pal){
                    echo "<p>$pal</p>";
                }
                
                
                echo "<p>Cadena invertida </p>";
                $cadR= strrev($cad);                
                echo "<p> Original: $cad e invertida: $cadR</p>";

                

        ?>
    </body>
</html>
