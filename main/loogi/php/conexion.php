<?php
// Versión final de conexion.php lista para Render y Local

// Render genera una variable llamada DATABASE_URL automáticamente
$database_url = getenv('DATABASE_URL');

if ($database_url) {
    // Si detecta la variable de Render (Producción)
    $db_config = parse_url($database_url);
    $host     = $db_config['host'];
    $port     = isset($db_config['port']) ? $db_config['port'] : '5432';
    $dbname   = ltrim($db_config['path'], '/');
    $username = $db_config['user'];
    $password = $db_config['pass'];
} else {
    // Si no existe, estás en tu computadora (Local)
    $host     = 'dpg-d9037claeets73dm0apg-a.oregon-postgres.render.com';
    $port     = '5432';
    $dbname   = 'hokworks';
    $username = 'hokworks_user';
    $password = 'Elo9CBDp8Q6qLEY79uY0rXw3i95chbGu';
}

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}