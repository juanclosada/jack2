<?php

include '../controlador/conexion.php';
$db = new Conexion();
// Obtener datos del formulario
$datos['nombre'] = mb_strtoupper($_POST['nombre']);
$datos["correo"] = $_POST['correo'];
$datos["contrasena"] = $_POST['contrasena'];
$contrasena1 = $_POST['contrasena1'];
$datos["id_rol"] = $_POST['rol'];
$user = $db->consultarRegistro('SELECT * FROM usuarios WHERE correo = :email', ['email' => $datos["correo"]]);
if (!$user) {
    if (strlen($datos["contrasena"]) < 8) {
        echo "La contraseña debe tener entre 8 y 20 caracteres. <a href='../vista/registro.php'>Registrar Nuevamente</a>";
    } else {
        if ($datos["contrasena"] == $contrasena1) {
            $datos["contrasena"] = password_hash($datos["contrasena"], PASSWORD_DEFAULT);
            $valid = $db->insertarRegistro('usuarios', $datos);
            if (!$valid) {
                echo "El usuario no se registro. <a href='../vista/admin/usuarios.php'>Registrar Nuevamente</a>";
            } else {
                echo "Usuario registrado correctamente. <a href='../vista/admin/usuarios.php'>Iniciar sesión</a>";
            }
        } else {
            echo "Las contraseñas no coinciden. <a href='../vista/admin/usuarios.php'>Volver a intentar</a>";
        }
    }
} else {
    echo "El usuario ya esta registrado. <a href='../vista/admin/usuarios.php'>Iniciar sesión</a>";
}
