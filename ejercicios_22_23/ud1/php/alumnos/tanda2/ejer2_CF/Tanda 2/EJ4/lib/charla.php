<?php
define("CHAT_CONTENT", "../files/chat-content.txt");

if(!isset($_POST["user_name"]) && !isset($_GET["user_name"]))
{
    header("Location: ../login.php");
    exit();
}

$GLOBALS["user_name"]="Usuario Desconocido";
if(isset($_POST["user_name"]))
    $GLOBALS["user_name"]=$_POST["user_name"];
else if(isset($_GET["user_name"]))
    $GLOBALS["user_name"]=$_GET["user_name"];  

if(isset($_POST["send_message"]) && !empty($_POST["message"]))
    sendMessage();

function sendMessage()
{
    if(file_exists(CHAT_CONTENT))
    {
        $f=fopen(CHAT_CONTENT, "a");
        $line="\n".$GLOBALS["user_name"].";EJ4;".$_POST["message"];
        fwrite($f, $line); 
        fclose($f);
    }
}

function drawForm_sendMsg()
{
    $txtHtml="<form enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."' method='post'><table>";
    $txtHtml.="<tr><td colspan='2'>Usuario: <strong>".$GLOBALS["user_name"]."</strong></td></tr>";
    $txtHtml.="<tr><td><input type='text' name='message'></td>";
    $txtHtml.="<td><input type='submit' value='Enviar' name='send_message'></td></tr>";
    $txtHtml.="</table><input type='hidden' name='user_name' value='".$GLOBALS["user_name"]."'></form>";
    echo $txtHtml;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
</head>
<body>
    <iframe src="./contenido_charla.php"></iframe>
    <?php
    drawForm_sendMsg();
    ?>
</body>
</html>