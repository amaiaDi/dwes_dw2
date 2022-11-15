<?php
require_once "./header.php";
require_once "../DB/DB_user.php";

$checkExists_user=false;
$checkValid_pass=true;
$checkValid_newRegister=false;

if(isset($_POST["registerUser"]))
{
    if(validateInput())
    {
        $checkValid_newRegister=registerUser(
            $_POST["user_name"], 
            $_POST["user_fullName"], 
            $_POST["user_pass"], 
            $_POST["user_email"]
        );
    }
}

function validateInput()
{
    global $checkExists_user;
    global $checkValid_pass;

    if(trim($_POST["user_name"])=="" || trim($_POST["user_email"])=="")
        return false;

    $user_pass=trim($_POST["user_pass"]);
    $user_passCheck=trim($_POST["user_passCheck"]);

    if($user_pass!="" && $user_pass==$user_passCheck)
    {
        $user_name=$_POST["user_name"];

        if(!userExists($user_name))
            return true;
        else 
            $checkExists_user=true;
    }
    else 
        $checkValid_pass=false;

    return false;
}

function drawForm_registerUser()
{
    global $checkValid_pass;
    global $checkExists_user;
    
    $txtHTML="<form action=".str_replace(" ", "%20", $_SERVER["PHP_SELF"])." method='post'>";
    $txtHTML.=
    '
        <h2>REGISTRO</h2>
        <p>Para registrarte en SUBASTAS DEWS , rellenar el siguiente formulario</p>
    ';
        
    if($checkValid_pass==false)
        $txtHTML.="<p style='color:red'>Las contraseñas introducidas no coinciden</p>";
    else if($checkExists_user==true)
        $txtHTML.="<p style='color:red'>El usuario ".$_POST["user_name"]." ya existe</p>";

    $txtHTML.=
    '
        <table>
            <tr>
                <td><label for="user_name">Usuario</label></td>
                <td><input type="text" name="user_name" id="user_name"></td>
            </tr>
            <tr>
                <td><label for="user_fullName">Nombre completo</label></td>
                <td><input type="text" name="user_fullName" id="user_fullName"></td>
            </tr>
            <tr>
                <td><label for="user_pass">Password</label></td>
                <td><input type="password" name="user_pass" id="user_pass"></td>
            </tr>
            <tr>
                <td><label for="user_passCheck">Password (de nuevo)</label></td>
                <td><input type="password" name="user_passCheck" id="user_passCheck"></td>
            </tr>
            <tr>
                <td><label for="user_email">Email</label></td>
                <td><input type="text" name="user_email" id="user_email"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="registerUser" value="Regístrate"></td>
            </tr>
        </table>
    </form>
    ';

    echo $txtHTML;
}
?>
    <?php
    if(!isset($_POST["registerUser"]) || (!$checkValid_pass || $checkExists_user))
        drawForm_registerUser();
    else if($checkValid_newRegister)
        echo "<p>Nuevo usuario registrado.<br>Comprueba tu correo para activar la cuenta.</p>";
    else 
    {
        echo "<p style='color:red'>No se ha completado el registro.<br>Por favor, vuelve a intentarlo.</p>";
        drawForm_registerUser();
    }
    ?>
</body>
</html>