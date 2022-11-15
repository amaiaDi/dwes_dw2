<?php
    $sql = "SELECT * FROM categorias ORDER BY categoria ASC";
    $result = mysqli_query($con, $sql);
    echo "<h1>CATEGORIAS</h1>";
    echo "<ul>";
        echo "<li><a href='index.php'>Ver todas</a></li>";
        while($fila = mysqli_fetch_array($result)){
            echo "<li><a href='index.php?id=".$fila['id']."'>".$fila['categoria']."</a></li>";
        }
    echo "</ul>";
?>