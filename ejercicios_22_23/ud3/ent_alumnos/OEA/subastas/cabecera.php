<?php
    //Iniciar/retomar sesión
    session_start();
    //incluir fichero de configuracion
    include_once("config.php");

    //Crear conexion BD
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    mysqli_select_db($con, DB_DATABASE);
?>
<html><head><title><?php echo DB_TITULO; ?></title>
 	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="stylesheet.css" type="text/css" />
</head>
<body>
    <div id="header">
        <h1><?php echo DB_TITULO; ?></h1>
    </div>
    <div id="menu">
        <a href="index.php">Home</a>
        <?php
            if(isset($_SESSION['usuario']))
                echo "<a href='logout.php'>Logout</a>";
            else
                echo "<a href='login.php'>Login</a>";
        ?>
        <a href="nuevoitem.php">New Item</a>
    </div>
    <div id="container">
        <div id="bar">
            <?php require("barra.php"); ?>
        </div>
        <div id="main">