<?php
include("../config.php");

$id_persona = $_POST['ID_PERSONA'];

// file extension
$response = 0;
$sql = "UPDATE PERSONA SET IMAGEN = '../imagenes/fotos_personas/NN.png' WHERE ID_PERSONA=".$id_persona;
if ($con->query($sql) === TRUE){			
	$response = '../imagenes/fotos_personas/NN.png';
}
echo $response;
?>