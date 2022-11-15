<?php

    if (!$_SESSION['username']) {
        header('Location: ?r=login');
    }

    $sqlAllCat = "SELECT * FROM categorias";
    $resultadoAllCat = mysqli_query($con, $sqlAllCat);

    $mensaje = '';
    if (isset($_POST['enviar'])) {
        if (empty($_POST['nombreNuevoItem']) || empty($_POST['descNuevoItem']) || empty($_POST['precioNuevoItem'])) {
            $mensaje = 'Campo vacío!';
        } else {
            if (!is_numeric($_POST['precioNuevoItem'])) {
                $mensaje = 'El campo del precio tiene que ser un valor numérico!';
            } else {
                //Se saca el ID de la categoría para luego insertarlo en la tabla de ITEMS
                $categoriaNuevoItem = $_POST['categoriasNuevoItem'];
                $sqlNumCat = "SELECT * FROM categorias WHERE categoria='$categoriaNuevoItem'";
                $resultadoNumCat = mysqli_query($con, $sqlNumCat);
                $idCategoria = 0;
                while($rowNumCat = mysqli_fetch_assoc($resultadoNumCat)) {
                    $idCategoria = $rowNumCat['id'];
                }
                $nombreNuevoItem = $_POST['nombreNuevoItem'];
                $descNuevoItem = $_POST['descNuevoItem'];
                $precioNuevoItem = $_POST['precioNuevoItem'];
                $fechaNuevoItem = $_POST['anioNuevoItem'] . '-' . $_POST['mesNuevoItem'] . '-' . $_POST['diaNuevoItem'];
                
                $fecha_actual = strtotime(date("Y-m-d"));
                $fecha_entrada = strtotime($fechaNuevoItem);

                if($fecha_actual > $fecha_entrada){
                    $mensaje = 'La fecha tiene que ser posterior a la actual!';
                } else {
                    $idUsuario = $_SESSION['id_user'];
                    $sqlMaxId = "SELECT MAX(id) FROM items";
                    $resultadoMaxId = mysqli_query($con, $sqlMaxId);
                    $rowMaxId = mysqli_fetch_array($resultadoMaxId);
                    $maxId = intval($rowMaxId[0]);
                    $sqlInsertarItem = "INSERT INTO items(id, id_cat, id_user, nombre, preciopartida, descripcion, fechafin) VALUES ($maxId+1, $idCategoria, $idUsuario, '$nombreNuevoItem', $precioNuevoItem, '$descNuevoItem', '$fechaNuevoItem')";
                    $resultadoInsertarItem = mysqli_query($con, $sqlInsertarItem);
                    header('Location: ?r=editaritem&id=' . ++$maxId);
                }
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Añade nuevo item</h2>
    <p style="color: red"><?php echo $mensaje; ?></p>
    <form action="" method="post">
        <table>
            <tr>
                <td>Categoría</td>
                <td>
                    <select name="categoriasNuevoItem">
                        <?php
                            while($rowAllCat = mysqli_fetch_assoc($resultadoAllCat)) {
                                echo '<option>' . $rowAllCat['categoria'] . '</option>';
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td><input type="text" name="nombreNuevoItem" required></td>
            </tr>
            <tr>
                <td>Descripción</td>
                <td><textarea name="descNuevoItem" cols="30" rows="10" required></textarea></td>
            </tr>
            <tr>
                <td>Fecha de fin para pujas</td>
                <td>
                    <table>
                        <tr>
                            <td>Día</td>
                            <td>Mes</td>
                            <td>Año</td>
                            <td>Hora</td>
                            <td>Minutos</td>
                        </tr>
                        <tr>
                            <td>
                                <select name="diaNuevoItem">
                                    <?php
                                        for ($i=1; $i <= 31; $i++) { 
                                            echo '<option>' . $i . '</option>';
                                        }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select name="mesNuevoItem">
                                    <?php
                                        for ($i=1; $i <= 12; $i++) { 
                                            echo '<option>' . $i . '</option>';
                                        }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select name="anioNuevoItem">
                                    <?php
                                        $anioActual = intval(date("Y"));
                                        for ($i=$anioActual; $i <= ($anioActual+5); $i++) { 
                                            echo '<option>' . $i . '</option>';
                                        }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select name="horaNuevoItem">
                                    <?php
                                        for ($i=0; $i <= 23; $i++) { 
                                            echo '<option>' . $i . '</option>';
                                        }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select name="minNuevoItem">
                                    <?php
                                        for ($i=0; $i <= 59; $i++) { 
                                            echo '<option>' . $i . '</option>';
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
                <td><input type="text" name="precioNuevoItem" required>€</td>
            </tr>
            <tr><td colspan="2"><button type="submit" name="enviar" style="width: 100%">Enviar!</button></td></tr>
        </table>
    </form>
</body>
</html>