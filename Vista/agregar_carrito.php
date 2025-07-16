<?php
session_start();
include './controlador/conexion.php';
if (!isset($_SESSION['usuario']['id'])) {
    header("Location: vista/login.php");
    exit();
}

$producto_id = $_POST['producto_id'];
$cantidad = $_POST['cantidad'];
$usuario_id = $_SESSION['usuario']['id'];

$conn->query("INSERT INTO carrito (usuario_id, producto_id, cantidad) 
                  VALUES ($usuario_id, $producto_id, $cantidad)");
header("Location: cart.php");
