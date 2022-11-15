<?php 
    require 'cabecera.php';
    if (isset($_SESSION['user'])) {
?>

<body>
    
    <h1>Añade nuevo item</h1>
    <form action="#" method="post">
        <table>
            <!-- Categoria -->
            <tr>
                <td><label for="categoria">Categoría</label></td>
                <td>
                    <select id="categoria" name="categoria">
                        <?php cargarCategoriasEnTabla($conn); ?>
                    </select>
                </td>
            </tr>
            <!-- Nombre -->
            <tr>
                <td><label for="nombre">Nombre</label></td>
                <td><input type="text" name="nombre" id="nombre"></td>
            </tr>
            <!-- Descripción -->
            <tr>
                <td><label for="descripcion">Descripcion</label></td>
                <td><textarea name="descripcion" id="descripcion" cols="50" rows="10" maxlength="1500"></textarea></td>
            </tr>
            <!-- Fecha Fin -->
            <tr>
                <td><label for="fechaFin">Fecha de fín para pujas</label></td>
                <td>
                    <input type="datetime-local" name="fecha" id="fecha">
                </td>
            </tr>
            <!-- Precio -->
            <tr>
                <td><label for="precio">Precio</label></td>
                <td><input type="number" name="precio" id="precio" step="any"><?php echo MONEDA;?></td>
            </tr>
            <!-- btnEnviar -->
            <tr>
                <td colspan="2" class="registro"><input type="submit" id="enviar" name="enviar" value="Enviar"></td>
            </tr>
        </table>
    </form>
    <?php 
            if (isset($_POST['enviar'])) {
                $errores = comprobarFormulario();
                if ($errores == 0) {
                    $idItem = guardarItemEnBBDD($conn);
                    header("Location: editarItem.php?item=$idItem");
                }
            }
        // Cerrar Container y Main
            echo "</div>";
        echo "</div>";
        } else 
            header("Location: login.php?nuevoItem");
    ?>
</body>
</html>