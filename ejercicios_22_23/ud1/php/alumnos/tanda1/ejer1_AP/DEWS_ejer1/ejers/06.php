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
        function tablaSemana($arr, $horaIni, $horaFin, $int) {
            $horasTotal=$horaFin-$horaIni;
            $filasTotal=$horasTotal*60/$int;
            echo "<table border='2px' style='border-collapse: collapse'>";
            echo "<tr>";
            echo "<th></th>";
            escribirDia($arr);
            echo "</tr>";
            escribirHora($arr, $filasTotal, $horaIni, $int);
            echo "</table>";
        }

        function escribirDia($arr) {
            foreach($arr as &$dia) {
                echo "<th>$dia</th>";
            }
        }

        function escribirHora($arr, $filasTotal, $horaIni, $int) {
            $mins=0;
            for ($i = 0; $i <= $filasTotal; $i++) {
                echo "<tr>";
                echo "<th> " . dameHoraFormato($mins,$horaIni) . "</th>";
                for ($j = 1 ; $j <= count($arr) ; $j++) {
                    echo "<td></td>";
                }
                echo "</tr>";

                $mins=$mins+$int;
            }
        }

        function dameHoraFormato($mins, $horaIni) {
            $horaFormato=$horaIni*60+$mins;
            if ($horaFormato%60<10) {
                return floor($horaFormato/60) . ":" . $horaFormato%60 . "0";
            }
            else {
                return floor($horaFormato/60) . ":" . $horaFormato%60;
            }
            
        }

        tablaSemana(array("Lun","Mie"),8,15,40);
    ?>
    <br></br>
    <a href="../index.php">Volver</a>
</body>
</html>