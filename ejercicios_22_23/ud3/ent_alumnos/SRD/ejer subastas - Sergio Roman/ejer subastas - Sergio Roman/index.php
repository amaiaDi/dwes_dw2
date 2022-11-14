<?php
    require('header.php');
    echo "<h1>Items disponibles</h1>";
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $consultaSQL = "SELECT * FROM items where id_cat = $id;";
    }
    else
    {
        $consultaSQL = "SELECT * FROM items;";
    }
    if(isset($_SESSION['pagina']))
    {
        unset($_SESSION['pagina']);
    }
    $resulSQL = mysqli_query($conn, $consultaSQL);
    echo "<table>
            <tr>
                <th>IMAGEN</th>
                <th>ITEM</th>
                <th>PUJAS</th>
                <th>PRECIO</th>
                <th>PUJAS HASTA</th>
            </tr>";
    foreach($resulSQL as $item)
    {
        $id_item = $item['id'];

        $consultaImagenSQL = "SELECT imagen FROM imagenes where id_item = $id_item;";
        $resulImagenSQL = mysqli_query($conn, $consultaImagenSQL);
        $imagen = mysqli_fetch_assoc($resulImagenSQL);

        $consultaPujasSQL = "SELECT count(*) FROM pujas where id_item = $id_item";
        $resulPujasSQL = mysqli_query($conn, $consultaPujasSQL);
        $pujas = mysqli_fetch_assoc($resulPujasSQL);

        $consultaPrecioMaxSQL = "SELECT max(cantidad) FROM pujas where id_item = $id_item";
        $resulPrecioMaxSQL = mysqli_query($conn, $consultaPrecioMaxSQL);
        $precioMax = mysqli_fetch_assoc($resulPrecioMaxSQL);


        echo "<tr>
                <td>";
                echo $imagen == null ? 'NO IMAGEN' : '<img src="assets/img/'.$imagen['imagen'].'" alt="imagen" width="100">';
                echo "</td>
                <td><a href='itemdetalles.php?id=$id_item'>";
                echo ucfirst($item['nombre']);
                echo "</a>";
                if(isset($_SESSION['user']) && $_SESSION['id'] == $item['id_user'])
                {
                    echo " - <a href='editaritem.php?id=$id_item'>[editar]</a>";
                }
                echo "</td>";
                echo "<td>";
                echo $pujas['count(*)'];
                echo "</td>
                <td>";
                echo $pujas['count(*)'] == 0 ? $item['preciopartida'] . '€' : $precioMax['max(cantidad)'] . '€';
                echo "</td>
                <td>".$item['fechafin']."</td>
            </tr>";
    }
    echo "</table>";
    require('pie.php');
?>