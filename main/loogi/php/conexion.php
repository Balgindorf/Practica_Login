<?php
// .php

$host = 'localhost'; 
$dbname = 'hokworks';
$username = 'root'; 
$password = '';

try {
    // Configurar la conexión PDO
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $opciones = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, 
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       
        PDO::ATTR_EMULATE_PREPARES   => false,                 
    ];

    $pdo = new PDO($dsn, $username, $password, $opciones);

} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>