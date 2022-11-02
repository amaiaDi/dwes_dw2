<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>validación</title>
</head>
<body>
    <?php
        $nombre = $_POST['nombre'];
        $passw = $_POST['password'];
        $arr;
        $exist = false;
        $fp = fopen("ficheros/usuarios.txt", "r");
        while(!feof($fp))
        {
            $linea = fgets($fp);
            $arr = explode(";", $linea);
            if($arr[0] == $nombre)
            {
                $exist = true;
                $arr[1] = trim($arr[1]);
                if($arr[1] == $passw)
                {
                    header("Location: charla.php?nombre=$nombre");
                }
                else
                {
                    header("Location: login.php?variable=$nombre");
                }
            }
        }
        fclose($fp);
        if(!$exist)
        {
            header("Location: alta.php");
        }
    ?>
</body>
</html>