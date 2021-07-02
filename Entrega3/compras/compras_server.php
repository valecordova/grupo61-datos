<?php

if(empty($_SESSION)) // if the session not yet started 
    session_start();


/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
// DB table to use
$table = 'vista_compra';
 
// Table's primary key
$primaryKey = 'id_compra';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'id_compra', 'dt' => 0,),
    array( 'db' => 'rut', 'dt' => 1 ),
    array( 'db' => 'nombre', 'dt' => 2 ),
    array( 'db' => 'direccion', 'dt' => 3 ),
    array( 'db' => 'comuna', 'dt' => 4,),        
    array( 'db' => 'fecha_compra','dt' => 5, 'formatter' => function( $d, $row ) { return date( 'Y-m-d', strtotime($d)); } )
);
 
// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => 'admin',
    'db'   => 'Grupo_impar',
    'host' => 'localhost'
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( '../ssp.class.php' );

$sql_where = "";
if ($_SESSION["ID_PERFIL"] == 1){
    $id_usuario = $_SESSION["id"];
    $sql_where = "id_usuario = ".$id_usuario;
}

echo json_encode(
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, "", $sql_where )
);

