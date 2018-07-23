<!DOCTYPE html>
<html >
<head>
  <!-- Site made with Mobirise Website Builder v4.8.1, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.8.1, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/logogpi-158x128.png" type="image/x-icon">
  <meta name="description" content="">
  <title>Generador de Solicitudes GPI</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic&subset=latin">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/animate.css/animate.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  
</head>
<body>
 <?php
	session_start();
	if((empty($_SESSION['username'])) or ($_SESSION['area']!='obras')){
		header('Location: ../login.php');
	}
	$usuario = $_SESSION['username'];
	$conexion = new mysqli("localhost", "root", "", "gpi");
	$solicitador = $_SESSION['username'];
	$area = $_SESSION['area'];
	$obra = $_SESSION['obra'];	
	
?>		

  <section id="ext_menu-6" data-rv-view="49">

    <nav class="navbar navbar-dropdown navbar-fixed-top">
        <div class="container">

            <div class="mbr-table">
                <div class="mbr-table-cell">

                    <div class="navbar-brand">
                        <a href="../index.php" class="navbar-logo"><img src="assets/images/logogpi-158x128.png" alt="Mobirise"></a>
                        <a class="navbar-caption" >&nbsp; &nbsp; &nbsp; &nbsp;  USUARIO: <?php echo"$usuario" ?></a>
                    </div>                    
                </div>
                <div class="mbr-table-cell">

                    <button class="navbar-toggler pull-xs-right hidden-md-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="hamburger-icon"></div>
                    </button>

                    <ul class="nav-dropdown collapse pull-xs-right nav navbar-nav navbar-toggleable-sm" id="exCollapsingNavbar">
                    	<li class="nav-item"><a class="nav-link link" href="../index.php">INICIO<br></a></li>
                    	<li class="nav-item"><a class="nav-link link" href="../todas_las_solicitudes.php">TODAS LAS SOLICITUDES<br></a></li>
                    	<?php if( $area == 'obras'){
                    	echo '<li class="nav-item"><a class="nav-link link" href="../obras/nueva_solicitud.php">NUEVA SOLICITUD</a></li>';
						echo '<li class="nav-item"><a class="nav-link link" href="../obras/mis_solicitudes.php">MIS SOLICITUDES</a></li>';
						}if( $area == 'bodega'){
						echo '<li class="nav-item"><a class="nav-link link" href="../bodega/reservar_solicitudes.php">SOLICITUDES PENDIENTES</a></li>';
						echo '<li class="nav-item"><a class="nav-link link" href="../bodega/solicitudes_reservadas.php">SOLICITUDES RESERVADAS</a></li>';
						}?>
                   		<li class="nav-item nav-btn"><a class="nav-link btn btn-info-outline btn-info" href="../logout.php">CERRAR SESIÓN</a></li></ul>
                    <button hidden="" class="navbar-toggler navbar-close" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="close-icon"></div>
                    </button>

                </div>
            </div>

        </div>
    </nav>

</section>


<section class="engine"><a href="https://mobiri.se/d">free site maker</a></section><section class="mbr-section mbr-parallax-background mbr-after-navbar" id="testimonials4-1d" data-rv-view="48" style="background-image: url(assets/images/fondo-login3-1300x866.jpg); padding-top: 120px; padding-bottom: 40px;">

        <div class="mbr-section mbr-section__container mbr-section__container--middle">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-xs-center">
                        <h3 class="mbr-section-title display-2"><br>No hay materiales agregados a la solicitud, inténtelo nuevamente.</h3>
                    </div>
                </div>
            </div>
        </div>
    
</section>

<section class="mbr-info mbr-info-extra mbr-section mbr-section-md-padding mbr-parallax-background" id="msg-box1-1h" data-rv-view="78" style="background-image: url(assets/images/fondo-login3-1300x866.jpg); padding-top: 30px; padding-bottom: 0px;">

    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(157, 127, 80);">
    </div>
    <div class="container">
        <div class="row">


            <div class="mbr-table-md-up">
                <div class="mbr-table-cell col-md-4">
                    <div class="text-xs-center"><a class="btn btn-primary" href="../obras/nueva_solicitud.php">VOLVER</a></div>
                </div>

                <div class="mbr-table-cell mbr-right-padding-md-up col-md-8 text-xs-center">
                    <h2 class="mbr-info-subtitle mbr-section-subtitle"></h2>
                    
                </div>

            </div>

        </div>
    </div>
</section>

<section class="mbr-section mbr-section-md-padding mbr-footer footer1" id="contacts1-16" data-rv-view="16" style="background-color: rgb(35, 35, 35); padding-top: 30px; padding-bottom: 30px;">
    
    <div class="container">
        <div class="row">
            <div class="mbr-footer-content col-xs-12 col-md-3">
                <div><span class="mbri-user mbr-iconfont mbr-iconfont-contacts1" style="color: rgb(239, 239, 239);"></span></div>
            </div>
            <div class="mbr-footer-content col-xs-12 col-md-3">
                <p><font color="#7c7c7c" face="Montserrat, sans-serif"><span style="font-size: 16px; letter-spacing: -1px;"><strong><br>Usuario:<br><?php echo"$usuario" ?></strong></span></font></p>
            </div>
            <div class="mbr-footer-content col-xs-12 col-md-3">
                <p><strong><br>Área:<br><?php echo"$area" ?></strong></p>
            </div>
            <?php if( $area == 'obras'){
            	echo "<div class='mbr-footer-content col-xs-12 col-md-3'>";
            	echo "<p><strong><br>Obra:<br>&nbsp&nbsp&nbsp$obra</p></strong>";
            	echo "</div>";
			}?>

        </div>
    </div>
</section>

<footer class="mbr-small-footer mbr-section mbr-section-nopadding" id="footer1-17" data-rv-view="18" style="background-color: rgb(22, 10, 46); padding-top: 0.875rem; padding-bottom: 0.875rem;">
    
    <div class="container text-xs-center">
        <p>Copyright (c) 2018 <em>Half-Software</em>.</p>
    </div>
</footer>


  <script src="assets/web/assets/jquery/jquery.min.js"></script>
  <script src="assets/tether/tether.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/viewport-checker/jquery.viewportchecker.js"></script>
  <script src="assets/dropdown/js/script.min.js"></script>
  <script src="assets/touch-swipe/jquery.touch-swipe.min.js"></script>
  <script src="assets/jarallax/jarallax.js"></script>
  <script src="assets/smooth-scroll/smooth-scroll.js"></script>
  <script src="assets/theme/js/script.js"></script>
  
  
  <input name="animation" type="hidden">
  <?php mysqli_close($conexion);?>
  </body>
</html>