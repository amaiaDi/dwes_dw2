<?php echo "_SERVER['REMOTE_ADDR']:".$_SERVER['REMOTE_ADDR'] ;

    
$exec = exec("hostname"); //the "hostname" is a valid command in both windows and linux 
$hostname = trim($exec); //remove any spaces before and after 
$ip = gethostbyname($hostname); //resolves the hostname using local hosts resolver or DNS
echo ("</br>");
echo ("hostname: $hostname ,ip:$ip");
echo ("</br>");
echo ("ip:".getRealIP());

function getRealIP(){

    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];
    
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];

    return $_SERVER['REMOTE_ADDR'];
}
?>