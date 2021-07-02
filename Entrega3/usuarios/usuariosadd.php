<?php

  if(empty($_SESSION)) // if the session not yet started 
   session_start();

  if(!isset($_SESSION['username'])) { //if not yet logged in
    header("Location: ../login.php");// send to login page
    exit;
  } 
?>

<?php
	include("../config.php");

	// Define variables and initialize with empty values
	$username = $password = $confirm_password = "";
	$username_err = $password_err = $confirm_password_err = "";

	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST"){	 
		// Validate username
		if(empty(trim($_POST["username"]))){
			$username_err = "Please enter a username.";
		} else{
			// Prepare a select statement
			$sql = "SELECT id FROM users WHERE username = ?";			
			
			if($stmt = mysqli_prepare($con, $sql)){				

				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "s", $param_username);				
				
				// Set parameters
				$param_username = trim($_POST["username"]);

				// Attempt to execute the prepared statement
				if(mysqli_stmt_execute($stmt)){
					/* store result */
					mysqli_stmt_store_result($stmt);
					
					if(mysqli_stmt_num_rows($stmt) == 1){
						$username_err = "This username is already taken.";
					} else{
						$username = trim($_POST["username"]);
					}
				} else{
					echo "Oops! Something went wrong. Please try again later.";
				}				
			}
			 
			// Close statement
			mysqli_stmt_close($stmt);
		}
		
		// Validate password
		if(empty(trim($_POST["password"]))){
			$password_err = "Please enter a password.";     
		} elseif(strlen(trim($_POST["password"])) < 6){
			$password_err = "Password must have atleast 6 characters.";
		} else{
			$password = trim($_POST["password"]);
		}
		
		// Validate confirm password
		if(empty(trim($_POST["confirm_password"]))){
			$confirm_password_err = "Please confirm password.";     
		} else{
			$confirm_password = trim($_POST["confirm_password"]);
			if(empty($password_err) && ($password != $confirm_password)){
				$confirm_password_err = "Password did not match.";
			}
		}
		
		// Check input errors before inserting in database
		if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
			
			// Prepare an insert statement
			$sql = "INSERT INTO users (username, password) VALUES (?, ?)";
			 
			if($stmt = mysqli_prepare($con, $sql)){
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
				
				// Set parameters
				$param_username = $username;
				$param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
				
				// Attempt to execute the prepared statement
				if(mysqli_stmt_execute($stmt)){
					// Redirect to login page
					header("location: ../login.php");
				} else{
					 
				}
			}
			 
			// Close statement
			mysqli_stmt_close($stmt);
		}
		
		// Close connection
		mysqli_close($con);
	}




?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>WillBox Administración - Usuarios</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
  
  <!-- Custom styles for this page -->
  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <style>
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }	
  </style> 
  
</head>

</head>

