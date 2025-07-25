<?php
session_start();
include '../config/config.php';
include '../controlador/conexion.php';

if (!isset($_SESSION['usuario']['id'])) {
    header("Location: ../vista/login.php");
    exit();
}
$db = new Conexion();
$factura = $db->consultarRegistro("SELECT * FROM factura WHERE id = :id", ['id' => $_POST['id']]);
$iva = $factura['total'] * 0.19;
$query = $db->actualizarRegistro('factura', [
    'forma_pago' => $_POST['metodo'],
    'numero_tarjeta' => $_POST['numero'],
    'fecha_expedicion' => $_POST['expira'],
    'cvv' => $_POST['cvv'],
    'fecha_pago' => date('Y-m-d H:i:s'),
    'estado' => 2,
    'IVA' => $iva,
], ['id' => $factura['id']]);
$db->actualizarRegistro('carrito', ['estado' => 2], ['usuario_id' => $_SESSION['usuario']['id'], 'estado' => 1]);
//
if ($query) {
    header("location: ../vista/ReporteFactura.php?factura_id=" . base64_encode($factura['id']));
} else {
    echo "Error al crear la factura.";
    die();
}
