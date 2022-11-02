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
                for ($anio=2020; $anio<2400; $anio++){
                    
                     $strAnio=$anio."/11/11";
                     if (date("L", strtotime($strAnio))==1)
                            echo "<br/>$anio";
                }
        ?>
    </body>
</html>
