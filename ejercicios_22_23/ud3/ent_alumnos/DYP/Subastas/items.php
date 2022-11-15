<?php
    $tabla = "";

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        //Ver Todas
        $sql = "SELECT * 
                FROM ITEMS
                WHERE id_cat = '$id'";
        $result = mysqli_query($con, $sql);

        while( $fila = mysqli_fetch_assoc($result)){
            $tabla = $tabla."<tr>";
            $nombre = $fila['nombre'];
                //Sacar imagen
                $imagen = sacarImagenes($con, $nombre);
                $tabla = $tabla."<td>$imagen</td>";
                //Sacar nombre
                $id = $fila['id'];
                $tabla = $tabla."<td><a href='index.php?ir=itemdetalles&id=$id'>$nombre </a></td>";
                //Sacar cantidad
                $cantidadPujas = sacarCantidadPujas($con, $nombre);
                $tabla = $tabla."<td>$cantidadPujas</td>";
                //Sacar precio
                $precioPartida = $fila['preciopartida'];
                $precio = sacarPrecio($con, $nombre, $precioPartida);
                $tabla = $tabla."<td>$precio</td>";
                //Sacar fecha limite
                $fechaLimite = $fila['fechafin'];
                $tabla = $tabla."<td>$fechaLimite</td>";

            $tabla = $tabla."</tr>";
        }
    }else{
        //Ver Todas
        $sql = "SELECT * 
                FROM ITEMS";
        $result = mysqli_query($con, $sql);

        while( $fila = mysqli_fetch_assoc($result)){
            $tabla = $tabla."<tr>";
            $nombre = $fila['nombre'];
                //Sacar imagen
                $imagen = sacarImagenes($con, $nombre);
                $tabla = $tabla."<td>$imagen</td>";
                //Sacar nombre
                $id = $fila['id'];
                $tabla = $tabla."<td><a href='index.php?ir=itemdetalles&id=$id'>$nombre </a></td>";
                //Sacar cantidad
                $cantidadPujas = sacarCantidadPujas($con, $nombre);
                $tabla = $tabla."<td>$cantidadPujas</td>";
                //Sacar precio
                $precioPartida = $fila['preciopartida'];
                $precio = sacarPrecio($con, $nombre, $precioPartida);
                $tabla = $tabla."<td>$precio</td>";
                //Sacar fecha limite
                $fechaLimite = $fila['fechafin'];
                $tabla = $tabla."<td>$fechaLimite</td>";

            $tabla = $tabla."</tr>";
        }
    }

    function sacarImagenes($con ,$nombreItem){
        $sql = "SELECT imagen 
                FROM imagenes
                where EXISTS
                    (SELECT *
                    FROM ITEMS
                    WHERE ITEMS.ID = IMAGENES.ID_ITEM
                    AND ITEMS.NOMBRE = '$nombreItem')";
        $result = mysqli_query($con, $sql);
        $fila = mysqli_fetch_Array($result);
        if($fila == null){
            return "No disponible";
        }else{
            return "<img src='imagenes/$fila[0]' width='150px'>";
        }
    }

    function sacarCantidadPujas($con ,$nombreItem){
        $sql = "SELECT count(*) 
                FROM PUJAS
                where EXISTS
                    (SELECT *
                    FROM ITEMS
                    WHERE ITEMS.ID = PUJAS.ID_ITEM
                    AND ITEMS.NOMBRE = '$nombreItem')";
        $result = mysqli_query($con, $sql);
        $fila = mysqli_fetch_Array($result);
        if($fila == null){
            return 0;
        }else{
            return $fila[0];
        }
    }

    //Imaginando que cantidad es precio
    function sacarPrecio($con ,$nombreItem, $precioPartida){
        $sql = "SELECT max(CANTIDAD)
                FROM PUJAS
                where EXISTS
                    (SELECT *
                    FROM ITEMS
                    WHERE ITEMS.ID = PUJAS.ID_ITEM
                    AND ITEMS.NOMBRE = '$nombreItem')";
        $result = mysqli_query($con, $sql);
        $fila = mysqli_fetch_Array($result);
        if($fila[0] == null){
            return $precioPartida;
        }else{
            return $fila[0];
        }
    }
?>
    <table>
                <caption><h1>ITEMS DISPONIBLES</h1></caption>
                <tr class="head">
                    <th>IMAGEN</th>
                    <th>ITEM</th>
                    <th>PUJAS</th>
                    <th>PRECIO</th>
                    <th>PUJAS HASTA</th>
                </tr>
                <tr class="body">
                    <?php 
                        echo $tabla;
                    ?>
                </tr>
    </table>