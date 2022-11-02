<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <?php
        if(isset($_GET['variable']))
        {
            $nombre = $_GET['variable'];
            echo "<h1>CONTRASEÑA ERRÓNEA PARA $nombre</h1> <br>";
            echo "Inténtalo de nuevo";
        }
    ?>

    <form action="validacion.php" method="post">
        <table>
            <tr>
                <td><label for="nombre">Nombre de usuario:</label></td>
                <td><input type="text" name="nombre"></td>
                <td rowspan="2"><button type="submit" name="entrar">Entrar</button></td>
            </tr>
            <tr>
                <td><label for="password">Contraseña:</label></td>
                <td><input type="password" name="password"></td>
            </tr>
        </table>
    </form>
</body>
</html>