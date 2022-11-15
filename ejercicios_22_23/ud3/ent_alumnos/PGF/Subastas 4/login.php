<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css" type="text/css"/>
    </head>
    <body>
        <div id="header">
            <h1>SUBASTAS DEWS</h1>
        </div>
        <div id="menu">
            <a href="index.php">Home</a>
            <?php
            if(isset($_SESSION["id"])){
                print "<a href='logout.php'>Logout</a>";
            }
            else{
                print "<a href='login.php'>Login</a>";
            }
            ?>
            <a href="">Nuevo</a>
            <a href="">Item</a>
        </div>
        <div id="container">
            <div id="bar">
                <?php include("barra.php") ?>
            </div>
            <div id="main">
            <?php
                if(isset($_POST["login"])){
                    include_once("config.php");
                    $usuario=$_POST['usuario'];
                    $contrasena=$_POST['contrasena'];
                    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
                    mysqli_select_db($conn, DB_DATABASE);
                    $sqlId="SELECT id as id FROM usuarios WHERE username='$usuario' and password='$contrasena'";
                    $resultado= $conn->query($sqlId);
                    $fila = $resultado -> fetch_assoc();
                    if(isset($fila['id'])){
                        $_SESSION['username']=$usuario;
                        $_SESSION['id']=$fila['id'];
                        $conn->close();
                        header("Location: index.php");
                        
                    }
                    else{
                        print "Nombre de usuario o contraseña incorrecta";
                        $conn->close();
                    }
                }
            ?>
            <h1>Login</h1>
            <form action="login.php" method="post">
                <table>
                    <tr>
                        <td>Usuario</td>
                        <td><input type="text" id="usuario" name="usuario"></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="text" id="contrasena" name="contrasena"></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td><input type="submit"  name="login" value="Login!"></td>
                    </tr>
                </table>
                <span>No tienes cuenta? <a href="registro.php"><b>Regístrate!</b></a></span>
            </form>
            </div>
        </div>
    </body>
</html>