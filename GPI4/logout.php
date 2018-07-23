<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cerrando Sesión</title>
</head>
<body>
<?php
	mysqli_close($conexion);
	@session_start();
	session_destroy();
	header("Location: login.php");
?>
</body>
</html>