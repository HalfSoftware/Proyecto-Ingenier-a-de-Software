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
  <title>Generador de solicitudes GPI</title>
  <link rel="stylesheet" href="assets/et-line-font-plugin/style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons-bold/mobirise-icons-bold.css">
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
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
	if(empty($_SESSION['username'])){
		header('Location: login.php');
	}	
	$conexion = new mysqli("localhost", "root", "", "gpi");
	$usuario=$_SESSION['username'];
	$sql = "SELECT * FROM personal WHERE nombre = '$usuario'";
	$result = $conexion->query($sql);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	$area = $row['area'];
	$_SESSION['area'] = $area;
	if( $area == 'obras'){
		$_SESSION['obra'] = $row['obra'];
		$obra = $row['obra'];
		$_SESSION['arreglo']=array();//Útil para nueva solicitud.
	}
	$sql = "SELECT COUNT(*) FROM solicitud";
	$result = $conexion->query($sql)or die("No puedo realizar la consulta");
	$cantidad_solicitudes = mysqli_fetch_row($result)[0];
	
	$sql = "SELECT COUNT(*) FROM solicitud WHERE estado = 'pendiente'";
	$result = $conexion->query($sql)or die("No puedo realizar la consulta");
	$cantidad_solicitudes_pedientes = mysqli_fetch_row($result)[0];
	
	$sql = "SELECT COUNT(*) FROM solicitud WHERE solicitador = '$usuario'";
	$result = $conexion->query($sql)or die("No puedo realizar la consulta");
	$cantidad_solicitudes_usuario = mysqli_fetch_row($result)[0];
	
	$sql = "SELECT COUNT(*) FROM obra WHERE estado = 'activa'";
	$result = $conexion->query($sql)or die("No puedo realizar la consulta");
	$obras_activas = mysqli_fetch_row($result)[0];
	
	$sql = "SELECT COUNT(*) FROM productos";
	$result = $conexion->query($sql)or die("No puedo realizar la consulta");
	$cantidad_productos = mysqli_fetch_row($result)[0];
	
?>
  <section id="ext_menu-6" data-rv-view="49">

    <nav class="navbar navbar-dropdown navbar-fixed-top">
        <div class="container">

            <div class="mbr-table">
                <div class="mbr-table-cell">

                    <div class="navbar-brand">
                        <a href="index.php" class="navbar-logo"><img src="assets/images/logogpi-158x128.png" alt="Mobirise"></a>
                        <a class="navbar-caption" >&nbsp; &nbsp; &nbsp; &nbsp;  USUARIO: <?php echo"$usuario" ?></a>
                    </div>                    
                </div>
                <div class="mbr-table-cell">

                    <button class="navbar-toggler pull-xs-right hidden-md-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="hamburger-icon"></div>
                    </button>

                    <ul class="nav-dropdown collapse pull-xs-right nav navbar-nav navbar-toggleable-sm" id="exCollapsingNavbar">
                    	<li class="nav-item"><a class="nav-link link" href="index.php">INICIO<br></a></li>
                    	<li class="nav-item"><a class="nav-link link" href="todas_las_solicitudes.php">TODAS LAS SOLICITUDES<br></a></li>
                    	<?php if( $area == 'obras'){
                    	echo '<li class="nav-item"><a class="nav-link link" href="obras/nueva_solicitud.php">NUEVA SOLICITUD</a></li>';
						echo '<li class="nav-item"><a class="nav-link link" href="obras/mis_solicitudes.php">MIS SOLICITUDES</a></li>';
						}if( $area == 'bodega'){
						echo '<li class="nav-item"><a class="nav-link link" href="bodega/reservar_solicitudes.php">SOLICITUDES PENDIENTES</a></li>';
						echo '<li class="nav-item"><a class="nav-link link" href="bodega/solicitudes_reservadas.php">SOLICITUDES RESERVADAS</a></li>';
						}?>
                   		<li class="nav-item nav-btn"><a class="nav-link btn btn-info-outline btn-info" href="logout.php">CERRAR SESIÓN</a></li></ul>
                    <button hidden="" class="navbar-toggler navbar-close" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="close-icon"></div>
                    </button>

                </div>
            </div>

        </div>
    </nav>

