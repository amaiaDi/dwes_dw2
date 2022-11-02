<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4 | Edgar Martínez Palmero</title>
    <link rel="stylesheet" href="../style/ejercicio4.css">
</head>
<body>
    <?php 
        include 'constantes.php';
        include 'funciones.php';
        if (isset($_GET['reenviado'])) {
    ?>
    <h1>Registrate</h1>
    <form action="#" method="post">
        <div class="container">
            <div class="columna">
                <table>
                    <tr>
                        <td><label for="user">Nombre de Usuario: </label></td>
                        <td><input type="text" name="user" id="user"></td>
                    </tr>
                    <tr>
                        <td><label for="passw">Contraseña: </label></td>
                        <td><input type="password" name="passw" id="passw"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Registrarse" name="registro"></td>
                    </tr>
                </table>
            </div>
            <div class="columna">
                <img style="float:right;" src="../img/Ejercicio4/registro.jpg" alt="img de registro" width="150">
            </div>
        </div>        
    </form>
    <?php 
            if (isset($_POST['registro'])) {
                $cod = validarUsuario();
                switch ($cod) {
                    case 0:
                        controlarErrores(0, $_POST['user']);
                        break;
                    case 1:
                    case 2:
                        controlarErrores(2, $_POST['user']);
                        break;
                    case 3:
                        guardarUsuario($_POST['user'], $_POST['passw'], FichUSER);
                        header("Location: alta.php");
                        break;
                }
            }
        } else {
            echo '<p>Ya puedes <a href=login.php>iniciar sesion</a></p>';
        }
    ?>
</body>
</html>