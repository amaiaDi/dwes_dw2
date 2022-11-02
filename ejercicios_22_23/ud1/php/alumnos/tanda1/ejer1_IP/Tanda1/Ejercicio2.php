<?php 
//Crear array
$array = array(12,29,41,22,34,14,11);
?>
<p><strong>Visualizar array</strong></p>
<?php 
for($i=0;$i<sizeof($array);$i++){
    echo $array[$i]."<br>";
}
?>

<p><strong>Media redondeada/truncada</strong></p>
<?php 
echo "Media redondeada: ".array_sum($array) / count($array)."<br>";
echo "Media truncada: ".intval(array_sum($array) / count($array))."<br>";
?>

<p><strong>5 temperaturas más bajas</strong></p>
<?php 
sort($array);
for($i=0;$i<5;$i++){
    echo $array[$i]."<br>";
}
?>

<p><strong>5 temperaturas más altas</strong></p>
<?php 
rsort($array);
for($i=0;$i<5;$i++){
    echo $array[$i]."<br>";
}
?>