<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio6</title>
</head>
<body>
    <?php
        $dia =["Lun", "Mar", "Mie", "Jue", "Vie", "Sab", "Dom"];
        
        function crearHorario($dias, $horaIni, $horaFin, $intervalo){
            list($hi, $mi) = explode(":", $horaIni);
            list($hf, $mf) = explode(":", $horaFin);
            $inicioMin = intval($hi)*60+intval($mi);
            $finMin = intval($hf)*60+intval($mf);
            echo "<table border = 1>";
            echo "<tr>";
            echo "<td></td>";
            foreach($dias as $d){ 
                echo "<td>$d</td>";
            }
            echo "</tr>";
            for($i = $inicioMin; $i<=$finMin; $i = $i+$intervalo){
                echo "<tr>";
                $cero = "";
                if($i%60<10)
                    $cero = "0";
                $hora = (int)($i/60).":".$cero.($i%60);
                echo "<td>$hora</td>";
                for($j = 0; $j<count($dias); $j++){
                    echo "<td></td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
        crearHorario($dia, "8:00", "15:00", 30);
    ?>
</body>
</html>