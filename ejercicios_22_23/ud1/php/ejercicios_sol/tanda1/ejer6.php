<!-- EJERCICIO 6.	Función que recibe un array con días de la semana, un hora de inicio, una hora de fin
y un intervalo en minutos y visualiza  una tabla horaria así: -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/estilos.css">
    <title>Tanda 1 - Ejercicio 6</title>
    <?php
        include 'funciones.php';
    ?>
</head>
<body>
    <table>
        <?php

            // Inicializamos las variables, al estar fuer a de funciones se trata de variables globales
            $arrayDias=array("Lun","Mar","Mie","Jue","Vie","Sab","Dom");
            $horaInicio=8;
            $horaFin=16;
            $intervaloMinutos=30;

            //Ejemplo 1: Definicion de funcion para visualizar tabla horaria con 4 parametros de entrada y 0 de salida
            // Recibe los elementos como parametros de la funcion
            visualizarTablaHorariaRecibeParametros($arrayDias, $horaInicio, $horaFin, $intervaloMinutos);

            //Version 2: Definicion de funcion para visualizar tabla horaria con 4 parametros de entrada y 0 de salida
            //Utiliza las variables globales sin recibirlas por parametr
            //visualizarTablaHorariaNoRecibeParametrosUsaGlobales();

            //Version 3: Definicion de funcion para visualizar tabla horaria sin parametros de entrada y con variables locales
            //  visualizarTablaHorariaSinParametrosVariablesLocales();
  

        ?>
    </table>
</body>
</html>

