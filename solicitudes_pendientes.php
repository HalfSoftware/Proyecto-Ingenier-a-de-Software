<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Solicitudes pendientes</title>
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
	
	//Mostrar todas las solicitudes pendientes
	$sql = "SELECT * FROM solicitud WHERE estado = 'pendiente'";
	$result = $conexion->query($sql);
	echo "<table align=center border=1>";
	echo "<tr><td>N°Soliciud</td><td>Obra</td><td>Fecha emisión</td><td>Solicitado por</td><td>estado</td></tr>";
    while ($row = mysqli_fetch_assoc($result)){
		$numero=$row['numero'];
		$obra=$row['obra'];
		$fecha=$row['fecha'];
		$solicitador=$row['solicitador'];
		$estado=$row['estado'];
		echo "<tr><td>$numero</td><td>$obra</td><td>$fecha</td><td>$solicitador</td><td>$estado</td></tr>";
	}
	echo "</table>";
	
	//Mostrar materiales asosciado a una solicitud seleccionada
	$result = $conexion->query($sql);
	echo "<br><br><form  method='post' action='solicitudes_pendientes.php' align='center'>";
	echo "<table align=center><tr><td>Seleccione una Solicitud:</td><td><select name='solicitud'>";
    while ($row = mysqli_fetch_assoc($result)){
		$numero=$row['numero'];
    	echo "<option value='$numero'>$numero</option>";
    }
	echo "</select></td></tr>";
	echo "<tr><td><input type='submit' name='Submit' value='Ver Materiales'></td></tr>";
	echo "</table></form><br>";
	//Ingresar una nueva solicitud de compra
	$result = $conexion->query($sql);
	echo "<br><br><form  method='post' action='solicitudes_pendientes.php' align='center'>";
	echo "<table align=center><tr><td>Seleccionar una Solicitud:</td><td><select name='orden'>";
    while ($row = mysqli_fetch_assoc($result)){
		$numero=$row['numero'];
    	echo "<option value='$numero'>$numero</option>";
    }
	echo "</select></td></tr>";
	echo "<tr><td><input type='submit' name='Submit' value='Reservar elementos en bodega'></td></tr>";
	echo "</table></form><br>";
	
	if(!empty($_POST['solicitud'])){
		$numero = $_POST['solicitud'];
		$sql = "SELECT * FROM lista_solicitados WHERE numero_solicitud = '$numero'";
		$result = $conexion->query($sql);//Aca estan todos los materiales asociados a una solicitud elegida
		echo '<table align="center" border="2">';
		echo '<tr><td>ID</td><td>Descripción</td><td>Cantidad</td><td>Unidades</td><td>Certificado</td></tr>';
		while ($row = mysqli_fetch_assoc($result)){
			$id_producto=$row['id_producto'];
			$cantidad=$row['cantidad'];
			$sql2 = "SELECT * FROM productos WHERE id = '$id_producto'";
			$result2 = $conexion->query($sql2);//Aca estan los datos asociado a UN material
    		$row2 = mysqli_fetch_assoc($result2);
			$descripcion=$row2['descripcion'];
			$unidad=$row2['unidad'];
			$certificado=$row2['certificado'];
			echo "<tr><td>$id_producto</td><td>$descripcion</td><td>$unidad</td><td>$cantidad</td><td>$certificado</td></tr>";
    	}		
		echo '</table>';
	}
	
	if ( !empty($_POST['orden']) ){
		$orden = $_POST['orden'];
		$sql = "SELECT * FROM lista_solicitados WHERE numero_solicitud = '$orden'";
		$result = $conexion->query( $sql );
		
		while ($row = mysqli_fetch_assoc($result)){	//Para cada producto solicitado se comprueba si hay stock en bodega
			$cantidad_solicitada = $row['cantidad'];
			$id_solicitado = $row['id_producto'];
			$sql = "SELECT * FROM productos WHERE id = '$id_solicitado'";
			$row2 = mysqli_fetch_assoc( $conexion->query( $sql ) );
			$cantidad_existente = $row2['cantidad'];
			
			if( $cantidad_existente != 0 ){				
				if( $cantidad_solicitada > $cantidad_existente ){  //Hay materiales pero no suficientes
					$sql_insert = "INSERT INTO lista_reservados (id_producto, numero_solicitud, cantidad) VALUES ('$id_solicitado','$orden','$cantidad_existente')";
					$result_insert = $conexion->query( $sql_insert );
					$diferencia = $cantidad_solicitada - $cantidad_existente;
					$sql_update = "UPDATE lista_solicitados SET cantidad = '$diferencia' WHERE id_producto = '$id_solicitado'AND numero_solicitud = '$orden'";
					$result_update = $conexion->query( $sql_update );
					$sql_update = "UPDATE productos SET cantidad = 0 WHERE id = '$id_solicitado'";
					$result_update = $conexion->query( $sql_update );
				}
				else{//Hay materiales suficientes
					$sql_insert = "INSERT INTO lista_reservados (id_producto, numero_solicitud, cantidad) VALUES ('$id_solicitado','$orden','$cantidad_solicitada')";
					$result_insert = $conexion->query( $sql_insert );
					$diferencia = $cantidad_existente - $cantidad_solicitada;
					$sql_update = "DELETE FROM lista_solicitados WHERE id_producto = '$id_solicitado' AND numero_solicitud = '$orden'";
					$result_update = $conexion->query( $sql_update );
					$sql_update = "UPDATE productos SET cantidad = '$diferencia' WHERE id = '$id_solicitado'";
					$result_update = $conexion->query( $sql_update );
				
				}
					
			}
		}
		//Finalmente se cambia el estado de la orden
		$sql = "UPDATE solicitud SET estado = 'reservada' WHERE numero = '$orden'";
		$result_update = $conexion->query( $sql );
		
	}
	
	echo "<br><br><br><a  href=bodega.php>Volver al Menú</a>";
	
	mysqli_close($conexion);
?>


</body>
</html>