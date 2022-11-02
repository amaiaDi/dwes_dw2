<!-- EJERCICIO 7. Crea un fichero de texto en una carpeta de tu proyecto que contenga url’s (una por línea).
Haz que tu página visualice los enlaces del fichero (uno por cada url del fichero), 
y que enlacen a las direcciones correspondientes. -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanda 1 - Ejercicio 7</title>
    <?php
        include 'funciones.php';
    ?>
</head>
<body>
    <!-- Lectura de fichero linea a linea -->
    <?php
        $nombre="";
        $enlace="";
        $handle = fopen("enlaces.txt", "r");
        
        echo ("<h1>Enlaces leidos linea a linea del documento</h1></br>");

        // //Abrimos el fichero  y lo recorremos linea por linea para mostrar el nombre u la url del fichero
        // while (!feof($handle)) {
        //     $linea = fgets($handle);
        //     // obtenemos los valores mediante el metodo strstr
        //     $nombre=strstr($linea, ":", true);
        //     $enlace=strstr($linea, ":", false);
        //     $enlace=substr($enlace, 1, strlen($enlace));

        //     echo ("<p>$nombre - <a href='$linea'>$enlace</a></p>");
        // }
        // fclose($handle);

        //Abrimos el fichero  y lo recorremos linea por linea para mostrar el nombre u la url del fichero
        while (!feof($handle)) {
            $linea = fgets($handle);
            // obtenemos los valores mediante el metodo strstr
            $posicionPuntos=strpos($linea, ":");
            $nombre=substr($linea, 0, $posicionPuntos);
            $enlace=substr($linea, $posicionPuntos+1, strlen($linea));

            echo ("<p>$nombre - <a href='$enlace' target='_blank'>$nombre</a></p>");
        }
        fclose($handle);
    ?>
</body>
</html>