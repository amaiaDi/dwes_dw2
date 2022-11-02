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
        $arrTemp = array(23,32,15,26,22,20,17,25,37,40,34,24,10,7,11);


        $media = array_sum($arrTemp) / count($arrTemp);
        echo round($media, 0, PHP_ROUND_HALF_UP)." //// ".floor($media)."<br>";

        sort($arrTemp);
        echo "las 5 temperaturas mas bajas: ";
        for ($i = 0; $i < 5; $i++){
            echo $arrTemp[$i]." -- ";
        }
        echo "<br>";

        rsort($arrTemp);
        echo "las 5 temperaturas mas altas: ";
        for ($i = 0; $i < 5; $i++){
            echo $arrTemp[$i]." -- ";
        }

    ?>
</body>
</html>