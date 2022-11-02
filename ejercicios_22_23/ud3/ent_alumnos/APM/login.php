<?php require "cabecera.php";
    //AUTENTIFICAR USUARIO
    if (isset($_POST['login'])) {
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $sql = "select id, username, password from usuarios where username = '$user' and password = '$pass' and activo = '1'";
        $resultado = $conn->query($sql);  
        if($conn->errno) die($conn->error);
        $fila = $resultado -> fetch_assoc();
        if ($fila['id']!=null) {
            $_SESSION['user'] = $fila['id'];
            header("Location:".$_SESSION['link']);
            return;
        }
        unset($_SESSION['user']);
        header("Location: login.php?err");
    }

?>
<h2>LOGIN</h2>
<form action="login.php" method="post"> <!-- FORMULARIO DE LOGIN -->
    <table id="formauth">
        <?php if (isset($_GET['err'])) echo "<p>Login incorrecto, Intentalo de nuevo</p>"?>
        <tr>
            <td><input type="text" name="user" id="user" placeholder="Usuario" required></td>
        </tr>
        <tr>
            <td><input type="password" name="pass" id="pass" placeholder="Contraseña" required></td>
        </tr>
        <tr>
            <td><input type="submit" name="login" value="Log in"></td>
        </tr>
    </table>
    <p>No tienes cuenta? puedes registrarte <a href="registro.php">aqui</a></p>
</form>
<?php require "pie.php"; ?>