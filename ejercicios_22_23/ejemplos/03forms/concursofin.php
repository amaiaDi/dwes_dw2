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
            if ((!isset($_GET['aciertos']))||(!isset($_GET['total']))  )
            {
                header("location:concurso.php");
            }
            else{
                $aciertos=$_GET['aciertos'];
                $total=$_GET['total'];
                if ($aciertos/$total > 0.5)
                    echo "<p>Muy bien lo has hecho </p>";
                else
                    echo "<p>Te convendría repetir el test </p>";
           }
        
        ?>
    </body>
</html>
