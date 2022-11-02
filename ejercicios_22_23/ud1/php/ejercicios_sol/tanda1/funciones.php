<?php
//*********************************************************************************************
// EJERCICIO 1
//*********************************************************************************************
// Metodo que permite obtener los nombres de los ficheros dentro de una ruta de carpeta dada
function obtenerNombresFicherosDesdeCarpeta($rutaCarpeta){

    $listado = glob($rutaCarpeta);
    $rutas= array();
    $i=0;
    foreach($listado as $elemento) {
        $rutas[$i++] = $elemento;
    }

    return $rutas;
}

// Calcula el numero de días que quedan hasta fin de año
function calcularDiasHastaFinAnio(){
    
    $dia=date('d');
    $mes=date('m');
    
    $totalDias=$dia;
    $mes++;

    for($mes;$mes<=12;$mes++){
        if($mes===2){
            $diasMes=28;
        }else{
            if(($mes% 2) == 0){
                $diasMes=31;
            }else{
                $diasMes=30;
            }
        }
        $totalDias=$totalDias+$diasMes;
    }

    return $totalDias;
}

//Función que devuelve un array con n números aleatorios entre limite1 y limite2
function numerosAleatorios($limite1, $limite2, $numElementos){
    
    for($j=0;$j<$numElementos;$j++){
        $numerosAleatorios[$j]=rand($limite1,$limite2);
    }
    
    return $numerosAleatorios;
}

 //Función que recibe una cadena y la devuelve cifrada.
 function cifrarCadena($arrayCifrado){

    global $cadenaCifrada;

    for($i=0; $i<strlen($cadenaCifrada);$i++){
        if(array_key_exists($cadenaCifrada[$i],$arrayCifrado)!==false){
            $cadenaCifrada[$i]=$arrayCifrado[$cadenaCifrada[$i]];
        }
    }

    return $cadenaCifrada;
}
//*********************************************************************************************
// FIN EJERCICIO 1
//*********************************************************************************************

//*********************************************************************************************
// EJERCICIO 2
//*********************************************************************************************

//crear array de temperaturas aleatorias en un mes de XXX dias
function crearArrayTemperaturasAleatorias($pfDiaMes){
    $pfArray=array();
    for($i=0;$i<$pfDiaMes;$i++){
        $pfArray[$i]=rand(0,$pfDiaMes);
    }
    return $pfArray;
}

//Metodo que mueestra el contenido de un array separado por comas 
//comprobando que no exista ese dato previamente en la cadena de texto
function obtenerDatosArrayConComas($pfArray, $pfLimite){
    $cadena="";
    for($i=0;$i<$pfLimite;$i++){
        if(!strstr($cadena, "$pfArray[$i]")){
            $cadena=$cadena.$pfArray[$i].($pfLimite>0 && $i<$pfLimite-1?",":"");
        }else{
            $pfLimite++;
        }
    }

    return $cadena;
}
//*********************************************************************************************
// FIN EJERCICIO 2
//*********************************************************************************************

//*********************************************************************************************
// EJERCICIO 5
//*********************************************************************************************
// Recibe un nombre de película y devuelve cuántas personas la tienen entre sus favoritas, entendiendo que cada persona solo lo tiene una vez
function fncNombrePeliculaPorPersona ($nombrePelicula ){

    global $peliculasPersonas;
    $contador=0;

    foreach($peliculasPersonas as $persona=>$peliculas){

        if (array_search($nombrePelicula, $peliculas)){
            $contador++;
        }

    }

}

// Muestra, por cada persona, 2 de sus películas favoritas al azar
function fncMostrarPeliculasFavoritasPersona(){
    global $peliculasPersonas;
    $arrayFavoritas=array();
    foreach($peliculasPersonas as $persona=>$peliculas){

        echo("<p>Las 2 peliculas favoritas de $persona son: ");

        for($i=0; $i<2; $i++){
            $pelicula=$peliculas[rand(0,3)];
            if(!in_array( $pelicula,$arrayFavoritas))
                $arrayFavoritas[$i]=$pelicula;
        }
        echo($arrayFavoritas[0]." y ".$arrayFavoritas[1]);
    }
}
//*********************************************************************************************
// FIN EJERCICIO 5
//*********************************************************************************************


//*********************************************************************************************
// EJERCICIO 6
//*********************************************************************************************
//Metodo que calcula el numero de intervalos de la tabla dado la hora de inicio, la de fin y los minutos de intervalo
function calcularIntervalo($horaInicio, $horaFin, $intervaloMinutos){
    $pfIntervalo;

    //Comprobamos que las horas sean mayores que 0 y menores que 24 y que la hora de fin sea mayor que la de inicio, si no. devolvemos -1 a modo de identificar el error
    if(($horaInicio>24 || $horaInicio<0 || $horaFin>24 || $horaFin<0 || $horaFin<$horaInicio)){
        return -1;
    }else{
        // Hacemos el calculo de intervalos
        $pfIntervalo= ($horaFin-$horaInicio)*60 / $intervaloMinutos;
        //comprobamos si el intervalo no es exacto comprobando el resto de la división. 
        //Si es distinta de 0 redondeamos al entero superior
        if(($horaFin-$horaInicio)*60 % $intervaloMinutos !==0){
            $pfIntervalo=round($pfIntervalo);
        // si el resto de la division es 0, si es 0 redondeamos al entero inferior
        }else{
            $pfIntervalo=floor($pfIntervalo);
        }

        return $pfIntervalo;
    }

}

 //Ejemplo 1: Definicion de funcion para visualizar tabla horaria con 4 parametros de entrada y 0 de salida
