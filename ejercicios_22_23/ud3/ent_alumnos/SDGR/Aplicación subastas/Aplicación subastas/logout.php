<?php 
    session_start();
    $_SESSION["id_usuario"] = null;
    $_SESSION["nom_usuario"] = null;
    header("Location: index.php");
?>