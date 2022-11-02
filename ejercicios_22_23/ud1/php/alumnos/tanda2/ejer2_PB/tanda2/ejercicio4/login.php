<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="validacion.php" method="post">
        <p>
            <?php
                $usuario = '';
                if (isset($_GET['encontrado']) && $_GET['encontrado'] == false) {
                    echo 'CONTRASEÑA ERRÓNEA PARA <strong>' . $_GET['usuario'] . '</strong></p><p>Inténtalo de nuevo</p>';
                    $usuario = $_GET['usuario'];
                }
            ?>
        </p>
        <table>
            <tr>
                <td><label for="nombre">Nombre de usuario: </label></td>
                <td><input type="text" name='nombre' value="<?php echo $usuario; ?>"></td>
                <td rowspan='2'><button type="submit" name='entrar'>ENTRAR</button></td>
            </tr>
            <tr>
                <td><label for="password">Contraseña: </label></td>
                <td><input type="password" name="password" id="password"></td>
            </tr>
        </table>
    </form>
</body>
</html>