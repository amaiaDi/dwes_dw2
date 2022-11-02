<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    session_start();  
    if (!isset($_SESSION['login'])){
        header("location:index.php");
        exit();        
    }

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
             
                      
            
            
            if (isset($_GET['guardar'])){                
                $f=fopen("usuarios.txt","a");
                foreach ($_SESSION['nuevos'] as $usuario => $ciclo){
                    fputs($f,$usuario . "\t" . $ciclo . "\r\n");
                }                
                fclose($f);
                echo "<p>Se han guardado". count ($_SESSION['nuevos']) . " usuarios</p>";
                unset($_SESSION['nuevos']);
            }
            
            if (!isset($_SESSION['nuevos']))
                $_SESSION['nuevos']=array();
            
            if (isset($_GET['eliminar'])){
                $usuario=$_GET['eliminar'];
                unset ($_SESSION['nuevos'][$usuario]);
            }
               
            
            if (isset($_POST['submitaniadir'])){
                $usuario=$_POST['usuario'];
                $ciclo=$_POST['ciclo'];
                if (!array_key_exists($usuario,$_SESSION['nuevos']))
                        $_SESSION['nuevos'][$usuario]=$ciclo;
            }
            
        
            echo "<h2>". $_SESSION['login'] . ", puedes añadir usuarios</h2>";
        
        ?>
        
        
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']  ?>">            
            <input type="text" name="usuario" />
            <select  name="ciclo" >
                <option value="DW" >DW</option> 
                <option value="DM" >DM</option> 
                <option value="SI" >SI</option> 
                <option value="AF" >AF</option>          
            </select>
            <input type="submit" name="submitaniadir" value="AÑADIR USUARIO" />
            
        </form>
        
        <?php
        
        
        if ((count($_SESSION['nuevos'])>0)){
            echo "<h2>Usuarios a añadir</h2>";
            foreach ($_SESSION['nuevos'] as $usuario => $ciclo){
                echo "<br/>$usuario: $ciclo";
                $enlace=$_SERVER['PHP_SELF']."?eliminar=$usuario";
                echo "<a href='$enlace'>Eliminar</a>";
            }
            
            $enlace=$_SERVER['PHP_SELF']."?guardar";
            echo "<p><a href='$enlace'>GUARDAR USUARIOS NUEVOS</a></p>";
        }
        
        
        
        
        ?>
    </body>
</html>
