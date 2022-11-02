<?php

    if (isset($_POST['enviar'])) {
        if (!empty($_POST['mensaje'])) {
            $mensaje = $_POST['mensaje'];
            $file = fopen("charla.txt", "a");
            fwrite($file, PHP_EOL . $_GET['usuario'] . ';' . $mensaje);
            fclose($file);
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charla</title>
</head>
<body>
    <iframe src="contenido_charla.php">
        
    </iframe>
    <form action="" method="post">
        <table>
            <tr>
                <td>Usuario: </td>
                <td>
                    <?php
                        $usuario = $_GET['usuario'];
                        echo '<strong>' . $usuario . '</strong>';
                    ?>
                </td>
            </tr>
            <tr>
                <td>Mensaje: </td>
                <td><input type="text" name="mensaje" id="mensaje" autofocus></td>
            </tr>
            <tr>
                <td><button type="submit" name="enviar">Enviar</button></td>
            </tr>
        </table>
    </form>
</body>
</html>