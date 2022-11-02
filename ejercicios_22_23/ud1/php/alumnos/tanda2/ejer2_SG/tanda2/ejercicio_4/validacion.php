<?php
    if(isset($_POST["entrada"])){
        $usuario = $_POST["nombre_usuario"];
        $password = $_POST["contraseina"];
        $archivo = fopen("../ficheros_ejercicio2_5/usuarios.txt","r");
        $esElUsuario = false;
        $constrainaValida = false;
        while (!feof($archivo)) {
            $linea = fgets($archivo);
            $posible_usuario = substr($linea,0,strpos($linea,":"));
            if($posible_usuario == $usuario){
                $posible_password = substr($linea,strpos($linea,":")+1);
                $posible_password = trim($posible_password);
                $esElUsuario = true;
                if($posible_password == $password){
                    $constrainaValida = true;
                }
                break;
            }
        }
        if($esElUsuario && $constrainaValida){
            session_start();
            $_SESSION["logeado"] = $usuario;
            header("Location: charla.php");
        }
        if($esElUsuario && !$constrainaValida){
            header("Location: login.php?usuario=$usuario");
        }
        if(!$esElUsuario){
            header("Location: alta.php?");
        }
    }
?>