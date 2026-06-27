<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    // Lo regresamos al login
    header("Location: /loogi/login-3.php");
    exit;
}
?>

<!doctype html>
 <html class="no-js" lang="">

	<head>
	  <meta charset="utf-8">
	  <meta http-equiv="x-ua-compatible" content="ie=edge">
	  <title>Dashboard </title>
	  <meta name="description" content="">
	  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <link rel="manifest" href="site.webmanifest">
	  <link rel="shortcut icon" type="x-icon" href="favicon.ico">
	  <link rel="stylesheet" href="../css/font-awesome.min.css">
	  <link rel="stylesheet" href="../css/flaticon.css">
	  <link rel="stylesheet" href="../css/themify-icons.css">
	  <link rel="stylesheet" href="../css/owl.carousel.min.css">
	  <link rel="stylesheet" href="../css/animate.min.css">
	  <link rel="stylesheet" href="../css/line-awesome.css">	  
	  <link rel="stylesheet" href="../css/bootstrap.min.css">
	  <link rel="stylesheet" href="../css/jquery.fancybox.css">
	  <link rel="stylesheet" href="../css/magnific-popup.css">
	  <link rel="stylesheet" href="../css/slicknav.css">
	  <link rel="stylesheet" href="../css/swiper.min.css">
	  <link rel="stylesheet" href="../css/normalize.css">
	  <link rel="stylesheet" href="../css/cekko-style.css">
	  <link rel="stylesheet" href="../css/cekko-responsive.css">
	  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,500i,600,700,800&amp;display=swap" rel="stylesheet">
	  
	</head>

	<body>
	  <!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
	  <![endif]-->
	  
	  <div class="mouse-cursor cursor-outer" style="visibility: visible; transform: translate(529px, 654px);"></div>
	  <div class="mouse-cursor cursor-inner" style="visibility: visible; transform: translate(529px, 654px);"></div>
	  <!-- START PRELOADER -->
		<section class="loading-container">
			<div class="Shape_7">
				<span></span>
				<span></span>
			</div>
		</section>
		<header>
			<div id="header_sticky_2" class="mainmenu_area_2">
				<div class="logo-area">
				</div>	
				<button aria-label='Toggle menu' class='nav-button button-lines button-lines-x close' role='button' type='button'>
				  <span class='lines'>
				  </span>
				</button>
			</div>
		</header>
		<nav class="demo-black nav-wrapper mainmenu">
			<ul class="nav">
				<li><a href="logout.php">Cerrar Sesion</a></li>
						
			</ul>
		</nav>
		<!-- END HEADER -->
		<!-- START BANNER -->
		<section id="home">
			<div class="slider-area demo-banner">
				<div class="slider-wrapper vh d-flex">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-6">
								<div class="demo-content text-left">
									<h1><span>¡Bienvenido a HokWorks,</span><br /><?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
									<p>Has iniciado sesión correctamente. Dentro de esta pagina es solo una muestra de las funcionalidades disponibles.

										Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel porro nostrum maiores doloribus quos cumque ab minima molestias qui rem, ut aliquam laudantium at amet aut atque quibusdam saepe error?
									
									</p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="banner-images" style="background-image:url(../img/bg3.jpg)">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- END BANNER -->
		
		<!-- START FOOTER -->
		<div class="section-footer">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="footer-info-wrapper">
							<div class="copyright">
								<p>Copyright ©2026 by hokashiro.com.</a> All Rights Reserved</p>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<!-- END FOOTER -->
		
		<script src="../js/vendor/modernizr-3.6.0.min.js"></script>
		<script src="../js/vendor/jquery-3.5.1.min.js"></script>		  	  
		<script src="../js/jquery.counterup.min.js"></script>
		<script src="../js/jquery.scrollUp.min.js"></script>
		<script src="../js/scrollreveal.min.js"></script>			
		<script src="../js/waypoints.min.js"></script>		 		 
		<script src="../js/bootstrap.min.js"></script> 	  
		<script src="../js/jquery.sticky-sidebar.min.js"></script> 	  
		<script src="../js/jquery.slicknav.min.js"></script>
		<script src="../js/smooth-scrollbar.js"></script>
		<script src="../js/fancyBox v2.1.5.js"></script>
		<script src="../js/swiper.min.js"></script>			
		<script src="../js/owl.carousel.min.js"></script>			
		<script src="../js/cekko-main.js"></script>
		<script src="../js/isotope.pkgd.min.js"></script>
		<script src="../js/imagesloaded.pkgd.min.js"></script>
		<script src="../js/plugins.js"></script>
		  
	</body>

</html>
