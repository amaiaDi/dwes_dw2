<?php

    $mensaje = '';
    if (isset($_POST['login'])) {
        if (empty($_POST['usuario']) || empty($_POST['password'])) {
            $mensaje = 'Hay que rellenar los 2 campos';
        } else {
            $encontrado = false;
            $sqlDatosLogin = "SELECT * FROM usuarios";
            $resultadoDatosLogin = mysqli_query($con, $sqlDatosLogin);
            while($rowDatos = mysqli_fetch_assoc($resultadoDatosLogin)) {
                if (strcmp($_POST['usuario'], $rowDatos['username']) === 0 && strcmp($_POST['password'], $rowDatos['password']) === 0) {
                    $encontrado = true;
                    $_SESSION['id_user'] = $rowDatos['id'];
                    $_SESSION['username'] = $rowDatos['username'];
                }
            }

            if (!$encontrado) {
                $mensaje = 'Login incorrecto. Inténtalo de nuevo!';
            } else {
                header('Location: cabecera.php');
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p name="mensaje">
        <?php echo $mensaje; ?>
    </p>
    <h1>Login</h1>
    <form action="" method="post">
        <table>
            <tr>
                <td><label for="usuario">Usuario</label></td>
                <td><input type="text" name="usuario" id="usuario"></td>
            </tr>
            <tr>
                <td><label for="password">Password</label></td>
                <td><input type="password" name="password" id="password"></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" name="login">Login!</button></td>
            </tr>
        </table>
    </form>
    <p>No tienes una cuenta? <a href="?r=registro">Regístrate</a></p>
</body>
</html>