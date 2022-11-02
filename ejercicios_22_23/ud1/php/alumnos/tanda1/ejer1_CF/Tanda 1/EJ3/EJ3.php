<?php
$cities=
[
    "Madrid",
    "Barcelona",
    "Sevilla",
    "Toledo",
    "Barcelona",
    "Valencia",
    "Toledo",
    "Zaragoza",
    "Barcelona",
    "Madrid"
];
$cities=array_unique($cities);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
</head>
<body>
    <ol>
        <?php
        foreach($cities as $city)
            echo "<li>".$city."</li>";
        ?>
    </ol>
</body>
</html>