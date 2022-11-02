<?php
require_once('funciones.php');
    if(isset($_POST['usuario'])){
        $nombre = $_POST['usuario'];
        $contrasenia = $_POST['password'];
        if(existeUsuarioContr($nombre, $contrasenia)==1){
            if(usuarioNoActivo($nombre)==0){
                $_SESSION['nombre']=$nombre;
                $_SESSION['contrasenia']=$contrasenia;
                header("Location: /dews/subastas/index.php");
            }
            else{
                echo '<p>El usuario no esta activado, porfavor activelo en el correo que se le a mandado al registrarse</p>';
            }
        }
        else{
            echo '<p>El usuario y/o la contraseña no coinciden, intentalo otra vez.</p>';
        }
    }

    ?>
<?php require("cabecera.php"); ?>
<?php
    $con = mysqli_connect(HOST, USER, PASS);
    mysqli_select_db($con, DATABASE);

?>
<!DOCTYPE html>
<html lang="eS">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    
    <h1>LOGIN</h1>
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
        <p>No tienes una cuenta? <a href="registro.php">Registrate!</a></p>
    </form>
    <?php require("pie.php"); ?>
</body>
</html>