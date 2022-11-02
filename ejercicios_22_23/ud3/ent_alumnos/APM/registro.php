<?php require "cabecera.php" ?>
<h2>REGISTRO</h2>
<p>Para registrarte en <?=$nombreforo?>, rellena el siguiente formulario</p>
<form method="post">
    <table id="formauth">
        <tr>
            <td>Usuario -</td>
            <td><input type="text" name="user" id="user"></td>
        </tr>
        <tr>
            <td>Nombre completo -</td>
            <td><input type="text" name="nom" id="nom"></td>
        </tr>
        <tr>
            <td>Password -</td>
            <td><input type="password" name="pass1" id="pass1"></td>
        </tr>
        <tr>
            <td>Repite Password -</td>
            <td><input type="password" name="pass2" id="pass2"></td>
        </tr>
        <tr>
            <td>Email -</td>
            <td><input type="email" name="email" id="email"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Registrarme" name="submit"></td>
        </tr>
        <?php if(isset($_GET['reg'])) {
            if ($_GET['reg']==1) {
                echo "<tr><td colspan='2'>Ya estas registrado prueba a <a href='login.php'>logear</a>.</td></tr>";
            } else if ($_GET['reg']==2) {
                echo "<tr><td colspan='2'>Esta cuenta no esta verificada, Te hemos enviado un correo de verificacion.</td></tr>";
            }
        } ?>
    </table>
</form>
<?php 
    //use PHPMailer\PHPMailer\PHPMailer;
    //use PHPMailer\PHPMailer\Exception;

    if (isset($_POST['submit'])) {
        $user = $_POST['user'];
        $nom = $_POST['nom'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
        $email = $_POST['email'];
        if ($pass1 == $pass2) {
            $sql = "SELECT * from usuarios where username like '$user'";  
            $resultado = $conn->query($sql);  
            if($conn->errno) die($conn->error);
            $fila = $resultado -> fetch_assoc();
            if (isset($fila['id'])) {
                if ($fila['activo']==0) header("Location: registro.php?reg=2");
                if ($fila['activo']==1) header("Location: registro.php?reg=1");
                return;
            }
            $cadena = generarCadenaRad(16);
            $sql = "INSERT INTO `usuarios`(`username`, `nombre`, `password`, `email`, `cadenaverificacion`, `activo`, `falso`) VALUES ('$user','$nom','$pass1','$email','$cadena','0','0')";
            $resultado = $conn->query($sql);  
            if($conn->errno) die($conn->error);
            echo "<p>Usuario creado con exito. ";
            enviarMail($email,$cadena);
            echo "</p>";
        }
    }

    function enviarMail($email,$cadena) {
        //require 'mail/Exception.php';
        //require 'mail/PHPMailer.php';
        //require 'mail/SMTP.php';

        $enlace = "http://$_SERVER[HTTP_HOST]/subastas/verificacion.php?email=$email&cadena=$cadena";

        echo "Verificate aqui <a href='$enlace'>AQUI</a>";
        
        /* $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'anderciudadj@gmail.com';                     //SMTP username
            $mail->Password   = 'contra';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('anderciudadj@gmail.com', 'Remitente');
            $mail->addAddress($email);     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Verificacion '.$nombreforo;
            $mail->Body    = "Verificate aqui <a href='$enlace'>AQUI</a>";

            $mail->send();
        } catch (Exception $e) {

        } */
    }
?>
<?php require "pie.php"; ?>