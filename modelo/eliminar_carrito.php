<?php
session_start();
include '../controlador/conexion.php';
if (!isset($_SESSION['usuario'])) {
    header("Location: vista/login.php");
    die();
}
$db = new Conexion();
$db->eliminarRegistro('carrito', ['id' => $_POST['carrito_id']]);
switch ($_SESSION['usuario']['id_rol']) {
    case '1':
        header("location: dashboardadmin.php");
        break;
    case '2':
        header("location: ../roles/dashboardjefe.php");
        break;
    case '3':
        header("location: ../vista/dashboardcliente.php");
        break;
    default:
        echo "Rol no definido<a href='../vista/login.php'>Ingresar Nuevamente</a>";
        break;
}
