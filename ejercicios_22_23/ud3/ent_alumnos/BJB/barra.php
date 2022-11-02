<?php
    include_once "config.php";
    $con = mysqli_connect(HOST, USER, PASS);
    mysqli_select_db($con, DATABASE);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php
        $catsql = "SELECT * FROM CATEGORIAS ORDER BY categoria ASC;";
        $catresult = mysqli_query($con,$catsql);
        echo "<h1>Categorias</h1>";
        echo "<ul>";
        echo "<li><a href='index.php'>Ver todas</a></li>";
        while($catrow = mysqli_fetch_assoc($catresult)) {
            echo "<li><a href='index.php?id="
                . $catrow['id'] . "'>" . ucfirst($catrow['categoria']) . "</a></li>";
        }
        echo "</ul>";
    ?>
    
</body>
</html>