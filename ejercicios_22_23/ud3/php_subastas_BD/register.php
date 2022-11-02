<?php
require("header.php");

if (isset($_GET['error'])){
    echo "ERROR!!!!!!!!!!!!!!!!";
    switch($_GET['error']) {
        case "pass":
            echo "Passwords no coinciden!!";            break;
        case "taken":
            echo "Nombre de usuario ya adjudicado, elija otro.";       break;
        case "no":
            echo "Detalles de login incorrectos";        break;
    }
}
if(isset($_POST['submit'])) {

    if($_POST['password1'] == $_POST['password2']) {
        $checksql = "SELECT * FROM usuarios WHERE username = '" . $_POST['username'] . "';";
        $checkresult = mysqli_query($checksql);
        $checknumrows = mysqli_num_rows($checkresult);
        if($checknumrows == 1) {
            header("Location: " . $config_basedir ."register.php?error=taken");
        }
        else { //Contraseñas bien puestas y la contraseña no esta cogida
            //Generar cadena aleatoria de verificación
            //Insertar usuario nueva en la tabla y enviarle email
            $randomstring="";
            for($i = 0; $i < 16; $i++) {
                $randomstring .= chr(mt_rand(32,126));
            }
           //Con localhost no lo reconoce como enlace
            $verifyurl="http://127.0.0.1/BD_php_subastas/verify.php";  
            $verifystring = urlencode($randomstring);
            $verifyemail = urlencode($_POST['email']);
            $validusername = $_POST['username'];
            $sql = "INSERT INTO usuarios(username, password, email, cadenaverificacion,activo)
         VALUES('". $_POST['username']. "', '" . $_POST['password1']. "', '" . $_POST['email']
                    . "', '" . addslashes($randomstring). "', 0)";
            mysqli_query($sql);         
            $mail_body=<<<MAIL
                    Hola $validusername- Haz click en el siguiente link
                    para verificar tu nueva cuenta:
                    $verifyurl?email=$verifyemail&verify=$verifystring
MAIL;
            $from="From: cualquiercosa";
            if (mail($_POST['email'], $config_forumsname . " Verif. usuario", $mail_body,$from))
                echo "Se ha enviado un enlace a tu email. Pinchalo para activar tu cuenta";
            else
                echo "No se ha enviado el mensaje";
        }
    }
    else {
        header("Location: " . $config_basedir ."register.php?error=pass");
    }
}
?>




<h2>REGISTRO</h2>
Para registrar en  <?php echo $config_forumsname; ?> , rellena el siguiente formulario
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <table>
        <tr>
            <td>Usuario</td>
            <td><input type="text" name="username"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password1"></td>
        </tr>
        <tr>
            <td>Password (de nuevo)</td>
            <td><input type="password" name="password2"></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Registrate"></td>
        </tr>
    </table>
</form>
