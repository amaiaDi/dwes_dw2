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
        $temperaturas = [22.3, 17.7, 30.5, 28.2, 24.7, 10.2, 15.4, 18.3, 20.4, 22.2];
        $suma = array_sum($temperaturas);
        $cont = count($temperaturas);
        $media = $suma/$cont;
        echo round($media);
        echo '<br/>';
        echo intval($media);
        echo '<br/>';
        sort($temperaturas);

        for($i = 0; $i < 2; $i++)
        {
            for($c = 0; $c < 5; $c++)
            {
                echo $temperaturas[$c] . ' ';
            }
            echo '<br/>';
            rsort($temperaturas);
        }
    ?>
</body>
</html>