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
        /*Función que devuelve un array con n números aleatorios entre limite1 y limite2
        (n, limite1, limite2 son parámetros de la función)*/
        $arrayNums = [];
        function numsAleatorios($n,$limite1,$limite2) {
            $array = range(0, $n);
            foreach ($array as &$v) {
            $v = rand($limite1, $limite2);
            }
            echo  implode(" ", $array);
        }
        echo numsAleatorios(10,5,25);

    ?>
</body>
</html>