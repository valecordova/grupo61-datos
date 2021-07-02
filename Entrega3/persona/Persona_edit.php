<?php

  if(empty($_SESSION)) // if the session not yet started 
   session_start();

  if(!isset($_SESSION['username'])) { //if not yet logged in
    header("Location: ../login.php");// send to login page
    exit;
  }

  include("../config.php");
  
  require("../js/validar_rut.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>WillBox Administración - Agregar Personas</title>

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
			  
			  <!-- Menu Cerrar Session -->
			  <?php include("../menCerrarSesion.php"); ?>
			  <!-- Menu Cerrar Session -->

			</nav>
			<!-- End of Topbar -->

			<!-- Begin Page Content -->
			<div class="container-fluid">
				<form id="update_persona" name="update_persona" method="POST" action="#" data-toggle="validator">
					<input type="hidden" id="nID_PERSONA" name="nID_PERSONA" value="<?php echo mysqli_real_escape_string($con,(strip_tags($_POST["nID_PERSONA"],ENT_QUOTES))) ?>" />
					<input type="hidden" id="pesan" name="pesan" />
					
					<div class="card o-hidden border-0 shadow-lg my-5">
					  <div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">         
						  <div class="col-lg-10">
							<div class="p-5"> 						
								<?php								
									try {
										$nID_PERSONA = mysqli_real_escape_string($con,(strip_tags($_POST["nID_PERSONA"],ENT_QUOTES)));													
										
										$sql = mysqli_query($con, "SELECT * FROM PERSONA WHERE ID_PERSONA='$nID_PERSONA'");
										if(mysqli_num_rows($sql) == 0){
											echo "<script>window.location.href='Personas.php';</script>";
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
									<input type="text" required class="form-control form-control-user" name="rec_Rut" id="rec_Rut" placeholder="Rut" value="<?php echo $row ['RUT']; ?>">
								  </div>
								  <div class="col-sm-4">
									<input type="text" required class="form-control form-control-user" name="rec_Nombres" id="rec_Nombres" placeholder="Nombres" value="<?php echo $row ['NOMBRES']; ?>">
								  </div>
								  <div class="col-sm-5">
									<input type="text" required class="form-control form-control-user" name="rec_Apellidos" id="rec_Apellidos" placeholder="Apellidos" value="<?php echo $row ['APELLIDOS']; ?>">
								  </div>                  				
								</div>
								<div class="form-group row">					
									<div class="col-sm-2">
										<input type="number" class="form-control form-control-user" name="rec_Edad" id="rec_Edad" placeholder="Edad" value="<?php echo $row ['EDAD']; ?>">
									</div>
									<div class="col-sm-5">                  
										<input type="email" class="form-control form-control-user" name="rec_Email" id="rec_Email" placeholder="Email" value="<?php echo $row ['EMAIL']; ?>">
									</div>
									<div class="col-sm-5">
										<input type="text" class="form-control form-control-user" name="rec_Direccion" id="rec_Direccion" placeholder="Dirección" value="<?php echo $row ['DIRECCION']; ?>">
									</div>
								</div>						
								<div class="form-group row">
									<div class="col-xs-12 col-sm-12 col-md-6">
										<div class="row form-group">
										   <div class="col-xs-12 mx-sm-3">
												<select name="rec_TIPO_PERSONA" id="rec_TIPO_PERSONA" class="form-control" required>
													<option value="Residente" <?=$row['TIPO_PERSONA'] == 'Residente' ? ' selected="selected"' : '';?> >Residente</option>
													<option value="Visita" <?=$row['TIPO_PERSONA'] == 'Visita' ? ' selected="selected"' : '';?>>Visita</option>						  
													<option value="Contratista" <?=$row['TIPO_PERSONA'] == 'Contratista' ? ' selected="selected"' : '';?>>Contratista</option>
												</select>
										   </div>									               
										   <div class="col-xs-12  mx-sm-3">
												<select name="rec_ESTADO" id="rec_ESTADO" class="form-control" required>
													<option value="Activa" <?=$row['ESTADO'] == 'Activa' ? ' selected="selected"' : '';?> >Activa</option>
													<option value="Inactiva" <?=$row['ESTADO'] == 'Inactiva' ? ' selected="selected"' : '';?>>Inactiva</option>					  
													<option value="Bloqueada" <?=$row['ESTADO'] == 'Bloqueada' ? ' selected="selected"' : '';?>>Bloqueada</option>
												</select>
											</div>
										</div>
										<div id="divid" class="col-xs-12 col-sm-12 col-md-12">
											<div class="row form-group col-md-9 overflow-auto scrollbar scrollbar-primary">
											  <?php
												  $nik1 = mysqli_real_escape_string($con,(strip_tags($_POST["nID_PERSONA"],ENT_QUOTES)));
												  $result = mysqli_query($con, "SELECT * FROM PERSONA_TARJETA WHERE ID_PERSONA='$nik1'");

												  echo "<table class='table table-hover table-inverse'>";
												  echo "<tr>";
												  echo "<th>Identificación</th>";											
												  //echo "<th>Tipo</th>";
												  echo "<th><button type='button' onclick='Limpiar()' class='fa fa-plus-circle btn-info' data-toggle='modal' data-target='#TarjetaModal'/></th>";
												  echo "</tr>";

												  while ($row1 = mysqli_fetch_assoc($result)){ 
													  echo "<tr>";
													  echo "<td>" . $row1["IDENTIFICACION"] . "</td>";													 
													  echo "<td><button id='".$row1["IDENTIFICACION"]."' type='button' class='fa fa-times btn-outline-danger' onclick='AbrirModal(this);';  /></td>";
													  echo "</tr>";	
												  }
												  echo "</table>";
											  ?>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-3">
										<img alt="foto_persona" 
											src="<?php if ($row ['IMAGEN'] != "") { echo $row ['IMAGEN']; }else { echo '../imagenes/fotos_personas/NN.png';}; ?>"  
												id="rec_IMG_URL_IMAGEN"
												name="rec_IMG_URL_IMAGEN" style="cursor: pointer" height="200" width="200" onClick="fnOpenImage('<?php echo($row ['IMAGEN']);?>')" data-p1='rec_URL_IMAGEN' />
									</div>
									<div class="col-xs-12 col-sm-6 col-md-3">
										<button type="button" class="btn btn-info" data-toggle="modal" data-target="#uploadModal" onclick="Limpiar()" >
												Actualizar
										</button>
										<button id='btn_clear_img' type="button" class="btn btn-outline-danger" >
												Quitar
										</button>
									</div>								
								</div>						
								<div class="form-group row">							
									<div class="col-sm-6 mb-3 mb-sm-0">
										<input type="button" id="save" name="save" class="btn btn-primary btn-user btn-block" value="Guardar datos">
									</div>
									<div class="col-sm-6 mb-3 mb-sm-0">
										<a href="../persona/Personas.php" class="btn btn-secondary btn-user btn-block">Volver</a>								
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

  <!-- Modal Visualizar Imagen -->
	<div id="imageviewer-dialog" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Imagen</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div id='imageviewer-dialog-content' name="imageviewer-dialog"></div>
				</div>

			</div>
		</div>
	</div>

<!-- Modal -->
<div id="uploadModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<!-- Form -->
			<form method='post' action='' enctype="multipart/form-data">
				<div class="modal-header">
					<h5 class="modal-title">Subir Imagen</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Seleccionar archivo.</p>
					<input type='file' name='file' id='file' class='form-control form-control-user' >
					<br>        
			        <!-- Preview-->
					<div id='preview' name="preview" src="#"></div>
				</div>
				<div class="modal-footer">
					<input type='button' class='btn btn-primary btn-user btn-block' value='Upload' id='btn_upload'>
				</div>
			</form>
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
<div id="Tarjeta_Del_Modal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<!-- Form -->
			<form method='post' action='' enctype="multipart/form-data">
				<div class="modal-header">
					<h5 class="modal-title">Eliminar tarjeta</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Ingresar tarjeta.</p>
					<span class="label label-default" id="rec_tarjeta_del" name="rec_tarjeta_del"></span>					
				</div>
				<div class="modal-footer">
					<input type='button' class='btn btn-primary btn-user btn-block' value='Eliminar' id='btn_tarjeta_del'>
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
		$('#rec_tarjeta_del').text(valor.id);
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

		// se visualiza 
		$("#collapsePersonas").addClass("show"); 

		$('#update_persona').bootstrapValidator({        
			feedbackIcons: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},			
			fields: {
				rec_Rut: {
					validators: {							
						notEmpty: { message: 'Por favor, ingresar Rut'}
					}
				},
				rec_Nombres: {
					validators: {
						stringLength: {min: 5, message: 'Mínimo de 5 caracteres'},
						notEmpty: {	message: 'Por favor, ingresar Nombres'}
					}
				},
				 rec_Apellidos: {
					validators: {
						stringLength: {min: 5, message: 'Mínimo de 5 caracteres. '},
						notEmpty: {	message: 'Por favor, ingresar Apellidos'}
					}
				},
				rec_Edad: {
					validators: {
						 stringLength: {max: 3, message: 'Máximo de 3 caracteres. '},
						 regexp: {
							 regexp: /^[0-9]+$/,
							 message: 'El teléfono solo puede contener números. '
						 }						
					}
				}

			}
		});


		$("#iconUpdates").html("<img src='images/ajax-loader_small.gif' />    ");		
		$("#iconUpdates").hide();

		$('#btn_tarjeta_del').click(function(){

			$("#btn_tarjeta_del").prop('disabled', true); 

			var fd = new FormData();
			var tarjeta = $('#rec_tarjeta_del').text();
			var ID_PERSONA = $('#nID_PERSONA').val();
			fd.append('tarjeta',tarjeta);
			fd.append('ID_PERSONA',ID_PERSONA );

			// AJAX request
			$.ajax({
				url: 'data_reg_persona_del_tarjeta.php',
				type: 'post',
				data: fd,
				contentType: false,
				processData: false,
				success: function(response){
					$("#btn_tarjeta_del").prop('disabled', false); 

					if(response != 0){
						$("#divid").load("data_get_tarjeta.php?nID_PERSONA=" + ID_PERSONA);	
						$('#Tarjeta_Del_Modal').modal('toggle');
					}else{
						alert('identificación no eliminada.');
					}
				}
			});
		});

		$('#save').click(function(){
			$('#update_persona').bootstrapValidator('validate');			
			if ($('#update_persona').data('bootstrapValidator').isValid()) {

				if ($.trim($('#rec_Edad').val()) != ""){
					if ($('#rec_Edad').val() > 120){
						$('#confirm-title').text("Atención.");
						$('#confirm-body').text("Edad ingresada es invalida!");						
						$('#confirm-dialog').modal('toggle');
						return;
					}
				}


				event.preventDefault();						
				var fd = new FormData();
				fd.append('rec_Rut',$('#rec_Rut').val());
				fd.append('nID_PERSONA',$('#nID_PERSONA').val());
				fd.append('rec_Nombres',$('#rec_Nombres').val());
				fd.append('rec_Apellidos',$('#rec_Apellidos').val());
				fd.append('rec_Edad',$('#rec_Edad').val());
				fd.append('rec_Email',$('#rec_Email').val());
				fd.append('rec_TIPO_PERSONA',$('#rec_TIPO_PERSONA').val());
				fd.append('rec_Direccion',$('#rec_Direccion').val());
				fd.append('rec_ESTADO',$('#rec_ESTADO').val());

				$("#iconUpdates").show();

				// AJAX request
				$.ajax({
					url: 'data_reg_persona_add.php',
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
							$('#confirm-body').text("Rut ingresado es invalido!");						
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
	  
		$('#btn_tarjeta_add').click(function(){
		    event.preventDefault();

			$("#btn_tarjeta_add").prop('disabled', true); 

			var fd = new FormData();
			var tarjeta = $('#rec_tarjeta_add').val();
			var ID_PERSONA = $('#nID_PERSONA').val();
			fd.append('tarjeta',$.trim(tarjeta));
			fd.append('ID_PERSONA',ID_PERSONA );

			if ($.trim(tarjeta) == ""){
				$('#confirm-title').text("Agregar Tarjeta.");
				$('#confirm-body').text("Por favor, ingresar una identificación valida.");						
				$('#confirm-dialog').modal('toggle');
				$("#btn_tarjeta_add").prop('disabled', false);
				return;
			}

			// AJAX request
			$.ajax({
				url: 'data_reg_persona_add_tarjeta.php',
				type: 'post',
				data: fd,
				contentType: false,
				processData: false,
				success: function(response){
					$("#btn_tarjeta_add").prop('disabled', false);

				    if(response == "1"){
						$('#rec_tarjeta_add').val("")
						$('#TarjetaModal').modal('toggle');
						$("#divid").load("data_get_tarjeta.php?nID_PERSONA=" + ID_PERSONA);
				    }
				    else{ 
						if(response == 2){							
							$('#confirm-title').text("Agregar Tarjeta.");
							$('#confirm-body').text("Tarjeta ya se encuentra registrada.");						
							$('#confirm-dialog').modal('toggle');
						}
						else{
							$('#confirm-title').text("Agregar Tarjeta.");
							$('#confirm-body').text("Identificación no subida.");						
							$('#confirm-dialog').modal('toggle');
						}
				    }
				}
			});
		});
	  
		$('#btn_upload').click(function(){
			var fd = new FormData();
			var files = $('#file')[0].files[0];
			var ID_PERSONA = $('#nID_PERSONA').val();
			fd.append('file',files);
			fd.append('ID_PERSONA',ID_PERSONA );

			$("#iconUpdates").show();
			$("#btn_upload").prop('disabled', true); 

			// AJAX request
			$.ajax({
				url: 'data_reg_update_foto.php',
				type: 'post',
				data: fd,
				contentType: false,
				processData: false,
				success: function(response){
				
				if(response == 0){
					$('#confirm-title').text("Imagen no subida.");
					$('#confirm-body').text(response);						
					$('#confirm-dialog').modal('toggle');
				}
				else if (response == 1)
				{
					$('#confirm-title').text("Imagen no subida.");
					$('#confirm-body').text('Problema de carga de foto');						
					$('#confirm-dialog').modal('toggle');
				}
				else{
					$("#rec_IMG_URL_IMAGEN").attr('src',response);
					// Show image preview
					$('#preview').empty();
					$('#preview').append("<img src='"+response+"' width='200' height='200' style='display: inline-block;'>");					
					$('#uploadModal').modal('toggle');
				}
				$("#iconUpdates").hide();
				$("#btn_upload").prop('disabled', false); 
			  }
			});
		});

		$('#btn_clear_img').click(function(){
			var ID_PERSONA = $('#nID_PERSONA').val();
			var fd = new FormData();
			fd.append('ID_PERSONA',ID_PERSONA );

			// AJAX request
			$.ajax({
			  url: 'data_reg_delete_foto.php',
			  type: 'post',
			  data: fd,
			  contentType: false,
			  processData: false,
			  success: function(response){
				if(response != 0){
				    $("#rec_IMG_URL_IMAGEN").attr('src',response);				
				}else{
				  alert('imagen no actualizada');
				}
			  }
			});
		  });
	});

	function fnOpenImage(img_field) {
 
		var data = "<img id='img_person' src='" + img_field + "?rnd=" + Math.random() + "' />"

		$('#imageviewer-dialog-content').html(data);
		$('#img_person').css('height', 450);
		$('#img_person').css('width', 450);
	
		$('#imageviewer-dialog').modal('toggle');		

	};

  </script>
 

</body>

</html>
