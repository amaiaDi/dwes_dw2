<?php
$weekDays= 
[
    "Lunes",
    "Martes",
    "Miércoles",
    "Jueves",
    "Viernes",
    "Sábado",
    "Domingo"
];      

function showTimeTable($weekDays, $startTime, $endTime, $interval)
{
    $txtHtml="<table><tr><th></th>";
    foreach($weekDays as $day)
        $txtHtml.="<th>$day</th>";
    $txtHtml.="</tr>";

    // Elimina este bucle para permitir el funcionamiento de casos ilógicos. Nunca subestimes la cabezonería del usuario
    while($endTime>24)      
        $endTime-=24;
    while($startTime>$endTime)
        $endTime+=24;

    for($currentHour=$startTime, $currentMin=0; $currentHour<$endTime || ($currentHour==$endTime && $currentMin==0); )
    {
        $txtHtml.="<tr>";

        $currentHour_output=$currentHour;
        while($currentHour_output>=24)
            $currentHour_output-=24;
        if($currentMin<10)
            $txtHtml.="<td>$currentHour_output:0$currentMin</td>";
        else 
            $txtHtml.="<td>$currentHour_output:$currentMin</td>";

        for($i=0; $i<count($weekDays); $i++)
            $txtHtml.="<td></td>";

        for($tmpInterval=$interval; $tmpInterval>=60; $tmpInterval-=60)
            $currentHour++;
        $currentMin+=$tmpInterval;
        while($currentMin>=60)
        {
            $currentMin-=60;
            $currentHour++;
        }

        $txtHtml.="</tr>";
    }
    echo "</table>".$txtHtml;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
</head>
<style>
    table, th, td
    {
        border: 1px solid black;
    }
    tr:nth-child(odd)>td
    {
        background-color: lightgray;
    }
</style>
<body>
    <?php 
    showTimeTable($weekDays, 8, 15, 60); echo "<br>";
    showTimeTable($weekDays, 7, 24, 70); echo "<br>";
    showTimeTable($weekDays, 8, 12, 11); echo "<br>";
    showTimeTable($weekDays, 20, 4, 15); echo "<br>";
    showTimeTable($weekDays, 56, 5, 60); echo "<br>";
    showTimeTable($weekDays, 5, 56, 60); echo "<br>";
    ?>
</body>
</html>