<?php

    $mensaje_error = '';
    $mensaje = '';
    $cantidad = '';
    $conversion = 0;

    if (isset($_POST['convertir'])) {
        if (empty($_POST['cantidad'])) {
            $mensaje_error = '¡VACÍO!';
        } else {
            if (!is_numeric($_POST['cantidad'])) {
                $mensaje_error = '¡NO NUMÉRICO!';
            } else {
                $conversion = intval($_POST['cantidad']);
                if (strcmp($_POST['dinero'], 'euro') === 0) {
                    $conversion *= 0.99;
                    $mensaje = $conversion . '$';
                }

                if (strcmp($_POST['dinero'], 'dolar') === 0) {
                    $conversion *= 1.01;
                    $mensaje = $conversion . '€';
                }

                $fp = fopen('archivo_conversion.txt', 'a');
                fwrite($fp, $mensaje . PHP_EOL);
                fclose($fp);
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
    <title>Ejercicio 5</title>
</head>
<body>
    <form name="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table>
            <tr>
                <td rowspan="2"><label for="cantidad">Cantidad: </label><input type="text" name="cantidad" value="<?php
                                                                                                                    if (isset($_POST['convertir'])) {
                                                                                                                        echo '';
                                                                                                                    }

                                                                                                                    if (isset($_POST['convertir']) && !empty($_POST['cantidad'])) {
                                                                                                                        echo $_POST['cantidad'];
                                                                                                                    }
                                                                                                                ?>" ><p style="color: red">
                    <?php
                        if (isset($_POST['convertir']) && empty($_POST['cantidad'])) {
                            echo $mensaje_error;
                        } else if (isset($_POST['convertir']) && !empty($mensaje_error)) {
                            echo $mensaje_error;
                        }
                    ?>
                </p></td>
                <td>
                    <input type="radio" name="dinero" id="dinero" value="euro" checked="checked" <?php
                                                                                                    if (isset($_POST['convertir']) && $_POST['dinero']=="euro") {
                                                                                                        echo 'checked="checked"';
                                                                                                    }
                                                                                                ?>>Euros a dólares
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="dinero" id="dinero" value="dolar" <?php
                                                                                    if (isset($_POST['convertir']) && $_POST['dinero']=="dolar") {
                                                                                        echo 'checked="checked"';
                                                                                    }
                                                                                ?>>Dólares a euros
                </td>
            </tr>
            <tr>
                <td><p><strong>
                    <?php
                        if (isset($_POST['convertir']) && !empty($_POST['cantidad'])) {
                            echo $mensaje;
                        }
                    ?>
                </strong></p></td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="CONVERTIR" name="convertir">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>