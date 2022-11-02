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
       
        <?php
        
            $pregs=array(
                array("2+2","4"),
                array("Año actual","2020"),
                array("Rio que pasa por Gasteiz","Zadorra"),
                array("Raiz cuadrada de 25",5)
            );
        
        
        ?>
    </head>
    <body>
        <?php
            $iPregunta=0;   
            $aciertos=0;
            $strRespCorrecta="";
            
            if (isset($_POST['submit'])){
                
                //Comprobar respuesta, pasar de pregunta.....
                $iPregunta=$_POST['iPregunta'];
                $aciertos=$_POST['aciertos'];
                if ($_POST['resp']==$pregs[$iPregunta][1]){
                    $acertado=true;     
                    $aciertos++;
                }
                else{
                    $acertado=false;
                    $strRespCorrecta=$pregs[$iPregunta][1];
                }                
                $iPregunta++;               
                
                
                
                //Retroalimentación
                if ($acertado)
                    echo "<p>Acertado</p>";
                else
                    echo "<p>Error. La respuesta es $strRespCorrecta </p>";                
                echo "<p>Has acertado $aciertos / "
                        .count($pregs)."</p>";
            }
        
            if ($iPregunta<count($pregs)){
                echo "<form method='POST' action='". $_SERVER['PHP_SELF']."' >";
                echo "<label>" . $pregs[$iPregunta][0] . "</label>";
                echo "<input type='text' name='resp' />";
                echo "<input type='hidden' name='iPregunta' value='$iPregunta' />";
                 echo "<input type='hidden' name='aciertos' value='$aciertos' />";
                echo "<input type='submit' name='submit' value='Reponder' />";
                echo "</form>";
            }
            else{
                $enlace="concursofin.php?aciertos=$aciertos&total=".count($pregs);
                echo "<p><a href='$enlace'>VER RESULTADO FINAL</a></p>";
            }
        ?>
        
        
    </body>
</html>
