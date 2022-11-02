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
        
        
        function creaFiltrado($rutaOrigen,$rutaDestino)
        {
            //Copia un fichero a otro, haciendo algunas sustituciones
            
            $sust=array("a"=>"AAA", "ñ"=>"gn","<h2>"=>"<h3>","</h2>"=>"</h3>");
            
            
            $fOrigen=fopen($rutaOrigen,"r");
            if (!$fOrigen)
                return false;
            
            //Leer fichero de 1 vez
            $strOrigen=fread($fOrigen, filesize($rutaOrigen));
            
            //Realizar las sustituciones en str....
            foreach ($sust as $antes=>$despues){  
                $strOrigen=str_replace($antes,$despues,$strOrigen);
            }
            
            //Crear fichero destino
            $fDestino=fopen($rutaDestino,"w");
            fputs($fDestino,$strOrigen);
            fclose($fDestino);
            return true;
            
            
        }
           
        
        
        
        if (!creaFiltrado("ficheros/origen.txt", "ficheros/destino.txt"))
                echo "<p>No existe origen</p>";
        else {
                echo "<p>Fichero filtrado en destino.txt</p>";
        }
        ?>
    </body>
</html>
