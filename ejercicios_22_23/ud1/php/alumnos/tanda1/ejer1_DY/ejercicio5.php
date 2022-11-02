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
     /*5.	Función que:
                o	Define un array de arrays, representando cada posición/fila una correspondencia de nombre de persona con sus películas preferidas
                o	Recibe un nombre de película y devuelve cuántas personas la tienen entre sus favoritas
                o	Muestra, por cada persona, 2 de sus películas favoritas al azar*/
        
        ejercicio5("cars");
        function ejercicio5($nomPeli){
            $matrPelis = array(
                "Iker" => array("Txipi manostijeras","Codigo Piojo","cars"),
                "Adrian" => array("cars","Abella danger 2","Documental de cristiano ronaldo"),
                "Amaia" => array("php 1","php contraataca", "el regreso de php"),
                    );
            /**Comprobar cuantas personas comparten la pelicula cars */
            $contPers = 0;
            foreach ($matrPelis as $key){
                if($key[0] == $nomPeli){
                    $contPers++;
                }else if($key[1] == $nomPeli){
                    $contPers++;
                }else if($key[2] == $nomPeli){
                    $contPers++;
                }
            }
            echo($contPers." personas comparten la pelicula ".$nomPeli);
            echo "<br>";
            echo "<br>";
            /**Mostrar dos peliculas aleatorias por persona */
            foreach ($matrPelis as $key){
                $numAle1 = mt_rand(0,2);
                $numAle2 = mt_rand(0,2);
                while($numAle1==$numAle2){
                    $numAle2 = mt_rand(0,2);
                }
                echo $key[$numAle1]."<br>";
                echo $key[$numAle2]."<br>";
                echo "<br>";
            }
        }
     ?>
</body>
</html>
