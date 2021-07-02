<?php
	include("../config.php");
	
	try {
		$sql ="";
		$sql .= "UPDATE Productos set ";
		$id_tienda = mysqli_real_escape_string($con,(strip_tags($_POST["id_tienda"],ENT_QUOTES)));//Escanpando caracteres
		$sql .= " id_tienda = $id_tienda";		
		$nombre	= mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));//Escanpando caracteres
		$sql .= " ,nombre='$nombre'";			
		$descripcion = mysqli_real_escape_string($con,(strip_tags($_POST["descripcion"],ENT_QUOTES)));//Escanpando caracteres 
		$sql .= " ,descripcion='$descripcion'";
		$precio	= mysqli_real_escape_string($con,(strip_tags($_POST["precio"],ENT_QUOTES)));//Escanpando caracteres 
		$sql .= " ,precio=$precio";
		$tipo_producto = mysqli_real_escape_string($con,(strip_tags($_POST["tipo_producto"],ENT_QUOTES)));//Escanpando caracteres 
		$sql .= " ,tipo_producto='$tipo_producto'";
		
		if ($tipo_producto === "No Comestible"){
			$ancho = mysqli_real_escape_string($con,(strip_tags($_POST["ancho"],ENT_QUOTES)));//Escanpando caracteres 
			$sql .= " ,ancho=$ancho";
			
			$largo = mysqli_real_escape_string($con,(strip_tags($_POST["largo"],ENT_QUOTES)));//Escanpando caracteres 
			$sql .= " ,largo=$largo";
			$alto = mysqli_real_escape_string($con,(strip_tags($_POST["alto"],ENT_QUOTES)));//Escanpando caracteres 
			$sql .= " ,alto=$alto";
			$peso = mysqli_real_escape_string($con,(strip_tags($_POST["peso"],ENT_QUOTES)));//Escanpando caracteres 
			$sql .= " ,peso=$peso";

			
			
		}		
		else{
			$fecha_expiracion = mysqli_real_escape_string($con,(strip_tags($_POST["fecha_expiracion"],ENT_QUOTES)));

			$sql .= ",fecha_expiracion='$fecha_expiracion'";

			$categoria = mysqli_real_escape_string($con,(strip_tags($_POST["categoria"],ENT_QUOTES)));
			$sql .= ",categoria='$categoria'";
			if ($categoria === "Congelados"){
				$peso = mysqli_real_escape_string($con,(strip_tags($_POST["peso"],ENT_QUOTES)));
				$sql .= ",peso=$peso";
			}
			else if ($categoria === "frescos"){
				$tiempo_sin_refrigeracion = mysqli_real_escape_string($con,(strip_tags($_POST["tiempo_sin_refrigeracion"],ENT_QUOTES)));
				$sql .= ",tiempo_sin_refrigeracion=$tiempo_sin_refrigeracion";
			}
			else{
				$metodo_conservacion = mysqli_real_escape_string($con,(strip_tags($_POST["metodo_conservacion"],ENT_QUOTES)));
				$sql .= ",metodo_conservacion='$metodo_conservacion'";
			}
		}

		$id_producto = mysqli_real_escape_string($con,(strip_tags($_POST["id_producto"],ENT_QUOTES)));//Escanpando caracteres
		$sql .= " WHERE id= $id_producto ";
		
		$update = mysqli_query($con, $sql) or die(mysqli_error());
		
		if($update){
			$response = 1; //'Datos Correctos';
		}else{
			$response= 2; // Error, no se pudo guardar los datos.
		}
		

		
		
	} catch (Exception $e) {		
		echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		exit;
	}

	echo $response;
?>			
