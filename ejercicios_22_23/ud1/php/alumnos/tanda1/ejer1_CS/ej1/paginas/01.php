<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>01</title>
</head>
<body>
    <?php 
            echo date("dS F Y ,l"); 
            echo "<br>";
            echo "Los días que quedan para terminar el año son: ";
            echo 365 - date("z"); 
            echo "<br>";
            $arrNombres = array("Alfredo", "son majos", "y", "Ander");
            echo $arrNombres[0], " " ,$arrNombres[2], " ", $arrNombres[3], " ", $arrNombres[1], ".";
            echo "<br>";
            $cadena = "ññññññññññññññññññhlgkñswhksjhsññ";
            echo $cadena;
            echo "<br>";
            $cadena = str_replace("ñ", "gn", $cadena);
            echo $cadena;
            echo "<br>";
            $arrNums = array();
            function devuelveArray($limite1, $limite2, $n){
                $arrResult = array();
                for ($i= 0; $i < $n; $i++) { 
                    $arrResult[$i] = random_int($limite1,$limite2);
                }
                return $arrResult;
            }
            $arrNums = devuelveArray(1,10,3);
            for ($i=0; $i < count($arrNums); $i++) { 
                echo $arrNums[$i]." ";
            }
    ?>
</body>
</html>