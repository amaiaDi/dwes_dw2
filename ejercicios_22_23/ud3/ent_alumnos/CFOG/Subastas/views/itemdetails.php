<?php
require_once "./header.php";
require_once "../DB/DB_bid.php";
require_once "../DB/DB_item.php";
require_once "../DB/DB_image.php";
require_once "../DB/DB_user.php";
require_once "../lib/format.php";

if(!isset($_GET["item_id"]))
{    
    header("Location: ./index.php");
    exit();
}

$item_id=$_GET["item_id"];
$_SESSION["lastVisitedPage"]="./itemdetails?item_id=${item_id}.php";
    
// Item Data
$item=getItemById($item_id);
$item_name=$item["nombre"];
$item_startingPrice=$item["preciopartida"];
$item_description=$item["descripcion"];
$item_endDate=$item["fechafin"];
$list_itemImage=getImagesOfItem($item_id);

// Bid Data of Item
$bidData=getBidDataOfItem($item_id);
$bidData_bidAmount=$bidData[0];
$bidData_itemMaxBid=$bidData[1];
$item_currentPrice=$item_startingPrice;
if($bidData_itemMaxBid>$item_currentPrice)
    $item_currentPrice=$bidData_itemMaxBid;

if(isset($_SESSION["user_id"]))
    $user_id=$_SESSION["user_id"];

$checkExpired_item=false;
$checkReached_user_maxBidAmountPerDay=false;
$checkNotReached_bid_minVal=false;
$checkValid_bid=true;


if(isset($_POST["send_newBid"]) && validateInput())
    addBid(intval($item_id), intval($user_id), doubleval($_POST["newBid"]), strval(date("Y-m-d")));
if(isset($_SESSION["user_name"]) && isset($_SESSION["user_id"]))
{
    $checkSuccessful_login=true;
    $list_bidOfItem=getBidsOfItem($item_id);
}

function validateInput()
{
    global $checkExpired_item;
    global $checkReached_user_maxBidAmountPerDay;
    global $checkNotReached_bid_minVal;
    global $checkValid_bid;

    global $item_currentPrice;
    global $item_endDate;
    global $user_id;

    $_POST["newBid"]=str_replace(",", ".", trim($_POST["newBid"]));
    $newBid=$_POST["newBid"];
    $date=date("Y-m-d");
    if($date >= $item_endDate)                                          
        $checkExpired_item=true;
    else if(!is_numeric($newBid))                                    
        $checkValid_bid=false;
    else if($newBid <= $item_currentPrice)                               
        $checkNotReached_bid_minVal=true;
    // Un usuario no puede realizar más de 3 pujas el mismo día
    else if(count(getBidsOfUserFromToday($user_id, $date)) >= 3)    
        $checkReached_user_maxBidAmountPerDay=true;
    else                                                            
        return true;
    return false;
}

function drawDiv_itemBidData()
{
    global $bidData_bidAmount;
    global $item_currentPrice;
    global $item_description;
    global $item_endDate;
    global $item_name;
    global $list_itemImage;

    $txtHTML="<div>";
    $txtHTML.="<h1>$item_name</h1>";
    $txtHTML.="<h2>Número de pujas: $bidData_bidAmount - Precio actual: ".format_money($item_currentPrice)." - Fecha fin para jugar: ".format_date($item_endDate, "d/M/Y h:iA")."</h2>";
    for($i=0; $i < count($list_itemImage); $i++)
    {
        $item_image=$list_itemImage[$i];
        if($i < 10)
            $txtHTML.="<img src='../images/$item_image' alt='${item_name}_0$i' width='150px' style='object-fit: cover;'>";       
        else
            $txtHTML.="<img src='../images/$item_image' alt='${item_name}_$i' width='150px' style='object-fit: cover;'>";       
    }
    $txtHTML.="<h2>$item_description</h2>";
    $txtHTML.="<h1>Puja por este item</h1>";
    $txtHTML.="</div>";
    echo $txtHTML;
}

function drawForm_newBid()
{
    global $checkExpired_item;
    global $checkReached_user_maxBidAmountPerDay;
    global $checkNotReached_bid_minVal;
    global $checkValid_bid;

    global $item_id;
    global $list_bidOfItem;
    
    $txtHTML="<form action=".str_replace(" ", "%20", $_SERVER["PHP_SELF"])."?item_id=$item_id"." method='post'>";
    $txtHTML.=
    '
    <table>
            <tr>
                <td><input type="text" name="newBid" id="newBid"></td>
                <td>
                    <input type="submit" name="send_newBid" value="¡Puja!">
    ';
                 
    if($checkExpired_item)
        $txtHTML.="<span style='color:red'>Se ha agotado el tiempo para realizar pujas sobre este item</span>";
    else if(!$checkValid_bid)
        $txtHTML.="<span style='color:red'>El valor introducido no es numérico</span>";
    else if($checkNotReached_bid_minVal)
        $txtHTML.="<span style='color:red'>¡Puja muy baja!</span>";
    else if($checkReached_user_maxBidAmountPerDay)
        $txtHTML.="<span style='color:red'>Límite de 3 pujas por día</span>";

    $txtHTML.=
    '                
            </td>
        </tr>
    </table>
    <h2>Historial de la puja</h2>
    <ul>
    ';  
    
    if(count($list_bidOfItem) == 0)
        $txtHTML.="<li>No se han realizado pujas para este item</li>";
    else
    {
        for($i=0; $i < count($list_bidOfItem); $i++)
        {
            $bidOfItem=$list_bidOfItem[$i];
            $bidOfItem_user_id=$bidOfItem["id_user"];
            $bidOfItem_quantity=$bidOfItem["cantidad"];
            $txtHTML.="<li>".getUserFromId($bidOfItem_user_id)["username"]." - ".format_money($bidOfItem_quantity)."</li>";
        }
    }

    $txtHTML.=
    '  
        </ul>
    </form>
    ';
    echo $txtHTML;
}
?>
    <?php
    drawDiv_itemBidData();

    global $checkSuccessful_login;
    if(!$checkSuccessful_login)
        echo "<h2>Para pujar, debes autenticarte <a href='./login.php'>aquí</a></h2>";
    else 
    {
        echo "<h2>Añade tu puja en el cuadro inferior</h2>";
        drawForm_newBid();
    }
    ?>
</body>
</html>