<?php
define("DIR_ITEMS", "./files/articulos.txt");
$GLOBALS["checkValid_newItem_name"]=true;
$GLOBALS["checkValid_newItem_price"]=true;

$GLOBALS["total"]=0;
if(isset($_GET["total"]))
    $GLOBALS["total"]=$_GET["total"];

if(isset($_POST["new_item"]) && validateInput())
    addNewItem();

function validateInput()
{
    $clean_newItem_name=trim($_POST["newItem_name"]);
    if($clean_newItem_name=="" || item_exists($clean_newItem_name))
        $GLOBALS["checkValid_newItem_name"]=false;

    $clean_newItem_price=str_replace(",", ".", trim($_POST["newItem_price"]));
    if($_POST["newItem_price"]=="" || !is_numeric($clean_newItem_price) || 0 > floatval($clean_newItem_price))
        $GLOBALS["checkValid_newItem_price"]=false;

    return $GLOBALS["checkValid_newItem_name"] && $GLOBALS["checkValid_newItem_price"];
}

function addNewItem()
{
    $newItem_name=trim($_POST["newItem_name"]);
    $newItem_price=bcdiv(floatval(str_replace(",", ".", trim($_POST["newItem_price"]))), 1, 2);
    
    if(file_exists(DIR_ITEMS))
    {
        $f=fopen(DIR_ITEMS, "a");
        $linea="\n".$newItem_name.";".$newItem_price;
        fwrite($f, $linea); 
        fclose($f);
    }

    if(isset($_FILES["f_newItem"]))
    {
        $target="./files/item-info/".$newItem_name.".txt";
        move_uploaded_file($_FILES["f_newItem"]["tmp_name"], $target);
    }
}

function drawTable_items()
{
    $txtHtml="<table><tr><th colspan='4'>ELIGE TU PEDIDO</th></tr>";
    if(file_exists(DIR_ITEMS))
    {
        $f=fopen(DIR_ITEMS, "r");
        while(!feof($f)) 
        {
            $exp_line=explode(";", fgets($f));
            if(count($exp_line)==2 && is_numeric(str_replace(",", ".", trim($exp_line[1]))))
            {
                $itemName=$exp_line[0];
                $itemPrice=floatval(str_replace(",", ".", trim($exp_line[1])));
                $newTotal=$GLOBALS["total"]+$itemPrice;    
                $txtHtml.="<tr>";
                if(file_exists("./files/item-info/${itemName}.txt"))
                    $txtHtml.="<td style='text-align: center;'><a href='./files/item-info/${itemName}.txt' target='_blank'><img src='./images/item_info.png' alt='Ver información sobre item' width='17px'></a></td>";
                else 
                    $txtHtml.="<td></td>";
                $txtHtml.="<td>$itemName</td>";
                $txtHtml.="<td style='text-align: right;'>${itemPrice}€</td>";
                $txtHtml.="<td style='text-align: center;'><a href='?total=${newTotal}'>Añadir unidad</a></td>";
                $txtHtml.="</tr>";
            }
        }
        fclose($f);
    }
    $txtHtml.="<tr><th colspan='4'>TOTAL: ".$GLOBALS["total"]."€</th></tr></table>";
    echo $txtHtml;
}

function drawTable_newItem()
{
    $txtHtml="<table><tr><th colspan='2'>AÑADE ARTÍCULO</th></tr>";
    
    $txtHtml.="<tr style='display:flex; justify-content:space-between;'><td><label for='newItem_name'>Nombre:</label></td>";
    if(!isset($_POST["new_item"]))
        $txtHtml.="<td><input type='text' name='newItem_name'></td></tr>";
    else if($GLOBALS["checkValid_newItem_name"])
        $txtHtml.="<td><input type='text' name='newItem_name' value='".$_POST["newItem_name"]."'></td></tr>";
    else 
        $txtHtml.="<td><input style='border-color:red;' type='text' name='newItem_name'></td></tr>";
    
    $txtHtml.="<tr style='display:flex; justify-content:space-between;'><td><label for='newItem_price'>Precio(€):</label></td>";
    if(!isset($_POST["new_item"]))
        $txtHtml.="<td><input type='text' name='newItem_price'></td></tr>";
    else if($GLOBALS["checkValid_newItem_price"])
        $txtHtml.="<td><input type='text' name='newItem_price' value='".$_POST["newItem_price"]."'></td></tr>";
    else 
        $txtHtml.="<td><input style='border-color:red;' type='text' name='newItem_price'></td></tr>";
    
    $txtHtml.="<tr><td colspan='2'><input type='file' name='f_newItem' accept='.txt'/></td></tr>";
    $txtHtml.="<tr><td colspan='2'><input style='width:300px;' type='submit' name='new_item' value='AÑADIR'/></td></tr></table>";
    echo $txtHtml;
}

function item_exists($newItem_name)
{
    if(file_exists(DIR_ITEMS))
    {
        $f=fopen(DIR_ITEMS, "r");
        while(!feof($f)) 
        {
            $exp_line=explode(";", fgets($f));
            if(count($exp_line)==2 && is_numeric(str_replace(",", ".", trim($exp_line[1]))))
            {
                if(trim($exp_line[0]) == $newItem_name)
                    return true;
            }
        }
        fclose($f);
    }
    return false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
</head>
<style>
    table
    {
        display: flex;
        flex-direction: row;
        justify-content: center;
        margin: 10px;
    }
    th 
    {
        background-color: lightblue;
        min-width: 300px;
    }
    form th 
    {
        background-color: lightpink;
    }
    th, td
    {
        padding: 5px;
    }
    input[type="submit"]
    {
        cursor: pointer;
    }
</style>
<body>
    <?php
    drawTable_items();
    ?>
    <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <?php
        drawTable_newItem();
        ?>  
    </form>  
</body>
</html>