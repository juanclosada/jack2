<?php
include '../controlador/conexion.php';
$db = new Conexion();
if (!empty($_POST['correo'])) {
    $usuario =  $db->consultarRegistro('SELECT * FROM usuarios WHERE correo =:email', ['email' => $_POST['correo']]);
    if ($usuario) {
        $aleatorio = random_int(100000, 999999);
        $update = $db->actualizarRegistro('usuarios', ['contrasena' => password_hash($aleatorio, PASSWORD_DEFAULT)], ['id_usuario' => $usuario['id_usuario']]);
        if (!$update) {
            header("Location: ../vista/recordarPass.php?error=2");
        }
        header("Location: ../vista/login.php?error=3");
    } else {
        header("Location: ../vista/recordarPass.php?error=2");
    }
} else {
    header("Location: ../vista/recordarPass.php?error=1");
}
