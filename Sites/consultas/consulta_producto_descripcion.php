<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $descripcion = $_POST["descripcion"];

  #Se construye la consulta como un string
 	$query = "SELECT U.nombre FROM Usuarios AS U INNER JOIN Compra AS C ON C.uid = U.id INNER JOIN Productos AS P ON P.id = C.pid WHERE P.Descripcion = @DESCRIPCION";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$usuarios = $result -> fetchAll();
  ?>

  <table>
    <tr>
      <th>Usuario</th>
    </tr>
  
      <?php
        foreach ($usuarios as $p) {
          echo "<tr><td>$p[0]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>
