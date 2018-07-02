<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="logoGPI.png" type="image/x-icon">
	<title>Generador de solicitudes GPI</title>
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
	<header>
		Usuario conectado: <?php echo "$usuario" ?> &nbsp&nbsp&nbsp Área: <?php echo "$area" ?> &nbsp&nbsp&nbsp 
		<?php if( $area == 'obras') echo "Obra Actual: $obra" ?>
		
	</header>
	<section class="wrapper">
		<section class="main">
			<articule>
				<h2> Resumen del Generador de Solicitudes</h2>
				<ul>	
					<li><strong> Cantidad de Solicitudes Actuales :</strong> <?php echo"$cantidad_solicitudes" ?></li>	
					<li><strong> Solicitudes Pendientes :</strong> <?php echo"$cantidad_solicitudes_pedientes" ?></li>
					<li><strong> Solicitudes Generadas por el Usuario :</strong> <?php echo"$cantidad_solicitudes_usuario" ?></li>
					<li><strong> Obras Activas :</strong> <?php echo"$obras_activas" ?></li>
					<li><strong> Tipos de Materiales distintos :</strong> <?php echo"$cantidad_productos" ?></li>		
				</ul>
			</articule>
		</section>
		<aside class="sidebar">
			<ul>
				<h3> Menú </h3>
				<li> <a href="index.php">Inicio</a> </li> 
				<li> <a href="todas_las_solicitudes.php">Todas las solicitudes</a> </li> 
				<?php if( $area == 'obras')
					echo "<li> <a href=obras/nueva_solicitud.php> Nueva Solicitud</a> </li>
						  <li> <a href=obras/mis_solicitudes.php> Solicitudes de la Obra</a> </li>" ?>					
				<?php if( $area == 'bodega')
					echo "<li> <a href=bodega/solicitudes_pendientes.php> Solicitudes Pendientes</a> </li>
						  <li> <a href=bodega/solicitudes_reservadas.php> Solicitudes Reservadas</a> </li>
						  <li> <a href=bodega/orden_de_compra.php> Nueva Orden de Compra</a> </li>" ?>						  
				<li><a href=logout.php> Cerrar Sesión</a></li>
			</ul>
		</aside>
	</section>	

<?php mysqli_close($conexion); ?>

</body>
</html>