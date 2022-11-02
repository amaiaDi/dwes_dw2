<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="2">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contenido_charla</title>
    <script type="text/javascript">
        window.onload = function() {
            window.scrollTo(0, document.body.scrollHeight);
        }
    </script>
</head>
<body>
    <?php
        $fp = fopen('ficheros/charla.txt', "r");
        while(!feof($fp))
        {
            $linea = fgets($fp);
            if(!empty($linea))
            {
                echo $linea;
                echo "<br>";
            }
        }
    ?>
</body>
</html>