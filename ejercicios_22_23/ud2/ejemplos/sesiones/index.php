<?php
    //Ejemplos de manejo, creación y destrucción de sessiones
    session_start();
    // Crea variable de sesión ‘visitas’ con un valor
    //$_SESSION['visitas'] = 1;

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
        echo "Inicializada variable visitas a : ".$_SESSION['visitas'] ;
        ?>

        </br>
        <a href="sesion_visitas.php">Ir a siguiente pagina</a>
    </body>
</html>


