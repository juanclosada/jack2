<!DOCTYPE html>
<html lang="en">
<?php
include dirname(__DIR__) . '/vista/layout/head.php';
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