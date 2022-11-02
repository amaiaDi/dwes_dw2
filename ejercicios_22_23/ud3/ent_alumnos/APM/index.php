<?php require "cabecera.php";
$_SESSION['link'] = $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
<h2>Items Disponibles</h2>
<table>
    <tr>
        <th>IMAGEN</th>
        <th>ITEM</th>
        <th>PUJAS</th>
        <th>PRECIO</th>
        <th>PUJAS HASTA</th>
    </tr>
    <?php //VISUALIZAR ITEMS
        $cat = isset($_GET['cat']) ? "and id_cat = (select id from categorias where categoria = '".$_GET['cat']."')" : '';
        $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
        $sql = "select it.id, it.id_user, it.nombre, it.preciopartida as pp, it.fechafin,
        (select imagen from imagenes where id_item = it.id limit 1) as imagen, 
        (select count(*) from pujas p3 where p3.id_item = it.id) as cont, 
        (select round(max(cantidad),2) from pujas where id_item = it.id) as cantidad
        from items it where now() < it.fechafin $cat";
        //CAMBIAR ESTO
        $resultado = $conn->query($sql);
        if($conn->errno) die($conn->error);
        while($fila = $resultado -> fetch_assoc()){
            $id = $fila['id'];
            echo "<tr>";
            if ($fila['imagen']) echo "<td><img src=$img" . $fila['imagen'] . "></td>";
            else echo "<td>SIN IMAGEN</td>";
            if ($user==$fila['id_user']) echo "<td><a href='itemdetalles.php?id=$id'>" . $fila['nombre'] . "</a> - <a href='editaritem.php?item=$id'>[editar]</a></td>";
            else echo "<td><a href='itemdetalles.php?id=$id'>" . $fila['nombre'] . "</a></td>";
            echo "<td>" . $fila['cont'] . "</td>";
            if ($fila['cont']==0) echo "<td>" . $fila['pp'] . "€</td>";
            else echo "<td>" . $fila['cantidad'] . "€</td>";
            echo "<td>" . $fila['fechafin'] . "</td>";
            echo "</tr>";
        }
    ?>
</table>
<?php require "pie.php"; ?>