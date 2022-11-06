 <?php
     /**
     * Pagina pagina index principal
     */
    require("cabecera.php");
    $_SESSION['pagina_anterior'] =  $_SERVER["REQUEST_URI"]; 

    if(isset($_GET['id'])){
        $categoria = $_GET['id'];
        $final_query = " where items.id_cat = '$categoria'";
    } else {
        $final_query = "";
    }

    $item_sql = SQL_TODOS_ITEMS_DISPONIBLES.$final_query;

    $item_result = mysqli_query($con, $item_sql);
?> 

    <h1><?=TITULO_ITEMS_DISPONIBLE?></h1>
    <table>
       <tr>
            <th><?=TITULO_IMAGEN?></th>
            <th><?=TITULO_ITEM?></th>
            <th><?=TITULO_PUJAS?></th>
            <th><?=TITULO_PRECIO?></th>
            <th><?=TITULO_PUJAS_HASTA?></th>
        </tr>
        <?php      
        while($item_row = mysqli_fetch_assoc($item_result)){
            $item_id = $item_row['id'];
            $item_nombre = $item_row['nombre'];
            echo "<tr>";
            // imagen 
            echo "<td>";
            if($item_row['imagen'] == null){
                echo TEXTO_NO_IMAGEN;
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
