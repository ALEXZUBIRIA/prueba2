<?php
$host = getenv('DB_HOST'); // Lee el valor de la variable de entorno 'DB_HOST'
$dbname = getenv('DB_NAME'); // Lee el valor de la variable de entorno 'DB_NAME'
$username = getenv('DB_USER'); // Lee el valor de la variable de entorno 'DB_USER'
$password = getenv('DB_PASSWORD'); // Lee el valor de la variable de entorno 'DB_PASSWORD'

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
?>
