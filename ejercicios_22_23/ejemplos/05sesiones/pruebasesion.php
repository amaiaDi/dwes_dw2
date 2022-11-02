<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php

session_start();

if (!isset($_SESSION['clics']))
    $_SESSION['clics']=0;

if (isset($_GET['clic'])){
    $_SESSION['clics']++;    
}


?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        echo "<p>". session_id() ."</p>";
        echo "<p>". $_SESSION['clics'] . " clics</p>";
        echo "<p><a href='pruebasesion.php?clic'>Pincha aqui</a></p>";
        ?>
    </body>
</html>
