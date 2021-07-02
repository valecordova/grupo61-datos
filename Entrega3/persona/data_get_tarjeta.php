<?php

   
  
  include("../config.php");
  
  require("../js/validar_rut.php");
 
?>


		<?php
			echo "<div class='row form-group col-md-9 overflow-auto scrollbar scrollbar-primary'>";
		  $nik1 = mysqli_real_escape_string($con,$_GET["nID_PERSONA"]);
		  $result = mysqli_query($con, "SELECT * FROM PERSONA_TARJETA WHERE ID_PERSONA='$nik1'");

		  echo "<table class='table table-hover table-inverse'>";
		  echo "<tr>";
		  echo "<th>Identificación</th>";											
		  echo "<th>Tipo</th>";
		  echo "<th><button type='button' class='fa fa-plus-circle btn-info' data-toggle='modal' data-target='#TarjetaModal'/></th>";
		  echo "</tr>";

		  while ($row1 = mysqli_fetch_assoc($result)){ 
			  echo "<tr>";
			  echo "<td>" . $row1["IDENTIFICACION"] . "</td>";
			  echo "<td>" . $row1["TIPO_IDENTIFICACION"] . "</td>";
			  echo "<td><button id='".$row1["IDENTIFICACION"]."' type='button' class='fa fa-times btn-outline-danger' onclick='AbrirModal(this);';  /></td>";
			  echo "</tr>";	
		  }
		  echo "</table>";
								 
echo "</div>";
  ?>
