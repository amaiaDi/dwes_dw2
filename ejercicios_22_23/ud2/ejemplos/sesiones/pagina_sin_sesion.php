<html>
    <body>
        <?php
        // Lee el contenido de la variable de sesión ‘visitas’
        echo "Valor variable visitas : ".(isset($_SESSION['visitas'])?$_SESSION['visitas']:"No existe la variable visitas") ;
        ?>
        </br>
        <a href="index.php">Volver a inicio</a>
    </body>
</html>