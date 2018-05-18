<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Ingresando solicitud ...</title>
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
	
	// Ingresa lso metadatos de la nueva solicitud asociando el numero correspondiente
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
	$solicitador=$_SESSION['username'];
	$obra=$_SESSION['obra'];
	$sql="INSERT INTO solicitud(numero, solicitador, obra) VALUES ('$next','$solicitador','$obra')";
	$result = $conexion->query($sql);
	$sql="UPDATE solicitud SET number='$nnext' WHERE numero = 'SL1'";
	$result = $conexion->query($sql);
	
	//Ingresa cada uno de los productos de la lista asociada a la solicitud
	$arreglo=$_SESSION['arreglo'];
	foreach ($arreglo as $producto){
		$sql="SELECT * FROM productos WHERE id='$producto[0]'";
		$result = $conexion->query($sql);
		$row= mysqli_fetch_assoc($result);
		$id=$row["id"];
		$precio=$row["precio"]*$producto[1];
		$cantidad=$producto[1];
		$sql="INSERT INTO lista_solicitados(id_producto, numero_solicitud, cantidad, precio ) VALUES ('$id','$next','$cantidad','$precio')";
		$result = $conexion->query($sql);
	}
	mysqli_close($conexion);
	header('Location:obras.php');	
?>
</body>
</html>