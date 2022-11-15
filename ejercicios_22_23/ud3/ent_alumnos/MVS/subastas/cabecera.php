<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Subastas</title>
</head>
<body>
    <?php
        if (!isset($_GET['log'])) {
            unset($_SESSION['user']);
            unset($_SESSION['pass']);
        }
    ?>
    <div id="header"><h1>SUBASTAS DEWS</h1></div>
    <div id="menu">
        <a href="#">Home</a>
        <?php
            if (isset($_SESSION['user'])) {
                echo "<a href='index.php?log=1'>Logout</a>";
            }
            else {
                echo "<a href='login.php'>Login</a>";
            }
        ?>
        <a href="#">Nuevo item</a>
    </div>
    <div id="container">
        <div id="bar">
            <?php
                include __DIR__ . '\barra.php';
            ?>
        </div>
        <div id="main">
            
        </div>
    </div>
</body>
</html>