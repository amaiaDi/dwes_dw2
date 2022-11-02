<?php
define("FILE_USERS", "../files/usuarios.txt");
$GLOBALS["checkExists_user"]=false;

// No se ha intentado iniciar de sesión
if(!isset($_POST["submit_login"]))
{
    header("Location: ../login.php");
    exit();
}

$_POST["user_name"]=trim($_POST["user_name"]);
$_POST["user_pass"]=trim($_POST["user_pass"]);

// El texto introducido por el usuario es válido
if($_POST["user_name"]!="" && $_POST["user_pass"]!="" && strpos($_POST["user_name"], ";EJ4;")==false && strpos($_POST["user_pass"], ";EJ4;")==false)
{
    // El inicio de sesión es correcto
    if(tryLogin())
    {
        header("Location: ./charla.php?user_name=".$_POST["user_name"]);
        exit();
    }
    // El usuario existe, pero la contraseña no es correcta
    if($GLOBALS["checkExists_user"]==true)
    {
        header("Location: ../login.php?incorrectPassForUser=".$_POST["user_name"]);
        exit();
    }
    // El usuario no existe
    header("Location: ./alta.php?newUser=".$_POST["user_name"]);
    exit();
}
// El texto introducido por el usuario no es válido
header("Location: ../login.php?invalidInput=true");
exit();

function tryLogin()
{
    if(file_exists(FILE_USERS))
    {
        $f=fopen(FILE_USERS, "r");
        while(!feof($f) && $GLOBALS["checkExists_user"]==false) 
        {
            $line=fgets($f);
            $exp_line=explode(";EJ4;", $line);
            if(count($exp_line)==2)
            {
                $f_userName=trim($exp_line[0]);
                $f_userPass=trim($exp_line[1]);
                if($f_userName==$_POST["user_name"])
                {
                    $GLOBALS["checkExists_user"]=true;
                    if($f_userPass==$_POST["user_pass"])
                        return true;
                }                    
            } 
        }
        fclose($f);
    }
    return false;
}
?>