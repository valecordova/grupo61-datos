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

  <title>WillBox Administración - Usuarios</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  --->

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
          
          <h1>Usuarios</h1>
          
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  <?php echo $_SESSION['username']; ?>
                  </span>
                <img class="img-profile rounded-circle" src="./../../start/img/imglogin.jpeg"> 
              </a>
              <!-- Dropdown - User Information -->
			  <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Usuario
                </a>                
                <div class="dropdown-divider"></div>
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
				<table id="table_usuarios" id="table_usuarios" class="table table-bordered table-hover">
				  <thead bgcolor="#eeeeee" align="center">
				  <tr>
					  <th>Acción</th>
            <th>Rut</th>
					  <th>Nombres</th>
            <th>Edad</th>
				  </tr>
				  </thead>
				  <tbody>
				  </tbody>
				  <tfoot>
					<tr>                  
          <th>Acción</th>
            <th>Rut</th>
					  <th>Nombres</th>
            <th>Edad</th>
				  </tr>
				  </tfoot>
				</table>
			</div>         
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

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
          <a class="btn btn-primary" href="../logout.php">Cerrar sesión</a>
        </div>
      </div>
    </div>
  </div>
  <form id="ActionUpdate" name="ActionUpdate" action="usuarios_edit.php" method="POST">
    <input type="hidden" id="nID" name="nID">
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

		// se visualiza 
		$("#collapseUsuarios").addClass("show"); 

		if ((/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))==true) {                    
			$("body").toggleClass("sidebar-toggled");
			$(".sidebar").toggleClass("toggled");
			if ($(".sidebar").hasClass("toggled")) {
			  $('.sidebar .collapse').collapse('hide');
			};
		}
      
        $('#table_usuarios tfoot th').each(function () {
            var title = $(this).text();
            $(this).html(title+' <input type="text" class="col-search-input" placeholder="" />');
        });
        
        var table = $('#table_usuarios').DataTable({			
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
            "ajax": "usuarios_server.php",			
            order: [[1, 'asc']],			
            columnDefs: [
            {
				targets : 0,
				orderable: false,
				render : function(data, type, row, meta){
					if (type === 'display')
					{ 	       
						data1 = '<a class="edit_data tn btn-info btn-circle btn-sm" data-id="' + encodeURIComponent(data) + '" href="javascript:void(0)" title="Editar datos">'
						data1 += '<span class="fas fa-edit" aria-hidden="true"></span></a>'
						data1 += '  <a class="delete_data btn btn-danger btn-circle btn-sm" data-id="' + encodeURIComponent(data) + '" href="javascript:void(0)">'
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
        
        $(document).on('click', '.edit_data', function () {            
          var id = $(this).attr('data-id');
          $("#nID").val(id)          
          javascript:document.ActionUpdate.submit()
        });
        
        $(document).on('click', '.delete_data', function () {            
            var id = $(this).attr('data-id');
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
                    url: 'usuarios_delete.php',
                    data: 'id='+id        
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
