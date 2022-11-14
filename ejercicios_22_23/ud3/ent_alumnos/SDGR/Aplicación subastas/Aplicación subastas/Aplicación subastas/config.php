<?php 
    define("DB_HOST","localhost" );  
    define("DB_USER", "root");  
    define("DB_PASS", "");  
    define("DB_DATABASE", "gestion_subastas" );  
    define("IMAGENES","imagenes");
    define("NOMBRE_FORO","SUBASTAS DEWS");
    define("DIVISA_LOCAL","EURO");
    define("RUTABASE","index.php");

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);   
    if($conn->connect_errno > 0){   
        die("Imposible conectarse con la base de datos [" . $conn->connect_error . "]");   
    }  

?>