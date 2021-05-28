<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $comuna = $_POST["comuna"];

 	$query = ";";
	$result = $db -> prepare($query);
	$result -> execute();
	$jefes = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>Nombre</th>
      <th>Tienda</th>
    </tr>
  <?php
	foreach ($jefes as $jefe) {
  		echo "<tr><td>$jefe[0]</td><td>$jefe[1]</tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
