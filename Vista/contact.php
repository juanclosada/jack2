<!DOCTYPE html>
<html lang="en">
<?php
include dirname(__DIR__) . '/vista/layout/head.php';
?>

<body>
    <?php
    include dirname(__DIR__) . '/vista/layout/topBar.php';
    include dirname(__DIR__) . '/vista/layout/navBar.php';
    ?>

    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Contact Start -->
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contactanos</span></h2>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form bg-light p-30">
                    <div id="success"></div>
                    <form name="Envió de Mensaje" id="contactForm" novalidate="novalidate">
                        <div class="control-group">
                            <input type="text" class="form-control" id="name" placeholder="Sus Nombres"
                                required="required" data-validation-required-message="POr favor escriba su Nombre" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="email" class="form-control" id="email" placeholder="Su Correo"
                                required="required" data-validation-required-message="Por Favor Ingrese su Correo" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control" id="subject" placeholder="Asunto:"
                                required="required" data-validation-required-message="Por favor ingrese su Asunto" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control" rows="8" id="message" placeholder="Mensaje"
                                required="required"
                                data-validation-required-message="Por favor Ingrese su Mensaje"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Envie su Mensaje</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <div class="bg-light p-30 mb-30">
                    <iframe style="width: 100%; height: 250px;"
                        src="https://www.google.com/maps/embed/v1/place?q=Bogotá+Colombia&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"
                        frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
                <div class="bg-light p-30 mb-3">
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>calle 138# 54c-40, Bogota, Colombia</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@industria2jack.com</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+057 603520236</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
    <?php
    include dirname(__DIR__) . '/vista/layout/footer.php';
    ?>
</body>
<?php
include dirname(__DIR__) . '/vista/layout/script.php';
?>

</html>