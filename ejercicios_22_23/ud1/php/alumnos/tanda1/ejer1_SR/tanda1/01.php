<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>01</title>
</head>
<body>
    <?php 
        echo date("dS F Y, l");
        echo "<br>";

        if(date("L") == 0){
            echo 365-date("z");
        }
        else{
            echo 364-date("z");
        }
        echo "<br>";
   
        $array = ['buenos','dias','don','alfredo'];
        for($c = 0; $c < count($array); $c++){
            echo $array[$c];
        }
        echo "<br>";

        $enies = 'asdñasdagfñgewgñwffswñasdññññasdasdññ';
        echo str_replace('ñ', 'gn', $enies);
        echo "<br>";

        function random($n, $limite1, $limite2){
            $ran = [];
            for($c = 0; $c < $n; $c++){
                $ran[$c] = mt_rand($limite1,$limite2);
            }
            return $ran;
        };
        $ran = random(5, 10, 100);
        for($c = 0; $c < count($ran); $c++){
            echo $ran[$c];
            echo "\t";
        }
        echo "<br>";

        $sincifrar = "HOLA AMO";
        function cifrar($cadena){
            $cifrado = array(
                "A" => "20",
                "H" => "9R",
                "M" => "abcd"
            );
            while(current($cifrado)){
                $cadena = str_replace(key($cifrado),$cifrado[key($cifrado)], $cadena);
                next($cifrado);
            }
            return $cadena;
        };
        echo cifrar($sincifrar);
    ?>
</body>
</html>