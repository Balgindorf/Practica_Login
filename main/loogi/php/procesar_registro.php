<?php
session_start();
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: register-3.php");
    exit;
}

$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';
$terms = $_POST['terms'] ?? '';

// Función para redirigir con toast de error
function setErrorToast($title, $message) {
    $_SESSION['toast'] = [
        'type' => 'error',
        'title' => $title,
        'message' => $message
    ];
    header("Location: /register-3.php");
    exit;
}

// Validaciones
if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
    setErrorToast('Campos vacíos', 'Por favor completa todos los campos obligatorios.');
}
if ($terms !== '1') {
    setErrorToast('Términos y privacidad', 'Debes aceptar los términos y la política de privacidad.');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    setErrorToast('Correo inválido', 'El formato del correo electrónico no es válido.');
}
if ($password !== $confirm_password) {
    setErrorToast('Contraseñas no coinciden', 'Las dos contraseñas ingresadas no son iguales.');
}

// Verificar duplicados en BD
try {
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username LIMIT 1");
    $stmt->execute(['username' => $username]);
    if ($stmt->fetch()) {
        setErrorToast('Usuario no disponible', 'El nombre de usuario ya está en uso. Elige otro.');
    }

    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email LIMIT 1");
    $stmt->execute(['email' => $email]);
    if ($stmt->fetch()) {
        setErrorToast('Correo ya registrado', 'Ya existe una cuenta con ese correo electrónico.');
    }

    // Si todo es válido, registrar
    $hash = password_hash($password, PASSWORD_BCRYPT);
    $sql = "INSERT INTO users (username, email, password_hash) VALUES (:username, :email, :password_hash)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'username' => $username,
        'email' => $email,
        'password_hash' => $hash
    ]);

    // Éxito: redirigir al login con toast de éxito
    $_SESSION['toast'] = [
        'type' => 'success',
        'title' => '¡Registro exitoso!',
        'message' => 'Tu cuenta ha sido creada. Ahora puedes iniciar sesión.'
    ];
    header("Location: /loogi/login-3.php");
    exit;

} catch (PDOException $e) {
    setErrorToast('Error del servidor', 'Ocurrió un problema inesperado. Intenta más tarde.');
}