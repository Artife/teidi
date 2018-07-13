<?php
session_start();
include 'parts/conex.php';

$pagina = 'Nuevo usuario';
$migas = array('');
$migas_url = array('');

//Solo permitir acceso a estos roles
$acceso_roles = array('admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';

?>
	<?php echo header_documento(); ?>
	<?php include 'parts/header.php'; ?>
	<link href="<?php echo $url_app; ?>css/plugins/datapicker/datepicker3.css" rel="stylesheet">	
	<!-- Check -->
	<link href="<?php echo $url_app; ?>css/plugins/switchery/switchery.css" rel="stylesheet">
	<style>
	#dni_mensaje{
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
        <div class="row">
            <div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						Introduzca los datos del nuevo usuario                            
					</div>
					<div class="ibox-content">
					<!-- formulario nuevo usuario -->
					<div class="row">
						<div class="col-md-12">								
							<div class="form-group">
								<p id="dni_mensaje"><strong>¿El DNI no es correcto seguro que desea continuar?</strong></p>
							</div>
						</div>
					</div>	
					<div class="row">							
					<form method="post" class="form-horizontal" action="<?php echo vinculo('crear-nuevo-usuario'); ?>">						
						<div class="col-lg-6">
							<div class="form-group"><label class="col-sm-5 control-label">Nombre y Apellidos</label>
								<div class="col-sm-5"><input type="text"  name="nombre" placeholder="Nombre y Apellidos" class="form-control" required></div>
							</div>							
							<div class="form-group"><label class="col-sm-5 control-label">DNI / CIF</label>
								<div class="col-sm-5"><input type="text" id="dni" name="dni" placeholder="DNI / CIF" class="form-control" required></div>
							</div>							
							<div class="form-group"><label class="col-sm-5 control-label">E-mail</label>
								<div class="col-sm-5">
									<div class="input-group m-b"><span class="input-group-addon">@</span> <input type="email" name="email" placeholder="E-mail" class="form-control" required></div>
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group"><label class="col-sm-5 control-label">Tipo de usuario</label>
								<div class="col-sm-5">
									<select class="input-sm form-control input-s-sm inline" style="padding-top:0px;" name="role">										
										<?php $grupo_de_roles = grupo_de_roles(); ?>																			
										<?php for ($i = 0; $i <= count($grupo_de_roles); $i++) {?>	
											<?php if(!empty($grupo_de_roles[$i]['role']) || $grupo_de_roles[$i]['role'] != '' ) { ?>											
												<option value="<?php echo $grupo_de_roles[$i]['role']; ?>"><?php echo $grupo_de_roles[$i]['role']; ?></option>
											<?php } ?>		
										<?php } ?>
									</select>
								</div>
							</div>							
							<div class="form-group"><label class="col-sm-5 control-label">Fecha de alta</label>
								<div class="col-sm-5">									                         
									<div class="input-group date" id="data_1">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="fecha_inicio" class="form-control" value="<?php echo date('d/m/Y')?>" required>
									</div>									
								</div>
							</div>							
							<div class="form-group"><label class="col-sm-5 control-label">Fecha fin suscripción</label>
								<div class="col-sm-5">
									<div class="input-group date" id="data_2">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text"  name="fecha_fin" class="form-control"  value="<?php echo date('d/m/Y')?>" required>
									</div>
								</div>
							</div>
							<div class="hr-line-dashed"></div>														
							<div class="form-group"><label class="col-sm-5 control-label">Dirección</label>
								<div class="col-sm-5"><input type="text" name="direccion" class="form-control" required></div>
							</div>
							<div class="form-group"><label class="col-sm-5 control-label">Población</label>
								<div class="col-sm-5"><input type="text" name="poblacion" class="form-control" required></div>
							</div>
							<div class="form-group"><label class="col-sm-5 control-label">Provincia</label>
								<div class="col-sm-5">
									<select class="input-sm form-control input-s-sm inline" style="padding-top:0px;" name="provincia">
									<?php foreach ($spain_provincias as & $nombre_provincia) { ?>
										<option value="<?php echo $nombre_provincia; ?>"><?php echo $nombre_provincia; ?></option>
									<?php } ?>
									</select>
								</div>
							</div>							
							<div class="hr-line-dashed"></div>
							<div class="form-group"><label class="col-sm-5 control-label">Colegio</label>
								<div class="col-sm-5"><input type="text" name="colegio" class="form-control"></div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group"><label class="col-sm-5 control-label">N° colegiado</label>
								<div class="col-sm-5"><input type="text" name="numero_colegiado" class="form-control"></div>
							</div>				
						</div>            	
						<div class="col-lg-6">							
							<div class="form-group"><label class="col-sm-3 control-label">Estado</label>
								<div class="col-sm-9">
									<input type="checkbox" name="activo" class="js-switch"  />
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group"><label class="col-sm-3 control-label">Forma de pago</label>
								<div class="col-sm-9">
									<select class="input-sm form-control input-s-sm inline" style="padding-top:0px;" name="forma_pago" id="forma_pago">
										<option value="Domiciliación bancaria">Domiciliación bancaria</option>
										<option value="PayPal">PayPal</option>
									</select>
								</div>
							</div>
							<div class="form-group" id="iban_grupo"><label class="col-sm-3 control-label">IBAN</label>
								<div class="col-sm-9"><input type="text" name="iban" id="iban" class="form-control" required></div>
							</div>	
							<div class="form-group"><label class="col-sm-3 control-label">Observaciones</label>
								<div class="col-sm-9"><textarea name="observaciones" class="form-control" rows="4" placeholder="Observaciones"></textarea></div>
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
	});
    </script>		
	<?php $conn->close(); ?>
</body>
</html>
