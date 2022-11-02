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
    echo date("dS F Y , l");
    echo "<br>";
    if(date("L")==0)
    {
        echo 365-date("z");
    }
    else
    {
        echo 364-date("z");
    }

    echo "<br>";

    $palabras = array("Hola", ", ", "Que ", "tal ", "estas", "?");
    for($i=0; $i<count($palabras); $i++)
    {
        echo $palabras[$i];
    }

    echo "<br>";
    $enie = 'eñeddñdññfdasñfñdasfñasfñdñasfñ';
    echo $enie;

    echo "<br>";
    $enie = str_replace('ñ','gn', $enie);
    echo $enie;

    echo "<br>";
    function random($n, $limit1, $limit2)
    {
        for($i=0;$i<$n;$i++)
        {
            echo random_int($limit1, $limit2);
            echo "\t";
        }
    }

    echo random(5, 10, 100);

    echo "<br>";
    
    function cifrar($str)
    {
        $cifrado = array(
            "A" => "20",
            "H" => "9R",
            "M" => "abcd"
        );
        
        while($clave = current($cifrado))
        {
            $str = str_replace(key($cifrado),$cifrado[key($cifrado)],$str);
            next($cifrado);
        }

        echo $str;
    }

    echo cifrar('HOLA AMO');

    ?>
</body>
</html>