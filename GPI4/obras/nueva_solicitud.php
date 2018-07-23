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
	if((empty($_SESSION['username'])) or ($_SESSION['area']!='obras')){
		header('Location: login.php');
	}
	$conexion = new mysqli("localhost", "root", "", "gpi");
	$usuario = $_SESSION['username'];
	$area = $_SESSION['area'];
	$obra = $_SESSION['obra'];
	//Consutlar todos los productos disponibles
	$sql="SELECT * FROM productos";
	$result = $conexion->query($sql);
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

<section class="engine"><a href="https://mobiri.se/k">how to develop your own website</a></section><section class="mbr-section mbr-section__container article mbr-after-navbar" id="header3-v" data-rv-view="87" style="background-color: rgb(239, 239, 239); padding-top: 20px; padding-bottom: 0px;">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3 class="mbr-section-title display-2"><br><br>Nueva Solicitud</h3>
                <small class="mbr-section-subtitle"><p>Seleccione los materiales y la cantidad requerida:&nbsp;&nbsp;&nbsp;&nbsp;</p></small>
            </div>
        </div>
    </div>
</section>

<section class="mbr-section form2" id="form2-12" data-rv-view="116" style="background-color: rgb(239, 239, 239); padding-top: 20px; padding-bottom: 120px;">
	<div class="mbr-section mbr-section-nopadding">
        <div class="container">
            <div class="row">
                    
                    <?php $result = $conexion->query($sql);?>
					<table><form class="mbr-form" method='post' action='nueva_solicitud.php'>
						<tr><td><label class="boton2"><br>Agregar un material:</label></td><td><select name='producto'  class="boton3">
						<?php while ($row = mysqli_fetch_assoc($result)){
							$nombre = $row['descripcion'];
							$id = $row['id'];
							$uni = $row['unidad'];
							echo "<option value='$id'>ID: $id - $nombre  - $uni</option>";
						}?></select></td></tr>
						<tr><td><label class="boton2">Cantidad: </label></td>
    					<td><input type='number' name='cantidad' id='cantidad' min=0 required placeholder="Ingrese la cantidad"></td>
							<style>.boton{margin-right: 200%;}</style>
							<style>.boton2{margin-left: 50%; column-width: 400px }</style>
							<style>.boton3{margin-left: 3	0%;}</style>
							<style>.boton4{margin-right: 3	0%;}</style>
						<td><span class="boton"><button type="submit" class="btn btn-primary">AGREGAR</button></span></td>
					</form></table>
            </div>
        </div>
    </div>       
    <div class="mbr-section mbr-section__container mbr-section__container--middle">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-xs-center">
              	<table  class="table"><?php
				if(!empty($_POST['limpiar'])){
					$_SESSION['arreglo']=array();//Útil para nueva solicitud.
				}
				if(!empty($_POST['producto'])){
					$eleccion = $_POST['producto'];
					$cantidad = $_POST['cantidad'];
					$temparray = $_SESSION['arreglo'];
					$producto = array($eleccion,$cantidad);
					array_push($temparray,$producto);
					$_SESSION['arreglo'] = $temparray;
					echo '<tr><td><strong>ID</strong></td><td><strong>Descripción</strong></td><td><strong>Cantidad</strong></td><td><strong>Unidades</strong></td></tr>';
					foreach ($temparray as $producto){
						$sql="SELECT * FROM productos WHERE id='$producto[0]'";
						$result = $conexion->query($sql);
						$row= mysqli_fetch_assoc($result);
						$id = $row["id"];
						$descripcion = $row["descripcion"];
						$unidad = $row["unidad"];
						echo "<tr><td>$id</td><td>$descripcion</td><td>$cantidad</td><td>$unidad</td></tr>";
					}
				}
				?>
				<br>
					</table>
				<table align="center">
				<tr><td><a href='agregar_solicitud.php'>Ingresar Solicitud de Materiales</a></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td><a href='limpiar_solicitud.php' class="boton">Limpiar Solicitud</a></td></tr>
				</table>      
                    
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


<footer class="mbr-small-footer mbr-section mbr-section-nopadding" id="footer1-y" data-rv-view="94" style="background-color: rgb(22, 10, 46); padding-top: 0.875rem; padding-bottom: 0.875rem;">
    
    <div class="container text-xs-center">
        <p>Copyright (c) 2018 <em>Half-Software</em>.</p>
    </div>
</footer>
  <script src="assets/web/assets/jquery/jquery.min.js"></script>
  <script src="assets/tether/tether.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/smooth-scroll/smooth-scroll.js"></script>
  <script src="assets/viewport-checker/jquery.viewportchecker.js"></script>
  <script src="assets/dropdown/js/script.min.js"></script>
  <script src="assets/touch-swipe/jquery.touch-swipe.min.js"></script>
  <script src="assets/theme/js/script.js"></script>
  <script src="assets/formoid/formoid.min.js"></script>
  
  
  <input name="animation" type="hidden">
  <?php mysqli_close($conexion);?>
  </body>
</html>