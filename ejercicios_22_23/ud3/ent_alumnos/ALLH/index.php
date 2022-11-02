<?php 
    include_once("config.php");
    
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    mysqli_select_db($con, DB_DATABASE);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
             Subastas
        </title>
 	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="estilos.css">
    </head>
<body>
    <div id="header">
        <h1><?php require("cabecera.php");?></h1>
    </div>
    <div id="menu">
        <?php require("menu.php");?>
    </div>
    <div id="container">
        <div id="bar">
               <?php require("barra.php"); ?>
        </div>
        <div id="main">
            <?php require("vertodas.php"); ?>
    
    
    <?php require("pie.php"); ?>