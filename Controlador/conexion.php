<?php
$host = 'localhost';
$db = 'mi_negocio';
$user = 'root';
$pass = ''; // pon tu contraseña si la tienes

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}
