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

	<title>WillBox Administración - Agregar Usuarios</title>

	<!-- Custom fonts for this template-->
	<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

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
			  
			  <h1 class="h3 mb-4 text-gray-800">Actualizar Persona</h1>
			  
			  <!-- Topbar Navbar -->
			  <ul class="navbar-nav ml-auto">

				<!-- Nav Item - User Information -->
				<li class="nav-item dropdown no-arrow">
					
				  <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="validateTips" id="iconUpdates">  </span>
					<span class="mr-2 d-none d-lg-inline text-gray-600 small">
					  <?php echo $_SESSION['username']; ?>
					  </span>
					<img class="img-profile rounded-circle" src="../img/imglogin.jpeg">
				  </a>
				  <!-- Dropdown - User Information -->
				  <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">					
					<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
					  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
					  Cerrar sesión
					</a>
				  </div>
				</li>

			  </ul>

			</nav>
			<!-- End of Topbar -->

			<!-- Begin Page Content -->
			<div class="container-fluid">
				<form id="update_usuarios" name="update_usuarios" method="POST" action="#" data-toggle="validator">					
					<input type="hidden" id="pesan" name="pesan" />
					
					<div class="card o-hidden border-0 shadow-lg my-5">
					  <div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">         
						  <div class="col-lg-10">
							<div class="p-5">
								<div class="form-group row">
								  <div class="col-sm-3 mb-1 mb-sm-0">
									<input type="text" required class="form-control form-control-user" name="rec_rut" id="rec_rut" placeholder="Rut" value="">
								  </div>
								  <div class="col-sm-9">
									<input type="text" required class="form-control form-control-user" name="rec_nombre" id="rec_nombre" placeholder="Nombres" value="">
								  </div>								  
								</div>

								<div class="form-group row">
									<div class="col-sm-5">                  
										<input type="number" class="form-control form-control-user" name="rec_edad" id="rec_edad" placeholder="Edad" value="">
									</div>
								</div>
								<div class="form-group row">									
									<div class="col-sm-5"> 
										<input type="password" class="form-control form-control-user" name="rec_Password" id="rec_Password" placeholder="Contraseña" value="">
									</div>
									<div class="col-sm-5"> 
										<input type="password" class="form-control form-control-user" name="rec_Password2" id="rec_Password2" placeholder="Confirmar Contraseña" value="">
									</div>
								</div>
								<div class="form-group row">							
									<div class="col-sm-4 mb-3 mb-sm-0">
										<input type="button" id="save" name="save" class="btn btn-primary btn-user btn-block" value="Guardar datos">
									</div>
									<div class="col-sm-4 mb-3 mb-sm-0">
										<a href="usuarios.php" class="btn btn-secondary btn-user btn-block">Volver</a>								
									</div>
									<div class="col-sm-4 mb-3 mb-sm-0">
										<a href="#" onclick="myLimpiar()" class="btn btn btn-light btn-user btn-block">Limpiar</a>								
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

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Preparado para irme?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Seleccione "Cerrar sesión" a continuación si está listo para finalizar su sesión actual.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-primary" href="../logout.php">Cerrar sesión</a>
        </div>
      </div>
    </div>
  </div>

<div id="TarjetaModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<!-- Form -->
			<form method='post' action='' enctype="multipart/form-data">
				<div class="modal-header">
					<h5 class="modal-title">Agregar tarjeta</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Ingresar tarjeta.</p>
					<input type='text' name='rec_tarjeta_add' id='rec_tarjeta_add' class='form-control form-control-user' >
				</div>
				<div class="modal-footer">
					<input type='button' class='btn btn-primary btn-user btn-block' value='Agregar' id='btn_tarjeta_add'>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="confirm-dialog" class="modal fade" role="dialog">
	<div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirm-title"></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div id="confirm-body" class="modal-body"></div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Ok</button>          
        </div>
      </div>
    </div>
</div>

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

		$("#collapseUsuarios").addClass("show"); 

		$('#update_usuarios').bootstrapValidator({        
			feedbackIcons: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},			
			fields: {				
				rec_rut: {
					validators: {							
						notEmpty: { message: 'Por favor, ingresar Rut'}
					}
				},
				rec_nombre: {
					validators: {
						stringLength: {min: 5, message: 'Minimo de 5 caracteres'},
						notEmpty: {	message: 'Por favor, ingresar Nombres'}
					}
				},
				rec_edad: {
					validators: {
						stringLength: {min: 2, message: 'Minimo de 2 caracteres'},
						notEmpty: {	message: 'Por favor, ingresar Edad'}
					}
				},
				rec_Password: {					
					validators: {
						identical: {
							field: 'rec_Password2',
							message: 'La contraseña y su confirmación no son las mismas.'
						},						
						notEmpty: {message: 'Por favor, ingresar contraseña'}
					}
				},
				rec_Password2: {					
					validators: {
						identical: {
							field: 'rec_Password',
							message: 'La contraseña y su confirmación no son las mismas.'
						},						
						notEmpty: {message: 'Por favor, confirmar contraseña'}
					}
				}

			}
		});


		$("#iconUpdates").html("<img src='images/ajax-loader_small.gif' />    ");		
		$("#iconUpdates").hide();

		$('#save').click(function(){
			$('#update_usuarios').bootstrapValidator('validate');
			if ($('#update_usuarios').data('bootstrapValidator').isValid()) {
				event.preventDefault();						
				var fd = new FormData();
				fd.append('rec_rut',$('#rec_rut').val());
				fd.append('rec_nombre',$('#rec_nombre').val());
				fd.append('rec_edad',$('#rec_edad').val());
				fd.append('rec_Password',$('#rec_Password').val());

				$("#iconUpdates").show();

				// AJAX request
				$.ajax({
					url: 'data_reg_add.php',
					type: 'post',
					data: fd,
					contentType: false,
					processData: false,
					success: function(response){
						if (response == 1)	{
							$('#confirm-title').text("Confirmación de guardado de datos.");
							$('#confirm-body').text("Los datos han sido guardados con éxito.");						
							$('#confirm-dialog').modal('toggle');

							myLimpiar();
						}
						else if (response == 2)
						{
							$('#confirm-title').text("Atención.");
							$('#confirm-body').text("No se pudo guardar los datos. Por favor, reintentar.");						
							$('#confirm-dialog').modal('toggle');						
						}						
						else 
						{
							$('#confirm-title').text("Atención.");
							$('#confirm-body').text(response);						
							$('#confirm-dialog').modal('toggle');						
						}
						$("#iconUpdates").hide();
					}
				});
			}
			else{
				$('#confirm-title').text("Completar campos.");
				$('#confirm-body').text("hay campos obligatorios vacios.");						
				$('#confirm-dialog').modal('toggle');
			}

		});
	  
		
	});

	function myLimpiar(){
		$('#rec_rut').val("");
		$('#rec_nombre').val("");
		$('#rec_edad').val("");
		$('#rec_Password').val("");
		$('#rec_Password2').val("");
	}
  </script>
 

</body>

</html>
