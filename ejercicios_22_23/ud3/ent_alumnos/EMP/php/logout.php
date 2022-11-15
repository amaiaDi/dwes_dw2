<?php 
    session_start();
    require 'config.php';
    if (isset($_GET['referer'])) {
        $_SESSION['pagAnterior'] = $_GET['referer'];
    }
    unset($_SESSION['user']);
    unset($_SESSION['id']);
    header("Location: ".DIR);
?>