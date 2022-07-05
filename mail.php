<?php 

// Con esto ya tenemos PHPMailer
require("vendor/autoload.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

function sendMail($subject, $body, $email, $name, $html = false){

    // Configuacion inicial de nuestro servidor de correo
    $phpmailer = new PHPMailer();
    $phpmailer->isSMTP();
    $phpmailer->Host = 'smtp.gmail.com';
    $phpmailer->SMTPAuth = true;
    $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $phpmailer->Port = 465; // Puerto que tiene seguridad al enviar correo
    $phpmailer->Username = 'tusCredenciales@example.com';
    $phpmailer->Password = 'tusCredenciales';

    // Asignando destinatarios
    $phpmailer->setFrom('contact@miempresa.com', 'jSebastian'); // Quien envia
    $phpmailer->addAddress($email,$name); // Quien recibe

    // Definiendo contenido del Email
    $phpmailer->isHTML($html);        // Si es HTML los que no envian 
    $phpmailer->Subject = $subject;
    $phpmailer->Body    = $body;

    // Envio correo
    $phpmailer->send();
}