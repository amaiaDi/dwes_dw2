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
            function crearTabla($dias, $horaIni, $horaFin, $inter){
                list($horaI, $minI) = explode(":", $horaIni);
                list($horaF, $minF) = explode(":", $horaFin);
                $iniMin = intval($horaI)*60+intval($minI);
                $fMin = intval($horaF)*60+intval($minF);
                echo "<table border = 1>";
                echo "<tr>";
                echo "<td></td>";
                foreach($dias as $dia){ 
                    echo "<td>$dia</td>";
                }
                echo "</tr>";
                for($col = $iniMin; $col<=$fMin; $col = $col+$inter){
                    echo "<tr>";
                    $cero = "";
                    if($col%60<10)
                        $cero = "0";
                    $hora = (int)($col/60).":".$cero.($col%60);
                    echo "<td>$hora</td>";
                    for($fil = 0; $fil<count($dias); $fil++){
                        echo "<td></td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            }
            $semana = array("Lun","Mar","Mie","Jue","Vie","Sab","Dom");
            crearTabla($semana,"8:00","13:00",60)
    ?>
</body>
</html>