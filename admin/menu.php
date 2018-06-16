<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Menú Administrador de GPI</title>
</head>
<body>
<?php
	session_start();
	$host_db = "localhost";
	$user_db = "root";
	$pass_db = "";
	$db_name = "gpi";
	$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);
	if ($conexion->connect_error) {
		die("La conexion falló: " . $conexion->connect_error);
	}
	// Menú
	echo "<br><br><a href=admin_materiales.php>Mostrar Materiales en la Base de Datos GPI</a>";
	echo "<br><br><a href=admin_pendientes>Mostrar Solicitudes Pendientes de las obras</a>";
	echo "<br><br><a href=admin_reservados>Mostrar lista de de productos reservados por solicitud</a>";
	echo "<br><br><a href=admin_compras.php>Mostrar solicitudes de compra generadas</a>";
	
	
	mysqli_close($conexion);
?>

</body>
</html>