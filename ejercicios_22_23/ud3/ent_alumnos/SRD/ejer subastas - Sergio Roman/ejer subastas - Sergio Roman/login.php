<?php
    require('header.php');

    if(isset($_POST['Login']))
    {
        $usuario = $_POST['user'];
        $password = $_POST['password'];
        $consultaUserSQL = "SELECT * FROM usuarios where username = '$usuario';";
        $resulUserSQL = mysqli_query($conn, $consultaUserSQL);
        $user = mysqli_fetch_assoc($resulUserSQL);

        $sw = 0;
        if($user != null)
        {
            if($user['activo'] == 0)
            {
                $sw = 1;
                echo "<p>Esta cuenta no esta verificada. Te hemos enviado un email para verificarla!</p>";
            }
            else
            {
                if($user['password'] == $password)
                {
                    $id = $user['id'];
                    $_SESSION['id'] = $id;
                    $_SESSION['user'] = $user;
                    if(isset($_SESSION['pagina']))
                    {
                        $pag = $_SESSION['pagina'];
                        header("Location: $pag");
                    }
                    else
                    {
                        header('Location: index.php');
                    }
                }
            }
        }
        if($sw == 0)
        {
            echo "<p>Login incorrecto. Intentalo de nuevo!</p>";
        }
    }

?>
<h1>Login</h1>
<form action="login.php" method="post">
    <table>
        <tr>
            <td><label for="user">Usuario</label></td>
            <td><input type="text" name="user"></td>
        </tr>
        <tr>
            <td><label for="password">Password</label></td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="Login" value="Login"></td>
        </tr>
    </table>
</form>
<?php
    echo "<p>No tienes una cuenta? <a href='registro.php'><strong>Registrate!</strong><a/></p>";
    require('pie.php');
?>