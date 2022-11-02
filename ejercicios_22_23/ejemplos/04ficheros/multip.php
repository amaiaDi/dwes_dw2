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
        
        $factores=[2,5,6,8,9,10,13];
        $num=8;
        $factorR="";
        
        if (isset($_POST['submit'])){
            $rtdoR=$_POST['rtdo'];
            $factorR=$_POST['factor'];
            if ($rtdoR==($factorR * $num)){
                $feedback="OK";
            }
            else{
                $feedback="Mal. Resultado=". ($factorR * $num);
            }
        }
        
        
        
        
        
        echo "<table>";
        foreach ($factores as $factor){
            
            $valor='';
            if ($factorR==$factor)
                $valor=$rtdoR;
            
            echo "<tr>";
            echo "<form action='".$_SERVER['PHP_SELF']."' method='POST'>";
                echo "<td>$num x $factor</td>";
                echo "<td><input type='text' name='rtdo' value='$valor'/></td>";
                echo "<td><input type='submit' name='submit' value='Corregir' /></td>";
                echo "<input type='hidden' name='factor' value='$factor' />";
                if ($factorR==$factor)
                    echo "<td>$feedback</td>";
            echo "</form>";
            echo "</tr>";
        }
        echo "</table>";
        
        
        
        
        ?>
    </body>
</html>
