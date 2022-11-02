<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
</head>
<style>
    td, th, table{
        border: 1px double black;
    }
    table tr:nth-child(odd){
        background-color: lightgray;
    }
    table tr:nth-child(1){
        background-color: white;
    }
</style>
<body>
    <?php
        $diasSemana = ["Lun", "Mar", "Mie", "Jue", "Vie", "Sab", "Dom"];
        
        function pintarTabla($diasSemana,$horaIni, $horaFin, $intervaloMin){
            $tdVacios = "";
            for ($i= 0; $i<count($diasSemana); $i++){
                $tdVacios.="<td></td>";
            }
           
           
            $horaFin=abs($horaFin);
            $horaIni=abs($horaIni);
            while ($horaIni >=24){
                $horaIni-= 24;
            }
            if ($horaFin>= 24){
                $horaFin = 23;
            }

            if ($horaIni>$horaFin){
                $horaIni = $horaFin;
            }

            $txtHtml = "<table><tr><th></th>";
            foreach ($diasSemana as $dia){
                $txtHtml .= "<th>".$dia."</th>";
            }

            $inicioMin = $horaIni * 60;
            $finMin = $horaFin * 60;

            for ($i = $inicioMin; $i <= $finMin; $i += $intervaloMin) {
                $hora = floor($i / 60);
                if ($hora < 10)
                    $hora = "0" . $hora;
        
                $minutos = $i % 60;
        
                if ($minutos <10)
                    $minutos = "0" . $minutos;
                
                $txtHtml .= "<tr><td>".$hora.":".$minutos."</td>".$tdVacios."</tr>";
            }
            echo $txtHtml."</table>";

        }
        
        pintarTabla($diasSemana,1, 12, 60);

    ?>
</body>
</html>