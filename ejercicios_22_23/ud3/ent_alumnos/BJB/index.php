<?php require("cabecera.php"); ?>
<?php
    $con = mysqli_connect(HOST, USER, PASS);
    mysqli_select_db($con, DATABASE);
    $_SESSION['pagina']=$_SERVER["REQUEST_URI"];
?>

<!DOCTYPE html>
<html lang="eS">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Items disponibles</h1>
    <table>
        <tr>
            <th>IMAGEN</th>
            <th>ITEM</th>
            <th>PUJAS</th>
            <th>PRECIO</th>
            <th>PUJAS HASTA</th>
        </tr>
        <?php
        $tipo="";
        if(isset($_GET['id'])){
            $a=$_GET['id'];
            $tipo=" where id_cat=$a";
        }
        $consulta=  "select  imagenes.imagen, items.nombre, items.id, items.preciopartida, items.fechafin, items.id_cat
                    from items
                    left join imagenes on imagenes.id_item=items.id 
                    $tipo
                    group by id_item;";

        $resultado = mysqli_query($con, $consulta);
        while($item_row = mysqli_fetch_assoc($resultado)){
            echo '<tr>';

            //Imagenes
            if($item_row['imagen']==null){
                echo '<td>NO IMAGEN</td>';
            }
            else{
                $imagen=$item_row['imagen'];
                echo "<td><img src=img/$imagen class='imgprinci'/></td>";
            }

            //Nombres
            $nombre=$item_row['nombre'];
            $id=$item_row['id'];
            echo "<td><a href='itemdetalles.php?nombre=$nombre&id=$id'>$nombre</a></td>";
            
            //pujas
            $pujas=$item_row['id'];
            $resultpuj=cuantasPujas($pujas);
            echo "<td>$resultpuj</td>";
            
            //precio
            $resultprecio=preciopuja($pujas);
            if($resultprecio==null){
                echo '<td>NO HAY PUJA</td>';
            }
            else{
                echo "<td>$resultprecio</td>";
            }
            
            //fecha maxima
            $fecha=$item_row['fechafin'];
            echo "<td>$fecha</td>";

            echo '</tr>';
        }
        ?>
    </table>
    <?php require("pie.php"); ?>
    
</body>
</html>