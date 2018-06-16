<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Administrador de Solicitudes</title>
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
	$usuario=$_SESSION['username'];
	echo "Bienvenido! " . $_SESSION['username']."<br>";	
	echo "<br><br><a href=solicitudes_pendientes.php>Solicitudes Pendientes</a>";
	echo "<br><br><a href=solicitudes_reservadas.php>Solicitudes Reservadas</a>";
	echo "<br><br><a href=orden_de_compra.php>Nueva Orden de Compra</a>";		
	echo "<br><br><a href=logout.php>Cerrar Sesión</a>";
	mysqli_close($conexion);
?>


</body>
</html>