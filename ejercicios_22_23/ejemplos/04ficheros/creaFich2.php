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
        
            function creaFichAlimentos($ruta,$alimentos){
                
                $f=fopen($ruta,"w");
                if (!$f)
                    return false;
                else{
                    foreach ($alimentos as $nombre =>$cal){
                       $linea=$nombre . "\t" . $cal . "\t" . "4.5\r\n";
                       fputs($f,$linea);
                    }
                    fclose($f);
                    return true;
                }
            }
        
            $alimentos=["Patatas"=>50,"Lentejas"=>30,"Leche"=>60];
            if (creaFichAlimentos("ficheros/restaurante.txt", $alimentos))
                    echo "<p>Fichero creado </p>";
            else
                    echo "<p>No se pudo crear fichero </p>";
            
        
        
        
        
        ?>
    </body>
</html>
