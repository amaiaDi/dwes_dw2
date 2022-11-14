<?php
    require('header.php');

    echo "<h1>Subastas vencidas</h1>";

    echo "<form action='vencidas.php' method='post'>
        <table>
            <tr>
                <th></th>
                <th>ITEM</th>
                <th>PRECIO FINAL</th>
                <th>GANADOR</th>
            </tr>";

    //Borrar pujas
    if(isset($_POST['vencidas'])){
        $arrBorrar = $_POST['vencidas'];
        foreach($arrBorrar as $borr){
            $deleteImg = "DELETE FROM imagenes WHERE id_item = $borr;";
            mysqli_query($conn, $deleteImg);
            $deletePujas = "DELETE FROM pujas WHERE id_item = $borr;";
            mysqli_query($conn, $deletePujas);
            $deleteItem = "DELETE FROM items WHERE id = $borr;";
            mysqli_query($conn, $deleteItem);
        }
    }

    //Consulta para mostrar las pujas vencidas
    $fechaActual = date("Y-m-d H:i");
    $consulta = "SELECT * FROM items WHERE fechafin < '$fechaActual';";
    $result = mysqli_query($conn, $consulta);

    foreach($result as $item){
        $itemId = $item['id'];

        $consultaPrecio = "SELECT cantidad, id_user FROM pujas WHERE id_item = $itemId AND cantidad = (SELECT MAX(cantidad) FROM pujas WHERE id_item = $itemId) GROUP BY id_item;";
        $resultPrecio = mysqli_query($conn, $consultaPrecio);
        $precio = mysqli_fetch_assoc($resultPrecio);

        echo "<tr>
                <td><input type='checkbox' name='vencidas[]' value='$itemId'></td>
                <td><a href='itemdetalles.php?id=$itemId'>".ucfirst($item['nombre'])."</a></td>
                <td>PRECIO FINAL: ";
            if($precio == null){
                echo $item['preciopartida'] . "€</td>";
                echo "<td>Ganador: No hay pujas</td>";
            }
            else{
                echo $precio['cantidad'] . "€";
                $consultaGanador = "SELECT username FROM usuarios WHERE id = ".$precio['id_user'].";";
                $resultadoGanador = mysqli_query($conn, $consultaGanador);
                $ganador = mysqli_fetch_assoc($resultadoGanador);

                echo "<td>Ganador: ".$ganador['username']."</td>";
            }

            echo "</tr>";

    }
    echo "<tr><td colspan='4'><input type='submit' value='BORRAR' name='borrar' style='width: 100%'></td></tr>";
    echo "</table></form>";


    require('pie.php');
?>
