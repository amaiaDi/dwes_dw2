<?php
    /**
     * Pagina encargada de obtener el menu a mostrar por el usuario en
     * base a si el usuario está logueado y quien es el usuario. 
     * En caso no estar logueado se mostrarán los siguientes puntos de menu: Login
     * En caso estar logueado y de ser admin el usuario puede acceder a dos puntos de menu mas: Subastas vencidas y Anunciantes
     */

    if(isset($_SESSION['usuario']) == TRUE) {
        
        echo "<a href='nuevoitem.php'> ".TITULO_MENU_NUEVO_ITEM." </a>";
        if($usuario == USUARIO_ADMIN){
            echo "<a href='vencidas.php'> ".TITULO_MENU_SUBASTAS_VENCIDAS." </a>";
            echo "<a href='anunciantes.php'> ".TITULO_MENU_ANUNCIANTES." </a>";
        }
        echo "<a href='logout.php'> ".TITULO_MENU_LOGOUT." ($usuario)</a>";
    }else {
        echo "<a href='login.php'>".TITULO_MENU_LOGIN." </a>";
    }
?>