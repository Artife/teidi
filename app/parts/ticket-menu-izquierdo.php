<div class="file-manager">
	<a class="btn btn-block btn-primary compose-mail" href="<?php echo $url_app; ?>crear-ticket">Crear Ticket</a>
	<div class="space-25"></div>
	<h5>Tickets</h5>
	<ul class="folder-list m-b-md" style="padding: 0">
		<li><a href="<?php echo $url_app; ?>soporte"> <i class="fa fa-circle text-danger" style="color:red"></i> Pendientes <span class="label  label-white pull-right" style="background:red; color:white;"><?php echo total_tickets_pendientes(); ?></span> </a></li>				
		<li><a href="<?php echo $url_app; ?>soporte-tickets-solucionados"> <i class="fa fa-circle text-navy" style="color:green"></i> Resueltos <span class="label label-white white-right"  style="background:green; color:white; float: right;"><?php echo total_tickets_solucionados(); ?></span></a></li>                                
		<?php if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'Desarrollador') { ?>
		<li><a href="<?php echo $url_app; ?>responder-tickets"> <i class="fa fa-circle text-navy" style="color:#772e71"></i> Responder Tickets <span class="label label-white white-right"  style="background:#772e71; color:white; float: right;"><?php echo total_tickets_por_resolver(); ?></span></a></li>                                
		<?php } ?>
	</ul>                            
	<div class="clearfix"></div>
</div>