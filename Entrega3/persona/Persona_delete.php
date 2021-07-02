<?php
	include_once("../config.php");
if($_REQUEST['empid']) {
	$sql = "DELETE FROM PERSONA WHERE ID_PERSONA='".$_REQUEST['empid']."'";
	$resultset = mysqli_query($con, $sql) or die("database error:". mysqli_error($conn));	
	if($resultset) {
		echo "Registro Borrado";
	}
}
?>
