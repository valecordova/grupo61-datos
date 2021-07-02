<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="./../../grupo61/index.php">
		<div class="sidebar-brand-icon rotate-n-15">          
			<img src="./../../grupo61/img/logofinal.png" height="47" width="47">
		</div>
		<div class="sidebar-brand-text mx-2">Dashboard <sup>1</sup></div>        
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider my-0">

	<!-- Nav Item - Dashboard -->
	<li class="nav-item active">
		<a class="nav-link" href="./../../grupo61/index.php">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Dashboard</span>
		</a>          
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<div class="sidebar-heading"> Tienda </div>
	<!-- Personas - mantenedor de compras -->
	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCompras" aria-expanded="true" aria-controls="collapseCompras">
			<i class="fas fa fa-users"></i>
			<span>Compras</span>
		</a>
		<div id="collapseCompras" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header">Mantenedor Compras:</h6>
				<a class="collapse-item" href="./../../grupo61/compras/comprasrealizadas.php">Mis Compras</a>
				<a class="collapse-item" href="./../../grupo61/compras/nuevacompra.php">Nueva Compra</a>
			</div>
		</div>
	</li>
	<!-- Personas - mantenedor de productos -->
	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProductos" aria-expanded="true" aria-controls="collapseProductos">
			<i class="fas fa fa-users"></i>
			<span>Productos</span>
		</a>
		<div id="collapseProductos" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header">Mantenedor Productos:</h6>
				<a class="collapse-item" href="./../../grupo61/productos/productos.php">Productos</a>				
			</div>
		</div>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsuarios" aria-expanded="true" aria-controls="collapseUsuarios">
			<i class="fas fa fa-user"></i>
			<span>Usuarios</span>
		</a>
		<div id="collapseUsuarios" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header">Usuarios:</h6>
				<a class="collapse-item" href="./../../grupo61/usuarios/usuarios.php">Usuarios</a>
				<?php 		
					if ($_SESSION["ID_PERFIL"] == 2){
						echo ('<a class="collapse-item" href="./../../grupo61/usuarios/usuarios_add.php">Agregar</a>');
					} 				
					$nik1 = $_SESSION["username"];
					$ssql = "select * from JefeUnidad where rut ='".$nik1."'";
					$result = mysqli_query($con2, $ssql);
					while ($row1 = mysqli_fetch_assoc($result)){ 
						echo ('<a class="collapse-item" href="./../../grupo61/usuarios/usuariosjefe.php">Jefe Unidad</a>');
					}
				?>
				
			</div>
		</div>
	</li>


	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>

</ul>
<!-- End of Sidebar -->
