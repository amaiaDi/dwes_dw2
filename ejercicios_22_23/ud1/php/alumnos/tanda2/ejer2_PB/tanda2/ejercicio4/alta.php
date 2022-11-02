<?php

    $mensaje = '';
    $existe = false;
    $usuario = '';
 
    if (isset($_POST['registrar'])) {
        if (empty($_POST['login']) || empty($_POST['password'])) {
            $mensaje = 'Debe rellenar los dos campos de forma obligatoria para registrarse';
        } else {
            $file = fopen("usuarios.txt", "r");
            while(!feof($file)) {        
                $linea = fgets($file);
                $datos = explode(';', $linea);
                if (in_array($_POST['login'], $datos)) {
                    $existe = true;
                }
            }
            fclose($file);
            
            if ($existe) {
                $mensaje = 'Lo sentimos, ya existe un usuario <strong>' . $_POST['login'] . '</strong>';
            } else {
                $usuario = $_POST['login'];
                $file = fopen("usuarios.txt", "a");
                fwrite($file, PHP_EOL . $_POST['login'] . ';' . $_POST['password']);                
                fclose($file);
                dibujarMensaje();
            }
        }
    }

    function dibujarMensaje() {
        $usuario = $_POST['login'];
        echo '
            <p><strong>' . $usuario . '</strong>: Has sido dado de alta</p>
            <a href="charla.php?usuario=' . $usuario . '" style="font-size: 20px;">ENTRAR AL CHAT</a>
        ';
    }

    if (empty($_POST['password']) || $existe) {
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alta</title>
    </head>
    <body>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <h2>REGÍSTRATE</h2>
            <p style="color: red;">
            <?php
                echo $mensaje;
            ?>
            </p>
            <table>
                <tr>
                    <td><label for="login">Login: </label></td>
                    <td><input type="text" name="login"></td>
                    <td rowspan="2"><img src="imagenes/registro.jpg" alt="registro.jpg"></td>
                </tr>
                <tr>
                    <td><label for="password">Password: </label></td>
                    <td><input type="password" name="password" id="password"></td>
                </tr>
            </table>
            <button type="submit" name="registrar">REGISTRAR</button>
        </form>
        <?php
            }
        ?>
    </body>
</html>