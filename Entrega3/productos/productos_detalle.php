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

	<title>Mi Tienda - Detalle Producto</title>

	<!-- Custom fonts for this template-->
	<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	
	<!-- Custom styles for this template-->
	<link href="../css/sb-admin-2.min.css" rel="stylesheet">
  
	<!-- Custom styles for this page -->
	<link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

	<link href="../css/bootstrapValidator.min.css" rel="stylesheet">
   
</head>

<body id="page-top" onload="revisar()">

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
			  
			  <h1 class="h3 mb-4 text-gray-800">Detalle Producto</h1>
			  
			  <!-- Menu Cerrar Session -->
			  <?php include("../menCerrarSesion.php"); ?>
			  <!-- Menu Cerrar Session -->

			</nav>
			<!-- End of Topbar -->

			<?php				
				
					try {
						$nID_PRODUCTO = mysqli_real_escape_string($con,(strip_tags($_POST["nID_PRODUCTO"],ENT_QUOTES)));													
						
						$sql = mysqli_query($con, "SELECT * FROM Productos WHERE id= $nID_PRODUCTO ");
						if(mysqli_num_rows($sql) == 0){
							echo "<script>window.location.href='productos.php';</script>";
							exit;
						}else{
							$row = mysqli_fetch_assoc($sql);
						}												
						$nombre_producto = $row["nombre"];	
						$id_tienda = $row["id_tienda"];				
	
					} catch (Exception $e) {
						echo 'Excepción capturada: ',  $e->getMessage(), "\n";
						exit;
					}
				
					$result = mysqli_query($con, "SELECT * FROM Tiendas where id = ".$id_tienda);
					$row1 = mysqli_fetch_assoc($result)
				
			

			?>
			<!-- Begin Page Content -->
			<div class="container-fluid">
				<form id="update_persona" name="update_persona" method="POST" action="#" data-toggle="validator">				
					<input type="hidden" id="nID_PRODUCTO" name="nID_PRODUCTO" value="<?php echo mysqli_real_escape_string($con,(strip_tags($_POST["nID_PRODUCTO"],ENT_QUOTES))) ?>" />
					<div class="card o-hidden border-0 shadow-lg my-5">
						<div class="card-body p-0">
							<div class="row">
								<div class="col-lg-10">
									<div class="p-5">										
										
											<div class="form-group row">
												<div class="col-sm-12 mb-12 mb-sm-12">
													<select class="form-select" aria-label="Tienda" name="rec_SelectTienda" id="rec_SelectTienda">
													<?php
															$result2 = mysqli_query($con, "SELECT * FROM Tiendas order by id");
															while ($row2 = mysqli_fetch_assoc($result2)){ 
																if ($row1["nombre"]==$row2["nombre"]){
																	echo "<option value=".$row2["id"]." selected>".$row2["nombre"]."</option>";
																}
																else{
																	echo "<option value=".$row2["id"].">".$row2["nombre"]."</option>";
																}											
															}
														?>
													</select>												
												</div>			
											</div>										
											<div class="form-group row">
												<div class="col-sm-3 mb-1 mb-sm-0">
													<input type="text" required class="form-control form-control-user" name="rec_nombre" id="rec_nombre" placeholder="Rut" value="<?php echo($nombre_producto); ?>">
												</div>
												<div class="col-sm-4">
													<input type="text" required class="form-control form-control-user" name="rec_descripcion" id="rec_descripcion" placeholder="Descripción" value="<?php echo $row ['descripcion']; ?>">
												</div>
												<div class="col-sm-5">
													<input type="number" required class="form-control form-control-user" name="rec_precio" id="rec_precio" placeholder="Precio" value="<?php echo $row ['precio']; ?>">
												</div>                  				
											</div>	
											<div class="form-group row">										
												<div class="form-check col-sm-6">
													<input class="form-check-input" type="radio" name="tipo_producto" value="Comestible" id="ck_Comestible"  <?php if($row["tipo_producto"]=="Comestible"){ echo("checked");} ?> >
													<label class="form-check-label" for="ck_Comestible">Comestible</label>
												</div>
												<div class="form-check col-sm-6">
													<input class="form-check-input" type="radio" name="tipo_producto" value="No Comestible" id="ck_No_Comestible" <?php if($row["tipo_producto"]=="No Comestible"){ echo("checked");} ?> >
													<label class="form-check-label" for="ck_No_Comestible">No Comestible</label>
												</div>										
											</div>
											<!--- Productos no comestibles: ancho, largo, alto, peso --->
											<div id="div_No_Comestibles">
										
												<div class="form-group row" >
													<div class="col-sm-3">												
														<label for="rec_ancho">Ancho</label>
														<input type="number" class="form-control form-control-user" name="rec_ancho" id="rec_ancho" placeholder="Ancho" value="<?php echo($row ['ancho']);  ?>">
													</div>
													<div class="col-sm-3">
														<label for="rec_ancho">Largo</label>
														<input type="number" class="form-control form-control-user" name="rec_largo" id="rec_largo" placeholder="Largo" value="<?php echo $row ['largo']; ?>">
													</div>
													<div class="col-sm-3">
														<label for="rec_ancho">Alto</label>
														<input type="number" class="form-control form-control-user" name="rec_alto" id="rec_alto" placeholder="Alto" value="<?php echo $row ['alto']; ?>">
													</div> 
													<div class="col-sm-3">
														<label for="rec_ancho">Peso</label>
														<input type="number" class="form-control form-control-user" name="rec_peso_no_comestible" id="rec_peso_no_comestible" placeholder="Peso" value="<?php echo $row ['peso']; ?>">
													</div> 
												</div>
											</div>
																		
											<div id="div_Comestibles">
											
												<div class="form-group row" >
													<div class="col-sm-12">												
														<label for="rec_fecha_expiracion">Fecha Expiración</label>
														<input type="date" class="form-control form-control-user" name="rec_fecha_expiracion" id="rec_fecha_expiracion" placeholder="Fecha Expiración" value="<?php echo($row ['fecha_expiracion']);  ?>">
													</div>
												</div>
												<div class="form-group row" >
													<div class="form-check col-5">
														<input class="form-check-input" type="radio" name="categoria" id="ck_Congelados" value="Congelados"  <?php if($row["categoria"]=="Congelados"){ echo("checked");} ?> >
														<label class="form-check-label" for="ck_Congelados">Congelados</label>
													</div>
													<div class="form-check col-4">
														<input class="form-check-input" type="radio" name="categoria" id="ck_frescos" value="frescos" <?php if($row["categoria"]=="frescos"){ echo("checked");} ?> >
														<label class="form-check-label" for="ck_frescos">Frescos</label>
													</div>
													<div class="form-check col-3">
														<input class="form-check-input" type="radio" name="categoria" id="ck_conserva" value="conserva" <?php if($row["categoria"]=="conserva"){ echo("checked");} ?> >
														<label class="form-check-label" for="ck_conserva">Conserva</label>
													</div>
												</div>

												<div class="form-group row" >
													<div class="col-sm-12" id="div_congelados">
														<label for="rec_peso_comestible">Peso</label>
														<input type="number" class="form-control form-control-user" name="rec_peso_comestible" id="rec_peso_comestible" placeholder="Peso" value="<?php echo $row ['peso']; ?>">
													</div>

													<div class="col-sm-12" id="div_frescos">
														<label for="rec_peso_tiempo_sin_conservacion">Tiempo sin conservación</label>
														<input type="number" class="form-control form-control-user" name="rec_peso_tiempo_sin_conservacion" id="rec_peso_tiempo_sin_conservacion" placeholder="Tiempo sin conservación" value="<?php echo $row['tiempo_sin_refrigeracion']; ?>">
													</div>

													<div class="col-sm-12" id="div_conserva">
														<label >Método conservación</label>
														<input type="text" class="form-control form-control-user" name="rec_metodo_conservacion" id="rec_metodo_conservacion" placeholder="Método de conservación" value="<?php echo $row['metodo_conservacion']; ?>">													
													</div>
												</div>										
											</div>
											<div class="form-group row">							
												<div class="col-sm-6 mb-3 mb-sm-0">													
													<input type="button" id="save" name="save" class="btn btn-primary btn-user btn-block" value="Guardar datos">
												</div>
												<div class="col-sm-6 mb-3 mb-sm-0">
													<a href="../productos/productos.php" class="btn btn-secondary btn-user btn-block">Volver</a>
												</div>							
											</div>	
																									
									<div>
								</div>
							<div>
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
		$("#collapseProductos").addClass("show"); 

		$("#iconUpdates").html("<img src='images/ajax-loader_small.gif' />    ");		
		$("#iconUpdates").hide();

		

		$('#ck_Comestible').on('change', function(){ // on change of state
			if(this.checked) // if changed state is "CHECKED"
			{
				$("#div_Comestibles").show();
				$("#div_No_Comestibles").hide();
				
			}
		});

		$('#ck_No_Comestible').on('change', function(){ // on change of state
			if(this.checked) // if changed state is "CHECKED"
			{
				$("#div_No_Comestibles").show();
				$("#div_Comestibles").hide();				
				
			}
		});

		$('#ck_Congelados').on('change', function(){ // on change of state
			if(this.checked) // if changed state is "CHECKED"
			{
				$("#div_congelados").show();
				$("#div_frescos").hide();
				$("#div_conserva").hide();
				
			}
		});

		$('#ck_frescos').on('change', function(){ // on change of state
			if(this.checked) // if changed state is "CHECKED"
			{
				$("#div_frescos").show();
				$("#div_congelados").hide();
				$("#div_conserva").hide();
				
			}
		});

		$('#ck_conserva').on('change', function(){ // on change of state
			if(this.checked) // if changed state is "CHECKED"
			{
				$("#div_conserva").show();
				$("#div_congelados").hide();
				$("#div_frescos").hide();
				
			}
		});

		$('#save').click(function(){
			$('#update_persona').bootstrapValidator('validate');			
			if ($('#update_persona').data('bootstrapValidator').isValid()) {
				event.preventDefault();	
				var tipo_producto = $('input[name="tipo_producto"]:checked').val();

				var fd = new FormData();
				fd.append('id_producto',$('#nID_PRODUCTO').val());
				fd.append('id_tienda',$('#rec_SelectTienda').val());
				fd.append('nombre',$('#rec_nombre').val());
				fd.append('descripcion',$('#rec_descripcion').val());
				fd.append('precio',$('#rec_precio').val());
				fd.append('tipo_producto',tipo_producto);
				if (tipo_producto == "No Comestible"){
					fd.append('ancho',$('#rec_ancho').val());
					fd.append('largo',$('#rec_largo').val());
					fd.append('alto',$('#rec_alto').val());
					fd.append('peso',$('#rec_peso_no_comestible').val());
				}
				else{
					fd.append('fecha_expiracion',$('#rec_fecha_expiracion').val());
					var categoria = $('input[name="categoria"]:checked').val();
					fd.append('categoria',categoria);
					if (categoria == "Congelados"){
						fd.append('peso',$('#rec_peso_comestible').val());
					}
					else {
						if (categoria == "frescos"){
							fd.append('tiempo_sin_refrigeracion',$('#rec_peso_tiempo_sin_conservacion').val());
						}
						else {
						if (categoria == "conserva"){
								fd.append('metodo_conservacion',$('#rec_metodo_conservacion').val());
							}
						}
					}
				}				
				$("#iconUpdates").show();

				// AJAX request
				$.ajax({
					url: 'data_reg_productos_add.php',
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

		if( $('#ck_Comestible').prop('checked') ) {
			$("#div_Comestibles").show();
			$("#div_No_Comestibles").hide();
		}

		if( $('#ck_No_Comestible').prop('checked') ) {
			$("#div_No_Comestibles").show();
			$("#div_Comestibles").hide();
		}
	

		
		if( $('#ck_Congelados').prop('checked') ) {
			$("#div_congelados").show();
			$("#div_frescos").hide();
			$("#div_conserva").hide();		
		}

		if( $('#ck_frescos').prop('checked') ) {
			$("#div_frescos").show();
			$("#div_congelados").hide();
			$("#div_conserva").hide();		
		}

		if( $('#ck_conserva').prop('checked') ) {
			$("#div_conserva").show();
			$("#div_congelados").hide();
			$("#div_frescos").hide();	
		}
		
	});

	function revisar(){
		
	}

  </script>
 

</body>

</html>
