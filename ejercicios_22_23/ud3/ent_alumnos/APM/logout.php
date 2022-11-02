<?php 
    require "cabecera.php";
    unset($_SESSION['user']);
    unset($_SESSION['link']);
    header("Location:."); 
?>