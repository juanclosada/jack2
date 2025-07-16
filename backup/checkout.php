<?php
session_start();
include '../jack2/config/config.php';
include '../jack2/Vista/Encabezado.php'; // contiene el navbar
include '../jack2/Controlador/conexion.php';

if (!isset($_SESSION['id'])) {
    header("Location: ../Inicio_sesion.php");
    exit();
}

$usuario_id = $_SESSION['id'];


// Obtener detalles del carrito
$carrito = $conn->query("
  SELECT c.*, p.nombre, p.precio 
    FROM carrito c 
    JOIN productos p ON c.producto_id = p.id_producto
    WHERE c.usuario_id = " . $usuario_id);

$total = 0;
$productos = [];

while ($item = $carrito->fetch_assoc()) {
    $item['subtotal'] = $item['precio'] * $item['cantidad'];
    $total += $item['subtotal'];
    $productos[] = $item;
}

// Guardar factura
//if ($tot  al > 0) {
//    $conn->query("INSERT INTO factura (nombre, total) VALUES ($usuario_id, $total)");
//    $conn->query("DELETE FROM carrito WHERE usuario_id = $usuario_id");
//}

?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">🧾 RESUMEN DE PAGO</h4>
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

                <div class="container mt-5">
                    <div class="card mx-auto" style="max-width: 500px;">
                        <div class="card-header bg-success text-white">
                            <h4 class="mb-0">Formulario de Pago</h4>
                        </div>
                        <div class="card-body">
                            <form action="procesar_pago.php" method="POST">

                                <!-- Método de pago -->
                                <div class="mb-3">
                                    <label for="metodo" class="form-label">Método de pago</label>
                                    <select class="form-select" id="metodo" name="metodo" required>
                                        <option value="">Seleccione una opción</option>
                                        <option value="credito">Tarjeta de Crédito</option>
                                        <option value="debito">Tarjeta Débito</option>
                                        <option value="nequi">Nequi</option>
                                    </select>
                                </div>

                                <!-- Nombre en la tarjeta -->
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre en la tarjeta</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>

                                <!-- Número de tarjeta -->
                                <div class="mb-3">
                                    <label for="numero" class="form-label">Número de tarjeta / Nequi</label>
                                    <input type="text" class="form-control" id="numero" name="numero" placeholder="Número de tarjeta o Nequi" required>
                                </div>

                                <!-- Fecha y CVV -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="expira" class="form-label">Fecha de expiración</label>
                                        <input type="text" class="form-control" id="expira" name="expira" placeholder="MM/AA">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="cvv" class="form-label">CVV</label>
                                        <input type="text" class="form-control" id="cvv" name="cvv" maxlength="4">
                                    </div>
                                </div>

                                <!-- Monto 
                                <div class="mb-3">
                                    <label for="monto" class="form-label">Monto</label>
                                    <input type="number" class="form-control" id="monto" name="monto" required>
                                </div> -->

                                <button type="submit" class="btn btn-success w-100">Pagar</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <a href="/jack2/roles/dashboardcliente.php" class="btn btn-outline-primary">🛍️ Seguir comprando</a>
                    <a href="logout.php" class="btn btn-outline-danger">Cerrar sesión</a>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">
                    Tu carrito está vacío. <a href="productos.php" class="alert-link">Ver productos</a>.
                </div>
            <?php endif; ?>
        </div>
    </div>