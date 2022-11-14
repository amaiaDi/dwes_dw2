<?php ?>
    <h1>Categorias</h1>
    <ul>
        <li><a href="index.php">Ver todas</a></li>
        <?php 
            $sql = "SELECT id, categoria FROM categorias";
            $resultado = $conn-> query($sql);
            if($conn->errno) die($conn->error);
            while($fila_cat = $resultado -> fetch_assoc()){
                $id_cat = $fila_cat["id"];
                $categoria = $fila_cat["categoria"];
                echo "<li> <a href='index.php?categoria=$id_cat'>$categoria</a></li>";  
            }             
        ?>
    </ul>
<?php ?>