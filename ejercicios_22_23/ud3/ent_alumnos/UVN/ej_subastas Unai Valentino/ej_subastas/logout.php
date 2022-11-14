<?php
    require('header.php');
    unset($_SESSION['usuario']);
    unset($_SESSION['id']);
    header('Location: index.php');
?>