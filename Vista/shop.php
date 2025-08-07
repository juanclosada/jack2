<!DOCTYPE html>
<html lang="en">
<?php
include_once dirname(__DIR__) . '/vista/layout/head.php';
?>

<body>
    <?php
    include_once '../controlador/conexion.php';
    $db = new Conexion();
    $pag = empty($_GET['pag']) ? 0 : $_GET['pag'];
    $contarP = $db->contarRegistros('productos WHERE stock > 0');
    $limite = 12;
    $cantPag = round($contarP / $limite);
    if ($pag < 0) {
        $pag = 0;
    }
    if ($pag > $cantPag) {
        $pag = 0;
    }
    $min = empty($_GET['min']) ? 0 : $_GET['min'];
    $max = empty($_GET['max']) ? 0 : $_GET['max'];

    $body = 2;
    $query = "SELECT * FROM productos WHERE stock > 0";
    if ($min > 0) {
        $query .= " AND precio >= $min";
    }
    if ($max > 0) {
        if ($min > 0) {
            $query .= " AND ";
        }
        $query .= "precio <= $max";
    }
    $productosD = $db->consultarRegistros2("$query LIMIT $limite OFFSET $pag");
    // mostrar($productosD);
    ?>

    <body>

        <?php
        include_once dirname(__DIR__) . '/vista/layout/topBar.php';
        include_once dirname(__DIR__) . '/vista/layout/navBar.php'; ?>
        <!-- Breadcrumb Start -->
        <!-- <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-12">
                    <nav class="breadcrumb bg-light mb-30">
                        <a class="breadcrumb-item text-dark" href="#">Inicio</a>
                        <a class="breadcrumb-item text-dark" href="#">Tienda</a>
                        <span class="breadcrumb-item active">Detalle de los Productos</span>
                    </nav>
                </div>
            </div>
        </div> -->
        <!-- Breadcrumb End -->


        <!-- Shop Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <!-- Shop Sidebar Start -->
                <div class="col-lg-3 col-md-4">
                    <!-- Price Start -->
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filtrar
                            por Precios</span></h5>
                    <div class="bg-light p-4 mb-30">
                        <form method="GET" action="shop.php">
                            <div>
                                <label for="min">Precio mínimo:</label>
                                <input class="form-control form-control-sm" type="number" id="min" name="min" min="0" placeholder="Ej: 100.000 o 1.0000.000" required>
                                <label for="max">Precio máximo:</label>
                                <input class="form-control form-control-sm" type="number" id="max" name="max" min="0" placeholder="Ej: 100.000 o 1.0000.000" required>
                                <button class="btn btn-sm btn-warning mt-2" type="submit">Buscar</button>
                                <a href="shop.php" class="btn btn-sm btn-light mt-2 ml-1" type="button">Limpiar</a>
                            </div>

                        </form>
                    </div>
                    <!-- Price End -->

                    <!-- Color Start -->
                    <!-- <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filtrar
                            por color</span></h5>
                    <div class="bg-light p-4 mb-30">
                        <form>
                            <div
                                class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input" checked id="color-all">
                                <label class="custom-control-label" for="price-all">Todos los Colores</label>
                                <span class="badge border font-weight-normal">1000</span>
                            </div>
                            <div
                                class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input" id="color-1">
                                <label class="custom-control-label" for="color-1">Negro</label>
                                <span class="badge border font-weight-normal">150</span>
                            </div>
                            <div
                                class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input" id="color-2">
                                <label class="custom-control-label" for="color-2">Blanco</label>
                                <span class="badge border font-weight-normal">295</span>
                            </div>
                            <div
                                class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input" id="color-3">
                                <label class="custom-control-label" for="color-3">Rojo</label>
                                <span class="badge border font-weight-normal">246</span>
                            </div>
                            <div
                                class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input" id="color-4">
                                <label class="custom-control-label" for="color-4">Azul</label>
                                <span class="badge border font-weight-normal">145</span>
                            </div>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                                <input type="checkbox" class="custom-control-input" id="color-5">
                                <label class="custom-control-label" for="color-5">Rosado</label>
                                <span class="badge border font-weight-normal">168</span>
                            </div>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                                <input type="checkbox" class="custom-control-input" id="color-6">
                                <label class="custom-control-label" for="color-6">marron</label>
                                <span class="badge border font-weight-normal">168</span>
                            </div>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                                <input type="checkbox" class="custom-control-input" id="color-7">
                                <label class="custom-control-label" for="color-7">Rosado</label>
                                <span class="badge border font-weight-normal">168</span>
                            </div>
                        </form>
                    </div> -->
                    <!-- Color End -->
                </div>
                <!-- Shop Sidebar End -->

                <!-- Shop Product Start -->
                <div class="col-lg-9 col-md-8">
                    <div class="row pb-3">

                        <?php
                        if (empty($productosD)) {
                            echo "<h3>No se encontraron resultados para tu búsqueda.</h3>";
                        } else {
                            foreach ($productosD as $key => $value) {
                                $enlace = 'detail.php?id=' . base64_encode($value['id_producto']); ?>
                                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img2 position-relative overflow-hidden">
                                            <img class="img-fluid w-100" src="<?php echo $value['imagen'] ?>" alt="" style="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href="<?php echo $enlace; ?>"><i class="fa fa-shopping-cart"></i></a>
                                                <!-- <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a> -->
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="<?php echo $enlace; ?>"><?php echo $value['nombre']; ?></a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>$<?php echo number_format($value['precio']); ?></h5>
                                                <h6 class="text-muted ml-2"><del>$<?php echo number_format($value['precio'] + sumarDescuento($value['precio'])); ?></del></h6>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small>(<?php echo rand(10, 99); ?>)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-12">
                                <nav>
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item <?php echo ($pag <= 0 ? 'disabled' : ''); ?>"><a class="page-link" href="shop.php?pag=<?php echo  $var = $pag - 1; ?>">Anterior</span></a></li>
                                        <?php
                                        for ($i = 0; $i < $cantPag; $i++) {
                                            $e = $i + 1; ?>
                                            <li class="page-item <?php echo ($i == $pag ? "active" : '') ?>"><a class="page-link" href="shop.php?pag=<?php echo $i; ?>"><?php echo $e ?></a></li>
                                        <?php } ?>
                                        <li class="page-item"><a class="page-link" href="shop.php?pag=<?php echo $pag + 1; ?>">Siguiente</a></li>
                                    </ul>
                                </nav>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <!-- Shop Product End -->
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