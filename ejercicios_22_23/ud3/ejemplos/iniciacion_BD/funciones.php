<?php
    //Funcion que comprueba si un radio button esta chekeado
    function fncIsChecked($id, $elemento){
        if (isset ($_POST[$elemento]) && !empty($_POST[$elemento]) && $_POST[$elemento]==$id){
             return "checked";
        }else{
             return "";
        }
     }
 
     //funcion que comprueba si un combo select tiene algun elemento seleccionado
     function fncIsSelected($id, $elemento){
         if (isset ($_POST[$elemento]) && !empty($_POST[$elemento]) && $_POST[$elemento]==$id){
              return "selected";
         }else{
              return "";
         }
      }

?>