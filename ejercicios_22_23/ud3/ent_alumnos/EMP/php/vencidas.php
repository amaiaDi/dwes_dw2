<?php require 'cabecera.php'; ?>
<body>
    <?php 
        // Comprobar si el usuario puede estar aqui
        if ($_SESSION['user'] == 'admin') {
            if (isset($_POST['borrar'])) {
                if (isset($_POST['item']))
                    $itemsABorrar = $_POST['item'];
                    foreach ($itemsABorrar as $item) {
                        borrarItemDeLaBBDD($conn, $item);
                    }
            }
    ?>
    <h2>Subastas vencidas</h2>
    <form action="#" method="post">
    <table>
        <tr>
            <th colspan="2">ITEM</th>
            <th>PRECIO FINAL</th>
            <th>GANADOR</th>
        </tr>
        <?php aniadirSubastasVencidas($conn); ?>
        <tr>
            <td colspan="4" class="registro"><input type="submit" value="Borrar" name="borrar"></td>
        </tr>
    </table>
    </form>
    <?php
        // Cerrar Container y Main
            echo "</div>";
        echo "</div>";
    ?>
</body>
</html>
<?php 
// cerrar if si deberias estar aqui
} else {
    echo "<h1>No deberias estar aquí</h1>";
}
?>