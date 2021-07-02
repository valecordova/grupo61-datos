<?php
	include("../config.php");

	if(empty($_SESSION)) // if the session not yet started 
    	session_start();
					
	try {
		$nID		    = mysqli_real_escape_string($con,(strip_tags($_POST["nID"],ENT_QUOTES)));//Escanpando caracteres
		$nombre		    = mysqli_real_escape_string($con,(strip_tags($_POST["rec_nombre"],ENT_QUOTES)));//Escanpando caracteres		
		$edad	     	= mysqli_real_escape_string($con,(strip_tags($_POST["rec_edad"],ENT_QUOTES)));//Escanpando caracteres 
		$rec_password	= mysqli_real_escape_string($con,(strip_tags($_POST["rec_password"],ENT_QUOTES)));//Escanpando caracteres 
		$contrasena_valid = mysqli_real_escape_string($con,(strip_tags($_POST["rec_contrasena_valid"],ENT_QUOTES)));//Escanpando caracteres 
		$cambio_clave = mysqli_real_escape_string($con,(strip_tags($_POST["cambio_clave"],ENT_QUOTES)));//Escanpando caracteres 
		

		$result = mysqli_query($con, "select * from Usuarios where id = ".$_SESSION["id"]);
		$row1 = mysqli_fetch_assoc($result);
		
		if ($cambio_clave === "1" and $contrasena_valid != $row1["clave"]){
			$response= 3; 
		}
		else{
			$sql = "UPDATE Usuarios SET edad = '$edad', nombre = '$nombre'";
			if (empty($rec_password) == false){
				$sql .= " ,clave = '$rec_password' ";
			}		
			$sql .= " WHERE id='$nID'" ;

			$update = mysqli_query($con,$sql) or die(mysqli_error());
			
			if($update){
				$response = 1; //'Datos Correctos';
			}else{
				$response= 2; // Error, no se pudo guardar los datos.
			}

		}

		
		
		
	} catch (Exception $e) {
		//$response 'Excepción capturada: ',  $e->getMessage(), "\n";
		echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		exit;
	}

	echo $response;
?>			
