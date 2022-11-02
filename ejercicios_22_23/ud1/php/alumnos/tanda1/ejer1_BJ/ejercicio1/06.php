<?php
function tabla($dias,$comienzo,$commin,$fin,$finmin,$intervalo){
    echo "<table><tr>";
    //Primera fila
    echo "<td></td>";
    foreach($dias as $dia){
        echo "<td>$dia</td>";
    }
    //Segunda fila
    echo "</tr><tr>";
    echo "<td>$comienzo:$commin</td>";
    for($for=0;$for>count($dias);$for++){
        echo "<td></td>";
    }
    //tronco
    echo "</tr><tr>";
    do{
        $commin+=$intervalo;
        while($commin>=60){
            $comienzo+=1;
            $commin=$commin-60;
        }
        echo "<td>$comienzo:$commin</td>";
        for($for=0;$for>count($dias);$for++){
            echo "<td></td>";
        }
        echo "</tr><tr>";
    }while($comienzo<$fin and $commin<=$finmin);
    echo "</tr></table>";
}
$arr=array("Lun","Mar","Mie","Jue","Vie","Sab","Dom");
$comienzo=8;
$commin=30;
$fin=15;
$finmin=30;
$intervalo=120;
tabla($arr,$comienzo,$commin,$fin,$finmin,$intervalo);
?>