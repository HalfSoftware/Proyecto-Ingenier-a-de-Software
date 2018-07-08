<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="logoGPI.png" type="image/x-icon">
<title>Genarador de Solicitudes GPI</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type = "text/css"/>
<meta name="viewport" content = "width=device-width, initial-scale=1.0">
<style type="text/css">
		html,
		body {
		  height:100%
		}
</style>
<link href="floating-labels.css" rel="stylesheet">
</head>

<body>
<form action="login.php" class="form-signin" method="post" >
<div class="text-center mb-4">
        <img class="mb-4" src="logoGPI.png" alt="" width="80" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Gestion de Procesos Industriales</h1>
      </div>
<hr>
<label>Nombre:</label><br>
<div class="form-label-group">
	<input name="username" type="text" id="username" class="form-control" required> 
	<label for="username">Nombre Usuario</label>
</div>
	<label>Contraseña:</label><br>
<div class="form-label-group">
	<input name="password" type="password" id="password" class="form-control" required>
	<label for="password">Contraseña</label>
</div>
	<br><br>
	<button class="btn btn-lg btn-primary btn-block" type="submit" name="Submit" value="Entrar">Entrar</button>
</form>
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