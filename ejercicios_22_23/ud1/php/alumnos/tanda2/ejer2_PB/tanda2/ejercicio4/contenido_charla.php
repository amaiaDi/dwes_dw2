<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="2">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $file = fopen("charla.txt", "r");
        while(!feof($file)) {
            $linea = fgets($file);
            $datos = explode(';', $linea);
            $pos = 0;
            $datos[1] = str_replace(':)', '&#128578;', $datos[1]);
            $datos[1] = str_replace(':(', '&#128577;', $datos[1]);
            $fileOfensivo = fopen("palabras_ofensivas.txt", "r");
            while (!feof($fileOfensivo)) {
                $lineaOfensiva = fgets($fileOfensivo);
                if (strpos($datos[1], $lineaOfensiva) !== false) {
                    $datos[1] = str_replace($lineaOfensiva, '*****', $datos[1]);
                }
            }
            fclose($fileOfensivo);
            echo '<p><strong>' . $datos[0] . ":</strong> " . $datos[1] . '</p>';
        }
        fclose($file);
    ?>
</body>
</html>
<script type="text/javascript">
    window.onload = function() {
        window.scrollTo(0, document.body.scrollHeight);
    }
</script>