<?php

session_start();

require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        header("Location: login-3.html?error=campos_vacios");
        exit;
    }

    try {
        $sql = "SELECT id, username, password_hash FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        
        // 2. Ejecutar pasando el email
        $stmt->execute(['email' => $email]);
        
        // 3. Obtener el resultado
        $user = $stmt->fetch();


        if ($user && password_verify($password, $user['password_hash'])) {
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            
            header("Location: dashboard.php"); 
            exit;
            
        } else {

            header("Location: login-3.html?error=credenciales_invalidas");
            exit;
        }

    } catch (PDOException $e) {
        die("Error en la consulta: " . $e->getMessage());
    }
} else {
    header("Location: login-3.html");
    exit;
}
?>