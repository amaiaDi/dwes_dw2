<?php
    session_start();
    include_once "config.php";
    include_once "libreria_subastas.php";
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    mysqli_select_db($con, DB_DATABASE);
    if(isset($_SESSION['usuario'])){
        $usuario = $_SESSION['usuario'];
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Subastas</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header id="header">
        <h1><?php echo FORO_SUBASTAS;?></h1>
    </header>
    <nav id="menu">
        <a href="index.php"> Home </a>
        <?php
            if(isset($_SESSION['usuario']) == TRUE) {
                echo "<a href='logout.php'> Logout ($usuario)</a>";
                echo "<a href='nuevoitem.php'> Nuevo ítem </a>";
                if($usuario == "admin"){
                    echo "<a href='vencidas.php'> Subastas vencidas </a>";
                    echo "<a href='Publi.php'> Anunciantes </a>";
                }
            }
            else {
                echo "<a href='login.php'> Login </a>";
                echo "<a href='login.php'> Nuevo ítem </a>";
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