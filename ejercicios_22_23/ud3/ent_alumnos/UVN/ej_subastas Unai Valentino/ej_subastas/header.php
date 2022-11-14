<?php
    require('config.php');
    session_start();
    $conn = new mysqli($host, $user, $password, $database);   
    if($conn->connect_errno > 0){   
        die("Imposible conectarse con la base de datos [" . $conn->connect_error . "]");   
    }  

?>

<html>
    <head>
        <title><?php echo $foroname; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/style.css" type="text/css" />
    </head>
    <body>
        <div id="header">
            <h1>SUBASTAS UNAI</h1>
        </div>
        <div id="menu">
            <a href="index.php">Home</a>
            <?php
                if(isset($_SESSION['usuario'])) {
                    echo "<a href='logout.php'>Logout</a> ";
                    echo "<a href='newitem.php'>New Item</a>";
                    if($_SESSION['usuario'] == 'admin'){
                        echo " <a href='vencidas.php'>Subastas Vencidas</a>";
                        echo " <a href='publi.php'>Anunciantes</a>";
                    }
                }
                else{
                    echo "<a href='login.php'>Login</a> ";
                    echo "<a href='newitem.php'>New Item</a>";
                }
            ?>
            
        </div>
        <div id="container">
            <div id="bar">
                <?php require("bar.php"); ?>
            </div>
            <div id="main">

