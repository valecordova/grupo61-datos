<?php

  if(empty($_SESSION)) // if the session not yet started 
   session_start();

  if(!isset($_SESSION['username'])) { //if not yet logged in
    header("Location: ../login.php");// send to login page
    exit;
  }

  $id_tienda = $_POST['id_tienda_producto_baratos'];

  include("../config.php");
  
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>WillBox Administración - Detalle de Compras</title>

	<!-- Custom fonts for this template-->
	<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	
	<!-- Custom styles for this template-->
	<link href="../css/sb-admin-2.min.css" rel="stylesheet">
  
	<!-- Custom styles for this page -->
	<link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

	<link href="../css/bootstrapValidator.min.css" rel="stylesheet">
   
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar - Brand -->
	<?php include("../menubar.php"); ?>      
	<!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

		<!-- Main Content -->
		<div id="content">

			<!-- Topbar -->
			<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

			  <!-- Sidebar Toggle (Topbar) -->
			  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
				<i class="fa fa-bars"></i>
			  </button>
			  
			  <h1 class="h3 mb-4 text-gray-800">Productos más Baratos</h1>
			  
			  <!-- Menu Cerrar Session -->
			  <?php include("../menCerrarSesion.php"); ?>
			  <!-- Menu Cerrar Session -->

			</nav>
			<!-- End of Topbar -->			
			<!-- Begin Page Content -->
			<div class="container-fluid">
				<form id="update_persona" name="update_persona" method="POST" action="#">
					<div class="table-responsive">
  						<h2>Comestible </h2>
						<table id="table_Congelados" class="table table-bordered table-hover" width="98%">
						<thead bgcolor="#eeeeee" align="center">
							<tr>
								<th>Nombre</th>
								<th>Precio</th>
								<th>Descripcion</th>
								<th>Categoria</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$result = mysqli_query($con, "SELECT * FROM Productos WHERE id_tienda = ".$id_tienda." and tipo_producto='Comestible' order by precio limit 0, 3 ");
								while ($row1 = mysqli_fetch_assoc($result)){ 
									echo "<tr>";
									echo "<td>" . $row1["nombre"] . "</td>";	
									echo "<td>" . $row1["precio"] . "</td>";
									echo "<td>" . $row1["descripcion"] . "</td>";
									echo "<td>" . $row1["categoria"] . "</td>";
									echo "</tr>";	
								}
							?>
						</tbody>						
						</table>
					</div> 
					<hr>
					<div class="table-responsive">
  						<h2>No Comestible </h2>
						<table id="table_Congelados" class="table table-bordered table-hover" width="98%">
						<thead bgcolor="#eeeeee" align="center">
							<tr>
								<th>Nombre</th>
								<th>Precio</th>
								<th>Descripcion</th>
								<th>Ancho</th>
								<th>Largo</th>
								<th>Alto</th>
								<th>Peso</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$result = mysqli_query($con, "SELECT * FROM Productos WHERE id_tienda = ".$id_tienda." and tipo_producto='No Comestible' order by precio limit 0, 3 ");
								while ($row1 = mysqli_fetch_assoc($result)){ 
									echo "<tr>";
									echo "<td>" . $row1["nombre"] . "</td>";	
									echo "<td>" . $row1["precio"] . "</td>";
									echo "<td>" . $row1["descripcion"] . "</td>";
									echo "<td>" . $row1["ancho"] . "</td>";
									echo "<td>" . $row1["largo"] . "</td>";
									echo "<td>" . $row1["alto"] . "</td>";
									echo "<td>" . $row1["peso"] . "</td>";
									echo "</tr>";	
								}
							?>
						</tbody>						
						</table>
					</div>


				</form>
			</div>
			<!-- /.container-fluid -->

		</div>
		<!-- End of Main Content -->

      <!-- Footer -->
      <?php include("../footer.php"); ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
 
  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../js/bootstrapValidator.min.js" type="text/javascript" ></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script> 

<script>
	$(document).ready(function(){
		if ((/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))==true) {                    
				$("body").toggleClass("sidebar-toggled");
				$(".sidebar").toggleClass("toggled");
				if ($(".sidebar").hasClass("toggled")) {
				  $('.sidebar .collapse').collapse('hide');
				};
			}

		// se visualiza 
		$("#collapseCompras").addClass("show"); 

		$("#iconUpdates").html("<img src='images/ajax-loader_small.gif' />    ");		
		$("#iconUpdates").hide();
		
	});

  </script>
 

</body>

</html>
