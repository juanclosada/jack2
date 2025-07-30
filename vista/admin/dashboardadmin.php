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
$home = 'active';
$produc = $user = '';
if (empty($_SESSION['usuario']['id_rol']) || $_SESSION['usuario']['id_rol'] != 1) {
    header("location: login.php");
}
$db = new Conexion('N');
$usuarios = $db->contarRegistros('usuarios');
$productos = $db->contarRegistros('productos');
$facturas = $db->contarRegistros('factura');
$comentarios = $db->contarRegistros('contactos');
?>

<body>
    <?php
    include dirname(__DIR__) . '/admin/layout/topBar.php';
    include dirname(__DIR__) . '/admin/layout/navBar.php';
    ?>
    <!-- start section -->
    <div class="container">
        <h4>Bienvenido <?php echo $_SESSION['usuario']['nombre']; ?></h4>
        <p><?php 
            //echo $formatter->format(new DateTime()) 
            ?></p>
        <span class="text-dark mb-5">Resumen</span>
        <div class="table-responsive mt-3">
            <table class="table">
                <thead class="">
                    <tr>
                        <th scope="col">Usuarios registrados</th>
                        <td><?php echo $usuarios; ?></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Productos en inventario</th>
                        <td><?php echo $productos; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Facturación del mes</th>
                        <td><?php echo $facturas; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Comentarios de clientes</th>
                        <td><?php echo $comentarios; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- end section -->

</body>


<?php
include dirname(__DIR__) . '/admin/layout/footer.php';
?>

</html>
<?php
include dirname(__DIR__) . '/admin/layout/script.php';
?>