<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Solicitudes Actuales</title>
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
	
	//Mostrar todas las solicitudes asociadas a la obra del usuario
	$obra=$_SESSION['obra'];
	$sql = "SELECT * FROM solicitud WHERE obra = '$obra'";
	$result = $conexion->query($sql);
	echo "<table align=center border=1>";
	echo "<tr><td>N°Soliciud</td><td>Obra</td><td>Fecha emisión</td><td>Solicitado por</td><td>estado</td></tr>";
    while ($row = mysqli_fetch_assoc($result)){
		$numero=$row['numero'];
		$fecha=$row['fecha'];
		$solicitador=$row['solicitador'];
		$estado=$row['estado'];
		echo "<tr><td>$numero</td><td>$obra</td><td>$fecha</td><td>$solicitador</td><td>$estado</td></tr>";
	}
	echo "</table>";
	
	//Mostrar materiales asosciado a una solicitud seleccionada
	$sql = "SELECT * FROM solicitud WHERE obra = '$obra'";
	$result = $conexion->query($sql);
	echo "<br><br><form  method='post' action='lista_solicitudes.php' align='center'>";
	echo "<table align=center><tr><td>Seleccione una Solicitud:</td><td><select name='solicitud'>";
    while ($row = mysqli_fetch_assoc($result)){
		$numero=$row['numero'];
    	echo "<option value='$numero'>$numero</option>";
    }
	echo "</select></td></tr>";
	echo "<tr><td><input type='submit' name='Submit' value='Ver Materiales'></td></tr>";
	echo "</table></form><br>";
	
	if(!empty($_POST['solicitud'])){
		$numero = $_POST['solicitud'];
		$sql = "SELECT * FROM lista_solicitados WHERE numero_solicitud = '$numero'";
		$result = $conexion->query($sql);//Aca estan todos los materiales asociados a una solicitud elegida
		echo '<table align="center" border="2">';
		echo '<tr><td>ID</td><td>Descripción</td><td>Cantidad</td><td>Unidades</td><td>Certificado</td></tr>';
		while ($row = mysqli_fetch_assoc($result)){
			$id_producto=$row['id_producto'];
			$cantidad=$row['cantidad'];
			$sql2 = "SELECT * FROM productos WHERE id = '$id_producto'";
			$result2 = $conexion->query($sql2);//Aca estan los datos asociado a UN material
    		$row2 = mysqli_fetch_assoc($result2);
			$descripcion=$row2['descripcion'];
			$unidad=$row2['unidad'];
			$certificado=$row2['certificado'];
			echo "<tr><td>$id_producto</td><td>$descripcion</td><td>$unidad</td><td>$cantidad</td><td>$certificado</td></tr>";
    	}		
		echo '</table>';
	}
	
	
	echo "<br><br><br><a  href=obras.php>Volver al Menú</a>";
	
	mysqli_close($conexion);
?>
</body>
</html>