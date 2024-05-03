<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pago Exitoso</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
        }

        .payment-box {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        h1 {
            color: #28a745;
        }

        p {
            color: #6c757d;
        }
    </style>

  <script src="<?=base_url()?>static/scrips/jquery-3.7.1.min.js"></script>  

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
					<a class="navbar-brand logo_h" href="<?=base_url()?>"><img src="<?=base_url()?>static/karma/img/logo.png" alt=""></a>
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
							<li class="nav-item active"><a class="nav-link text-primary" href="<?=site_url()?>/frontend/carro">Carrito</a></li>							
							<li class="nav-item active"><a class="nav-link text-primary" href="<?=site_url()?>/frontend/catalogo">Catalogo</a></li>
							<li class="nav-item active"><a class="nav-link text-primary" href="<?=site_url()?>/frontend/compras">Compras</a></li>						
							<li class="nav-item"><a class="nav-link text-primary" href="<?=site_url()?>/frontend/lista_deseos">Lista de deseos</a></li>
							<li class="nav-item submenu dropdown">
								<a href="#" class="nav-link dropdown-toggle text-primary" data-toggle="dropdown" role="button" aria-haspopup="true"
								 aria-expanded="false">Acciones</a>
								<ul class="dropdown-menu">
									<li class="nav-item"><a class="nav-link" href="<?=site_url()?>/frontend/login">Iniciar sesion</a></li>
									<li class="nav-item"><a class="nav-link" href="<?=site_url()?>/acceso/cierrasesion">Cerrar sesión</a></li>
								</ul>
							</li>
						</ul>
						<!--<ul class="nav navbar-nav navbar-right">
							<li class="nav-item"><a href="#" class="cart"><span class="ti-bag"></span></a></li>
							<li class="nav-item">
								<button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
							</li>
						</ul>-->
					</div>
				</div>
			</nav>
		</div>
		<!--<div class="search_input" id="search_input_box">
			<div class="container">
				<form class="d-flex justify-content-between">
					<input type="text" class="form-control" id="search_input" placeholder="Buscador">
					<button type="submit" class="btn"></button>
					<span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
				</form>
			</div>
		</div>-->
	</header>
	<!-- End Header Area -->

<div class="payment-box">
    <h1>Pago Exitoso</h1>
    <p>¡Gracias por tu compra!</p>
    <!-- Puedes agregar más contenido o enlaces aquí según tus necesidades -->
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
