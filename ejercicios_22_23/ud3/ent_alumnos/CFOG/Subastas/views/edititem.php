<?php
require_once "./header.php";
require_once "../lib/format.php";
require_once "../DB/DB_image.php";
require_once "../DB/DB_item.php";
require_once "../DB/DB_bid.php";

if(!isset($_GET["item_id"]) && !isset($_POST["item_id"]))
{
    header("Location: ./index.php");
    exit();
}

if(isset($_GET["item_id"]))
    $item_id=$_GET["item_id"];
else if(isset($_POST["item_id"]))
    $item_id=$_POST["item_id"];

$item=getItemById($item_id);
$item_user_id=$item["id_user"];
if($_SESSION["user_id"] != $item_user_id)
{
    header("Location: ./index.php");
    exit();
}

$_SESSION["lastVisitedPage"]="./edititem.php?item_id=$item_id";

if(isset($_GET["delete_itemImagePath"]))
{
    $delete_itemImagePath=$_GET["delete_itemImagePath"];
    deleteImage($item_id, $delete_itemImagePath);
}

$item_name=$item["nombre"];
$item_startingPrice=$item["preciopartida"];
$item_description=$item["descripcion"];
$item_endDate=$item["fechafin"];

$checkValid_newPrice=true;
if(isset($_POST["lowerPrice"]) || isset($_POST["higherPrice"]))
{
    $priceVariation=$_POST["priceVariation"];
    if(is_numeric($priceVariation))
    {
        if(isset($_POST["lowerPrice"]))
            $item_newPrice=$item_startingPrice-$priceVariation;
        else 
            $item_newPrice=$item_startingPrice+$priceVariation;

        setPriceOfItem($item_id, $item_newPrice);
    }
    else 
        $checkValid_newPrice=false;
}

if(isset($_POST["item_endDate_incHour"]) || isset($_POST["item_endDate_incDay"]))
{
    $item_newEndDate=date_create($item_endDate);
    if(isset($_POST["item_endDate_incHour"]))
        date_modify($item_newEndDate, "+1 hour");
    else 
        date_modify($item_newEndDate, "+1 day");
    $item_newEndDate=date_format($item_newEndDate, "Y-m-d H:i:s"); 

    setEndDateOfItem($item_id, $item_newEndDate);
}

if(isset($_POST["send_item_newImage"]) && isset($_FILES["item_newImage"]))
{    
    $f=$_FILES["item_newImage"];
    if($f != null)
    {
        $f_name=$f["name"];
        $target="../images/".$f_name;
        $item_image_path=$f_name;
        for($i=0; file_exists($target); $i++)
        {
            $exp_f_data=explode(".", $f_name);
            $f_data_name=$exp_f_data[0];
            $f_data_ext=$exp_f_data[1];

            if($i < 10)
                $item_image_path=$f_data_name."_0$i.".$f_data_ext;
            else 
                $item_image_path=$f_data_name."_$i.".$f_data_ext;

            $target="../images/".$item_image_path;
        }
        
        move_uploaded_file($_FILES["item_newImage"]["tmp_name"], $target);
        addImage($item_id, $item_image_path);
    }
}

// Update item
$item=getItemById($item_id);
$item_name=$item["nombre"];
$item_startingPrice=$item["preciopartida"];
$item_description=$item["descripcion"];
$item_endDate=$item["fechafin"];

function drawForm_editItem()
{
    global $checkValid_newPrice;

    global $item_endDate; 
    global $item_id; 
    global $item_name; 
    global $item_startingPrice; 

    $txtHTML="<form enctype='multipart/form-data' action=".str_replace(" ", "%20", $_SERVER["PHP_SELF"])." method='post'>";
    $txtHTML.=
    '
    <h2>'.$item_name.'</h2>
    <table>
        <tr>
            <td>Precio de salida: '.format_money($item_startingPrice).'</td>
            <td>
    ';
       
    $item_bidQuantity=getBidDataOfItem($item_id)[0];
    if($item_bidQuantity == 0)
    {
        $txtHTML.="<input type='text' name='priceVariation'>";
        $txtHTML.="<input type='submit' name='lowerPrice' value='BAJAR'>";
        $txtHTML.="<input type='submit' name='higherPrice' value='SUBIR'>";

        if(!$checkValid_newPrice)
            $txtHTML.="<p style='color:red'>El valor debe ser numérico</p>";
    }
    
    $txtHTML.=
    '
            </td>
        </tr>
        <tr>
            <td>Fecha fin para pujar: '.format_date($item_endDate, "d/M/Y h:iA").'</td>
            <td>
                <input type="submit" name="item_endDate_incHour" value="POSPONER 1 HORA">
                <input type="submit" name="item_endDate_incDay" value="POSPONER 1 DIA">
            </td>
        </tr>
    </table>
    <h2>Imágenes actuales</h2>
    ';

    $list_item_image=getImagesOfItem($item_id);
    if(count($list_item_image) <= 0)
        $txtHTML.="<p>No hay imágenes del item.</p>";
    else 
    {
        $txtHTML.="<table>";
        for($i=0; $i < count($list_item_image); $i++)
        {
            $src=DIR_IMAGES.$list_item_image[$i];
            $delete_itemImagePath=$list_item_image[$i];

            $txtHTML.="<tr>";
            $txtHTML.="<td><img src='$src' width='100' height='100'></td>";
            $txtHTML.="<td><a href='?delete_itemImagePath=$delete_itemImagePath&item_id=$item_id'>[BORRAR]</a></td>";
            $txtHTML.="</tr>";
        }
        $txtHTML.="</table>";
    }

    $txtHTML.=
    '
        <table>
            <tr>
                <td>Imagen a subir</td>
                <td><input type="file" name="item_newImage" accept="image/*"></td>
            </tr>
            <tr>
                <td colspan="2"><input style="width:100%" type="submit" name="send_item_newImage" value="Subir"></td>
            </tr>
        </table>
        <input type="hidden" name="item_id" value="'.$item_id.'">
    </form>
    '; 

    echo $txtHTML;
}
?>
    <?php
    drawForm_editItem();
    ?>
</body>
</html>