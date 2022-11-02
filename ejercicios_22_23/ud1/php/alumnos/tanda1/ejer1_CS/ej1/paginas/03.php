<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejer 3</title>
</head>
<body>
    <?php
        $arrCiudades = array("Vitoria", "Pamplona", "Malaga", "Logroño", "Madrid", "Barcelona", "Malaga", "Vitoria", "Pamplona", "Madrid");
        $aux = array();

        echo "<ol>";
        for ($i=0; $i < count($arrCiudades); $i++) {
            if (!in_array($arrCiudades[$i], $aux)) {
                $aux[$i] = $arrCiudades[$i];
                echo "<li>".$aux[$i]."</li>";
            }

        }
        echo "</ol>";
    ?>
</body>
</html>