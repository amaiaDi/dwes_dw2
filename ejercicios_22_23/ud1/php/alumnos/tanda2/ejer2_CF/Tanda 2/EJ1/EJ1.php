<?php
require_once("lib/encrypter.php");
define("DIR_REPLACEMENT", "./files/");
define("LIST_DISPLACEMENT", [3, 5, 10]);
$GLOBALS["checkValid_input"]=true;
$GLOBALS["checkValid_displacement"]=true;
$GLOBALS["checkValid_replacementFile"]=true;

$output=null;
if(isset($_POST["encryptCesar"]) && validateInput("c"))
    $output=encrypt_cesar(strtoupper($_POST["input"]), $_POST["displacement"]);
else if(isset($_POST["encryptReplacement"]) && validateInput("r"))
    $output=encrypt_replacement(strtoupper($_POST["input"]), $_POST["replacementFile"]);

function validateInput($method)
{
    if(isset($_POST["input"]) && $_POST["input"]!="")
    {
        if($method=="c")
        {
            if(isset($_POST["displacement"]))
                return true;  
            else 
                $GLOBALS["checkValid_displacement"]=false;
        }
        else if($method=="r")
        {
            if(isset($_POST["replacementFile"]))
                return true;    
            else 
                $GLOBALS["checkValid_replacementFile"]=false;
        }
    }
    else 
        $GLOBALS["checkValid_input"]=false;

    return false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<style>
#td-radios{display: flex; flex-direction: column; align-items: left;}
</style>
<body>
    <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <table>
            <tr>
                <td>Texto a cifrar:</td>
                <td>
                    <?php 
                    if($GLOBALS["checkValid_input"]==false)
                        echo "<input type='text' name='input' style='border: 2px solid red;'>";
                    else if(isset($_POST["input"]))
                        echo "<input type='text' name='input' value='".$_POST["input"]."'>";
                    else
                        echo "<input type='text' name='input'>";
                    ?>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Desplazamiento</td>
                <td id="td-radios">
                    <?php 
                    if(isset($_POST["displacement"]))
                        $displacement=$_POST["displacement"]; 

                    $txtHtml="";
                    for($n=0; $n<count(LIST_DISPLACEMENT); $n++)
                    {
                        $nDisplace=LIST_DISPLACEMENT[$n];
                        $txtHtml.="<div><input type='radio' name='displacement' value='$nDisplace'";
                        if(isset($_POST["displacement"]) && $displacement==$nDisplace)
                            $txtHtml.=" checked";
                        $txtHtml.="><label for='displacement'>$nDisplace</label>";
                        $txtHtml.="</div>";
                    }
                    echo $txtHtml;
                    ?>
                </td>
                <td><input type="submit" name="encryptCesar" value="CIFRADO CESAR"/></td>
            </tr>
            <tr>
                <td>Fichero de clave</td>
                <td>
                    <select name="replacementFile">
                        <?php
                        $files=scandir(DIR_REPLACEMENT);
                        foreach($files as $f)
                        {
                            $pathFile=DIR_REPLACEMENT.$f;
                            if(is_file($pathFile) and strpos($f,'.txt')!=false)
                            {
                                if(isset($_POST["replacementFile"]) && $_POST["replacementFile"]==$f)
                                    echo "<option value='$f' selected>$f</option>";
                                else 
                                    echo "<option value='$f'>$f</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
                <td><input type="submit" name="encryptReplacement" value="CIFRADO POR SUSTITUCIÓN"/></td>
            </tr>
        </table>
    </form>
    <?php
    // ERRORS
    if(!$GLOBALS["checkValid_input"] || !$GLOBALS["checkValid_displacement"])
    {
        $txtHtml="<div><p style='color: red;'>";
        if($GLOBALS["checkValid_input"]==false)
            $txtHtml.="No se ha introducido texto a encriptar.<br>";
        if($GLOBALS["checkValid_displacement"]==false)
            $txtHtml.="Es necesario seleccionar un desplazamiento para utilizar el codificador César.<br>";
        if($GLOBALS["checkValid_replacementFile"]==false)
            $txtHtml.="Es necesario seleccionar un fichero de clave para utilizar el codificador por sustitución.<br>";
        $txtHtml.="</p></div>";
        echo $txtHtml;
    }
    
    // RESULT
    if($output!=null)
    {
        $txtHtml="<p><strong style='color: green;'>";
        $txtHtml.="Texto cifrado: ".$output;
        $txtHtml.="</strong></p>";
        echo $txtHtml;
    }
    ?>
</body>
</html>