<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php

include "validacion.php";
function registrarUsuario($user, $pass){
    $handle = fopen("txt/usuarios.txt","a");
    $nueva_linea = PHP_EOL . $user . ";" . $pass;
    fwrite($handle, $nueva_linea);
    fclose($handle);
}


if(isset($_GET['usuario_registrado'])){
    $usuario_reg = $_GET['usuario_registrado'];
    echo "
    <p><strong>$usuario_reg</strong>: Has sido dado de alta</p><br>
    <a href='charla.php?usuario=$usuario_reg' class='letra-grande'>ENTRAR AL CHAT</a>
    ";
    
}
else{
    
?>
    <form action="alta.php" name="registro" method="post" class="registro">
        <p><strong>REGÍSTRATE</strong></p>
        <?php
        if(isset($_POST['login'])){
            $usuario = $_POST['login'];
            $contrasenia = $_POST['pass'];
            if(usuarioExiste($usuario)){
                echo "<p class='rojo'>Lo sentimos, ya existe un usuario  <strong>$usuario</strong></p>";
            }
            else {
                if(trim($contrasenia) != ""){
                    registrarUsuario($usuario, $contrasenia);
                    header("Location: alta.php?usuario_registrado=$usuario");
                }
            }
        }
        ?>
        <label for="login">Login:</label>
        <input type="text" name="login"><br>
        <label for="pass">Password:</label>
        <input type="password" name="pass">
        <input type="submit" value="REGISTRAR">
    </form>

<?php
    }
?>

</body>
</html>