</section>

<section class="engine"><a href="https://mobiri.se/t">free amp template</a></section><section class="mbr-section mbr-section__container article mbr-after-navbar" id="header3-2" data-rv-view="40" style="background-color: rgb(239, 239, 239); padding-top: 20px; padding-bottom: 20px;">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3 class="mbr-section-title display-2"><br><br>Generador de Solicitudes GPI</h3>
                <small class="mbr-section-subtitle">Resumen de datos dinámicos de la base de datos:</small>
            </div>
        </div>
    </div>
</section>

<section class="mbr-cards mbr-section mbr-section-nopadding" id="features7-3" data-rv-view="42" style="background-color: rgb(239, 239, 239);">

    

    <div class="mbr-cards-row row">
        <div class="mbr-cards-col col-xs-12 col-lg-3" style="padding-top: 40px; padding-bottom: 80px;">
            <div class="container">
                <div class="card cart-block">
                    <div class="card-img iconbox"><a  class="mbri-pages mbr-iconfont mbr-iconfont-features7" style="color: rgb(255, 255, 255);"></a></div>
                    <div class="card-block">
                        <h4 class="card-title">Solicitudes de Materiales</h4>
                        
                        <p class="card-text">Se muestran las solicitudes totales generadas en distintios estados.&nbsp;<br>Totales:&nbsp;<strong><?php echo"$cantidad_solicitudes" ?></strong></p>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="mbr-cards-col col-xs-12 col-lg-3" style="padding-top: 40px; padding-bottom: 80px;">
            <div class="container">
                <div class="card cart-block">
                    <div class="card-img iconbox"><a  class="mbri-edit mbr-iconfont mbr-iconfont-features7" style="color: rgb(255, 255, 255);"></a></div>
                    <div class="card-block">
                        <h4 class="card-title">Solicitudes Pendientes</h4>
                        
                        <p class="card-text">Se muestran las solicitudes que no han sido revisadas de todas las obras.<br>Pendientes:  <strong><?php echo"$cantidad_solicitudes_pedientes" ?></strong></p>
                        
                    </div>
                </div>
          </div>
        </div>
        <div class="mbr-cards-col col-xs-12 col-lg-3" style="padding-top: 40px; padding-bottom: 80px;">
            <div class="container">
                <div class="card cart-block">
                    <div class="card-img iconbox"><a  class="mbri-setting mbr-iconfont mbr-iconfont-features7" style="color: rgb(255, 255, 255);"></a></div>
                    <div class="card-block">
                        <h4 class="card-title">Obras Activas</h4>
                        
                        <p class="card-text">Se muestran las obras que <br>actualmente estan en desarrollo.<br>Totales: <strong><?php echo"$obras_activas" ?></strong></p>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="mbr-cards-col col-xs-12 col-lg-3" style="padding-top: 40px; padding-bottom: 80px;">
            <div class="container">
                <div class="card cart-block">
                    <div class="card-img iconbox"><a  class="mbrib-setting3 mbr-iconfont mbr-iconfont-features7" style="color: rgb(255, 255, 255);"></a></div>
                    <div class="card-block">
                        <h4 class="card-title">Materiales Distintos</h4>
                        
                        <p class="card-text">Se muestran la cantidad de los tipos<br> de materiales y herramientas:<br>Tipos: <strong><?php echo"$cantidad_productos" ?></strong></p>
                        
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>
</section>

<section class="mbr-section mbr-section-md-padding mbr-footer footer1" id="contacts1-8" data-rv-view="45" style="background-color: rgb(46, 46, 46); padding-top: 15px; padding-bottom: 5px;">
    
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

<footer class="mbr-small-footer mbr-section mbr-section-nopadding" id="footer1-5" data-rv-view="47" style="background-color: rgb(46, 46, 46); padding-top: 1.75rem; padding-bottom: 1.25rem;">
    
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
  <script src="assets/smooth-scroll/smooth-scroll.js"></script>
  <script src="assets/theme/js/script.js"></script>
  
  
  <input name="animation" type="hidden">
  <?php mysqli_close($conexion);?>
  </body>
</html>