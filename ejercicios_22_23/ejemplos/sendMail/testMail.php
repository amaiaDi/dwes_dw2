<?php
// Mostrar errores PHP (Desactivar en producción)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir la libreria PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'smtp.live.com';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'dwes.icj@hotmail.com';
$mail->Password = 'Dwes_2022';
$mail->setFrom('dwes.icj@hotmail.com', 'Your Name');
$mail->addReplyTo('dwes.icj@hotmail.com', 'Your Name');
$mail->addAddress('dwes.icj@hotmail.com', 'Receiver Name');
$mail->Subject = 'Testing PHPMailer';
//$mail->msgHTML(file_get_contents('message.html'), __DIR__);
$mail->Body = 'This is a plain text message body';
//$mail->addAttachment('test.txt');
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'The email message was sent.';
}
?>