<?php
session_start();
include 'parts/conex.php';
ini_set('error_reporting', E_ALL);

//Solo permitir acceso a estos roles
$acceso_roles = array('admin');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';

$id_usuario =  $_GET['id']; 

//Solicitamos los datos del usuario
$where = "WHERE id_usuario = '".$id_usuario."'";
$datos = listado_de_usuarios($where);

//si trata de entrar con un usuario que no existe
if($datos[0]['id_usuario'] == '') {
	header('location:'.$url_app.'lista-usuarios/1');
}

$pagina = 'Actualizar usuario - '.salida_nombre($datos[0]['nombre']);
$migas = array('');
$migas_url = array('');
$botones ="";
/*
Errores
11 = este usuario no existe

*/	
?>
	<?php echo header_documento(); ?>
	<?php include 'parts/header.php'; ?>
	<link href="<?php echo $url_app; ?>css/plugins/datapicker/datepicker3.css" rel="stylesheet">
	
	<!-- Check -->
	<link href="<?php echo $url_app; ?>css/plugins/switchery/switchery.css" rel="stylesheet">
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
			<?php echo migas_de_pan($pagina, $migas, $migas_url, $botones); ?>                
            </div>
		<div class="wrapper wrapper-content animated fadeInRight">	
        <div class="row">
            <div class="col-lg-12">
				<div class="ibox float-e-margins">					
					
					<!--- Fin  Mensajes -->
					<div class="ibox-title">
						Actualice los datos del nuevo usuario                            
					</div>
					<div class="ibox-content">
					<!-- formulario nuevo usuario -->
					<div class="row">							
					<form method="post" class="form-horizontal" action="<?php echo vinculo('update-usuario'); ?>">						
						<input type="hidden"  name="id_usuario" value="<?php echo $id_usuario; ?>" >
						<input type="hidden"  name="row" value="<?php echo $id_usuario; ?>" >
						<div class="col-lg-6">
							<div class="form-group"><label class="col-sm-5 control-label">Nombre y Apellidos</label>
								<div class="col-sm-5"><input type="text"  name="nombre" placeholder="Nombre y Apellidos" class="form-control" value="<?php echo salida_nombre($datos[0]['nombre']); ?>" required></div>
							</div>							
							<div class="form-group"><label class="col-sm-5 control-label">DNI / CIF</label>
								<div class="col-sm-5"><input type="text" name="dni" placeholder="DNI / CIF" class="form-control" value="<?php echo $datos[0]['dni']; ?>" required></div>
							</div>							
							<div class="form-group"><label class="col-sm-5 control-label" disabled>E-mail</label>
								<div class="col-sm-5">
									<div class="input-group m-b"><span class="input-group-addon">@</span> <input type="email" name="email" placeholder="E-mail" class="form-control" value="<?php echo $datos[0]['email']; ?>" required disabled></div>
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group"><label class="col-sm-5 control-label">Tipo de usuario</label>
								<div class="col-sm-5">									
									<select class="input-sm form-control input-s-sm inline" style="padding-top:0px;" name="role">										
										<?php $grupo_de_roles = grupo_de_roles(); ?>																			
										<?php for ($i = 0; $i <= count($grupo_de_roles); $i++) {?>	
											<?php if(!empty($grupo_de_roles[$i]['role']) || $grupo_de_roles[$i]['role'] != '' ) { ?>
												<?php if ($datos[0]['role'] == $grupo_de_roles[$i]['role']) { ?>
													<option value="<?php echo $grupo_de_roles[$i]['role']; ?>" selected><?php echo $grupo_de_roles[$i]['role']; ?></option>
												<?php } else { ?>	
													<option value="<?php echo $grupo_de_roles[$i]['role']; ?>"><?php echo $grupo_de_roles[$i]['role']; ?></option>
												<?php } ?>	
											<?php } ?>		
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group"><label class="col-sm-5 control-label">Fecha de alta</label>
								<div class="col-sm-5">									                         
									<div class="input-group date" id="data_1">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="fecha_inicio" class="form-control" value="<?php echo $datos[0]['fecha_inicio']; ?>" required>
									</div>									
								</div>
							</div>							
							<div class="form-group"><label class="col-sm-5 control-label">Fecha de suscripción</label>
								<div class="col-sm-5">
									<div class="input-group date" id="data_2">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text"  name="fecha_fin" class="form-control"  value="<?php echo $datos[0]['fecha_fin']; ?>" required>
									</div>
								</div>
							</div>
							<div class="hr-line-dashed"></div>														
							<div class="form-group"><label class="col-sm-5 control-label">Dirección</label>
								<div class="col-sm-5"><input type="text" name="direccion" class="form-control" value="<?php echo salida_nombre($datos[0]['direccion']); ?>" required></div>
							</div>
							<div class="form-group"><label class="col-sm-5 control-label">Población</label>
								<div class="col-sm-5"><input type="text" name="poblacion" class="form-control" value="<?php echo salida_nombre($datos[0]['poblacion']); ?>" required></div>
							</div>
							<div class="form-group"><label class="col-sm-5 control-label">Provincia</label>
								<div class="col-sm-5">
									<select class="input-sm form-control input-s-sm inline" style="padding-top:0px;" name="provincia">
									<?php foreach ($spain_provincias as & $nombre_provincia) { ?>
										<?php if ($datos[0]['provincia'] == $nombre_provincia) { ?>
											<option value="<?php echo $nombre_provincia; ?>" selected><?php echo $nombre_provincia; ?></option>
										<?php } else { ?>
											<option value="<?php echo salida_nombre($nombre_provincia); ?>"><?php echo salida_nombre($nombre_provincia); ?></option>
										<?php } ?>
									<?php } ?>
									</select>
								</div>
							</div>							
							<div class="hr-line-dashed"></div>
							<div class="form-group"><label class="col-sm-5 control-label">Colegio</label>
								<div class="col-sm-5"><input type="text" name="colegio" class="form-control" value="<?php echo salida_nombre($datos[0]['colegio']); ?>"></div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group"><label class="col-sm-5 control-label">N° colegiado</label>
								<div class="col-sm-5"><input type="text" name="numero_colegiado" class="form-control" value="<?php echo salida_nombre($datos[0]['numero_colegiado']); ?>"></div>
							</div>				
						</div>            	
						<div class="col-lg-6">							
							<div class="form-group"><label class="col-sm-3 control-label">Estado</label>								
								<div class="col-sm-9">
									<?php if ($datos[0]['activo']== "Activo" || $datos[0]['activo'] == 1) { ?>
										<input type="checkbox" name="activo" class="js-switch" checked />
									<?php } else { ?>
										<input type="checkbox" name="activo" class="js-switch"  />
									<?php } ?>
								</div>
							</div>
							<div class="form-group"><label class="col-sm-3 control-label">Confirmar</label>								
								<div class="col-sm-9">									
									<input type="checkbox" name="confirmar" class="js-switch_2"  />
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group"><label class="col-sm-3 control-label">Forma de pago</label>
								<div class="col-sm-9">
									<select class="input-sm form-control input-s-sm inline" style="padding-top:0px;" name="forma_pago" id="forma_pago">
										<?php if ($datos[0]['forma_pago'] == "Domiciliación bancaria") { ?>
											<option value="Domiciliación bancaria" selected>Domiciliación bancaria</option>
											<option value="PayPal">PayPal</option>
										<?php }else{ ?>
											<option value="Domiciliación bancaria">Domiciliación bancaria</option>
											<option value="PayPal" selected>PayPal</option>
										<?php } ?>
									</select>
								</div>
							</div>
							<?php if ($datos[0]['forma_pago'] == "PayPal") { ?>
							<div class="form-group" id="iban_grupo" style="display: none;">
								<label class="col-sm-3 control-label">IBAN</label>								
								<div class="col-sm-9"><input type="text" name="iban" id="iban" class="form-control" value="<?php echo $datos[0]['iban']; ?>"></div>
							</div>	
							<?php }else{ ?>
							<div class="form-group" id="iban_grupo">
								<label class="col-sm-3 control-label">IBAN</label>								
								<div class="col-sm-9"><input type="text" name="iban" id="iban" class="form-control" value="<?php echo $datos[0]['iban']; ?>" required></div>
							</div>	
							<?php } ?>	
							<div class="form-group"><label class="col-sm-3 control-label">Observaciones</label>
								<div class="col-sm-9"><textarea name="observaciones" class="form-control" rows="4" placeholder="Observaciones"><?php echo html_entity_decode(salida_nombre($datos[0]['observaciones'])); ?></textarea></div>
							</div>
							<div class="form-group text-center">
								<button type="submit" class="btn btn-w-m btn-primary">Guardar</button>
							</div>			
						</div>
					</form>
					<!-- formulario nuevo usuario -->
					</div>
					</div>
				</div>
			</div>
		</div>
        </div>
			<div class="footer">
                    <?php include_once 'parts/footer.php'; ?>
			</div>
			<?php include_once 'parts/menu_derecho.php'; ?>
        </div>        
    </div>
	<?php include 'parts/jquery_footer.php'; ?>	
	<!-- Data picker -->
	<script src="<?php echo $url_app; ?>js/plugins/datapicker/bootstrap-datepicker.js"></script>
	<script src="<?php echo $url_app; ?>js/plugins/datapicker/bootstrap-datepicker-es.js"></script>
	
	<!-- Switchery -->
	<script src="<?php echo $url_app; ?>js/plugins/switchery/switchery.js"></script> 
	<script>
	$(document).ready(function(){	
		//Calendario 1
		$('#data_1').datepicker({
			todayBtn: "linked",
			keyboardNavigation: false,
			forceParse: false,
			calendarWeeks: true,
			autoclose: true,
			changeMonth: true,
			changeYear: true,
			yearRange: "+0:+10",
			language: 'es'
		});
		
		//Calendario 2
		$('#data_2').datepicker({
			todayBtn: "linked",
			keyboardNavigation: false,
			forceParse: false,
			calendarWeeks: true,
			autoclose: true,
			changeMonth: true,
			changeYear: true,
			yearRange: "+0:+10",
			language: 'es'
		});
		
		//Check
		var elem = document.querySelector('.js-switch');
		var switchery = new Switchery(elem, { color: '#81d742' });
		
		//Check confirmar
		var elem = document.querySelector('.js-switch_2');
		var switchery = new Switchery(elem, { color: '#81d742' });
		
		//Domiciliaicon bancaria
		$("#forma_pago").change(function(){
		  var cur_value = $('option:selected',this).text();			
				if(cur_value == 'PayPal'){
					//quitamos el input de iban
					$('#iban_grupo').css("display", "none");
					$('#iban').css("display", "none");
					$('#iban').prop('required', false);
				}else{
					//en caso contrario mostramos el input con los valores estandar
					$('#iban_grupo').css("display", "block");
					$('#iban').css("display", "block");
					$('#iban').prop('required', true);
				}
		});
	});
    </script>		
	<?php $conn->close(); ?>
</body>
</html>
