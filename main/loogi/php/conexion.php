<?php
// conexion.php

// Railway inyecta estas variables automáticamente si arrastraste el servicio o añadiste las referencias
$host     = $_ENV['MYSQLHOST'] ?? 'localhost'; 
$port     = $_ENV['MYSQLPORT'] ?? '3306';
$dbname   = $_ENV['MYSQLDATABASE'] ?? 'hokworks'; // Si usas el MySQL de Railway por defecto, inyectará el nombre correcto solo
$username = $_ENV['MYSQLUSER'] ?? 'root'; 
$password = $_ENV['MYSQLPASSWORD'] ?? '';

try {
    // Configurar la conexión PDO incluyendo las variables dinámicas de entorno
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $opciones = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, 
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       
        PDO::ATTR_EMULATE_PREPARES   => false,                 
    ];

    $pdo = new PDO($dsn, $username, $password, $opciones);

} catch (PDOException $e) {
    // Te mostrará el error detallado en los logs de Railway si algo sale mal con las variables
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>