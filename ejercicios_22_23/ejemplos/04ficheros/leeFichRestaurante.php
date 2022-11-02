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
        
            $f=fopen("ficheros/restaurante.txt","r+");
            if (!$f){
                echo "<p>No existe restaurante</p>";
                exit();
            }
            
            $suma=0;
            $cont=0;
            //Formato: %s cadena, %d entero, %f float .....
            $partes=fscanf($f,"%s\t%d\t%f");
            while (!feof($f)){                
                list($nombre,$cal,$precio)=$partes;
                $suma+=$precio;
                $cont++;
                echo "<p>";
                echo $nombre . " " . $cal . " " . $precio;                
                echo "</p>";                
                $partes=fscanf($f,"%s\t%d\t%f");
            }
            $precioMedio=$suma/$cont;
            
            //fputs($f,"PRECIO MEDIO:".$precioMedio."\r\n");            
            fclose($f);
            
        
        
        ?>
    </body>
</html>
