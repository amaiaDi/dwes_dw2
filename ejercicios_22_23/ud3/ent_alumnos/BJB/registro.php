<?php require("cabecera.php"); ?>
<?php
    $con = mysqli_connect(HOST, USER, PASS);
    mysqli_select_db($con, DATABASE);

?>

<!DOCTYPE html>
<html lang="eS">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>REGISTRO</h1>
    <p>Para registrarse en SUBASTAS JOSELITO, rellena el siguiente formulario</p>
    <?php 
        if(isset($_POST['usuario'])){
            $usuario=$_POST['usuario'];
            $cuantosUsuarios=existeUsuario($usuario);
            if($cuantosUsuarios>0){
                echo "<p class='error'>El usuario $usuario ya existe</p>";
            }
            else{
                $nombrecompleto=$_POST['nombre'];
                $contrasenia=$_POST['password'];
                $email=$_POST['email'];
                $cadena=cadenaRandom();
                $consultaInser="INSERT INTO usuarios  (id, username, nombre, password, email, cadenaverificacion, activo, falso) VALUES (NULL, '$usuario','$nombrecompleto' , '$contrasenia', '$email', '$cadena','0', '1');";
                insertarTupla($consultaInser);
                echo '<p>Usuario creado</p>';

            }
        }
    
    ?>
    <form action="registro.php" method="post">
        <table class="registro-login">
            <tr>
                <td><label for="usuario">Usuario</label></td>
                <td><input type="text" name="usuario"></td>
            </tr>
            <tr>
                <td><label for="nombre">Nombre completo</label></td>
                <td><input type="text" name="nombre"></td>
            </tr>
            <tr>
                <td><label for="password">Password</label></td>
                <td id="pass"><input type="password" name="password"></td>
            </tr>
            <tr>
                <td><label for="password2">Password (de nuevo)</label></td>
                <td><input type="password" name="password2"></td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td><input type="email" name="email"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Registrarse" name="registrarse"></td>
            </tr>
        </table>
    </form>
    <?php require("pie.php"); ?>
</body>
</html>