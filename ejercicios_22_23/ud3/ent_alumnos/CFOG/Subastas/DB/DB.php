<?php
function connectToDB()
{
    $conn=new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB);
    mysqli_set_charset($conn, "UTF8");
    
    return $conn;
}
?>