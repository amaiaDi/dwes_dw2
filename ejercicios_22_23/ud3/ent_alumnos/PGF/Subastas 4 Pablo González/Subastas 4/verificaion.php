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
<?php
 require("class.phpmailer.php"); 
        
 if (isset($_GET['usuario'])){
     echo "Has sido registrado ". $_GET['usuario'];
     echo urldecode($_GET['codigo']);
 }               

 if (isset($_GET['correo'])){    
    
         $mail = new PHPMailer();
         $mail->IsSMTP();
         $mail->SMTPAuth = true; 
         $mail->Host = "smtp.gmail.com";
         $mail->Port = 587;
         $mail->SMTPSecure = 'tls';                 
         $mail->Username = "dwes.subastas@gmail.com";                 
         $mail->Password = "dwes123456";                
         $mail->From = "dwes.subastas@gmail.com";
         $mail->FromName = "app web";              
         $mail->AddAddress("$_GET[email]");
         $mail->Subject = "Verificacion";
         $body = "Hola, este es un…";         
         // $mail->Body = $body;
          $mail->IsHTML(true);              
          
         $randomstring="";
         for($i = 0; $i < 16; $i++) {
             $randomstring .= chr(mt_rand(32,126));
         }
         $cadver=urlencode($randomstring);
         
$enlace="http://localhost/Prueba/verificacion.php?usuario=$_GET[usuario]&codigo=$cadver";              
          $body="<a href='$enlace'>Pincha para activar</a>";

          $mail->msgHTML($body);  
         if(!$mail->Send()){
             echo "No se pudo enviar el Mensaje.";
         }else{
              echo "Mensaje enviado";
         }
 }       
 
 echo "<p><a href='verificacion.php?correo'>Enviar correo</a></p>"; 
?>

</body>
</html>