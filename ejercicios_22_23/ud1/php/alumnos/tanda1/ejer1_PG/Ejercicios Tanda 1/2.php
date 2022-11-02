<!DOCTYPE html>
<html>
<body>

<?php
$temperaturas=array(1=>20,2=>21,3=>24,4=>24,5=>27,6=>28);
$cont=1;
foreach($temperaturas as $codigo => $a){
    
    print "Dia ".$codigo." ".$a."ºC<br>";
    $cont++;
}

$suma=array_sum($temperaturas);
$total=$suma/$cont;
$truncado=bcdiv($total,'1',1);
$redondeado=round($total,1);
print "Truncado = ".$truncado."<br> Redondeado = ".$redondeado."<br>";

sort($temperaturas);
print "Temperatu mas bajas: ";
for($i=0;$i<5;$i++){
   print $temperaturas[$i].",";
}

rsort($temperaturas);
print "<br>Temperatu mas altas: ";
for($i=0;$i<5;$i++){
    print $temperaturas[$i].",";
 }
?>

</body>
</html>