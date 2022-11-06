<?php
    /**
     * Pagina encargada de obtener el menu a mostrar por el usuario en
     * base a si el usuario está logueado y quien es el usuario. 
     * En caso no estar logueado se mostrarán los siguientes puntos de menu: Login
     * En caso estar logueado y de ser admin el usuario puede acceder a dos puntos de menu mas: Subastas vencidas y Anunciantes
     */
    include_once "config.php";

    if(isset($_SESSION['usuario'])){
        $usuario = $_SESSION['usuario'];
    }

    if(isset($_SESSION['usuario']) == TRUE) {
        echo "<a href='logout.php'> Logout ($usuario)</a>";
        echo "<a href='nuevoitem.php'> Nuevo ítem </a>";
        if($usuario == USUARIO_ADMIN){
            echo "<a href='vencidas.php'> Subastas vencidas </a>";
            echo "<a href='Publi.php'> Anunciantes </a>";
        }
    }else {
        echo "<a href='login.php'> Login </a>";
    }
?>