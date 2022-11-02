<?php
    $sql = "SELECT * FROM categorias ORDER BY categoria ASC;";
    $resultado = mysqli_query($con,$sql);
    echo "<h1>Categorias</h1>";
    echo "<ul>";
    echo "<li><a href='vertodas.php'>Ver todas</a></li>";
    while($fila = mysqli_fetch_assoc($resultado)) {
        echo "<li><a href='index.php?id="
            . $fila['id'] . "'>" . $fila['categoria']. "</a></li>";
    }
    echo "</ul>";
?>
