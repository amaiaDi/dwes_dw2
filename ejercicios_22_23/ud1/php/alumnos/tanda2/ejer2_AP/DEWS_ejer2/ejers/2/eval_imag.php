<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php error_reporting (E_ALL ^ E_NOTICE);
        function rutas_imag($ruta) {
            $arrext = array("jpg","png","tiff");
            $d = dir($ruta);
            $i = 0;
            while (false !== ($entry = $d->read())) {
                foreach ($arrext as &$form) {
                    if (strpos($entry, $form)) {
                        $arr[$i] = $ruta . $entry;
                        $i++;
                    }
                }
            }
            $d->close();
            return $arr;
        }
        
        function enseñarImgs() {
            $arrimg = rutas_imag("../../img/");
            echo "<form action='eval_imag.php' method='post'><table>";
            if ($_POST['numImg']!=1) $arrrand = array_rand($arrimg, $_POST['numImg']);
            else $arrrand[0] = array_rand($arrimg, $_POST['numImg']);
            for ($i = 0; $i < $_POST['numImg']; $i++) {
                echo "<tr>";
                $imgstr = substr($arrimg[$arrrand[$i]], strrpos($arrimg[$arrrand[$i]],"/")+1);
                echo "<td><img src=" . $arrimg[$arrrand[$i]] . " width='200' height='130'></td>";
                echo "<td><input name='megusta[]' value=" . $imgstr . " type='checkbox'><label for='megusta[]'>Me gusta</label></td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "<input type='submit' name='enviar' value='ENVIAR VALORACIONES'>
                    <input type='hidden' name='numImg' value='0' />
                </form>";
        }

        function escribirMeGusta($arr) {
            $handle = fopen($fichero, "w");
            while (!feof($handle)) {
                $linea = fgets($handle);
            }
            fclose($handle);
        }

        if ($_POST['numImg']>0) {
            enseñarImgs();
        }
        
        if (isset($_POST['enviar'])) {
            $_POST['numImg'] = 0;
            if ($_POST['megusta']!=null) {
                $arr = $_POST['megusta'];
                $fichero = fopen("megustan.txt", "a");
                $ip = $_SERVER['REMOTE_ADDR'];
                fwrite($fichero,"$ip: ");
                foreach ($arr as &$linea) {
                    fwrite($fichero,"$linea ");
                }
                fwrite($fichero,"\n");
                fclose($fichero);
                echo "Gracias por tu envio <br>";
                echo "<button onclick='location.href = \"selec_cantidad.php\"'>Volver a la pagina principal</button>";
                return;
            }
            echo "Sentimos que no le haya gustado ninguna <br>";
            echo "<button onclick='location.href = \"selec_cantidad.php\"'>Volver a la pagina principal</button>";
        }
            
    ?>
</body>
</html>