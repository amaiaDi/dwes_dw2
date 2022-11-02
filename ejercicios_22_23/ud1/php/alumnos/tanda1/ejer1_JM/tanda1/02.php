


<?php

#2.	Crea un array con las temperaturas de varios días de un mes y lo muestra 
#Calcula la media (sin utilizar un bucle) y visualízala de 2 maneras: redondeada y truncada
#Visualiza las 5 temperaturas más bajas y las 5 más altas

$temperaturas = [1=>15, 2=>17, 3=>9, 4=>21, 7=>18, 12=>10,
 19=>22, 21=>30, 23=>31, 26=>8, 30=>5];

echo 'Día    Temperatura <br/>';
echo '------------------ <br/>';
$dias = array_keys($temperaturas);
foreach($dias as $dia){
    echo $dia . ' - ' . $temperaturas[$dia] .'º' . '<br/>';
}

$media  = array_sum($temperaturas)/count($temperaturas);
echo '<br/>Media redondeada: ' . round($media) . 'º';
echo '<br/>Media truncada: ' . floor($media) . 'º<br/>';


asort($temperaturas);

$temperaturas_minimas = array_slice($temperaturas,0,5);
echo "<br/> Las cinco temperaturas mínimas son: <br/>";
foreach ($temperaturas_minimas as $tmi){
    echo '<br/>' . $tmi . 'º';
}
echo "<br/>";
$temperaturas_maximas = array_slice($temperaturas,count($temperaturas)-5);
echo "<br/> Las cinco temperaturas máximas son: <br/>";
foreach($temperaturas_maximas as $tma){
    echo "<br/>" . $tma . "º";
}

?>