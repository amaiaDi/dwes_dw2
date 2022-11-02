<?php require "cabecera.php";
    $_SESSION['link'] = $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    //INSERTAR NUEVO ITEM EN BD
    if (isset($_POST['submit'])) {
        $user = $_SESSION['user'];
        $cat = $_POST['cat'];
        $nom = $_POST['nom'];
        $desc = $_POST['desc'];
        $fecha = $_POST['anio'] . "-" . $_POST['mes'] . "-" . $_POST['dia'] . " " . $_POST['hora'] . ":" . $_POST['min'] . ":00";
        $prec = $_POST['prec'];
        $fecha = date($fecha);

        $sql = "INSERT INTO `items`(`id_cat`, `id_user`, `nombre`, `preciopartida`, `descripcion`, `fechafin`) VALUES ('$cat','$user','$nom','$prec','$desc','$fecha')";
        $resultado = $conn->query($sql);
        if($conn->errno) die($conn->error);
        $sql = "select max(id) as id from items";
        $resultado = $conn->query($sql);
        if($conn->errno) die($conn->error);
        $fila = $resultado -> fetch_assoc();
        $id = $fila['id'];
        header("Location: editaritem.php?item=$id");
    }

    if (isset($_SESSION['user'])) :
?>
<div> <!-- FORMULARIO ITEM -->
    <form action="nuevoitem.php" method="post">
        <table>
            <tr>
                <td>Categoria</td>
                <td>
                    <select name="cat" id="cat">
                        <?php
                            $sql = "select id,categoria from categorias";
                            $resultado = $conn->query($sql);
                            if($conn->errno) die($conn->error);
                            while($fila = $resultado -> fetch_assoc()) {
                                $id = $fila['id'];
                                $nom = $fila['categoria'];
                                echo "<option value='$id'>$nom</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td><input type="text" name="nom" id="nom" required></td>
            </tr>
            <tr>
                <td>Descripcion</td>
                <td><textarea name="desc" id="desc" cols="30" rows="10"></textarea></td>
            </tr>
            <tr>
                <td>Fecha de fin para pujas</td>
                <td>
                    <table>
                        <tr>
                            <td>Dia</td>
                            <td>Mes</td>
                            <td>Año</td>
                            <td>Hora</td>
                            <td>Minutos</td>
                        </tr>
                        <tr>
                            <td>
                                <select name="dia" id="dia">
                                    <?php 
                                        for ($i = 1; $i <= 31; $i++) {
                                            echo "<option value='$i'>$i</option>";
                                        }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select name="mes" id="mes">
                                    <?php 
                                        for ($i = 1; $i <= 12; $i++) {
                                            echo "<option value='$i'>$i</option>";
                                        }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select name="anio" id="anio">
                                    <?php 
                                        for ($i = 2022; $i <= 2050; $i++) {
                                            echo "<option value='$i'>$i</option>";
                                        }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select name="hora" id="hora">
                                    <?php 
                                        for ($i = 0; $i <= 23; $i++) {
                                            echo "<option value='$i'>$i</option>";
                                        }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select name="min" id="min">
                                    <?php 
                                        for ($i = 0; $i <= 59; $i++) {
                                            echo "<option value='$i'>$i</option>";
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>Precio</td>
                <td><input type="number" name="prec" id="prec" class="corto"> €</td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Enviar" name="submit"></td>
            </tr>
        </table>
    </form>
</div>
<?php else : ?>
    <h5>Para subastar un item debes autenticarte <a href="login.php">aqui</a></h5>
<?php endif ; ?>
<?php require "pie.php"; ?>