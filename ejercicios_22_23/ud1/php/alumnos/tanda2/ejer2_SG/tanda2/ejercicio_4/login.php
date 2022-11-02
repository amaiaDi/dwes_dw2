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
        if(!isset($_SESSION["logeado"])):
    ?>
    <main>
        <?php 
            if(isset($_GET["usuario"])){
                echo "<p>CONTRASEÑA ERRONEA PARA <b>" .$_GET['usuario']."</b></p>";
            }
        ?>
        <form action="validacion.php" method="post">
            <table>
                <tr>
                    <td><label for="nombre_usuario">Nombre de usuario: </td>
                    <td><input type="text" name="nombre_usuario" id="nombre_usuario" value="<?php echo $usuario = isset($_GET["usuario"]) ? $_GET["usuario"] : "" ?>"></td>
                    <td rowspan="2"><input type="submit" name="entrada" value="Entrar"></td>
                </tr>
                <tr>
                    <td><label for="contraseina">Contraseña</label></td>
                    <td><input type="password" name="contraseina" id="contraseina"></td>
                </tr>
            </table>
        </form>
    </main>
    <?php else : ?>
        <p><b><?php echo $_SESSION["logeado"] ?></b>: Has sido dado de alta</p>
        <a href="charla.php">ENTRAR AL CHAT</a>
    <?php endif?>
</body>
</html>