// Recibe los elementos como parametros de la funcion
function visualizarTablaHorariaRecibeParametros($arrayDias, $horaInicio, $horaFin, $intervaloMinutos){
    
    $pfIntervalo=calcularIntervalo($horaInicio, $horaFin, $intervaloMinutos);
    $arrayHoraIntervalo=array('hora'=>$horaInicio,'mins' =>0);
    $countColummnas=0;

    if($pfIntervalo===-1){
        echo "<tr><td> Los datos introducidos son erroneos no se puede visualizar la tabla horaria </td></tr>";
    }else{
        //Creamos el for para escribir las filas. Tenemos tantas filas como intervalos logrados con el calculo
        for($fila=0; $fila<=$pfIntervalo;$fila++){
            //Diferenciamos las filas con fondo gris claro cuando son pares
            if ($fila%2==0){
                echo ("<tr style='background-color:lightgrey;'>");
            }else{
                echo ("<tr style='background-color:white;'>");
            }
            //Creamos el for para escribir tantas columnas como dias existen en el array
            foreach ($arrayDias as $valor ){
                //Si la fila es 0
                if($fila===0){
                    // Si la fila y la columna es 0 el hueco queda vacio
                    if($countColummnas===0){
                        echo ("<td> </td>");
                    }else{
                        // Si no se rellena con el elemento del array de dias correspondiente
                        echo ("<td> $valor</td>");
                    }        
                //Si la fila no es 0
                }else{
                    //Pero si la columna es 0 esccribiremos la hora y los minutos calculados segun intervalos
                    if($countColummnas===0){
                        $horaTexto="";
                         // Si la suma de los minutos + el intervalo es MENOR de 60 y no es la primera vez que mostramos la hora, cambiamos la hora
                       if($arrayHoraIntervalo['mins']+$intervaloMinutos<60 &&  $fila!==1){
                            $arrayHoraIntervalo['mins']=$arrayHoraIntervalo['mins']+$intervaloMinutos;
                        
                        // Si No, sumamos los minutos al intervalo y le restamos 60. Ademas le sumamos 1 a la hora
                        }else{
                            //Modificamos la hora siempre que no sea la primera vez que mmostramos la hora
                            if($fila!==1){
                                $arrayHoraIntervalo['hora']=$arrayHoraIntervalo['hora']+1;
                                $arrayHoraIntervalo['mins']=$arrayHoraIntervalo['mins'] + $intervaloMinutos-60;
                            }
                        }

                        $horaTexto=$arrayHoraIntervalo['hora'].":".($arrayHoraIntervalo['mins']<10?"0".$arrayHoraIntervalo['mins']:$arrayHoraIntervalo['mins']);

                        echo ("<td>$horaTexto</td>");
                    //Si no completaremos con caracter vacio
                    }else{
                        echo ("<td>&nbsp; </td>");
                    }
                    
                }
                //Incrementamos el valor de columna en 1
                $countColummnas++;

            }
            echo "</tr>";
            $countColummnas=0;
        }
    }
}

