<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="logoGPI.png" type="image/x-icon">
	<title>Solicitudes Actuales</title>
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
	$sql = "SELECT * FROM solicitud WHERE obra = '$obra'";
	$result = $conexion->query($sql);
?>
	<header>
		Usuario conectado: <?php echo "$usuario" ?> &nbsp&nbsp&nbsp Área: <?php echo "$area" ?> &nbsp&nbsp&nbsp 
		<?php if( $area == 'obras') echo "Obra Actual: $obra" ?>
	</header>
	<section class="wrapper">
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
		<section class="main">
			<articule>
				<h3>Lista de Solicitudes para la obra del usuario</h3>
				<table  class="table">
				<tr><td>N°Soliciud</td><td>Obra</td><td>Fecha emisión</td><td>Solicitado por</td><td>estado</td></tr>
				<?php while ($row = mysqli_fetch_assoc($result)){
					$numero = $row['numero'];
					$fecha = $row['fecha'];
					$solicitador = $row['solicitador'];
					$estado = $row['estado'];
					echo "<tr><td>$numero</td><td>$obra</td><td>$fecha</td><td>$solicitador</td><td>$estado</td></tr>";
				}?>
				</table>
			</articule>
			<article>
				<?php $result = $conexion->query($sql);?>
				<form  method='post' action='mis_solicitudes.php' class="form">
					<label>Seleccione una Solicitud:</label><select name='solicitud'>
					<?php while ($row = mysqli_fetch_assoc($result)){
						$numero = $row['numero'];
						echo "<option value='$numero'>$numero</option>";
					}?>
					</select>
					<input type='submit' name='Submit' value='Ver Materiales'>
				</form>
			</article>
			<article>
				<h3>Materiales de la solicitud seleccionada</h3>
				<?php if(!empty($_POST['solicitud'])){
					$numero = $_POST['solicitud'];
					echo "<strong>Solicitud </strong>$numero";
					$sql = "SELECT * FROM productos_solicitados WHERE nro_solicitud = '$numero'";
					$result = $conexion->query($sql);//Aca estan todos los materiales asociados a una solicitud elegida
					echo "<table class='table'>";
						echo "<tr><td>ID</td><td>Descripción</td><td>Cantidad</td><td>Unidades</td><td>Estado</td></tr>";
						while ($row = mysqli_fetch_assoc($result)){
							$id_producto = $row['id_producto'];
							$cantidad = $row['cantidad'];
							$estado_p = $row['estado'];
							$sql2 = "SELECT * FROM productos WHERE id = '$id_producto'";
							$result2 = $conexion->query($sql2);//Aca estan los datos asociado a UN material
							$row2 = mysqli_fetch_assoc($result2);
							$descripcion = $row2['descripcion'];
							$unidad = $row2['unidad'];
							echo "<tr><td>$id_producto</td><td>$descripcion</td><td>$cantidad</td><td>$unidad</td><td>$estado_p</td></tr>";
						}		
					echo "</table>";
				}?>
			</article>
		</section>
	</section>

	<?php mysqli_close($conexion) ?>
	
</body>
</html>