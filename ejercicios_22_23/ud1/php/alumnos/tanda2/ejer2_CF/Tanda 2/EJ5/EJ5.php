<?php
define("CONV_VALUE", "./files/conv_value.txt");
$GLOBALS["checkValid_input"]=true;
$GLOBALS["checkNumber_input"]=true;

$output=null;
if(isset($_POST["convert"]) && validateInput())
    $output=convertInput(); 

function validateInput()
{
    if(trim($_POST["input_number"]) != "")
    {
        if(is_numeric(trim($_POST["input_number"])))
        {
            if(isset($_POST["new_currency"]))
                return true;
        }
        else 
        {
            $GLOBALS["checkValid_input"]=false;
            $GLOBALS["checkNumber_input"]=false;
        }
    }
    else 
        $GLOBALS["checkValid_input"]=false;

    return false;
}

function convertInput()
{
    $output="No se ha conseguido encontrar el fichero.";
    $input=trim($_POST["input_number"]);
    $newCurrency=$_POST["new_currency"];

    if(file_exists(CONV_VALUE))
    {
        $f=fopen(CONV_VALUE, "r");
        $conv_value=floatval(trim(fgets($f)));
        fclose($f);
        
        if($newCurrency=="$")
            $output=bcdiv($input * $conv_value, 1, 2).$newCurrency;
        else if($newCurrency=="€") 
            $output=bcdiv($input / $conv_value, 1, 2).$newCurrency;
    }
    
    return $output;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <table>
            <tr>
                <td style="width:350px;">
                    <label for="input_number">Cantidad:</label>
                    <?php
                    $txtHtml="<input type='text' name='input_number'>";
                    if(isset($_POST["convert"]))
                    {
                        if($GLOBALS["checkValid_input"])
                            $txtHtml="<input type='text' name='input_number' value='".$_POST["input_number"]."'>";
                        else if(!$GLOBALS["checkNumber_input"])
                            $txtHtml.="<span style='color:red; margin-left:10px;'>¡NO NUMÉRICO!</span>";   
                        else
                            $txtHtml.="<span style='color:red; margin-left:10px;'>¡VACÍO!</span>";  
                    }
                    echo $txtHtml;
                    ?>
                </td>
                <td style="display: flex; flex-direction: column;">
                    <div>
                        <?php
                        if(!isset($_POST["convert"]) || $_POST["new_currency"]=="$")
                            echo "<input type='radio' name='new_currency' value='$' checked>";
                        else
                            echo "<input type='radio' name='new_currency' value='$'>";
                        ?>
                        <label for="new_currency">Euros a dólares</label>
                    </div>
                    <div>
                        <?php
                        if(isset($_POST["convert"]) && $_POST["new_currency"]=="€")
                            echo "<input type='radio' name='new_currency' value='€' checked>";
                        else
                            echo "<input type='radio' name='new_currency' value='€'>";
                        ?>
                        <label for="new_currency">Dólares a euros</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="height:50px;">
                    <?php
                    if($output!=null)
                        echo "<strong style='font-size: 30px;'>$output</strong>";
                    ?>
                </td>
            </tr>
            <tr>
                <td><input type="submit" name="convert" value="CONVERTIR"></td>
            </tr>
        </table>
    </form>
</body>
</html>