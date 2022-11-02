<!DOCTYPE html>
<html>
<body>

<?php

$clientes=array("Juan" => array("peli1","peli2"), "Manolo" => array("peli3","peli4"));

$peliP="peli1";
$cont=0;
$cliente = array_keys($clientes);
for($i = 0; $i < count($clientes); $i++) {
    foreach($clientes[$cliente[$i]] as $peli){
        if($peli==$peliP){
            $cont++;
        }
    }
}
print $cont." Personas la tienen entre sus favorita <br>";

for($i = 0; $i < count($cliente); $i++) {
        print $cliente[$i].": ";
        for($u=0;$u<2;$u++){
            $r=rand(0,1);
            $a = $clientes[$cliente[$i]];
            print $a[$r]." ";
        }
        print "<br>";
    } 
?>
</body>
</html>