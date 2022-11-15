<?php
require_once "./header.php";
require_once "../DB/DB_category.php";
require_once "../DB/DB_item.php";

$_SESSION["lastVisitedPage"]="./newitem.php";

if(!isset($_SESSION["user_name"]) || !isset($_SESSION["user_id"])) 
{
    header("Location: ./login.php");
    exit();
}

$checkValid_item_endDate=true;
$checkValid_item_name=true;
$checkValid_item_price=true;
$list_item_category=getItemCategories();

$item_category_id=-1;
$item_name=""; 
$item_price=-1; 
$item_description=""; 
$item_endDate="";

if(isset($_POST["send_newItem"]) && validateInput())
{
    $item_id=addItem(
        $item_category_id, 
        $_SESSION["user_id"], 
        $item_name, 
        $item_price, 
        $item_description, 
        $item_endDate
    );

    header("Location: ./edititem.php?item_id=".intval($item_id));
    exit();
}

function validateInput()
{
    global $checkValid_item_endDate;
    global $checkValid_item_name;
    global $checkValid_item_price;    
    global $list_item_category;

    global $item_category_id;
    global $item_name; 
    global $item_price; 
    global $item_description; 
    global $item_endDate;

    $input_category_name=$_POST["input_category_name"];
    $item_description=$_POST["item_description"];

    $checkFound_category=false;
    for($i=0; $i < count($list_item_category) && !$checkFound_category; $i++)
    {
        $item_category_id=$list_item_category[$i]["id"];
        $item_category_name=$list_item_category[$i]["categoria"];
        if($item_category_name == $input_category_name)
            $checkFound_category=true;
    }

    $item_endDate_year=$_POST["item_endDate_year"];
    $item_endDate_month=$_POST["item_endDate_month"];
    $item_endDate_day=$_POST["item_endDate_day"];
    $item_endDate_hour=$_POST["item_endDate_hour"];
    $item_endDate_min=$_POST["item_endDate_min"];
    $item_endDate="$item_endDate_year-$item_endDate_month-$item_endDate_day $item_endDate_hour:$item_endDate_min:00";

    $item_price=$_POST["item_price"];
    if(!is_numeric($item_price))
        $checkValid_item_price=false;

    $item_name=trim($_POST["item_name"]);
    if($item_name == "")
        $checkValid_item_name=false;


    $currentDate_year=date("Y");
    $currentDate_month=date("m");
    $currentDate_day=date("d");
    $currentDate_hour=date("H");
    $currentDate_min=date("i");
    if($currentDate_year >= $item_endDate_year)
        $checkValid_item_endDate=false;
    else if($currentDate_year == $item_endDate_year)
    {
        if($currentDate_month > $item_endDate_month)
            $checkValid_item_endDate=false;
        else if($currentDate_month == $item_endDate_month)
        {
            if($currentDate_day > $item_endDate_day)
                $checkValid_item_endDate=false;
            else if($currentDate_day == $item_endDate_day)
            {
                if($currentDate_hour > $item_endDate_hour)
                    $checkValid_item_endDate=false;
                else if($currentDate_hour == $item_endDate_hour)
                {
                    if($currentDate_min >= $item_endDate_min)
                        $checkValid_item_endDate=false;
                }
            }
        }
    }

    return $checkValid_item_endDate && $checkValid_item_name && $checkValid_item_price;
}

function drawForm_newItem()
{
    global $checkValid_item_endDate;
    global $checkValid_item_name;
    global $checkValid_item_price;
    global $list_item_category;

    $txtHTML="<h2>Añade nuevo item</h2>";
    $txtHTML.="<form action=".str_replace(" ", "%20", $_SERVER["PHP_SELF"])." method='post'>";
    $txtHTML.=
    '
    <table>
            <tr>
                <td>Categoría</td>
                <td>
                    <select name="input_category_name">
    ';
        
    for($i=0; $i < count($list_item_category); $i++)
    {
        $category_name=$list_item_category[$i]["categoria"];
        $txtHTML.="<option>$category_name</option>";
    }

    $txtHTML.=
    '
            </select>
        </td>
    </tr>
    <tr>
        <td>Nombre</td>
        <td><input type="text" name="item_name" id="item_name">
    ';
                    
    if(!$checkValid_item_name)
        $txtHTML.="<p style='color:red'>Campo vacío</p>";


    $txtHTML.=
    '
        </td>
    </tr>
    <tr>
        <td>Descripción</td>
        <td><textarea name="item_description" id="item_description" cols="30" rows="10" maxlength="200"></textarea></td>
    </tr>
    <tr>
        <td>Fecha de fin para pujas</td>
        <td>
            <table>
                <tr>
                    <td>Día</td>
                    <td>Mes</td>
                    <td>Año</td>
                    <td>Hora</td>
                    <td>Minutos</td>
                </tr>
                <tr>
                    <td><select name="item_endDate_day" id="item_endDate_day">
    ';
    
    // date("t") - Devuelve número de días que tiene el mes actual
    for($i=1, $maxI=date("t"); $i <= $maxI; $i++) 
        $txtHTML.="<option>$i</option>";

    $txtHTML.="</select></td>";
    $txtHTML.="<td><select name='item_endDate_month'>";

    for($i=1; $i <= 12; $i++) 
        $txtHTML.="<option>$i</option>";

    $txtHTML.="</select></td>";
    $txtHTML.="<td><select name='item_endDate_year'>";
                                
    $currentDate_year=date("Y");; 
    for($i=$currentDate_year; $i <= $currentDate_year+5; $i++) 
        $txtHTML.="<option>$i</option>";

    $txtHTML.="</select></td>";
    $txtHTML.="<td><select name='item_endDate_hour'";

    for($i=0; $i <= 23; $i++) 
        $txtHTML.="<option>$i</option>";

    $txtHTML.="</select></td>";
    $txtHTML.="<td><select name='item_endDate_min'>";
                                
    for($i=0; $i <= 59; $i++)    
        $txtHTML.="<option>$i</option>";

    $txtHTML.=
    '
                </select>
            </td>
        </tr>
    </table>
    ';

    if(!$checkValid_item_endDate)
        $txtHTML.="<p style='color:red'>La fecha de fin no puede ser anterior o igual a la fecha actual</p>";
                    
    $txtHTML.=
    '
        </td>
    </tr>
    <tr>
        <td>Precio</td>
        <td><input type="text" name="item_price">'.CURRENCY;
                
    if(!$checkValid_item_price)
        $txtHTML.="<p style='color:red'>El valor debe ser numérico</p>";
    
    $txtHTML.=
    '
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input style="width:100%" type="submit" name="send_newItem" value="¡Enviar!">
                </td>
            </tr>
        </table>
    </form>
    ';

    echo $txtHTML;
}
?>
    <?php
    drawForm_newItem();
    ?>
</body>
</html>