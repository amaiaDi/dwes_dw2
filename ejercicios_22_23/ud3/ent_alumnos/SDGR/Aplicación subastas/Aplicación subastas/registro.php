<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="./css/stylesheet.css">
</head>
<body>
    <?php
        include "config.php";
        $nombre_Foro = NOMBRE_FORO;
        /*use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;*/
        require "cabecera.php"; 
    ?>
    <div id="container">
        <h1>Registro</h1>
        <?php
            $nue_user = "";
            $nom = "";
            $mail = "";
            $valido = false;
            if(isset($_POST["nuevo_usuario"])){
                $mensaje_error = posibleMensajeError($conn);
                if(strcmp($mensaje_error,"")==0 && !empty($_POST["mail"]) && !empty($_POST["nom_comp"])){
                    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $string = substr(str_shuffle($permitted_chars),0,16);
                    $valido = true;
                    crearUsuario($conn,$_POST["nuevo_usuario"],$_POST["nom_comp"],$_POST["pass"],$_POST["mail"],$string);
                }else
                    echo $mensaje_error . (empty($_POST["mail"])? "<p>El campo email no esta relleno</p>":"") . (empty($_POST["nom_comp"]) ? "<p>El campo nombre no esta relleno</p>":"");
                $nue_user = (isset($_POST["nuevo_usuario"]) && !$valido) ? $_POST["nuevo_usuario"]:"";
                $nom = (!empty($_POST["nom_comp"]) && !$valido) ? $_POST["nom_comp"]:"";
                $mail = (!empty($_POST["mail"]) && !$valido) ? $_POST["mail"]:"";
            }
        ?>
        <form action="registro.php" method="post" id="formulario">
            <span>Para registrarte en <?php echo $nombre_Foro ?>, rellena el siguiente formulario</span>
            <table>
                <tr>
                    <td><label for="nuevo_usuario">Usuario</label></td>
                    <td>
                        <input type="text" name="nuevo_usuario" id="nuevo_usuario" value="<?php echo $nue_user?>">
                    </td>
                </tr>
                <tr>
                    <td><label for="nom_comp">Nombre Completo</label></td>
                    <td>
                        <input type="text" name="nom_comp" id="nom_comp" value="<?php echo $nom;?>">
                    </td>
                </tr>
                <tr>
                    <td><label for="pass">Password</label></td>
                    <td><input type="password" name="pass" id="pass"></td>
                </tr>
                <tr>
                    <td><label for="rep_pass">Password (de nuevo)</label></td>
                    <td><input type="password" name="rep_pass" id="rep_pass"></td>
                </tr>
                <tr>
                    <td><label for="mail">Email</label></td>
                    <td>
                        <input type="email" name="mail" id="mail" value="<?php echo $mail;?>">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="insertar_usuario" value="Registrate"></td>
                </tr>
            </table>
        </form>
        <script src="js/app.js"></script>
        <?php 
            function posibleMensajeError($conn){
                if(empty($_POST["nuevo_usuario"]))
                    return "<p>El campo usuario no rellenado</p>";
                $posible_usuario = $_POST["nuevo_usuario"];
                $sql_existe_usuario = "SELECT username from usuarios";
                $resul = $conn -> query($sql_existe_usuario);
                if($conn -> errno)die($conn -> error);
                $list_usuarios = $resul -> fetch_array(MYSQLI_NUM);
                for ($i=0; $i < count($list_usuarios) ; $i++) {
                    if(strcmp($list_usuarios[$i],$_POST["nuevo_usuario"])==0){
                        return "<p>El usuario $posible_usuario ya existe</p>";   
                    }    
                }
                return "";
            }
            function crearUsuario($conn,$usuario,$nombre,$password,$mail,$string){
                $sql_CrearUsuario = "INSERT INTO `usuarios`(`username`, `nombre`, `password`, `email`, `cadenaverificacion`, `activo`, `falso`) VALUES ('$usuario','$nombre','$password','$mail','$string','0','1')";
                $resul_user = $conn -> query($sql_CrearUsuario);
                if($conn -> errno)die($conn -> error);
                enviarMensaje($string,$mail,$usuario);
            }
            function enviarMensaje($cadena_verificacion, $mail,$usuario){
                $urlCadena_ver = urlencode($cadena_verificacion);
                $urlMail = urlencode($mail);
                $enlace = "http://127.0.0.1/DEWS/UD3/Aplicación%20subastas/verificacion.php?mail=$urlMail&cadenaVer=$urlCadena_ver";
                /*
                $server_mail = new PHPMailer(true);
                $server_mail->From = "from@yourdomain.com";
                $server_mail->FromName = "Full Name";
                $server_mail->addAddress("$mail", "$usuario");
                $mail->Subject = "Verificaccion de cuenta";
                $mail->Body = "Hola $usuario, Haz clic en el siguiente enlace para registrarte:
                $enlace
                un saludo";
                try {
                    $server_mail->send();
                    echo "Message has been sent successfully";
                } catch (Exception $e) {
                    echo "Mailer Error: " . $mail->ErrorInfo;
                }
                */$mensaje = <<<MAIL
                Hola $usuario, Haz clic en el siguiente enlace para registrarte:
                $enlace
                un saludo
                MAIL;
                if(mail($mail,"Registro 127.0.0.1",$mensaje,"From:dwes.ciudadjardin@gmail.com"))
                    echo "<p>Mensaje Enviado</p>";
                else
                    echo "<p>No se pudo enviar el mensaje</p>";
            }
        ?>
    </div>
</body>
</html>