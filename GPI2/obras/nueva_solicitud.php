<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="logoGPI.png" type="image/x-icon">
	<title>Nueva Solicitud</title>
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
	<header>
		Usuario conectado: <?php echo "$usuario" ?> &nbsp&nbsp&nbsp Área: <?php echo "$area" ?> &nbsp&nbsp&nbsp 
		<?php if( $area == 'obras') echo "Obra Actual: $obra" ?>
	</header>
	<section class="wrapper">
		<section class="main">
			<form action="nueva_solicitud.php" method="post" class="form"><table align="center">
				<tr>
					<td>Agregar un material:</td>
					<td><select name='producto' id='producto'>"
					<?php while ($row = mysqli_fetch_assoc($result)){
						$nombre = $row['descripcion'];
						$id = $row['id'];
						$uni = $row['unidad'];
						echo "<option value='$id'>ID: $id - $nombre  - $uni</option>";
						} ?></select></td>
    			</tr>
    			<tr>
    				<td><label>Cantidad: </label></td>
    				<td><input type='number' name='cantidad' id='cantidad' min=0 required placeholder="Ingrese la cantidad"></td>
    			</tr>
    			<tr>
    				<td><input type='submit' name='Submit' value='Agregar'></td>
    			</tr>
			</table></form>
			<articule>
				<table align="center" class="table"><?php
				if(!empty($_POST['producto'])){
					$eleccion = $_POST['producto'];
					$cantidad = $_POST['cantidad'];
					$temparray = $_SESSION['arreglo'];
					$producto = array($eleccion,$cantidad);
					array_push($temparray,$producto);
					$_SESSION['arreglo'] = $temparray;
					echo '<tr><td>ID</td><td>Descripción</td><td>Cantidad</td><td>Unidades</td></tr>';
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
				<tr><td><a href='agregar_solicitud.php'>Ingresar Solicitud de Materiales</a></td></tr>
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
	
<?php mysqli_close($conexion) ?>
</body>
</html>