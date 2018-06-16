<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Agregando Orden de Compra...</title>
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
	
	$solicitud=$_POST['orden'];
	
	
	
	mysqli_close($conexion);
	header('Location:obras.php');	
?>
</body>
</html>