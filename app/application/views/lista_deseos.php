<?php
  $user=$this->session->userdata('user');
  $id=$user['id'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lista de Deseos - Mi Aerolínea</title>
    <!-- Agrega el enlace a Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="shortcut icon" href="<?=base_url()?>static/karma/img/fav.png">
    <script src="<?=base_url()?>static/scrips/jquery-3.7.1.min.js"></script>
    <script src="<?=base_url()?>static/scrips/scripts/listadeseos.js"></script>
    <link rel="stylesheet" href="<?=base_url()?>static/karma/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url()?>static/karma/css/themify-icons.css">
    <link rel="stylesheet" href="<?=base_url()?>static/karma/css/bootstrap.css">
    <link rel="stylesheet" href="<?=base_url()?>static/karma/css/nice-select.css">
    <link rel="stylesheet" href="<?=base_url()?>static/karma/css/nouislider.min.css">
    <link rel="stylesheet" href="<?=base_url()?>static/karma/css/ion.rangeSlider.css" />
    <link rel="stylesheet" href="<?=base_url()?>static/karma/css/ion.rangeSlider.skinFlat.css" />
    <link rel="stylesheet" href="<?=base_url()?>static/karma/css/magnific-popup.css">
    <link rel="stylesheet" href="<?=base_url()?>static/karma/css/main.css">

    <style>
        body {
            background-color: white;
        }

        .deseo-item {
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
            background-color: #fff;
        }

        .deseo-item img {
            max-width: 100%;
            height: auto;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .deseo-item .table {
            margin-bottom: 0;
        }

        .deseo-item .btn {
            width: 100%;
        }
    </style>
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
							<li class="nav-item">
								<button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</div>		
	</header>
    <br><br>
    <br><br>

    <!-- End Header Area -->
    <div class="container mt-5">
    <h2 class="text-center mb-4">Lista de Deseos de Vuelo</h2>

    <table class="table" id="lista-deseos-table">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Destino</th>
                <th>Fecha de Salida</th>
                <th>Costo</th>
                <!--<th>Añadir a la Lista</th>-->
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <tr class="deseo-item">
                <td><img src="#" alt="Deseo 1" style="width: 150px; height: 100px;"></td>
                <td>Ciudad, País</td>
                <td>Fecha de Salida</td>
                <td>$Costo</td>
                <!--<td><button class="btn btn-primary">Añadir a la Lista</button></td>-->
                <td><button class="btn btn-danger eliminar-btn">Eliminar</button></td>
            </tr>
            <!-- Puedes agregar más filas aquí según sea necesario -->
        </tbody>
    </table>
</div>
<script>
    var appData = {
        idpromocion: 0,
        uri_app: "<?= base_url() ?>",
        uri_ws: "<?= base_url() ?>../webservice/",
        id : <?=$id?>
    };
</script>



    <!-- Agrega el enlace a Bootstrap JS y jQuery (necesario para algunos componentes de Bootstrap) -->




    