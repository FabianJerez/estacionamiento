<?php
// Configuración de la base de datos
$host = 'localhost';
$db = 'estacionamiento';
$user = 'root';
$pass = '';

// Creamos la conexión PDO
try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}
?>
