<?php

function usuarioExiste($usuario){
    $handle = fopen("txt/usuarios.txt","r");
    while(!feof($handle)){
        $linea = fgets($handle);
        $partes = explode(";",$linea);
        if($usuario === $partes[0]){
            fclose($handle);
            return true;
        }
    }
    fclose($handle);
    return false;
}

function contraseniaCorrecta($usuario, $contrasenia){
    $handle = fopen("txt/usuarios.txt","r");
    while(!feof($handle)){
        $linea = fgets($handle);
        $partes = explode(";",$linea);
        if($partes[0] === $usuario && trim($partes[1]) === $contrasenia){
            fclose($handle);
            return true;
        }
    }
    fclose($handle);
    return false;
}


if(isset($_POST['enviar_usuario_contrasenia'])){
    $usuario = trim($_POST['usuario']);
    $contrasenia = trim($_POST['contrasenia']);
    if(usuarioExiste($usuario)){
        echo "existe: $usuario<br>";
        if(contraseniaCorrecta($usuario, $contrasenia)){
            // si usuario existe y pass correcto -> charla.php
            header("Location: charla.php?usuario=$usuario");
        }
        else{
            // si usuario existente y pass incorrecto -> login.php
            // conservamos el nombre de usuario
            header("Location: login.php?usuario=$usuario");
            exit;
        }
    }
    else {
        // si usuario no existente -> alta.php
        header("Location: alta.php");
        exit;
    }
    
}


?>