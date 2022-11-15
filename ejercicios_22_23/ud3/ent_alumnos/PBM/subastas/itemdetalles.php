<?php

    if (isset($_GET['item']) && !empty($_GET['item'])) {
        $idItem = $_GET['item'];
        $sqlDatosItem = "SELECT * FROM items WHERE id=$idItem";
        $resultadoDatosItem = mysqli_query($con, $sqlDatosItem);
        while($rowDatosItem = mysqli_fetch_assoc($resultadoDatosItem)) {
            echo '<h2>' . $rowDatosItem['nombre'] . '</h2>';

            $idItem = $rowDatosItem['id'];

            //Sacamos el número de pujas que tiene este item
            $sqlCantPujas = "SELECT COUNT(*) FROM pujas WHERE id_item=$idItem";
            $resultadoPujas = mysqli_query($con, $sqlCantPujas);
            $rowPujas = mysqli_fetch_array($resultadoPujas);
            $numPujas = 0;
            if (!empty($rowPujas[0])) {
                $numPujas = $rowPujas[0];
            }

            //Sacamos el precio actual de cada item, si han pujado por él ponemos el valor más elevado y en caso de que no, el precio de partida
            $sqlMaxCant = "SELECT MAX(cantidad) FROM pujas WHERE id_item=$idItem";
            $resultadoMaxCant = mysqli_query($con, $sqlMaxCant);
            $rowCantidad = mysqli_fetch_array($resultadoMaxCant);
            $precioActual = 0;
            if (!empty($rowCantidad[0])) {
                $precioActual = $rowCantidad[0];
            } else {
                $precioActual = $rowDatosItem['preciopartida'];
            }

            echo '<p><strong>Número de pujas: </strong>' . $numPujas . ' - <strong>Precio actual: </strong>' . $precioActual . ' - <strong>Fecha fin para pujar: </strong>' . $rowDatosItem['fechafin'] . '</p>';

            //Sacar las imágenes del item seleccionado
            $sqlImagenItem = "SELECT imagen FROM imagenes WHERE id_item=$idItem";
            $resultadoImagenItem = mysqli_query($con, $sqlImagenItem);
            $row = mysqli_fetch_array($resultadoImagenItem);
            if (!empty($row[0])) {
                echo '<p><img src="' . DB_RUTA_IMG . $row[0] . '" alt="' . $row[0] . '" style="width: 250px; height: 150px"/></p>';
            } else {
                echo '<p>No hay imágenes sobre este item</p>';
            }

            //Descripción del item
            echo '<p>' . $rowDatosItem['descripcion'] . '</p>';
            echo '<h2>Puja por este item</h2>';

            if(isset($_SESSION['username']) != TRUE) {
                //Lo que se dibuja en caso de que el usuario no esté logeado
                echo '<p>Para pujar, debes autenticarte, <a href="?r=login">aquí</a></p>';      
            } else {
                $mensaje = '';

                if (isset($_POST['cantidadPuja'])) {
                    if (empty($_POST['cantidadPuja'])) {
                        $mensaje = 'Campo vacío!';
                    } else {
                        if (!filter_var($_POST["cantidadPuja"], FILTER_VALIDATE_INT)) {
                            $mensaje = 'Tiene que ser un valor numérico!';
                        } else {
                            if ($precioActual > intval($_POST['cantidadPuja'])) {
                                $mensaje = 'Puja muy baja!';
                            } else {
                                $cantidad = intval($_POST['cantidadPuja']);
                                $idUser = $_SESSION['id_user'];
                                $sqlPujasDia = "SELECT COUNT(*) FROM pujas WHERE id_user=$idUser AND fecha=CURDATE()";
                                $resultadoPujasDia = mysqli_query($con, $sqlPujasDia);
                                $rowPujasDia = mysqli_fetch_array($resultadoPujasDia);
                                if (intval($rowPujasDia[0]) == 3) {
                                    $mensaje = 'Límite de 3 pujas por día';
                                } else {
                                    $sqlInsertarPuja = "INSERT INTO pujas (id_item, id_user, cantidad, fecha) VALUES ($idItem, $idUser, $cantidad, CURDATE())";
                                    $resultadoInsertarPuja = mysqli_query($con, $sqlInsertarPuja);
                                    if (mysqli_errno($con)) {
                                        die(mysqli_error($con));
                                    }
                                }
                            }
                        }
                    }
                }
                //Lo que se dibuja en caso de que el usuario esté logeado

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
    <form action="" method="post">
        <p>Añade tu puja en el cuadro inferior:</p>
        <table>
            <tr>
                <td><input type="text" name="cantidadPuja" id="cantidadPuja"></td>
                <td><button type="submit" name="pujar">¡Puja!</button><span style="color: red"><?php echo ' ' . $mensaje; ?></span></td>
            </tr>
        </table>
        <h2>Historial de la puja</h2>
        <ul>
            <?php
                if ($numPujas > 0) {
                    $sqlHistorialPujas = "SELECT usuarios.nombre, pujas.cantidad FROM usuarios, pujas WHERE usuarios.id=id_user AND id_item=$idItem ORDER BY pujas.cantidad DESC";
                    $resultadoHistorialPujas = mysqli_query($con, $sqlHistorialPujas);
                    while($rowHistorialPujas = mysqli_fetch_assoc($resultadoHistorialPujas)) {
                        echo '<li>' . $rowHistorialPujas['nombre'] . ' - ' . $rowHistorialPujas['cantidad'] . '€</li>';
                    }
                }
            ?>
        </ul>
    </form>
</body>
</html>
<?php
            }
        }
    }
?>