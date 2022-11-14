<?php
    /**
     * Pagina encargada crear la estructura del menu lateral llamado barra. 
     * Menu que selecciona los items de la categorias a mostrar en el centro
     */

    //Consultamos en BD todas las categorias disponibles
    $resultado = mysqli_query($con,SQL_TODAS_CATEGORIAS);
?>
<h1>Categorias</h1>
<ul>
    <li><a href='index.php'>Ver todas</a></li>

    <?php
        while($fila = mysqli_fetch_assoc($resultado)) {
            echo "<li><a href='index.php?id="
                . $fila['id'] . "'>" . ucfirst($fila['categoria']) . "</a></li>";
        }
    ?>
</ul>