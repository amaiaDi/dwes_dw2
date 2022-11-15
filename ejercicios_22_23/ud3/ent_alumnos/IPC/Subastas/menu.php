<?php 
    //session_start();
require_once("config.php");
?>
<a href="index.php">Home</a>
<?php
    if(isset($_SESSION['usuario']) == TRUE) {
        echo "<a href='index.php?pagActual=logout'>Logout</a>";
    }
    else {
        echo "<a href='index.php?pagActual=login'>Login</a>";
    }
?>
<a href="index.php?pagActual=nuevoitem">Nuevo Item</a>
<!-- NO PUEDO MOSTRAR NOMBRE DE USUARIO PORQUE EL SESSION_START NO QUIERE -->
<a><span style="color:#24cc0a;float: right;margin-right:20px;"><?php
             if(isset($_SESSION['usuario']) == TRUE) 
                echo $_SESSION['usuario'];
?></span></a>
