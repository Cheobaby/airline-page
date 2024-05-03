<?php
  $user=$this->session->userdata('user');
  $name=$user['nombre'];  
?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="<?=base_url()?>static/karma/img/fav.png">
	<script src="<?=base_url()?>static/scrips/jquery-3.7.1.min.js"></script>
	<script src="<?=base_url()?>static/scrips/scripts/index.js"></script>
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

	<!-- start banner Area -->
	<section class="banner-area">
		<div class="container">
			<div class="row fullscreen align-items-center justify-content-start">
				<div class="col-lg-12">
					<div class="active-banner-slider owl-carousel">
						<!-- single-slide -->
						<div class="row single-slide align-items-center d-flex">
							<div class="col-lg-5 col-md-6">
								<div class="banner-content">
									<h1>¡Bienvenido<br><?=$name?>!</h1>
									<h3>Bienvenido a <strong>Karma</strong>, donde cada vuelo es una invitación a explorar el mundo con comodidad y estilo. </h3>
							
								</div>
							</div>
							<div class="col-lg-7">
								<div class="banner-img">
									<img class="img-fluid" src="<?=base_url()?>static/karma/img/paises/trans.png" alt=""id="principal">
								</div>
							</div>
						</div>
						<!-- single-slide -->
						<div class="row single-slide">
							<div class="col-lg-5">
								<div class="banner-content">
									<h1>Horizontes Infinitos<br></h1>
									<p> Descubre destinos asombrosos, vive experiencias únicas y haz que cada viaje sea una aventura inolvidable. Con nuestro compromiso de ofrecer vuelos excepcionales</p>
									
								</div>
							</div>
							<div class="col-lg-7">
								<div class="banner-img">
									<img class="img-fluid" src="<?=base_url()?>static/karma/img/paises/avion2.png" alt="">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End banner Area -->

	<!-- start features Area -->
	
	<!-- end features Area -->
	<br><br><br><br>
	<!-- Start category Area -->
	<section class="category-area">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 col-md-12">
					<div class="row">
						<div class="col-lg-8 col-md-8">
							<div class="single-deal">
								<div class="overlay"></div>
								<img class="img-fluid w-100" src="<?=base_url()?>static/karma/img/paises/viaje2.jpg" alt="">
								<a href="<?=base_url()?>static/karma/img/category/c1.jpg" class="img-pop-up" target="_blank">
									<div class="deal-details">
										<h6 class="deal-title">Tu viaje, nuestro compromiso</h6>
									</div>
								</a>
							</div>
						</div>
						<div class="col-lg-4 col-md-4">
							<div class="single-deal">
								<div class="overlay"></div>
								<img class="img-fluid w-100" src="<?=base_url()?>static/karma/img/paises/viaje3.jpg" alt="">
								<a href="img/category/c2.jpg" class="img-pop-up" target="_blank">
									<div class="deal-details">
										<h6 class="deal-title">Pueblos mágicos</h6>
									</div>
								</a>
							</div>
						</div>
						<div class="col-lg-4 col-md-4">
							<div class="single-deal">
								<div class="overlay"></div>
								<img class="img-fluid w-100" src="<?=base_url()?>static/karma/img/paises/viaje5.jpg" alt="">
								<a href="<?=base_url()?>static/karma/img/category/c3.jpg" class="img-pop-up" target="_blank">
									<div class="deal-details">
										<h6 class="deal-title">Vistas increibles</h6>
									</div>
								</a>
							</div>
						</div>
						<div class="col-lg-8 col-md-8">
							<div class="single-deal">
								<div class="overlay"></div>
								<img class="img-fluid w-100" src="<?=base_url()?>static/karma/img/paises/viaje4.jpg" alt="">
								<a href="<?=base_url()?>static/karma/img/category/c4.jpg" class="img-pop-up" target="_blank">
									<div class="deal-details">
										<h6 class="deal-title">Lugares populares</h6>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="single-deal">
						<div class="overlay"></div>
						<img class="img-fluid w-100" src="<?=base_url()?>static/karma/img/paises/viaje6.jpg" alt="">
						<a href="<?=base_url()?>static/karma/img/category/c5.jpg" class="img-pop-up" target="_blank">
							<div class="deal-details">
								<h6 class="deal-title">Viajes seguros</h6>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End category Area -->
	<h1>ESTAMOS UBICADOS EN</h1>
	<div id="map"></div>


	<!-- start footer Area -->
	<footer class="footer-area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-3  col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>About Us</h6>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore
							magna aliqua.
						</p>
					</div>
				</div>
				<div class="col-lg-4  col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>Newsletter</h6>
						<p>Stay update with our latest</p>
						<div class="" id="mc_embed_signup">

							<form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
							 method="get" class="form-inline">

								<div class="d-flex flex-row">

									<input class="form-control" name="EMAIL" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '"
									 required="" type="email">


									<button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
									<div style="position: absolute; left: -5000px;">
										<input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
									</div>

									<!-- <div class="col-lg-4 col-md-4">
												<button class="bb-btn btn"><span class="lnr lnr-arrow-right"></span></button>
											</div>  -->
								</div>
								<div class="info"></div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-3  col-md-6 col-sm-6">
					<div class="single-footer-widget mail-chimp">
						<h6 class="mb-20">Instragram Feed</h6>
						<ul class="instafeed d-flex flex-wrap">
							<li><img src="<?=base_url()?>static/karma/img/i1.jpg" alt=""></li>
							<li><img src="<?=base_url()?>static/karma/img/i2.jpg" alt=""></li>
							<li><img src="<?=base_url()?>static/karma/img/i3.jpg" alt=""></li>
							<li><img src="<?=base_url()?>static/karma/img/i4.jpg" alt=""></li>
							<li><img src="<?=base_url()?>static/karma/img/i5.jpg" alt=""></li>
							<li><img src="<?=base_url()?>static/karma/img/i6.jpg" alt=""></li>
							<li><img src="<?=base_url()?>static/karma/img/i7.jpg" alt=""></li>
							<li><img src="<?=base_url()?>static/karma/img/i8.jpg" alt=""></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>Follow Us</h6>
						<p>Let us be social</p>
						<div class="footer-social d-flex align-items-center">
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-dribbble"></i></a>
							<a href="#"><i class="fa fa-behance"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
				<p class="footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</p>
			</div>
		</div>
	</footer>
	<!-- End footer Area -->
    <script>
		var appData = {
        	idpromocion : 0,
        	uri_app : "<?= base_url() ?>",
        	uri_ws : "<?= base_url() ?>../webservice/"
    	};
	</script>	
	<script src="<?=base_url()?>static/scrips/scripts/maps.js"></script>							
	<script src="<?=base_url()?>static/karma/js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
	 crossorigin="anonymous"></script>
	<script src="<?=base_url()?>static/karma/js/vendor/bootstrap.min.js"></script>
	<script src="<?=base_url()?>static/karma/js/jquery.ajaxchimp.min.js"></script>
	<script src="<?=base_url()?>static/karma/js/jquery.nice-select.min.js"></script>
	<script src="<?=base_url()?>static/karma/js/jquery.sticky.js"></script>
	<script src="<?=base_url()?>static/karma/js/nouislider.min.js"></script>
	<script src="<?=base_url()?>static/karma/js/countdown.js"></script>
	<script src="<?=base_url()?>static/karma/js/jquery.magnific-popup.min.js"></script>
	<script src="<?=base_url()?>static/karma/js/owl.carousel.min.js"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="<?=base_url()?>static/karma/js/gmaps.min.js"></script>
	<script src="<?=base_url()?>static/karma/js/main.js"></script>
</body>

</html>