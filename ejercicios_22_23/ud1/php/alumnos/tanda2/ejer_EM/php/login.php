<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4 | Edgar Martínez Palmero</title>
</head>
<body>
    <?php 
        include 'constantes.php';
        include 'funciones.php';
        if (isset($_GET['error'])) {
            if (isset($_GET['user']))
                controlarErrores($_GET['error'], $_GET['user']);
            else
                controlarErrores($_GET['error'], 'sinUsuario');
        }
    ?>
    <form action="validacion.php" method="post">
        <table>
            <tr>
                <td><label for="user">Nombre de Usuario: </label></td>
                <td><input type="text" name="user" id="user"></td>
                <td rowspan="2"><input type="submit" value="Entrar" name="entrar"></td>
            </tr>
            <tr>
                <td><label for="passw">Contraseña: </label></td>
                <td><input type="password" name="passw" id="passw"></td>
            </tr>
        </table>        
    </form>
</body>
</html>