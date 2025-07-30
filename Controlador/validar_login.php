<?php
session_start();
include_once('conexion.php');

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

$sql = "SELECT u.*, r.cargo FROM usuarios  u JOIN roles r  ON u.id_rol = r.id_rol WHERE correo = :correo";
$db = new Conexion();

$usuario = $db->consultarRegistro($sql, ['correo' => $correo]);
echo password_hash($contrasena, PASSWORD_DEFAULT);
if (!empty($usuario)) {
    if (password_verify($contrasena, $usuario["contrasena"])) {
        $_SESSION['usuario']['rol'] = $usuario['cargo'];
        $_SESSION['usuario']['id_rol'] = $usuario['id_rol'];
        $_SESSION['usuario']['nombre'] = $usuario['nombre'];
        $_SESSION['usuario']['id'] =  $usuario['id_usuario'];
        $_SESSION['usuario']['correo'] =  $usuario['correo'];
        switch ($usuario['id_rol']) {
            case '1':
                header("location: dashboardadmin.php");
                break;
            case '2':
                header("location: ../roles/dashboardjefe.php");
                break;
            case '3':
                header("location: ../vista/index.php");
                break;
            default:
                echo "Rol no definido<a href='../vista/login.php'>Ingresar Nuevamente</a>";
                break;
        }
    } else {
        echo "Usuario o contraseña incorrectos.<a href='../vista/login.php'>Ingresar Nuevamente</a>";
    }
} else {
    echo "El usuario no existe.<a href='../vista/login.php'>Ingresar Nuevamente</a>";
}
die();
