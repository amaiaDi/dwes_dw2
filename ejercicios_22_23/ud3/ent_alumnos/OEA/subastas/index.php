<?php
    if(isset($_SESSION['usuario']))
        $_SESSION['ultimaPagina'] = $_SERVER["REQUEST_URI"];
    function rellenarTabla($conn){
        if(isset($_GET['id']))
            $sql = "SELECT * FROM items WHERE ".$_GET['id'] ."= id_cat";
        else
            $sql = "SELECT * FROM items ORDER BY id_cat";
        $resultado = mysqli_query($conn,$sql);
        if(mysqli_errno($conn)) die(mysqli_error($conn));
        while($fila = mysqli_fetch_assoc($resultado)){
            
            $sqlImg = "SELECT imagen FROM imagenes WHERE ".$fila['id']." = id_item";
            $imagen = mysqli_query($conn,$sqlImg);
            $sqlPujas = "SELECT count(*) FROM pujas WHERE ".$fila['id']." = id_item";
            $pujas = mysqli_query($conn,$sqlPujas);
            $sqlPrecio = "SELECT MAX(cantidad) FROM pujas WHERE ".$fila['id']." = id_item";
            $precio = mysqli_query($conn,$sqlPrecio);
            //Sacamos resultados
            $resultadoImg = mysqli_fetch_assoc($imagen);
            $resultadoPujas = mysqli_fetch_assoc($pujas);
            $resultadoPrecio = mysqli_fetch_assoc($precio);
            echo "<tr>";
                if(empty($resultadoImg['imagen']))
                    echo "<td>NO IMAGEN</td>";
                else
                    echo "<td>".$resultadoImg['imagen']."</td>";
                echo "<td><a href='itemdetalles.php?id=".$fila['id']."'>".$fila['nombre']."</a></td>";
                echo "<td>".$resultadoPujas['count(*)']."</td>";
                if(empty($resultadoPrecio['MAX(cantidad)']))
                    echo "<td>".$fila['preciopartida'].DB_MONEDA."</td>";
                else
                    echo "<td>".$resultadoPrecio['MAX(cantidad)'].DB_MONEDA."</td>";
                echo "<td>".$fila['fechafin']."</td>";
            echo "</tr>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo DB_TITULO; ?></title>
</head>
<body>
    <?php require("cabecera.php"); ?>
    <table>
        <h1>Items disponibles</h1>
        <tr class="head">
            <th>IMAGEN</th>
            <th>ITEM</th>
            <th>PUJAS</th>
            <th>PRECIO</th>
            <th>PUJAS HASTA</th>
        </tr>
        <?php rellenarTabla($con); ?>
    </table>
    <?php  require("pie.php"); ?>
</body>
</html>