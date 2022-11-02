<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $arr;
        function cuantasImag($ruta) {
            define('DIRIMG', $ruta);
            $arrext = array("jpg","png","tiff");
            $d = dir(DIRIMG);
            $cantidad = 0;
            while (false !== ($entry = $d->read())) {
                foreach ($arrext as &$form) {
                    if (strpos($entry, $form)) {
                        $arr[$cantidad] = $ruta . $entry;
                        $cantidad++;
                        if ($cantidad!=1) echo "<option value='$cantidad'>$cantidad</option>";
                    }
                }
            }
            $d->close();
            return $cantidad;
        }
    ?>
    <form action="eval_imag.php" method="post">
        <label for="numImg">¿Cuantas imagenes deseas ver?</label>
        <select name="numImg" id="numImg">
            <?php
                cuantasImag("../../img/");
            ?>
        </select><br><br>
        <input type="submit" value="VER IMAGENES">
    </form>
</body>
</html>