<?php
    $colores=array("rojo"=>"#ff0000","verde"=>"#00ff00","azul"=>"#0000ff");

    if (!isset($_REQUEST["radio"])){
         setcookie("micolor","#ffaa44",0,"/");
    }else{
        setcookie("micolor",$colores[$_REQUEST["radio"]],time()+180);
    }      
        /*
        if ($_REQUEST['radio']=="rojo")
            //setcookie("color","#ff0000",time()+20,"/");
            $_COOKIE['color']="#ff0000";
        elseif ($_REQUEST['radio']=="verde")
            setcookie("color","#00ff00",time()+60*60*24*365,"/");
        elseif ($_REQUEST['radio']=="azul")
            setcookie("color","#0000ff",time()+60*60*24*365,"/");
         * 
         */
?>
<html>
    <head>
        <title>Problema</title>
    </head>
    <body>
        Se creó la cookie.    
        <br> 
        <a href="pagina3.php">Ir a la pagina 3</a>
    </body>
</html>
