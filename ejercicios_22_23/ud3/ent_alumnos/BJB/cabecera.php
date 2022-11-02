<?php
    session_start();
    include_once "config.php";
    include_once "funciones.php";
    $con = mysqli_connect(HOST, USER, PASS);
    mysqli_select_db($con, DATABASE);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Subastas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header id="header">
        <h1><?php echo NOMBRE_FORO;?></h1>
    </header>
    <nav id="menu">
        <a href="index.php"> Home </a>
        <?php
            if(isset($_SESSION['nombre']) == TRUE) {
                echo "<a href='logout.php'> Logout </a>";
                echo "<a href='nuevoitem.php'> Nuevo ítem </a>";
            }
            else {
                echo "<a href='login.php'> Login </a>";
                echo "<a href='registro.php'> Registrarse </a>";
            }
        ?>
        
    </nav>
    <div id="container">
        <div id="bar">
               <?php require("barra.php"); ?>
        </div>

        <div id="main">
        

    
</body>
</html>