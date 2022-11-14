<?php
    /**
     * Pagina de login que se carga en el centro, en el div main
     */
    //Cagamos la estructura de la pagina de cabecera
    require("cabecera.php");
    //Establece la información de la ultima pagina visitada.Cargamos la de la pagina a la que accedemos porque será la anteior al movernos a la siguiente
    //$_SESSION['pagina_anterior'] =  $_SERVER["REQUEST_URI"];

    //Si la peticon viene del formulario de usuario, recuperamos los datos y metemos el usuario en sesion
    if(isset($_POST['usuario'])){
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        if(comprobarLogin($usuario, $password) == 1){
            $_SESSION['usuario'] = $usuario;
            $_SESSION['password'] = $password;
            $pagina_anterior = $_SESSION['pagina_anterior'];
            header("Location: $pagina_anterior");
        }
        elseif (comprobarLogin($usuario, $password) == 2) {
            $mensaje =  "Esta cuenta no está verificada. Te hemos envíado un email para verificarla.";
        }
        else{
            $mensaje = "Login incorrecto. Inténtalo de nuevo!";
        }
    }

?>
    <header>
        <h1>LOGIN</h1>
    </header>
    <form action="login.php" method="post" >
        <table >
            <tr>
                <td><label for="usuario">Usuario</label></td>
                <td><input type="text" name="usuario"></td>
            </tr>
            <tr>
                <td><label for="password">Password</label></td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Login!" name="loguearse"></td>
            </tr>
        </table>
        <p>No tienes una cuenta? <a href="registro.php">Regístrate!</a></p>
    </form>
    <?php if(isset($mensaje)) echo "<p class='msg-rojo'>$mensaje</p>"?>
    <?php require("pie.php"); ?>