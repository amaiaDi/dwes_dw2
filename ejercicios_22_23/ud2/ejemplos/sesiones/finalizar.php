<?php
    session_start();
    // unset() es utilizada para liberar una variable específica
    function destruirVariable(){
        unset($_SESSION['visitas']) ;
    }
    // session_destroy() destruye la sesión de forma completa
    function destruirSesion(){
        session_destroy();
    }
    
?>
<html>
    <body>
        <?php
        // Lee el contenido de la variable de sesión ‘visitas’
        echo "Valor variable visitas : ".(isset($_SESSION['visitas'])?$_SESSION['visitas']:"No existe la variable visitas") ;
        ?>

        </br>
        <a href="<?php destruirVariable();?>">Destruir Variable</a>
        </br>
        <a href="pagina_sin_sesion.php<?php destruirSesion();?>">
            Destruir sesion
            
        </a>
        </br>
        <a href="index.php">Volver a inicio</a>
    </body>
</html>