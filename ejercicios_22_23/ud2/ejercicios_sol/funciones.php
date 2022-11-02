<?php
/*******************
*******EJERCICIO 1
********************/

//Función que comprubea si el texto en base a un patron establecido. En este caso solo letras y espacio
function fncEsTextoValido($texto){
    $patron = "/^[a-zA-Z\sñáéíóúÁÉÍÓÚ]+$/";
    return preg_match($patron, $texto);
}
?>