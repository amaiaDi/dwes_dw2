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
        
            $ultimover="";
             
            if (isset($_GET['borrar'])){                
                $ruta=$_GET['borrar'];
                unlink($ruta);
            }
            
            if (isset($_GET['ver'])){
                $ultimover=$_GET['ver'];
            }
            //$mostrar_tabla=false;
            $error_carpeta="";
            $imgs=[];
            
            if (isset($_POST['submit'])  || 
                    isset($_GET['borrar'])  || 
                    (isset($_GET['ver']))){
                $carpeta=$_REQUEST['carpeta'];
                if (!is_dir($carpeta)){
                    $error_carpeta="Carpeta no existe";
                }
                else{
                    
                    $dir=opendir($carpeta);
                    while ($entrada=readdir($dir)){                    
                        $partes=explode(".",$entrada);
                        $ext=$partes[count($partes)-1];
                        if ($ext=="jpg"){                            
                            $imgs[]=$carpeta."/".$entrada;
                        }
                    }
                    closedir($dir);
                }
            }        
            
            
        
        ?>
        
        
        
        
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <input type="text" name="carpeta" /><?php echo $error_carpeta ?>
            <input type="submit" name="submit" value="VER IMAGENES" />            
        </form>
        
        
        <?php
        
            if (count($imgs)>0){
               echo "<table>"; 
               foreach ($imgs as $img){
                   
                    $enlaceB=$_SERVER['PHP_SELF']."?borrar=$img&carpeta=$carpeta";
                    $enlaceVer=$_SERVER['PHP_SELF']."?ver=$img&carpeta=$carpeta";
                   
                    echo "<tr>";
                    echo "<td>$img</td>";
                    echo "<td><a href='$enlaceVer'>VER</a></td>";
                    
                    if ($ultimover==$img){
                         echo "<td><img src='$img' width='30'/></td>";
                    }
                    
                    echo "<td><a href='$enlaceB'>BORRAR</a></td>";
                    echo "</tr>";
               }
               echo "</table>";
            }     
           
        ?>
    </body>
</html>
