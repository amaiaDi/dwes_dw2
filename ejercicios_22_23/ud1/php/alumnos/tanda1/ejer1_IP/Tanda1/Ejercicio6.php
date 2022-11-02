<?php 

function pasarAsegundos($hora){
    $t = (substr($hora, 0, stripos($hora, ":"))*3600)+
    (substr($hora, stripos($hora, ":")+1, strrpos($hora, ":")-(stripos($hora, ":")+1))*60)+
    (substr($hora, strrpos($hora, ":")+1));
    return $t;
}


function crearHorario($arrayDias, $horaInicio, $horaFin, $intervalo){
    $color="lightgrey";
    echo "<table>";

    //Crear primera fila
    echo "<tr>";
    echo "<td></td>";
    for($i=0; $i<sizeof($arrayDias);$i++){
        echo "<td style='background-color:$color;'>$arrayDias[$i]</td>";
    }
    echo "</tr>";

    //Bucle lineas
    while(pasarAsegundos($horaInicio)<pasarAsegundos($horaFin)){
        echo "<tr>";
        //Cambiar color
        if($color=="lightgrey"){
            $color="grey";
        }else{
            $color="lightgrey";
        }
        
        //Crear celda para el tiempo + filas vacias
        echo "<td style='background-color:$color;'>$horaInicio</td>";
        for($i=0;$i<sizeof($arrayDias);$i++){
            echo "<td style='background-color:$color;'>    </td>"; 
        }

    //Calcular nuevo tiempo
    $tiempo=date('H:i:s',strtotime($horaInicio));
    $tiempoEnSegundos = (substr($tiempo, 0, stripos($tiempo, ":"))*3600)+
                        (substr($tiempo, stripos($tiempo, ":")+1, strrpos($tiempo, ":")-(stripos($tiempo, ":")+1))*60)+
                        (substr($tiempo, strrpos($tiempo, ":")+1))+$intervalo;  
    $hora=intval(($tiempoEnSegundos/3600));
    $tiempoEnSegundos-=($hora*3600);
    $minutos=intval(($tiempoEnSegundos/60));
    $tiempoEnSegundos-=($minutos*60);
    $segundos=intval(($tiempoEnSegundos%60));
    $horaInicio=$hora.":".$minutos.":".$segundos;
    echo "</tr>";
    }
    echo "</table>";
}
?>

<?php 
$array=array("Lun", "Mar", "Mie", "Jue" ,"Vie", "Sab", "Dom");
crearHorario($array,"8:30", "15:00", "60");

?>