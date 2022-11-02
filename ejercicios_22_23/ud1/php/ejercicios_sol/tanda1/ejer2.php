<!-- 2.	Crea un array con las temperaturas de varios días de un mes y lo muestra 
Calcula la media (sin utilizar un bucle) y visualízala de 2 maneras: redondeada y truncada
Visualiza las 5 temperaturas más bajas y las 5 más altas
     (Dispones de las funciones array_sum, count, sort, rsort, ………) -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EJERCICIO 2</title>
</head>
<body>
    <?php
        include 'funciones.php';
        // echo "<h2>Recorrido array asociativo foreach</h2>"; 
        // $temps=array("L"=>30,"M"=>25, "X"=>29.5);
        // $temps["J"]=30;
        // $temps["V"]=18;
        
        $temps=crearArrayTemperaturasAleatorias(30);
        foreach ($temps as $dia => $temp){
         echo "<p>Dia $dia: $temp grados</p>";
        }

        // Calcula la media (sin utilizar un bucle) y visualízala de 2 maneras: redondeada y truncada
        $media=array_sum($temps)!=0?array_sum($temps)/count($temps):"0";
        echo "<p>La media de temperatura de la semana es:</p>".$media."</br>";
        echo "<p>La media REDONDEADA es:</p>".round($media)."</br>";
        echo "<p>La media TRUNCADA es:</p>".round($media,2)."</br>";

        // Visualiza las 5 temperaturas más bajas y las 5 más altas
        //ordenamos de menor a mayor y mostramos las 5 mas bajas
        echo "<p>Las 5 temperaturs mas bajas del mes son:</p></br>";
        sort($temps);
        echo obtenerDatosArrayConComas($temps,5);
       //Ordenamos de Mayor a menor y mostramos las 5 mas altas
        echo "<p>Las 5 temperaturs mas altas del mes son:</p></br>";
        rsort($temps);
        echo obtenerDatosArrayConComas($temps,5);

    ?>
</body>
</html> 
