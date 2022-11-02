<!-- 3.	Crea un array con 10 nombres de ciudades, que puede contener repetidos.
Visualízalo, en forma de lista numerada y sin repetidos. -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXAMEN 3</title>
</head>
<body>
    <?php
        $arrayCiudades=array("Madrid", "Bilbao" , "Vitoria" , "Oviedo", "Madrid", "Barcelona", "Jaen", "Cadiz", "Bilbao");
        $ciudadesMostradas=array();
        //Para cada elment del array
        foreach($arrayCiudades as $valor){

            //comprobamos si ya existe la ciudad en el array de datos mostrados
            if(!in_array($valor,$ciudadesMostradas)){
                //Mostramos la ciudad
                echo("$valor,");
                //añadimos la ciudad al array de control de imagenes mostradas
                array_push($ciudadesMostradas,$valor);
            }
        }
    ?>
</body>
</html>
