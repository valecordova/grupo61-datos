<?php
	include("../config.php");

	$response = 'Error en la inserción de usuarios';
						
	try {
		$rut		     		= mysqli_real_escape_string($con,(strip_tags($_POST["rec_rut"],ENT_QUOTES)));//Escanpando caracteres
		$nombre		    		= mysqli_real_escape_string($con,(strip_tags($_POST["rec_nombre"],ENT_QUOTES)));//Escanpando caracteres
		$edad					= mysqli_real_escape_string($con,(strip_tags($_POST["rec_edad"],ENT_QUOTES)));//Escanpando caracteres 
		$rec_Password				= mysqli_real_escape_string($con,(strip_tags($_POST["rec_Password"],ENT_QUOTES)));//Escanpando caracteres 

		$sql = "INSERT INTO Usuarios (rut, nombre, edad, clave, id_perfil) values (replace(REPLACE('$rut','-',''),'.',''),'$nombre',$edad,'$param_password',1)";
		$update = mysqli_query($con,$sql) or die(mysqli_error());
		
		if($update){
			$response = 1; //'Datos Correctos';
		}else{
			$response= 2; // Error, no se pudo guardar los datos.
		}
		
		
	} catch (Exception $e) {
		//$response 'Excepcion capturada: ',  $e->getMessage(), "\n";
		//echo 'Excepcion capturada: ',  $e->getMessage(), "\n";
		$response = 'Error en la inserción de usuarios';
	}

	echo $response;
?>			
