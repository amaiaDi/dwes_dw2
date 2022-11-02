<?php
    session_start();
    include_once ('libmenu.php');
    include_once ('../constantes.php');
 
    $arrayDatosUsuarios;

    //Boton de acceso pulsado el de socio
    if(isset($_POST['btnAccesoSocio'])){
        if(fncAutenticar($_POST['txtUsuario'], $_POST['txtPassword'])==1) {
            $_SESSION['usuario']= $_POST['txtUsuario'];
            $_SESSION['descuento']= fncDameDcto($_POST['txtUsuario']);
            header("Location: pedido.php");

        }else{
            header("Location: entrada.php?usuario=".$_POST['txtUsuario']."&error=ERROR_USUARIO_NO_VALIDO");
        }
    } 

    //Boton de acceso pulsado el de Invitado
    if(isset($_POST['btnAccesoInvitado'])){
        if(fncAutenticar('Invitado', 0)==1) {
            $_SESSION['usuario']='Invitado';
            $_SESSION['descuento']= 0;
            header('Location: pedido.php?usuario=Invitado');
        }else{
            header('Location: entrada.php?usuario=Invitado&error=ERROR_INVITADO');
        }
    } 
?>