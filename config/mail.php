<?php

require __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function envoyerEmail($destinataire, $nom, $sujet, $message)
{
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'yayad3972@gmail.com';
        $mail->Password = str_replace(' ', '', 'nxuk gopkgzaw urda');
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8';
        $mail->SMTPAutoTLS = true;
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ],
        ];

        $mail->setFrom('yayad3972@gmail.com', 'Gestions Étudiants');
        $mail->addAddress($destinataire, $nom);
        $mail->addReplyTo('yayad3972@gmail.com', 'Gestions Étudiants');

        $mail->isHTML(true);
        $mail->Subject = $sujet;
        $mail->Body = $message;

        return $mail->send();
    } catch (Exception $e) {
        return 'Erreur SMTP : ' . $mail->ErrorInfo . ' - ' . $e->getMessage();
    }
}
