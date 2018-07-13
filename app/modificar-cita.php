<?php
header('Cache-Control: no cache'); 
session_cache_limiter('private_no_expire');
session_start();
include 'parts/conex.php';
$pagina = 'Modificar cita';
$migas = array('Agenda');
$migas_url = array('');

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';

while ($post = each($_POST))
{
	$desactivar = substr($post[0], 0, 11);
	if($desactivar == 'desactivar_' && $post[1] == 'on') {
		$id_modificar = substr($post[0], 11);				
	}
}

if(empty($id_modificar)){
	header('location:'.$url_app.'agenda');
}

$datos_cita = buscar_cita($id_modificar); 



?>
	<?php echo header_documento(); ?>
	<link href="<?php echo $url_app; ?>css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
    <link href="<?php echo $url_app; ?>css/plugins/fullcalendar/fullcalendar.print.css" rel='stylesheet' media='print'>
	<?php include 'parts/header.php'; ?>	
	<link href="<?php echo $url_app; ?>css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
	<link href="<?php echo $url_app; ?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">
	<link href="<?php echo $url_app; ?>css/plugins/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
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
	#buscar_rango_fechas, #vinculo_modificar_cita	{
		display:none;
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
		<form id="formulario_de_citas" action="<?php echo $url_app; ?>update-cita" method="post">	
		<input type="hidden" name="id" value="<?php echo $id_modificar; ?>">
			<div class="row">
				<div class="col-md-3">					
				</div>
				<div class="col-md-6">
					<div class="ibox float-e-margins">
						<div class="ibox-title">
							<h5>Modificar cita de: <?php echo $datos_cita['nombre'].' - '.$datos_cita['apellidos']; ?></h5>
						</div>
						<div class="ibox-content">
							<!-- contenido -->
							<div class="row">	
								<div class="col-md-2"></div>
								<div class="col-md-8">	
									<div class="form-group"><label class="col-lg-4 control-label">Titulo</label>
										<div class="col-lg-6">
											<input type="text" placeholder="Titulo" class="input-sm form-control" name="titulo" value="<?php echo $datos_cita['titulo']; ?>">
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
												<option class="event_inicio" <?php if($datos_cita['tipo_cita'] == 'Inicial') { echo "selected"; } ?>>Inicial</option>
												<option class="event_revision"<?php if($datos_cita['tipo_cita'] == 'Revisión') { echo "selected"; } ?>>Revisión</option>
												<option class="event_mediciones" <?php if($datos_cita['tipo_cita'] == 'Mediciones') { echo "selected"; } ?>>Mediciones</option>
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
									<div class="form-group"><label class="col-lg-4 control-label">Inicio de la cita</label>
										<div class="col-lg-6">
											<input id="date_inicio" type="text" placeholder="Fecha Inicio.." class="input-sm form-control" name="inicio" value="<?php echo $datos_cita['inicio']; ?>" required>
										</div>
									</div>
								</div>
								<div class="col-md-2"></div>
							</div>
							<br><br>							
							<div class="row">
								<div class="col-md-12">								
									<div class="form-group text-center">
									<a href="<?php echo $url_app; ?>agenda" class="btn btn-w-m btn-atras">Atras</a>
									<button id="guardar_alimento" type="submit" class="btn btn-w-m btn-primary" title="Guardar las nuevas citas">Guardar</button>
									</div>
								</div>
							</div>	
							<!-- fin contenido -->
						</div>
					</div>
				</div>
				<div class="col-md-3">					
				</div>
			</div>
		</form>		
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
	<script>
    $(document).ready(function() {   
		//Fecha y Hora
		$('#date_inicio, #date_fin').datetimepicker({ 
			minDate: moment(1, 'h'),
			locale:'es'
		});
		
    });
</script>
	<?php $conn->close(); ?>
</body>
</html>
