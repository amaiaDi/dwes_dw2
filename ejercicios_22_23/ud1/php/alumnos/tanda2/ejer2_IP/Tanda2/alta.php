<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta</title>
</head>
<body>
        <?php 
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
        ?>


        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <?php 
                if(isset($_GET["mensaje"])){
                    echo "<p>".$_GET["mensaje"]."</p>";
                }
                
                if(isset($_POST["altaUsuario"])){

                    if(usuarioExistente($_POST['nombreNuevo'])){
                        echo "<p id='desaparecer' style='color:red;'>Lo sentimos, ya existe un usuario <strong>".$_POST['nombreNuevo']."</strong></p>";
                    }else if(empty($_POST['passwordNuevo'])){
                        echo "<p id='desaparecer' style='color:red;'>Pon una contraseña!</p>";
                    }else{
                        //Hacer que desaparezca html previo
                        echo '<style>#desaparecer { display:none;}</style>';
                        
                        //Mostrar nuevo html y añadir nuevo usuario al fichero de usuarios
                        file_put_contents("ficheros/usuarios.txt","\r\n".$_POST['nombreNuevo'].";".$_POST['passwordNuevo'], FILE_APPEND);  
                        echo "<strong>".$_POST["nombreNuevo"]."</strong>: Has sido dado de alta<br>";
                        $mensaje=$_POST['nombreNuevo'];
                        echo "<a href='charla.php?mensaje=$mensaje'><strong style='text-decoration:underline; color:blue;'>ENTRAR AL CHAT</strong></a>";
                    }
                } 
            ?>
            <label id="desaparecer">Nombre de usuario:<input type="text" id="nombreNuevo" name="nombreNuevo"></label><br>
            <label id="desaparecer">Contraseña:<input type="password" id="passwordNuevo" name="passwordNuevo"></label>
            <input type="submit" id="desaparecer" value="altaUsuario" name="altaUsuario"/>
        </form>
</body>
</html>