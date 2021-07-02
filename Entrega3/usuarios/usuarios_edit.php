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
	<!--- 
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	--->

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
			  
			  <h1 class="h3 mb-4 text-gray-800">Actualizar Usuario</h1>
			  
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
					<input type="hidden" id="nID" name="nID" value="<?php echo mysqli_real_escape_string($con,(strip_tags($_POST["nID"],ENT_QUOTES))) ?>" />
					<input type="hidden" id="pesan" name="pesan" />
					
					<div class="card o-hidden border-0 shadow-lg my-5">
					  <div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">         
						  <div class="col-lg-10">
							<div class="p-5"> 						
								<?php								
									try {										
										$nID = mysqli_real_escape_string($con,(strip_tags($_POST["nID"],ENT_QUOTES)));										
										
										$sql = mysqli_query($con, "SELECT * FROM Usuarios WHERE id=$nID");
										if(mysqli_num_rows($sql) == 0){
											echo "<script>window.location.href='usuarios.php';</script>";
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
									<input type="text" readonly required class="form-control form-control-user" name="rec_rut" id="rec_rut" placeholder="Rut usuario" value="<?php echo $row ['rut']; ?>">
								  </div>
								  <div class="col-sm-4">
									<input type="text" required class="form-control form-control-user" name="rec_nombre" id="rec_nombre" placeholder="Nombres" value="<?php echo $row ['nombre']; ?>">
								  </div>
								  <div class="col-sm-5">
									<input type="number" required class="form-control form-control-user" name="rec_edad" id="rec_edad" placeholder="Edad" value="<?php echo $row ['edad']; ?>">
								  </div>                  				
								</div>
								<div class="form-group row">
									<div class="col-xs-12 col-sm-6 col-md-4 custom-control custom-checkbox" style="margin-left:15px; margin-top:10px;">
										<input type="checkbox" class="custom-control-input" id="CambiarClave">
										<label for="CambiarClave" class="custom-control-label" >Cambiar contraseña</label>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-3">
										<input type="password" class="form-control form-control-user" name="rec_password" id="rec_password" placeholder="Contraseña" value="">
									</div>
									<div class="col-xs-12 col-sm-6 col-md-3">
										<input type="password" class="form-control form-control-user" name="rec_password2" id="rec_password2" placeholder="Confirmar Contraseña" value="">
									</div>
								</div>
								
								<div id="divid" class="col-xs-12 col-sm-12 col-md-12">
									<div class="row form-group col-md-9 overflow-auto scrollbar scrollbar-primary">
									  <?php
										  $nik1 = mysqli_real_escape_string($con,(strip_tags($_POST["nID"],ENT_QUOTES)));
										  
										  
										  $result = mysqli_query($con, "SELECT * FROM UsuariosDirecciones WHERE id_usuario=$nik1");

										  echo "<table class='table table-hover table-inverse'>";
										  echo "<tr>";
										  echo "<th>Dirección</th><th>Comuna</th>";
										  //echo "<th>Tipo</th>";
										  echo "<th><button type='button' onclick='Limpiar()' class='fa fa-plus-circle btn-info' data-toggle='modal' data-target='#TarjetaModal'/></th>";
										  echo "</tr>";

										  while ($row1 = mysqli_fetch_assoc($result)){ 
											  echo "<tr>";
											  echo "<td>" . $row1["direccion"] . "</td>";
											  echo "<td>" . $row1["comuna"] . "</td>";
											  echo "<td><button id='".$row1["id"]."' direccion='".$row1["direccion"]."' type='button' class='fa fa-times btn-outline-danger' onclick='AbrirModal(this);';  /></td>";
											  echo "</tr>";	
										  }
										  echo "</table>";
									  ?>
									</div>
								</div>
										
													
								<div class="form-group row">							
									<div class="col-sm-6 mb-3 mb-sm-0">
										<input type="button" id="save" name="save" class="btn btn-primary btn-user btn-block" value="Guardar datos">
									</div>
									<div class="col-sm-6 mb-3 mb-sm-0">
										<a href="usuarios.php" class="btn btn-secondary btn-user btn-block">Volver</a>								
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
					<h5 class="modal-title">Agregar Dirección</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Ingresar dirección.</p>
					<input type='text' name='rec_direccion_add' id='rec_direccion_add' class='form-control form-control-user' >
					
					<p>Ingresar comuna</p>
					<input type='text' name='rec_comuna_add' id='rec_comuna_add' class='form-control form-control-user' >
					
				</div>
				<div class="modal-footer">
					<input type='button' class='btn btn-primary btn-user btn-block' value='Agregar' id='btn_direccion_add'>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="Solicitar_clave" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<!-- Form -->
			<form method='post' action='' enctype="multipart/form-data">
				<div class="modal-header">
					<h5 class="modal-title">Ingresar contraseña anterior</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Ingresar contraseña.</p>
					<input type='password' name='rec_contrasena_valid' id='rec_contrasena_valid' class='form-control form-control-user' >				
				</div>
				<div class="modal-footer">					
					<input type='button' class='btn btn-primary btn-user btn-block' value='Confirmar' id='btn_confirmar_clave'>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="Tarjeta_Del_Modal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<!-- Form -->
			<form method='post' action='' enctype="multipart/form-data">
				<div class="modal-header">
					<h5 class="modal-title">Eliminar dirección</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Eliminar dirección.</p>
					<span class="label label-default" id="rec_direccion_del" name="rec_direccion_del"></span>					
				</div>
				<div class="modal-footer">
					<input type='hidden' id='rec_id_direccion_del' >
					<input type='button' class='btn btn-primary btn-user btn-block' value='Eliminar' id='btn_direccion_del'>
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
	function Limpiar(){
		$('#preview').empty();
		$('#file').val("");
		
	};
	function AbrirModal(valor){
		
		$('#rec_direccion_del').text($('#'+valor.id).attr("direccion"));
		$('#rec_id_direccion_del').val(valor.id);
		$('#Tarjeta_Del_Modal').modal('toggle');
	};

</script>

<script>
	$(document).ready(function(){
		
		if ((/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))==true) {                    
				$("body").toggleClass("sidebar-toggled");
				$(".sidebar").toggleClass("toggled");
				if ($(".sidebar").hasClass("toggled")) {
				  $('.sidebar .collapse').collapse('hide');
				};
			}

		$("#rec_password").hide();
		$("#rec_password2").hide();

		$("#collapseUsuarios").addClass("show"); 

		$("#rec_username").attr("readonly","readonly");

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
				red_edad: {
					validators: {
						stringLength: {min: 2, message: 'Minimo de 2 caracteres'},
						notEmpty: {	message: 'Por favor, ingresar edad'}
					}
				},
				rec_password: {					
					validators: {
						identical: {
							field: 'rec_password2',
							message: 'La contraseña y su confirmación no son las mismas.'
						},						
						notEmpty: {message: 'Por favor, ingresar contraseña'}
					}
				},
				rec_password2: {					
					validators: {
						identical: {
							field: 'rec_password',
							message: 'La contraseña y su confirmación no son las mismas.'
						},						
						notEmpty: {message: 'Por favor, ingresar contraseña'}
					}
				}

			}
		});


		$("#iconUpdates").html("<img src='../images/ajax-loader_small.gif' />    ");		
		$("#iconUpdates").hide();


		$('#btn_confirmar_clave').click(function(){
			if ($('#rec_contrasena_valid').val() != ""){
				$('#Solicitar_clave').modal('toggle');
			}
		});
				
		$('#CambiarClave').click(function(){
			$("#rec_password").val("");
			$("#rec_password2").val("");	
			
			$('#update_usuarios').bootstrapValidator('revalidateField', 'rec_password');
			$('#update_usuarios').bootstrapValidator('revalidateField', 'rec_password2');

			$('#update_usuarios').bootstrapValidator('enableFieldValidators', 'rec_password', false);
			$('#update_usuarios').bootstrapValidator('enableFieldValidators', 'rec_password2', false);

			$('#update_usuarios').data('bootstrapValidator').resetForm();
			$('#update_usuarios').bootstrapValidator('validate');

			if($("#CambiarClave").is(':checked')) { 
				$('#update_usuarios').bootstrapValidator('enableFieldValidators', 'rec_password', true);
				$('#update_usuarios').bootstrapValidator('enableFieldValidators', 'rec_password2', true);
				
				$("#rec_password").show();
				$("#rec_password2").show();

				// levantar show para 											
				$('#Solicitar_clave').modal('toggle');

			}
			else{
				$("#rec_password").hide();
				$("#rec_password2").hide();
			}

			

		});

		$('#save').click(function(){
			$('#update_usuarios').bootstrapValidator('validate');
			if ($('#update_usuarios').data('bootstrapValidator').isValid()) {
				event.preventDefault();
				var fd = new FormData();				
				fd.append('nID',$('#nID').val());				
				fd.append('rec_nombre',$('#rec_nombre').val());
				fd.append('rec_edad',$('#rec_edad').val());
				fd.append('rec_password',$('#rec_password').val());
				fd.append('rec_contrasena_valid',$('#rec_contrasena_valid').val());				
				if($("#CambiarClave").is(':checked')) { 
					fd.append('cambio_clave',"1");	
				}else{
					fd.append('cambio_clave',"0");
				}
				$("#iconUpdates").show();

				// AJAX request
				$.ajax({
					url: 'data_reg_edit.php',
					type: 'post',
					data: fd,
					contentType: false,
					processData: false,
					success: function(response){
						if (response == 1)	{
							$('#confirm-title').text("Confirmación de guardado de datos.");
							$('#confirm-body').text("Los datos han sido guardados con éxito.");						
							$('#confirm-dialog').modal('toggle');
						}
						else if (response == 2)
						{
							$('#confirm-title').text("Atención.");
							$('#confirm-body').text("No se pudo guardar los datos. Por favor, reintentar.");
							$('#confirm-dialog').modal('toggle');						
						}
						else if (response == 3)
						{
							$('#confirm-title').text("Atención.");
							$('#confirm-body').text("Contraseña anterior no corresponde.");
							$('#confirm-dialog').modal('toggle');
							
							$("#CambiarClave").trigger("click");

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
	  
		

		
		  
		  $('#btn_direccion_add').click(function(){
		    event.preventDefault();

			$("#btn_direccion_add").prop('disabled', true); 

			var fd = new FormData();
			var direccion = $('#rec_direccion_add').val();
			var comuna = $('#rec_comuna_add').val();
			var ID = $('#nID').val();
						
			fd.append('direccion',$.trim(direccion));
			fd.append('comuna',$.trim(comuna));
			fd.append('id',ID );

			if ($.trim(direccion) == ""){
				$('#confirm-title').text("Agregar Dirección.");
				$('#confirm-body').text("Por favor, ingresar una dirección valida.");						
				$('#confirm-dialog').modal('toggle');
				$("#btn_direccion_add").prop('disabled', false);
				return;
			}
			
			if ($.trim(comuna) == ""){
				$('#confirm-title').text("Agregar Comuna.");
				$('#confirm-body').text("Por favor, ingresar una comuna valida.");						
				$('#confirm-dialog').modal('toggle');
				$("#btn_direccion_add").prop('disabled', false);
				return;
			}
			

			// AJAX request
			$.ajax({
				url: 'data_reg_usuario_add_direccion.php',
				type: 'post',
				data: fd,
				contentType: false,
				processData: false,
				success: function(response){
					$("#btn_direccion_add").prop('disabled', false);

				    if(response == "1"){
						$('#rec_direccion_add').val("")
						$('#rec_comuna_add').val("")
						$('#TarjetaModal').modal('toggle');
						$("#divid").load("data_get_direccion.php?nID=" + ID);
				    }
				    else{ 
						if(response == 2){							
							$('#confirm-title').text("Agregar Dirección.");
							$('#confirm-body').text("Direccion ya se encuentra registrada.");
							$('#confirm-dialog').modal('toggle');
						}
						else{
							$('#confirm-title').text("Agregar Dirección.");
							$('#confirm-body').text("Dirección no subida.");
							$('#confirm-dialog').modal('toggle');
						}
				    }
				}
			});
		});
		
		$('#btn_direccion_del').click(function(){

			$("#btn_direccion_del").prop('disabled', true); 

			var fd = new FormData();
			var direccion = $('#rec_direccion_del').text();			
			var id_direccion = $('#rec_id_direccion_del').val();
			var ID = $('#nID').val();
						
			fd.append('id',id_direccion);

			// AJAX request
			$.ajax({
				url: 'data_reg_usuario_del_direccion.php',
				type: 'post',
				data: fd,
				contentType: false,
				processData: false,
				success: function(response){
					$("#btn_direccion_del").prop('disabled', false); 

					if(response != 0){
						$("#divid").load("data_get_direccion.php?nID=" + ID);	
						$('#Tarjeta_Del_Modal').modal('toggle');
					}else{
						alert('identificación no eliminada.');
					}
				}
			});
		});
		
		
	});
  </script>
 

</body>

</html>
