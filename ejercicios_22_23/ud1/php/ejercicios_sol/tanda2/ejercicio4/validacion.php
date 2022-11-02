<?php

    if(isset($_POST['Entrar'])){
        if(empty($_POST[nombreUsuario])){
            $errorUsuario= "Usuario no puede estar vacio";
        }else{
            validarUsuario($_POST[nombreUsuario]);
        }

        if(empty($_POST[passwordUsuario])){
            $errorPassword= "El password no puede estar vacio" ;
        }else{
            validarPassword($_POST[passwordUsuario]);
        }
    }

    //metodo paa validar el usuario
    function validarUsuario($pf_nombreUsuario){

    }

    //metodo para validar el password
    function validarPassword($pf_nombrePassword){
        
    }

?>