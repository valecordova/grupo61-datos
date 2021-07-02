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
				<form id="update_persona" name="update_persona" method="POST" action="#" data-toggle="validator">
					<input type="hidden" id="nID_COMPRA" name="nID_COMPRA" value="<?php echo mysqli_real_escape_string($con,(strip_tags($_POST["nID_COMPRA"],ENT_QUOTES))) ?>" />
					
					<div class="card o-hidden border-0 shadow-lg my-5">
					  <div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">         
						  <div class="col-lg-10">
							<div class="p-5"> 						
								<?php								
									try {
										$nID_COMPRA = mysqli_real_escape_string($con,(strip_tags($_POST["nID_COMPRA"],ENT_QUOTES)));													
										
										$sql = mysqli_query($con, "SELECT * FROM vista_compra WHERE id_compra='$nID_COMPRA'");
										if(mysqli_num_rows($sql) == 0){
											echo "<script>window.location.href='comprasrealizadas.php';</script>";
											exit;
										}else{
											$row = mysqli_fetch_assoc($sql);
										}
										
									} catch (Exception $e) {
										echo 'Excepción capturada: ',  $e->getMessage(), "\n";
										exit;
									}
								?>						
					
							  
								<div class="form-group row">
								  <div class="col-sm-3 mb-1 mb-sm-0">
									<input type="text" required class="form-control form-control-user" name="rec_rut" id="rec_rut" placeholder="Rut" value="<?php echo $row ['rut']; ?>">
								  </div>
								  <div class="col-sm-4">
									<input type="text" required class="form-control form-control-user" name="rec_nombres" id="rec_nombres" placeholder="Nombres" value="<?php echo $row ['nombre']; ?>">
								  </div>
								  <div class="col-sm-5">
									<input type="text" required class="form-control form-control-user" name="rec_direccion" id="rec_direccion" placeholder="Dirección" value="<?php echo $row ['direccion']; ?>">
								  </div>                  				
								</div>
								<div class="form-group row">					
									<div class="col-sm-2">
										<input type="text" class="form-control form-control-user" name="rec_comuna" id="rec_comuna" placeholder="Comuna" value="<?php echo $row ['comuna']; ?>">
									</div>
									<div class="col-sm-5">                  
										<input type="date" class="form-control form-control-user" name="rec_fecha_compra" id="rec_fecha_compra" placeholder="Fecha" value="<?php echo $row ['fecha_compra']; ?>">
									</div>									
								</div>						
								<div class="form-group row">
									<div class="col-xs-12 col-sm-12 col-md-12">										
										<div id="divid" class="col-xs-12 col-sm-12 col-md-12">
											<div class="row form-group col-md-12 overflow-auto scrollbar scrollbar-primary">
											  <?php
												  $nik1 = mysqli_real_escape_string($con,(strip_tags($_POST["nID_COMPRA"],ENT_QUOTES)));
												  $result = mysqli_query($con, "SELECT * FROM vista_compra_detalle WHERE id_compra='$nik1'");

												  echo "<table class='table table-hover table-inverse'>";
												  echo "<tr>";
												  echo "<th>Acción</th>";
												  echo "<th>Producto</th>";
												  echo "<th>Precio</th>";
												  echo "<th>Descripcion</th>";
												  echo "<th>Cantidad</th>";												  
												  echo "</tr>";

												  while ($row1 = mysqli_fetch_assoc($result)){ 
													  echo "<tr>";
													  
													  echo "<td><button type='button' class='fa fa-plus-circle btn-info' onclick='editarProducto(".$row1["id_producto"].");'; </td>";		  													  
													  echo "<td>" . $row1["nombre"] . "</td>";	
													  echo "<td>" . $row1["precio"] . "</td>";
													  echo "<td>" . $row1["descripcion"] . "</td>";
													  echo "<td>" . $row1["cantidad"] . "</td>";
													  echo "</tr>";	
												  }
												  echo "</table>";
											  ?>
											</div>
										</div>
									</div>																
								</div>						
								<div class="form-group row">
									<div class="col-sm-6 mb-3 mb-sm-0">
										<a href="../compras/comprasrealizadas.php" class="btn btn-secondary btn-user btn-block">Volver</a>								
									</div>							
								</div>					                        
							</div>
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

  <form id="ActionUpdate" name="ActionUpdate" action="../productos/productos_detalle.php" method="POST">
    <input type="hidden" id="nID_PRODUCTO" name="nID_PRODUCTO">
  </form>

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

		$(document).on('click', '.edit_employee', function () {
          var empid = $(this).attr('data-emp-id');          
          $("#nID_PERSONA").val(empid)          
          javascript:document.ActionUpdate.submit()
        });
		
	});

	function editarProducto(id){		
		$("#nID_PRODUCTO").val(id)          
        javascript:document.ActionUpdate.submit()
	}

  </script>
 

</body>

</html>
