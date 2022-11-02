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
        $personas = array("Ander" => array("Captain Fantastic", "Un gato callejero llamado Bob", "Planeta del Tesoro"),
                            "Paula" => array("American Beauty", "Captain Fantastic", "300"),
                            "Lake" => array("Planeta del Tesoro", "El niño y la Bestia"));

        function personasConPeliFav($peli, $personas){
            while ($pelisFav = current($personas)){
                if (in_array($peli, $pelisFav, false)){
                    echo key($personas)."\t";
                }
                next($personas);
            }
        }

        function pelisRandom ($personas){
            foreach($personas as $pelis){
                $rand_keys = array_rand($pelis, 2);
                echo $pelis[$rand_keys[0]]."\t".$pelis[$rand_keys[1]]."<br>";
            }
        }

        personasConPeliFav("Planeta del Tesoro", $personas);
        echo "<br>";
        pelisRandom($personas);
                            
    ?>
</body>
</html>