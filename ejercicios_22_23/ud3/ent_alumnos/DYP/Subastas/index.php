<?php
    //Crear conexion BD
    include_once("config.php");
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    mysqli_select_db($con, DB_DATABASE);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/subastas.css">
    <title>Subastas</title>
</head>
<body>
    <header id="header">
        <h1>SUBASTAS DANI</h1></div>
        <div id="menu">
            <a href="index.php">Home </a>
            <a href='index.php?ir=items'>Items </a>
            <?php
                session_start();
                if(isset($_SESSION['usuario'])){
                    echo "<a href='index.php?ir=nuevoitem'>Nuevo Item </a>";
                    echo "<a href='index.php?ir=logout'>Logout </a>";
                }else{
                    echo "<a href='index.php?ir=registro'>Registrate </a>";
                    echo "<a href='index.php?ir=login'>Login </a>";
                }
            ?>
        </div>
    </header>
    <div id="container">
        <div id="bar">
            <?php 
                require("barra.php");
            ?>
        </div>
        <div id="main">
            <?php
                if(isset($_GET['ir']) && $_GET['ir']=='registro'){
                    require("registro.php");
                }
                if(isset($_GET['ir']) && $_GET['ir']=='login'){
                    require("login.php");
                }
                if(isset($_GET['ir']) && $_GET['ir']=='items'){
                    require("items.php");
                }
                if(isset($_GET['ir']) && $_GET['ir']=='logout'){
                    require("logout.php");
                }
                if(isset($_GET['ir']) && $_GET['ir']=='itemdetalles'){
                    require("itemdetalles.php");
                }
                if(isset($_GET['ir']) && $_GET['ir']=='nuevoitem'){
                    require("nuevoItem.php");
                }
                if(isset($_GET['ir']) && $_GET['ir']=='editaritem'){
                    require("editaritem.php");
                }
            ?>
        </div>
    </div>
</body>
</html>