<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 iniciacion PHP</title>
    <?php
        include 'funciones.php';
    ?>
</head>
<body>
    
<!-- Enlaces a los ficheros php de los ejercicios  -->
    <h1>Ejercicio 1 - Enlaces</h1>
    <?php 
        // 1ª FORMA DE HACERLO
        //Creamos los enlaces de forma manual y se muestra por pantalla
        echo "<h3>Ejercicio 1 - 1ª forma de obtener enlaces</h3>";
        echo "<a href='ejer1.php'> Ejercicio 1 </a></br>";
        echo "<a href='ejer2.php'> Ejercicio 2 </a></br>";
        echo "<a href='ejer3.php'> Ejercicio 3 </a></br>";
        echo "<a href='ejer4.php'> Ejercicio 4 </a></br>";
        echo "<a href='ejer5.php'> Ejercicio 5 </a></br>";
        echo "<a href='ejer6.php'> Ejercicio 6 </a></br>";
        echo "<a href='ejer7.php'> Ejercicio 7 </a></br>";

        //2ª FORMA DE HACERLO
        echo "<h3>Ejercicio 1 - 2ª forma de obtener enlaces</h3>";
        
        //Se añaden los nombres de fichero en un array 
        $rutas= array("ejer1.php","ejer2.php","ejer3.php","ejer4.php","ejer5.php","ejer6.php",'ejer7.php');
        //se recorre con un bucle para la creación del enlace en cada iteración
        for ($i=0;$i<7;$i++){
            echo "<a href='$rutas[$i]'> Ejercicio ".($i+1)." </a></br>";
        }

        //3ª FORMA DE HACERLO
        echo "<h3>Ejercicio 1 - 3ª forma de obtener enlaces</h3>";

        //Llamamos al metodo que obtiene el listado de ficheros
        $rutasFicheros = obtenerNombresFicherosDesdeCarpeta('*');
        for ($j=0;$j<count($rutasFicheros);$j++){
            // Se comprueba que el nombre del fichero tenga el sufijo ejer para poder mostrarlo entendiendo que solo seran ejercicios los ficheros con ese nombre
            if (strstr($rutasFicheros[$j],"ejer")){
                //Creamos los enlaces y los mostramos por pantalla
                echo "<a href='$rutasFicheros[$j]'> Archivo $rutasFicheros[$j] </a></br>";
            }
        }

    ?>
</body>
</html>