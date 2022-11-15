<?php

    echo '<h1>Items disponibles</h1>';
    echo '<table>
        <tr>
            <th>IMAGEN</th>
            <th>ITEM</th>
            <th>PUJAS</th>
            <th>PRECIO</th>
            <th>PUJAS HASTA</th>
        </tr>';

        if (isset($_GET['id']) && !empty($_GET['id'])) {

            //Una consulta que devuelva los items de una categoría en concreto
            $idCategoria = $_GET['id'];

            $sqlItemsCat = "SELECT * FROM items WHERE id_cat=$idCategoria";
            $resultadoItemsCat = mysqli_query($con, $sqlItemsCat);

            while($rowItemsCat = mysqli_fetch_assoc($resultadoItemsCat)) {
                //Hay que mirar por el precio actual de la puja porque si no ha recibido se pone el precio de partida y si ha recibido pues el actual
                
                echo '<tr>';
                    //Cuando hemos sacado el item, cogemos su id para hacer otra consulta con la tabla imágenes
                    $idItem = $rowItemsCat['id'];
                    $sqlImagenItem = "SELECT imagen FROM imagenes WHERE id_item=$idItem";
                    $resultadoImagenItem = mysqli_query($con, $sqlImagenItem);
                    $rowImagen = mysqli_fetch_array($resultadoImagenItem);
                    if (!empty($rowImagen[0])) {
                        echo '<td><img src="' . DB_RUTA_IMG . $rowImagen[0] . '" alt="' . $rowImagen[0] . '" style="width: 250px; height: 150px"/></td>';
                    } else {
                        echo '<td>NO IMAGEN</td>';
                    }
                    echo '<td><a href="?r=itemdetalles&item=' . $rowItemsCat['id'] . '">' . $rowItemsCat['nombre'] . '</a></td>';
                    
                    //Cogemos el id del item de nuevo para hacer una consulta en la tabla pujas para ver cuántos han pujado por dicho item
                    $sqlCantPujas = "SELECT COUNT(*) FROM pujas WHERE id_item=$idItem";
                    $resultadoPujas = mysqli_query($con, $sqlCantPujas);
                    $rowPujas = mysqli_fetch_array($resultadoPujas);
                    if (!empty($rowPujas[0])) {
                        echo '<td>' . $rowPujas[0] . '</td>';
                    } else {
                        echo '<td>0</td>';
                    }
                    
                    //Cogemos el id del item de nuevo para hacer una consulta en la tabla pujas para ver cuál es la puja más alta, en caso de no haber pujas se pone el precio de partida
                    $sqlMaxCant = "SELECT MAX(cantidad) FROM pujas WHERE id_item=$idItem";
                    $resultadoMaxCant = mysqli_query($con, $sqlMaxCant);
                    $rowCantidad = mysqli_fetch_array($resultadoMaxCant);
                    if (!empty($rowCantidad[0])) {
                        echo '<td>' . $rowCantidad[0] . '</td>';
                    } else {
                        echo '<td>' . $rowItemsCat['preciopartida'] . '</td>';
                    }
                    echo '<td>' . $rowItemsCat['fechafin'] . '</td>
                </tr>';
            }            
            
        } else {

            //Una consulta que devuelva todos los items, da igual de que categoría sean
            
            $sqlItems = "SELECT * FROM items";
            $resultadoItems = mysqli_query($con, $sqlItems);

            while($rowItems = mysqli_fetch_assoc($resultadoItems)) {
                echo '<tr>';
                $idItem = $rowItems['id'];
                $sqlImagenItem = "SELECT imagen FROM imagenes WHERE id_item=$idItem";
                $resultadoImagenItem = mysqli_query($con, $sqlImagenItem);
                $row = mysqli_fetch_array($resultadoImagenItem);
                if (!empty($row[0])) {
                    echo '<td><img src="' . DB_RUTA_IMG . $row[0] . '" alt="' . $row[0] . '" style="width: 250px; height: 150px"/></td>';
                } else {
                    echo '<td>NO IMAGEN</td>';
                }
                echo '<td><a href="?r=itemdetalles&item=' . $rowItems['id'] . '">' . $rowItems['nombre'] . '</a></td>';
                $sqlCantPujas = "SELECT COUNT(*) FROM pujas WHERE id_item=$idItem";
                $resultadoPujas = mysqli_query($con, $sqlCantPujas);
                $rowPujas = mysqli_fetch_array($resultadoPujas);
                if (!empty($rowPujas[0])) {
                    echo '<td>' . $rowPujas[0] . '</td>';
                } else {
                    echo '<td>0</td>';
                }
                $sqlMaxCant = "SELECT MAX(cantidad) FROM pujas WHERE id_item=$idItem";
                $resultadoMaxCant = mysqli_query($con, $sqlMaxCant);
                $rowCantidad = mysqli_fetch_array($resultadoMaxCant);
                if (!empty($rowCantidad[0])) {
                    echo '<td>' . $rowCantidad[0] . '</td>';
                } else {
                    echo '<td>' . $rowItems['preciopartida'] . '</td>';
                }
                echo '<td>' . $rowItems['fechafin'] . '</td>
            </tr>';
        }

    }

    echo '</table>';

?>