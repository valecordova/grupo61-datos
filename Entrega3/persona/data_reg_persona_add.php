<?php
	include("../config.php");
	require("../js/validar_rut.php");
							
	try {
		$RUT		     			= mysqli_real_escape_string($con,(strip_tags($_POST["rec_Rut"],ENT_QUOTES)));//Escanpando caracteres
		if (valida_rut($RUT)){
			$nID_PERSONA		     	= mysqli_real_escape_string($con,(strip_tags($_POST["nID_PERSONA"],ENT_QUOTES)));//Escanpando caracteres
			$NOMBRES		    		= mysqli_real_escape_string($con,(strip_tags($_POST["rec_Nombres"],ENT_QUOTES)));//Escanpando caracteres
			$APELLIDOS					= mysqli_real_escape_string($con,(strip_tags($_POST["rec_Apellidos"],ENT_QUOTES)));//Escanpando caracteres 
			$EDAD	 					= mysqli_real_escape_string($con,(strip_tags($_POST["rec_Edad"],ENT_QUOTES)));//Escanpando caracteres 
			$EMAIL	     				= mysqli_real_escape_string($con,(strip_tags($_POST["rec_Email"],ENT_QUOTES)));//Escanpando caracteres 
			$TIPO_PERSONA				= mysqli_real_escape_string($con,(strip_tags($_POST["rec_TIPO_PERSONA"],ENT_QUOTES)));//Escanpando caracteres 
			$DIRECCION					= mysqli_real_escape_string($con,(strip_tags($_POST["rec_Direccion"],ENT_QUOTES)));//Escanpando caracteres 
			$ESTADO						= mysqli_real_escape_string($con,(strip_tags($_POST["rec_ESTADO"],ENT_QUOTES)));//Escanpando caracteres 
			$ID_USUARIO_MODIFICACION	= mysqli_real_escape_string($con,$_SESSION['id']);//Escanpando caracteres 
			
			$update = mysqli_query($con, "UPDATE PERSONA 
				SET 
					RUT = '$RUT',
					NOMBRES='$NOMBRES', 
					APELLIDOS='$APELLIDOS', 
					EDAD='$EDAD', 
					EMAIL='$EMAIL', 
					TIPO_PERSONA='$TIPO_PERSONA', 
					DIRECCION='$DIRECCION', 
					ID_USUARIO_MODIFICACION='$ID_USUARIO_MODIFICACION' ,
					ESTADO = '$ESTADO'
				WHERE ID_PERSONA='$nID_PERSONA'") or die(mysqli_error());
			
			if($update){
				$response = 1; //'Datos Correctos';
			}else{
				$response= 2; // Error, no se pudo guardar los datos.
			}
		}
		else{
			$response = 3; // Error. rut ingresado invalido!
		}
		
	} catch (Exception $e) {
		//$response 'Excepción capturada: ',  $e->getMessage(), "\n";
		echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		exit;
	}

	echo $response;
?>			
