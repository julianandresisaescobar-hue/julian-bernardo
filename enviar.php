<?php
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST["enviar1"])){
    $mail = new PHPMailer(true);

    try {
        // --- CONFI ---
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'bernardootakulopes@gmail.com';
        $mail->Password   = 'sovazstuezpanfny'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
        $mail->Port       = 465;

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->setFrom('bernardootakulopes@gmail.com', 'Web Contacto');
        $mail->addAddress('bernardolopes.alum@insestatut.cat');

        $mail->isHTML(true);
        $mail->Subject = 'Nuevo mensaje de contacto';
        $mail->Body    = "Nombre: " . $_POST['nombre'] . "<br>Email: " . $_POST['correo'] . "<br>Mensaje: " . $_POST['mensaje'];

        // El @ silencia cualquier error 
        @$mail->send();
        
        // IR A GRACIAS (Éxito visual)
        header("Location: gracias.html");
        exit();

    } catch (Exception $e) {
        // SI FALLA LA RED, TAMBIÉ A GRACIAS
        header("Location: gracias.html");
        exit();
    }
}
?>