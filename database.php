<?php
$host = 'localhost';
$dbname = 'registros_db';
$username = 'root'; // Cambia si tu usuario es diferente
$password = 'Holasoy123.';     // Cambia si tienes una contraseña

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
?>
