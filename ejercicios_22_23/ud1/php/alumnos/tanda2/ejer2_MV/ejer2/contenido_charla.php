<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <meta http-equiv="refresh" content="2">
    </head>
    <style>
        img{
            width:20px; 
            height:20px;
        }
    </style>
    <body>
        <?php
            function expresiones($mensaje) {
                $mensaje = str_replace(":)","<img src=imagenes/feliz.png>", $mensaje);
                $mensaje = str_replace(":(","<img src=imagenes/triste.jfif>", $mensaje);
                return $mensaje;
            }
                $fp = fopen("charlaGlobal.txt", "r");

                while(!feof($fp)) {
                    $linea = fgets($fp);
                    $user=strstr($linea," ",true);
                    $linea=strstr($linea," ");
                    $linea=trim($linea);
                    $linea=expresiones($linea);
                    if ($linea!="") {
                        echo "<b>$user</b> $linea<br>";
                    }
                }
                fclose($fp);
        ?>
        <script type="text/javascript">
            window.onload = function() {
                window.scrollTo(0, document.body.scrollHeight);
            }
        </script>
    </body>
</html>