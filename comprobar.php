<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Comprobando datos</title>
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
		
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$sql = "SELECT * FROM personal WHERE nombre = '$username'";
	$result = $conexion->query($sql);
	if ($result->num_rows > 0) {    
	 }
	 $row = $result->fetch_array(MYSQLI_ASSOC);
	 if ( $password == $row['password'] ) {
	    $_SESSION['loggedin'] = true;
	    $_SESSION['username'] = $username;
	    $_SESSION['start'] = time();
	    $_SESSION['expire'] = $_SESSION['start'] + (20 * 60);
	    echo "Bienvenido! " . $_SESSION['username'];
		$area=$row['area'];
		if($area=='obras'){
			header('Location: obras.php');
		}
		elseif($area=='bodega'){
			header('Location: bodega.php');
		}
		elseif($area=='ventas'){
			echo "<br><br><a href=ordenes.php>Ordenes de Compra</a>";
			echo "<br><br><a href=modificar_ordenes.php>Actualizar Orden</a>";
		}
		elseif( $area == 'administracion'){
			header('Location: admin/menu.php');
		}
		elseif($area=='contabilidad'){
			echo "<br><br><a href=solicitudes.php>Solicitudes Pendientes</a>";
			echo "<br><br><a href=ordenes.php>Ordenes de Compra</a>";	
		}

	 } else {
		echo "Username o Password estan incorrectos.";
	   	echo "<br><a href='index.php'>Volver a Intentarlo</a>";
	 }
	 mysqli_close($conexion);
?>
</body>
</html>