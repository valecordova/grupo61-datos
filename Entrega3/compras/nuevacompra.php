<?php

  if(empty($_SESSION)) // if the session not yet started 
   session_start();

  if(!isset($_SESSION['username'])) { //if not yet logged in
    header("Location: ../login.php");// send to login page
    exit;
  }

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
			  
			  <h1 class="h3 mb-4 text-gray-800">Detalle de Compras</h1>
			  
			  <!-- Menu Cerrar Session -->
			  <?php include("../menCerrarSesion.php"); ?>
			  <!-- Menu Cerrar Session -->

			</nav>
			<!-- End of Topbar -->

			<!-- Begin Page Content -->
			<div class="container-fluid">
				<form id="update_persona" name="update_persona" method="POST" action="newcompra.php" data-toggle="validator">
					<div class="card o-hidden border-0 shadow-lg my-5">
						<div class="card-body p-0">
							<!-- Nested Row within Card Body -->
							<div class="row">         
							<div class="col-lg-10">
								<div class="p-5"> 
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<label class="input-group-text" for="SelectEmpresa">Empresa</label>
										</div>
										<select class="form-select" aria-label="Default select example" name="SelectEmpresa" id="SelectEmpresa">
											<?php
												$result = mysqli_query($con, "SELECT * FROM Tiendas order by id");
												$primer = 0;

												while ($row1 = mysqli_fetch_assoc($result)){ 
													if ($primer==0){
														$primer = 1;
														echo "<option value=".$row1["id"]." selected>".$row1["nombre"]."</option>";
													}
													else{
														echo "<option value=".$row1["id"].">".$row1["nombre"]."</option>";
													}											
												}
											?>
										</select>
									</div>
									<input class="btn btn-primary" type="submit" value="Iniciar">	
								</div>
							</div>
						</div>
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
