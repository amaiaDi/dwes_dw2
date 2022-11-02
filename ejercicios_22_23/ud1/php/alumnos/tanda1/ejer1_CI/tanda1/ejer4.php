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
            echo "<table>";
            $rutas = array("/dwes/tanda1/imagenes/camara.jpg","/dwes/tanda1/imagenes/movil.jpg",
            "/dwes/tanda1/imagenes/camara.jpg","/dwes/tanda1/imagenes/portatil.jpg","/dwes/tanda1/imagenes/tierra.jpg");
            function verImagenes($verRutas) {
                $rutasUnicas = array_unique($verRutas);
                $cont=1; 
                foreach ($rutasUnicas as $v) {
                    if($cont == 1) {
                        echo "<tr>";
                    }
                        echo "<td><a href=$v><img src=$v alt='Imagen' width=100 height=100></img></a></td>";
                    if($cont == 3){
                        $cont=1;
                        echo "</tr>";
                    }
                    $cont++;
                }
            }
            echo verImagenes($rutas);
            echo "</table>";
        ?>
    
</body>
</html>