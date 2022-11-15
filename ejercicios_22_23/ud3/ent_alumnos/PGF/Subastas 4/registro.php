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
        <h1>REGISTRO</h1>
        <?php
        if(isset($_POST["registrar"])){
            if($_POST['contrasena']==$_POST['contrasenasConfirm']){
                include_once("config.php");
                $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);

                mysqli_select_db($conn, DB_DATABASE);
                
                $usuario=$_POST['usuario'];

                $sqlId="SELECT MAX(id) as id,(SELECT count(id) FROM usuarios WHERE username='$usuario') as repe FROM usuarios";
                $resultado= $conn->query($sqlId);
                $fila = $resultado -> fetch_assoc();

                if($fila['repe']==0){
                    $id=$fila['id']+1;
                    $nombre=$_POST['nombre'];
                    $contrasena=$_POST['contrasenas'];
                    $email=$_POST['email'];
                    
                    //Cadena de 16 caracteres random

                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersLength = strlen($characters);
                    $randomString = '';
                    for ($i = 0; $i < 16; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                    }

                    $sql="INSERT INTO usuarios VALUES('$id','$usuario','$nombre','$contrasena','$email','$randomString',1,0)";
        
                    if ($conn->query($sql) === TRUE) {
                        //Si funcionase lo del mail
                        //header("Location: verificacion?email=$email&codigo=$randomString.php&usuario=$usuario");
                        header("Location: login.php");
                    } 
                    else {
                        print "Error";
                    }
                }
                else{
                    print "El NOMBRE DE USUARIO $usuario ya esta elegido<br>";
                }
            }
            else{
                print "Las contraseñas no cuinciden<br>";
            }
        }
    ?>

    <span>Para registrarte en SUBASTAS DEWS, rellena el siguiente formulario</span>
    <form action="registro.php" method="post">
    <table>
        <tr>
            <td>Usuario</td>
            <td><input type="text" id="usuario" name="usuario"></td>
        </tr>
        <tr>
            <td>Nombre completo</td>
            <td><input type="text" id="nombre" name="nombre"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="text" id="contrasena" name="contrasena"></td>
        </tr>
        <tr>
            <td>Password (de nuevo)</td>
            <td><input type="text" id="contrasenasConfirm" name="contrasenasConfirm"></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" id="email" name="email"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit"  name="registrar" value="registrar"></td>
        </tr>
    </table>
    </form>
        </div>
    </div>
    
</body>
</html>