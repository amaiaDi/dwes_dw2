<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
 $fondo="white";
    if (isset($_COOKIE['sexo'])){
        if ($_COOKIE['sexo']=='M')
            $fondo="pink";
        else
            $fondo="yellow";
        
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body bgcolor="<?php echo $fondo ?>" />
        pagina suelta
    </body>
</html>
