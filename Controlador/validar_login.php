<head>
    <link href="../vista/css/style.css" rel="stylesheet">
</head>
<?php
session_start();
include_once('conexion.php');

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

$sql = "SELECT u.*, r.cargo FROM usuarios  u JOIN roles r  ON u.id_rol = r.id_rol WHERE correo = :correo";
$db = new Conexion();

$usuario = $db->consultarRegistro($sql, ['correo' => $correo]);
if (!empty($usuario)) {
    if (password_verify($contrasena, $usuario["contrasena"])) {
        $_SESSION['usuario']['rol'] = $usuario['cargo'];
        $_SESSION['usuario']['id_rol'] = $usuario['id_rol'];
        $_SESSION['usuario']['nombre'] = $usuario['nombre'];
        $_SESSION['usuario']['id'] =  $usuario['id_usuario'];
        $_SESSION['usuario']['correo'] =  $usuario['correo'];
        switch ($usuario['id_rol']) {
            case '1':
                header("location: ../vista/admin/dashboardadmin.php");
                break;
            case '3':
                header("location: ../vista/index.php");
                break;
            default:
                echo '
    <div class="text-center" style="margin: 50px auto; max-width: 500px;">
        <div class="alert alert-danger text-center" role="alert">
            Rol no definido.<br>
            </div>
            <a href="../vista/login.php" class="btn btn-sm btn-primary mt-3">Ingresar Nuevamente</a>
    </div>
';
                break;
        }
    } else {
        echo '
    <div class="text-center" style="margin: 50px auto; max-width: 500px;">
        <div class="alert alert-danger text-center" role="alert">
            Usuario o contraseña incorrectos.<br>
            </div>
            <a href="../vista/login.php" class="btn btn-sm btn-primary mt-3">Ingresar Nuevamente</a>
    </div>
';
    }
} else {
    echo '
    <div class="text-center" style="margin: 50px auto; max-width: 500px;">
        <div class="alert alert-danger text-center" role="alert">
            El usuario no existe..<br>
            </div>
            <a href="../vista/login.php" class="btn btn-sm btn-primary mt-3">Ingresar Nuevamente</a>
    </div>
';
}
die();
