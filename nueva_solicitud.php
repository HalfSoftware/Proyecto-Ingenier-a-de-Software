<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Nueva Solicitud</title>
</head>

<body>

<?php
	session_start();
	if(empty($_SESSION['username'])){
		header('Location: index.php');
	}
	
	$host_db = "localhost";
	$user_db = "root";
	$pass_db = "";
	$db_name = "gpi";
	$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);
	
	
	//Consutlar todos los productos disponibles
	$sql="SELECT * FROM productos";
	$result = $conexion->query($sql);
	
	echo "<form  method='post' action='nueva_solicitud.php' align='center'>";
	echo "<table align=center><tr><td>Seleccione un producto:</td><td><select name='producto' id='producto'>";
    while ($row = mysqli_fetch_assoc($result)){
		$nombre=$row['descripcion'];
		$id=$row['id'];
    	echo "<option value='$id'>'N° $id - $nombre'</option>";
    }
	echo "</select></td></tr>";
	echo "<tr><td><label>Cantidad: </label></td><td><input type='number' name='cantidad' id='cantidad' min=0 required></td></tr>";
	echo "<tr><td><input type='submit' name='Submit' value='Agregar'></td></tr>";
	echo "</table></form><br>";
	if(!empty($_POST['producto'])){
		$eleccion = $_POST['producto'];
		$cantidad = $_POST['cantidad'];
		$temparray=$_SESSION['arreglo'];
		$producto=array($eleccion,$cantidad);
		array_push($temparray,$producto);
		$_SESSION['arreglo']=$temparray;
		
		echo '<table align="center" border="1">';
		echo '<tr><td>ID</td><td>Descripción</td><td>Cantidad</td><td>Unidades</td></tr>';
		foreach ($temparray as $producto){
			$sql="SELECT * FROM productos WHERE id='$producto[0]'";
			$result = $conexion->query($sql);
			$row= mysqli_fetch_assoc($result);
			$id=$row["id"];
			$descripcion=$row["descripcion"];
			$unidad=$row["unidad"];
			echo "<tr><td>$id</td><td>$descripcion</td><td>$unidad</td><td>$producto[1]</td></tr>";
			
		}
		echo '</table>';
	}
	echo "<br><a href='agregar_solicitud.php'>Ingresar Solicitud de Materiales</a>";
	
	mysqli_close($conexion);
?>

</body>
</html>