<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="logoGPI.png" type="image/x-icon">
	<title>Ingresando solicitud ...</title>
</head>
<body>
<?php
	session_start();
	if((empty($_SESSION['username'])) or ($_SESSION['area']!='obras')){
		header('Location: login.php');
	}
	$conexion = new mysqli("localhost", "root", "", "gpi");
	$solicitador = $_SESSION['username'];
	$area = $_SESSION['area'];
	$obra = $_SESSION['obra'];
	
	// Ingresa los metadatos de la nueva solicitud asociando el numero correspondiente
	$sql="SELECT number FROM solicitud WHERE numero='SL1'";
	$result = $conexion->query($sql);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	if (!empty($row)){
		$nnext=$row['number']+1;
	}
	else{
		$nnext=1;
	}
	$next="SL".$nnext;
	$sql="INSERT INTO solicitud(numero, solicitador, obra) VALUES ('$next','$solicitador','$obra')";
	$result = $conexion->query($sql);
	$sql="UPDATE solicitud SET number='$nnext' WHERE numero = 'SL1'";
	$result = $conexion->query($sql);
?>		
	<header>
		Usuario conectado: <?php echo "$solicitador" ?> &nbsp&nbsp&nbsp Área: <?php echo "$area" ?> &nbsp&nbsp&nbsp 
		<?php if( $area == 'obras') echo "Obra Actual: $obra" ?>
	</header>
	
	<section class="wrapper">
		<section class="main">
			<articule>
				Se creado una nueva solicitud con los siguientes datos:
				<ul>
				<li><strong>ID: </strong><?php echo"$next" ?></li>
				<li><strong>Solicitador: </strong><?php echo"$solicitador" ?></li>
				<li><strong>Obra: </strong><?php echo"$obra" ?></li>
				<li><strong>Estado: </strong>Pendiente</li>
				</ul>
			</articule>
			<articule>
				Materiales incluidos:
				<table class="table">
					<tr><td>Descripción</td><td>Cantidad</td><td>Estado</td></tr>
					<?php
					$arreglo = $_SESSION['arreglo'];
					foreach ($arreglo as $producto){
						$sql="SELECT * FROM productos WHERE id='$producto[0]'";
						$result = $conexion->query($sql);
						$row= mysqli_fetch_assoc($result);
						$id= $row["id"];
						$descripcion = $row["descripcion"];
						$cantidad = $producto[1];
						$sql="INSERT INTO productos_solicitados(id_producto, nro_solicitud, cantidad) VALUES ('$id','$next','$cantidad')";
						$result = $conexion->query($sql);
						echo "<tr><td> $descripcion </td><td> $cantidad </td><td> solicitado </td></tr>";
						$_SESSION['arreglo'] = array();
					}?>
					<tr><td><a href="../index.php"> Volver</a></td></tr>
				</table>
			</articule>
		</section>
		<aside class="sidebar">
			<ul>
				<h3> Menú </h3>
				<li> <a href="../index.php">Inicio</a> </li> 
				<li> <a href="../todas_las_solicitudes.php">Todas las solicitudes</a> </li> 
				<?php if( $area == 'obras')
					echo "<li> <a href=../obras/nueva_solicitud.php> Nueva Solicitud</a> </li>
						  <li> <a href=../obras/mis_solicitudes.php> Solicitudes de la Obra</a> </li>" ?>					
				<?php if( $area == 'bodega')
					echo "<li> <a href=../bodega/solicitudes_pendientes.php> Solicitudes Pendientes</a> </li>
						  <li> <a href=../bodega/solicitudes_reservadas.php> Solicitudes Reservadas</a> </li>
						  <li> <a href=../bodega/orden_de_compra.php> Nueva Orden de Compra</a> </li>" ?> 
				<li><a href=../logout.php> Cerrar Sesión</a></li>
			</ul>
		</aside>
	</section>	
</body>
</html>