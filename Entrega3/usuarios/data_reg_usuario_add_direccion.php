<?php
include("../config.php");

$id = $_POST['id'];
$direccion = $_POST['direccion'];
$comuna = $_POST['comuna'];
$response = 0;

// file extension

$result = $con->query("SELECT COUNT(*) FROM UsuariosDirecciones WHERE direccion = '".$direccion."' and id_usuario = ".$id)->fetch_array();
if ($result[0] > 0){
	$response = 2;	
}
else{
	
	$sql = "INSERT INTO UsuariosDirecciones (id_usuario,direccion,comuna) VALUES(".$id.",'".$direccion."','".$comuna."') ";
	if ($con->query($sql) === TRUE){			
		$response = 1;
	}
}
echo $response;
?>
