<?php 
if (isset($_GET['item'])) {
    require 'cabecera.php';
    // Obtener datos del item
    $item = itemPorId($conn, $_GET['item']);
    $idItem = $item['id'];
    $idCat = $item['id_cat'];
    $idUser = $item['id_user'];
    $nombre = $item['nombre'];
    $precioPartida = $item['preciopartida'];
    $descripcion = $item['descripcion'];
    $fechaFin = $item['fechafin'];
    $pujaMasAlta = pujaMasAltaDeItem($conn, $idItem);

?>
<body>
    <?php
        echo "<h1>$nombre</h1>";
        $cantPujas = cantPujasDeItem($conn, $idItem);
        echo "<p><b>Número de pujas:</b> $cantPujas - <b>Precio actual</b>: $pujaMasAlta -  <b>Fecha fin para pujar:</b> $fechaFin</p>";
        mostrarTodasImgDeItem($conn, $idItem);
        echo "<p>$descripcion</p>";
    ?>
    <h2>Puja por este item</h2>
    <?php 
        if (!isset($_SESSION['user'])) 
            echo "<p>Para puajr, debes autenticarte<b><a href='login.php?referer=itemdetalles.php?item=$idItem'>Aquí</a></b><p>";
        else {
    ?>
    <form action="#" method="post">
        <table>
            <tr>
                <td><input type="number" name="cantidad" id="canitdad" step="0.01"></td>
                <td><input type="submit" name="puja" value="¡Puja!"></td>
            </tr>
        </table>
    </form>
    <?php 
        if (isset($_POST['puja'])) {
            if (isset($_POST['cantidad'])) {
                $cantidadPuja = $_POST['cantidad'];
                if ($cantidadPuja <= $pujaMasAlta) {
                    echo "<p class='error'>Puja muy baja!</p>";
                } else {
                    if (cantPujasDeUsuarioItemHoy($conn, $idItem, $_SESSION['userID']) < 3) {
                        aniadirPuja($conn, $idItem, $_SESSION['userID'], $cantidadPuja);
                    } else {
                        echo "<p class='error'>Límite de 3 pujas por día</p>";
                    }
                }
            }
        }
    ?>
    <h2>Historial de la puja</h2>
    <?php
        cargarListaPujaItem($conn, $idItem);
        }
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