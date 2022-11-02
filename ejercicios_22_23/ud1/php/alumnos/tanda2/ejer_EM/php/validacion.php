<?php
    include 'constantes.php';
    include 'funciones.php';
    $errores = array();
    if (isset($_POST['entrar'])) {
        $cod = validarUsuario();
        switch ($cod) {
            case 0:
                header("Location: login.php?error=0");
                break;
            case 1:
                header("Location: login.php?error=1&user=$user"); 
                break;
            
            case 2:
                header("Location: chat.php");
                break;
                
            case 3:
                header("Location: alta.php?reenviado=si");
                break;
        }
    }  


?>