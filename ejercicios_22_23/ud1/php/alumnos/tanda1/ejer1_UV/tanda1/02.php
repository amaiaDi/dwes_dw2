<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>02</title>
</head>
<body>
    <?php
    $temperaturas = array(5.9, 20.56, 15.4, 30.45, 38.8, 18.6, 17.3, 19.4, 14.4, 15.9, 10.1, 7.2);
    $media = array_sum($temperaturas)/count($temperaturas);
    echo 'La media redondeada es: ' . round($media) . "<br>";
    echo 'La media truncada es: ' . floor($media) . "<br>";

    sort($temperaturas);
    echo 'Los numeros más bajos son: ';
    for($i=0;$i<5;$i++)
    {
        echo $temperaturas[$i] . ", ";
    }

    echo "<br>";

    rsort($temperaturas);
    echo 'Los numeros más bajos son: ';
    for($i=0;$i<5;$i++)
    {
        echo $temperaturas[$i] . ", ";
    }
    ?>
</body>
</html>
