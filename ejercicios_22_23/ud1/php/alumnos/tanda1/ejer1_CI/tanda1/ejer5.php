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

        

        function verFavoritos($Peli) {
            $nombresPers = array(	
                "Javier" => array("Spider-Man: No Way Home.","La Liga de la Justicia de Zack Snyder.","Cruella","La guerra del mañana","El Escuadrón Suicida"),
                "Adrian" => array("Raya y el último dragón","Shang-Chi y la leyenda de los Diez Anillos","Sin tiempo para morir","El Escuadrón Suicida"),
                "Daniel" => array("Un lugar tranquilo 2","La guerra del mañana","El Escuadrón Suicida")
            );
            $cont=0;
            foreach($nombresPers as $nom => $peliculas) {

                foreach($peliculas as $valor) {
                    if($valor==$Peli) {
                        $cont++;
                    }
                }
                
            }
            return $cont;
        }

        echo verFavoritos("El Escuadrón Suicida");




    ?>
</body>
</html>