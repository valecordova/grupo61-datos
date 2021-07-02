<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

 	$query = "SELECT T.nombre,  D.comuna FROM Tiendas as T INNER JOIN Compra AS C on C.tid = T.id INNER JOIN Direcciones AS D ON T.id = D.Tid";
	$result = $db -> prepare($query);
	$result -> execute();
	$tiendas = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>Nombre</th>
      <th>Comuna Despacho</th>
    </tr>
  <?php
	foreach ($tiendas as $tienda) {
  		echo "<tr> <td>$tienda[0]</td> <td>$tienda[1]</td> </tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
