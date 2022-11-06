<?php
    /**
     * Pagina encargada crear la estructura, mostrar la cabecera con el titulo, el mehnu, 
     * la barra de tareas y abrir la etiqueta del div main, para poder insertar contenido en el contenedor main 
     */
    session_start();
    include_once "config.php";
    include_once "libreria_subastas.php";
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    mysqli_select_db($con, DB_DATABASE);
    if(isset($_SESSION['usuario'])){
        $usuario = $_SESSION['usuario'];
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header id="header">
        <h1><?php echo TITULO_SUBASTAS;?></h1>
    </header>
    <nav id="menu">
        <?php require("menu.php"); ?>   
    </nav>
    <div id="container">
        <div id="bar">
               <?php require("barra.php"); ?>
        </div>

        <div id="main">
        

    
</body>
</html>