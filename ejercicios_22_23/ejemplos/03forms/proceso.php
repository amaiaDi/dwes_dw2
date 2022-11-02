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
            if (!isset($_POST['submit'])){                
                //echo "<a href='index.php'>IR A FORM</a>";
                header("location: index.php");
            }
            else{
                $errores=array();
                
                
                if ($_POST['nombre']=="")
                    $errores[]="Debes introducir nombre";
                else
                    $nombre=$_POST['nombre'];
                
                
                $pass=$_POST['pass'];
                $edad=$_POST['edad'];
                
                //Si no se selecciona ningún radio, nisiquiera
                //se envía
                if (!isset($_POST['sexo']))
                    $errores[]="Debes seleccionar sexo";
                else                      
                    $sexo=$_POST['sexo'];
                
                if (!isset($_POST['afics']))
                    $errores[]="Debes seleccionar alguna aficion";
                else{
                    $afics=$_POST['afics'];
                }
                
                
                
                if (count($errores)>0){
                    foreach ($errores as $error)
                        echo "<p>$error</p>";
                }
                else{
                    
                    echo "<p>Nombre:$nombre</p>";
                    echo "<p>Pass:$pass</p>";
                    echo "<p>Edad:$edad</p>";
                    $sexoStr=($sexo=='h')?'Hombre':'Mujer';
                    echo "<p>$sexoStr</p>";
                    echo "<p><u>Aficiones</u></p>";
                    foreach($afics as $afic)
                        echo "<p>$afic</p>";
                }
                
                
            }
        ?>
    </body>
</html>
