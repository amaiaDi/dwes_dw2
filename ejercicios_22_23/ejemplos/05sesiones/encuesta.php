<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php


    session_start();  
    if (!isset($_SESSION['login'])){
        header("location:index.php");
        exit();        
    }
    
    $fondo="white";
    if (isset($_COOKIE['sexo'])){
        if ($_COOKIE['sexo']=='M')
            $fondo="pink";
        else
            $fondo="yellow";
        
    }
    

?>         

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body bgcolor="<?php echo $fondo   ?>">
        <?php

            if (!isset($_SESSION['visitados'])){
                    $_SESSION['visitados']=array();
            }
            
            if (isset($_GET['lugar'])){
                
                if (!in_array($_GET['lugar'], $_SESSION['visitados']))
                    $_SESSION['visitados'][]=$_GET['lugar'];
                
                print_r($_SESSION['visitados']);
            }
            
            
            
            $lugares=["London","Madrid","Sydney","Caracas"];
                        
        
            echo "<p>Encuesta para " . $_SESSION['login'] . "</p>";
            
            echo "<p>Pincha los lugares que has visitado</p>";
            
            echo "<ul>";
            foreach ($lugares as $lugar){
                $enlace=$_SERVER['PHP_SELF']."?lugar=$lugar";
                
                if (in_array($lugar, $_SESSION['visitados']))
                    echo "<li>$lugar</li>";
                else
                    echo "<li><a href='$enlace'>$lugar</a></li>";
            }
            echo "</ul>";
            
        
        ?>
    </body>
</html>
