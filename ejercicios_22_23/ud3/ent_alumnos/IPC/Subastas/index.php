<?php
   //session_start();
    require_once("config.php");
    require_once("funciones.php");

    //Crear conexion BD
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    mysqli_select_db($con, DB_DATABASE);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/css2.css">
    <title>Document</title>
</head>
<body>
    <div id="header">
        <?php require("cabecera.php"); ?>
    </div>
    <div id="menu">
         <?php require("menu.php"); ?>
    </div>
    <div id="container">
        <div id="bar">
            <?php require("barra.php"); ?>
        </div>
        <div id="main">
         <?php 
         if(isset($_GET["pagActual"]) &&  $_GET["pagActual"]=="index"){
            require("listadoItems.php"); 
         }else if(isset($_GET["pagActual"]) &&  $_GET["pagActual"]=="itemdetalles"){
            require("itemdetalles.php"); 
         }else if(isset($_GET["pagActual"]) &&  $_GET["pagActual"]=="login"){
            require("login.php"); 
         }else if(isset($_GET["pagActual"]) &&  $_GET["pagActual"]=="logout"){
            require("logout.php"); 
         }else if(isset($_GET["pagActual"]) &&  $_GET["pagActual"]=="nuevoitem"){
            require("nuevoitem.php"); 
         }else if(isset($_GET["pagActual"]) &&  $_GET["pagActual"]=="registro"){
            require("registro.php"); 
         }else{
            require("listadoItems.php"); 
         }
         ?>
        </div>
    </div>
</body>
</html>