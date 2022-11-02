<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
</head>
<body>
    <?php
    /*
        4.	Función que recibe un array con rutas de imágenes (dentro del proyecto) y las muestra en una tabla, todas ellas con el mismo tamaño.
            o	La tabla tiene un máximo de 3 columnas y tantas filas como sean necesarias
            o	No deben mostrarse imágenes repetidas
            o	Además, cada imagen será un enlace a la propia imagen */
        function crearTablaImagenes($array){
            $array =  array_unique($array);
            $cont = 0;
            echo "<table><tr>";
            foreach ($array as $src_img) {
                if($cont == 3){
                    $cont = 0;
                    echo "</tr><tr>";
                }
                echo "<td><a href='" . $src_img ."'><img src="."'$src_img' alt='". substr($src_img,strpos($src_img,"/")+1) ."' width='256px' height='256px'></td>";
                $cont++;
            }
            echo "</tr></table>";
        }
        $path_img = array("../imagenes/blogger.png","../imagenes/facebook.png","../imagenes/github.png","../imagenes/google.png","../imagenes/HTML5.png","../imagenes/intel.png","../imagenes/sharex_logo.webp","../imagenes/twitter.png","../imagenes/youtube.png","../imagenes/blogger.png");
        crearTablaImagenes($path_img);
    ?>
</body>
</html>