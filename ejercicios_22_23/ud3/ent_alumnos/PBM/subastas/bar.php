<?php
    $catsql = "SELECT * FROM categorias ORDER BY categoria ASC;";
    $catresult = mysqli_query($con, $catsql);
    echo "<h1>Categorias</h1>";
    echo "<ul>";
    echo "<li><a href='cabecera.php'>Ver todas</a></li>";
    while($catrow = mysqli_fetch_assoc($catresult)) {
        echo "<li><a href='cabecera.php?id="
            . $catrow['id'] . "'>" . $catrow['categoria']. "</a></li>";
    }
    echo "</ul>";
?>