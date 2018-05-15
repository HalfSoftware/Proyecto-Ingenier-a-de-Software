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
	
	
	//Consutlar todos los productos disponibles
	$sql="SELECT * FROM productos";
	$result = $conexion->query($sql);
	
	echo "<form  method='post' action='nueva_solicitud.php'>";
	echo "Seleccione un producto: <select name='producto' id='producto'>";
    while ($row = mysqli_fetch_assoc($result)){
		$nombre=$row['descripcion'];
		$id=$row['id'];
    	echo "<option value='$id'>'N° $id - $nombre'</option>";
    }
	echo "</select>";
	echo "<label>     Cantidad: </label> <input type='number' name='cantidad id='cantidad' min=0>";
	echo "<input type='submit' name='Submit' value='Agregar'>";
	echo "</form>";
	if(!empty($_POST['producto'])){
		$eleccion = $_POST['producto'];
		$temparray=$_SESSION['arreglo'];
		array_push($temparray,$eleccion);
		$_SESSION['arreglo']=$temparray;
		
		foreach ($temparray as $elegido){
			$sql="SELECT * FROM productos WHERE id='$elegido'";
			$result = $conexion->query($sql);
			$row= mysqli_fetch_assoc($result);
			echo $row['id']." ".$row['descripcion']."<br>";
		}
		
	}
	
	
	/*$sql="SELECT number FROM solicitud WHERE numero='SL1'";
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
	$result = $conexion->query($sql);*/
	mysqli_close($conexion);
?>

</body>
</html>