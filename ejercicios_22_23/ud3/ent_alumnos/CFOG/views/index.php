<?php
require_once "./header.php";
require_once "../DB/DB_bid.php";
require_once "../DB/DB_image.php";
require_once "../DB/DB_item.php";
require_once "../lib/format.php";

$_SESSION["lastVisitedPage"]="./index.php";

function drawTbody_itemData()
{
    $category_id="";
    if(isset($_GET["item_category_id"]))
        $category_id=$_GET["item_category_id"];
    $itemsOfCategory=getItemsOfCategory($category_id);

    $txtHTML="";
    for($i=0; $i<count($itemsOfCategory); $i++)
    {
        $itemOfCategory=$itemsOfCategory[$i];
        
        $item_id=$itemOfCategory["id"];
        $item_imgPath=getImageOfItem($item_id);

        $item_bidData=getBidDataOfItem($item_id);
        $item_bidData_quantity=$item_bidData[0];
        $item_bidData_maxPrice=$item_bidData[1];
        if($item_bidData_maxPrice==-1)
            $item_bidData_maxPrice=$itemOfCategory["preciopartida"];

        $item_user_id=$itemOfCategory["id_user"];
        $item_name=$itemOfCategory["nombre"];
        $item_endDate=$itemOfCategory["fechafin"];

        $txtHTML.="<tr>";

        if($item_imgPath != "NA")
            $txtHTML.="<td><img style='object-fit:cover;' src='".$item_imgPath."' alt='".$item_name."' width='150'></td>";
        else 
            $txtHTML.="<td>NO IMAGEN</td>";

        if(isset($_SESSION["user_id"]) && $item_user_id == $_SESSION["user_id"])
            $txtHTML.="<td><a href='./itemdetails.php?item_id=".$item_id."'>$item_name</a> - <a href='./edititem.php?item_id=$item_id'>[editar]</a></td>";
        else 
            $txtHTML.="<td><a href='./itemdetails.php?item_id=".$item_id."'>$item_name</a></td>";

        $txtHTML.="<td>".$item_bidData_quantity."</td>";    
        $txtHTML.="<td>".format_money($item_bidData_maxPrice)."</td>"; 
        $txtHTML.="<td>".format_date($item_endDate, "d/M/Y h:iA")."</td>";
        
        $txtHTML.="</tr>";
    }
    echo $txtHTML;
}
?>
    <table>
        <tr>
            <th>IMAGEN</th>
            <th>ITEM</th>
            <th>PUJAS</th>
            <th>PRECIO</th>
            <th>PUJAS HASTA</th>
        </tr>
        <tbody>
            <?php
            drawTbody_itemData();
            ?>
        </tbody>
    </table>
</body>
</html>