<?php
// conexion.php

// 1. Pega aquí tu "External Connection String" de Render
// Cuando subas el proyecto a Render, lo ideal es cambiar esto por: getenv("DATABASE_URL")
$db_url = 'postgresql://hokworks_user:Elo9CBDp8Q6qLEy79uY0rXw3i95chbGu@dpg-d9037claeets73dm0apg-a.oregon-postgres.render.com/hokworks';

// 2. Extraer los componentes de la URL automáticamente
$db_config = parse_url($db_url);

$host     = $db_config['host'];
$port     = isset($db_config['port']) ? $db_config['port'] : '5432'; // Por defecto Postgres usa 5432
$dbname   = ltrim($db_config['path'], '/');
$username = $db_config['user'];
$password = $db_config['pass'];

try {
    // Configurar la conexión PDO para PostgreSQL (Cambiamos mysql: por pgsql:)
    // Nota: Agregamos el puerto (;port=) ya que Render no usa el puerto estándar local en conexiones externas
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    
    $opciones = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $pdo = new PDO($dsn, $username, $password, $opciones);
    
    // Opcional: Descomenta la línea de abajo para probar localmente en tu navegador si conectó bien
    // echo "¡Conexión exitosa a PostgreSQL en Render!";

} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>