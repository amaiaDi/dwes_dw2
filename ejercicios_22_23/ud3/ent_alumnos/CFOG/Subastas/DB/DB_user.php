<?php
require_once "../DB/DB.php";

function login($userName, $userPass)
{
    $conn=connectToDB();
    $userAccountStateAndId=[];
    $query="SELECT * FROM usuario WHERE username = ? AND password = ?;";
    
    $st=$conn -> prepare($query);
    $st_prepared=$st -> bind_param("ss", $userName, $userPass);
    $st_executed=$st -> execute(); 

    if($st_prepared && $st_executed) 
    {
        $st_result=$st -> get_result();

        if($userData=$st_result -> fetch_assoc())       
        {
            $userAccountState=$userData["activo"];

            // Inicio de sesión correcto en una cuenta activada
            if($userAccountState==intval(true))        
                $userAccountStateAndId[0]=1;     
            // Inicio de sesión correcto en una cuenta no activada              
            else if($userAccountState==intval(false))  
                $userAccountStateAndId[0]=0;
        }
        else 
            // No se ha conseguido iniciar sesión  
            $userAccountStateAndId[0]=-1;
    }
    $userAccountStateAndId[1]=$userData["id"];
    
    $st -> close();
    $conn -> close();
    return $userAccountStateAndId;
}

function registerUser($userName, $userFullName, $userPass, $userEmail)
{
    $conn=connectToDB();
    $intVal_false=intval(false);
    $userVerificationCode=generateUserVerificationCode(16);
    $query="INSERT INTO usuario(username, nombre, password, email, cadenaverificacion, activo, falso) VALUES(?,?,?,?,?,?,?);";
    
    $st=$conn -> prepare($query);
    $st_prepared=$st -> bind_param("sssssii", $userName, $userFullName, $userPass, $userEmail, $userVerificationCode, $intVal_false, $intVal_false);
    $st_executed=$st -> execute();
    
    $st -> close();
    $conn -> close();

    if($st_prepared && $st_executed)
        return sendUserVerificationCode($userName, $userVerificationCode, $userEmail);
    return false;
}

function generateUserVerificationCode($size) 
{
    $result="";

    $permittedChars="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $length=strlen($permittedChars);
    for($i=0; $i<$size; $i++) 
    {
        $random_character=$permittedChars[mt_rand(0, $length-1)];
        $result.=$random_character;
    }
    
    return $result;
}

function sendUserVerificationCode($userName, $userVerificationCode, $userEmail)
{
    $url_userVerificationCode=urlencode($userVerificationCode);
    $url_email=urlencode($userEmail);    
    $url=BASE_ROUTE."Subastas/views/verificacion.php?userEmail=$url_email&userVerificationCode=$url_userVerificationCode";            

    $mail_subject=  "Registro en ".FORUM_TITLE;

    $mail_content=  <<<MAIL
                        Hola $userName. Haz clic en el siguiente enlace para registrarte:
                        $url
                        Gracias
                    MAIL;

    $mail_headers=  'From: phpalas4am@gmail.com' . "\r\n" .
                    'MIME-Version: 1.0' . "\r\n" .
                    'Content-type: text/html; charset=utf-8';

    return mail($userEmail, $mail_subject, $mail_content, $mail_headers);
}

function userExists($userName)
{
    $userExists=false;

    $conn=connectToDB();
    $query="SELECT * FROM usuario WHERE username=?;";
    
    $st=$conn -> prepare($query);
    $st_prepared=$st -> bind_param("s", $userName);
    $st_executed=$st -> execute(); 

    if($st_prepared && $st_executed) 
    {
        $st_result = $st -> get_result();
        if($userData = $st_result -> fetch_assoc()) 
            $userExists=true;
    }
    
    $st -> close();
    $conn -> close();
    return $userExists;
}

function verifyUser($userVerificationCode, $userEmail)
{
    $conn=connectToDB();
    $query="SELECT * FROM usuario WHERE email=? AND cadenaverificacion=?;";

    $st=$conn -> prepare($query);
    $st_prepared=$st -> bind_param("ss", $userEmail, $userVerificationCode);
    $st_executed=$st -> execute();
    
    if($st_prepared && $st_executed)
    {
        $st_result=$st -> get_result();
        if($usuario=$st_result -> fetch_assoc()) 
        {
            $userId=intval($usuario["id"]);
            $intVal_true=intval(true);

            $query="UPDATE usuario SET activo = ? WHERE id = ?;";
            $st=$conn -> prepare($query);
            $st_prepared=$st -> bind_param("ii", $intVal_true, $userId);
            $st_executed=$st -> execute();
            
            $st -> close();
            $conn -> close();
            return $st_prepared && $st_executed;
        }
    }

    $st -> close();
    $conn -> close();
    return false;
}

function getUserFromId($idUser)
{
    $userFromId=null;

    $conn=connectToDB();
    $query="SELECT * FROM usuario WHERE id=?;";
    
    $st=$conn -> prepare($query);
    $st_prepared=$st -> bind_param("i", $idUser);
    $st_executed=$st -> execute(); 

    if($st_prepared && $st_executed) 
    {
        $st_result=$st -> get_result();

        if($userData=$st_result -> fetch_assoc()) 
            $userFromId=$userData;
    }

    $st -> close();
    $conn -> close();
    return $userFromId;
}
?>