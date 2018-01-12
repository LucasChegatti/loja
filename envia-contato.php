<?php

session_start();
$nome = $_POST["nome"];
$email = $_POST["email"];
$mensagem = $_POST["mensagem"];

require "PHPMailer.php";
require "OAuth.php";
require "SMTP.php";
require "POP3.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
$mail = new PHPMailer();

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "lucas@loginfo.com.br";
$mail->Password = "loginfo@1234";

$mail->setFrom("lucas@loginfo.com.br", "Lucas");
$mail->addAddress("lucas@loginfo.com.br");
$mail->Subject = "Email de contato da loja";
$mail->msgHTML("<html>de: {$nome}<br/>email: {$email}<br/>mensagem: {$mensagem}</html>");
$mail->AltBody = "de: {$nome}\nemail:{$email}\nmensagem: {$mensagem}";
if($mail->send()) {
    $_SESSION["success"] = "Mensagem enviada com sucesso";
    header("Location: index.php");
} else {
    $_SESSION["danger"] = "Erro ao enviar mensagem " . $mail->ErrorInfo;
    header("Location: contato.php");
}
die();