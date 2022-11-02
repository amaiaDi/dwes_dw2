<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eval_imag</title>
</head>
<body>
    <?php
    if(isset($_POST['enviar']))
    {
        function rutas_imag($carpeta)
        {
            $arrext = array("jpg", "png", "tiff");
            $cont = 0;
            $arr = [];
            $dir = opendir($carpeta);
            for($i=0; $archivo = readdir($dir);$i++)
            {
                for($i1=0;$i1<count($arrext);$i1++)
                {
                    if(substr($archivo, strpos($archivo, ".")+1) == $arrext[$i1])
                    {
                        $arr[$cont] = $carpeta ."/" . $archivo ;
                        $cont++;
                    }
                }

            }
            return $arr;
        }
        
        $cantidad = $_POST['cantidadImg'];
        $arr = rutas_imag("DIRIMG");
        $random = array_rand($arr, $cantidad);
        
        
        
        ?>

        <form action="eval_imag.php" method="post">
        
        <?php
            echo "<table>";
            for($i=0;$i<count($random);$i++)
            {
                $img = $arr[$random[$i]];
                $nombre = substr($img, strpos($img, '/')+1);
                echo "<tr>
                    <td><img src='$img' alt='$img' width='300' height='150'></td>";

                echo"<td>
                        <input type='checkbox' name='megusta[]' id='$i' value='$nombre'>
                        <label for='$i'>Me gusta</label>
                    </td>
                    </tr>";
            }
            echo "</table>";
            echo "<button type='submit' name='enviarResp'>ENVIAR VALORACIONES</button>";
        }

        if(isset($_POST['enviarResp']))
        {
            if(empty($_POST['megusta']))
            {
                echo "<p>Sentimos que no le haya gustado ninguna</p>";
                echo "<p><a href='selec_cantidad.php'>Volver a la página principal</a></p>";
            }
            else
            {
                echo "<p>Gracias por valorar las imagenes</p>";
                echo "<p><a href='selec_cantidad.php'>Volver a la página principal</a></p>";

                $fp = fopen('ficheros/imagenes.txt', 'a+');
                $linea = gethostbyname(gethostname()) . ": ";
                $array = $_POST['megusta'];
                for($i=0;$i<count($array);$i++)
                {
                    $linea .= $array[$i] . " ";
                }
                fwrite($fp, $linea);
                fwrite($fp, "\n");
                
            }
        }

    ?>
    </form>
</body>
</html>