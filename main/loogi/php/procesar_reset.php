<?php
session_start();
require_once 'conexion.php'; // Ajusta según tu estructura

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: /loogi/forgot-3.php");
    exit;
}

$token = trim($_POST['token'] ?? '');
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

if (empty($token) || empty($password) || empty($confirm_password)) {
    $_SESSION['toast'] = [
        'type' => 'error',
        'title' => 'Campos vacíos',
        'message' => 'Completa todos los campos.'
    ];
    header("Location: /loogi/reset-password.php?token=" . urlencode($token));
    exit;
}

if ($password !== $confirm_password) {
    $_SESSION['toast'] = [
        'type' => 'error',
        'title' => 'Contraseñas no coinciden',
        'message' => 'Las dos contraseñas ingresadas no son iguales.'
    ];
    header("Location: /loogi/reset-password.php?token=" . urlencode($token));
    exit;
}

if (strlen($password) < 6) {
    $_SESSION['toast'] = [
        'type' => 'error',
        'title' => 'Contraseña débil',
        'message' => 'La contraseña debe tener al menos 6 caracteres.'
    ];
    header("Location: /loogi/reset-password.php?token=" . urlencode($token));
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT email, expires_at, used FROM password_resets WHERE token = :token LIMIT 1");
    $stmt->execute(['token' => $token]);
    $reset = $stmt->fetch();

    if (!$reset) {
        $_SESSION['toast'] = [
            'type' => 'error',
            'title' => 'Token inválido',
            'message' => 'El enlace de restablecimiento no es válido.'
        ];
        header("Location: /loogi/forgot-3.php");
        exit;
    }

    if ($reset['used'] == 1) {
        $_SESSION['toast'] = [
            'type' => 'error',
            'title' => 'Token ya usado',
            'message' => 'Este enlace ya ha sido utilizado.'
        ];
        header("Location: /loogi/forgot-3.php");
        exit;
    }

    if (strtotime($reset['expires_at']) < time()) {
        $_SESSION['toast'] = [
            'type' => 'error',
            'title' => 'Token expirado',
            'message' => 'El enlace ha caducado. Solicita uno nuevo.'
        ];
        header("Location: /loogi/forgot-3.php");
        exit;
    }

    // Actualizar contraseña del usuario
    $email = $reset['email'];
    $hash = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $pdo->prepare("UPDATE users SET password_hash = :password_hash WHERE email = :email");
    $stmt->execute(['password_hash' => $hash, 'email' => $email]);

    // Marcar token como usado
    $stmt = $pdo->prepare("UPDATE password_resets SET used = 1 WHERE token = :token");
    $stmt->execute(['token' => $token]);

    // Éxito: redirigir al login con toast de éxito
    $_SESSION['toast'] = [
        'type' => 'success',
        'title' => 'Contraseña actualizada',
        'message' => 'Tu contraseña se ha cambiado correctamente. Inicia sesión con tu nueva clave.'
    ];
    header("Location: /loogi/login-3.php");
    exit;

} catch (PDOException $e) {
    $_SESSION['toast'] = [
        'type' => 'error',
        'title' => 'Error del servidor',
        'message' => 'Ocurrió un problema al actualizar la contraseña.'
    ];
    header("Location: /loogi/reset-password.php?token=" . urlencode($token));
    exit;
}