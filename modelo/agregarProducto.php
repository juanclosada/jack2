<?php

session_start();
include '../controlador/conexion.php';
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../vista/login.php");
    die();
}

$db = new Conexion();
// Recibir datos del formulario (POST)
$data['nombre'] = $_POST['nombre'] ?? '';
$data['descripcion'] = $_POST['descripcion'] ?? '';
$data['precio'] = $_POST['precio'] ?? 0;
$data['stock'] = $_POST['stock'] ?? 0;
$data['URL.Imagen'] = $_POST['imagen'] ?? '';

// Validación básica
if ($nombre && $precio >= 0 && $stock >= 0) {
    $imagen_url = '';
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombreImagen = basename($_FILES['imagen']['name']);
        $rutaDestino = 'uploads/' . time() . '_' . $nombreImagen;

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
            $imagen_url = $rutaDestino;
        } else {
            die("❌ Error al mover la imagen.");
        }
    } else {
        die("❌ No se subió ninguna imagen válida.");
    }
    $db->insertarRegistro('productos', $data);
} else {
    echo "❗ Por favor, completa todos los campos correctamente.";
}
