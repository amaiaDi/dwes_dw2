<?php

    //Apertura de fichero en modo lectura
    $punteroLectura = fopen('usuarios.txt', 'r');
    if(!$punteroLectura){
    echo 'No se puede abrir el fichero.'; exit();
    }
    while(!feof($punteroLectura)){
         echo fgets($punteroLectura)."</br>";
    }
    fclose($punteroLectura);

    ///Apertura de fichero en modo escritura
    $punteroEscritura = fopen('usuarios.txt', 'a');
    if(!$punteroEscritura){
        echo 'No se puede abrir el fichero.'; exit();
    }
    
    $cadena="Hola, esto es un ejemplo de escritura en ficheros.";
    fwrite($punteroEscritura, $cadena, strlen($cadena));
    fclose($punteroEscritura);

    //Apertura de fichero en modo lectura/escritura
    //Escritura con puntero al principio del fichero
    // $punteroLecEsc = fopen('usuarios.txt', 'r+');
    // if(!$punteroLecEsc){
    // echo 'No se puede abrir el fichero.'; exit();
    // }
    // while(!feof($punteroLecEsc)){
    //     $cadenaLec=fgets($punteroLecEsc);
    //     if(strstr($cadenaLec,'Diaz')){
    //         fwrite($punteroLecEsc, $cadenaLec." nombre añadido en el proceso de escritura lectura </br>", strlen($cadenaLec));
    //     }
    // }
    // fclose($punteroLecEsc);

    // //Escritura con puntero al final del fichero
    $punteroLecEsc = fopen('usuarios.txt', 'a+');
    if(!$punteroLecEsc){
        echo 'No se puede abrir el fichero.'; exit();
    }
    while(!feof($punteroLecEsc)){
         fwrite($punteroEscritura, $cadena, strlen($cadena));
    }
    fclose($punteroLecEsc);
    
?>
