<?php

    $idItem;
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $idItem = $_GET['id'];
        $titulo;
        $precio;
        $fecha;
        $sqlEditarItem = "SELECT * FROM items WHERE id=$idItem";
        $resultadoEditarItem = mysqli_query($con, $sqlEditarItem);
        while($rowEditarItem = mysqli_fetch_assoc($resultadoEditarItem)) {
            $titulo = $rowEditarItem['nombre'];
            $precio = $rowEditarItem['preciopartida'];
            $fecha = $rowEditarItem['fechafin'];
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
    <h1><?php echo $titulo; ?></h1>
    <table>
        <tr>
            <td><strong>Precio de salida: </strong> <?php echo $precio . DB_MONEDA; ?></td>
            <td><input type="text" name="cantidad"><button type="submit" name="bajar">BAJAR</button><button type="submit" name="subir">SUBIR</button></td>
        </tr>
        <tr>
            <td><strong>Fecha fin para pujar: </strong> <?php echo date_format(date_create($fecha), 'd/M/Y'); ?></td>
            <td><button type="submit" name="posponer_hora">POSPONER 1 HORA</button><button type="submit" name="posponer_dia">POSPONER 1 DIA</button></td>
        </tr>
    </table>
</body>
</html>