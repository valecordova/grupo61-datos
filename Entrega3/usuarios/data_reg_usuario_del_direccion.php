<?php
include("../config.php");

$id = $_POST['id'];

// file extension
$response = 0;
$sql = "DELETE FROM UsuariosDirecciones WHERE id=".$id;
if ($con->query($sql) === TRUE){			
	$response = 1;
}
echo $response;
?>
