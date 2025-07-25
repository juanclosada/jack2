<!DOCTYPE html>
<html lang="en">
<?php

include_once '../controlador/conexion.php';

include dirname(__DIR__) . '/vista/layout/head.php';
?>

<body>
    <?php
    include dirname(__DIR__) . '/vista/layout/topBar.php';
    include dirname(__DIR__) . '/vista/layout/navBar.php';
    ?>
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (empty($_SESSION['usuario']['id'])) {
        header("Location: login.php");
        exit();
    }
    $db = new Conexion();
    $db->eliminarRegistro('factura', ['usuario_id' => $_SESSION['usuario']['id'], 'estado' => 1]);
    $sql = "SELECT c.*, p.nombre, p.precio 
    FROM carrito c 
    JOIN productos p ON c.producto_id   = p.id_producto 
    WHERE c.usuario_id =:id AND c.estado = 1";
    $carrito = $db->consultarRegistros2($sql, ['id' =>  $_SESSION['usuario']['id']]);
    $total = 0;
    $productos = [];
    foreach ($carrito as $key => $item) {
        $item['total'] = $item['precio'] * $item['cantidad'];
        $item['subtotal'] = $item['precio'];
        $total +=  $item['total'];
        $productos[] = $item;
    }
    $datos = [
        'usuario_id' => $_SESSION['usuario']['id'],
        'fecha' => date('Y-m-d H:i:s'),
        'descuento' => 0,
        'IVA' => 0,
        'total' => $total,
        'estado' => 1
    ];
    $db->insertarRegistro('factura', $datos);
    $id = $db->lastInsertId();
    // Guardar detalles de la factura
    foreach ($productos as $key => $value) {
        $db->insertarRegistro('detalle_factura', [
            'usuario_id' => $_SESSION['usuario']['id'],
            'producto_id' => $value['producto_id'],
            'factura_id' =>  $id,
            'cantidad' => $value['cantidad'],
            'Precio' => $value['total'],
            'Subtotal' => $value['subtotal']
        ]);
    }


    ?>

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">🧾 Resumen de pago</h4>
            </div>
            <div class="card-body">
                <?php if (count($productos) > 0): ?>
                    <table class="table table-bordered table-striped text-dark">
                        <thead class="table-success">
                            <tr>
                                <th>Producto</th>
                                <th>Precio Unitario</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($productos as $prod): ?>
                                <tr>
                                    <td><?= htmlspecialchars($prod['nombre']) ?></td>
                                    <td>$<?= number_format($prod['precio'], 2) ?></td>
                                    <td><?= $prod['cantidad'] ?></td>
                                    <td>$<?= number_format($prod['total'], 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr class="table-secondary">
                                <td colspan="3" class="text-right"><strong>Total:</strong></td>
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
                                <form action="../modelo/procesar_pago.php" method="POST" autocomplete="on">

                                    <!-- Método de pago -->
                                    <div class="mb-3">
                                        <label for="metodo" class="form-label">Método de pago</label>
                                        <select class="form-control" id="metodo" name="metodo" required>
                                            <option value="">Seleccione una opción</option>
                                            <option value="1">Tarjeta de Crédito</option>
                                            <option value="2">Tarjeta Débito</option>
                                            <option value="3">Nequi</option>
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
                                        <input type="text" class="form-control d-none" id="id" name="id" placeholder="" required value="<?= $id ?>">
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
                        <a href="dashboardcliente.php" class="btn btn-outline-primary">🛍️ Seguir comprando</a>
                        <a href="logout.php" class="btn btn-outline-danger">Cerrar sesión</a>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning">
                        Tu carrito está vacío. <a href="cart.php" class="alert-link">Ver productos</a>.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
<?php
include dirname(__DIR__) . '/vista/layout/footer.php';
?>
<?php
include dirname(__DIR__) . '/vista/layout/script.php';
?>

</html>