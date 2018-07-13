<?php
session_start();
include 'parts/conex.php';
$pagina = 'Configurar Dieta';
$migas = array('Lista Clientes');
$migas_url = array('lista-clientes');

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';

while ($post = each($_POST)){
	if($post[0] != 'example_length') {
		//echo $post[0] . " = " . $post[1];
		if(!empty($post[0])){	
			$cliente_id = $post[0];
		}
	}
}
if(empty($cliente_id)) { $cliente_id = $_GET['id']; }

if(empty($cliente_id)){
	$_SESSION['mensaje'] = 'datos_vacios';	
	header('location:'.$url_app.'lista-clientes');
}
$cliente = obtener_datos_cliente_x_usuario ($cliente_id);	
$historial_peso = obtener_historial_peso_cliente ($cliente_id);
if(empty($historial_peso)){
	$ultimo_peso['gasto_energetico_total'] = 0;
}else{
	$ultimo_peso = array_pop($historial_peso);
}	

?>
	<?php echo header_documento(); ?>	
	<?php include 'parts/header.php'; ?>	
	<link href="<?php echo $url_app; ?>css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
	<link href="<?php echo $url_app; ?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">
	<!-- Morris -->    	
	<link href="<?php echo $url_app; ?>css/plugins/datapicker/datepicker3.css" rel="stylesheet">
	<style>
	.table-responsive {
		overflow-x: hidden;
	}
	.check_line {
		margin-top: -1px;
		float: left;
		padding-right: 35px;
	}
	.checkbox+.checkbox, .radio+.radio {
		margin-top: auto;
	}
	#listado_plantillas, .mantener_kcal_clase, .adaptar_kcal_clase, .config_dieta{
		display:none;
	}
	.adaptar_kcal_class{
		float: left;
		width: 30%;
		margin-left: 15px;
		margin-top: -7px;
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
		<form id="formulario_completo" action="<?php echo $url_app; ?>dieta" method="post">		
		<input type="hidden" name="cliente_id" value="<?php echo $cliente_id; ?>" 	>
		<div class="row"> 				
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h1><strong>Cliente:</strong> <?php echo $cliente['apellidos'].', '.$cliente['nombre']; ?></h1>	
						<div class="ibox-tools">							
						</div>
					</div>
					<div class="ibox-content">
						<h3>Asistente de generación de dieta</h3>
						<p>Configuración básica</p>
						<br />
						<div class="row grupo_plantilla">
							<div class="col-md-2"></div>
							<div class="col-md-8">                            
									<div class="form-group"><label class="col-lg-2 control-label">Duración (días)</label>
										<div class="col-lg-5"><input type="number" id="duracion" name="duracion" placeholder="Duración (días)" value="7" min="1" max="365" step="1" class="form-control" required>
										</div>
									</div>
									<br /><br />
									<div class="form-group"><label class="col-lg-2 control-label">Comidas por día</label>
										<div class="col-lg-5">	
											<select class="form-control m-b" id="num_comidas" name="num_comidas">
												<option>3</option>
												<option select>4</option>
												<option>5</option>
												<option>6</option>
											</select>
										</div>
									</div>
									<br /><br />
									<div class="form-group "><label class="col-lg-2 control-label">Comida con</label>
										<div class="col-lg-10" id="confi_comidas">
											 <div class="radio radio-success radio-inline">
												<input type="radio" id="platos_comidas_1" name="platos_comidas"  value="1">
												<label for="platos_comidas_1">
													1 plato
												</label>
											</div>
											<div class="radio radio-success radio-inline">
												<input type="radio" id="platos_comidas_2" name="platos_comidas"  value="2" checked="">
												<label for="platos_comidas_2">
													2 plato
												</label>
											</div>
											<div class="checkbox checkbox-success checkbox-inline" style="margin-top: -5px; margin-left: 9px;">
												<input type="checkbox" id="comida_postre" name="comida_postre" value="si" checked="">
												<label for="comida_postre"> Postre </label>
											</div>
										</div>
									</div>
									<br /><br />
									<div class="form-group "><label class="col-lg-2 control-label">Cena con</label>
										<div class="col-lg-10" id="confi_cenas">
											<div class="radio radio-success radio-inline">
												<input type="radio" id="plato_cena_1" name="plato_cena" value="1">
												<label for="plato_cena_1">
													1 plato
												</label>
											</div>
											<div class="radio radio-success radio-inline">
												<input type="radio" id="plato_cena_2" name="plato_cena" value="2" checked="">
												<label for="plato_cena_2">
													2 plato
												</label>
											</div>
											<div class="checkbox checkbox-success checkbox-inline" style="margin-top: -5px; margin-left: 9px;">
												<input type="checkbox" id="cena_postre" name="cena_postre" value="si" checked="">
												<label for="cena_postre"> Postre </label>
											</div>
										</div>
									</div>
									<br /><br />									
									<div class="form-group">
										<div class="col-lg-offset-2 col-lg-10">
										</div>
									</div>
							</div>	
							<div class="col-md-2"></div>	
						</div>
						<div class="row">
							<div class="col-md-2"></div>	
								<div class="col-md-8">
									<div class="form-group"><label class="col-lg-2 control-label">Fecha de inicio</label>
										<div class="col-lg-5">
											<div class="input-group date">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input id="data_1" type="text" class="form-control" name="fecha_inicio" value="<?php echo date('d/m/Y'); ?>" required>
											</div>
										</div>
									</div>
									<br /><br />
								</div>
							<div class="col-md-2"></div>	
						</div>
						<br /><br />									 
					</div>
				</div>
			</div>
		</div>	
		<!-- Avanzada -->	
		<div class="row"> 				
			<div class="col-lg-12">
				<div class="ibox float-e-margins">					
					<div class="ibox-content">
						<p>Configuración avanzada</p>
						<br />						
						<br /><br />
						<div class="row grupo_plantilla">
							<div class="col-md-2"></div>
							<div class="col-md-4">								                              
								<div class="form-group"><label class="col-lg-4 control-label">Kilocalorías/día</label>
									<div class="col-lg-6">
										<input type="number" name="kilocalorias_dia" placeholder="Duración (días)" value="<?php echo round($ultimo_peso['gasto_energetico_total']); ?>" class="form-control" min="1500" max="6000" required>
									</div>
								</div>
								<br /><br />
								<div class="form-group"><label class="col-lg-4 control-label">Grasas diarias</label>
									<div class="col-lg-6">
										<div class="input-group m-b"><input type="number" name="grasas_diarias" placeholder="Duración (días)" value="30" class="form-control" required><span class="input-group-addon">%</span></div>
									</div>
								</div>
							</div>
							<div class="col-md-4">			
								<div class="form-group"><label class="col-lg-4 control-label">Proteínas diarias</label>
									<div class="col-lg-6">
										<div class="input-group m-b"><input type="number" name="proteinas_diarias" placeholder="Duración (días)" value="15" class="form-control" required><span class="input-group-addon">%</span></div>
									</div>
								</div>
								<br /><br />
								<div class="form-group"><label class="col-lg-4 control-label">Hidratos diarios</label>
									<div class="col-lg-6">
										<div class="input-group m-b"><input type="number" name="hidratos_diarios" placeholder="Duración (días)" value="55" class="form-control" required><span class="input-group-addon">%</span></div>
									</div>
								</div>							
							</div>	
							<div class="col-md-2"></div>	
						</div>
						<br /><br />
						<div class="row">
							<div class="col-md-2"></div>
							<div class="col-md-3">								                              
								<div class="checkbox checkbox-success checkbox-inline" style="margin-top: -5px; margin-left: 9px;">
									<input type="checkbox" id="limitar_tamano" name="limitar_tamano" value="si" checked>
									<label for="limitar_tamano"> Limitar tamaño </label>
								</div>
								<div class="checkbox checkbox-success checkbox-inline" style="margin-top: -5px; margin-left: 9px;">
									<input type="checkbox" id="usar_plantilla" name="usar_plantilla" value="si">
									<label for="usar_plantilla"> Usar plantilla</label>
								</div>
							</div> 
							<div class="col-md-3">
								<select class="form-control m-b" id="listado_plantillas" name="listado_plantillas">
									<?php echo gx_listado_de_plantillas(); ?>
								</select>
							</div>
							<div class="col-md-3">
								<div class="checkbox checkbox-success checkbox-inline mantener_kcal_clase">
									<input type="checkbox" id="mantener_kcal" name="mantener_kcal" value="si">
									<label for="mantener_kcal"> Mantener Kcal y raciones originales </label>
								</div>
							</div>	
						</div>
						<div class="row">
							<div class="col-md-8"></div>
							<div class="col-md-3">
								<div class="checkbox checkbox-success checkbox-inline adaptar_kcal_clase">
									<input type="checkbox" id="adaptar_kcal" name="adaptar_kcal" value="si">
									<label for="adaptar_kcal" style="float: left;"> Adaptar a Kcal/día </label>
									<input type="number" id="adaptar_kcal_number" name="adaptar_kcal_number" placeholder="<?php echo round($ultimo_peso['gasto_energetico_total']); ?>" value="<?php echo round($ultimo_peso['gasto_energetico_total']); ?>" class="form-control adaptar_kcal_class">
								</div>				
							</div>
							<div class="col-md-1"></div>	
						</div>	
						<br /><br />
						<div class="row">
							<div class="col-md-2"></div>
							<div class="col-md-8 text-center">
								<div class="form-group text-center">
									<a id="limpiar_inputs" href="#" class="btn btn-w-m btn-default">Limpiar</a>
									<button id="guardar_alimento" type="submit" class="btn btn-w-m btn-primary" title="La suma de Hidratos, Proteínas y Grasas debe dar 100">Generar</button>
								</div>
							</div> 
							<div class="col-md-2"></div>	
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Avanzada -->
		</form>	
		<!-- Fin buscador -->  
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
	 <!-- Date range picker -->
    <script src="<?php echo $url_app; ?>js/plugins/datapicker/bootstrap-datepicker.js"></script>
	<script src="<?php echo $url_app; ?>js/plugins/datapicker/bootstrap-datepicker-es.js"></script>
	
	<script>
		$(document).ready(function(){
			$('#mensajes_footer').modal('show');
			$('#data_1').datepicker({
				startDate: new Date(),
				minDate: 0, 
                todayBtn: "linked",                
                autoclose: true,				
				setDate: "0",		
				dateFormat: 'dd/mm/yyyy',
				language: 'es'
				
            });	
			//Limpiar formulario
			$('#limpiar_inputs').click(function() {
				$('#formulario_completo')[0].reset();
			});
			//Limpiar formulario
			$('#usar_plantilla').change(function() {
				if ($(this).is(':checked')) {
				   // Do something...				   
				   $('#duracion').prop('disabled', true); 
				   $('#num_comidas').prop('disabled', true); 
				   $('#platos_comidas_1').prop('disabled', true); 
				   $('#platos_comidas_2').prop('disabled', true); 
				   $('#comida_postre').prop('disabled', true); 
				   $('#plato_cena_1').prop('disabled', true); 
				   $('#plato_cena_2').prop('disabled', true); 
				   $('#cena_postre').prop('disabled', true); 
				   $('.grupo_plantilla').css('display', 'none'); 
				   $('.config_dieta').css('display', 'none'); 				  	
				   $('#listado_plantillas').css('display', 'block'); 
				   $('.mantener_kcal_clase').css('display', 'block'); 
				   $('.adaptar_kcal_clase').css('display', 'block'); 			
				}else{
					// alert('not');
				   $('#duracion').prop('disabled', false); 
				   $('#num_comidas').prop('disabled', false); 
				   $('#platos_comidas_1').prop('disabled', false); 
				   $('#platos_comidas_2').prop('disabled', false); 
				   $('#comida_postre').prop('disabled', false); 
				   $('#plato_cena_1').prop('disabled', false); 
				   $('#plato_cena_2').prop('disabled', false); 
				   $('#cena_postre').prop('disabled', false); 
				   $('.grupo_plantilla').css('display', 'block'); 
				   $('.config_dieta').css('display', 'block'); 				  	
				   $('#listado_plantillas').css('display', 'none'); 
				   $('.mantener_kcal_clase').css('display', 'none'); 
				   $('.adaptar_kcal_clase').css('display', 'none'); 
				};
			});	
			
			$('#mantener_kcal').change(function() {
				if ($(this).is(':checked')) {					
					$('#adaptar_kcal').prop('checked', false); // Checks it						
				}		
			});		
			$('#adaptar_kcal').change(function() {
				if ($(this).is(':checked')) {
					$('#mantener_kcal').prop('checked', false); // Checks it										
				}		
			});
		});	
	</script>		
	<?php $conn->close(); ?>
</body>
</html>
