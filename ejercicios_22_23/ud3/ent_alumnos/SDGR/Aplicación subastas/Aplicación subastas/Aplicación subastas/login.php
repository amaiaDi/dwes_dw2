<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/stylesheet.css">
</head>
<body>
    <?php
        require "config.php";
        $nombre_Foro = NOMBRE_FORO;
        require "cabecera.php"; 
    ?>
    <div id="container">
        <h1>Login</h1>
        <?php 
            if(isset($_POST["logearse"])){
                $datosCorrectos = false;
                $sql = "select id, username user, nombre ,password pass, activo from usuarios";
                $resultado = $conn->query($sql);
                while($fila = $resultado -> fetch_assoc()){
                    if(strcmp($fila["user"],$_POST["usuario"])==0 && strcmp($fila["pass"],$_POST["contraseina"])==0 ){
                        $datosCorrectos = true;
                        if($fila["activo"] != 0){
                            session_start();
                            $pag = $_SESSION["ultima_pagina"];
                            $_SESSION["id_usuario"] = $fila["id"];
                            $_SESSION["nom_usuario"] = $fila["nombre"];
                            header("Location: $pag");
                        }else{
                            echo "<p>Esta cuenta no esta verificada. Te hemos enviado un email para confirmarla cuenta.</p>";
                        }
                        break;
                    }
                }
                if(!$datosCorrectos){
                    echo "<p>Login incorrecto. Intentalo de nuevo!</p>";
                }

            }
        ?>
        <form action="login.php" method="post">
            <table>
                <tr>
                    <td><label for="usuario">Usuario</label></td>
                    <td><input type="text" name="usuario" id="usuario"></td>
                </tr>
                <tr>
                    <td><label for="contraseina">Password</label></td>
                    <td><input type="password" name="contraseina" id="contraseina"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="logearse" value="Login!"></td>
                </tr>
            </table>
        </form>
        <p>No tienes una cuenta? <a href="registro.php">Registrate</a>!</p>
    </div>
</body>
</html>