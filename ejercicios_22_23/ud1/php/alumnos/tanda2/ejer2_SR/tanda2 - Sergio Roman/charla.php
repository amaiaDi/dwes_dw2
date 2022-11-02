<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charla</title>
</head>
<body>
<?php
    if(isset($_GET['username']))
    {
        $username = $_GET['username'];
    }
    if(isset($_POST['mensaje']))
    {
        $message = $_POST['mensaje'];
        $file = fopen('ficheros/charla.txt', "a+");
        $mensaje = $username . ': ' . $message."\n";
        $mensaje = str_replace(':)', '🙂', $mensaje);
        $mensaje = str_replace(':(', '🙁', $mensaje);
        $insultos = fopen('ficheros/insultos.txt', "r");
        while(!feof($insultos))
        {
            $linea = fgets($insultos);
            $linea = trim($linea);
            $mensaje = str_replace($linea, str_pad('*', strlen($linea), "*"), $mensaje);
        }
        fclose($insultos);
        fwrite($file, $mensaje);
        fclose($file);
    }
    echo "<iframe src='contenido_charla.php' frameborder='0'></iframe>";
        echo "<form action='charla.php?username=$username' method='post'>";
            echo "<label for='user'>Usuario: <strong>$username</strong></label>
            <br>
            <label for='mensaje'>Mensaje:</label>
            <input type='text' name='mensaje' id='msg'>
            <br>
            <input type='submit' value='ENVIAR'>
        </form>";
    ?>
</body>
</html>