<!DOCTYPE html>
<html lang="en">
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['usuario']['id'])) {
    header("Location: login.php?error=1");
    exit();
}
include_once dirname(__DIR__) . '/vista/layout/head.php';
$body = 6;
?>

<body>
    <?php
    include_once '../controlador/conexion.php';
    $db = new Conexion();
    $facturas = [];
    if (!empty($_SESSION['usuario']['id'])) {
        $facturas = $db->consultarRegistros2('SELECT * FROM factura WHERE estado = 2 AND usuario_id  = :id', ['id' => $_SESSION['usuario']['id']]);
    } else {
        echo "<h5>Sin registros<h5>";
        die();
    }
    // mostrar($facturas);
    ?>

    <body>

        <?php
        include_once dirname(__DIR__) . '/vista/layout/topBar.php';
        include_once dirname(__DIR__) . '/vista/layout/navBar.php'; ?>



        <!-- Shop Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-dark">
                        <thead class="table-success">
                            <tr>
                                <th>Fecha</th>
                                <th>Forma de pago</th>
                                <th class="text-center">Descuento</th>
                                <th>IVA</th>
                                <th>Total</th>
                                <th>Ver detalle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($facturas as $fac): ?>
                                <tr>
                                    <td><?= htmlspecialchars($fac['fecha_pago']) ?></td>
                                    <td><?= formaPago($fac['forma_pago']) ?></td>
                                    <td>$<?= number_format($fac['descuento'], 2) ?></td>
                                    <td>$<?= number_format($fac['IVA'], 2) ?></td>
                                    <td>$<?= number_format($fac['total'], 2) ?></td>
                                    <td>
                                        <a href="ReporteFactura.php?factura_id=<?php echo base64_encode($fac['id']); ?>" type='submit' class='btn btn-warning btn-sm'><i class="fa fa-file-pdf-o"></i> Ver factura</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Shop End -->


        <?php
        include 'layout/footer.php';
        ?>
    </body>
    <?php
    include 'layout/script.php';
    ?>

</html>