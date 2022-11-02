<?php
# 3. Crea un array con 10 nombres de ciudades, que puede contener repetidos.
# Visualízalo, en forma de lista numerada y sin repetidos.

$array_ciudades = array("Vitoria","Bilbao","Donosti","Pamplona","Vitoria","Logroño","Santander","Bilbao","Burgos","Bilbao");
$arr_ciudades_sin_repetidos = array_unique($array_ciudades);
$count = 1;

foreach($arr_ciudades_sin_repetidos as $a){
    echo "<br/>" .$count . " - ". $a;
    $count++;
}

echo "<br/>";

// OTRA FORMA

$arr_ciudades_con_indices = array_values($arr_ciudades_sin_repetidos);

for($i = 0;$i<count($arr_ciudades_con_indices);$i++){
    echo '<br/>' . ($i+1) . ' - ' . $arr_ciudades_con_indices[$i];
    
} 

?>