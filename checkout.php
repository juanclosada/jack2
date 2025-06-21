<?php
include 'Controlador/conexion.php';
session_start();
include '../jack2/Vista/Encabezado.php'; // contiene el navbar

if (!isset($_SESSION['usuario']['id'])) {
 header("Location: Inicio sesion.php");
    exit();
}

$usuario_id = $_SESSION['usuario']['id'];


// Obtener detalles del carrito
$carrito = $conn->query("
  SELECT c.*, p.nombre, p.precio 
    FROM carrito c 
    JOIN productos p ON c.producto_id = p.id_producto
    WHERE c.usuario_id = ".$usuario_id);

$total = 0;
$productos = [];

while ($item = $carrito->fetch_assoc()) {
    $item['subtotal'] = $item['precio'] * $item['cantidad'];
    $total += $item['subtotal'];
    $productos[] = $item;
}

// Guardar factura
if ($total > 0) {
    $conn->query("INSERT INTO factura (nombre, total) VALUES ($usuario_id, $total)");
    $conn->query("DELETE FROM carrito WHERE usuario_id = $usuario_id");
}

?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">🧾 Factura generada</h4>
        </div>
        <div class="card-body">
            <?php if (count($productos) > 0): ?>
                <table class="table table-bordered table-striped">
                    <thead class="table-success">
                        <tr>
                            <th>Producto</th>
                            <th>Precio Unitario</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $prod): ?>
                            <tr>
                                <td><?= htmlspecialchars($prod['nombre']) ?></td>
                                <td>$<?= number_format($prod['precio'], 2) ?></td>
                                <td><?= $prod['cantidad'] ?></td>
                                <td>$<?= number_format($prod['subtotal'], 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr class="table-secondary">
                            <td colspan="3" class="text-end"><strong>Total:</strong></td>
                            <td><strong>$<?= number_format($total, 2) ?></strong></td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-end">
                    <a href="cart.php" class="btn btn-outline-primary">🛍️ Seguir comprando</a>
                    <a href="logout.php" class="btn btn-outline-danger">Cerrar sesión</a>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">
                    Tu carrito está vacío. <a href="productos.php" class="alert-link">Ver productos</a>.
                </div>
            <?php endif; ?>
        </div>
    </div>
