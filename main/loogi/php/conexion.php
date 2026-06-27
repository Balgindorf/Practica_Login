<?php
// conexion.php

// Pega aquí temporalmente tu External Connection String completa de Render
$host     = 'dpg-d9037claeets73dm0apg-a.oregon-postgres.render.com';
$port     = '5432';
$dbname   = 'hokworks';
$username = 'hokworks_user';
$password = 'Elo9CBDp8Q6qLEY79uY0rXw3i95chbGu'; // Recuerda cambiarla en Render al terminar tu proyecto por seguridad

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $opciones = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $pdo = new PDO($dsn, $username, $password, $opciones);
    // echo "¡Conexión exitosa desde mi PC local!";
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>