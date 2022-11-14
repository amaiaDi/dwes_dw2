<?php

    //Se incluyen los datos de configuración del fichero config.php
    include 'config.php';

    session_start();

    //Se establece la conexión con la base de datos
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    mysqli_select_db($con, DB_DATABASE);

?>

<html>
    <head>
        <title>
            <?php echo DB_TITULO; ?>
        </title>
 	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/estilos.css" type="text/css" />
    </head>
    <body>
        <div id="header">
            <h1>SUBASTAS CIUDAD JARDIN</h1>
        </div>
        <div id="menu">
            <a href="?r=main">Home</a>
            <?php
                if(isset($_SESSION['username'])) {
                    echo "<a href='logout.php'>Logout</a>";
                    echo " <a href='?r=nuevoitem'>New Item</a>";
                }
                else {
                    echo "<a href='?r=login'>Login</a>";
                }
            ?>
        </div>
        <div id="container">
            <div id="bar">
                <?php require("bar.php"); ?>
            </div>
            <div id="main">
                <?php
                    $rutas = array("main", "login", "registro", "itemdetalles", "nuevoitem", "editaritem");
                    $ruta = "";
                    if (isset($_GET['r']) && in_array($_GET['r'], $rutas, true)) {
                        $ruta = $_GET['r'] . ".php";
                    } else {
                        $ruta = "main.php";
                    }

                    require($ruta);
                ?>
            </div>
        </div>
    </body>
</html>