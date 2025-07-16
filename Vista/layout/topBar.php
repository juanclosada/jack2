<!-- Topbar Start -->
<div class="container-fluid">
  <div class="row bg-secondary py-1 px-xl-5">
    <div class="col-lg-6 d-none d-lg-block">
      <div class="d-inline-flex align-items-center h-100">
        <!-- <a class="text-body mr-3" href="">Sobre Nosotros</a>
        <a class="text-body mr-3" href="">Contactenos</a>
        <a class="text-body mr-3" href="">Ayuda</a>
        <a class="text-body mr-3" href="">FAQs</a> -->
      </div>
    </div>
    <div class="col-lg-6 text-center text-lg-right">
      <div class="d-inline-flex align-items-center">
        <div class="btn-group">
          <!-- <button
            type="button"
            class="btn btn-sm btn-light dropdown-toggle"
            data-toggle="dropdown">
            Mi Cuenta
          </button> -->
          <?php
          if (session_status() === PHP_SESSION_NONE) {
            session_start();
          }
          if (empty($_SESSION['id'])) {
            echo '<a href="login.php" class="btn btn-light">Inicio de Sesión</a>';
            echo '<a href="registro.php" class="btn btn-light">Registrese Aqui</a>';
          } else {
            echo '<a href="logout.php" class="btn btn-light">Salir</a>';
          }
          ?>

          <div class="dropdown-menu dropdown-menu-right">
          </div>
        </div>
        <!-- <div class="btn-group mx-2">
          <button
            type="button"
            class="btn btn-sm btn-light dropdown-toggle"
            data-toggle="dropdown">
            Pagos
          </button>
          <div class="dropdown-menu dropdown-menu-right">
            <button class="dropdown-item" type="button">COP</button>
            <button class="dropdown-item" type="button">EUR</button>
            <button class="dropdown-item" type="button">VOB</button>
            <button class="dropdown-item" type="button">USD</button>
          </div>
        </div> -->
        <!-- <div class="btn-group">
          <button
            type="button"
            class="btn btn-sm btn-light dropdown-toggle"
            data-toggle="dropdown">
            ES
          </button>
          <div class="dropdown-menu dropdown-menu-right">
            <button class="dropdown-item" type="button">FR</button>
            <button class="dropdown-item" type="button">PORT</button>
            <button class="dropdown-item" type="button">EN</button>
          </div>
        </div> -->
      </div>
      <div class="d-inline-flex align-items-center d-block d-lg-none">
        <a href="" class="btn px-0 ml-2">
          <i class="fas fa-heart text-dark"></i>
          <span
            class="badge text-dark border border-dark rounded-circle"
            style="padding-bottom: 2px">0</span>
        </a>
        <a href="" class="btn px-0 ml-2">
          <i class="fas fa-shopping-cart text-dark"></i>
          <span
            class="badge text-dark border border-dark rounded-circle"
            style="padding-bottom: 2px">0</span>
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
          <input
            type="text"
            class="form-control"
            placeholder="Buscar productos" />
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