<?php
  include("../config.php");
 
?>


		<?php
			echo "<div class='row form-group col-md-9 overflow-auto scrollbar scrollbar-primary'>";
		  $nik1 = mysqli_real_escape_string($con,$_GET["nID"]);
		  $result = mysqli_query($con, "SELECT * FROM UsuariosDirecciones WHERE id_usuario='$nik1'");

		  echo "<table class='table table-hover table-inverse'>";
		  echo "<tr>";
		  echo "<th>Dirección</th>";											
		  echo "<th>Comuna</th>";
		  echo "<th><button type='button' class='fa fa-plus-circle btn-info' data-toggle='modal' data-target='#TarjetaModal'/></th>";
		  echo "</tr>";

		  while ($row1 = mysqli_fetch_assoc($result)){ 
			  echo "<tr>";
			  echo "<td>" . $row1["direccion"] . "</td>";
			  echo "<td>" . $row1["comuna"] . "</td>";
			  echo "<td><button id='".$row1["id"]."' type='button' class='fa fa-times btn-outline-danger' onclick='AbrirModal(this);';  /></td>";
			  echo "</tr>";	
		  }
		  echo "</table>";
								 
echo "</div>";
  ?>