<body class="bg-gradient-primary">

  <div class="container">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user">
				<div class="form-group row">
					<div class="col-sm-6 mb-3 mb-sm-0">
						<input type="text" name="username" class="form-control form-control-user" value="<?php echo $username; ?>" placeholder="Nombre de usuario">
						<span class="help-block"><?php echo $username_err; ?></span>
					</div>
				</div>
                <div class="form-group row">
					<div class="col-sm-6 mb-3 mb-sm-0">
						<input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="First Name">
					</div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Last Name">
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password">
					<span class="help-block"><?php echo $password_err; ?></span>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" name="confirm_password" id="confirm_password" placeholder="Repeat Password">
					<span class="help-block"><?php echo $confirm_password_err; ?></span>
                  </div>
                </div>
				<input type="submit" class="btn btn-primary btn-user btn-block" value="Register Account">                                
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="forgot-password.html">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="login.html">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  </div>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">

	<!-- Sidebar - Brand -->
	<?php include("./../menubar.php"); ?>      
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
          
          <h1 class="h3 mb-4 text-gray-800">Mantenedor de Personas</h1>
          
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) 
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              Dropdown - Messages 
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
              
            </li>
            -->

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  <?php echo $_SESSION['username']; ?>
                  </span>
                <img class="img-profile rounded-circle" src="../start/img/imglogin.jpeg">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <!--
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Usuario
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Configuración
                </a>                
                <div class="dropdown-divider"></div>
                -->
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
          <div class="table-responsive">			
				<table id="table_personas" id="table_personas" class="table table-bordered table-hover">
				  <thead bgcolor="#eeeeee" align="center">
				  <tr>
					  <th>Acción</th>
					  <th>Usuario</th>
					  <th>Nombres</th>
					  <th>Apellidos</th>
					  <th>Email</th>
				  </tr>
				  </thead>
				  <tbody>
				  </tbody>
				  <tfoot>
					<tr>                  
					  <th>Acción</th>
					  <th>Usuario</th>
					  <th>Nombres</th>
					  <th>Apellidos</th>
					  <th>Email</th>
				  </tr>
				  </tfoot>
				</table>
			</div>         
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
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
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <a class="btn btn-primary" href="logout.php">Cerrar sesión</a>
        </div>
      </div>
    </div>
  </div>
  <form id="ActionUpdate" name="ActionUpdate" action="Persona_edit.php" method="POST">
    <input type="hidden" id="nID_PERSONA" name="nID_PERSONA">
  </form>
  

  <!-- Bootstrap core JavaScript-->

  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>
  <!-- Page level plugins -->
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
  
  <script src="../js/dataTables.buttons.min.js"></script>
  <script src="../js/buttons.flash.min.js"></script>

  <!-- bootbox code -->
  <script src="../vendor/bootbox/bootbox.min.js"></script>
  <script src="../vendor/bootbox/bootbox.locales.min.js"></script>

  <script src="../js/dataTables.buttons.min.js"></script>
  <script src="../js/buttons.flash.min.js"></script>
  <script src="../js/jszip.min.js"></script>  
  <script src="../js/pdfmake.min.js"></script>
  <script src="../js/pdfmake.min.js"></script>
  <script src="../js/vfs_fonts.js"></script>
  <script src="../js/buttons.html5.min.js"></script>
  <script src="../js/buttons.print.min.js"></script>

  <script>
    $(document).ready(function() {      
      
        $('#table_personas tfoot th').each(function () {
            var title = $(this).text();
            $(this).html(title+' <input type="text" class="col-search-input" placeholder="" />');
        });
        
        var table = $('#table_personas').DataTable({			
            "language":	{
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "orderCellsTop": true,
                "fixedHeader": {
                  header: true,
                  footer:true
                }                
            }, 
			
            "scrollX": false,            		
            "processing": true,
            "serverSide": true,
            "ajax": "usuario_server.php",			
            order: [[1, 'asc']],			
            columnDefs: [
            {
				targets : 0,              
				orderable: false,
				render : function(data, type, row, meta){
					if (type === 'display')
					{                          
						data1 = '<a class="edit_employee tn btn-info btn-circle btn-sm" data-emp-id="' + encodeURIComponent(data) + '" href="javascript:void(0)" title="Editar datos">'
						data1 += '<span class="fas fa-edit" aria-hidden="true"></span></a>'                    
						data1 += '  <a class="delete_employee btn btn-danger btn-circle btn-sm" data-emp-id="' + encodeURIComponent(data) + '" href="javascript:void(0)">'
						data1 += '<i class="fas fa-trash"></i>'
						data1 += '</a>'						
					}
					return data1;
				}             
			 }			 
			 ],
			dom: '<"top"B><"bottom">p<"clear">',
			buttons: [
				'excel', 'pdf', 'print'
			],
			"pageLength": 5
             
        }); 

		table.columns().every(function () {
            var table = this;
            $('input', this.footer()).on('keyup change', function () {
                if (table.search() !== this.value) {
                	   table.search(this.value).draw();
                }
            });
        }); 		
        
        $(document).on('click', '.edit_employee', function () {            
          var empid = $(this).attr('data-emp-id');          
          $("#nid").val(empid)          
          javascript:document.ActionUpdate.submit()
        });
        
        $(document).on('click', '.delete_employee', function () {            
            var empid = $(this).attr('data-emp-id');
            var parent = $(this).parent("td").parent("tr");   
            bootbox.dialog({
              message: "Estas seguro que quieres borrarlo ?",
              title: "<i class='glyphicon glyphicon-trash'></i> Borrar !",
              buttons: {
                success: {
                    label: "No",
                    className: "btn-success",
                    callback: function() {
                    $('.bootbox').modal('hide');
                  }
                },
                danger: {
                  label: "Borrar!",
                  className: "btn-danger",
                  callback: function() {       
                   $.ajax({        
                    type: 'POST',
                    url: 'Persona_delete.php',
                    data: 'empid='+empid        
                   })
                   .done(function(response){        
                    bootbox.alert(response);
                    parent.fadeOut('slow');        
                   })
                   .fail(function(){        
                    bootbox.alert('Error....');               
                   })              
                  }
                }
              }
            });   
        });
      
      
        
      
    } );
    
    function CallEdit(data){
      
    }
</script>

</body>

</html>
