<?php 
    // Iniciar Sesión
    session_start();
    // Fichero de config con las constantes
    include 'config.php';
    include 'gestion_db.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
        if($_SERVER['PHP_SELF'] == '/dwes/UD3/Subastas/index.php')
            echo "<link rel='stylesheet' href='style/style.css'>";
        else
            echo "<link rel='stylesheet' href='../style/style.css'>";
    ?>
    <title><?php echo NOMBRE_FORO ?></title>
</head>
<?php

    // Conexión con la BBDD
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
    $conn->set_charset("utf8");
    if($conn->connect_errno > 0)
        die("Imposible conectarse con la base de datos [" . $conn->connect_error . "]"); 
    // Header
    echo '<div id="header">';
    echo "<h1>".NOMBRE_FORO."</h1>";
    echo '</div>';
    
    // Menu
    echo "<div id='menu'>";
    echo "<a href='".DIR."'>Home</a>";
    if (isset($_SESSION['user'])) {
        echo "<a href='".DIR."php/nuevoitem.php'>Añadir Item</a>";
        echo "<a href='".DIR."php/logout.php'>Logout</a>";
        if ($_SESSION['user'] == 'admin') {
            echo "<a href='".DIR."php/vencidas.php'>Subastas Vencidas</a>";
            echo "<a href='".DIR."php/publi.php'>Publicitar</a>";
        }
    } else {
        if (isset($_GET['item']))
            echo "<a href='".DIR."php/login.php?referer=".urlencode($_SERVER['PHP_SELF'])."?item=".$_GET['item']."'>Login</a>";
        else
            echo "<a href='".DIR."php/login.php?referer=".urlencode($_SERVER['PHP_SELF'])."'>Login</a>";
        echo "<a href='".DIR."php/registro.php'>Register</a>";
    }
    echo "</div>";

    // Barra
    echo "<div id='container'>";
    require 'barra.php';
    
    
    // Main
    echo "<div id='main'>";
?>