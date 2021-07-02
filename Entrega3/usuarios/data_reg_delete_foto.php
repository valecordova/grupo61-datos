<?php
include("../config.php");

$id = $_POST['ID'];
$response = 0;

$sql = mysqli_query($con, "SELECT * FROM users WHERE id=".$id);
if(mysqli_num_rows($sql) > 0){
	$row = mysqli_fetch_assoc($sql);
	$Imagen = $row ['IMAGEN'];

	$file_extension = pathinfo($Imagen, PATHINFO_EXTENSION);
	$file_extension = strtolower($file_extension);
	$filename = $id.".".$file_extension;
	
	
	$sql = "UPDATE users SET IMAGEN = '../imagenes/fotos_usuarios/NN.png' WHERE ID=".$id;
	if ($con->query($sql) === TRUE){
		if ($_SESSION["id"]=== $id){
			session_start();
			$_SESSION["IMAGEN"] = "../imagenes/fotos_usuarios/NN.png";
		}
		unlink("/var/www/html/start/imagenes/fotos_usuarios/".$filename);
	

		// file extension
		$response = 1;
	}	
}
echo $response;
?>