//Version 2: Definicion de funcion para visualizar tabla horaria con 4 parametros de entrada y 0 de salida
//Utiliza las variables globales sin recibirlas por parametr            
function visualizarTablaHorariaNoRecibeParametrosUsaGlobales(){
    
    global $arrayDias, $horaInicio, $horaFin, $intervaloMinutos;
    $pfIntervalo=calcularIntervalo($horaInicio, $horaFin, $intervaloMinutos);
    $arrayHoraIntervalo=array('hora'=>$horaInicio,'mins' =>0);
    $countColummnas=0;

    if($pfIntervalo===-1){
        echo "<tr><td> Los datos introducidos son erroneos no se puede visualizar la tabla horaria </td></tr>";
    }else{
        //Creamos el for para escribir las filas. Tenemos tantas filas como intervalos logrados con el calculo
        for($fila=0; $fila<=$pfIntervalo;$fila++){
            //Diferenciamos las filas con fondo gris claro cuando son pares
            if ($fila%2==0){
                echo ("<tr style='background-color:lightgrey;'>");
            }else{
                echo ("<tr style='background-color:white;'>");
            }
            //Creamos el for para escribir tantas columnas como dias existen en el array
            foreach ($arrayDias as $valor ){
                //Si la fila es 0
                if($fila===0){
                    // Si la fila y la columna es 0 el hueco queda vacio
                    if($countColummnas===0){
                        echo ("<td> </td>");
                    }else{
                        // Si no se rellena con el elemento del array de dias correspondiente
                        echo ("<td> $valor</td>");
                    }        
                //Si la fila no es 0
                }else{
                    //Pero si la columna es 0 esccribiremos la hora y los minutos calculados segun intervalos
                    if($countColummnas===0){
                        $horaTexto="";
                         // Si la suma de los minutos + el intervalo es MENOR de 60 y no es la primera vez que mostramos la hora, cambiamos la hora
                       if($arrayHoraIntervalo['mins']+$intervaloMinutos<60 &&  $fila!==1){
                            $arrayHoraIntervalo['mins']=$arrayHoraIntervalo['mins']+$intervaloMinutos;
                        
                        // Si No, sumamos los minutos al intervalo y le restamos 60. Ademas le sumamos 1 a la hora
                        }else{
                            //Modificamos la hora siempre que no sea la primera vez que mmostramos la hora
                            if($fila!==1){
                                $arrayHoraIntervalo['hora']=$arrayHoraIntervalo['hora']+1;
                                $arrayHoraIntervalo['mins']=$arrayHoraIntervalo['mins'] + $intervaloMinutos-60;
                            }
                        }

                        $horaTexto=$arrayHoraIntervalo['hora'].":".($arrayHoraIntervalo['mins']<10?"0".$arrayHoraIntervalo['mins']:$arrayHoraIntervalo['mins']);

                        echo ("<td>$horaTexto</td>");
                    //Si no completaremos con caracter vacio
                    }else{
                        echo ("<td>&nbsp; </td>");
                    }
                    
                }
                //Incrementamos el valor de columna en 1
                $countColummnas++;

            }
            echo "</tr>";
            $countColummnas=0;
        }
    }

    
}


//Version 3: Definicion de funcion para visualizar tabla horaria sin parametros de entrada y con variables locales        
function visualizarTablaHorariaSinParametrosVariablesLocales(){
    $pfArrayDias=array("Lun","Mar","Mie","Jue","Vie","Sab","Dom");
    $pfHoraInicio=18;
    $pfHoraFin=24;
    $pfIntervaloMinutos=35;
    $pfIntervalo=calcularIntervalo($pfHoraInicio, $pfHoraFin, $pfIntervaloMinutos);
    $arrayHoraIntervalo=array('hora'=>$pfHoraInicio,'mins' =>0);
    $countColummnas=0;

    if($pfIntervalo===-1){
        echo "<tr><td> Los datos introducidos son erroneos no se puede visualizar la tabla horaria </td></tr>";
    }else{
        //Creamos el for para escribir las filas. Tenemos tantas filas como intervalos logrados con el calculo
        for($fila=0; $fila<=$pfIntervalo;$fila++){
            //Diferenciamos las filas con fondo gris claro cuando son pares
            if ($fila%2==0){
                echo ("<tr style='background-color:lightgrey;'>");
            }else{
                echo ("<tr style='background-color:white;'>");
            }
            //Creamos el for para escribir tantas columnas como dias existen en el array
            foreach ($pfArrayDias as $valor ){
                //Si la fila es 0
                if($fila===0){
                    // Si la fila y la columna es 0 el hueco queda vacio
                    if($countColummnas===0){
                        echo ("<td> </td>");
                    }else{
                        // Si no se rellena con el elemento del array de dias correspondiente
                        echo ("<td> $valor</td>");
                    }        
                //Si la fila no es 0
                }else{
                    //Pero si la columna es 0 esccribiremos la hora y los minutos calculados segun intervalos
                    if($countColummnas===0){
                        $horaTexto="";

                        // Si la suma de los minutos + el intervalo es MENOR de 60
                        if ($arrayHoraIntervalo['mins']+$pfIntervaloMinutos<60){
                            $arrayHoraIntervalo['mins']=$arrayHoraIntervalo['mins']+$pfIntervaloMinutos;
                        
                        // Si No, sumamos los minutos al intervalo y le restamos 60. Ademas le sumamos 1 a la hora
                        }else{
                            $arrayHoraIntervalo['hora']=$arrayHoraIntervalo['hora']+1;
                            $arrayHoraIntervalo['mins']=$arrayHoraIntervalo['mins'] + $pfIntervaloMinutos-60;
                        }

                        $horaTexto=$arrayHoraIntervalo['hora'].":".($arrayHoraIntervalo['mins']<10?"0".$arrayHoraIntervalo['mins']:$arrayHoraIntervalo['mins']);

                        echo ("<td>$horaTexto</td>");
                    //Si no completaremos con caracter vacio
                    }else{
                        echo ("<td>&nbsp; </td>");
                    }
                    
                }
                //Incrementamos el valor de columna en 1
                $countColummnas++;

            }
            echo "</tr>";
            $countColummnas=0;
        }
    }


    //Si intento usar los parametros globales  definidos en 
    // echo ("horaInicio=$horaInicio");
    // echo ("pfHoraInicio=$pfHoraInicio");

 
}

//*********************************************************************************************
// FIN EJERCICIO 6
//*********************************************************************************************
?>