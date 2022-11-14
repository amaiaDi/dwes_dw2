<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css" type="text/css"/>
    <title>Subastas</title>
</head>
<body>
    <div id="header">
        <h1>SUBASTAS DEWS</h1>
    </div>
    <div id="menu">
         <a href="cabecera.php">Home</a>
         <?php
         if(isset($_SESSION["id"])){
            print "<a href='logout.php'>Logout</a>";
         }
         else{
             print "<a href='login.php'>Login</a>";
         }
         ?>
         <a href="">Nuevo</a>
         <a href="">Item</a>
    </div>
    <div id="container">
        <div id="bar">
            <?php include("barra.php") ?>
        </div>
        <div id="main">
            <?php include("cabecera.php") ?>
        </div>
    </div>
    </body>
</html>