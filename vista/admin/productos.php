<!DOCTYPE html>
<html lang="en">
<?php
date_default_timezone_set('America/Bogota');
include dirname(__DIR__) . '/admin/layout/head.php';
include_once('../../controlador/conexion.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// $formatter = new IntlDateFormatter(
//     'es_CO', // idioma local
//     IntlDateFormatter::FULL, // fecha completa (ej: miércoles, 30 de julio de 2025)
//     IntlDateFormatter::SHORT, // hora corta (ej: 9:38 p. m.)
//     'America/Bogota',
//     IntlDateFormatter::GREGORIAN
// );
$produc = 'active';
$home = $user = $fac = $com = '';
if (empty($_SESSION['usuario']['id_rol']) || $_SESSION['usuario']['id_rol'] != 1) {
    header("location: ../../vista/login.php");
}
$db = new Conexion('N');
$productos = $db->consultarRegistros2('SELECT * FROM productoS WHERE 1=1');
// mostrar($productos);
?>

<body>
    <?php
    include dirname(__DIR__) . '/admin/layout/topBar.php';
    include dirname(__DIR__) . '/admin/layout/navBar.php';
    ?>
    <!-- start section -->
    <div class="container">
        <h4>Productos</h4>
        <p><?php
            //echo $formatter->format(new DateTime()) 
            ?></p>
        <button class="btn btn-primary float-right mb-3" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-plus"></i> Agregar producto</button>
        <div class="table-responsive mt-3">
            <?php
            if (!empty($productos)) { ?>
                <table id="productos" class="table table-light table-borderless table-hover text-center mb-0 ">
                    <thead class="thead-dark">
                        <tr>
                            <th>Sec</th>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php
                        foreach ($productos as $key => $value) { ?>
                            <tr>
                                <td class="align-middle"><?php echo $key + 1; ?></td>
                                <td class="align-middle"><img src="../<?php echo $value['URL.Imagen'] ?>" alt="" style="width: 50px;"> <?php echo $value['nombre'] ?> </td>
                                <td class="align-middle"><?php echo $value['nombre']; ?></td>
                                <td class="align-middle"><?php echo $value['descripcion']; ?></td>
                                <td class="align-middle">$<?php echo number_format($value['precio']); ?></td>
                                <td class="align-middle"><?php echo $value['stock']; ?></td>
                                <td class="align-middle">
                                    <form action='../modelo/eliminar_carrito.php' method='post' class='m-0'>
                                        <input type='hidden' name='carrito_id' value="<?php echo $value['id_producto']; ?>">
                                        <button type='submit' class='btn btn-danger btn-sm'>🗑️</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php
            } else {
                echo "<h5>Sin productos seleccionados.</h5>";
                echo "<a href='shop.php' class='btn btn-warning'>Comprar productos</a>";
            }
            ?>
        </div>
    </div>
    <!-- end section -->

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" action="../../modelo/agregarProducto.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Agregar producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nombre">Nombre del producto</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Ingresa el nombre" required>
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" id="descripcion" rows="3" placeholder="Describe el producto" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="number" class="form-control" id="precio" placeholder="Ej: 199.99" step="0.01" min="0" required>
                        </div>

                        <div class="form-group">
                            <label for="stock">Stock disponible</label>
                            <input type="number" class="form-control" id="stock" placeholder="Ej: 10" min="0" required>
                        </div>

                        <div class="form-group">
                            <label for="imagen">URL de la imagen</label>
                            <input type="file" class="form-control" accept="image/*" id="imagen" placeholder="https://ejemplo.com/imagen.jpg" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerra</button>
                        <button type="submit" class="btn btn-primary">Guardar producto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<?php
include dirname(__DIR__) . '/admin/layout/footer.php';
?>

</html>
<?php
include dirname(__DIR__) . '/admin/layout/script.php';
?>
<script>
    $('#productos').DataTable({
        language: {
            url: './language.json'
        }
    });
</script>