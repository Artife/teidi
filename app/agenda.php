 <?php
session_start();
include 'parts/conex.php';
$pagina = 'Ver Agenda';
$migas = array('Agenda');
$migas_url = array('');

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';

$buscar_desde = '';
$buscar_hasta = '';
$buscar_desde_value = '';
$buscar_hasta_value = '';
	
if(!empty($_POST['buscar_desde'])){
	$buscar_desde = substr($_POST['buscar_desde'], 6, 4).substr($_POST['buscar_desde'], 3, 2).substr($_POST['buscar_desde'], 0, 2);					
	$buscar_hasta = substr($_POST['buscar_hasta'], 6, 4).substr($_POST['buscar_hasta'], 3, 2).substr($_POST['buscar_hasta'], 0, 2);
	$buscar_desde_value = $_POST['buscar_desde'];
	$buscar_hasta_value = $_POST['buscar_hasta'];
}
?>
	<?php echo header_documento(); ?>
	<link href="<?php echo $url_app; ?>css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
    <link href="<?php echo $url_app; ?>css/plugins/fullcalendar/fullcalendar.print.css" rel='stylesheet' media='print'>
	<?php include 'parts/header.php'; ?>	
	<link href="<?php echo $url_app; ?>css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
	<link href="<?php echo $url_app; ?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">
	<link href="<?php echo $url_app; ?>css/plugins/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
	<link href="<?php echo $url_app; ?>css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">
	<link href="<?php echo $url_app; ?>css/plugins/datapicker/datepicker3.css" rel="stylesheet">
	<style>
	.table-responsive {
		overflow-x: hidden;
	}
	#example_filter label, #example_info{
		display:none;
	}
	.event_inicio {
		background-color: #81d74266;
		border-color: #81d74266;
		color: #656464;
	}
	.event_mediciones {
		background-color: #772e714a;
		border-color: #772e714a;
		color: #656464;
	}
	.event_revision {
		background-color: #f8ac59a8;
		border-color: #f8ac59a8;
		color: #656464;
	}
	.event_inicio:hover, .event_mediciones:hover, .event_revision:hover {
		color: #000000;
	} 
	.fc-state-active {
		background-color: #772e71;
		border-color: #772e71;
		color: #ffffff;
	}
	#tabla_lista_citas_wrapper .html5buttons {
		position: absolute;
		float: right;
		right: 40px;
		top: 165px;
	}		
	#tabla_lista_citas span, #vinculo_cita_anterior, #vinculo_modificar_cita{
		display:none;
	}
	.fc-time-grid .fc-event {
		min-height: 10px;
	}
	</style>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <?php include_once 'parts/menu_izquierdo.php'; ?>
        </nav>
        <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
        <?php include_once 'parts/menu_top.php'; ?>
        </div>
			<div class="row wrapper border-bottom white-bg page-heading">
			<?php echo migas_de_pan($pagina, $migas, $migas_url, ''); ?>                
            </div>
		<div class="wrapper wrapper-content">	
		<!-- Buscador -->
		<form id="formulario_de_citas" action="#" method="post">	
			<div class="row">
				<div class="col-md-12">
					<form id="filtro_agenda" action="<?php echo vinculo('agenda'); ?>" method="post">	
					<div class="ibox float-e-margins">
						<div class="ibox-title">
							<h5>Filtro de citas</h5>							
						</div>
						<div class="ibox-content">							
							<div class="row" id="buscar_rango_fechas">									
								<div class="col-md-12">	
									<div class="row" id="buscar_rango_fechas">																			
										<div class="form-group">
											<div class="col-lg-2">
												<label>Citas del día ..</label>
											</div>
											<div class="col-lg-3">
												<input type="text" placeholder="" class="input-sm form-control date-range-filter fd" id="buscar_desde" name="buscar_desde" value="<?php echo $buscar_desde_value; ?>" >
											</div>
											<div class="col-lg-1">
												<label>a</label>
											</div>
											<div class="col-lg-3">
												<input type="text" placeholder="" class="input-sm form-control date-range-filter fd" id="buscar_hasta" name="buscar_hasta" value="<?php echo $buscar_hasta_value; ?>">
											</div>
											<div class="col-lg-2">
												<button  type="submit" class="btn btn-w-m btn-guardar" title="Guardar las nuevas citas">Buscar</button>	
											</div>
										</div>
									</div>
									<br><br>
								</div>
							</div>
						</div>		
					</div>
					</form>					
				</div>
				<div class="col-md-5">
					<div class="ibox float-e-margins">
						<div class="ibox-title">
							<h5>Lista de citas</h5>
							<div class="ibox-tools">								
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">
									<i class="fa fa-wrench"></i> Agregar citas o Eliminarlas
								</a>
								<ul class="dropdown-menu dropdown-user">
									<li><a href="#" data-toggle="modal" data-target="#nueva_cita" >Agregar nueva cita</a></li>
									<li><a id="vinculo_modificar_cita" class="modificar_citas" href="#">Modificar cita</a></li>
									<li><a id="vinculo_cita_anterior" class="modificar_citas" href="#">Las citas anteriores no se pueden modificar</a></li>
									<li><a id="btn_desactivar_citas" href="#">Desactivar citas</a></li>
								</ul>
							</div>
						</div>
						<div class="ibox-content">														
							<table id="tabla_lista_citas" class="table table-striped dataTables-example">
								<thead>
								<tr>
									<th style="width: 30px;">
										<div class="checkbox checkbox-success" style="position: absolute;margin-top: -5px; margin-left: -3px;">
											<input id="checkbox1" type="checkbox" class="marcar_todos_desactivar">
											<label for="checkbox1"></label>
										</div>
									</th>
									<th>DNI </th>
									<th>Cliente </th>
									<th>Teléfono</th>								
									<th>Fecha I.</th>
									<th>Fecha H.</th>
								</tr>
								</thead>
								<tbody>
									<!-- Todos vacios -->
									<?php if ($buscar_desde == '' AND $buscar_hasta == '') { ?>
									<?php //Obtener el historial de pesos por clientes
										$citas = todas_las_citas_activas ();
									?> 
									<?php for ($i = 0; $i <= count($citas); $i++) { ?>										
										<?php if(!empty($citas[$i]['id'])){ ?>
										<?php if($citas[$i]['ordenar_inicio'] >= date("Ymd") AND $citas[$i]['ordenar_inicio'] <= date("Ymd")+7){ ?>
										<?php $indice_fecha = substr($citas[$i]['inicio'], 6, 4).substr($citas[$i]['inicio'], 3, 2).substr($citas[$i]['inicio'], 0, 2); ?>
										<?php if($indice_fecha < date('Ymd')) { $class_cita = 'citas_anteriores'; }else{ $class_cita = ''; } ?>
											<tr>
												<td>
													<div class="checkbox checkbox-success">
														<input id="desactivar_<?php echo $citas[$i]['id']; ?>" type="checkbox" name="desactivar_<?php echo $citas[$i]['id']; ?>" class="marcar_desactivar <?php echo $class_cita; ?>"><label for="desactivar_<?php echo $citas[$i]['id']; ?>"></label>
													</div>
												</td>
												<td><?php echo $citas[$i]['dni']; ?></td>
												<td><?php echo salida_nombre($citas[$i]['nombre']); ?></td>
												<td><?php echo $citas[$i]['telefono_movil']; ?></td>												
												<td><span><?php echo substr($citas[$i]['inicio'], 6, 4).substr($citas[$i]['inicio'], 3, 2).substr($citas[$i]['inicio'], 0, 2); ?></span><?php echo $citas[$i]['inicio']; ?></td>
												<td><?php echo $citas[$i]['fin']; ?></td>
											</tr>
										<?php } ?>	
										<?php } ?>
									<?php } ?>
									<?php } ?>
									<!-- Fin -->
									<!-- Desde Lleno -->
									<?php if ($buscar_desde != '' AND $buscar_hasta == '') { ?>
									<?php //Obtener el historial de pesos por clientes
										$citas = todas_las_citas_activas ();
									?> 
									<?php for ($i = 0; $i <= count($citas); $i++) { ?>
										<?php if(!empty($citas[$i]['id'])){ ?>
										<?php if($citas[$i]['ordenar_inicio'] >= $buscar_desde){ ?>
										<?php $indice_fecha = substr($citas[$i]['inicio'], 6, 4).substr($citas[$i]['inicio'], 3, 2).substr($citas[$i]['inicio'], 0, 2); ?>
										<?php if($indice_fecha < date('Ymd')) { $class_cita = 'citas_anteriores'; }else{ $class_cita = ''; } ?>
											<tr>
												<td>
													<div class="checkbox checkbox-success">
														<input id="desactivar_<?php echo $citas[$i]['id']; ?>" type="checkbox" name="desactivar_<?php echo $citas[$i]['id']; ?>" class="marcar_desactivar <?php echo $class_cita; ?>"><label for="desactivar_<?php echo $citas[$i]['id']; ?>"></label>
													</div>
												</td>
												<td><?php echo $citas[$i]['dni']; ?></td>
												<td><?php echo salida_nombre($citas[$i]['nombre']); ?></td>
												<td><?php echo $citas[$i]['telefono_movil']; ?></td>												
												<td><span><?php echo substr($citas[$i]['inicio'], 6, 4).substr($citas[$i]['inicio'], 3, 2).substr($citas[$i]['inicio'], 0, 2); ?></span><?php echo $citas[$i]['inicio']; ?></td>
												<td><?php echo $citas[$i]['fin']; ?></td>
											</tr>
										<?php } ?>	
										<?php } ?>
									<?php } ?>
									<?php } ?>
									<!-- Fin -->
									<!-- Hasta Lleno -->
									<?php if ($buscar_desde == '' AND $buscar_hasta != '') { ?>
									<?php //Obtener el historial de pesos por clientes
										$citas = todas_las_citas_activas ();
									?> 
									<?php for ($i = 0; $i <= count($citas); $i++) { ?>
										<?php if(!empty($citas[$i]['id'])){ ?>
										<?php if($citas[$i]['ordenar_inicio'] <= $buscar_hasta){ ?>
										<?php $indice_fecha = substr($citas[$i]['inicio'], 6, 4).substr($citas[$i]['inicio'], 3, 2).substr($citas[$i]['inicio'], 0, 2); ?>
										<?php if($indice_fecha < date('Ymd')) { $class_cita = 'citas_anteriores'; }else{ $class_cita = ''; } ?>
											<tr>
												<td>
													<div class="checkbox checkbox-success">
														<input id="desactivar_<?php echo $citas[$i]['id']; ?>" type="checkbox" name="desactivar_<?php echo $citas[$i]['id']; ?>" class="marcar_desactivar <?php echo $class_cita; ?>"><label for="desactivar_<?php echo $citas[$i]['id']; ?>"></label>
													</div>
												</td>
												<td><?php echo $citas[$i]['dni']; ?></td>
												<td><?php echo salida_nombre($citas[$i]['nombre']); ?></td>
												<td><?php echo $citas[$i]['telefono_movil']; ?></td>												
												<td><span><?php echo substr($citas[$i]['inicio'], 6, 4).substr($citas[$i]['inicio'], 3, 2).substr($citas[$i]['inicio'], 0, 2); ?></span><?php echo $citas[$i]['inicio']; ?></td>
												<td><?php echo $citas[$i]['fin']; ?></td>
											</tr>
										<?php } ?>	
										<?php } ?>
									<?php } ?>
									<?php } ?>
									<!-- Fin -->
									<!-- Los 2 Llenos -->
									<?php if ($buscar_desde != '' AND $buscar_hasta != '') { ?>
									<?php //Obtener el historial de pesos por clientes
										$citas = todas_las_citas_activas ();
									?> 
									<?php for ($i = 0; $i <= count($citas); $i++) { ?>
										<?php if(!empty($citas[$i]['id'])){ ?>
										<?php if($citas[$i]['ordenar_inicio'] >= $buscar_desde AND $citas[$i]['ordenar_inicio'] <= $buscar_hasta){ ?>
										<?php $indice_fecha = substr($citas[$i]['inicio'], 6, 4).substr($citas[$i]['inicio'], 3, 2).substr($citas[$i]['inicio'], 0, 2); ?>
										<?php if($indice_fecha < date('Ymd')) { $class_cita = 'citas_anteriores'; }else{ $class_cita = ''; } ?>
											<tr>
												<td>
													<div class="checkbox checkbox-success">
														<input id="desactivar_<?php echo $citas[$i]['id']; ?>" type="checkbox" name="desactivar_<?php echo $citas[$i]['id']; ?>" class="marcar_desactivar <?php echo $class_cita; ?>"><label for="desactivar_<?php echo $citas[$i]['id']; ?>"></label>
													</div>
												</td>
												<td><?php echo $citas[$i]['dni']; ?></td>
												<td><?php echo salida_nombre($citas[$i]['nombre']); ?></td>
												<td><?php echo $citas[$i]['telefono_movil']; ?></td>												
												<td><span><?php echo $indice_fecha; ?></span><?php echo $citas[$i]['inicio']; ?></td>
												<td><?php echo $citas[$i]['fin']; ?></td>
											</tr>
										<?php } ?>	
										<?php } ?>
									<?php } ?>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-md-7">
					<div class="ibox float-e-margins">
						<div class="ibox-title">
							<h5>Calendario de citas</h5>							
						</div>
						<div class="ibox-content">
							<div id="calendar"></div>
						</div>
					</div>
				</div>
			</div>
		</form>		
		<!-- Modal Agregar nueva cita -->
		<!-- Modal -->
		<div class="modal fade" id="nueva_cita" role="dialog">
			<div class="modal-dialog modal-lg">
			  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Agregar nueva cita</h4>
				</div>
				<div class="modal-body">
				<form id="formulario_completo" action="<?php echo vinculo('crear-cita'); ?>" method="post">	
					<!-- Formato -->
					<div class="row">	
						<div class="col-md-2"></div>
						<div class="col-md-8">	
							<div class="form-group"><label class="col-lg-4 control-label">Titulo</label>
								<div class="col-lg-6">
									<input type="text" placeholder="Titulo" class="input-sm form-control" name="titulo">
								</div>
							</div>
						</div>
						<div class="col-md-2"></div>
					</div>
					<br><br>
					<div class="row">	
						<div class="col-md-2"></div>
						<div class="col-md-8">	
							<div class="form-group"><label class="col-lg-4 control-label">Tipo de cita</label>
								<div class="col-lg-6">
									<select id="tipo_cita" name="tipo_cita" class="input-sm form-control">										
										<option class="event_inicio">Inicial</option>
										<option class="event_revision">Revisión</option>
										<option class="event_mediciones">Mediciones</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-2"></div>
					</div>
					<br><br>
					<div class="row">	
						<div class="col-md-2"></div>
						<div class="col-md-8">	
							<div class="form-group"><label class="col-lg-4 control-label">Inicio de la cita (Dia)</label>
								<div class="col-lg-6">
									<input id="date_inicio" type="text" placeholder="Fecha Inicio.." class="input-sm form-control" name="inicio" autocomplete="nope" required>
								</div>
							</div>
						</div>
						<div class="col-md-2"></div>
					</div>
					<br><br>
					<div class="row">	
						<div class="col-md-2"></div>
						<div class="col-md-8">	
							<div class="form-group"><label class="col-lg-4 control-label">Inicio de la cita (Hora)</label>
								<div class="col-lg-6">
									<input id="hora_inicio" type="text" placeholder="Hora Inicio.." class="input-sm form-control" name="hora" autocomplete="nope" required>
								</div>
							</div>
						</div>
						<div class="col-md-2"></div>
					</div>
					<br><br>
					<div class="row">	
						<div class="col-md-2"></div>
						<div class="col-md-8">	
							<div class="form-group"><label class="col-lg-4 control-label">Duración</label>
								<div class="col-lg-6">									
									<input id="date_fin" type="number" placeholder="Duración.." class="touchspin1" name="fin" value="10" min="0" max="60"  required>
								</div>
							</div>
						</div>
						<div class="col-md-2"></div>
					</div>
					<br><br>					
					<div class="row">
						<div class="col-md-12">								
							<div class="form-group text-center">
							<a data-dismiss="modal" href="#" class="btn btn-w-m btn-atras">Atras</a>
							<button type="submit" class="btn btn-w-m btn-primary" title="Guardar las nuevas citas">Guardar</button>
							</div>
						</div>
					</div>	
					<br><br><br><br>		
					<!-- Fin Formato -->
					<table id="tabla_clientes" class="table table-striped dataTables-example">
						<thead>
						<tr>
							<th style="width: 30px;">
								<div class="checkbox checkbox-success" style="position: absolute;margin-top: -5px; margin-left: -3px;">
									<input id="mt_cita" type="checkbox" class="marcar_todos_cita">
									<label for="mt_cita"></label>
								</div>
							</th>
							<th>Nombre </th>
							<th>Apellido </th>
							<th>Email</th>								
						</tr>
						</thead>
						<tbody>
							<?php //Obtener el historial de pesos por clientes
								$clientes = listado_clientes_x_usuario ();
							?> 
							<?php for ($i = 0; $i <= count($clientes); $i++) { ?>
								<?php if(!empty($clientes[$i]['id_cliente']) && $clientes[$i]['fecha_de_baja'] == ''){ ?>
									<tr>
										<td>
											<div class="checkbox checkbox-success">
												<input id="<?php echo $clientes[$i]['id_cliente']; ?>" type="checkbox" name="<?php echo $clientes[$i]['id_cliente']; ?>" class="marcar_cita"><label for="<?php echo $clientes[$i]['id_cliente']; ?>"></label>
											</div>
										</td>
										<td><?php echo salida_nombre($clientes[$i]['nombre']); ?></td>
										<td><?php echo salida_nombre($clientes[$i]['apellidos']); ?></td>
										<td><?php echo $clientes[$i]['email']; ?></td>												
									</tr>
								<?php } ?>
							<?php } ?>
						</tbody>
					</table>						
				</form>		
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				</div>
			  </div>
			</div>
		</div>
		<!-- Fin Modal Agregar nueva cita --> 
		<!-- Modificar cita -->
		<?php //print_r( $alimentos_activos ); ?>	
		</div>
                <div class="footer">
                    <?php include_once 'parts/footer.php'; ?>
                </div>
            </div>
			<?php include_once 'parts/menu_derecho.php'; ?>
        </div>
        </div>      
    </div>  
	<?php include 'parts/jquery_footer.php'; ?>	
	<!-- Full Calendar -->
	<script src="<?php echo $url_app; ?>js/plugins/fullcalendar/moment.min.js"></script>
	<script src="<?php echo $url_app; ?>js/plugins/fullcalendar/fullcalendar.min.js"></script>	
	<script src="<?php echo $url_app; ?>js/plugins/fullcalendar/lang-all.js"></script>	
	<script src="<?php echo $url_app; ?>js/plugins/dataTables/datatables.min.js"></script>	
	<script src="<?php echo $url_app; ?>js/plugins/datetimepicker/bootstrap-datetimepicker.js"></script>
	<script src="<?php echo $url_app; ?>js/plugins/datapicker/bootstrap-datepicker.js"></script>
	<script src="<?php echo $url_app; ?>js/plugins/datapicker/bootstrap-datepicker-es.js"></script>		
	<script src="<?php echo $url_app; ?>js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>
	<script>
    $(document).ready(function() {   
		//Mensaje del footer
		$('#mensajes_footer').modal('show');
		
		$(".touchspin1").TouchSpin({
			min: 1,
			max: 99999,
			step: 1,
			decimals: 0,
			boostat: 5,
			maxboostedstep: 10,
			postfix: 'Minutos',
			buttondown_class: 'btn btn-white',
			buttonup_class: 'btn btn-white'
		});
		
		var tabla_lista_citas = $('#tabla_lista_citas').DataTable({  
			responsive: true,
			processing: true,
			erverSide: true,											
			deferRender:    true,
			scrollCollapse: true,
			scroller:       false,
			serialize:		true,				
			iDisplayLength:	10,
			paging: 		true,		 
			order: [[ 4, 'asc' ]],	
			dom: '<"html5buttons"B>lTfgitp',
			columnDefs: [   {
                "targets": [ 5 ],
				"visible": false
			}],
			buttons: [],
			'fnCreatedRow': function (nRow, aData, iDataIndex) {
				$(nRow).attr('id', 'my' + iDataIndex); // or whatever you choose to set as the id
			}
			
		});
		
		var table_buscar = $('#tabla_clientes').DataTable({  
			responsive: true,
			processing: true,
			erverSide: true,											
			deferRender:    true,
			scrollCollapse: true,
			scroller:       false,
			serialize:		true,				
			iDisplayLength:	13,
			paging: 		true
			
		});
		
		//Fecha y Hora
		$('#hora_inicio').datetimepicker({
			// minDate: moment(1, 'h'),
			 format: 'LT',
			locale:'es'
		});
		$('#buscar_desde, #buscar_hasta, #date_inicio').datepicker({ 						
			minDate: moment(1),
			locale:'es',
			language: 'es'
		});
		
		//Filtrar por rango de fechas
		$.fn.dataTable.ext.search.push(
			function( settings, data, dataIndex ) {
				var min  = $('#buscar_desde').val();
				var max  = $('#buscar_hasta').val();
				var createdAt = data[4] || 0; // Our date column in the table				
				if  ( 
						( min == "" || max == "" )
						|| 
						( moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max) ) 
					)
				{
					return true;
				}
				return false;
			}
		);
		$('.date-range-filter').on('keyup', function () {	
			tabla_lista_citas.draw();			
		});	
			
        /* initialize the calendar */       
        $('#calendar').fullCalendar({
			lang: 'es',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            editable: false,
            droppable: false, // this allows things to be dropped onto the calendar
            drop: function() {
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            },
            events: [				
				<?php //print_r($citas); ?>
				<?php for ($i = 0; $i <= count($citas); $i++) { ?>
					<?php if(!empty($citas[$i]['id_cliente'])){ ?>
				{
                    id: <?php echo $citas[$i]['id']; ?>,
                    title: '<?php echo salida_nombre($citas[$i]['nombre']).' - '.salida_nombre($citas[$i]['apellidos']); ?>',
                    start: new Date(<?php echo $citas[$i]['inicio_ano']; ?>, <?php echo $citas[$i]['inicio_mes']; ?>, <?php echo $citas[$i]['inicio_dia']; ?>, <?php echo $citas[$i]['inicio_hora']; ?>, <?php echo $citas[$i]['inicio_min']; ?>),
					end: new Date (<?php echo $citas[$i]['fin_ano']; ?>, <?php echo $citas[$i]['fin_mes']; ?>, <?php echo $citas[$i]['fin_dia']; ?>, <?php echo $citas[$i]['fin_hora']; ?>, <?php echo $citas[$i]['fin_min']; ?>),					
                    allDay: false,
					<?php if(salida_nombre($citas[$i]['tipo_cita']) == 'Inicial'){ ?>
					className: 'event_inicio'
					<?php } ?>
					<?php if(salida_nombre($citas[$i]['tipo_cita']) == 'Revisión'){ ?>
					className: 'event_revision'
					<?php } ?>
					<?php if(salida_nombre($citas[$i]['tipo_cita']) == 'Mediciones'){ ?>
					className: 'event_mediciones'
					<?php } ?>
                },
				<?php } ?>
			<?php } ?>
            ]
        });
		
		//Contar seleccionados
		var total_marcados = 0;
		var citas_anteriores = 0;
		//Marcar citas
		$(".marcar_todos_cita").on("click", function () {
			var marcado = $(this).is(':checked'); 			
			if(marcado == true){				
				$('.marcar_cita').prop('checked',true);
				$(".marcar_cita").attr('value', '1');
			}else{				
				$('.marcar_cita').prop('checked',false);
				$(".marcar_cita").attr('value', '0');
			}			
		});
		
		
		$(".marcar_todos_desactivar").on("click", function () {
			var marcado = $(this).is(':checked'); 			
			if(marcado == true){				
				$('.marcar_desactivar').prop('checked',true);
				$(".marcar_desactivar").attr('value', '1');
			}else{				
				$('.marcar_desactivar').prop('checked',false);
				$('.marcar_desactivar').attr('value', '0');
			}
			//Desactivar modificar cita si esta mas de uno seleccionado
			total_marcados = $('.marcar_desactivar').filter(':checked').length			
			if(total_marcados == 1){
				$('#vinculo_modificar_cita').css('display', 'block');
			}else{
				$('#vinculo_modificar_cita').css('display', 'none');
			}
		});
		
		//Desactivar modificar cita si esta mas de uno seleccionado
		$('#tabla_lista_citas').on( 'click', 'tr', function () {
			total_marcados = $('.marcar_desactivar').filter(':checked').length
			citas_anteriores = $('.citas_anteriores').filter(':checked').length			
			if(total_marcados == 1 & citas_anteriores == 0){
				$('#vinculo_modificar_cita').css('display', 'block');
			}else{
				$('#vinculo_modificar_cita').css('display', 'none');
			}
			if(citas_anteriores >= 1){
				$('#vinculo_cita_anterior').css('display', 'block');
			}else{
				$('#vinculo_cita_anterior').css('display', 'none');
			}
		});
				
		$(".modificar_citas").on("click", function () {
            $('#formulario_de_citas').attr('action', "<?php echo vinculo('modificar-cita'); ?>");			
			$("#formulario_de_citas" ).submit();
        });
		
		//Desactivar citas
		$("#btn_desactivar_citas").on("click", function () {
            $('#formulario_de_citas').attr('action', "<?php echo vinculo('desactivar-citas'); ?>");			
			$("#formulario_de_citas" ).submit();
        });
    });
</script>
	<?php $conn->close(); ?>
</body>
</html>
