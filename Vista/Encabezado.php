<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>INDUSTRIA ALCOBAS 2JACK</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="<?php echo IMG_PATH; ?>Favicon.jpg" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?php echo LIB_PATH; ?>animate/animate.min.css" rel="stylesheet">
    <link href="<?php echo LIB_PATH; ?>owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo CSS_PATH; ?>style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-1 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center h-100">
                    <a class="text-body mr-3" href="">Sobre Nosotros</a>
                    <a class="text-body mr-3" href="">Contactenos</a>
                    <a class="text-body mr-3" href="">Ayuda</a>
                    <a class="text-body mr-3" href="">FAQs</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Mi Cuenta</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="../jack2/Inicio_sesion.php">Inicio de Sesión</a>
                            <a href="../jack2/registro.php">Registrese Aqui</a>
                        </div>
                    </div>
                    <div class="btn-group mx-2">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Pagos</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <button class="dropdown-item" type="button">COP</button>
                            <button class="dropdown-item" type="button">EUR</button>
                            <button class="dropdown-item" type="button">VOB</button>
                            <button class="dropdown-item" type="button">USD</button>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">ES</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <button class="dropdown-item" type="button">FR</button>
                            <button class="dropdown-item" type="button">PORT</button>
                            <button class="dropdown-item" type="button">EN</button>
                        </div>
                    </div>
                </div>
                <div class="d-inline-flex align-items-center d-block d-lg-none">
                    <a href="" class="btn px-0 ml-2">
                        <i class="fas fa-heart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                    </a>
                    <a href="" class="btn px-0 ml-2">
                        <i class="fas fa-shopping-cart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">INDUSTRIA</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">ALCOBAS</span>
                    <span class="h1 text-uppercase text-primary bg-dark px-2">2JACK</span>
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar productos">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-6 text-right">
                <p class="m-0">Servicio al Cliente</p>
                <h5 class="m-0">+57 603520236</h5>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categorias</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100">
                        <div class="nav-item dropdown dropright">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Muebles <i class="fa fa-angle-right float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute rounded-0 border-0 m-0">
                                <a href="" class="dropdown-item">Mesas de Noche</a>
                                <a href="" class="dropdown-item">Sillas</a>
                                <a href="" class="dropdown-item">Camacuna</a>
                            </div>
                        </div>
                        <a href="" class="nav-item nav-link">Mesas de Noche</a>
                        <a href="" class="nav-item nav-link">Camacuna</a>
                        <a href="" class="nav-item nav-link">Sofa</a>
                        <a href="" class="nav-item nav-link">Tocador</a>
                        <a href="" class="nav-item nav-link">Sillas</a>
                        <a href="" class="nav-item nav-link">Tendidos</a>
                        <a href="" class="nav-item nav-link">Camas</a>
                        <a href="" class="nav-item nav-link">Puff</a>
                        <a href="" class="nav-item nav-link">Juego de Alcobas</a>
                        <a href="" class="nav-item nav-link">Armarios</a>
                        <a href="" class="nav-item nav-link">Escritorio</a>
                        <a href="" class="nav-item nav-link">Mesa de Centro</a>
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">INDUSTRIA</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">ALCOBAS</span>
                        <span class="h1 text-uppercase text-dark bg-light px-2">2JACK</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="../jack2/index.php" class="nav-item nav-link active">Inicio</a>
                            <a href="<?php echo VISTA_PATH; ?>../shop.html" class="nav-item nav-link">Tienda</a>
                            <a href="../detail.html" class="nav-item nav-link">Detalle de los Productos</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Páginas <i class="fa fa-angle-down mt-1"></i></a>
                                <div class="dropdown-menu bg-primary rounded-0 border-0 m-0">
                                    <a href="../cart.php" class="dropdown-item">Carrito de Compra</a>
                                    <a href="../checkout.php" class="dropdown-item">Realizar Pagos</a>
                                </div>
                            </div>
                            <a href="../Contact.html" class="nav-item nav-link">Contactenos</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <a href="" class="btn px-0">
                                <i class="fas fa-heart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
                            </a>
                            <a href="" class="btn px-0 ml-3">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->