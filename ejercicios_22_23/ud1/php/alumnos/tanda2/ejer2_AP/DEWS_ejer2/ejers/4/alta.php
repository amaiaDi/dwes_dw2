<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>REGISTRATE</h2>
    <?php 
        function checkUser() {
            $fichero = fopen("usuarios.txt", "r");
            $usuario = $_POST['usuario'];
            while (!feof($fichero)) {
                $linea = fgets($fichero);
                $usuLn = substr($linea,0,strpos($linea,";"));
                if ($usuario == $usuLn) {
                    fclose($fichero);
                    return true;
                }
            }
            fclose($fichero);
            return false;
        }

        function darDeAlta() {
            $fichero = fopen("usuarios.txt", "a");
            $usuario = $_POST['usuario'];
            $password = $_POST['passw'];
            $str = "\n" . $usuario . ";" . $password;
            fwrite($fichero, $str);
            fclose($fichero);
        }


        if (isset($_POST['regis'])) {
            if (!checkUser()) {
                darDeAlta();
                session_start();
                $_SESSION['loged'] = $_POST['usuario'];
                header("Location: login.php");
            } else {
                echo "Lo sentimos, ya existe un usuario <strong>" . $_POST['usuario'] . "</strong>";
            }
        }


    ?>
    <form action="alta.php" method="post">
        <table>
            <tr>
                <td>Login:</td>
                <td><input type="text" size="20" name="usuario"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" size="20" name="passw"></td>
            </tr>
        </table>
        <input type="submit" value="REGISTRARSE" name="regis" />
    </form>
</body>
</html>