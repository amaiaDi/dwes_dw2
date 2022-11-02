<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>alta</title>
</head>
<body>
    <h1>REGISTRATE</h1>
    <?php
        if(isset($_POST['registrar']))
        {
            $exist = false;
            $nombre = $_POST['name'];
            $fp = fopen("ficheros/usuarios.txt", "a+");
            while(!feof($fp))
            {
                $linea = fgets($fp);
                $arr = explode(";", $linea);
                if($arr[0] == $nombre)
                {
                    $exist = true;
                    echo "<p style='color:red'>Lo sentimos ya existe un usuario $nombre</p>";
                    break;
                }
            }
            if(!$exist)
            {
                $password = $_POST['password'];
                $nuevo = $nombre . ";" . $password . PHP_EOL; //salto de linea
                fwrite($fp, $nuevo);
                fclose($fp);
                echo "$nombre: Has sido dado de alta <br>";
                echo "<a href='charla.php?nombre=$nombre'>Entar al chat</a>";
            }
        }
    ?>
    <form action="alta.php" method="post">
        <table>
            <tr>
                <td><label for="nombre">Login:</label></td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td><label for="password">Password:</label></td>
                <td><input type="password" name="password"></td>
            </tr>
        </table>
        <button type="submit" name="registrar">Registrar</button>
    </form>

    
</body>
</html>