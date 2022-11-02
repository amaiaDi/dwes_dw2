<?php
define("FILE_USERS", "../files/usuarios.txt");
$GLOBALS["checkValid_input"]=true;  

if(isset($_POST["submit_register"]))
{
    if(!(trim($_POST["user_name"])!="" && trim($_POST["user_pass"])!="" && strpos($_POST["user_name"], ";EJ4;")==false && strpos($_POST["user_pass"], ";EJ4;")==false))
        $GLOBALS["checkValid_input"]=false;
}

function userExists()
{
    $userExists=false;
    if(file_exists(FILE_USERS))
    {
        $f=fopen(FILE_USERS, "r");
        while(!feof($f) && $userExists==false) 
        {
            $line=fgets($f);
            $exp_line=explode(";EJ4;", $line);
            if(count($exp_line)==2)
            {
                $f_userName=$exp_line[0];
                if(isset($_GET["newUser"]) && ($f_userName==$_GET["newUser"]))
                    $userExists=true;
                else if(isset($_POST["user_name"]) && ($f_userName==$_POST["user_name"]))
                    $userExists=true;;
            } 
        }
        fclose($f);
    }
    return $userExists;
}
function registerNewUser()
{
    if(file_exists(FILE_USERS))
    {
        $f=fopen(FILE_USERS, "a");
        $line="\n".trim($_POST["user_name"]).";EJ4;".trim($_POST["user_pass"]);
        fwrite($f, $line); 
        fclose($f);

        drawDiv_okayMsg();
    }
}
function drawForm_register()
{
    $txtHtml="<form enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."' method='post'>";
    $txtHtml.="<table><h3>REGÍSTRATE</h3>";
    if(userExists())
        $txtHtml.="<p style='color:red;'>Lo sentimos, ya existe un usuario <strong>".$_POST["user_name"]."</strong><br>Inténtalo de nuevo</p>";
    else if($GLOBALS["checkValid_input"]==false)
        $txtHtml.="<p style='color:red;'>Los valores introducidos no son válidos.</p>";;
    $txtHtml.="<tr><td><label for='user_name'>Login:</label></td>";
    if(isset($_GET["newUser"]))
        $txtHtml.="<td><input type='text' name='user_name' value='".$_GET["newUser"]."'></td>";
    else 
        $txtHtml.="<td><input type='text' name='user_name'></td>";
    $txtHtml.="<td rowspan='2'><img src='../images/new-user.png' alt='Registrar nuevo usuario'></td></tr>";
    $txtHtml.="<tr><td><label for='user_pass'>Password:</label></td>";
    $txtHtml.="<td><input type='password' name='user_pass'></td></tr>";
    $txtHtml.="<tr><td><input type='submit' name='submit_register' value='REGISTRAR'></td></tr>";
    $txtHtml.="</table></form>";
    echo $txtHtml;
}
function drawDiv_okayMsg()
{
    $txtHtml="<div>";
    $txtHtml.="<p><strong>".$_POST["user_name"]."</strong>: Has sido dado de alta</p>";
    $txtHtml.="<a style='font-size:30px;' href='./charla.php?user_name='".$_POST["user_name"]."'>ENTRAR AL CHAT</a>";
    $txtHtml.="</div>";
    echo $txtHtml;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regístrate</title>
</head>
<body>
    <?php
    if(isset($_POST["submit_register"]) && $GLOBALS["checkValid_input"]==true && !userExists())
        registerNewUser();
    else 
        drawForm_register();
    ?>    
</body>
</html>