<?php
session_start();
require_once 'conexion.php'; // Ajusta la ruta a tu conexión

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../phpmailer/Exception.php';
require_once __DIR__ . '/../phpmailer/PHPMailer.php';
require_once __DIR__ . '/../phpmailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location:  /forgot-3.php");
    exit;
}

$email = trim($_POST['email'] ?? '');

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['toast'] = [
        'type' => 'error',
        'title' => 'Correo inválido',
        'message' => 'Ingresa un correo electrónico válido.'
    ];
    header("Location: /loogi/forgot-3.php");
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email LIMIT 1");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user) {
        $stmt = $pdo->prepare("DELETE FROM password_resets WHERE email = :email AND used = 0");
        $stmt->execute(['email' => $email]);


        $token = bin2hex(random_bytes(32));
        $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Guardar token en BD
        $stmt = $pdo->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (:email, :token, :expires_at)");
        $stmt->execute([
            'email' => $email,
            'token' => $token,
            'expires_at' => $expires_at
        ]);

        $reset_link = "http://localhost:3000/loogi/reset-password.php?token=" . urlencode($token); // Cambia localhost por tu dominio real

        $mail = new PHPMailer(true);
        try {

            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'hokashirowalls@gmail.com';     
            $mail->Password   = 'ncsarbzdiraralzf'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->CharSet    = 'UTF-8';

            $mail->setFrom('hokashirowalls@gmail.com', 'HokWorks');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Restablecer contraseña - HokWorks';
            $mail->Body    = '
                <h3>Restablecimiento de contraseña</h3>
                <p>Haz clic en el siguiente enlace para crear una nueva contraseña:</p>
                <p><a href="' . $reset_link . '">' . $reset_link . '</a></p>
                <p>Este enlace caduca en 1 hora.</p>
                <p>Si no solicitaste este cambio, ignora este mensaje.</p>
            ';
            $mail->AltBody = "Para restablecer tu contraseña, copia y pega este enlace en tu navegador: $reset_link";

            $mail->send();
        } catch (Exception $e) {
            error_log("Error al enviar correo a $email: {$mail->ErrorInfo}");
        }
    }

    $_SESSION['toast'] = [
        'type' => 'success',
        'title' => 'Solicitud enviada',
        'message' => 'Si el correo está registrado, recibirás un enlace para restablecer tu contraseña.'
    ];
    header("Location: /loogi/forgot-3.php");
    exit;

} catch (PDOException $e) {
    $_SESSION['toast'] = [
        'type' => 'error',
        'title' => 'Error del servidor',
        'message' => 'Ocurrió un problema inesperado. Intenta más tarde.'
    ];
    header("Location: /loogi/forgot-3.php");
    exit;
}