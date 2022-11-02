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
        $arr = array("Lun","Mar","Mie","Jue","Vie","Sab","Dom","8:00","15:30","180");
        ejercicio6($arr);
     function ejercicio6($arr){
        $tabla = "<table><tr>";
        //Primera fila
        $tabla = $tabla."<td></td>";
        for ($i=0; $i < 7; $i++) { 
            $tabla = $tabla."<td>$arr[$i]</td>";
        }
        $tabla = $tabla."</tr>";
        //Resto de la tabla
        $horaActual = explode(":", $arr[7]);
        $horaFinal = explode(":", $arr[8]);
        $intervalo = intval($arr[9]);
        $arrSuma = horaMins($intervalo);
        $arrSuma = explode(":", $arrSuma[0]);
        while($horaActual[0] < $horaFinal[0] || ($horaActual[0] == $horaFinal[0] && $horaActual[1] <= $horaFinal[1]) ){
            $tabla = $tabla."<tr><td>$horaActual[0]:$horaActual[1]</td>";
            for ($i=0; $i < 7; $i++) { 
                $tabla = $tabla."<td>0</td>";
            }
            $horaActual[0] = $horaActual[0] + $arrSuma[0];
            $horaActual[1] = $horaActual[1] + $arrSuma[1];
            $horaActual = controlarHora($horaActual);
            $tabla = $tabla."</tr>";
        }
        $tabla = $tabla."</table>";
        //Mostrar tabla
        echo $tabla;
     }

     //funcion para controlar que los minutos no superan los 59 en el array de horaActual
     function controlarHora($arr){
        if($arr[1] >= 60){
            $hora = $arr[0];
            $minutos = 0;
            $intervalo = $arr[1];
            while($intervalo >= 60){
                //$hora = $hora + bcdiv($intervalo/60, '1',0);
                $hora++;
                $minutos = $intervalo%60;
                $intervalo = $intervalo - 60;
            }
            $arr[0] = $hora;
            $arr[1] = $minutos;
        }  
        return $arr;
    }

     //pasar de minutos a un array con hora y minuto
     function horaMins($intervalo){
        $hora = 0;
        $minutos = 0;
        if($intervalo >= 60){
            while($intervalo >= 60){
                $hora++;
                $minutos = $minutos + $intervalo%60;
                $intervalo = $intervalo - 60;
            }
            $arrHora = array($hora.":".$minutos);
        }else{
            $minutos = $intervalo;
            $arrHora = array($hora.":".$minutos);
        }
        return $arrHora;
     }
     ?>
</body>
</html>