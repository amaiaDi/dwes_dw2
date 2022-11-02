<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php
        if(isset($_GET['username']))
        {
            $username = $_GET['username'];
            echo "<p>CONTRASEÑA ERRONEA PARA <strong>$username</strong></p>";
            echo "<p>Intentalo de nuevo</p>";
        }
    ?>
    <form action="validacion.php" method="post">
        <table>
            <tr>
                <td><label for="name">Nombre de usuario:</label></td>
                <td><input type="text" name="user" id="name" value="<?php
                if(isset($_GET['username']))
                {
                    $username = $_GET['username'];
                    echo $username;
                }
                ?>"></td>
                <td rowspan="3"><button type="submit">ENTRAR</button></td>
            </tr>
            <tr>
                <td><label for="name">Contraseña:</label></td>
                <td><input type="password" name="password" id="pass"></td>
            </tr>
        </table>
    </form>
</body>
</html>