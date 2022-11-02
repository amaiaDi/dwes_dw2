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
    //Función que recibe un array con rutas de imágenes (dentro del proyecto) y las muestra en una 
    // tabla, todas ellas con el mismo tamaño.
        //La tabla tiene un máximo de 3 columnas y tantas filas como sean necesarias
        //No deben mostrarse imágenes repetidas
        //Además, cada imagen será un enlace a la propia imagen

        $enlaces=["imagenes/casa.png","imagenes/casa.png","imagenes/movil.png","imagenes/portatil.png","imagenes/casita.png","imagenes/casita.png"];
        $enlaces2=array_unique($enlaces);
        function crear_tabla($enla){
            $cont=0;
            echo('<table>');
            foreach($enla as $valor){
                if($cont==0){
                echo("<tr>");
                }

                echo("<td><a href='$valor'><img src='$valor' alt='#'></a></td>");


                if($cont==2){
                    echo("</tr>");
                    $cont=0;
                }
                $cont++;
            }
            if($cont==1 || $cont==2){
                echo("</tr>");
            }
            echo("</table>");
        }
        crear_tabla($enlaces2);
    ?>
</body>
</html>