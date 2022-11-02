<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
        <form action="validacion.php"  method="post">
            <?php if(isset($_GET["mensaje"])){
                echo "<p>".$_GET["mensaje"]."</p>";
            } ?>
            Nombre de usuario:<input type="text" id="nombre" name="nombre"><br>
            Contraseña:<input type="password" id="password" name="password">
            <input type="submit" value="comprobarUsuario" name="comprobarUsuario"/>
        </form>
</body>
</html>