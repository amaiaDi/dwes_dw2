<?php
    require('header.php');
    $_SESSION['anteriorP'] = $_SERVER["REQUEST_URI"];
    echo "<h1>ITEMS DISPONIBLES</h1>";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $consulta = "SELECT * FROM items where id_cat = $id;";
    }
    else{
        $consulta = "SELECT * FROM items;";
    }

    $result = mysqli_query($conn, $consulta);

    echo "<table>
            <tr>
                <th>IMAGEN</th>
                <th>ITEM</th>
                <th>PUJAS</th>
                <th>PRECIO</th>
                <th>PUJAS HASTA</th>
            </tr>";
    foreach($result as $item){
        $idItem = $item['id'];

        //Consultas
        $consultaImg = "SELECT imagen FROM imagenes where id_item = $idItem;";
        $resultImg = mysqli_query($conn, $consultaImg);
        $imagen = mysqli_fetch_assoc($resultImg);

        $consultaPujas = "SELECT COUNT(*) FROM pujas where id_item = $idItem group by id_item;";
        $resultPujas = mysqli_query($conn, $consultaPujas);
        $pujas = mysqli_fetch_assoc($resultPujas);

        $consultaPrecio = "SELECT MAX(cantidad) FROM pujas where id_item = $idItem group by id_item;";
        $resultPrecio = mysqli_query($conn, $consultaPrecio);
        $precio = mysqli_fetch_assoc($resultPrecio);
        
        echo "<tr>
                <td>"; 
            echo $imagen == null? 'NO IMAGEN' : '<img src="img/'.$imagen['imagen'].'" alt="'.$imagen['imagen'].'" width="200"/>';
            echo"</td>
                <td>";
                echo "<a href='itemdetalles.php?id=$idItem'>".ucfirst($item['nombre'])."</a>";
                if(isset($_SESSION['usuario']) && $_SESSION['id'] == $item['id_user']){
                    echo "<a href='editaritem.php?id=$idItem'> [EDITAR]</a>";
                }
                echo "</td>
                <td>";
                echo $pujas == null? 0 : $pujas['COUNT(*)'];
                echo "</td>
                <td>";
                echo $precio == null? $item['preciopartida'] . "€" : $precio['MAX(cantidad)'] . "€";
                echo"</td>
                <td>".$item['fechafin']."</td>
              </tr>";

    }
    echo "</table>";
    
    require('pie.php');
?>