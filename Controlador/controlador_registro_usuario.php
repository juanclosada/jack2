<?php

include('conexion.php');

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$contrasena1 = $_POST['contrasena1'];
$id_rol = $_POST['rol'];

if (strlen($contrasena) < 8) {
    echo "La contraseña debe tener entre 8 y 20 caracteres. <a href='../vista/registro.php'>Registrar Nuevamente</a>";
} else {

    if ($contrasena == $contrasena1) {

        // Las contraseñas coinciden, ahora se puede hashear
        // Insertar en la base de datos
        $sql = "INSERT INTO usuarios (nombre, correo, contrasena, id_rol) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nombre, $correo, $contrasena, $id_rol);
        if ($stmt->execute()) {

            echo "Usuario registrado correctamente. <a href='../vista/login.php'>Iniciar sesión</a>";
        } else {
            echo "Error al registrar usuario: " . $conn->error;
        }
    } else {
        echo "Las contraseñas no coinciden. <a href='vista/registro.php'>Registrar Nuevamente</a>";
    }
}
