<?php
    /**
     * Pagina de logout
     */
    session_destroy();
    header("Location: index.php");
?>