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
    <!-- Site Title -->
    <title>Karma Shop</title>
    <script src="https://www.paypal.com/sdk/js?client-id=AfEnx4YSylmHH5r63xrGz9jiPzp-DDZ0d66w8HKAlS6G7hv8Lu38_tilLM8q6jTkwl-B1ZCXviydd8_R&currency=MXN"></script>
    <!--<script src="https://www.paypal.com/sdk/js?client-id=AfEnx4YSylmHH5r63xrGz9jiPzp-DDZ0d66w8HKAlS6G7hv8Lu38_tilLM8q6jTkwl-B1ZCXviydd8_R&currency=MXN"></script>-->
    <script src="<?=base_url()?>static/scrips/jquery-3.7.1.min.js"></script>
    <script src="<?=base_url()?>static/scrips/scripts/mensajes.js"></script>
    <script src="<?=base_url()?>static/scrips/scripts/carrito.js"></script>  
    <!--
            CSS
            ============================================= -->
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
    <link rel="stylesheet" href="<?=base_url()?>static/karma/css/maps.css">

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

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Carrito de compras</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="category.html">Cart</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->
    
	<div class="container mt-5" id="carrito-container">
    <!-- Contenido generado dinámicamente se agregará aquí -->
</div>

<!--<div class="row mt-3 text-center" id="facturaSection" style="display: none;">
    <div class="col-md-12">
        <label>
            <input type="checkbox" id="facturaCheckbox"> ¿Necesitas factura?
        </label>
    </div>
</div>-->

<div class="row mt-3 text-center">
    <div class="col-md-12">
        <div class="d-flex align-items-center justify-content-center">
            <div id="pagarButton"></div>
        </div>
    </div>
</div>


  <!-- Formulario de factura -->
  <!--<div class="row mt-3 text-center" id="facturaForm" style="display:none;">
        <div class="col-md-12">
            <form id="facturaDatosForm">-->
                <!-- Campos del formulario -->
                <!--<div class="form-group">
                    <label for="idVuelo">Ingresa tu RFC:</label>
                    <input type="text" class="form-control" id="rfc" required>
                </div>                -->
                <!-- Otros campos del formulario -->
                <!--<button type="button" class="btn btn-success" id="generarFactura">Generar Factura</button>
            </form>
        </div>
    </div>-->
<body>
	
<!-- Incluye la biblioteca jsPDF -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js" onload="jsPDFLoaded()"></script>-->


<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>-->

    <!-- End footer Area -->
    <script>
        var appData = {
        idpromocion: 0,
        uri_app: "<?= base_url() ?>",
        uri_ws: "<?= base_url() ?>../webservice/",
        id : <?=$id?>
        };
    </script>							



</html>