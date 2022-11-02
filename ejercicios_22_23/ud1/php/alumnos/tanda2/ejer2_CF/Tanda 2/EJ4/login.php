<?php
function drawForm_login()
{
    $txtHtml="<form enctype='multipart/form-data' action='./lib/validacion.php' method='post'><table>";
    if(isset($_GET["incorrectPassForUser"]))
        $txtHtml.="<p style='color:red;'>CONTRASEÑA ERRÓNEA PARA EL USUARIO <strong>".$_GET["incorrectPassForUser"]."</strong><br>Inténtalo de nuevo</p>";
    else if(isset($_GET["invalidInput"]))
        $txtHtml.="<p style='color:red;'>Los valores introducidos no son válidos.</p>";
    $txtHtml.="<tr><td><label for='user_name'>Nombre de usuario:</label></td>";
    if(isset($_GET["incorrectPassForUser"]))
        $txtHtml.="<td><input type='text' name='user_name' value='".$_GET["incorrectPassForUser"]."'></td>";
    else 
        $txtHtml.="<td><input type='text' name='user_name'></td>";
    $txtHtml.="<td rowspan='2'><input type='submit' name='submit_login' value='ENTRAR'></td></tr>";
    $txtHtml.="<tr><td><label for='user_pass'>Contraseña:</label></td>";
    $txtHtml.="<td><input type='password' name='user_pass'></td></tr>";
    $txtHtml.="</table></form>";
    echo $txtHtml;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<body>
    <?php
    drawForm_login();
    ?>    
</body>
</html>