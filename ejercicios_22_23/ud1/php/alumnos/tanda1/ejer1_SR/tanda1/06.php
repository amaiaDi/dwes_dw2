<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>06</title>
</head>
<body>
    <?php
        function tablaSemana($semana_dias, $hora_i, $hora_f, $inter)
        {
            echo "<table border=1>
                    <tr>
                        <td>
                        </td>";
            for($c = 0; $c < count($semana_dias); $c++)
            {
                echo "<td>$semana_dias[$c]</td>";
            }
            echo "</tr>";

            $shadow = false;
            $segundosHora_i = strtotime($hora_i -> format("H:i"));
            $segundosHora_f = strtotime($hora_f -> format("H:i"));
            while($segundosHora_i <= $segundosHora_f)
            {
                if($shadow == true)
                {
                    echo "<tr style='background-color:lightgrey'>";
                    $shadow = false;
                }
                else{
                    echo "<tr>";
                    $shadow = true;
                }
                echo "<td>" . $hora_i -> format("H:i") . "</td>";
                $hora_i -> modify("+$inter minute");
                $segundosHora_i = strtotime($hora_i -> format("H:i"));
                for($c = 0; $c < count($semana_dias); $c++)
                {
                    echo "<td></td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }

        $sd = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'];
        $hi = new DateTime();
        $hi -> setTime(8, 0);
        $hf = new DateTime();
        $hf -> setTime(15, 0);
        $in = 60;

        tablaSemana($sd, $hi, $hf, $in);
    ?>
</body>
</html>