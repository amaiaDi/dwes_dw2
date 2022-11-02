<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio 4</title>
</head>
<body>
    <?php 
        $estaUsuario = false;
        if(isset($_POST["registrar"]) && !empty($_POST["nuevo_usuario"])){
            $estaUsuario = estaUser($_POST["nuevo_usuario"]);
            if(!empty($_POST["contraseina"]) && !$estaUsuario){
                guardarUsuario($_POST["nuevo_usuario"],$_POST["contraseina"]);
                session_start();
                $_SESSION["logeado"] = $_POST["nuevo_usuario"];
                header("Location: login.php?");
            }
        }
    ?>
    <main>
        <form action="alta.php" method="post">
            <h1>REGISTRATE</h1>
            <?php
                if($estaUsuario) 
                    echo "<p style='color:red'>Lo sentimos, ya existe el usuario <b>". $_POST["nuevo_usuario"] ."</b></p>";
                ?>
            <table>
                <tr>
                    <td><label for="nuevo_usuario">Login: </label></td>
                    <td><input type="text" name="nuevo_usuario" id="nuevo_usuario"></td>
                </tr>
                <tr>
                    <td><label for="contraseina">Password: </label></td>
                    <td><input type="password" name="contraseina" id="contraseina"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="registrar" value="REGISTRAR"></td>
                </tr>
            </table>
        </form>
    </main>
    <?php        
        function estaUser($usuario){
            session_start();
            $archivo = fopen("../ficheros_ejercicio2_5/usuarios.txt","r");
            while (!feof($archivo)) {
                $linea = fgets($archivo);
                $posible_usuario = substr($linea,0,strpos($linea,":"));
                if($posible_usuario == $usuario){
                    $_SESSION["logged"] = $_POST["nuevo_usuario"];
                    return true;
                }
            }
            fclose($archivo);
            $_SESSION["logged"] = null;
            return false;
        }
        function guardarUsuario($usuario, $password){
            $archivo = fopen("../ficheros_ejercicio2_5/usuarios.txt","a");
            fwrite($archivo,"\n".$usuario.":".$password);
            fclose($archivo);
        }
    ?>
</body>
</html>