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
       
       /*     
       define("CONSTANTE",array(3,4,4,5));
           print_r(CONSTANTE);
           exit();
       */
        
        
        $arr=[5,6,7,7,2,3,5];
        var_dump($arr);
        $arr2=array_unique($arr);
        var_dump($arr2);        
        
        $arr3=array_filter($arr2);
        var_dump($arr3);
        exit();
        
        echo "<br/>";
        
        $cad="abxatbtt";
        print_r($cad);
        print_r($cad);
        var_dump($cad);
        var_dump($cad);
        
        
        exit();
        
        
            $claves=array_keys($REEMPL);
            $valores= array_values($REEMPL);
            
            $cad2=str_replace($claves, $valores, $cad);
            echo "<br/>";
            print_r($cad2);
            exit();
        
        
            $ejercs=array(
                "Sintaxis" =>"01pruebaSintaxis.php",
                "Arrays" =>"02arrays.php",
                "Fechas" =>"03fechas.php",
                "Strings" =>"04strings.php",
                "Usar include" =>"05utilidadesUser.php",
                "GET" =>"06pruebaGET.php"
            );
                
                
            echo "<ul>";    
            foreach ($ejercs as $nombre=>$nombreScript){
                echo "<li>";
                echo "<a href='ejercicios/$nombreScript'>$nombre</a>";
                echo "</li>";
            }    
            echo "</ul>";
        ?>
    </body>
</html>
