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
          
          <h1 class="h3 mb-4 text-gray-800">Agregar Persona</h1>
          
          <!-- Menu Cerrar Session -->
		  <?php include("../menCerrarSesion.php"); ?>
		  <!-- Menu Cerrar Session -->

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
			<div class="card o-hidden border-0 shadow-lg my-5">
			  <div class="card-body p-0">
				<!-- Nested Row within Card Body -->
				<div class="row">         
				  <div class="col-lg-10">
					<div class="p-5"> 
						<?php
							if(isset($_POST['add'])){
								$RUT						= mysqli_real_escape_string($con,(strip_tags($_POST["rec_Rut"],ENT_QUOTES)));//Escanpando caracteres
								$NOMBRES		    		= mysqli_real_escape_string($con,(strip_tags($_POST["rec_Nombres"],ENT_QUOTES)));//Escanpando caracteres
								$APELLIDOS					= mysqli_real_escape_string($con,(strip_tags($_POST["rec_Apellidos"],ENT_QUOTES)));//Escanpando caracteres 
								$EDAD	 					= mysqli_real_escape_string($con,(strip_tags($_POST["rec_Edad"],ENT_QUOTES)));//Escanpando caracteres 
								$EMAIL	     				= mysqli_real_escape_string($con,(strip_tags($_POST["rec_Email"],ENT_QUOTES)));//Escanpando caracteres 
								$TIPO_PERSONA				= mysqli_real_escape_string($con,(strip_tags($_POST["rec_TIPO_PERSONA"],ENT_QUOTES)));//Escanpando caracteres 
								$DIRECCION					= mysqli_real_escape_string($con,(strip_tags($_POST["rec_Direccion"],ENT_QUOTES)));//Escanpando caracteres 

								if ($EDAD > 120){
									echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. La edad ingresada es inválida!</div>';
								}
								else{

									if (valida_rut($RUT)){										
										
										$ID_USUARIO_MODIFICACION	= mysqli_real_escape_string($con,$_SESSION['id']);//Escanpando caracteres 
										
										$cek = mysqli_query($con, "SELECT * FROM PERSONA WHERE replace(REPLACE(rut,'-',''),'.','')  =replace(REPLACE('$RUT','-',''),'.','')");						
										if(mysqli_num_rows($cek) == 0){
												$insert = mysqli_query($con, "INSERT INTO PERSONA(RUT, NOMBRES, APELLIDOS, EDAD, EMAIL, TIPO_PERSONA, ID_USUARIO_MODIFICACION, ESTADO, DIRECCION ) VALUES('$RUT','$NOMBRES', '$APELLIDOS', '$EDAD', '$EMAIL', '$TIPO_PERSONA', '$ID_USUARIO_MODIFICACION', 'Activa', '$DIRECCION')") or die(mysqli_error());
												if($insert){									
													echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho! Los datos han sido guardados con éxito.</div>';
												}else{								
													echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar los datos !</div>';
												}
											 
										}else{
											echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. identificador de persona ya exite!</div>';
										}
									}
									else{
										echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. rut ingresado invalido!</div>';
									}
								}
							}
						?>		
						
			
					  <form class="user" action="" method="post"> 
						<div class="form-group row">
						  <div class="col-sm-3 mb-1 mb-sm-0">
							<input type="text" required class="form-control form-control-user" name="rec_Rut" id="rec_Rut" placeholder="Rut" value="<?php echo($RUT); ?>">
						  </div>
						  <div class="col-sm-4">
							<input type="text" required class="form-control form-control-user" name="rec_Nombres" id="rec_Nombres" placeholder="Nombres" value="<?php echo($NOMBRES); ?>">
						  </div>
						  <div class="col-sm-5">
							<input type="text" required class="form-control form-control-user" name="rec_Apellidos" id="rec_Apellidos" placeholder="Apellidos" value="<?php echo($APELLIDOS); ?>">
						  </div>                  				
						</div>
						<div class="form-group row">					
							<div class="col-sm-2">
								<input type="number" class="form-control form-control-user" name="rec_Edad" id="rec_Edad" placeholder="Edad" value="<?php echo($EDAD); ?>">
							</div>
							<div class="col-sm-10">                  
								<input type="email" class="form-control form-control-user" name="rec_Email" id="rec_Email" placeholder="Email" value="<?php echo($EMAIL); ?>">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-12">
								<input type="text" class="form-control form-control-user" name="rec_Direccion" id="rec_Direccion" placeholder="Dirección" value="<?php echo($DIRECCION); ?>">
							</div>
						</div>

						<div class="form-group row">
							<div class="col-sm-6 mb-3 mb-sm-0">						
								<select name="rec_TIPO_PERSONA" id="rec_TIPO_PERSONA" class="form-control" required>
									<option value="Residente" <?php if ( isset($TIPO_PERSONA) === FALSE){echo("selected");}	else{ if($TIPO_PERSONA === "Residente"){echo("selected");}} ?>>Residente</option>
									<option value="Visita" <?php if($TIPO_PERSONA === "Visita"){ echo("selected"); } ?>>Visita</option>						  
									<option value="Contratista" <?php if($TIPO_PERSONA === "Contratista"){ echo("selected"); }?>>Contratista</option>						  
								</select>
							</div>
						</div>
						<input type="submit" name="add" class="btn btn-primary btn-user btn-block" value="Registrar Persona">
						
						<hr>                
					  </form>                      
					</div>
				  </div>
				</div>
			  </div>
			</div>
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

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>
  
 
 <script>
    $(document).ready(function() {
		if ((/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))==true) {                    
			$("body").toggleClass("sidebar-toggled");
			$(".sidebar").toggleClass("toggled");
			if ($(".sidebar").hasClass("toggled")) {
			  $('.sidebar .collapse').collapse('hide');
			};
		}

		// se visualiza 
		$("#collapsePersonas").addClass("show"); 
	} );   
    
</script>
 
</body>

</html>
