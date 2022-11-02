<?php
$weekTemperatures=[32,29,29,26,23,22,25];
$avg=array_sum($weekTemperatures)/count($weekTemperatures);
$avgRound=round($avg);
$avgTrunc=bcdiv($avg, 1);
echo "<p>Media: ".$avg."</p>";
echo "<p>Media redondeada: ".$avgRound."</p>";
echo "<p>Media truncada: ".$avgTrunc."</p>";

sort($weekTemperatures);
$lowTemperatures=array_slice($weekTemperatures, 0, 5);
echo "<p>Temperaturas más bajas: ".join(" ", $lowTemperatures)."</p>";
rsort($weekTemperatures);
$highTemperatures=array_slice($weekTemperatures, 0, 5);
echo "<p>Temperaturas más altas: ".join(" ", $highTemperatures)."</p>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>
<body>
    
</body>
</html>