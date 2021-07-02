<?php
/*Datos de conexion a la base de datos*/
								
try {
	$sql = mysqli_query($con, "SELECT COUNT(*) as TOTAL from Tiendas");
	$row = mysqli_fetch_assoc($sql);
	$TotalControl_Mensual = $row ['TOTAL'];

	$sql = mysqli_query($con, "SELECT COUNT(*) as TOTAL from Compra where id_usuario = ".$_SESSION["id"]);
	$row = mysqli_fetch_assoc($sql);
	$TotalControl_Anual = $row ['TOTAL'];

	$sql = mysqli_query($con, "SELECT COUNT(*) as TOTAL from Productos");
	$row = mysqli_fetch_assoc($sql);
	$TotalPersonas_Activas = $row ['TOTAL'];

	$sql = mysqli_query($con2, "SELECT COUNT(*) as TOTAL FROM Despachos");
	$row = mysqli_fetch_assoc($sql);
	$TotalControl_IntentoAcceso = $row ['TOTAL'];

} catch (Exception $e) {
	$TotalControl_Mensual = 0;
	$TotalControl_Anual = 0;
	$TotalControl_IntentoAcceso = 0;
	$TotalPersonas_Activas = 0;
}


?>