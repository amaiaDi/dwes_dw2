<?php
    require("cabecera.php");
    if(isset($_POST['usuario'])){
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        if(comprobarLogin($usuario, $password) == 1){
            $_SESSION['usuario'] = $usuario;
            $_SESSION['password'] = $password;
            $pagina_anterior = $_SESSION['pagina_anterior'];
            header("Location: $pagina_anterior");
        }
        elseif (comprobarLogin($usuario, $password) == 2) {
            $mensaje =  "Esta cuenta no está verificada. Te hemos envíado un email para verificarla.";
        }
        else{
            $mensaje = "Login incorrecto. Inténtalo de nuevo!";
        }
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/styles.css">
    <title>Registro</title>
</head>
<body>
    <?php if(isset($mensaje)) echo $mensaje;?>
    <header>
        <h1>LOGIN</h1>
    </header>
    <form action="login.php" method="post" >
        <table class="registro-login">
            <tr>
                <td><label for="usuario">Usuario</label></td>
                <td><input type="text" name="usuario"></td>
            </tr>
            <tr>
                <td><label for="password">Password</label></td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Login!" name="loguearse"></td>
            </tr>
        </table>
        <p>No tienes una cuenta? <a href="registro.php">Regístrate!</a></p>
    </form>
    <?php require("pie.php"); ?>
</body>
</html>