<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>05</title>
</head>
<body>
    <?php
    function peliculasFavoritas($pelicula)
    {
        $arrPelis = [
            "Unai"=>["Star Wars", "Avengers", "Piratas del Caribe", "Men in Black 1", "Kimetsu no Yaiba"],
            "Sergio"=>["Star Wars", "Piratas del Caribe", "Men in Black 2"],
            "Chej"=>["Star Wars", "Kimetsu no Yaiba", "Lord of the Rings"]
        ];
        $cont = 0;

        while($clave = current($arrPelis))
        {
            if(in_array($pelicula,$arrPelis[key($arrPelis)]))
            {
                $cont++;
            }
            
            next($arrPelis);
        }
        echo "A $cont personas les gusta $pelicula <br>";
        foreach($arrPelis as $nombre=>$peli)
        {
            $random = random_int(0,count($arrPelis[$nombre])-1);
            $random1 = random_int(0,count($arrPelis[$nombre])-1);
            while($random1 == $random)
            {
                $random1 = random_int(0,count($arrPelis[$nombre])-1);
            }
            echo "A $nombre le gusta: $peli[$random] y $peli[$random1] <br>";
        }
              
        
    }
    peliculasFavoritas("Piratas del Caribe");

    ?>
</body>
</html>