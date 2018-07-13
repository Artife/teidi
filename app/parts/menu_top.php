<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
	<div class="navbar-header">
		<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
		<!-- Buscador -->
		<form role="search" class="navbar-form-custom" action="#">
			<div class="form-group">
				<input type="text" placeholder="Buscar" class="form-control" name="top-search" id="top-search">
			</div>
		</form> 
	</div>
		<ul class="nav navbar-top-links navbar-right">
			<li>
				<span class="m-r-sm text-muted welcome-message">Bienvenido a i-Diet</span>
			</li>		
			<li class="dropdown">
				<a href="<?php echo $url_app; ?>soporte/">
					<?php 
					$query_alert = "SELECT * FROM `gx_tickets` WHERE usuario = '".$_SESSION['id_usuario']."' AND status = 'Pendiente'";					
					$result_alert = mysqli_query($_SESSION["conexion"], $query_alert) or die(mysqli_error($_SESSION["conexion"]));	
					$campana = '';	
					while($row_alert = $result_alert->fetch_assoc()) {	
						$campana = $row_alert['status'];
					}
					?>
					<?php if($campana != ''){ ?>
					<i class="bell fa fa-bell"></i><span class="label label-primary"></span>
					<?php } else { ?>
					<i class="fa fa-bell"></i><span class="label label-primary"></span>
					<?php } ?>
				</a>				
			</li>
			<li>
				<a class="right-sidebar-toggle">
					<i class="fa fa-tasks"></i>
				</a>
			</li>
		</ul>

	</nav>
	<audio id="myAudio">	  
	  <source src="<?php echo $url_app; ?>img/sonido_campana.mp3" type="audio/mpeg">
	</audio>
	<script>
	var x = document.getElementById("myAudio"); 
	// x.play(); 
	</script>