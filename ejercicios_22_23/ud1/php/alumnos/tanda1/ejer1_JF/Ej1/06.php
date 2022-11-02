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
    // Función que recibe un array con días de la semana, un hora de inicio, una hora de fin y un intervalo en minutos

    $dia=['Lun','Mar','Mie','Jue','Vie'];

    function tabla($array,$horaIni,$horaFin,$intervalo){

        list($hIni, $mIni)=explode(":",$horaIni);
        list($hFin, $mFin)=explode(":",$horaFin);
        $minutosIni=intval($hIni)*60+intval($mIni);
        $minutosFin=intval($horaFin)*60+intval($mFin);

        echo('<table border=1>');
        echo("<tr>");
        echo("<td></td>");
        foreach($array as $valor){ 
            echo ("<td>$valor</td>");
        }
        echo("</tr>");


        for($i=$minutosIni; $i<=$minutosFin; $i=$i+$intervalo ){

            echo("<tr>");

            $hora=(int)($i/60).":".($i%60);
            echo("<td>$hora</td>");

            for($j=0;$j<count($array);$j++){
                echo("<td></td>");
            }
            echo("</tr>");

        }
        echo('</table>');

    }

    tabla($dia,"8:10","19:30",20);

    ?>

</body>
</html>