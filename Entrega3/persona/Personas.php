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

  <title>WillBox Administración - Personas</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

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
          
          <h1 class="h3 mb-4 text-gray-800">Mantenedor de Personas</h1>
		  
          <!-- Menu Cerrar Sesion -->
          <?php include("../menCerrarSesion.php"); ?>
          <!-- Menu Cerrar Sesion -->

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="table-responsive">			
				<table id="table_personas" id="table_personas" class="table table-bordered table-hover" width="98%">
				  <thead bgcolor="#eeeeee" align="center">
				  <tr>
					  <th>Acción</th><th>Rut</th><th>Nombres</th><th>Apellidos</th><th>Email</th><th>Estado</th><th>Creación</th>                  
				  </tr>
				  </thead>
				  <tbody></tbody>
				  <tfoot>
					<tr>
						<th></th><th>Rut</th><th>Nombres</th><th>Apellidos</th><th>Email</th><th>Estado</th><th>Creación</th>
					</tr>
				  </tfoot>
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
		
		$.datepicker.regional['es'] = {
			 closeText: 'Cerrar',
			 prevText: '< Ant',
			 nextText: 'Sig >',
			 currentText: 'Hoy',
			 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
			 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
			 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
			 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
			 weekHeader: 'Sm',
			 dateFormat: 'dd/mm/yy',
			 firstDay: 1,
			 isRTL: false,
			 showMonthAfterYear: false,
			 yearSuffix: ''
		};
		$.datepicker.setDefaults($.datepicker.regional['es']);

		// se visualiza 
		$("#collapsePersonas").addClass("show"); 
      
        $('#table_personas tfoot th').each(function () {
            var title = $(this).text();
			if (title != ''){
				$(this).html(title+' <input type="text" class="col-search-input" placeholder="" />');
			}
			if (title == 'Creación'){
				$(this).html(title+' <input type="text" id="datepicker" placeholder="" autocomplete="off" />');
			}
        });
		
		$("#datepicker" ).datepicker({
			dateFormat: "yy-mm-dd",
			showButtonPanel: true,
			changeMonth: true,
			changeYear: true,
			maxDate: "+0D"
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
            "ajax": "Persona_server.php",			
            order: [[1, 'asc']],			
            columnDefs: [
				{
					width: "70px",
					className: "uniqueClassName",
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
				 },
				{
					targets : 6,
					orderable: false,
					type: 'date',
					render:function(data){
					  return moment(data).format('DD-MM-YYYY');
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
          $("#nID_PERSONA").val(empid)          
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
</script>

</body>

</html>
