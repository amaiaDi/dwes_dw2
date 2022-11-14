<?php
    /**
     * Pagina encargada crear la estructura, mostrar la cabecera con el titulo, el mehnu, 
     * la barra de tareas y abrir la etiqueta del div main, para poder insertar contenido en el contenedor main 
     */
    //Iniciamos session en la aplicación, si existe la recupera
    session_start();
    require_once "cabecera.php";
?>
<!-- Creamos la estructura HTML que mostrará la pagina final -->
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Muestra el titulo que aparece en la parte de arriba del navegador-->
        <title><?=TITULO_SUBASTAS?></title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <!-- Abre Div header y menu -->
        <header id="header">
            <!--  Titulo de la pantalla-->
            <h1><?php echo TITULO_SUBASTAS?></h1>
            <!-- Contenido de menu-->
            <nav id="menu">
                <?php require_once("menu.php"); ?>   
            </nav>
        </header>

        <!-- Abre Div Container - Bloque que contiene el contenido de bar 
        con los enlaces y de main con el contenido dinamico-->
        <div id="container">
            <div id="bar">
                <?php require_once("barra.php"); ?>
            </div>

            <!-- Abre Div Main - Parte central de la pantalla
            que contiene el contenido dinamico que va cambiando -->
            <div id="main">
                
                <?php if(isset($_GET['ira']) && $_GET['ira']=='nuevoitem'){?>
                    <?php require_once("nuevoitem.php"); ?>
                <?php }elseif(isset($_GET['ira']) && $_GET['ira']=='editaritem'){?>
                    <?php require_once("editaritem.php"); ?>                            
                <?php }elseif(isset($_GET['ira']) && $_GET['ira']=='vencidas'){?>
                    <?php require_once("vencidas.php"); ?>                
                <?php }elseif(isset($_GET['ira']) && $_GET['ira']=='anunciantes'){?>
                    <?php require_once("anunciantes.php"); ?>
                <?php }elseif(isset($_GET['ira']) && $_GET['ira']=='login'){?>
                    <?php require_once("login.php"); ?>
                <?php }elseif(isset($_GET['ira']) && $_GET['ira']=='logout'){?>
                    <?php require_once("logout.php"); ?>
                <?php }elseif(isset($_GET['ira']) && $_GET['ira']=='registro'){?>
                    <?php require_once("registro.php"); ?>
                <?php }elseif(isset($_GET['ira']) && $_GET['ira']=='itemdetalles'){?>
                    <?php require_once("itemdetalles.php"); ?>
                <?php }elseif(isset($_GET['ira']) && $_GET['ira']=='verificacion'){?>
                    <?php require_once("verificacion.php"); ?>
                <?php }else{?>
                    <?php require_once("listado-items.php"); ?>
                <?php }?>
            </div>
        </div>
   </body>
</html>
