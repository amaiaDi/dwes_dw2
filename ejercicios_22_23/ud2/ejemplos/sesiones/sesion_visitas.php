<?php
    session_start();

    if( ! isset($_SESSION['visitas']))
    {
    $_SESSION['visitas'] = 1;
    }
    else
    {
    $_SESSION['visitas'] = $_SESSION['visitas'] + 1;
    }
?>
<html>
    <body>
        <?php
        // Lee el contenido de la variable de sesión ‘visitas’
        echo "El valor de la variable visitas es : ".$_SESSION['visitas'] ;
        ?>
        
        </br>
        <a href="index.php">Volver a inicio</a></br>
        <a href="finalizar.php">Ir a pagina finalizacion</a>
    </body>
</html>