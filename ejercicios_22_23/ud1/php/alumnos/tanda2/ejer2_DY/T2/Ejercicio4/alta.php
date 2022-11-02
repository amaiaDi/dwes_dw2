<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <?php
       
        $nomUsuAlta = "";
        $contrAlta = "";
        $error = "";

        if(isset($_POST['botonRegistrar'])){
            global $error;
            $nomUsu = $_POST['nombreUsuarioAlta'];
            $contr = $_POST['contraseñaAlta'];
            $arrUsuarios = array();
            arrayUsuarios();
     
            if(in_array($nomUsu, $arrUsuarios)){
                 $error = "Lo sentimos, ya existe un usuario ".$nomUsu;
            }else{
                 file_put_contents("usuarios.txt", "\n".$nomUsu.";".$contr, FILE_APPEND);
                 $error = "sinErrores";
            }
        }

       function arrayUsuarios(){
            global $arrUsuarios;
            $fp = fopen("usuarios.txt", "r");
            while (!feof($fp)){
                $linea = fgets($fp);
                $nombre = substr($linea, 0, stripos($linea,';'));
                array_push($arrUsuarios, $nombre);
            }
            fclose($fp);
       }
        

    ?>
    <body>   
            <?php 
                if($error == "sinErrores"){
            ?>
            <p><?php echo $nomUsu;?> has sido dado de alta</p>
            <a href="charla.php?nom=$nomUsu" style="color:blue;">Entrar al chat</a>
            <?php 
                }else{
            ?>
            <h1>Registrate</h1>
            <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                        <?php echo "<span style='color:red'> $error</span>";?><br />
                        Nombre de usuario:
                        <input type="text" name="nombreUsuarioAlta" value="<?php echo $nomUsuAlta; ?>" /><br>
                        Constraseña:
                        <input type="password" name="contraseñaAlta" value="<?php echo $contrAlta; ?>" /><br>
                        <input type="submit" value="REGISTRAR" name="botonRegistrar"/>
            </form>
            <?php 
                }
            ?>
    </body>
</html>