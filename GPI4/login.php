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
	
	$conexion = new mysqli("localhost", "root", "", "gpi");
	if ($conexion->connect_error) {
		echo "No es posible conectarse a la base de datos de GPI";
		die("La conexion falló: " . $conexion->connect_error);
	}
	?>
  <section id="ext_menu-d" data-rv-view="20">

    <nav class="navbar navbar-dropdown navbar-fixed-top">
        <div class="container">

            <div class="mbr-table">
                <div class="mbr-table-cell">

                    <div class="navbar-brand">
                        <a href="index.php" class="navbar-logo"><img src="assets/images/logogpi-158x128.png" alt="Mobirise"></a>
                    </div>

                </div>
                <div class="mbr-table-cell">

                    <button class="navbar-toggler pull-xs-right hidden-md-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="hamburger-icon"></div>
                    </button>

                    <button hidden="" class="navbar-toggler navbar-close" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="close-icon"></div>
                    </button>

                </div>
            </div>

        </div>
    </nav>

</section>

<section class="engine"><a href="https://mobiri.se/u">bootstrap website templates</a></section><section class="mbr-section form1 mbr-parallax-background mbr-after-navbar" id="form1-i" data-rv-view="52" style="background-image: url(assets/images/fondo-login3-1300x866.jpg); padding-top: 120px; padding-bottom: 120px;">
    
    <div class="mbr-section mbr-section__container mbr-section__container--middle">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-xs-center">
                    <br><h3 class="mbr-section-title display-2">Inicio de Sesión&nbsp;</h3>
                    <small class="mbr-section-subtitle">Ingrese sus datos para acceder al generador de solicitudes GPI</small>
                </div>
            </div>
        </div>
    </div>
    <div class="mbr-section mbr-section-nopadding">
        <div class="container">
            <div class="row">
                   <style>.login{margin-left: 26%; text-align: center}</style>
                    <form action="login.php" method="post" class="login" >          
                        <div class="row row-sm-offset">

                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
									
                                    <label class="form-control-label"  for="form1-i-name"><strong >Nombre de usuario</strong>&nbsp;&nbsp;</label>
                                    <input type="text" name="username"  required="">
                                </div>
                            </div>
						</div>
						<div class="row row-sm-offset">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Contraseña</strong>&nbsp;&nbsp;&nbsp;</label>
                                    <input type="password"  name="password" required="" >
                                </div>
                            </div>
                        </div>
						<style>.boton {margin-right: 40% ; text-align: center}</style>
                        <div class="boton" ><button type="submit" name="Submit" class="btn btn-primary" >ENVIAR<br></button></div>
                    </form><br><br>
            </div>
        </div>
    </div>
</section>
<?php 
	if(!empty($_POST['username']) and !empty($_POST['password'])){
		echo "aca";
		$username = $_POST['username'];
		$password = $_POST['password'];
		$sql = "SELECT * FROM personal WHERE nombre = '$username'";
		$result = $conexion->query($sql);
		if ($result->num_rows > 0) {    
			$row = $result->fetch_array(MYSQLI_ASSOC);
			if ( $password == $row['password'] ) {
				session_start();
				$_SESSION['loggedin'] = true;
				$_SESSION['username'] = $username;
				$_SESSION['start'] = time();
				$_SESSION['expire'] = $_SESSION['start'] + (20 * 60);
				$area=$row['area'];
				if( $area == 'administracion'){
					header('Location: admin/menu.php');
				}
				else{
					header('Location: index.php');
				}
			}
			else{
				echo "<br><p><strong>La contraseña no es correcta</strong></p>";	
			}
		}
		else{
			echo "<br><p><strong>El usuario no es correcto</strong></p>";
		}
	}
	mysqli_close($conexion);
?>
<footer class="mbr-small-footer mbr-section mbr-section-nopadding" id="footer1-c" data-rv-view="18" style="background-color: rgb(23, 9, 54); padding-top: 0.875rem; padding-bottom: 0.875rem;">
    
    <div class="container text-xs-center">
        <p>Copyright (c) 2018 <em>Half-Software</em>.</p>
    </div>
</footer>


  <script src="assets/web/assets/jquery/jquery.min.js"></script>
  <script src="assets/tether/tether.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/jarallax/jarallax.js"></script>
  <script src="assets/smooth-scroll/smooth-scroll.js"></script>
  <script src="assets/viewport-checker/jquery.viewportchecker.js"></script>
  <script src="assets/dropdown/js/script.min.js"></script>
  <script src="assets/touch-swipe/jquery.touch-swipe.min.js"></script>
  <script src="assets/theme/js/script.js"></script>
  <script src="assets/formoid/formoid.min.js"></script>
  
  
  <input name="animation" type="hidden">
  </body>
</html>