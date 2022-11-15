<?php
require_once "./header.php";
require_once "../DB/DB_item.php";
require_once "../DB/DB_bid.php";
require_once "../DB/DB_user.php";
require_once "../lib/format.php";

if(isset($_POST["delete_expiredItem"]) && isset($_POST["check_deleteExpiredItem"]))
{
    $check_deleteExpiredItem=$_POST["check_deleteExpiredItem"];
    for($i=0; $i < count($check_deleteExpiredItem); $i++)
        deleteItem($check_deleteExpiredItem[$i]);   
}

function drawForm_expiredItems()
{
    $list_expiredItem=getExpiredItems();

    $txtHTML="<form enctype='multipart/form-data' action=".str_replace(" ", "%20", $_SERVER["PHP_SELF"])." method='post'>";
    $txtHTML.=
    '
    <h2>Subastas vencidas</h2>
    <table>
        <tr>
            <th colspan="2">ITEM</th>
            <th>PRECIO FINAL</th>
            <th>GANADOR</th>
        </tr>
    ';
    
    for($i=0; $i < count($list_expiredItem); $i++)
    {
        $expiredItem=$list_expiredItem[$i];                
        $expiredItem_id=$expiredItem["id"];
        $expiredItem_name=$expiredItem["nombre"];
        $expiredItem_startingPrice=$expiredItem["preciopartida"];

        $txtHTML.="<tr>";
        $txtHTML.="<td><input type='checkbox' name='check_deleteExpiredItem[]' value='$expiredItem_id'</td>";
        $txtHTML.="<td><a href='./expired.php?showItemDescById=$expiredItem_id'>$expiredItem_name</a>";
        
        if(isset($_GET["showItemDescById"]) && $_GET["showItemDescById"] == $expiredItem_id)
            $txtHTML.="<br>".$expiredItem["descripcion"];
        $txtHTML.="</td>";

        $bidData=getBidDataOfItem($expiredItem_id);
        $bidData_maxBid=$bidData[1];
        $bid_winner=false; 
        if($bidData_maxBid < $expiredItem_startingPrice)   
            $bidData_maxBid=$expiredItem_startingPrice;
        else 
        {
            $winner_id=$bidData[2];
            $bid_winner=getUserFromId($winner_id)["nombre"];
        }

        $txtHTML.="<td>PRECIO FINAL: ".format_money($bidData_maxBid)."</td>";
        if(!$bid_winner)
            $txtHTML.="<td></td>";
        else 
            $txtHTML.="<td>Ganador: $bid_winner</td>";
        $txtHTML.="</tr>";
    }

    $txtHTML.=
    '
        <tr><td colspan="4"><input style="width:100%" type="submit" name="delete_expiredItem" value="BORRAR"></td></tr>
    </table>
    </form> 
    ';

    echo $txtHTML;
}
?>
    <?php
    drawForm_expiredItems();
    ?>
</body>
</html>