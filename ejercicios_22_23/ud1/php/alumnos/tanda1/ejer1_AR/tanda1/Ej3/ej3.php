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
        $ciudades= array("Vitoria", "Madrid", "Barcelona", "Valencia", "Madrid", "Valencia", "Murcia", "Vigo", "Barcelona", "Vitoria");

        echo "<ol>";
        
        $ciudades = array_unique($ciudades);
        foreach ($ciudades as $ciudad) {
            echo "<li>".$ciudad."</li>";
        }

        echo "</ol>";
    ?>
</body>
</html>