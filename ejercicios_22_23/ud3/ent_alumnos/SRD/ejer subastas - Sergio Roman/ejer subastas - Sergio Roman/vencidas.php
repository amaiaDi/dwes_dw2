<?php
    require('header.php');
    if(isset($_POST['check'])){
        foreach($_POST['check'] as $item){
            $borrarImagenes = "DELETE FROM imagenes where id_item = $item";
            $borrarPujas = "DELETE FROM pujas where id_item = $item";
            $borrarItem = "DELETE FROM items where id = $item";
            mysqli_query($conn, $borrarImagenes);
            mysqli_query($conn, $borrarPujas);
            mysqli_query($conn, $borrarItem);
        }
    }
    $fechaActual =date('Y-m-d H:i:00', time());
    $consultaSubastasVencidas = "SELECT * FROM items where fechafin < '$fechaActual'";
    $resulSubastasVencidas = mysqli_query($conn, $consultaSubastasVencidas);

    echo "<h1>Subastas vencidas</h1>";
    echo "<form action='vencidas.php' method='post'>
        <table>
        <tr>
            <th></th>
            <th>ITEM</th>
            <th>PRECIO FINAL</th>
            <th>GANADOR</th>
        </tr>";
        foreach($resulSubastasVencidas as $item){
            $item_id = $item['id'];
            echo "<tr>";
                echo "<td><input type='checkbox' name='check[]' value='$item_id'></td>
                    <td><a href='itemdetalles?id=$item_id'>" . $item['nombre'] . "</a></td>";
                    $consultaPujasDeItemVencido = "SELECT id_user, cantidad FROM pujas where id_item = $item_id and cantidad = (select max(cantidad) where id_item = $item_id);";
                    $resulPujasDeItemVencido = mysqli_query($conn, $consultaPujasDeItemVencido);
                    $precioFinal = mysqli_fetch_assoc($resulPujasDeItemVencido);
                    if($precioFinal != null){
                        echo "<td>PRECIO FINAL: " . $precioFinal['cantidad'] . "€</td>";
                        $consultaNombreGanador = "SELECT username FROM usuarios where id =" . $precioFinal['id_user'];
                        $resulNombreGanador = mysqli_query($conn, $consultaNombreGanador);
                        $nombreGanador = mysqli_fetch_assoc($resulNombreGanador);
                        echo "<td>Ganador: " . $nombreGanador['username'] . "</td>";

                    }
                    else{
                        echo "<td>PRECIO FINAL: " . $item['preciopartida'] . "€</td>";
                        echo "<td>Ganador: No hay pujas</td>";
                    }
            echo "</tr>";
        }
        echo "<tr><td colspan=4><input style='width: 100%' type='submit' name='borrar' value='BORRAR'></td></tr>
        </table>
    </form>";

    require('pie.php');
?>
    