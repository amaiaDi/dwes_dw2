<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
</head>
<body>
    <main>
        <?php 
            /*6.	Función que recibe un array con días de la semana, un hora de inicio, una hora de fin y un intervalo en minutos y visualiza una tabla horaria así:
                o	El número de filas y columnas será dinámico en función de los parámetros recibidos por la función
                o	En la zona de datos, una de cada 2 filas se sombrea*/
            function crearCalendario($dias_semanas,$hora_inicio,$hora_fin,$inter_min){
                echo "<table border='1'>";
                //cantidad de columnas
                $colums = count($dias_semanas)+1 ;
                $hora_inicio_mins = intval(substr($hora_inicio,0,2))*60 + intval(substr($hora_inicio,strpos($hora_inicio,":")+1));
                $hora_fin_mins = intval(substr($hora_fin,0,2))*60 + intval(substr($hora_fin,strpos($hora_fin,":")+1));
                $restanteHora = $hora_fin_mins -$hora_inicio_mins;
                $fila = $restanteHora / $inter_min +1;
                echo "<tr><td></td>";
                //poner los dias de la semana
                for($i=0; $i < $colums-1; $i++){
                    echo "<td>". $dias_semanas[$i] ."</td>";
                }
                echo "</tr>";
                //poner el horario
                $horaCambio = $hora_inicio;
                for ($i=0; $i < $fila; $i++) { 
                    echo "<tr>";
                   for ($j=0; $j < $colums; $j++) { 
                        if($j != 0){
                            echo "<td></td>";
                        }else{
                            //para poner la hora
                            echo "<td>" . $horaCambio . "</td>";
                            $hora = intval(substr($horaCambio,0,2));
                            $minutos = intval(substr($horaCambio,strpos($horaCambio,":")+1));
                            $minutos = ($minutos + $inter_min);
                            $hora = intval($hora + $minutos/60);
                            $minutos = $minutos %60;
                            if($minutos < 10)
                                if($minutos ==0)
                                    $horaCambio = strval($hora) . ":" . strval($minutos) . "0";
                                else
                                    $horaCambio = strval($hora) . ":" ."0". strval($minutos);
                            else
                                $horaCambio = strval($hora) . ":" . strval($minutos);
                        }
                   }
                   echo "</tr>";
                }
                echo"</table>";
            }
            $dias = array("Mon","Tue","Wen","Thu","Fri");
            crearCalendario($dias,"8:00","15:00",120 );
        ?>
    </main>
</body>
</html>