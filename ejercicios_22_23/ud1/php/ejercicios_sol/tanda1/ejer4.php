<!-- 4.	Función que recibe un array con rutas de imágenes (dentro del proyecto) y las muestra en una tabla, todas ellas con el mismo tamaño.
o	La tabla tiene un máximo de 3 columnas y tantas filas como sean necesarias
o	No deben mostrarse imágenes repetidas
o	Además, cada imagen será un enlace a la propia imagen -->
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=EJERCICIO 4, initial-scale=1.0">
        <title>EJERCICIO 4</title>
    </head>
    <body>
    <h1>EJERCICIO 4</h1>
    <?php
        $rutaImagenes=array("imagenes/frambuesas.jpg","imagenes/fresas.jpg","imagenes/frutorojos.jpg","imagenes/frambuesas.jpg","imagenes/naranjas.jpg", "imagenes/peras.jpg", "imagenes/uvas.jpg","imagenes/macedonia.jpg");
        $posicionImagen=0;
        $imagenesPagina=array();

        //creamos la tabla
        echo ("<table>");
        //para cada elemento del array de imagenes
        for($elementos=0;$elementos<count($rutaImagenes) && $posicionImagen<count($rutaImagenes);$elementos++){
            
            //creamos fila cada multiplo de 3
            if($elementos%3===0)
                echo("<tr>");

            //creamos 3 columnas y añadimos imagenes en forma de enlace
            for($columna=0;$columna<3;$columna++){
                
                //Si el elemento posicion de imagen es menor que el numero de elementos 
                //Creamos las celdas e incluimos las imagenes aen forma de enlace
                if($posicionImagen<count($rutaImagenes)){

                    $imagen=$rutaImagenes[$posicionImagen];

                    //Si el array no contiene ya la ruta de la imagen, creamos la celda
                    //introducimos el enlace con la imagen y añadimos el elemento en el array de imagenes
                    //para controlar que no se repita
                    if(!in_array($imagen,$imagenesPagina)){
                        
                        echo ("<td>");
                        echo ("<a href='$imagen'><img src='$imagen' ></a>");
                        echo ("</td>");
                        $posicionImagen++;
                    
                        array_push($imagenesPagina,$imagen);

                    //Si el array contiene la imagen, no introducimos nada
                    }else{
                        //en el caso de que sea la ultima columna aumentaremos la posicion de la imagen para no repetir enlace
                        if($columna==2){
                            $posicionImagen++;
                        }
                    }
                //Si el elemento posicion de imagen es mayor que el numero de elementos 
                //creamos las celdas vacias para no descuadrar la fila y con ello la tala
                }else{
                    echo ("<td></td>");
                }
            }

            //para los multiplos de 3 cerramos fila
            if($elementos%3===0){
                echo ("</tr>");
            }
        }
        //cerramos tabla
        echo ("</table>");
    ?>
    </body>
</html>