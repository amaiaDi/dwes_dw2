<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
</head>
<body>

<?php

    function guardarMensaje($mensaje){
        $mensaje = PHP_EOL . $_POST['mensaje'];
        $handle = fopen('txt/charla.txt','a');
        fwrite($handle, $mensaje );
        fclose($handle);
    }


    if(isset($_GET['usuario'])){
        $usuario = $_GET['usuario'];
    }
    if(isset($_POST['texto_enviado'])){
        $usuario = $_POST['nombre_enviado'];
        $mensaje = $_POST['texto_enviado'];
        guardarMensaje($mensaje);
    }
?>
        <iframe src='contenido_charla.php'></iframe>

        <?php
        echo "
        <form action='charla.php' name='mensaje_enviado' method='post'>
            <label>Usuario:</label>
            <label><strong>$usuario</strong></label><br>
            <label for='mensaje'>Mensaje:</label>
            <input type='text' name='mensaje'><br>
            <input type='submit' name='texto_enviado'>
            <input type='hidden' name='nombre_enviado' value=$usuario>
        </form>
        ";
    
?>
    
</body>
</html>