<?php
    require('header.php');
    unset($_SESSION['user']);
    unset($_SESSION['id']);
    header('Location: index.php');
?>