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
$user = 'active';
$home = $produc = $fac = $com = '';
if (empty($_SESSION['usuario']['id_rol']) || $_SESSION['usuario']['id_rol'] != 1) {
    header("location: ../../vista/login.php");
}
$db = new Conexion('N');
$usuarios = $db->consultarRegistros2('SELECT u.*, r.cargo FROM usuarios u LEFT JOIN roles r ON u.id_rol = r.id_rol WHERE 1=1 ORDER BY id_usuario DESC');
// mostrar($usuarios);
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
        <button class="btn btn-primary float-right mb-3" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-plus"></i> Agregar usuario</button>
        <div class="table-responsive mt-3">
            <?php
            if (!empty($usuarios)) { ?>
                <table id="usuarios" class="table table-light table-borderless table-hover text-center mb-0 ">
                    <thead class="thead-dark">
                        <tr>
                            <th>Sec</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Cargo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php
                        foreach ($usuarios as $key => $value) { ?>
                            <tr>
                                <td class="align-middle"><?php echo $key + 1; ?></td>
                                <td class="align-middle"><?php echo $value['nombre'] ?> </td>
                                <td class="align-middle"><?php echo $value['correo']; ?></td>
                                <td class="align-middle"><?php echo $value['cargo'] ?></td>
                                <td class="align-middle">
                                    <input type='hidden' name='carrito_id' value="<?php echo $value['id_usuario']; ?>">
                                    <button type='button' class='btn btn-warning btn-sm' data-toggle="modal"
                                        data-target="#editarProductoModal"
                                        data-id="<?php echo $value['id_usuario']; ?>"
                                        data-nombre="<?php echo htmlspecialchars($value['nombre'], ENT_QUOTES); ?>"
                                        data-descripcion="<?php echo htmlspecialchars($value['correo'], ENT_QUOTES); ?>"
                                        data-precio="<?php echo $value['id_rol']; ?>"
                                        onclick="cargarDatosEditar(this)"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php
            } else {
                echo "<h5>Sin usuarios seleccionados.</h5>";
                echo "<a href='shop.php' class='btn btn-warning'>Comprar productos</a>";
            }
            ?>
        </div>
    </div>
    <!-- end section -->

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" action="../../modelo/agregarUsuario.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Agregar usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" name="nombre" placeholder="Ingresa el nombre" required>
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Correo</label>
                            <input type="email" class="form-control" name="correo " placeholder="Ingresa el correo " required></input>
                        </div>

                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="number" class="form-control" id="precio" name="precio" placeholder="Ej: 199.99" step="0.01" min="1" required>
                        </div>

                        <div class="form-group">
                            <label for="stock">Tipo de usuario</label>
                            <select name="id_rol" id="id_rol" value="">
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editarProductoModal" tabindex="-1" role="dialog" aria-labelledby="editarProductoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="../../modelo/actualizarProducto.php" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-id">

                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="edit-nombre" required>
                        </div>

                        <div class="form-group">
                            <label>Descripción</label>
                            <textarea class="form-control" name="descripcion" id="edit-descripcion" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Precio</label>
                            <input type="number" class="form-control" name="precio" id="edit-precio" step="0.01" required>
                        </div>

                        <div class="form-group">
                            <label>Stock</label>
                            <input type="number" class="form-control" name="stock" id="edit-stock" required>
                        </div>

                        <div class="form-group">
                            <label>Imagen (opcional)</label>
                            <input type="file" class="form-control-file" name="imagen" accept="image/*">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
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
    function cargarDatosEditar(btn) {
        document.getElementById("edit-id").value = btn.dataset.id;
        document.getElementById("edit-nombre").value = btn.dataset.nombre;
        document.getElementById("edit-descripcion").value = btn.dataset.descripcion;
        document.getElementById("edit-precio").value = btn.dataset.precio;
        document.getElementById("edit-stock").value = btn.dataset.stock;
    }
    $('#usuarios').DataTable({
        language: {
            url: './language.json'
        }
    });
</script>