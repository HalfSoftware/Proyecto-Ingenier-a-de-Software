<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Solicitudes para Obras</title>
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
	$sql = "SELECT * FROM personal WHERE nombre = '$usuario'";
	$result = $conexion->query($sql);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	$obra=$row['obra'];
	$_SESSION['obra']=$obra;
	
	$_SESSION['arreglo']=array();
	echo "<br><br><a href=nueva_solicitud.php>Nueva Solicitud</a>";	
	echo "<br><br><a href=lista_solicitudes.php>Solicitudes de la Obra</a>";
	echo "<br><br><a href=logout.php>Cerrar Sesión</a>";
	mysqli_close($conexion);
?>
</body>
</html>