<?php include('../templates/header.html');   ?>

<body>

  <?php
  require("../config/conexion.php"); #Llama a conexión, crea el objeto PDO y obtiene la variable $db

  $var = $_POST["tipo"];
  $query = "SELECT T.nombre FROM Tiendas AS T WHERE T.id IN (SELECT P.tid FROM Productos P WHERE ((@TIPO_PRODUCTO = 'PNoComestibles' AND FECHA_CADUCIDAD IS NULL) OR (@TIPO_PRODUCTO = 'Comestibles' AND NOT FECHA_CADUCIDAD IS NULL)	))";
  $result = $db -> prepare($query);
  $result -> execute();
  $dataCollected = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo
  ?>

  <table>
    <tr>
      <th>Nombre</th>
       </tr>
  <?php
  foreach ($dataCollected as $p) {
    echo "<tr> <td>$p[0]</td>";
  }
  ?>
  </table>

<?php include('../templates/footer.html'); ?>
