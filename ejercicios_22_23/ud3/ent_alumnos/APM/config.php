<?php
    session_start();
    define("DB_HOST","localhost" );
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_DATABASE", "ud03"); 
    $nombreforo = "SUBASTAS DEWS";
    $rutabase = "C:\wamp\www\DEWS_BD\subastas";
    $monedalocal = "euro";
    $img = "img/";
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);   
    if($conn->connect_errno > 0){
        die("Imposible conectarse con la base de datos [" . $conn->connect_error . "]");
    }
    
    function generarCadenaRad($length) {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charsLen = strlen($chars);
        $randomStr = '';
        for ($i = 0; $i < $length; $i++) {
            $randomStr .= $chars[rand(0, $charsLen - 1)];
        }
        return $randomStr;
    }
?>