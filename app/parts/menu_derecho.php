<div id="right-sidebar">
	<div class="sidebar-container">
		<!-- Opciones del menu derecho -->
		<ul class="nav nav-tabs navs-3">
			<li class="active">
				<a data-toggle="tab" href="#tab-1">Perfil</a>
			</li>			
		</ul>
		<!-- Vinculos del los enlaces  -->
		<div class="tab-content">
			<div id="tab-1" class="tab-pane active">							
				<div class="sidebar-message">
					<a href="<?php echo $url_app; ?>configuracion"><i class="fa fa-cog"></i> Configuración</a>
				</div>
				<div class="sidebar-message">
					<a href="<?php echo $url_app; ?>cambiar-password"><i class="fa fa-lock"></i> Cambiar contraseña</a>
				</div>						
				<div class="sidebar-message">
					<a href="<?php echo $url_app; ?>logout"><i class="fa fa-sign-out"></i> Cerrar sesión</a>
				</div>
			</div>
		</div>
	</div>
</div>