<?php
    $user=$this->session->userdata('user');
    $id=$user['id'];    
?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
  <!-- Mobile Specific Meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Favicon-->
  <link rel="shortcut icon" href="<?=base_url()?>static/karma/img/fav.png">
  <!-- Author Meta -->
  <meta name="author" content="CodePixar">
  <!-- Meta Description -->
  <meta name="description" content="">
  <!-- Meta Keyword -->
  <meta name="keywords" content="">
  <!-- meta character set -->
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <!-- Site Title -->
  <title>Karma Shop</title>

  <script src="<?=base_url()?>static/scrips/jquery-3.7.1.min.js"></script>
  <script src="<?=base_url()?>static/scrips/scripts/mensajes.js"></script>
  <script src="<?=base_url()?>static/scrips/scripts/catalogo.js"></script>

  <link rel="stylesheet" href="<?=base_url()?>static/karma/css/linearicons.css">
  <link rel="stylesheet" href="<?=base_url()?>static/karma/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?=base_url()?>static/karma/css/themify-icons.css">
  <link rel="stylesheet" href="<?=base_url()?>static/karma/css/bootstrap.css">
  <link rel="stylesheet" href="<?=base_url()?>static/karma/css/owl.carousel.css">
  <link rel="stylesheet" href="<?=base_url()?>static/karma/css/nice-select.css">
  <link rel="stylesheet" href="<?=base_url()?>static/karma/css/nouislider.min.css">
  <link rel="stylesheet" href="<?=base_url()?>static/karma/css/ion.rangeSlider.css" />
  <link rel="stylesheet" href="<?=base_url()?>static/karma/css/ion.rangeSlider.skinFlat.css" />
  <link rel="stylesheet" href="<?=base_url()?>static/karma/css/magnific-popup.css">
  <link rel="stylesheet" href="<?=base_url()?>static/karma/css/main.css">
</head>

<body>

  <!-- Start Header Area -->
  <header class="header_area sticky-header">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light main_box">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <a class="navbar-brand logo_h" href="<?=base_url()?>"><img src="<?=base_url()?>static/karma/img/logo.png"
              alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav ml-auto">
              <li class="nav-item active"><a class="nav-link text-primary" href="<?=base_url()?>">Inicio</a></li>
              <li class="nav-item active"><a class="nav-link text-primary"
                  href="<?=site_url()?>/frontend/carro">Carrito</a></li>
              <li class="nav-item active"><a class="nav-link text-primary"
                  href="<?=site_url()?>/frontend/catalogo">Catalogo</a></li>
              <li class="nav-item active"><a class="nav-link text-primary"
                  href="<?=site_url()?>/frontend/compras">Compras</a></li>
              <li class="nav-item"><a class="nav-link text-primary" href="<?=site_url()?>/frontend/lista_deseos">Lista
                  de deseos</a></li>
              <li class="nav-item submenu dropdown">
                <a href="#" class="nav-link dropdown-toggle text-primary" data-toggle="dropdown" role="button"
                  aria-haspopup="true" aria-expanded="false">Acciones</a>
                <ul class="dropdown-menu">
                  <li class="nav-item"><a class="nav-link" href="<?=site_url()?>/frontend/login">Iniciar sesion</a></li>
                  <li class="nav-item"><a class="nav-link" href="<?=site_url()?>/acceso/cierrasesion">Cerrar sesión</a>
                  </li>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="nav-item"><a href="#" class="cart"><span class="ti-bag"></span></a></li>
              <!--<li class="nav-item">
                <button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
              </li>-->
            </ul>
          </div>
        </div>
      </nav>
    </div>

  </header>

  <!-- End Header Area -->



  <br><br><br>


  <main role="main">

    <section class="jumbotron text-center">
      <div class="search-bar-container input-group">
        <input type="text" class="form-control" id="search-input" placeholder="Buscar...">
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="button" id="search-button">Buscar</button>
        </div>
      </div>
      <div class="container">

        <h1 class="jumbotron-heading">Catálogo de productos</h1>
        <p class="lead text-muted">"¡Descubre el mundo con nuestra exclusiva selección de destinos! Encuentra tu próxima
          aventura entre las nubes en nuestro catálogo de productos.".</p>

      </div>
    </section>

    <!-- Agregar el formulario de filtrado por país -->
    <form method="post" action="">
      <div class="container mb-4">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="input-group">
              <select class="form-control" name="pais_filtro" id="pais_filtro">
                <!-- La opción por defecto se agregará dinámicamente mediante JavaScript -->
              </select>
              <div class="input-group-append">
                <button type="button" class="btn btn-primary">Filtrar por país</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>

    <!-- Resto de tu HTML ... -->


    <div class="album py-5 bg-light">
      <div class="container">
        <div class="row" id="card-container">

        </div>
      </div>
    </div>

  </main>

  <!-- End footer Area -->
  <script>
    var appData = {
      idpromocion: 0,
      uri_app: "<?= base_url() ?>",
      uri_ws: "<?= base_url() ?>../webservice/",
      id: <?= $id ?>
    };
  </script>
</body>

</html>