<?php 
session_start();
require_once("config.php");
require_once("funciones.php");

//Crear conexion BD
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
 mysqli_select_db($con, DB_DATABASE);
?>

<?php
function loguearUsuario(){
    global $con;
    $error="";

    if(isset($_POST["login"])){
        //Comprobar si ambos campos se han rellenado
        if(!isset($_POST["usuario"]) || empty($_POST["usuario"])){
            $error="<span style='color:red;font-weight:bold;'>ERROR - campos vacíos</span>";
        }
        if(!isset($_POST["password"]) || empty($_POST["password"])){
            $error="<span style='color:red;font-weight:bold;'>ERROR - campos vacíos</span>";
        }

        //Si ambos campos se han rellenado
        if($error==""){
            $usuario=$_POST["usuario"];
            $password=$_POST["password"];
            $existe=existeUsername($con, $usuario);
            $resultadoUsuarios=dameUsuarios($con);
            if($existe){
                while($filaUsuarios = mysqli_fetch_assoc($resultadoUsuarios)){ 
                    if($filaUsuarios["username"]==$usuario){
                        if($filaUsuarios["password"]==$password){
                            if($filaUsuarios["activo"]==1){
                                $_SESSION["usuario"]=$usuario;
                                $_SESSION["id"]=$filaUsuarios["id"];
                                header("location: index.php");
                            }else{
                                //Verificar email
                            }
                        }else{
                            $error="CONTRASEÑA incorrecta";
                            header("location: index.php?pagActual=login");
                        }
                    }
                }
            }else{
                $error="USUARIO inexistente.";
                header("location: index.php?pagActual=login");
            }
        }
    }
    return $error;
}
?>

    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <h1>LOGIN</h1>
        <p><?php if(isset($_POST["login"]))echo loguearUsuario(); ?></p>
            <table>
                <tr>
                    <td>Usuario</td>
                    <td><input type="text" name="usuario" value=""></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" value=""></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="login" name="login"/></td>
                </tr>
            </table>
    </form>
    <a href="index.php?pagActual=registro">No tienes una cuenta? <strong>Registrate!</strong></a>