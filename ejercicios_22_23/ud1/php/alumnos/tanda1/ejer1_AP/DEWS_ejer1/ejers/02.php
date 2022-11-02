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
    $temps = array(34,21,45,23,34,23);
    $avg = array_sum($temps)/count($temps);
    echo round($avg);
    echo "<br>";
    sort($temps);
    $cont=0;
    while($cont<5) {
        echo $temps[$cont] . " ";
        $cont++;
    }
    echo "<br>";
    rsort($temps);
    $cont=0;
    while($cont<5) {
        echo $temps[$cont] . " ";
        $cont++;
    }
?>
<br></br>
<a href="../index.php">Volver</a>
</body>
</html>