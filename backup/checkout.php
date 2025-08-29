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
?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">🧾 RESUMEN DE PAGO</h4>
        </div>
        <div class="card-body">
            <?php if (count($productos) > 0): ?>
                <!-- TABLA RESPONSIVA -->
                <div class="table-responsive">
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
                </div>

                <!-- FORMULARIO RESPONSIVO -->
                <div class="container-fluid px-2 mt-5">
                    <div class="card shadow-sm mx-auto" style="max-width: 100%;">
                        <div class="card-header bg-success text-white">
                            <h4 class="mb-0">Formulario de Pago</h4>
                        </div>
                        <div class="card-body">
                            <form action="procesar_pago.php" method="POST">

                                <div class="mb-3">
                                    <label for="metodo" class="form-label">Método de pago</label>
                                    <select class="form-select" id="metodo" name="metodo" required>
                                        <option value="">Seleccione una opción</option>
                                        <option value="credito">Tarjeta de Crédito</option>
                                        <option value="debito">Tarjeta Débito</option>
                                        <option value="nequi">Nequi</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre en la tarjeta</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required autocomplete="name">
                                </div>

                                <div class="mb-3">
                                    <label for="numero" class="form-label">Número de tarjeta / Nequi</label>
                                    <input type="text" class="form-control" id="numero" name="numero" placeholder="Número de tarjeta o Nequi" required autocomplete="cc-number">
                                </div>

                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label for="expira" class="form-label">Fecha de expiración</label>
                                        <input type="text" class="form-control" id="expira" name="expira" placeholder="MM/AA" autocomplete="cc-exp">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="cvv" class="form-label">CVV</label>
                                        <input type="text" class="form-control" id="cvv" name="cvv" maxlength="4" autocomplete="cc-csc">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success w-100">Pagar</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- BOTONES FINALES -->
                <div class="text-end mt-4">
                    <a href="/jack2/roles/dashboardcliente.php" class="btn btn-outline-primary me-2">🛍️ Seguir comprando</a>
                    <a href="logout.php" class="btn btn-outline-danger">Cerrar sesión</a>
                </div>
            <?php else: ?>
                <div class="alert alert-warning mt-3">
                    Tu carrito está vacío. <a href="productos.php" class="alert-link">Ver productos</a>.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
