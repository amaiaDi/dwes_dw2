<?php
#6.	Función que recibe un array con días de la semana, un hora de inicio, una hora de fin y un intervalo en minutos y visualiza una tabla horaria 


// no comprobamos que los datos introducidos sean correctos
function crearHorario ($dias,$hora_inicio,$hora_fin,$intervalo){

    $nueva_hora = new DateTime();
    $nueva_hora = clone $hora_inicio;
    // creamos las variables para el control del bucle while
    $nueva_hora_timestamp = strtotime($nueva_hora -> format('H:i'));
    $hora_fin_timestamp= strtotime($hora_fin -> format('H:i'));
    $sombra = false;

    echo '<table border=1>';

        echo "<tr><th></th>";
            foreach($dias as $dia){
                echo "<th>$dia</th>";
            }
        echo "</tr>";


        while($hora_fin_timestamp - $nueva_hora_timestamp >= 0){
            if($sombra){
                echo '<tr bgcolor="Silver"><td>' . $nueva_hora -> format("H:i") . "</td>";
                $sombra = false;
            }
            else{
                echo "<tr><td>" . $nueva_hora -> format("H:i") . "</td>";
                $sombra = true;
            }
            for($i = 0;$i<count($dias);$i++){
                echo "<td></td>";
            }
                echo "</tr>";
                $nueva_hora -> modify("+$intervalo minutes"); 
                $nueva_hora_timestamp = strtotime($nueva_hora -> format('H:i'));
            }
            echo '</table>';
        }
        
        
        $dias_semana = ["Lun","Mar","Mie","Jue","Vie","Sab","Dom"];
        $hora_ini = new DateTime();
        $hora_ini -> setTime(8,0);
        $hora_fin = new DateTime();
        $hora_fin -> setTime(15,0);
        $inter = 45;

        crearHorario($dias_semana,$hora_ini,$hora_fin,$inter);
        
        echo '<br/>';
        

        ?>