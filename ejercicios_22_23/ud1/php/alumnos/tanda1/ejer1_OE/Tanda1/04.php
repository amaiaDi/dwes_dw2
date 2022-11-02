<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio4</title>
</head>
<body>
    <?php
        /*Función que recibe un array con rutas de imágenes (dentro del proyecto) y las muestra en una tabla, todas ellas con el mismo tamaño.
            -La tabla tiene un máximo de 3 columnas y tantas filas como sean necesarias
            -No deben mostrarse imágenes repetidas
            -Además, cada imagen será un enlace a la propia imagen
        */
        $imagenes = ["imagenes/bordes.png", "imagenes/casa.png", "imagenes/casita.png", "imagenes/reloj.png",];
        $imagenes2 = array_unique($imagenes);
        function cifrar_cadena($imagenesLocal) {
            echo "<table>";
                $count = 0;
                foreach($imagenesLocal as $valor){
                    if($count == 0){
                       echo "<tr>";
                    }
                    echo "<td><a href=$valor><img src=$valor alt='Imagen'></a></td>";
                    if($count == 2){
                        $count = 0;
                        echo "</tr>";
                    }
                    $count++;
                }
                if($count == 1)
                    echo "</tr>";
            echo "</table>";
        }
        cifrar_cadena($imagenes2);
    ?>
</body>
</html>