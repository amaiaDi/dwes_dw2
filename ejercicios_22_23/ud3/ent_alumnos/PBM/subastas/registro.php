<?php

    $mensaje = '';
    if (isset($_POST['registrate'])) {
        if (empty($_POST['usuario']) || empty($_POST['nombre_completo']) ||empty($_POST['password']) ||empty($_POST['password_again']) ||empty($_POST['email'])) {
            $mensaje = 'Debe de rellenar todos los campos para hacer el registro';
        } else {
            if (strcmp($_POST['password'], $_POST['password_again']) !== 0) {
                $mensaje = 'La contraseña debe coincidir en ambos campos';
            } else {
                $usuario = $_POST['usuario'];
                $nombre = $_POST['nombre_completo'];
                $pass = $_POST['password'];
                $email = $_POST['email'];

                $idUltimoUser = 0;
                $sqlContUser = "SELECT COUNT(*) FROM usuarios";
                $resultadoContUser = mysqli_query($con, $sqlContUser);
                $rowContador = mysqli_fetch_array($resultadoContUser);
                if (!empty($rowContador[0])) {
                    $idUltimoUser = $rowContador[0];
                }

                $sqlNuevoUser = "INSERT INTO usuarios (id, username, nombre, password, email, cadenaverificacion, activo, falso) VALUES ($idUltimoUser+1, '$usuario', '$nombre', '$pass', '$email', 'verific', 1, 0)";
                $resultadoNuevoUser = mysqli_query($con, $sqlNuevoUser);
                if (mysqli_errno($con)) {
                    die(mysqli_error($con));
                }

                header('Location: ?r=login');
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
    <link rel="stylesheet" href="css/estilos_login.css">
    <title>Document</title>
</head>
<body>
    <h1>REGISTRO</h1>
    <p>Para registrarse en <?php echo DB_TITULO; ?>, rellena el siguiente formulario</p>
    <p style="color: red;"><?php echo $mensaje; ?></p>
    <form action="" method="post">
        <table>
            <tr>
                <td><label for="usuario">Usuario</label></td>
                <td><input type="text" name="usuario" id="usuario"></td>
            </tr>
            <tr>
                <td><label for="nombre_completo">Nombre completo</label></td>
                <td><input type="text" name="nombre_completo" id="nombre_completo"></td>
            </tr>
            <tr>
                <td><label for="password">Password</label></td>
                <td><input type="password" name="password" id="password"></td>
            </tr>
            <tr>
                <td><label for="password_again">Password (de nuevo)</label></td>
                <td><input type="password" name="password_again" id="password_again"></td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td><input type="email" name="email" id="email"></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" name="registrate">Regístrate</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>