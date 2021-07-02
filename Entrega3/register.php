<?php 
	include "config.php";  
  	require("js/validar_rut.php");	  
	  
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Registrar Usuario</title>

  <!-- Custom fonts for this template-->  
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this page -->
	<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="css/bootstrapValidator.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
	<div class="container">
    	<div class="card o-hidden border-0 shadow-lg my-5">
      		<div class="card-body p-0">
        	<!-- Nested Row within Card Body -->
        		<div class="row">
          			<div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          			<div class="col-lg-7">
            			<div class="p-5">
              				<div class="text-center">
                				<h1 class="h4 text-gray-900 mb-4">Crear cuenta usuario!</h1>
                				<span class="validateTips" id="iconUpdates">  </span>
              				</div>

							<?php
								if(isset($_POST['add'])){
									$RUT			= mysqli_real_escape_string($con,(strip_tags($_POST["rec_rut"],ENT_QUOTES)));//Escanpando caracteres
									$NOMBRES		= mysqli_real_escape_string($con,(strip_tags($_POST["rec_nombre"],ENT_QUOTES)));//Escanpando caracteres
									$EDAD	 		= mysqli_real_escape_string($con,(strip_tags($_POST["rec_edad"],ENT_QUOTES)));//Escanpando caracteres 
									$DIRECCION	 	= mysqli_real_escape_string($con,(strip_tags($_POST["rec_direccion"],ENT_QUOTES)));//Escanpando caracteres 
									$COMUNA	 		= mysqli_real_escape_string($con,(strip_tags($_POST["rec_comuna"],ENT_QUOTES)));//Escanpando caracteres 
									
									if ($EDAD > 120){
										echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. La edad ingresada es inválida!</div>';
									}
									else{

										if (valida_rut($RUT)){		
											$cek = mysqli_query($con, "SELECT * FROM Usuarios WHERE rut = replace(REPLACE('$RUT','-',''),'.','')");
											if(mysqli_num_rows($cek) == 0){
												// Se debe llamar a una funcion para crear la contraseña
												// CrearContrasena
												$contrasena = mysqli_query($con, 'SELECT CrearContrasena() as clave');
												$row = mysqli_fetch_assoc($contrasena);
												$clave = $row["clave"];
												
												$insert = mysqli_query($con, "INSERT INTO Usuarios(rut,nombre,edad,id_perfil,clave) VALUES(replace(REPLACE('$RUT','-',''),'.',''),'$NOMBRES', $EDAD, 1,'$clave')") or die(mysqli_error());
												if($insert){
													$rs = mysqli_query($con, 'SELECT @@identity AS id');
													$row1 = mysqli_fetch_assoc($rs);
													$id_usuario = $row1["id"];
													
													$insert2 = mysqli_query($con, "INSERT INTO UsuariosDirecciones(id_usuario,direccion,comuna) VALUES($id_usuario,'$DIRECCION', '$COMUNA')") or die(mysqli_error());
													if($insert2){
														echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho! Los datos han sido guardados con éxito. Su nueva contraseña es: '.$clave.' </div>';
													}
													else{								
														echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar los datos !</div>';
													}
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
									<div class="col-sm-6 mb-3 mb-sm-0">
                    					<input type="text" required class="form-control form-control-user" id="rec_rut" name="rec_rut" placeholder="Rut" value="<?php echo($RUT); ?>">
                  					</div>
                  					<div class="col-sm-6 mb-3 mb-sm-0">
                    					<input type="text" required class="form-control form-control-user" id="rec_nombre" name="rec_nombre" placeholder="Nombres" value="<?php echo($NOMBRES); ?>">
                  					</div>                  					
                				</div>
								<div class="form-group row">
									<div class="col-sm-6 mb-3 mb-sm-0">
										<input type="number" required class="form-control form-control-user" id="rec_edad" name="rec_edad" placeholder="edad" value="<?php echo($EDAD); ?>">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-12 mb-6">
										<input type="text" required class="form-control form-control-user" id="rec_direccion" name="rec_direccion" placeholder="Dirección" value="<?php echo($DIRECCION); ?>">
									</div>									
								</div>
								<div class="form-group row">
									<div class="col-sm-12 mb-6">
										<input type="text" required class="form-control form-control-user" id="rec_comuna" name="rec_comuna" placeholder="Comuna" value="<?php echo($COMUNA); ?>">
									</div>									
								</div>

								<input type="submit" name="add" class="btn btn-primary btn-user btn-block" value="Registrar cuenta">
              				</form>
              				<hr>
							<!---
							<div class="text-center">
								<a class="small" href="forgot-password.php">¿Has olvidado tu contraseña?</a>
							</div>
							--->
							<div class="text-center">
								<a class="small" href="login.php">¿Ya tienes una cuenta? ¡Acceso!</a>
							</div>
            			</div>
          			</div>
        		</div>
      		</div>
    	</div>

  	</div>
  
	<!-- Bootstrap core JavaScript-->
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="js/bootstrapValidator.min.js" type="text/javascript" ></script>

	<!-- Core plugin JavaScript-->
	<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="js/sb-admin-2.min.js"></script> 
	
  

</body>

</html>
