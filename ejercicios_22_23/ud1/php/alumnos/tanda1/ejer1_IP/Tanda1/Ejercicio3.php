<?php 
//Crear array
$array = array ("Vitoria", "Madrid", "Barcelona", "Granada", "Valencia", "Madrid" ,"Sevilla", "Barcelona", "Vigo", "Gijon");
?>

<?php 
//Eliminar repetidos
$array = array_values(array_unique($array));
?>

<p><strong>Visualizar array en forma de lista numerada</strong></p>
<?php 
list("0"=>$Vi, "1"=>$Ma, "2"=>$Ba, "3"=>$Gr, "4"=>$Va, "5"=>$Vg,"6"=>$Se,"7"=>$Gi) = $array;
echo $Vi." ".$Ma." ".$Ba." ".$Gr." ".$Va." ".$Vg." ".$Se." ".$Gi;
?>