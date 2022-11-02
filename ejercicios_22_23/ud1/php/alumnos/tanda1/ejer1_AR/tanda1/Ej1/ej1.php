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

        echo date("d\\t\h F Y, l")."<br>";

        $segParaTerminarAnio = mktime (0,0,0,1,1,2023) - time();
        $diasParaTerminarAnio = floor($segParaTerminarAnio / (60*60*24));
        echo "quedan ".$diasParaTerminarAnio." dias para que termine el año";

        $arrPalabras= array("Hola", "que", "tal");
        $txt = implode(" ", $arrPalabras);
        echo $txt."<br>";

        echo str_replace("ñ", "gn", "ñoñeria")."<br>";

        function generadorNum($n, $limite1, $limite2){
            $txt = "";
            for ($i=0; $i < $n; $i++) { 
                $txt .= rand($limite1, $limite2)." -- ";
            }
            return $txt;
        }
        

      
        echo generadorNum(5, 4, 40)."<br>";

        
        function cifrar($cadena){
            $cifrado = ["A" => "20", "H"=>"9R", "M"=>"abcd"];
            $cadena = strtoupper($cadena);
            return str_replace(array_keys($cifrado), array_values($cifrado), $cadena);
        }

        echo cifrar("Hola amo");

    ?>
</body>
</html>
