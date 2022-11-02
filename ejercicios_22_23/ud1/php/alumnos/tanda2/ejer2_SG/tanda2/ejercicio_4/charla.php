<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
</head>
<body>
    <?php
        session_start();
    ?>
    <form action="contenido_charla.php" method="post">
        <table>
        <tr>
            <td colspan="2">
            <iframe src="contenido_charla.php"></iframe>
            </td>
        </tr>
        <tr>
            <td><label>Usuario: </label> </td>
            <td><b><?php echo $usuario = isset($_SESSION["logeado"])? $_SESSION["logeado"] :  $_SESSION["usuario"]?></b></td>
        </tr>
        <tr>
            <td><label for="mensaje">Mensaje: </label></td>
            <td><input type="text" name="mensaje" id="mensaje"></td>
        </tr>
        <tr>
            <td><input type="submit" name="charla" value="enviar"></td>
            <td></td>
        </tr>
        </table>
    </form>
    <?php 
        $_SESSION["logeado"] = null; 
        $_SESSION["usuario"] = $usuario;
    ?>
</body>
</html>