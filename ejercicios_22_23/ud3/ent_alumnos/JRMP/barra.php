<?php
    include_once "config.php";
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    mysqli_select_db($con, DB_DATABASE);
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
        $cat_sql = "SELECT * FROM CATEGORIAS ORDER BY categoria ASC;";
        $cat_result = mysqli_query($con,$cat_sql);
        echo "<h1>Categorias</h1>";
        echo "<ul>";
        echo "<li><a href='index.php'>Ver todas</a></li>";
        while($cat_row = mysqli_fetch_assoc($cat_result)) {
            echo "<li><a href='index.php?id="
                . $cat_row['id'] . "'>" . ucfirst($cat_row['categoria']) . "</a></li>";
        }
        echo "</ul>";
    ?>
    
</body>
</html>