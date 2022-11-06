<?php
    /**
     * Pagina encargada crear la estructura del menu lateral llamado barra. 
     * Menu que selecciona los items de la categorias a mostrar en el centro
     */
    include_once "config.php";
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    mysqli_select_db($con, DB_DATABASE);
?>

<?php
    $cat_sql = SQL_TODAS_CATEGORIAS;
    $cat_result = mysqli_query($con,$cat_sql);
?>
<h1>Categorias</h1>
<ul>
    <li><a href='index.php'>Ver todas</a></li>

    <?php
        while($cat_row = mysqli_fetch_assoc($cat_result)) {
            echo "<li><a href='index.php?id="
                . $cat_row['id'] . "'>" . ucfirst($cat_row['categoria']) . "</a></li>";
        }
    ?>
</ul>