<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="logoGPI.png" type="image/x-icon">
	<title>Solicitudes Actuales</title>
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" type = "text/css"/>
	<meta name="viewport" content = "width=device-width, initial-scale=1.0">
	<style type="text/css">
			html,
			body {
			  height:100%
			}
	</style>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
        
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
  </style>
</head>
<body>
<?php
	session_start();
	if(empty($_SESSION['username'])){
		header('Location: login.php');
	}
	$conexion = new mysqli("localhost", "root", "", "gpi");
	$usuario = $_SESSION['username'];
	$area = $_SESSION['area'];
	if ($area=='obras'){
		$obra = $_SESSION['obra'];
	}
	$sql = "SELECT * FROM solicitud";
	$result = $conexion->query($sql);
?>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href=index.php><img src="logoGPI.png" alt="logo" style="width:80px;"></a>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav mx-auto">
	     <li class="nav-link"><a href=index.php>Inicio</a></li>
        <li>
			<a class="nav-link">Usuario: <?php echo "$usuario  " ?></a>
		</li>
        <li class="nav-item">
			<a class="nav-link">Área: <?php echo "$area  " ?></a>
		</li>
        <li class="nav-item">
			<a class="nav-link"><?php if( $area == 'obras') echo "Obra Actual: $obra  " ?></a>
		</li>
	</ul>
	<ul class="nav navbar-nav pull-sm-right">
		<li class="nav-item">
			<a href=logout.php> Cerrar Sesión</a>
		</li>
    </ul>
  </div>  
</nav>

<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <p><a>Menú</a></p>
	  <p><a href="todas_las_solicitudes.php">Todas las solicitudes</a></p>
				<?php if( $area == 'obras')
					echo "<p> <a href=obras/nueva_solicitud.php> Nueva Solicitud</a> </p>
						  <p> <a href=obras/mis_solicitudes.php> Solicitudes de la Obra</a> </p>" ?>					
				<?php if( $area == 'bodega')
					echo "<p> <a href=bodega/solicitudes_pendientes.php> Solicitudes Pendientes</a> </p>
						  <p> <a href=bodega/solicitudes_reservadas.php> Solicitudes Reservadas</a> </p>
						  <p> <a href=bodega/orden_de_compra.php> Nueva Orden de Compra</a> </p>" ?>
    </div>
    <div class="col-sm-8 mx-auto"> 
				<h2>Lista de Solicitudes</h2>
				<div class="table-responsive">
				<table  class="table table-hover">
				<thead class="thead-dark">
				<tr><th>N°Soliciud</th><th>Obra</th><th>Fecha emisión</th><th>Solicitado por</th><th>estado</th></tr>
				</thead>
				<tbody>
				<?php while ($row = mysqli_fetch_assoc($result)){
					$numero = $row['numero'];
					$fecha = $row['fecha'];
					$solicitador = $row['solicitador'];
					$estado = $row['estado'];
					$obra2 = $row['obra'];
					echo "<tr><td>$numero</td><td>$obra2</td><td>$fecha</td><td>$solicitador</td><td>$estado</td></tr>";
				}?>
				</tbody>
				</table>
				</div>
			<p>
			<div class="container">
				<?php $result = $conexion->query($sql);?>
				<form  method='post' action='todas_las_solicitudes.php' class="form">
					<label>Seleccione una Solicitud:</label><select class="custom-select" name='solicitud'>
					<?php while ($row = mysqli_fetch_assoc($result)){
						$numero = $row['numero'];
						echo "<option value='$numero'>$numero</option>";
					}?>
					</select>
					<br></br>
					<input type='submit' class="btn btn-primary" name='Submit' value='Ver Materiales'>
				</form>
			</div>
			</p>
			<article>
				<h2>Materiales de la solicitud seleccionada</h2>
				<?php if(!empty($_POST['solicitud'])){
					$numero = $_POST['solicitud'];
					echo "<strong>Solicitud </strong>$numero";
					$sql = "SELECT * FROM productos_solicitados WHERE nro_solicitud = '$numero'";
					$result = $conexion->query($sql);//Aca estan todos los materiales asociados a una solicitud elegida
					echo "<table class='table table-hover'>";
						echo "<thead class='thead-light'><tr><th>ID</th><th>Descripción</th><th>Cantidad</th><th>Unidades</th><th>Estado</th></tr></thead><tbody>";
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
					echo "</tbody></table>";
				}?>
			</article>
    </div>
  </div>
</div>

	<?php mysqli_close($conexion) ?>
	
</body>
</html>