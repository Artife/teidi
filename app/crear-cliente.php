<?php
session_start();
include 'parts/conex.php';
$pagina = 'Crear Cliente';
$migas = array('Lista Alimentos');
$migas_url = array('lista-alimentos');

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';

?>
	<?php echo header_documento(); ?>
	<!-- TouchSpin -->	
	<link href="<?php echo $url_app; ?>css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="<?php echo $url_app; ?>css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
	<link href="<?php echo $url_app; ?>css/plugins/datapicker/datepicker3.css" rel="stylesheet">
	<link href="<?php echo $url_app; ?>css/plugins/dualListbox/bootstrap-duallistbox.min.css" rel="stylesheet">
	<?php include 'parts/header.php'; ?>	
	<style>
	.table-responsive {
		overflow-x: hidden;
	}
	p {
		font-size: 14px;
	}
	h3{
		font-size: 16px ;
	}
	.note-editable {
		min-height: 300px;
	}
	#dni_mensaje{
		display:none;
	}
	.select_multp_lg select{
		min-height: 450px;
	}	
	.no_mover {
		pointer-events: none;
		opacity: 0.4;
	}
	.boton_mediciones{
		color: #81d742;
		font-size: 40px;
		position: absolute;
		right: 38px;
		top: 20px;
		cursor:pointer;
	}
	.boton_mediciones:hover, .boton_grafico:hover{
		color: #5ea728;
	}
	.med_inputs{
		min-width: 180px;
		text-align: left;
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
		<form action="<?php echo $url_app; ?>crear-nuevo-cliente" method="post">						
		<div class="row">
            <div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-content">
						<h1>Datos obligatorios</h1>	
						<span title="Introducir mediciones" class="boton_mediciones" data-toggle="modal" data-target="#myModal_mediciones"><i class="fa fa-bar-chart"></i></span>		
						<br />
						<div class="row">
							<div class="col-md-12">								
								<div class="form-group">
									<p id="dni_mensaje"><strong>¿El DNI no es correcto seguro que desea continuar?</strong></p>
								</div>
							</div>
						</div>	
						<div class="row">
							<div class="col-md-6">							
								<div class="row">
									<div class="col-md-6">										
										<div class="input-group m-b"><span class="input-group-addon" style="padding-right: 47px;">DNI</span><input id="dni" type="text" placeholder="DNI" class="form-control" name="dni_cliente" required></div>
									</div>
									<div class="col-md-6">
										<div class="input-group m-b"><span class="input-group-addon">Nombre</span><input type="text" placeholder="Nombre" class="form-control" name="nombre_cliente" required></div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="input-group m-b"><span class="input-group-addon">Apellidos</span><input type="text" placeholder="Apellidos" class="form-control" name="apellidos_clientes" required></div>
									</div>
								</div>								
								<div class="row">
									<div class="col-md-12">
										<div class="input-group m-b"><span class="input-group-addon" style="padding-right: 37px;">Email</span><input type="email" placeholder="Email" class="form-control" name="email_cliente" required></div>
									</div>
								</div>
								<br />
								<div class="row">
									<div class="col-md-12">
										<div class="login-panel panel panel-default" style="margin-top:0px;">
											<div class="panel-heading">
												<h3 id="informacion_title">Información</h3>
												<button id="modificar" style="float-right; position:absolute; right:30px; top:9px;" type="button" class="btn btn-primary">Modificar</button>
											</div>
											<div class="panel-body">
												<div class="row">
													<div class="col-md-6">
														<p>Metabolismo basal</p>
													</div>
													<div class="col-md-6">
														<input type="number" step="0.25" class="form-control" id="metabolismo" name="metabolismo" readonly>
													</div>
												</div>
												<br />
												<div class="row">
													<div class="col-md-6">
														<p>Gasto energético total</p>
													</div>
													<div class="col-md-6">
														<input type="number" step="0.25" id="gasto" name="gasto" class="form-control" readonly>
													</div>
												</div>
												<br />
												<div class="row">
													<div class="col-md-6">
														<p>Índice Masa Corporal</p>
													</div>
													<div class="col-md-6">
														<input type="number" step="0.25" class="form-control" name="imc" id="imc" readonly>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">		
								<div class="row">
									<div class="col-md-3">
										<div class="input-group m-b"><span class="input-group-addon">Peso</span><input id="peso" type="number" placeholder="Peso" class="form-control" name="peso" step="0.25" required><span class="input-group-addon">kg</span></div>
									</div>
									<div class="col-md-4">
										<div class="input-group m-b"><span class="input-group-addon" style="padding-right: 32px;">Altura</span><input id="altura" type="number" placeholder="Altura" class="form-control" name="altura" step="0.25" required><span class="input-group-addon">cm</span></div>
									</div>
									<div class="col-md-5">
										<div class="form-group" id="data_1">
											<div class="input-group date">
												<span class="input-group-addon"> Fecha de nacimiento <i class="fa fa-calendar"></i></span><input id="fecha_nacimiento" type="text" class="form-control" value="03/04/2014" name="fecha_nacimiento" required>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="input-group m-b"><span class="input-group-addon">Sexo</span>
											<select id="sexo" class="input-sm form-control input-s-sm" style="padding-top:0px;" name="sexo">										
												<option>Hombre</option>
												<option>Mujer</option>
											</select>
										</div>
									</div>
									<div class="col-md-9">
										<div class="input-group m-b"><span class="input-group-addon">Actividad</span>
											<select id="actividad" class="input-sm form-control input-s-sm" style="padding-top:0px;" name="actividad">										
												<option>Intensa</option>
												<option>Moderada</option>
												<option>Ligera</option>
												<option>Reposo en cama</option>
											</select>
										</div>
									</div>									
								</div>
								<br />
								<div class="row">
									<div class="col-md-12">
										<h3>Excluir grupo de alimentos completo <i class="fa fa-info-circle" aria-hidden="true" style="color: #8dc72c;" title="Seleccione aquellos grupos completos de alimentos que se desee excluir en la dieta a elaborar.
	Si no desea excluir un grupo completo seleccione en la opción Excluir alimentos individualmente todos aquellos alimentos que desea excluir.
	Ambas opciones funcionan de forma complementaria, de manera que el generador excluirá de la dieta elaborada tanto los grupos de alimentos como los alimentos individuales que elija."></i></h3>
									</div>									
								</div>								
								<div class="row">
									<div class="col-md-12">																	
										<?php $grupos_alimentos = mostrar_grupos_alimentos(); ?>
										<select id="grupos_alimentos" class="form-control dual_select" name="grupos_alimentos[]" multiple>
											<?php for ($i=0; $i <= count($grupos_alimentos); $i++) {?>
											<?php if(!empty($grupos_alimentos[$i]['grupo'])) { ?>
											<option value="<?php echo $grupos_alimentos[$i]['id_grupo']; ?>"><?php echo utf8_encode($grupos_alimentos[$i]['grupo']); ?></option>
											<?php } ?>
											<?php } ?>
										</select>										
										<br />
										<div class="text-center">	
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Excluir alimentos individualmente</button>
										</div>
									</div>
								</div>	
							</div>	
						</div>
						<br /><br />									 
					</div>
					<!-- Datos Opcionales -->
					<div class="ibox-content">						
						<div class="row">
							<div class="col-md-6">
								<h1>Recomendaciones</h1>
								<div class="ibox-content no-padding">									
									<textarea name="recomendaciones" class="summernote">
									Espacio para incluir recomendaciones ó instrucciones al paciente  "Este contenido se mostrara en el informe del paciente"
									</textarea>
								</div>		
							</div>
							<div class="col-md-6">
								<h1>Notas del nutricionista (Solo lectura)</h1>
								<div class="ibox-content no-padding">									
									<textarea name="comentarios" class="summernote">
									Espacio para incluir datos, pruebas médicas, observaciones, etc del paciente  "Este contenido NO se mostrara en el informe del paciente"
									</textarea>
								</div>	
							</div>
						</div>
					</div>
					<!-- Datos Opcionales -->
					<!-- Parte 3 -->
					<div class="ibox-content">
						<h1>Datos opcionales</h1>							
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-12">
										<input type="text" placeholder="Dirección" class="form-control" name="direccion">
									</div>
								</div>
								<br />
								<div class="row">
									<div class="col-md-3">
										<input type="text" placeholder="Localidad" class="form-control" name="localidad">
									</div>
									<div class="col-md-3">
										<input type="text" placeholder="C.P." class="form-control" name="cp">
									</div>
									<div class="col-md-3">
										<input type="text" placeholder="Teléfono Fijo" class="form-control" name="telefono_fijo">
									</div>
									<div class="col-md-3">
										<input type="text" placeholder="Teléfono Movil" class="form-control" name="telefono_movil">
									</div>
								</div>
								<br /><br />									
								<div class="row">
									<div class="col-md-12">								
										<div class="form-group text-right">
										<a href="<?php echo $url_app; ?>lista-alimentos" class="btn btn-w-m btn-atras">Atras</a>
										<button id="guardar_cliente" type="submit" class="btn btn-w-m btn-guardar">Guardar</button>
										</div>
									</div>
								</div>	
							</div>
							<div class="col-md-6">								
							</div>
						</div>
					</div>
					<!-- Parte 3 fin -->
				</div>
			</div>
		</div>
		<!-- Modal Alimentos -->
		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog modal-lg">
			  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Excluir alimentos</h4>
				</div>
				<div class="modal-body select_multp_lg">
				  <p>Selecciona los alimentos a excluir.</p>
				  <?php $alimentos_activos = listado_de_alimentos_completo(); ?>				  
				  <?php  //print_r($alimentos_activos); ?>
					<select id="alimentos" class="form-control dual_select2" name="alimentos[]" multiple>
						<?php  for ($i=0; $i <= count($alimentos_activos); $i++) {?>
						<?php if(!empty($alimentos_activos[$i]['id_definitivo'])) { ?>
							<option class="<?php echo $alimentos_activos[$i]['id_grupo']; ?>" value="<?php echo $alimentos_activos[$i]['id_definitivo']; ?>"><?php echo utf8_encode($alimentos_activos[$i]['nombre']); ?></option>
						<?php } ?>
						<?php }  ?>						
					</select>
				</div>
				<div class="modal-footer">
					<input id="informacion" type="hidden" name="informacion" value="">	
					<input id="edad" type="hidden" name="edad" value="">		
				  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			  </div>
			</div>
		</div>
		<!-- Fin Modal Alimentos -->
		<!-- Modal Mediciones -->
		<!-- Modal -->
		<div id="myModal_mediciones" class="modal fade" role="dialog">
		  <div class="modal-dialog modal-lg">
			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header contenido_oculto">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-center">Mediciones de cliente</h4>
				<br /><br />
				<ul  class="nav nav-pills">
					<li class="active">
						<a  href="#1a" data-toggle="tab">Bia</a>
					</li>
					<li>
						<a href="#2a" data-toggle="tab">Ultrasonidos</a>
					</li>
					<li>
						<a href="#3a" data-toggle="tab">Infrarrojos</a>
					</li>
					<li>
						<a href="#4a" data-toggle="tab">Plicometría</a>
					</li>
					<li>
						<a href="#5a" data-toggle="tab">Perímetros</a>
					</li>
				</ul>
					<div class="tab-content clearfix">
						<div class="tab-pane active" id="1a">
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-6">							
									<br /><br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Grasa</span><input type="number" placeholder="Grasa" class="form-control" name="bia_porc_grasa" step="0.25" value="0"  required><span class="input-group-addon">%</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Grasa Total</span><input  type="number" placeholder="Grasa Total" class="form-control" name="bia_grasa_total" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Masa Grasa Total</span><input type="number" placeholder="Masa Grasa Total" class="form-control" name="bia_masa_grasa_total" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Agua Total</span><input type="number" placeholder="Agua Total" class="form-control" name="bia_agua_total" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Agua Intracelular</span><input type="number" placeholder="Agua Intracelular" class="form-control" name="bia_agua_intracelular" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Agua Extracelular</span><input type="number" placeholder="Agua Extracelular" class="form-control" name="bia_agua_extracelular" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Masa Magra</span><input type="number" placeholder="Masa Magra" class="form-control" name="bia_porc_masa_magra" step="0.25" value="0"  required><span class="input-group-addon">%</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Masa Muscular Total</span><input type="number" placeholder="Masa Muscular Total" class="form-control" name="bia_masa_muscular_total" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Músculo Brazo Dcho</span><input type="number" placeholder="Músculo Brazo Dcho" class="form-control" name="bia_musc_brazo_dcho" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Músculo Brazo Izdo</span><input type="number" placeholder="Músculo Brazo Izdo" class="form-control" name="bia_musc_brazo_izdo" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Tronco</span><input type="number" placeholder="Tronco" class="form-control" name="bia_tronco" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Pierna Derecha</span><input type="number" placeholder="Pierna Derecha" class="form-control" name="bia_pierna_dcha" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Pierna Izquierda</span><input type="number" placeholder="Pierna Izquierda" class="form-control" name="bia_pierna_izda" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Grasa Visceral</span><input type="number" placeholder="Grasa Visceral" class="form-control" name="bia_grasa_visceral" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
								</div>
								<div class="col-md-3"></div>
							</div>	
						</div>
						<div class="tab-pane" id="2a">
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-6">							
									<br /><br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Grasa</span><input type="number" placeholder="Grasa" class="form-control" name="ultrasonidos_grasa" step="0.25" value="0"  required><span class="input-group-addon">%</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Grasa Total</span><input  type="number" placeholder="Grasa Total" class="form-control" name="ultrasonidos_grasa_total" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Masa Magra Total</span><input type="number" placeholder="Masa Grasa Total" class="form-control" name="ultrasonidos_masa_magra" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>									
								</div>
								<div class="col-md-3"></div>
							</div>	
						</div>
						<div class="tab-pane" id="3a">
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-6">							
									<br /><br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Grasa</span><input type="number" placeholder="Grasa" class="form-control" name="infrarrojos_grasa" step="0.25" value="0"  required><span class="input-group-addon">%</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Grasa Total</span><input  type="number" placeholder="Grasa Total" class="form-control" name="infrarrojos_grasa_total" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Masa Magra Total</span><input type="number" placeholder="Masa Grasa Total" class="form-control" name="infrarrojos_masa_magra" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>									
								</div>
								<div class="col-md-3"></div>
							</div>	
						</div>
						<div class="tab-pane" id="4a">
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-6">							
									<br /><br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Tricipital</span><input type="number" placeholder="Tricipital" class="form-control" name="plico_tricipital" step="0.25" value="0"  required><span class="input-group-addon">mm</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Bicipital</span><input  type="number" placeholder="Bicipital" class="form-control" name="plico_bicipital" step="0.25" value="0"  required><span class="input-group-addon">mm</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Subescapular</span><input type="number" placeholder="Subescapular" class="form-control" name="plico_subescapular" step="0.25" value="0"  required><span class="input-group-addon">mm</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Suprailíaco</span><input type="number" placeholder="Suprailíaco" class="form-control" name="plico_suprailiaco" step="0.25" value="0"  required><span class="input-group-addon">mm</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Abdominal</span><input type="number" placeholder="Abdominal" class="form-control" name="plico_abdominal" step="0.25" value="0"  required><span class="input-group-addon">mm</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Pectoral</span><input type="number" placeholder="Pectoral" class="form-control" name="plico_pectoral" step="0.25" value="0"  required><span class="input-group-addon">mm</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Medioaxilar</span><input type="number" placeholder="Medioaxilar" class="form-control" name="plico_medioaxiliar" step="0.25" value="0"  required><span class="input-group-addon">mm</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Muslo</span><input type="number" placeholder="Muslo" class="form-control" name="plico_muslo" step="0.25" value="0"  required><span class="input-group-addon">mm</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Pantorrilla</span><input type="number" placeholder="Pantorrilla" class="form-control" name="plico_pantorrilla" step="0.25" value="0"  required><span class="input-group-addon">mm</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Suma Pliegues</span><input type="number" placeholder="Suma Pliegues" class="form-control" name="plico_suma_pliegues" step="0.25" value="0"  required><span class="input-group-addon"></span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Grasa</span><input type="number" placeholder="Grasa" class="form-control" name="plico_porc_grasa" step="0.25" value="0"  required><span class="input-group-addon">%</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Total Grasa</span><input type="number" placeholder="Total Grasa" class="form-control" name="plico_total_grasa" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Total Masa Magra</span><input type="number" placeholder="Total Masa Magra" class="form-control" name="plico_masa_grasa" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Densidad</span><input type="number" placeholder="Densidad" class="form-control" name="plico_densidad" step="0.25" value="0"  required><span class="input-group-addon"></span></div>
								</div>
								<div class="col-md-3"></div>
							</div>	
						</div>
						<div class="tab-pane" id="5a">
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-6">							
									<br /><br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Cefálico</span><input type="number" placeholder="Cefálico" class="form-control" name="perimetro_cefalico" step="0.25" value="0"  required><span class="input-group-addon">cm</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Cuello</span><input  type="number" placeholder="Cuello" class="form-control" name="perimetro_cuello" step="0.25" value="0"  required><span class="input-group-addon">cm</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Mesoesternal</span><input type="number" placeholder="Mesoesternal" class="form-control" name="perimetro_mesoesternal" step="0.25" value="0"  required><span class="input-group-addon">cm</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Brazo contraído</span><input type="number" placeholder="Brazo contraído" class="form-control" name="perimetro_brazo_contraido" step="0.25" value="0"  required><span class="input-group-addon">cm</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Brazo relajado</span><input type="number" placeholder="Brazo relajado" class="form-control" name="perimetro_brazo_relajado" step="0.25" value="0"  required><span class="input-group-addon">cm</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Antebrazo</span><input type="number" placeholder="Antebrazo" class="form-control" name="perimetro_antebrazo" step="0.25" value="0"  required><span class="input-group-addon">cm</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Muñeca</span><input type="number" placeholder="Muñeca" class="form-control" name="perimetro_muneca" step="0.25" value="0"  required><span class="input-group-addon">cm</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Cintura</span><input type="number" placeholder="Cintura" class="form-control" name="perimetro_cintura" step="0.25" value="0"  required><span class="input-group-addon">cm</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Cadera</span><input type="number" placeholder="Cadera" class="form-control" name="perimetro_cadera" step="0.25" value="0"  required><span class="input-group-addon">cm</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Muslo</span><input type="number" placeholder="Muslo" class="form-control" name="perimetro_muslo" step="0.25" value="0"  required><span class="input-group-addon">cm</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Pantorrilla</span><input type="number" placeholder="Pantorrilla" class="form-control" name="perimetro_pantorrilla" step="0.25" value="0"  required><span class="input-group-addon">cm</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Tobillo</span><input type="number" placeholder="Tobillo" class="form-control" name="perimetro_tobillo" step="0.25" value="0"  required><span class="input-group-addon">cm</span></div>									
								</div>
								<div class="col-md-3"></div>
							</div>	
						</div>
					</div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
			  </div>
			</div>

		  </div>
		</div>
		<!-- Fin Modal Mediciones -->
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
	<!-- Data picker -->
	<script src="<?php echo $url_app; ?>js/plugins/datapicker/bootstrap-datepicker.js"></script>
	<script src="<?php echo $url_app; ?>js/plugins/datapicker/bootstrap-datepicker-es.js"></script>
	<!-- Dual Listbox -->
    <script src="<?php echo $url_app; ?>js/plugins/dualListbox/jquery.bootstrap-duallistbox.js"></script>
	<!-- Summernote -->
	<script src="<?php echo $url_app; ?>js/plugins/summernote/summernote.min.js"></script>	
	<script>
		//Llamamos los datos de la tabla en segundo plano para que carge mucho mas rapido
        $(document).ready(function(){
			$('#mensajes_footer').modal('show');
			
			$('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
				dateFormat: 'dd/mm/yyyy',
				language: 'es'
            });
			
			$('.dual_select').bootstrapDualListbox({
                selectorMinimalHeight: 160
            });
			$('.dual_select2').bootstrapDualListbox({
                selectorMinimalHeight: 160
            });
			
			$('.summernote').summernote();
			$('.note-toolbar .note-insert, .note-toolbar .note-table, .note-toolbar .note-style:first, .note-toolbar .note-para, .note-view').remove();
        });	
		var sum = 0;
		
		//Calcular datos de peso
		var sexo = 'Hombre';
		var actividad = 'Intensa';
		var peso = '0';
		var altura = '0';
		var metabolismo = '0';
		var gasto = '0';
		// var imc;		
		var fecha_nacimiento;
		var factor_actividad_hombre = 0;
		var factor_actividad_mujer = 0;
		var info;
		var edad;
		
		
		$( "#peso, #altura").keyup(function() {
			if($("#peso").val() != '' && $("#altura").val() != '' && $("#fecha_nacimiento").val() != '' && $("#peso").val() != 0 && $("#altura").val() != 0 && $("#fecha_nacimiento").val() != 0){
				
				//Calcular metabolismo
				if (sexo == 'Hombre')
				{
					metabolismo = 66.5 + (13.74 * parseInt($("#peso").val())) + (5.03 * parseInt($("#altura").val())) - (6.75 * parseInt(calcular_edad($("#fecha_nacimiento").val())));
				}
				else
				{
					metabolismo = 655.1 + (9.65 * parseInt($("#peso").val())) + (1.85 * parseInt($("#altura").val())) - (4.68 * parseInt(calcular_edad($("#fecha_nacimiento").val())));
				}
				
				//Calcular actividad
				if ($("#actividad").val() == "Reposo en cama")
				{
					factor_actividad_mujer = 1;
					factor_actividad_hombre = 1;
				}
				else if ($("#actividad").val() == "Ligera")
				{
					factor_actividad_hombre = 1.55;
					factor_actividad_mujer = 1.56;
				}
				else if ($("#actividad").val() == "Moderada")
				{
					factor_actividad_hombre = 1.78;
					factor_actividad_mujer = 1.64;
				}
				else
				{
					factor_actividad_hombre = 2.10;
					factor_actividad_mujer = 1.82;
				}
				
				//Calcular gasto energetico
				if (sexo == "Hombre")
				{
					gasto = metabolismo * factor_actividad_hombre; 
				}
				else
				{
					gasto = metabolismo * factor_actividad_mujer;
				}
				
				//Calculamos el Índice Masa Corporal	
				imc = (parseInt($("#peso").val()) * 10000) / (parseInt($("#altura").val()) * parseInt($("#altura").val()));
				//Cambiar titulo
				if (imc < 18.5){				
				$('#informacion_title').replaceWith( '<h3 id="informacion_title">Información Peso Insuficiente</h3>' );
				$info = 'Información Peso Insuficiente';
				}else if (imc < 24.9) {					
					$('#informacion_title').replaceWith( '<h3 id="informacion_title">Información Peso Normal</h3>' );
					$info = 'Información Peso Normal';
				}
				else if (imc < 26.9){					
					$('#informacion_title').replaceWith( '<h3 id="informacion_title">Información Sobrepeso Tipo 1</h3>' );
					$info = 'Información Sobrepeso Tipo 1';
				}	
				else if (imc < 29.9){					
					$('#informacion_title').replaceWith( '<h3 id="informacion_title">Información Sobrepeso Tipo 2</h3>' );
					$info = 'Información Sobrepeso Tipo 2';
				}	
				else if (imc < 34.9){					
					$('#informacion_title').replaceWith( '<h3 id="informacion_title">Información Obesidad Tipo 1</h3>' );
					$info = 'Información Obesidad Tipo 1';
				}	
				else if (imc < 39.9){					
					$('#informacion_title').replaceWith( '<h3 id="informacion_title">Información Obesidad Tipo 2</h3>' );
					$info = 'Información Obesidad Tipo 2';
				}	
				else if (imc <= 49.9){					
					$('#informacion_title').replaceWith( '<h3 id="informacion_title">Información Obesidad Tipo 3</h3>' );
					$info = 'Información Obesidad Tipo 3';
				}	
				else if (imc > 49.9){
					$('#informacion_title').replaceWith( '<h3 id="informacion_title">Información Obesidad Tipo 4</h3>' );
					$info = 'Información Obesidad Tipo 4';
				}	
				
				
				//Escribimos las variables 
				$("#metabolismo").val(metabolismo.toFixed(2));
				$("#gasto").val(gasto.toFixed(2));
				$("#imc").val(imc.toFixed(2));
				$("#edad").val(parseInt(calcular_edad($("#fecha_nacimiento").val())));				
				$("#informacion").val($info);		
			}else{
				$("#metabolismo").val('-');
				$("#gasto").val('-');
				$("#imc").val('-');	
				$("#informacion").val('');				
			}
		});
		
		$('#actividad, #sexo, #fecha_nacimiento').change(function(){
			if($("#peso").val() != '' && $("#altura").val() != '' && $("#fecha_nacimiento").val() != '' && $("#peso").val() != 0 && $("#altura").val() != 0 && $("#fecha_nacimiento").val() != 0){
				
				//Calcular metabolismo
				if (sexo == 'Hombre')
				{
					metabolismo = 66.5 + (13.74 * parseInt($("#peso").val())) + (5.03 * parseInt($("#altura").val())) - (6.75 * parseInt(calcular_edad($("#fecha_nacimiento").val())));
				}
				else
				{
					metabolismo = 655.1 + (9.65 * parseInt($("#peso").val())) + (1.85 * parseInt($("#altura").val())) - (4.68 * parseInt(calcular_edad($("#fecha_nacimiento").val())));
				}
				
				//Calcular actividad
				if ($("#actividad").val() == "Reposo en cama")
				{
					factor_actividad_mujer = 1;
					factor_actividad_hombre = 1;
				}
				else if ($("#actividad").val() == "Ligera")
				{
					factor_actividad_hombre = 1.55;
					factor_actividad_mujer = 1.56;
				}
				else if ($("#actividad").val() == "Moderada")
				{
					factor_actividad_hombre = 1.78;
					factor_actividad_mujer = 1.64;
				}
				else
				{
					factor_actividad_hombre = 2.10;
					factor_actividad_mujer = 1.82;
				}
				
				//Calcular gasto energetico
				if ($("#sexo").val() == "Hombre")
				{
					gasto = metabolismo * factor_actividad_hombre; 
				}
				else
				{
					gasto = metabolismo * factor_actividad_mujer;
				}
				
				//Calculamos el Índice Masa Corporal	
				imc = (parseInt($("#peso").val()) * 10000) / (parseInt($("#altura").val()) * parseInt($("#altura").val()));
				
				//Cambiar titulo
				if (imc < 18.5){				
				$('#informacion_title').replaceWith( '<h3 id="informacion_title">Información Peso Insuficiente</h3>' );
				$info = 'Información Peso Insuficiente';
				}else if (imc < 24.9) {					
					$('#informacion_title').replaceWith( '<h3 id="informacion_title">Información Peso Normal</h3>' );
					$info = 'Información Peso Normal';
				}
				else if (imc < 26.9){					
					$('#informacion_title').replaceWith( '<h3 id="informacion_title">Información Sobrepeso Tipo 1</h3>' );
					$info = 'Información Sobrepeso Tipo 1';
				}	
				else if (imc < 29.9){					
					$('#informacion_title').replaceWith( '<h3 id="informacion_title">Información Sobrepeso Tipo 2</h3>' );
					$info = 'Información Sobrepeso Tipo 2';
				}	
				else if (imc < 34.9){					
					$('#informacion_title').replaceWith( '<h3 id="informacion_title">Información Obesidad Tipo 1</h3>' );
					$info = 'Información Obesidad Tipo 1';
				}	
				else if (imc < 39.9){					
					$('#informacion_title').replaceWith( '<h3 id="informacion_title">Información Obesidad Tipo 2</h3>' );
					$info = 'Información Obesidad Tipo 2';
				}	
				else if (imc <= 49.9){					
					$('#informacion_title').replaceWith( '<h3 id="informacion_title">Información Obesidad Tipo 3</h3>' );
					$info = 'Información Obesidad Tipo 3';
				}	
				else if (imc > 49.9){					
					$('#informacion_title').replaceWith( '<h3 id="informacion_title">Información Obesidad Tipo 4</h3>' );
					$info = 'Información Obesidad Tipo 4';
				}	
				
				
				//Escribimos las variables 
				$("#metabolismo").val(metabolismo.toFixed(2));
				$("#gasto").val(gasto.toFixed(2));
				$("#imc").val(imc.toFixed(2));
				$("#edad").val(parseInt(calcular_edad($("#fecha_nacimiento").val())));
				$("#informacion").val($info);
				
				
			}else{
				$("#metabolismo").val('-');
				$("#gasto").val('-');
				$("#imc").val('-');		
				$("#informacion").val('');		
			}
		});
		
		$('#dni').keyup(function() {
			var numero, let, letra;
			var expresion_regular_dni = /^[XYZ]?\d{5,8}[A-Z]$/;
			var dni = $("#dni").val();
			
			dni = dni.toUpperCase();

			if(expresion_regular_dni.test(dni) === true){
				numero = dni.substr(0,dni.length-1);
				numero = numero.replace('X', 0);
				numero = numero.replace('Y', 1);
				numero = numero.replace('Z', 2);
				let = dni.substr(dni.length-1, 1);
				numero = numero % 23;
				letra = 'TRWAGMYFPDXBNJZSQVHLCKET';
				letra = letra.substring(numero, numero+1);
				if (letra != let) {					
					$('#dni_mensaje').css('display','block');
				}else{					
					$('#dni_mensaje').css('display','none');
				}
			}else{
				$('#dni_mensaje').css('display','block');
			}
		});		
		
		//Calcular edad
		function calcular_edad(cumple) {
			var cumple_arr = cumple.split("/");
			var cumple_fecha = new Date(cumple_arr[2], cumple_arr[1] - 1, cumple_arr[0]);
			var ageDifMs = Date.now() - cumple_fecha.getTime();
			var ageDate = new Date(ageDifMs);
			return Math.abs(ageDate.getUTCFullYear() - 1970);
		}
		
		//Modificar campos
		$('#modificar').click(function() {
			$('#metabolismo').attr('readonly', false); 
			$('#gasto').attr('readonly', false); 
			$('#imc').attr('readonly', false); 
		});		
		
		//Cascada de grupos de alimentos > alimentos			
		$('#grupos_alimentos').change(function() {
			var seleccion = $("#grupos_alimentos").val();			
			var contador = (seleccion.length);
			$('#alimentos option').prop('selected', false);
			for (var i=0; i<contador; i++) {						
				$('#alimentos option[class="'+seleccion[i]+'"]').prop('selected', true);
				$('.'+seleccion[i]).addClass('no_mover');
				console.log(seleccion[i]);
			}
			$('#alimentos').bootstrapDualListbox('refresh', true);
			$('.bootstrap-duallistbox-container .removeall').prop('disabled', true);
		});			
    </script>	
	<?php $conn->close(); ?>
</body>
</html>
