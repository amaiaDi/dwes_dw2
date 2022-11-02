<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta</title>
</head>
<body>
    <p><strong>REGISTRATE</strong></p>
    <?php
        $sw = true;
        $arrUsuarios = unserialize($_GET['arrUsuarios']);
        if(isset($_POST['user']))
        {
            $usuarioAlta = $_POST['user'];
            $contraseñaAlta = $_POST['password'];
            for($c = 0; $c < count($arrUsuarios); $c++)
            {
                $usuarioExist = $arrUsuarios[$c][0];
                if($usuarioExist == $usuarioAlta)
                {
                    $sw = false;
                    echo "<p style='color:red'>Lo sentimos, ya existe un usuario <strong>$usuarioExist</strong></p>";
                }
            }
            if($sw == true)
            {
                $file = fopen('ficheros/usuarios.txt', "a+");
                fwrite($file, "\n$usuarioAlta;$contraseñaAlta");
                fclose($file);
                echo "<p><strong>$usuarioAlta</strong>: Has sido dado de alta</p>";
                echo "<a href='charla.php?username=$usuarioAlta'>ENTRAR AL CHAT</a>";
            }
        }
        if(!isset($_POST['user']) || $sw == false)
        {
            $arrUsuarios = serialize($arrUsuarios);
            $arrUsuarios = urlencode($arrUsuarios);
            echo "<form action='alta.php?arrUsuarios=$arrUsuarios' method='post'>
                <table>
                    <tr>
                        <td><label for='name'>Login:</label></td>
                        <td><input type='text' name='user' id='name'></td>
                    </tr>
                    <tr>
                        <td><label for='name'>Password:</label></td>
                        <td><input type='password' name='password' id='pass'></td>
                    </tr>
                    <tr>
                        <td><button type='submit'>REGISTRAR</button></td>
                    </tr>
                </table>
            </form>";
        }
    ?>
</body>
</html>