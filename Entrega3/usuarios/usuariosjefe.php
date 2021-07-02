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

  <title>Mi Tienda Administración - Usuario Jefe Unidad</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- 
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  -->

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
  <link href="../css/jquery-ui.css" rel="stylesheet">    
  <!-- Custom styles for this page -->
  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <style>
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }	
	.uniqueClassName {
		text-align: center;
	}
	.ui-widget-content .ui-icon {
		background-image: url(../images/ui-icons_777777_256x240.png);
	}
	.ui-widget-header .ui-icon {
		background-image: url(../images/ui-icons_777777_256x240.png);
	}

  </style> 
  
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
          
          <h1 class="h3 mb-4 text-gray-800">Usuario Jefe Unidad</h1>
		  
          <!-- Menu Cerrar Sesion -->
          <?php include("../menCerrarSesion.php"); ?>
          <!-- Menu Cerrar Sesion -->

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
              <div class="row">    
                <div class="col-lg-10">                  
                  <div class="p-5"> 
                    <?php								
                      try {
                        $nik1 = $_SESSION["username"];
                        $ssql = "select * from vista_unidades_jefe where rut ='".$nik1."'";
                        $result = mysqli_query($con2, $ssql);
                        $row1 = mysqli_fetch_assoc($result);

                        $ssql2 = "select * from PersonalAdministrativo where id_unidad ='".$row1["id_unidad"]."'";
                        $result2 = mysqli_query($con2, $ssql2);


                      } catch (Exception $e) {
                          echo 'Excepción capturada: ',  $e->getMessage(), "\n";
                        exit;
                      }
                    ?>
                    <input type="text" required class="form-control form-control-user" name="rec_direccion" id="rec_rec_direccionrut" placeholder="Dirección" value="<?php echo $row1 ['direccion']; ?>">

                  </div>
                </div>
              </div>
            </div>
          </div>


          <div class="table-responsive">			
            <table id="table_personas" id="table_personas" class="table table-bordered table-hover" width="98%">
              <thead bgcolor="#eeeeee" align="center">
              <tr>               
                <th>Rut</th>
                <th>Calificación</th>                
              </tr>
              </thead>
              <tbody>
                
											  <?php
												 
												  while ($row1 = mysqli_fetch_assoc($result2)){ 
													  echo "<tr>";
													  echo "<td>" . $row1["rut"] . "</td>";	
													  echo "<td>" . $row1["calificacion"] . "</td>";													 
													  echo "</tr>";	
												  }												 
											  ?>

              </tbody>              
            </table>
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
 
  <form id="ActionUpdate" name="ActionUpdate" action="compras_detalle.php" method="POST">
    <input type="hidden" id="nID_COMPRA" name="nID_COMPRA">
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
  
  <script src="../js/jquery-ui.js"></script>
  <script src="../js/moment.js"></script>
  
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
      $("#collapseUsuarios").addClass("show");             
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
                  footer:false
                }                
            }, 
			
            "scrollX": false,            		
            "processing": true,
            "serverSide": false,
            
            order: [[0, 'desc']],			
            columnDefs: [],
          dom: '<"top"B><"bottom">p<"clear">',
          buttons: [
            'excel', 'pdf', 'print'
          ],
          "pageLength": 5
             
        }); 

	     
      
    } );   
</script>

</body>

</html>
