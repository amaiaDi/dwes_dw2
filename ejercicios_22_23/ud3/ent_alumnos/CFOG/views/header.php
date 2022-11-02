<?php 
require_once "../lib/config.php";

session_start();
?>
<html>
<head>
    <title><?php echo FORUM_TITLE; ?></title>
 	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href=<?php echo BASE_ROUTE."css/style.css"; ?> type="text/css" />
</head>
<body>
    <div id="header">
        <h1>SUBASTAS DEWS</h1>
    </div>
    <div id="menu">
        <a href="./index.php">Home</a>
        <?php
        $txtHTML="";
        if(isset($_SESSION["user_name"]) && isset($_SESSION["user_id"])) 
        {
            $txtHTML.="<a href='./logout.php'>Logout</a>";
            $txtHTML.="<a href='./newitem.php'>Nuevo item</a>";

            if($_SESSION["user_name"] == "admin")
            {
                $txtHTML.="<a href='./expired.php'>Subastas vencidas</a>";
                $txtHTML.="<a href='./advertise.php'>Anunciantes</a>";
            }
        }
        else
            $txtHTML.="<a href='./login.php'>Login</a>";
        echo $txtHTML;
        ?>
    </div>
    <div id="container">
        <div id="bar"><?php require_once("./navbar.php");?></div>
        <div id="main">