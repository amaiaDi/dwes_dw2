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
        
    <u>VISTA 2</u>
    <p>Datos pasados desde el controlador:</p>
       
 <?php
 
    echo "<p>LIBROS DE $autor</p>";
       
    for ($i=0; $i<count($libros); $i++){
        echo "<p>$libros[$i]</p>";
    }
       
 ?>
    </body>
</html>
