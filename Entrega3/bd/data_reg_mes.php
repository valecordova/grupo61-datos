<?php

//setting header to json

header('Content-Type: application/json');

try {

    include("../config.php");

  

    //query to get data from the table

    $query = sprintf("SELECT MONTH(fecha_compra) MES, COUNT(id) AS TOTAL FROM Compra GROUP BY MONTH(fecha_compra) ORDER BY MES ");


    //execute query

	$result = $con->query($query);


	//loop through the returned data

	$data = array();

	foreach ($result as $row) {

		$data[] = $row;

	}



	//free memory associated with result

	$result->close();


	//now print the data

	print json_encode($data);



}

catch (Exception $e) {

    echo "error";

    echo 'Excepci�n capturada: ',  $e->getMessage(), "\n";

}

?>