<?php
    /**
     * Pagina encargada crear la estructura, mostrar la cabecera con el titulo, el mehnu, 
     * la barra de tareas y abrir la etiqueta del div main, para poder insertar contenido en el contenedor main 
     */
    
    //incluimos elementos de configuracion, gestion de BD y libreria de la aplicacion
    require_once "config.php";
    require_once "gestionBD_ioo.php";
    require_once "libreria_subastas.php";
    
    //creamos la conexión mediante el metodo que existe en la libreria de gestionBD
    $con = fncCrearConexion(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
    
    //Comrpobamos si existe usuario en session. Es la forma de saber si estamos logueados. 
    //Si existe lo recupero para su posterior utilización

    if(isset($_SESSION['usuario'])){
        $usuario = $_SESSION['usuario'];
    }else{
        $usuario="";
    }
?>
