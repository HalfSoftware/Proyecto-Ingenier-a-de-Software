<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>


<?php
	session_start();
	if(empty($_SESSION['username'])){
		header('Location: login.php');
	}
	$_SESSION['arreglo']=array();
	header('Location: ../obras/nueva_solicitud.php');
	mysqli_close($conexion);
?>
</body>
</html>