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
        
            function creaArrayCalorias ($ruta){                
                $f=fopen($ruta,"r");
                if ($f==false)
                    return false;
                else{
                    $alims=[];
                    $linea=fgets($f);
                    while (!feof($f)){
                        
                       $linea=trim($linea); 
                       $partes=explode("\t",$linea);
                       $alimento=$partes[0];
                       $calorias=$partes[1];                       
                       $alims[$alimento]=$calorias;                        
                       $linea=fgets($f);
                    }
                    fclose($f);
                    return $alims;
                }
            }
        
            $alimentos=creaArrayCalorias("ficheros/alimentos.txt");
            if (!$alimentos)
                 echo "<p>No se ha podido crear array a parti...</p>";
            else{
                foreach ($alimentos as $nombre =>$cal){
                    echo "<p>$nombre,$cal calorias</p>";
                }
            }
        
        
        
        
        ?>
    </body>
</html>
