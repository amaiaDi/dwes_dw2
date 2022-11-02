<!DOCTYPE html>
<html lang="en">
    <style>
        table{
            text-align: left;
            margin: auto;
            border-style: double;
            border-collapse: collapse;
        }
        td{
            border-style: double;
        }
        tr:nth-child(2n+1){
            background-color: gray;
        }
        tr:first-child{
            background-color: white;
        }
    </style>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php
        $arrayDias=array("Lun","Mar","Mie","Jue","Vie","Sab","Dom");

        function crearTabla($arrayDias,$horaCom,$horaFin,$inter){
            $numDias=count($arrayDias);
            for ($i=0; $i <$numDias ; $i++) { 
                echo"<td>$arrayDias[$i]</td>";
            }
            echo"</tr>";
            if (strlen($horaCom)==5) {
                $horaI=substr($horaCom,0,2);
                $minsI=substr($horaCom,3,5);
            }
            else {
                $horaI=substr($horaCom,0,1);
                $minsI=substr($horaCom,2,4);
            }
            if (strlen($horaFin)==5) {
                $horaF=substr($horaFin,0,2);
                $minsF=substr($horaFin,3,5);
            }
            else {
                $horaF=substr($horaFin,0,1);
                $minsF=substr($horaFin,2,4);
            }
            $sumaH=0;
            while ($inter >= 60) {
                $inter-=60;
                $sumaH++;
            }
            
            
            while ($horaI < $horaF) {
                if (strlen($minsI)==2) {
                    echo"<tr><td>$horaI:$minsI</td>";
                }
                else {
                    echo"<tr><td>$horaI:0$minsI</td>";
                }
                for ($i=0; $i <$numDias ; $i++) { 
                    echo"<td></td>";
                }
                $horaI+=$sumaH;
                $minsI+=$inter;
                if ($minsI>=60) {
                    $minsI-=60;
                    $horaI++;
                }
                echo"</tr>";
            }
            echo"<tr><td>$horaI:00</td>";
            for ($i=0; $i <$numDias ; $i++) { 
                echo"<td></td>";
            }
            echo"</tr>";
        }
        echo"<table><tr><td></td>";
        crearTabla($arrayDias,"8:00","15:00","30");
        echo"</table>";
    ?>
</body>
</html>