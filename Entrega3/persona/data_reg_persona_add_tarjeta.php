<?php
include("../config.php");

$id_persona = $_POST['ID_PERSONA'];
$tarjeta = $_POST['tarjeta'];

// file extension
$response = 0;
$result = $con->query("SELECT COUNT(*) FROM PERSONA_TARJETA WHERE IDENTIFICACION = '".$tarjeta."'")->fetch_array();
if ($result[0] > 0){
	$response = 2;	
}
else{
	
	$sql = "INSERT INTO PERSONA_TARJETA (ID_PERSONA,IDENTIFICACION,TIPO_IDENTIFICACION) VALUES(".$id_persona.",'".$tarjeta."','Tarjeta') ";
	if ($con->query($sql) === TRUE){			
		$response = 1;
	}
}
echo $response;
?>
