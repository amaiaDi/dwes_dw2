 <?php
    require("cabecera.php");
    $_SESSION['pagina_anterior'] =  $_SERVER["REQUEST_URI"]; 

?> 

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Items disponibles</h1>
    <table>
        <?php
        if(isset($_GET['id'])){
            $categoria = $_GET['id'];
            $final_query = "where items.id_cat = '$categoria'";
        } else {
            $final_query = "";
        }

        $item_sql = "select items.id, imagenes.imagen, items.nombre, items.preciopartida, items.fechafin
        from items
        left join imagenes on imagenes.id_item=items.id
        and imagenes.id = (select min(id) from imagenes where id_item = items.id)
        $final_query;
        ";
        $item_result = mysqli_query($con, $item_sql);
        ?>
       <tr>
            <th>IMAGEN</th>
            <th>ÍTEM</th>
            <th>PUJAS</th>
            <th>PRECIO</th>
            <th>PUJAS HASTA</th>
        </tr>
        <?php      
        while($item_row = mysqli_fetch_assoc($item_result)){
            $item_id = $item_row['id'];
            $item_nombre = $item_row['nombre'];
            echo "<tr>";
            // imagen 
            echo "<td>";
            if($item_row['imagen'] == null){
                echo "NO IMAGEN";
            } else {
                $imagen = CARPETA_IMAGENES . "/" . $item_row['imagen'];
                echo "<img src='$imagen' class='imagen'/>";
            }
            echo "</td>";
            // nombre (enlace)
            echo "<td>";
                echo "<a href='itemdetalles.php?item_id=$item_id&item_nombre=$item_nombre'>$item_nombre</a>";
                if(isset($usuario) && esDuenio($usuario, $item_id)){
                    echo "<a href='editaritem.php?id_item=$item_id'>[editar]</a>";
                }
            echo "</td>";
            // cantidad de pujas
            $cantidad = cantidadPujas($item_id);
            echo "<td>$cantidad</td>";
            
            // precio
            $precio = precioMaximo($item_id);
            $moneda = TIPO_MONEDA;
            echo "<td>$precio $moneda </td>";
    
            // fecha límite
            $fecha = $item_row['fechafin'];
            echo "<td>$fecha</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <?php require("pie.php"); ?>

</body>
</html>