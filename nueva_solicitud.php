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
	mysqli_close($conexion);
?>
</body>
</html>