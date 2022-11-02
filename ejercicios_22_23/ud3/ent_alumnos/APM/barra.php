<div id="bar">
    <h3>CATEGORIAS</h3>
    <ul>
        <?php //CATEGORIAS
            $catnum = isset($_GET['cat']) ? $_GET['cat'] : null;
            if ($catnum != null) echo "<li><a href='.'>Ver todos</a></li>";
            else echo "<li><u><a href='.'>Ver todos</a></u></li>";  
            $sql = "SELECT * from categorias";  
            $resultado = $conn->query($sql);  
            if($conn->errno) die($conn->error);
            while($fila = $resultado -> fetch_assoc()){  
                $idcat = $fila['id'];
                $cat = $fila['categoria'];
                if ($catnum == $cat) echo "<li><u><a href='.?cat=$cat'>$cat</a></u></li>";
                else  echo "<li><a href='.?cat=$cat'>$cat</a></li>";
            }
        ?>
    </ul>
</div>