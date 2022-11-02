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
        $arrImagenes = array(
                            "imagenes/gatoUno.PNG",
                            "imagenes/gatoDos.PNG",
                            "imagenes/gatoTres.PNG",
                            "imagenes/gatoCuatro.PNG",
                            "imagenes/gatoCinco.PNG",
                            "imagenes/gatoCinco.PNG",
                            );

        mostrarArr($arrImagenes);
        function mostrarArr($arr){
            $arr = array_values(array_unique($arr));
            $cantImagenes = count($arr);
            
            for ($i=1; $i <= $cantImagenes; $i++) { 
                echo '<td><a href='.$arr[$i-1].'><img src="'.$arr[$i-1].'" width="250" height="200" ></a></td>';
                if($i==3){
                    echo "<br>";
                }
            }
        }
     ?>
</body>
</html>