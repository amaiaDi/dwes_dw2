<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4: Chat sencillo con validación de usuario usando fichero de texto</title>
</head>
<body>
    <?php

        $errorUsuario="";
        $errorPassword="";

        if(isset($_POST['Entrar'])){
            if(empty($_POST[nombreUsuario])){
                $errorUsuario= "Usuario no puede estar vacio";
            }

            if(empty($_POST[passwordUsuario])){
                $errorPassword;
            }
        }
    ?>

    <h1>Ejercicio 4: Chat sencillo con validación de usuario usando fichero de texto</h1>
    <form action="ejercicio4_validacion.php" method="post">
        <table>
            <tr>
                <td>Nombre de usuario</td>
                <td><input type="text" name="nombreUsuario"></input></td>
                <td></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="passwordUsuario"></input></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="enviar" value="Entrar" ></input></td>
                <td></td>
            </tr>
        </table>
    </form>
</body>
</html>