<?php require "config.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='css/estilo.css'>
    <title><?=$nombreforo?></title>
</head>
<body>   
    <header id="header">
        <h1><?=$nombreforo?></h1>
    </header>
    <nav id="menu">
        <a href=".">Home</a>
            <?php 
                if (isset($_SESSION['user'])) echo "<a href='logout.php'>Logout</a>";
                else echo "<a href='login.php'>Login</a>";
                if (isset($_SESSION['user'])) echo " <a href='nuevoitem.php'>Nuevo Item</a>";
            ?>
    </nav>
    <div id="container">
            <?php require "barra.php" ?>
        <div id="main">
<?php ?>