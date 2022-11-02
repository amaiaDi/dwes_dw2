<!DOCTYPE html>
<html>
<body>

<?php
$ciudades=array("Vitoria","Vitoria","Madrid","Sevilla","Zaragoza","Avila","Valencia","Málaga","Toledo","Córdoba");
$cont=1;
$ciudadesNoRepe=array_unique($ciudades);
foreach($ciudadesNoRepe as $codigo => $ciudad){
        print ($codigo+1).". ".$ciudad."<br>";
        $cont++;
}


?>

</body>
</html>