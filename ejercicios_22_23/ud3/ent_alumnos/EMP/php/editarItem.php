<?php require 'cabecera.php'; ?>
<body>
    <?php 
        // Comprobar si el usuario puede estar aqui
        if (isset($_GET['item']) && $_SESSION['userID'] == idUserDeItem($conn, $_GET['item'])) {
            $item = itemPorId($conn, $_GET['item']);
            // Comprobar si se borrar img
            if (isset($_GET['borrar'])) {
                borrarImg($conn, $_GET['borrar']);
                // Redireccion sin borrar=NUM para evitar errores al refrescar la pagina
                header("Location: editaritem.php?item=".$_GET['item']);
            }
            // Comprobar que se sube una img
            if (isset($_POST['subir'])) {
                if ($_FILES['img']['size'] > 0)
                    guardarImg($conn, $_GET['item']);
            }
            // Comprobar si sube de precio
            $precioPartida = $item['preciopartida'];
            if (isset($_POST['subir'])) {
                if (cantPujasDeItem($conn, $_GET['item']) != 0)
                    echo "<div class='error'>No puedes cambiar el precio por que ya hay pujas</div>";
                else {
                    $subir = $_POST['nuevoPrecio'];
                    $precioPartida += $subir; 
                    cambiarPrecioPartida($conn, $_GET['item'], $precioPartida);
                }
            }
            // Comprobar si baja de precio
            if (isset($_POST['bajar'])) {
                if (cantPujasDeItem($conn, $_GET['item']) != 0)
                    echo "<div class='error'>No puedes cambiar el precio por que ya hay pujas</div>";
                else {
                    $bajar = $_POST['nuevoPrecio'];
                    if ($precioPartida-$bajar >= 0) {
                        $precioPartida -= $bajar;
                        cambiarPrecioPartida($conn, $_GET['item'], $precioPartida);
                    } else
                        echo "<div class='error'>No puedes dejar el precio en negativo</div>";
                }
            }
            // Comprobar si cambia de hora
            if (isset($_POST['mas1Hora']))
                cambiarFechaFin($conn, $_GET['item'], '1');
            if (isset($_POST['mas1Dia']))
                cambiarFechaFin($conn, $_GET['item'], '24');
        // Titulo del item
            echo "<h2>".$item['nombre']."</h2>";
    ?>
    <table>
        <tr>
            <td><b>Precio de salida: </b><?php echo $item['preciopartida'].MONEDA?></td>
            <td>
                <form action="#" method="post">
                    <input type="text" name="nuevoPrecio" id="nuevoPrecio">
                    <input type="submit" value="Bajar" name="bajar">
                    <input type="submit" value="Subir" name="subir">
                </form>
            </td>
        </tr>
        <tr>
            <td><b>Fecha fin para pujar: </b><?php echo $item['fechafin']?></td>
            <td>
                <form action="#" method="post">
                    <input type="submit" value="POSPONER 1 HORA" name="mas1Hora">
                    <input type="submit" value="POSPONER 1 DÍA" name="mas1Dia">
                </form>
            </td>
        </tr>
    </table>
    <h2>Imagenes actuales</h2>
    <?php 
        if (mostrarTodasImgDeItemEnTabla($conn,$_GET['item']) == 'SIN IMAGEN')
            echo 'No hay imágenes del item.';
    ?>
    <form action="#" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label for="img">Imagen a subir</label></td>
                <td><input type="file" name="img" accept="image/*"></td>
            </tr>
            <tr>
                <td colspan="2" class="registro"><input type="submit" value="Subir" name="subir"></td>
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