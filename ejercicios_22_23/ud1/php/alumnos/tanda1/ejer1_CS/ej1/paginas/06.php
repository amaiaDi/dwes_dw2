<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ej6</title>
</head>
<body>
    <?php
        $arrDias = array("Lun", "Mar", "Mie", "Jue", "Vie", "Sab", "Dom");
        $hora= "8:00";
        $horaFin = "15:00";
        $intervalo = 60;
        function ejer6 ($arrDias, $hora, $horaFin, $int){
            $sw = -1;
            echo "<table border=1>";
            echo "<tr><td> </td>";
            for ($i=0; $i < count($arrDias); $i++) { 
                echo "<td>{$arrDias[$i]}</td>";
            }
            echo "</tr>";
            $arrHoras = deVuelveHoras($hora,$horaFin,$int);
            for ($i=0; $i < count($arrHoras); $i++) { 
                if ($sw == 1) {
                    echo "<tr style='background-color:light grey'>";
                    $sw = -1;
                }elseif ($sw == -1) {
                    echo "<tr>";
                    $sw = 1;
                }
                echo "<td>{$arrHoras[$i]}</td>";
                for ($j=0; $j < (count($arrHoras)-1); $j++) { 
                    echo "<td></td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }

        function deVuelveHoras($horaIni,$horFin,$int){
            $hora = 7;
            $mins = 0;
            $hFin = 15;
            $pos = 0;
            $arrResult = array("0");
            while ($hora < $hFin) {
                if ($mins == 0) {
                    $mins += $int;
                    if ($mins >= 60) {
                        $hora+=1;
                        $mins = $mins - 60;
                        if ($mins == 0) {
                            $arrResult[$pos] = "{$hora}:{$mins}0";
                        }else {
                            $arrResult[$pos] = "{$hora}:{$mins}"; 
                        }
                    }else {
                        $arrResult[$pos] = "{$hora}:{$mins}";
                    }
                    
                }
                $pos+=1;
            }
            return $arrResult;
        }
        ejer6($arrDias,$hora,$horaFin,$intervalo);
    ?>
</body>
</html>