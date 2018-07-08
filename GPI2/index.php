<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="logoGPI.png" type="image/x-icon">
	<title>Generador de solicitudes GPI</title>
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
      <articule>
				<h3> Resumen del Generador de Solicitudes</h3>
				<p>	
					<li> Cantidad de Solicitudes Actuales : <?php echo"$cantidad_solicitudes" ?></li>	
					<li> Solicitudes Pendientes : <?php echo"$cantidad_solicitudes_pedientes" ?></li>
					<li> Solicitudes Generadas por el Usuario : <?php echo"$cantidad_solicitudes_usuario" ?></li>
					<li> Obras Activas : <?php echo"$obras_activas" ?></li>
					<li> Tipos de Materiales distintos : <?php echo"$cantidad_productos" ?></li>		
				</p>
			</articule>
    </div>
	<div class="col-sm-2"> 
    </div>
  </div>
</div>
<?php mysqli_close($conexion); ?>

</body>
</html>