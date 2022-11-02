<?php
//Incluir funciones
include 'funciones.php';
//Muestra la fecha actual con el formato:    17th  September 2021, Wednesday

    // Mediante variable
    echo ("<h3>1.Muestra la fecha actual con el formato:    17th  September 2021, Wednesday</h3></br>");
    $fechaActual = date('dS F Y').",".date('l');
    echo $fechaActual;

   //poniendo el calculo de fecha directamente en el mensaje
   // echo date('dS F Y').",".date('l');

    //Muestra cuántos días quedan para finalizar el año

    echo ("<h3>2.Muestra cuántos días quedan para finalizar el año</h3></br>");
    echo ("Numero de días que faltan para fin de año:".calcularDiasHastaFinAnio());

    //Crea una cadena/frase a partir de los elementos de un array de palabras y la visualiza.
    echo ("<h3>3.Crea una cadena/frase a partir de los elementos de un array de palabras y la visualiza.</h3></br>");

    $palabras=array("espacio"=>" ","la"=>"la", "casa"=>"casa","es"=>"es","una"=>"una", "miguel"=>"Miguel","verde"=>"verde", "de"=>"de", "coma"=>",");

    echo ( $palabras["la"].$palabras["espacio"].$palabras["casa"].$palabras["espacio"]);
    echo ( $palabras["de"].$palabras["espacio"].$palabras["miguel"].$palabras["espacio"]);
    echo ( $palabras["es"].$palabras["espacio"].$palabras["verde"]);

    //A partir de una cadena con eñes, crea y visualiza otra que reemplace las eñes por “gn”
    echo ("<h3>4.A partir de una cadena con eñes, crea y visualiza otra que reemplace las eñes por “gn”</h3></br>");
    
    $palabra="moño";

    $nuevaPalabra=str_replace("ñ","gn",$palabra);
    echo("La nueva palabra es: $nuevaPalabra");

    //Función que devuelve un array con n números aleatorios entre limite1 y limite2
    echo ("<h3>5.Función que devuelve un array con n números aleatorios entre limite1 y limite2</h3></br>");

    $numeros=numerosAleatorios(10,100,10);
    for($i=0;$i<count($numeros);$i++){
        echo("$numeros[$i]</br>");
    }
        
    //Función que recibe una cadena y la devuelve cifrada.
    echo ("<h3>6.Función que recibe una cadena y la devuelve cifrada</h3></br>");
    $cadena="palabra";
    $cadenaCifrada=$cadena;
    $arrayDeCifrado=array("a"=>"Pr", "p"=>"a", "l"=>"Ed", "b"=>"i", "r"=>"At");
    
    $cadenaCifrada=cifrarCadena($arrayDeCifrado);
    echo("La cadena es $cadena y  cifrada es $cadenaCifrada</br>");

   
?>