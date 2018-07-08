<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="../logoGPI.png" type="image/x-icon">
	<title>Ingresando solicitud ...</title>
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
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="../index.php"><img src="../logoGPI.png" alt="logo" style="width:80px;"></a>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav mx-auto">
	     <li class="nav-link"><a href="../index.php">Inicio</a></li>
        <li>
			<a class="nav-link">Usuario: <?php echo "$solicitador  " ?></a>
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
				<table class="table table-hover">
					<thead class="thead-dark"><tr><th>Descripción</th><th>Cantidad</th><th>Estado</th></tr>
					</thead>
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
	
    </div>
  </div>
</div>

</body>
</html>