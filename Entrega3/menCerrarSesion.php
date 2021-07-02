		<!-- Topbar Navbar -->
		<ul class="navbar-nav ml-auto">
		<!-- Nav Item - User Information -->
		<li class="nav-item dropdown no-arrow">
		  <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<span class="mr-2 d-none d-lg-inline text-gray-600 small">
			  <?php echo $_SESSION['username']; ?>
			  </span>
			<img class="img-profile rounded-circle" src="../../start/img/imglogin.jpeg">
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