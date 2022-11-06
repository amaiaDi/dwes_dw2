<?php
    require("cabecera.php");
    $con = mysqli_connect(DB_HOST,DB_USER,DB_PASS);
    mysqli_select_db($con, DB_DATABASE);
    // $_SESSION['pagina_anterior'] =  $_SERVER["REQUEST_URI"]; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/styles.css">
    <title>Registro</title>
</head>
<body>
    <?php
    // if(!isset($_GET['mensaje'])){
        if(isset($_POST['registrarse'])){
            $usuario = $_POST['usuario'];
            if(usuarioExiste($usuario)){
               $mensaje = "El usuario $usuario ya existe";
               header("Location: registro.php?mensaje=$mensaje");
            }
            else {
               $nombre = $_POST['nombre'];
               $pass = $_POST['password'];
               $email = $_POST['email'];
               $cadena_veri = crearCadenaVerificacion();
            //    insertarUsuario($usuario, $nombre, $pass, $email, $cadena_veri);
               // MANDAR MAIL PARA VERIFICACIÓN
               $url_cadena_veri=urlencode($cadena_veri); 
               $url_email = urlencode($email);
               $enlace="http://localhost/dwes/ud3%20-%20BBDD/subastas/verificacion.php?email=$url_email&cadena_verif=$url_cadena_veri";            
               
               $mens=<<<MAIL
               Hola $usuario. Haz clic en el siguiente enlace para registrarte:
               $enlace
               Gracias
               MAIL;
               
               if (mail($email,"Registro en SUBASTAS DEWS", $mens, "From:subastas.practica@gmail.com")){
                   insertarUsuario($usuario, $nombre, $pass, $email, $cadena_veri);
                   echo "Mensaje enviado, comprueba tu correo para verificar tu cuenta<br><br>";
                   echo "Añado el enlace para comprobar si funcionaría el enlace envíado:<br><br>";
                   echo $enlace;
               }
               else{
                   echo "No se pudo enviar mensaje";
               }
               
            }
       }
    // }
    ?>
    <header>
        <h1>REGISTRO</h1>
    </header>
    <p><?php if(isset($_GET['mensaje'])) echo $_GET['mensaje'];?></p>
    <p>Para registrarte en SUBASTAS DEWS, rellena el siguiente formulario</p>
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
                <td><label for="password_2">Password (de nuevo)</label></td>
                <td><input type="password" name="password_2"></td>
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
    <script>
        const btn = document.querySelector("input[type='submit']");
        btn.addEventListener("click", (event)=>{
            const pass = document.querySelector("input[name='password']");
            const pass_comp = document.querySelector("input[name='password_2']");
            if(pass.value !== pass_comp.value){
                event.preventDefault();
                const mensaje = document.createElement('p');
                mensaje.innerHTML = "* Las contraseñas no coinciden";
                const formulario = document.querySelector('form');
                formulario.appendChild(mensaje);
            } 
        });
    </script>
</body>
</html>