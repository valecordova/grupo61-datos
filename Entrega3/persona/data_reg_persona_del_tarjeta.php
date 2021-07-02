<?php
include("../config.php");

$id_persona = $_POST['ID_PERSONA'];
$tarjeta = $_POST['tarjeta'];

// file extension
$response = 0;
$sql = "DELETE FROM PERSONA_TARJETA WHERE ID_PERSONA=".$id_persona." AND IDENTIFICACION = '".$tarjeta."'";
if ($con->query($sql) === TRUE){			
	$response = 1;
}
echo $response;
?>