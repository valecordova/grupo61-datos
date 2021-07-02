<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $comuna = $_POST["comuna"];

 	$query = "SELECT TR.rut, TR.nombre FROM Trabajadores as TR INNER JOIN Tiendas as T ON T.id_jefe = TR.id AND T.id = TR.Tid INNER JOIN Direcciones as D ON T.id = D.Tid WHERE D.comuna = @DATO_COMUNA";
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
