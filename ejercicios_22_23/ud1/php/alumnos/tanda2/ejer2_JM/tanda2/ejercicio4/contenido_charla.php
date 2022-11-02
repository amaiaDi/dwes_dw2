<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="2">
</head>
<body>
    <?php
    $arr_palabras_ofensivas = [];
    $handle = fopen("txt/palabras_ofensivas.txt","r");
    while(!feof($handle)){
        $palabra = fgets($handle);
        array_push($arr_palabras_ofensivas, $palabra);
    }
    fclose($handle);
    function reemplazarOfensiva($palabra){
        $reemplazo = "";
        for($i=0; $i<strlen($palabra); $i++){
            $reemplazo .= "*";
        }
        return $reemplazo;
    }

    

    $handle = fopen("txt/charla.txt","r");
    while(!feof($handle)){
        $linea = fgets($handle);
            $linea = str_replace(":)","🙂",$linea);
            $linea = str_replace(":(","😠",$linea);
            for($i=0; $i<count($arr_palabras_ofensivas); $i++){
                $linea = str_replace($arr_palabras_ofensivas[$i],reemplazarOfensiva($arr_palabras_ofensivas[$i]),$linea);
            }
            echo "$linea";
            echo "<br>";
        }
        fclose($handle);
    ?>
    <script type="text/javascript">
        window.onload = function() {
        window.scrollTo(0, document.body.scrollHeight);
        }
    </script>

</body>
</html>