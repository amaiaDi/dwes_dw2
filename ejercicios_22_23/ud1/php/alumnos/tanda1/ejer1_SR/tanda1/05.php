<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>05</title>
</head>
<body>
    <?php
        function peliculasFav($pelicula)
        {
            $count = 0;
            $arrPeliculas = [
                'Juan' => ['Star Wars', 'Lord of the Rings', 'Piratas del Caribe'],
                'Alfredo' => ['Harry Potter', 'Fast & Furious', 'Star Wars'],
                'Manolo' => ['Mary Poppins', 'Thor', 'Harry Potter']
            ];
            while(current($arrPeliculas))
            {
                if(in_array($pelicula, $arrPeliculas[key($arrPeliculas)]))
                {
                    $count++;
                }
                next($arrPeliculas);
            }
            foreach ($arrPeliculas as $key => $row){
                $randomIndice = array_rand($arrPeliculas[$key]);
                $randomIndice1 = array_rand($arrPeliculas[$key]);
                while($randomIndice == $randomIndice1)
                {
                    $randomIndice1 = array_rand($arrPeliculas[$key]);
                }
                echo "A $key le gusta $row[$randomIndice] y $row[$randomIndice1] </br>";
            }
            return $count;
        }
        $peliFav = 'Star Wars';
        $num = peliculasFav($peliFav);
        echo "$num personas tienen de favorita $peliFav";
    ?>
</body>
</html>