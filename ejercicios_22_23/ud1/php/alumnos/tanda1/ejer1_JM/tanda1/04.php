<?php

// 4.	Función que recibe un array con rutas de imágenes (dentro del proyecto) y las muestra en una tabla, todas ellas con el mismo tamaño.
// -	La tabla tiene un máximo de 3 columnas y tantas filas como sean necesarias
// -	No deben mostrarse imágenes repetidas
// -	Además, cada imagen será un enlace a la propia imagen

$img_files = glob("images/*.*");

array_push($img_files, "images/auriculares.webp");
$img_files = array_values(array_unique($img_files));

echo "<table><tr>";

$count = 1;
foreach($img_files as $img){
    if($count < 4){
        echo "<td><a href='$img'><img src='$img' width='100' height='100'/></a></td>";
    }
    else{
        echo "</tr><tr>";
        $count = 0;
    }
    $count++;
}

echo "</tr></table>";


?>