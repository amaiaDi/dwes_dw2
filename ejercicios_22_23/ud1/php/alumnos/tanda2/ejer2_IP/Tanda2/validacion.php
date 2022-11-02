<?php 
if(isset($_POST['comprobarUsuario'])){
    $nombre=$_POST['nombre'];
    $pass=$_POST['password'];

    //echo $nombre." ".$pass;

    //Variables a guardar
    $redireccion;
    $mensaje;

    //Nombre de usuario existente
    if(usuarioExistente($nombre)){
        //Comprobar si la contraseña existe
        if(usuarioExistenteContraseñaExistente($nombre, $pass)){    
            $mensaje=$nombre;
            $redireccion="charla.php?mensaje="."$mensaje";
        }else{
            $mensaje="CONTRASEÑA ERRÓNEA PARA <strong>$nombre</strong><br>Inténtalo de nuevo<br>";
            //$mensaje="CONTRASEÑA ERRÓNEA PARA <strong>$nombre</strong><br>Inténtalo de nuevo<br>".damepass($nombre)." - ".$pass;
            $redireccion="login.php?mensaje="."$mensaje";
        }
    //Nombre de usuario inexistente  
    }else{
        //Nombre de usuario vacío
        if($nombre==""){
            $mensaje="NOMBRE DE USUARIO VACÍO, introducza uno válido";
            $redireccion="login.php?mensaje="."$mensaje";
        }else{
            $mensaje="<strong>REGISTRATE</strong>";
            $redireccion="alta.php?mensaje="."$mensaje";
        }
        
    }
    header('Location: '.$redireccion);
}

function obtenerUsuarios(){
    $usuarios = array();
    $f= fopen('ficheros/usuarios.txt', 'r' );
    if(!$f){
         echo 'EL ARCHIVO NO EXISTE';
    }else{
        while (!feof($f)){
            $usu = explode(";", fgets ($f));
            if(sizeof($usu)==2){
                array_push($usuarios, $usu);
            }
           
        }
    fclose ($f) ;
    }
    return $usuarios;
}

function usuarioExistente($usuario){
    $us=obtenerUsuarios();

    for ($i=0; $i < sizeof($us) ; $i++) {
        if(in_array($usuario, $us[$i])){
            return true;         
        }
    }
    return false;
}

function usuarioExistenteContraseñaExistente($usuario, $pass){
    $us=obtenerUsuarios();

    for ($i=0; $i < sizeof($us) ; $i++) {
        if(in_array($usuario, $us[$i])){
            if(trim($us[$i][1])==$pass){
                return true;
            }        
        }
    }
    return false;
}
?>