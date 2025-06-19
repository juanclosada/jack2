<?php
session_start();
include('conexion.php');

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

$sql = "SELECT * FROM usuarios WHERE correo = ? AND contrasena = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $correo, $contrasena);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $usuario = $result->fetch_assoc();
    $rol = $usuario['id_rol'];
    if ($rol == 1) {
        $_SESSION['rol'] ='admin';
        header("location: ../roles/dashboardadmin.php");
    } else {
         if ($rol == 2) {
        $_SESSION['rol'] ='Jefe de bodega';
        header("location: ../roles/dashboardjefe.php");
            }   
            
        if ($rol == 4) {
        $_SESSION['rol'] ='Vendedor';
        header("location: ../roles/dashboardvendedor.php");
            }

        if ($rol == 3) {
        $_SESSION['rol'] ='cliente';
        header("location: ../roles/dashboardcliente.php");
            }
        $_SESSION['rol'] = "usuario";
        $_SESSION['usuario'] = $usuario['nombre'];
    }
        
    //  header("Location: dashboard.php");
} else {
    echo "Usuario o contraseña incorrectos.";
}
    

?>
