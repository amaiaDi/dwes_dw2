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
        
            //Llega por GET
            //nombre---->$_GET['nombre']
            //y
            //edad ---->$_GET['edad']
        
            if (isset($_GET['nombre'])  && isset($_GET['edad'])){
                
                echo "<p>Tu nombre es " . $_GET['nombre'];
                echo " y tu edad ". $_GET['edad'] . "</p>";
                
            }
            else   {
                //echo "<p>Debes incluir parametros GET</p>";                
   $enlaceSelf=$_SERVER['PHP_SELF'] . "?nombre=desconocido&edad=0";
                echo "<p><a href='$enlaceSelf'>Pincha aquí</a></p>";
                
            }
        
        ?>
    </body>
</html>
