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
        $arr = array(array("Ander","Spiderman","Doctor Strange","Interstellar"),array("Pablo","Hulk", "Jurassic Park", "Fast and Furious"));

        function verArr($arr) {
            for ($i = 0; $i < count($arr); $i++) {
                for ($j = 0; $j < count($arr[$i]); $j++) {
                    echo $arr[$i][$j] . " ";
                }
                echo "<br>";
            }
        }

        function buscarPeli($arr,$peli) {
            echo "A estas personas les gusta la pelicula: " . $peli . "<br>";
            for ($i = 0; $i < count($arr); $i++) {
                for ($j = 1; $j < count($arr[$i]); $j++) {
                    if ($arr[$i][$j]!=null) {
                        if (strcmp($peli,$arr[$i][$j])==0) {
                            echo $arr[$i][0] . " ";
                            break;
                        }
                    }
                }
            }
        }

        function dosFavsAle($arr) {

            for ($i = 0; $i < count($arr); $i++) {
                    echo "Peliculas favoritas de " . $arr[$i][0] . ": ";
                    $numAle1 = random_int(1,count($arr[$i])-1);
                    $numAle2;
                    do {
                        $numAle2 = random_int(1,count($arr[$i])-1);
                    } while ($numAle1==$numAle2);
                    echo $arr[$i][$numAle1] . " " . $arr[$i][$numAle2];
                    echo "<br>";
            }
        }

        
        verArr($arr);
        echo "<br>";
        buscarPeli($arr,"Hulk");
        echo "<br><br>";
        dosFavsAle($arr);

    ?>
    <br></br>
    <a href="../index.php">Volver</a>
</body>
</html>