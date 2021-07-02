<?php
	include_once("../config.php");
	
	if(empty($_SESSION)) // if the session not yet started 
		session_start();		
	
if($_REQUEST['id']) {
	if ($_REQUEST['id'] == $_SESSION["id"]){
		echo "No se puede elimiar como usuario";
	}
	else{
	
		$sql = "DELETE FROM Usuarios WHERE id='".$_REQUEST['id']."'";
		$resultset = mysqli_query($con, $sql) or die("database error:". mysqli_error($conn));	
		if($resultset) {
			echo "Registro Borrado";
		}
	}
}
?>
