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
            function sumatorio($num){                
                $suma=0;
                for ($cont=1; $cont<=$num; $cont++){
                    $suma+=$cont;
                }
                return $suma;
            }
            
            function verDivisores($num){
                if ($num<=0)
                    return;
                echo "<h2>Divisores de $num </h2>" ;
                echo "<ul>";
                for ($pd=1; $pd<=$num;$pd++){
                    if ($num%$pd==0)
                        echo "<li>$pd</li>";                    
                }
                echo "</ul>";
                
            }
            
            
            function verTablaMulti($num){
                echo "<table>";
                echo "<tr>";
                    echo "<td colspan='2'>Tabla del $num</td>";
                echo "</tr>";     
                
                for ($cont=1; $cont<=$num ; $cont ++){
                    echo "<tr>";
                        echo "<td>$num x $cont</td>";
                        echo "<td>"  .($num * $cont) ."</td>";
                    echo "</tr>";
                }                
                echo "</table>";
                
            }
            
            
            function verBisiestos($cant){
                
                $anio=date('Y');
                
                $cont=0;
                while ($cont<$cant){
                    
                    if (($anio%400==0)
                            ||
                        ($anio%4==0 && $anio%100!=0))
                    {
                        echo "<p>$anio</p>";    
                        $cont++;
                    }                    
                    $anio++;
                }
                
                
            }
        
        ?>
        
    </head>
    <body>
        <?php
        //Mostrar la raiz de 200 en un párrafo y
        //subrayado
        echo "<p><u>" . sqrt(200) . "</u></p>";
        
        ?>
        
        <p>
            <u>
                <?php 
                    echo sqrt(100);
                ?>
            </u>
        </p>
        
        
        <?php
            echo "<p> El sumatorio de 100 es " . sumatorio(100) ."</p>";
            echo "<p> El sumatorio de 5 es " . sumatorio(100) ."</p>";
        
            verDivisores(50);
            
            verDivisores(17);
            
            verTablaMulti(8);
            
            
            //Visualizar tabla con la tabla de 
            //multiplicar de $num
            
            $num=12;
            
    ?>
            <table>
                <tr>
                <td colspan='2'>Tabla del 
    <?php           echo $num;
    ?>
                </td>";
                </tr>    
                
     <?php    for ($cont=1; $cont<=$num ; $cont ++){
     ?>
                <tr>
                <td>
                    <?php echo $num; ?>
                    x 
                    <?php echo $cont; ?>
                </td>
                <td>
                    <?php echo ($num * $cont); ?> 
                </td>
                </tr>
     <?php
                }
     ?>
         </table>
            
     <?php
  verBisiestos(30);
  ?>
        
        
    </body>
</html>
