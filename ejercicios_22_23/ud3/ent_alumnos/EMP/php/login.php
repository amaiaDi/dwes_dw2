<?php require 'cabecera.php'; ?>
<body>
    <?php 
        if (isset($_GET['referer'])) 
            $_SESSION['pagAnterior'] = $_GET['referer'];
        if (isset($_GET['nuevoItem']))
            $_SESSION['pagAnterior'] = 'nuevoitem.php';
        if (isset($_POST['login'])) {
            if (isset($_POST['user']) && isset($_POST['passw'])){
                $user = $_POST['user'];
                $passw = $_POST['passw'];
                $login = validarLogin($conn, $user, $passw);
                if ($login != false) {
                    $_SESSION['user'] = $user;
                    $_SESSION['userID'] = $login;
                    header("Location: ".$_SESSION['pagAnterior']);
                } 
            }
        }
    ?>
    <h2>Login</h2>
    <form action='login.php' method='post'>
        <table>
            <tr>
                <td><label for="user">Usuario</label></td>
                <td><input type="text" name="user" id="user"></td>
            </tr>
            <tr>
                <td><label for="passw">Contraseña</label></td>
                <td><input type="password" name="passw" id="passw"></td>
            </tr>
            <tr>
                <td colspan="2" class="registro"><input type="submit" value="Login" id="login" name="login"></td>
            </tr>
        </table>
    </form>
    <p>No tienes cuenta?<a href="registro.php"><b>Registrate!!</b></a></p>
    <?php 
        // Cerrar Container y Main
            echo "</div>";
        echo "</div>";
    ?>
</body>
</html>