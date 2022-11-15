<?php
    require_once("config.php");
    require_once("funciones.php");

    //Crear conexion BD
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    mysqli_select_db($con, DB_DATABASE);
?>
<?php
function insertarUsuario(){
    global $con;
    $error="";

    if(isset($_POST["registrate"])){

        //Usuario
        if(isset($_POST["usuario"]) && !empty($_POST["usuario"])){
            //COMPROBAR SI EL USUARIO EXISTE
            if(existeUsername($con, $_POST["usuario"])){
                $error="<span style='color:red;font-weight:bold;'>ERROR - NOMBRE DE USUARIO EXISTENTE</span>";
            }
        }else{
            $error="<span style='color:red;font-weight:bold;'>ERROR - datos incorrectos</span>";
        }

        //Usuario completo
        if(!isset($_POST["nombreCompleto"]) || empty($_POST["nombreCompleto"])){
            $error="<span style='color:red;font-weight:bold;'>ERROR - datos incorrectos</span>";
        }

        //Contraseña
        if(!isset($_POST["password"]) || empty($_POST["password"])){
            $error="<span style='color:red;font-weight:bold;'>ERROR - datos incorrectos</span>";
        }

        if(isset($_POST["password2"]) && !empty($_POST["password2"])){
            if($_POST["password"]!=$_POST["password2"]){
                $error="<span style='color:red;font-weight:bold;'>ERROR - CONTRASEÑAS DISTINTAS</span>";
            }
        }else{
            $error="<span style='color:red;font-weight:bold;'>ERROR - datos incorrectos</span>";
        }
        
        //Correo
        if(!isset($_POST["emailRegistro"]) || empty($_POST["emailRegistro"])){
            $error="<span style='color:red;font-weight:bold;'>ERROR - datos incorrectos</span>";
        }

        //INSERTAR USUARIO EN BBDD SI NO HAY ERRORES
        if($error==""){
            $error="USUARIO registrado!";
            $usuario=$_POST["usuario"];
            $nombreCompleto=$_POST["nombreCompleto"];
            $password=$_POST["password"];
            $emailRegistro=$_POST["emailRegistro"];
            $sql="INSERT INTO usuarios (username, nombre, password, email, cadenaverificacion, activo, falso) VALUES
            ('$usuario', '$nombreCompleto', '$password', '$emailRegistro','verific','0','0')";
            $resultado=mysqli_query($con, $sql);
            if(mysqli_errno($con)) die(mysqli_error($con));
        }

    }
    return $error;
}
?>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
    <h1>REGISTRO</h1>
        <table>
        <caption>Para registrarte en <?php echo NOMBRE_FORO;?>, rellena el siguiente formulario.</caption>
        <p><?php if(isset($_POST["registrate"]))echo insertarUsuario(); ?></p>
            <tr>
                <td>Usuario</td>
                <td><input type="text" name="usuario" value=""></td>
            </tr>
            <tr>
                <td>Nombre Completo</td>
                <td><input type="text" name="nombreCompleto" value=""></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" value=""></td>
            </tr>
            <tr>
                <td>Password(de nuevo)</td>
                <td><input type="password" name="password2" value=""></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="emailRegistro" value=""></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="registrate" name="registrate"/></td>
            </tr>
        </table>
    </form>