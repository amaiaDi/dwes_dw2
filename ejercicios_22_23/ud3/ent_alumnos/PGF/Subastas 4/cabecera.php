<!DOCTYPE html>
<html>
    <?php
        include_once("config.php");
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);

        mysqli_select_db($conn, DB_DATABASE);

        
        $sql="SELECT id as idIt, nombre as nom ,fechafin as fechaF,preciopartida as preciopartida,id_cat as id_cat,
        (SELECT imagen as imagen FROM imagenes WHERE id_item=idIt limit 1)as imagen,
        (SELECT count(*) as cantidadP FROM pujas WHERE id_item=idIT)as cantidadP,
        (SELECT MAX(cantidad) FROM pujas WHERE cantidadP!=0 and idIT=id_item) precio,
        (SELECT categoria as categoria FROM categorias WHERE id_cat=id) as categoria
        FROM items";

        $resultado= $conn->query($sql);
        print "<table>";
        print "<tr>
                <td>IMAGEN</td>
                <td>ITEM</td>
                <td>PUJAS</td>
                <td>PRECIO</td>
                <td>PUJAS HASTA</td>
            </tr>";

        while($fila = $resultado -> fetch_assoc()){ 
            if(!isset($_GET["categoria"])){
                print "<tr>";
                if(!is_null($fila["imagen"])){
                    print "<td><img src='imagenes/$fila[imagen]' width=100px height=100px></td>";
                }
                else{
                    print"<td>NO IMAGEN</td>";
                }
                print "<td>$fila[nom]</td>";
                print "<td>$fila[cantidadP]</td>";
                if(!is_null($fila["precio"])){
                    print "<td>$fila[precio]</td>";
                }
                else{
                    print "<td>$fila[preciopartida]</td>";
                }   
            print"<td>$fila[fechaF]</td>";
            
            }
            else{
            if($_GET["categoria"]==$fila["categoria"]){
                print "<tr>";
                if(!is_null($fila["imagen"])){
                    print "<td><img src='imagenes/$fila[imagen]' width=100px height=100px></td>";
                }
                else{
                    print"<td>NO IMAGEN</td>";
                }
                print "<td>$fila[nom]</td>";
                print "<td>$fila[cantidadP]</td>";
                if(!is_null($fila["precio"])){
                    print "<td>$fila[precio]</td>";
                }
                else{
                    print "<td>$fila[preciopartida]</td>";
                }   
            print"<td>$fila[fechaF]</td>";
            }
        }
        }
        $conn->close();
    ?>
        </table>
</html>