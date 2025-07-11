<?php
session_start();
require_once '../config/config.php';
include  ENCABEZADO;
include '../Controlador/conexion.php';
$resultado = $conn->query("SELECT * FROM productos");
$consulta = " SELECT c.*, p.nombre, p.precio 
    FROM carrito c 
    JOIN productos p ON c.producto_id   = p.id_producto 
    WHERE c.usuario_id ="  . $_SESSION['id'];
$carrito = $conn->query($consulta);
?>

<div class="container mt-4">
    <div class="row">
        <!-- Productos -->
        <div class="col-md-8">
            <div class="row">
                <?php while ($row = $resultado->fetch_assoc()) { ?>
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <img src="<?= $row['URL.Imagen'] ?>" class="card-img-top" style="width: 100%; height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><?= $row['nombre'] ?></h5>
                                <p><?= $row['descripcion'] ?></p>
                                <p><strong>$<?= $row['precio'] ?></strong></p>
                                <form action="./Clientes/agregar_carrito.php" method="post">
                                    <input type="hidden" name="producto_id" value="<?= $row['id_producto'] ?>">
                                    <input type="number" name="cantidad" value="1" min="1" class="form-control mb-2">
                                    <button type="submit" class="btn btn-primary">Agregar al carrito</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <!-- Carrito -->
        <div class="col-md-4">
            <h3>🛒 Tu carrito</h3>
            <?php
            $total = 0;
            if ($carrito->num_rows > 0) {
                echo "<ul class='list-group mb-3'>";
                while ($item = $carrito->fetch_assoc()) {
                    $subtotal = $item['precio'] * $item['cantidad'];
                    $total += $subtotal;
                    echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                    echo "<div>";
                    echo $item['nombre'] . " x " . $item['cantidad'];
                    echo "</div>";
                    echo "<div class='d-flex align-items-center'>";
                    echo "<span class='me-3'>$" . number_format($subtotal, 2) . "</span>";
                    echo "<form action='eliminar_del_carrito.php' method='post' class='m-0'>";
                    echo "<input type='hidden' name='carrito_id' value='" . $item['id'] . "'>";
                    echo "<button type='submit' class='btn btn-danger btn-sm'>🗑️</button>";
                    echo "</form>";
                    echo "</div>";
                    echo "</li>";
                }
                echo "</ul>";
                echo "<p><strong>Total: $" . number_format($total, 2) . "</strong></p>";
                echo "<a href='../checkout.php' class='btn btn-success'>Pagar</a>";
                echo "<form action='vaciar_carrito.php' method='post' class='mt-2'>";
                echo "<button type='submit' class='btn btn-warning'>Vaciar carrito 🗑️</button>";
                echo "</form>";
            } else {
                echo "<p>Tu carrito está vacío.</p>";
            }
            ?>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="card mb-4">Gracias por su compra</div>
    <div class="row">

        <?php while ($row = $resultado->fetch_assoc()) { ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="<?= $row['URL.Imagen'] ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row['nombre'] ?></h5>
                        <p><?= $row['descripcion'] ?></p>
                        <p><strong>$<?= $row['precio'] ?></strong></p>
                        <form action="../Clientes/agregar_carrito.php" method="post">
                            <input type="hidden" name="producto_id" value="<?= $row['id_producto'] ?>">
                            <input type="number" name="cantidad" value="1" min="1" class="form-control mb-2">
                            <button type="submit" class="btn btn-primary">Agregar al carrito</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

</div>



<?php
// include 'conexion.php';
include '../Vista/Piepagina.php'; // contiene el navbar
?>