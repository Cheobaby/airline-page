<?php
    $user=$this->session->userdata('user');
    $id=$user['id'];    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Historial de Compras</title>
    <!-- Enlace al CSS de Bootstrap (puedes cambiar la versión según tus necesidades) -->    
    <!-- Enlace a Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="<?=base_url()?>static/scrips/jquery-3.7.1.min.js"></script>
    <script src="<?=base_url()?>static/scrips/scripts/mensajes.js"></script>
    <script src="<?=base_url()?>static/scrips/scripts/compras.js"></script>
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

<!--<div class="container mt-5">
        <h2 class="text-center mb-4">Historial de Compras</h2>-->
        <!-- Aquí se agregarán dinámicamente las compras -->
    <!--<div>-->

<!-- Enlace al JS de Bootstrap (puedes cambiar la versión según tus necesidades) -->

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
<br><br><br><br>
<div class="container">
  <div class="text-center">
    <h1>Historial de compras</h1>
  </div>
</div>



<div class="container mt-4">
  <table class="table" id="carrito-container">
    <thead>
      <tr>
        <th scope="col">Folio</th>
        <th scope="col">Fecha</th>
        <th scope="col">Monto</th>
        <th scope="col">Detalles</th>
        <th scope="col">Factura</th>
      </tr>
    </thead>
    <tbody>
      <!-- Filas de la tabla se agregarán dinámicamente aquí -->
    </tbody>
  </table>
</div>

<div class="container mt-4" id="detalles">

</div>


<script>
    var appData = {
      idpromocion: 0,
      uri_app: "<?= base_url() ?>",
      uri_ws: "<?= base_url() ?>../webservice/",
      id : <?=$id?>
    };
  </script>

</body>

</html>