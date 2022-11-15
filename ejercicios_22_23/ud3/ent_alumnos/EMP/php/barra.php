<?php 
    $categorias = obtenerCategorias($conn);
    echo "<div id='bar'>";
    echo "<h1>Categorias</h1>";
    echo "<ul>";
    echo "<li><a href='".DIR."'>Ver Todas</a></li>";
    foreach ($categorias as $categoria) {
        echo "<li><a href='".DIR."?id=".$categoria['id']."'>".$categoria['categoria']."</a></li>";
    }
    echo "</ul>";
    echo "</div>";
?>