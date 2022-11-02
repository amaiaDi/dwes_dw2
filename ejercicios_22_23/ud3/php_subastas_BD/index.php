<?php
    
   
    require("header.php");
   
    if (!isset($_GET['id']))
         $sql = "SELECT items.* FROM items WHERE fechafin > NOW()";
    else{
        if (is_numeric($_GET['id']))
            $sql = "SELECT * FROM items WHERE fechafin > NOW() AND id_cat = " . $_GET['id'];
        else
             header("Location: ".$config_basedir);  
    }
   
    $result = mysqli_query($db,$sql);
    $numrows = mysqli_num_rows($result);
    echo "<h1>Items disponibles</h1>";
    echo "<table cellpadding='5'>";
    echo "<tr>";
    echo "<th>Imagen</th>";
    echo "<th>Item</th>";
    echo "<th>Pujas</th>";
    echo "<th>Precio</th>";
    echo "<th>Pujas hasta</th>";
    echo "</tr>";
    
    
    if($numrows == 0) {
        echo "<tr><td colspan=4>No hay items!</td></tr>";
    }
    else {
        while($row = mysqli_fetch_assoc($result)) {
            
            //MOSTRAR LA PRIMERA IMAGEN DE LA TABLA IMAGENES        
            $imagesql = "SELECT * FROM imagenes WHERE id_item = " . $row['id'] . " LIMIT 1";
            $imageresult = mysqli_query($db,$imagesql);
            $imagenumrows = mysqli_num_rows($imageresult);
            echo "<tr>";
            if($imagenumrows == 0) {
                echo "<td>NO IMAGEN</td>";
            }
            else {
                $imagerow = mysqli_fetch_assoc($imageresult);
                echo "<td><img src='./imagenes/". $imagerow['imagen'] . "' width='70'></td>";
            }
       
            //Nombre del item con enlace para ver sus detalles
            // y si es el creador del item enlace para editarlo
            echo "<td>";
            echo "<a href='itemdetails.php?id=". $row['id'] . "'>" . $row['nombre'] . "</a>";
            if((isset($_SESSION['USERID'])) && ($_SESSION['USERID'] == $row['id_user'])) {
                echo " - [<a href='addimages.php?id=". $row['id'] . "'>editar</a>]";
            }
            echo "</td>";
    
            //Cantidad de pujas
            $bidsql = "SELECT id_item, MAX(cantidad) AS pujamasalta, COUNT(id) AS numeropujas FROM pujas
                    WHERE id_item=" . $row['id'] . " GROUP BY id_item;";
            $bidresult = mysqli_query($db,$bidsql);
            $bidrow = mysqli_fetch_assoc($bidresult);
            $bidnumrows = mysqli_num_rows($bidresult);
            echo "<td>";
            if($bidnumrows == 0) {
                echo "0";
            }
            else {
                echo $bidrow['numeropujas'] . "</td>";
            }
    
            //Precio de partida (si aún no tiene pujas) o puja más alta
            echo "<td>";
            if($bidnumrows == 0) {
                echo sprintf('%.2f', $row['preciopartida']);
            }
            else {
                echo sprintf('%.2f', $bidrow['pujamasalta']);
            }
            echo " $config_currency</td>";
    
            //Fecha límite para pujas
            echo "<td>" . date("D jS F Y g.iA",strtotime($row['fechafin'])) . "</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
 
?>
