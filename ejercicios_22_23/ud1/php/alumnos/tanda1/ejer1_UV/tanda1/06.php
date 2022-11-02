<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>06</title>
</head>
<body>
    <?php

    function tablaHoraria($dias, $hora_ini, $hora_fin, $intervalo)
    {
        echo "<table border=1>
                <tr>
                    <td/>";
        for($i=0;$i<count($dias);$i++)
        {
            echo "<td>$dias[$i]</td>";
        }
        echo "</tr>";

        $hora_ini_seg = strtotime($hora_ini -> format("H:i"));
        $hora_fin_seg = strtotime($hora_fin -> format("H:i"));
        $sw = 1;
        while($hora_ini_seg <= $hora_fin_seg)
        {
            if($sw==(-1))
            {
                echo "<tr style='background-color:lightgrey'>";
            }
            else
            {
                echo "<tr>";
            }
            $sw*=-1;
            
            echo "<td>" . $hora_ini -> format("H:i") . "</td>";
            $hora_ini -> modify("+$intervalo minute");
            $hora_ini_seg = strtotime($hora_ini -> format("H:i"));
            for($i=0;$i<count($dias);$i++)
            {
                echo "<td></td>";
            }
            
            echo "</tr>";
        }
        echo "</table>";
    }

    $dias = ["Lun","Mar","Mie","Jue","Vie","Sab","Dom"];
    $hora_ini = new Datetime();
    $hora_ini -> setTime(8,0);
    $hora_fin = new DateTime();
    $hora_fin -> setTime(15,0);
    $intervalo = 60;

    tablaHoraria($dias, $hora_ini, $hora_fin, $intervalo);

    ?>
</body>
</html>