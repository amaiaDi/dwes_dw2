<?php
require_once "./header.php";
require_once "../DB/DB_user.php";

$user_accountState=1;
if(isset($_POST["login"]))
{
    $user_name=$_POST["user_name"];
    $user_pass=$_POST["user_pass"];
    $user_accountStateAndId=login($user_name, $user_pass);

    $user_accountState=$user_accountStateAndId[0];
    if($user_accountState==1)
    {
        $_SESSION["user_name"]=$user_name;
        $_SESSION["user_id"]=$user_accountStateAndId[1];

        if(!isset($_SESSION["lastVisitedPage"]))
            $_SESSION["lastVisitedPage"]="./index.php";
        header("Location: ".$_SESSION["lastVisitedPage"]);
        exit();
    }
}

function drawForm_login()
{
    global $user_accountState;

    $txtHTML="<form action=".str_replace(" ", "%20", $_SERVER["PHP_SELF"])." method='post'>";
    
    if($user_accountState==-1)
        $txtHTML.="<p style='color:red'>Login incorrecto.<br>Inténtalo de nuevo!</p>";
    else if($user_accountState==0)
        $txtHTML.="<p style='color:red'>Esta cuenta no está verificada.<br>Te hemos enviado un email para activarla.</p>";
    
    $txtHTML.=
    '
        <table>
            <tr>
                <td>Usuario</td>
                <td><input type="text" name="user_name" id="user_name"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="user_pass" id="user_pass"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="login" value="Login!"></td>
            </tr>
        </table>
        <p>No tienes una cuenta? <strong><a href="./register.php">Regístrate</a></strong></p>
    </form>
    ';

    echo $txtHTML;
}
?>
    <?php
    if(!isset($_POST["login"]) || $user_accountState != 1)
        drawForm_login();
    ?>
</body>
</html>