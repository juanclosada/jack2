<!DOCTYPE html>
<html lang="en">
<?php
include dirname(__DIR__) . '/vista/layout/head.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$error = '';
if (!empty($_GET['error'])) {
    $error = '<span class="text-dark mb-2 pb-2">Por favor inicia sesión para poder continuar con tu compra:</span>';
}
if (!empty($_SESSION['usuario'])) {
    switch ($_SESSION['usuario']['id_rol']) {
        case '1':
            header("location: dashboardadmin.php");
            break;
        case '2':
            header("location: ../roles/dashboardjefe.php");
            break;
        case '3':
            header("location: ../vista/index.php");
            break;
        default:
            echo "Rol no definido<a href='../vista/login.php'>Ingresar Nuevamente</a>";
            break;
    }
}
?>


<body>
    <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
        <div class="col-lg-4">
            <a href="" class="text-decoration-none">
                <span class="h1 text-uppercase text-primary bg-dark px-2">INDUSTRIA</span>
                <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">ALCOBAS</span>
                <span class="h1 text-uppercase text-primary bg-dark px-2">2JACK</span>
            </a>
        </div>
    </div>
    <div class="container login-container d-flex align-items-center justify-content-center mt-5">
        <div class="login-box">
            <h4 class="text-center mb-4">Iniciar Sesión</h4>
            <?php echo $error; ?>
            <form action="../controlador/validar_login.php" method="POST" novalidate>
                <div class="form-group">
                    <label for="correo">Correo</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" id="correo" name="correo" placeholder="Ingrese su correo" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Ingrese su contraseña" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                <div class="text-center mt-3">
                    <a href="#">¿Olvidó su contraseña?</a>
                    <a href="registro.php">Si no tienes una cuenta registrate aquí</a>
                </div>
            </form>
        </div>
    </div>

    <?php
    include dirname(__DIR__) . '/vista/layout/footer.php';
    ?>
</body>
<?php
include dirname(__DIR__) . '/vista/layout/script.php';
?>

</html>