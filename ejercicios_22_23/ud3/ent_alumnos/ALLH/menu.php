<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="estilos.css">
        <title>Document</title>
    </head>
    <body>
        <a href="index.php">Home</a>
         <?php
            if(isset($_SESSION['USERNAME']) == TRUE) {
                echo "<a href='logout.php'>Logout</a>";
            }else {
                echo "<a href='login.php'>Login</a>";
            }
        ?>
        <a href="newitem.php">New Item</a>
    </body>
</html>