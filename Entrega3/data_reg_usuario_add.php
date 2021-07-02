<?php
	include("config.php");	
						
	try {
		$nombre		     		= mysqli_real_escape_string($con,(strip_tags($_POST["rec_nombre"],ENT_QUOTES)));
		$rut		    		= mysqli_real_escape_string($con,(strip_tags($_POST["rec_rut"],ENT_QUOTES)));	
		$edad					= mysqli_real_escape_string($con,(strip_tags($_POST["rec_edad"],ENT_QUOTES)));	
		$rec_Password			= mysqli_real_escape_string($con,(strip_tags($_POST["rec_Password"],ENT_QUOTES)));
		
		// $param_password = password_hash($rec_Password, PASSWORD_DEFAULT); // Creates a password hash

		$sql = "insert into Usuarios (nombre,rut,edad,clave,id_perfil) values ('$nombre','$rut',$edad,'$rec_Password',1)";
				

		$update = mysqli_query($con,$sql) or die(mysqli_error());
		
		if($update){
			$response = 1; //'Datos Correctos';
		}else{
			$response= 2; // Error, no se pudo guardar los datos.
		}
		
		
	} catch (Exception $e) {
		$response= 3;
		//$response = 'Excepción capturada: ',  $e->getMessage(), "\n";
		//echo 'Excepción capturada: ',  $e->getMessage(), "\n";		
	}

	echo $response;
?>			
