<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="../logoGPI.png" type="image/x-icon">
	<title>Nueva Solicitud</title>
			<link rel="stylesheet" href="../assets/css/bootstrap.min.css" type = "text/css"/>
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
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="../index.php"><img src="../logoGPI.png" alt="logo" style="width:80px;"></a>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav mx-auto">
	     <li class="nav-link"><a href="../index.php">Inicio</a></li>
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
			<a href="../logout.php"> Cerrar Sesión</a>
		</li>
    </ul>
  </div>  
</nav>

<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <p><a>Menú</a></p>
	  <p><a href="../todas_las_solicitudes.php">Todas las solicitudes</a></p>
				<?php if( $area == 'obras')
					echo "<p> <a href=../obras/nueva_solicitud.php> Nueva Solicitud</a> </p>
						  <p> <a href=../obras/mis_solicitudes.php> Solicitudes de la Obra</a> </p>" ?>					
				<?php if( $area == 'bodega')
					echo "<p> <a href=../bodega/solicitudes_pendientes.php> Solicitudes Pendientes</a> </p>
						  <p> <a href=../bodega/solicitudes_reservadas.php> Solicitudes Reservadas</a> </p>
						  <p> <a href=../bodega/orden_de_compra.php> Nueva Orden de Compra</a> </p>" ?>
    </div>
    <div class="col-sm-8 mx-auto"> 

				<form action="nueva_solicitud.php" method="post" class="form"><table align="center">
				<tr>
					<td>Agregar un material:</td>
					<td><select class="custom-select form-control" name='producto' id='producto'>"
					<?php while ($row = mysqli_fetch_assoc($result)){
						$nombre = $row['descripcion'];
						$id = $row['id'];
						$uni = $row['unidad'];
						echo "<option value='$id'>ID: $id - $nombre  - $uni</option>";
						} ?></select></td>
    			</tr>
				
    			<tr>
    				<td><label>Cantidad: </label></td>
    				<td><input type='number' class="form-control" name='cantidad' id='cantidad' min=0 required placeholder="Ingrese la cantidad"></td>
    			</tr>
				</table>
				<br>
    		
    				<td><input type='submit' class="btn btn-primary" name='Submit' value='Agregar'></td>

			</form>
				<table align="center" class="table table-hover"><?php
				if(!empty($_POST['producto'])){
					$eleccion = $_POST['producto'];
					$cantidad = $_POST['cantidad'];
					$temparray = $_SESSION['arreglo'];
					$producto = array($eleccion,$cantidad);
					array_push($temparray,$producto);
					$_SESSION['arreglo'] = $temparray;
					echo '<thead class="thead-light"><tr><th>ID</th><th>Descripción</th><th>Cantidad</th><th>Unidades</th></tr></thead>';
					foreach ($temparray as $producto){
						$sql="SELECT * FROM productos WHERE id='$producto[0]'";
						$result = $conexion->query($sql);
						$row= mysqli_fetch_assoc($result);
						$id = $row["id"];
						$descripcion = $row["descripcion"];
						$unidad = $row["unidad"];
						echo "<tr><td>$id</td><td>$descripcion</td><td>$producto[1]</td><td>$unidad</td></tr>";
					}
				}
				?>
				<tr><td><a href='agregar_solicitud.php'>Ingresar Solicitud de Materiales</a></td></tr>
				</table>
	
    </div>
  </div>
</div>

	
<?php mysqli_close($conexion) ?>
</body>
</html>