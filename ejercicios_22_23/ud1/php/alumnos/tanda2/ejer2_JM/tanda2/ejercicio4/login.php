<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php
    echo "
    <form action='validacion.php' method='post'>
    ";
    if(isset($_GET['usuario'])){
        $usuario = $_GET['usuario'];
        ?>
        <p>CONTRASEÑA ERRÓNEA PARA: <strong> <?php echo "$usuario";?></strong></p>
        <p>Inténtalo de nuevo</p>
        <label for='usuario'>Nombre de usuario:</label>
        <input type="text" name="nombre" value="<?php echo $_GET['usuario'];?>">
        <?php
        echo "<br>";
    }
    else {
        echo "
        <label for='usuario'>Nombre de usuario:</label>
        <input type='text' name='usuario'><br>";
    }
    echo "
        <label for='usuario'>Contraseña:</label>
        <input type='password' name='contrasenia'>
        <input type='submit' name='enviar_usuario_contrasenia' value='ENTRAR'>
    </form>

    
    ";
    
    ?>    

</body>
</html>




