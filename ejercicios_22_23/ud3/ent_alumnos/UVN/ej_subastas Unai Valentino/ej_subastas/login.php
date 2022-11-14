<?php
    require('header.php');
    
    if(isset($_POST['usuario']))
    {
        $incorrecto = false;
        $usu = $_POST['usuario'];
        $consultaUsuario = "SELECT * from usuarios where username = '$usu';";
        $resultadoUsuario = mysqli_query($conn, $consultaUsuario);
        $usuario = mysqli_fetch_assoc($resultadoUsuario);
        if($usuario != null){
            if($usuario['activo'] == 0){
                echo "Esta cuenta no está verificada. Te hemos enviado un email para la verificación.";
            }
            else{
                if($_POST['password'] == $usuario['password']){
                    $_SESSION['id'] = $usuario['id'];
                    $_SESSION['usuario'] = $usuario['username'];
                    header("Location: ". $_SESSION['anteriorP']);
                }
                else{
                    $incorrecto = true;
                }
            }
        }
        else{
            $incorrecto = true;
        }
        if($incorrecto){
            echo "Login incorrecto, Inténtalo de nuevo!";
        }
    }
?>

<h1>Login</h1>

<form action="login.php" method="post">
    <table>
        <tr>
            <td><label for="usuario">Usuario:</label></td>
            <td><input type="text" name="usuario"></td>
        </tr>
        <tr>
            <td><label for="password">Password:</label></td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit" name="registrar">Login!</button></td>
        </tr>
    </table>
</form>

<p>No tienes cuenta? <a href="registro.php">Regístrate!</a></p>

<?php
    require('pie.php');
?>





