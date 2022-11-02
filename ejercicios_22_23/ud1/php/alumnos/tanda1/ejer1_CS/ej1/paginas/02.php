<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejer 2</title>
</head>
<body>
    <?php
        $suma = 0;
        $cont = 0;
        $media = 0;
        $array = array(20,25,18,45,23,17,19,23,26,30,22);
        $suma = array_sum($array);
        $cont = count($array);
        echo $cont;
        echo "<br>";
        echo $suma;
        echo "<br>";
        $media = $suma/$cont;
        echo "La media es: ",$media;
    ?>
</body>
</html>