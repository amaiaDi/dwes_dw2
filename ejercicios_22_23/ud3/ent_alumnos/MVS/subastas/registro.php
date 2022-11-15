<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Subastas</title>
</head>
<body>
    <div id="header"><h1>SUBASTAS DEWS</h1></div>
    <div id="menu">
        <a href="index.php">Home</a>
        <?php
            if (isset($_SESSION['user'])) {
                echo "<a href='index.php?log=1'>Logout</a>";
            }
            else {
                echo "<a href='login.php'>Login</a>";
            }
        ?>
        <a href="#">Nuevo item</a>
    </div>
    <div id="container">
        <div id="bar">
            <?php
                include __DIR__ . '\barra.php';
            ?>
        </div>
        <div id="main">
            <table>
            <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <section><b>REGISTRO</b></section>
                <p>Para registrarte en SUBASTAS DEWS, rellena el siguiente formulario</p>
                <tr class="body">
                    <td>Usuario</td>
                    <td><input type="text" name="usu"></td>
                </tr>
                <tr class="body">
                    <td>Nombre completo</td>
                    <td><input type="text" name="nom"></td>
                </tr>
                <tr class="body">
                    <td>Password</td>
                    <td><input type="password" name="pass1" id="pass1"></td>
                </tr>
                <tr class="body">
                    <td>Password (de nuevo)</td>
                    <td><input type="password" name="pass2" id="pass2"></td>
                </tr>
                <tr class="body">
                    <td>Email</td>
                    <td><input type="text" name="email"></td>
                </tr>
                <tr class="body">
                    <td></td>
                    <td><input type="submit" value="Registrar" name="registrar" id="registrar" onclick="registrar()"></td>
                </tr>
            </form>
            </table>
        </div>
        <?php
            if (isset($_POST['registrar']) && !empty($_POST['usu']) && !empty($_POST['nom']) && !empty($_POST['email'])) {
                $usu=$_POST['usu'];
                $mysqli = new mysqli("localhost", "marcos", "dw2", "subastas");
                $sql="SELECT * FROM usuarios";
                $resultado=$mysqli->query($sql);
                $cont=0;
                $esta=false;
                while($dato = $resultado->fetch_assoc())   {
                    if ($dato['username']==$usu) {
                        $esta=true;
                    }
                    if ($cont<$dato['id']) {
                        $cont=$dato['id'];
                    }
                }
                if ($esta==true) {
                    echo "<p>El usuario $usu ya existe</p>";
                }
                else {
                    $cont++;
                    $nom=$_POST['nom'];
                    $pass=$_POST['pass1'];
                    $email=$_POST['email'];
                    $cadena=substr(md5(time()), 0, 16);
                    $sql="INSERT INTO usuarios VALUES
                    ('$cont', '$usu', '$nom', '$pass', '$email', '$cadena', 0, 0)";
                    if ($mysqli->query($sql) === TRUE) {
                        echo "OK user registrado";
                        require("class.phpmailer.php"); 
        
                        if (isset($_GET['usuario'])){
                            echo "Has sido registrado ". $_GET['usuario'];
                            echo urldecode($_GET['cadver']);
                        }               
           
                        $mail = new PHPMailer();
                        $mail->IsSMTP();
                        $mail->SMTPAuth = true; 
                        $mail->Host = "smtp.gmail.com";
                        $mail->Port = 587;
                        $mail->SMTPSecure = 'tls';                 
                        $mail->Username = "dwes.ciudadjardin@gmail.com";                 
                        $mail->Password = "dwes123456";                
                        $mail->From = "dwes.ciudadjardin@gmail.com";
                        $mail->FromName = "app web";              
                        $mail->AddAddress("nerea.ciudadjardin@gmail.com","Nerea");
                        $mail->Subject = "Probando envio";

                        $mail->IsHTML(true);              
                        
                        $enlace="http://localhost/dwes/ud1/subastas/verificacion.php?email=$email&cadena=$cadena";              
                        $body="<a href='$enlace'>Pincha para activar</a>";

                        $mail->msgHTML($body);  
                        if(!$mail->Send()){
                            echo "No se pudo enviar el Mensaje.";
                        }
                        else{
                            echo "Mensaje enviado";
                        }
                        
                    }
                    else {
                        echo "Error: " . $sql . "<br>" . $mysqli->error;
                    }
                }
                $mysqli->close();
            }
        ?>
    </div>
    
    <script>
        function registrar(){
            var pass1 = document.getElementById('pass1').value;
            var pass2 = document.getElementById('pass2').value;
            if (pass1!=pass2) {
                alert('Las contraseñas no coinciden');
            }
            
        }
    </script>

</body>
</html>