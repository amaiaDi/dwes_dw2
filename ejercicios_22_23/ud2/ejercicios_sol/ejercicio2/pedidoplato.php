<?php
    session_start();

    include_once('libmenu.php');
    include_once('../constantes.php');
    $mensaje="";
    $tipo="";

    //validamos que se acceda mediante el login y su no se reenvía a la pagina de login
    if(!isset($_SESSION['usuario']) || (isset($_SESSION['usuario']) && empty($_SESSION['usuario']))){
        header('Location: entrada.php?error=ERROR_USUARIO_NO_AUTENTICADO');
        session_destroy();
    }

    //Recuperamos el tipo de plato del menu seleccionado y lo añadimos a la sesion
    if(isset($_GET['tipo']) && !empty($_GET['tipo'])){
        $_SESSION['tipo']=$_GET['tipo'];
        $tipo=$_GET['tipo'];

    }

    //si el plato ya ha sido seleccionado mostraremos un mensaje de el plato existente y la opción de cambio
    if(isset($_SESSION['eleccion']) && !empty($_SESSION['eleccion'])){
        $arraySeleccion=$_SESSION['eleccion'];
        if(isset($arraySeleccion[$tipo])){
            $mensaje= MSJ_REPETIR_ELECCION."<b>".$arraySeleccion[$tipo]."</b>".POR;
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../estilos.css"></link>
    <title>Ejercicio 2 - Menu / Pedido - Sesiones</title>
</head>
<body>
    <form action="pedido.php" method="post"> 
        
        <?php

            if(!empty($mensaje)){
                echo $mensaje."</br>"; 
            }

            $tipo=$_SESSION['tipo'];
            $arrayDatosPedidos=fncDamePlatos($tipo);

            if(isset($tipo)  && !empty($tipo)){
                echo "<select name='platos'>";
                foreach($arrayDatosPedidos as $clave=>$valor){
                    echo "<option value='$clave' >".strtoupper($tipo).":$clave + $valor €</option>";
                }
                echo "</select>";
            }
            
        ?>
        <input type="hidden" name="tipo" value="<?php echo $tipo;?>">
        <input type="submit" name="elegir" value="<?php echo 'ELEGIR '.$tipo;?>">
    </form>
</body>
</html>