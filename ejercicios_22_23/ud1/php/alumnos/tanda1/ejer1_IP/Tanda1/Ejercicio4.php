<?php
//array
$array = array("frutas/manzana.png", "frutas/platano.png", "frutas/naranja.png", "frutas/kiwi.png");
?>

<?php 
//Crear funcion
function arrayImagenes ($arrayImag){
    echo "<table>";
    for($i=0;$i<sizeof($arrayImag);$i+=3){
        echo "<tr>";
         for($j=0;$j<3;$j++){
            $suma=$i+$j;
            if(($i+$j)>=sizeof($arrayImag)){
                break;
            }
         echo "<td><a href='$arrayImag[$suma]'><img src='$arrayImag[$suma]' height='100px' width='100px'> </a></td>";
         }
        echo "</tr>";
    }
    echo "</table>";
}
?>
<?php
echo arrayImagenes($array);
?>
