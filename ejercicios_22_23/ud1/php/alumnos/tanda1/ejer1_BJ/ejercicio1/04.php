<?php
function imagenes($array){
    echo '<table><tr>';
    $cont=1;
    foreach($array as $arr){
        if($cont===4){
            echo'</tr><tr>';
            $cont=1;
        }
        echo "<td><a href=$arr><img src=$arr alt=imagenes height=400 width=400></a></td>";
        $cont=$cont+1;
    } 
    echo '</tr></table>';
}
$array=array("1.jpg","2.jpg","3.jpg","4.jpg","5.jpg");
imagenes($array);
?>