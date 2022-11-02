<?php

/*
EJERCICIO 2 - TANDA 2
*/
function obtenerArrayImagenes($ruta){
    global  $arrayImagenes;

    $arrayImagenes=scandir($ruta);
}

?>