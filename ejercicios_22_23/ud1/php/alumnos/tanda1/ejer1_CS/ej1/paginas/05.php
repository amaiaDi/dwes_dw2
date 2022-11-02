<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ej5</title>
</head>
<body>
    <?php

        function ejer5 (){
            $arrMulti = array(array("Jose", "Spiderman 2", "Marvels", "Juana Del Arco"),
                      array("Alfredo", "Pepito 4", "Me aburro 5", "Dos tontos muy tontos"),
                        array("Unai", "Supers", "Batman", "8 Apellidos Vascos"));

            for ($i=0; $i < count($arrMulti); $i++) { 
                echo "Nombre ".$arrMulti[$i][0]."<br>Pelis: ";
                for ($j=1; $j <= 2; $j++) { 
                    echo $arrMulti[$i][$j]."  ";
                }
                echo "<br>";
            }
        }
        ejer5();
    ?>
</body>
</html>