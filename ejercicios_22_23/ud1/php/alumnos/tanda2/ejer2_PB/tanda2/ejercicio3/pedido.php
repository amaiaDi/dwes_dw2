<?php

    $precio = 0;
    $total = 0;
    if(isset($_GET['precio'])) {
        $precio = $_GET['precio'];
        $total += $precio;
    }

    $mensaje = '';
    if (isset($_POST['aniadir'])) {
        if (empty($_POST['nombre'])) {
            $mensaje = 'No ha escrito el nombre del producto a añadir';
        }

        if (empty($_POST['precioNuevo'])) {
            $mensaje = 'No ha escrito el precio del producto a añadir';
        }

        if (empty($_POST['nombre']) && empty($_POST['precioNuevo'])) {
            $mensaje = 'No ha escrito el nombre y el precio del producto a añadir';
        }

        if (!empty($_POST['nombre']) && !empty($_POST['precioNuevo'])) {
            if (!is_numeric($_POST['precioNuevo'])) {
                $mensaje = 'El precio tiene que ser un valor numérico';
            } else {
                $file = fopen("articulos.txt", "a");
                fwrite($file, PHP_EOL . $_POST['nombre'] . ";" . $_POST['precioNuevo']);
                fclose($file);
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
    <title>Pedido</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
        <table style="width: 300px;">
            <tr><td colspan="3" style="background: lightgray; font-weight: bold; text-align: center; padding: 20px;">ELIGE TU PEDIDO</td></tr>
            <?php
                $file = fopen("articulos.txt", "r");
                while(!feof($file)) {    
                    $linea = fgets($file);
                    $datos = explode(';', $linea);
                    $nuevoTotal = $precio + floatval($datos[1]);
                    echo '<tr><td style="padding: 20px;">' . $datos[0] . '</td><td>' . $datos[1] . '</td><td><a href="?precio=' . $nuevoTotal . '">Añadir unidad</a></td></tr>';
                }
                fclose($file);
            ?>
            <tr><td colspan="3" style="background: lightgray; font-weight: bold; text-align: center; padding: 20px;">
                    TOTAL: <?php
                                echo $total;
                            ?>€</td></tr>
        </table>
    </form>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table style="width: 300px; margin-top: 20px">
            <tr><td colspan="3" style="background: lightgray; font-weight: bold; text-align: center; padding: 20px;">AÑADE ARTÍCULO</td></tr>
            <tr>
                <td><label for="nombre">Nombre: </label></td>
                <td><label for="precioNuevo">Precio(€): </label></td>
            </tr>
            <tr>
                <td><input type="text" name="nombre" id="nombre"></td>
                <td><input type="text" name="precioNuevo" id="precioNuevo"></td>
                <td><button type="submit" name="aniadir">AÑADIR</button></td>
            </tr>
        </table>
        <?php echo '<p>' . $mensaje . '</p>'; ?>
    </form>
</body>
</html>