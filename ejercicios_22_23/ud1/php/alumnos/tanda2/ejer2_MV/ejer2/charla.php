<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            if(isset($_SESSION['user'])) {
                $user= $_SESSION['user'];
            }
        ?>
        <iframe src="contenido_charla.php">
            
        </iframe>
        <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <table>
                <tr>
                    <td>Usuario:</td>
                    <?php
                        if(isset($_SESSION['user'])) {
                            echo "<td> $user </td>"; 
                        }
                    ?>
                </tr>
                <tr>
                    <td>Mensaje:</td>
                    <td><input type="text" name="mensaje"></td>
                </tr>
                <tr><td><input type="submit" name="enviar" value="Enviar"></td></tr>
            </table>
            <?php
                
                function malS($mensaje) {
                    $fp = fopen("malSonantes.txt", "r");

                    while(!feof($fp)) {
                        $linea = fgets($fp);
                        $linea=trim($linea);
                        if ($linea!="") {
                            $mensaje = str_replace("$linea","****", $mensaje);
                        }
                    }
                    fclose($fp);
                    return $mensaje;
                }
                if (isset($_POST['enviar'])){
                    $mensaje=$_REQUEST['mensaje'];
                    $mensaje=malS($mensaje);
                    $fp = fopen("charlaGlobal.txt", "a+");
                    $datos = "".$user.": ".$mensaje."\n";
                    fputs($fp, $datos);
                    fclose($fp);
                }
            ?>
        </form>
        

    </body>
</html>