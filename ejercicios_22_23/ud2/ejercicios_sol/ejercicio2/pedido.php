<?php
    //Iniciamos sesion
    session_start();

    //controlamos si el usuario ha accedido mediante el metodo de validación de usuarios, si no le redirigimos a 
    if(!isset($_SESSION['usuario']) || (isset($_SESSION['usuario']) && empty($_SESSION['usuario']))){
        session_destroy();
        header('Location: entrada.php?error=ERROR_USUARIO_NO_AUTENTICADO');   
    }

    //si estamos accediendo desde la pantalla de pedido plato, obtenemos el valor del plato seleccionado
    if(isset($_POST['elegir'])){

        $arraySeleccion=array();
        if(isset($_SESSION['eleccion'])){
            $arraySeleccion=$_SESSION['eleccion'];
        }
        //introducimos el plato selecciondo en el array
        $arraySeleccion[$_POST['tipo']]=$_POST['platos'];
        //lo volvemos a asignar al objeto sesion
        $_SESSION['eleccion']=$arraySeleccion;
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
    <?php
        // Incluimos los ficheros de funciones y constantes generales
        include_once("libmenu.php");
        include_once("../constantes.php");
    ?>

    <table>
        <tr><td ><a href="pedidoplato.php?tipo=primero"><?php echo PRIMER_PLATO?></a></td></tr>
        <tr><td ><a href="pedidoplato.php?tipo=segundo"><?php echo SEGUNDO_PLATO?></a></td></tr>
        <tr><td ><a href="pedidoplato.php?tipo=postre"><?php echo POSTRE?></a></td></tr>
        <tr><td ><a href="pedidoplato.php?tipo=bebida"><?php echo BEBIDA?></a></td></tr>
        <tr><td ></br></td></tr>
        <?php if (isset($_SESSION['eleccion']) &&  !empty($_SESSION['eleccion'])){?>
            <tr><td><?php echo ELECCION?></td></tr>
            <tr>
                
                <td>
                    <?php
                        $arrayEleccion=$_SESSION['eleccion'];
                        if(!empty($arrayEleccion)){
                            echo "<ul>";
                            foreach($arrayEleccion as $clave=>$valor){
                                echo "<li> ".fncObtenerTextoPlato($clave).": $valor </li>";
                            }
                            echo "</ul>";
                        }
                    ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>