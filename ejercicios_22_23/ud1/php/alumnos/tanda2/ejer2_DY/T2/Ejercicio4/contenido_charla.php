<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <meta http-equiv="refresh" content="2">
    </head>
    <?php
        $fp = fopen("charla.txt", "r");
        while (!feof($fp)){
            $linea = fgets($fp)."<br>";
            echo $linea;
        }
        fclose($fp);
    ?>
    <script type="text/javascript">
        window.onload = function() {
                window.scrollTo(0, document.body.scrollHeight);
        }
    </script>

</html>