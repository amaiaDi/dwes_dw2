<?php
    /**
     * Pagina encargada crear la estructura, mostrar la cabecera con el titulo, el mehnu, 
     * la barra de tareas y abrir la etiqueta del div main, para poder insertar contenido en el contenedor main 
     */
    //Iniciamos session en la aplicación, si existe la recupera
    session_start();
    
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
<!-- Creamos la estructura HTML que mostrará la pagina final -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Muestra el titulo que aparece en la parte de arriba del navegador-->
    <title><?=TITULO_SUBASTAS?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Abre Div header y menu -->
    <header id="header">
        <!--  Titulo de la pantalla-->
        <h1><?php echo TITULO_SUBASTAS?></h1>
        <!-- Contenido de menu-->
        <nav id="menu">
            <?php require("menu.php"); ?>   
        </nav>
    </header>

    <!-- Abre Div Container - Bloque que contiene el contenido de bar 
    con los enlaces y de main con el contenido dinamico-->
    <div id="container">
        <div id="bar">
               <?php require("barra.php"); ?>
        </div>

        <!-- Abre Div Main - Parte central de la pantalla
         que contiene el contenido dinamico que va cambiando -->
        <div id="main">
        <
<?php require("pie.php"); ?>
