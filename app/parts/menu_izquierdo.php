<div class="sidebar-collapse">
	<ul class="nav metismenu" id="side-menu">
		<li class="nav-header">
			<div class="dropdown profile-element"> <span>
				<a href="<?php echo $url_app; ?>home"><img alt="image" class="img-circle" src="<?php echo $url_app; ?>img/logo-menu.png" /></a>
				 </span>
				<a data-toggle="dropdown" class="dropdown-toggle" href="#">
				<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $_SESSION['nombre']; ?></strong>
				 </span> <span class="text-muted text-xs block"><?php echo $_SESSION['email']; ?> <b class="caret"></b></span> </span> </a>
				<ul class="dropdown-menu animated fadeInRight m-t-xs">					
					<li><a href="#">Ayuda</a></li>
					<li><a href="<?php echo $url_app; ?>soporte">Soporte técnico</a></li>
					<li class="divider"></li>
					<li><a href="<?php echo $url_app; ?>logout">Cerrar sesión</a></li>
				</ul>
			</div>
			<div class="logo-element">
				i-Diet
			</div>
		</li>
		
		<li>
			<a href="<?php echo $url_app; ?>home"><i class="fa fa-home"></i> <span class="nav-label">Inicio</span></a>			
		</li>
		<li>
			<a href="#"><i class="fa fa-user"></i> <span class="nav-label">Clientes</span><span class="fa arrow"></span></a>
			<ul class="nav nav-second-level collapse">
				<li><a href="<?php echo $url_app; ?>lista-clientes"><span class="nav-label">Clientes activos</span></a></li> 
				<li><a href="<?php echo $url_app; ?>lista-clientes-desactivados"><span class="nav-label">Clientes desactivados</span></a></li>
				<li><a href="<?php echo $url_app; ?>crear-cliente"><span class="nav-label">Crear cliente</span></a></li>	
			</ul>
		</li>			
		<li>
			<a href="#"><i class="fa fa-cutlery"></i> <span class="nav-label">Recetas</span><span class="fa arrow"></span></a>
			<ul class="nav nav-second-level collapse">
				<li><a href="<?php echo $url_app; ?>lista-recetas">Recetas activas</a></li>						
				<li><a href="<?php echo $url_app; ?>lista-recetas-desactivadas">Recetas desactivadas</a></li>
				<li><a href="<?php echo $url_app; ?>nueva-receta">Crear Receta</a></li>
				<li><a href="<?php echo $url_app; ?>editar-ingestas">Editar Ingestas</a></li>
			</ul>
		</li>
		<li>
			<a href="#"><i class="fa fa-lemon-o"></i> <span class="nav-label">Alimentos</span><span class="fa arrow"></span></a>
			<ul class="nav nav-second-level collapse">
				<li><a href="<?php echo $url_app; ?>lista-alimentos">Alimentos activos</a></li>						
				<li><a href="<?php echo $url_app; ?>alimentos-desactivados">Alimentos desactivados</a></li>
				<li><a href="<?php echo $url_app; ?>nuevo-alimento">Crear alimentos</a></li>
			</ul>
		</li>
		<li>
			<a href="#"><i class="fa fa-calendar" aria-hidden="true"></i> <span class="nav-label">Agenda</span><span class="fa arrow"></span></a>
			<ul class="nav nav-second-level collapse">
				<li><a href="<?php echo $url_app; ?>agenda">Agenda</a></li>										
				<li><a href="<?php echo $url_app; ?>agenda-desactivados">Citas desactivadas</a></li> 
			</ul>
		</li>
		<li>
			<a href="#"><i class="fa fa-circle"></i> <span class="nav-label">Reglas y Plantillas</span><span class="fa arrow"></span></a>
			<ul class="nav nav-second-level collapse">
				<li><a href="<?php echo $url_app; ?>lista-reglas">Lista de Reglas</a></li>	
				<li><a href="<?php echo $url_app; ?>lista-reglas-desactivadas">Reglas Desactivadas</a></li>
				<li><a href="<?php echo $url_app; ?>lista-plantillas">Lista de Plantillas</a></li>	
				<li><a href="<?php echo $url_app; ?>lista-plantillas-desactivadas">Plantillas Desactivadas</a></li>		
			</ul>
		</li>	
		<li>
			<a href="#"><i class="fa fa-download" aria-hidden="true"></i> <span class="nav-label">Descargas</span><span class="fa arrow"></span></a>
			<ul class="nav nav-second-level collapse">
				<li><a href="<?php echo $url_app; ?>datos-de-clientes"><span class="nav-label">Datos clientes</span></a></li>				
				<li><a href="<?php echo $url_app; ?>datos-de-mediciones"><span class="nav-label">Mediciones del cliente</span></a></li>	
			</ul>
		</li>	
		<?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'Desarrollador') {?>
		<li>
			<a href="#"><i class="fa fa-user-plus"></i> <span class="nav-label">Panel de Control</span><span class="fa arrow"></span></a>
			<ul class="nav nav-second-level collapse">
				<li><a href="<?php echo $url_app; ?>lista-usuarios">Lista de usuarios</a></li>
				<li><a href="<?php echo $url_app; ?>nuevo-usuario">Crear Nuevo Usuario</a></li>
				<li><a href="<?php echo $url_app; ?>lista-super-grupo">Lista Super Grupo</a></li>
			</ul>
		</li>		
		<? } ?>
	</ul>
</div>