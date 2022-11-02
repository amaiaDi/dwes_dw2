<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>charla</title>
</head>
<body>
    <?php
        $nombre = $_GET['nombre'];
        if(isset($_POST['enviar']))
        {
            $msg = $_POST['msg'];
            $palabras = fopen("ficheros/palabras_ofensivas.txt", "r");
            while(!feof($palabras))
            {
                $pal = trim(fgets($palabras));
                $msg = str_replace($pal, str_pad('*', strlen($pal), '*'), $msg);
            }
            fclose($palabras);
            $fp = fopen("ficheros/charla.txt", "a+");
            $linea = $nombre . ":" . $msg . "\n";
            fwrite($fp, $linea);
            fclose($fp);
        }

        echo"<iframe src='contenido_charla.php'></iframe>";
        
        echo "<form action='charla.php?nombre=$nombre' method='post'>
        <table>
            <tr>
                <td>Usuario: </td>
                <td><strong>$nombre</strong></td>
            </tr>
            <tr>
                <td>Mensaje:</td>
                <td><input type='text' name='msg'></td>
            </tr>
        </table>
        <button type='submit' name='enviar'>Enviar</button>
    </form>";
    ?>
            
</body>
</html>