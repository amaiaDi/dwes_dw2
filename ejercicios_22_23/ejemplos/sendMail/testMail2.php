<?php
//error_reporting(E_ALL); //Habilitar para ver errores php
//ini_set('display_errors', 1); // Habilitar para ver errores php
//require('phpmailer/PHPMailerAutoload.php');
//require('/home/USUARIO/public_html/INCLUDE/phpmailer/PHPMailerAutoload.php'); // Si no funciona el comando arriba coloque la ruta DE PHPMAILER

require ('class.phpmailer.php');
$mail = new PHPMailer;
//$mail->SMTPDebug = 1; // Habilitar salida de Debug

$mail->IsSMTP(); // Colocar el mailer para usar SMTP
$mail->Host = 'mail.sudominio.com'; // Especificar servidor principal de backup
$mail->Port = 587; // Configurar puerto SMTP
$mail->SMTPAuth = true; // Habilitar SMTP
$mail->Username = 'dwes.icj@hotmail.com'; // Usuario SMTP
$mail->Password = 'Dwes_2022'; // Contraseña SMTP
$mail->SMTPSecure = 'tls'; // Habilitar encrypcion, 'ssl' también se acepta.

$mail->From = 'dwes.icj@hotmail.com';
$mail->FromName = 'Your From name';
$mail->AddAddress('dwes.icj@hotmail.com', 'Mark S'); // Agregue un receptor
$mail->AddAddress('dwes.icj@hotmail.com'); // Este nombre es opcional.

$mail->IsHTML(true); // Colocar formato de correo a HTML

$mail->Subject = 'Aquí colocas el Asunto';
$mail->Body = 'Este es el cuerpo del mensaje <strong>en Retenido!</strong>';
$mail->AltBody = 'Este es el cuerpo del mensaje para Clientes no-HTML';

if(!$mail->Send()) {
echo 'El Mensaje no pudo ser enviado.';
echo 'Error del Mailer: ' . $mail->ErrorInfo;
exit;
}

echo 'El Mensaje ha sido enviado';
?>