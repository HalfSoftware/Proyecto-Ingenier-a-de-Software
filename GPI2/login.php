<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="logoGPI.png" type="image/x-icon">
<title>Genarador de Solicitudes GPI</title>
</head>

<body>
<h1>Login de Usuarios</h1>
<hr>
<form action="login.php" method="post" >
	<label>Nombre Usuario:</label><br>
	<input name="username" type="text" id="username" required>
	<br><br>

	<label>Contraseña:</label><br>
	<input name="password" type="password" id="password" required>
	<br><br>
	<input type="submit" name="Submit" value="Entrar">
</form>
<hr>
<?php	
	$conexion = new mysqli("localhost", "root", "", "gpi");
	if ($conexion->connect_error) {
		echo "No es posible conectarse a la base de datos de GPI";
		die("La conexion falló: " . $conexion->connect_error);
	}
	else{
		if(!empty($_POST['username']) and !empty($_POST['password'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$sql = "SELECT * FROM personal WHERE nombre = '$username'";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {    
	 			$row = $result->fetch_array(MYSQLI_ASSOC);
	 			if ( $password == $row['password'] ) {
					session_start();
	    			$_SESSION['loggedin'] = true;
	    			$_SESSION['username'] = $username;
	    			$_SESSION['start'] = time();
	    			$_SESSION['expire'] = $_SESSION['start'] + (20 * 60);
					$area=$row['area'];
					if( $area == 'administracion'){
						header('Location: admin/menu.php');
					}
					else{
						header('Location: index.php');
					}
				}
				else{
					echo "<br><strong>La contraseña no es correcta</strong>";	
				}
			}
			else{
				echo "<br><strong>El usuario no es correcto</strong>";
			}
		}
	}
	mysqli_close($conexion);
?>
</body>
</html>