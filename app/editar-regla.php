<?php
session_start();
include 'parts/conex.php';
$pagina = 'Editar Regla';
$migas = array('Lista Reglas');
$migas_url = array('lista-reglas');

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';

//Consultar si la regla pertenece al usuario

$id = extraer_numeros($_GET['id']);

if(!empty($id)){
	$datos_regla = gx_obtener_regla_por_id($id);	
	//si la regla no pertenece al usuario	
	if(empty($datos_regla) || $datos_regla == ''){ 
		$_SESSION['mensaje'] = 'datos_vacios';		
		header('location:'.$url_app.'lista-reglas');
	}
}else{
	//si no tiene variable get redireccionar
	$_SESSION['mensaje'] = 'datos_vacios';
	header('location:'.$url_app.'lista-reglas');
}


?>
	<?php echo header_documento(); ?>
	<!-- TouchSpin -->
	<link href="<?php echo $url_app; ?>css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">
	<?php include 'parts/header.php'; ?>	
	<style>
	.table-responsive {
		overflow-x: hidden;
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
		<div class="wrapper wrapper-content animated fadeInRight">	
		<!-- Buscador -->
		<form action="<?php echo $url_app; ?>crear-nueva-regla" method="post">						
		<div class="row">
            <div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-content">
						<h1>Datos obligatorios</h1>						
						<br />
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-3"> Unidades mínimas</div>
									<div class="col-md-3"><input id="min_unidades" type="number" placeholder="Proteínas" class="touchspin2" name="min_unidades" value="<?php echo $datos_regla['min_unidades']; ?>" min="0" max="100"  required></div>
									<div class="col-md-3"> Unidades máximas</div>
									<div class="col-md-3"><input id="max_unidades" type="number" placeholder="Proteínas" class="touchspin2" name="max_unidades" value="<?php echo $datos_regla['max_unidades']; ?>" min="0" max="100"  required></div>
								</div>								
								<br />
								<div class="row">
									<div class="col-md-3"> Grupo de alimentos  </div>
									<div class="col-md-3">
									<select class="input-sm form-control input-s-sm" style="padding-top:0px;" name="supergrupox" disabled>	
									<option><?php echo $datos_regla['supergrupo']; ?></option>	
									<?php echo gx_consultar_supergrupos(''); ?>																			
									</select>
									</div>
									<div class="col-md-3"> Frecuencia:  </div>
									<div class="col-md-3">
										<select class="input-sm form-control input-s-sm" style="padding-top:0px;" name="frecuencia">																					
											<option <?php if($datos_regla['frecuencia'] == 'Diaria') { echo  'selected'; }?> >Diaria</option>
											<option <?php if($datos_regla['frecuencia'] == 'Semanal') { echo  'selected'; }?> >Semanal</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-2">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 text-center"><br /><br />
								<div class="form-group text-center">
									
								</div>
							</div>
						</div>						
						<div class="row">
							<div class="col-md-12">								
								<div class="form-group text-center">
								<a href="<?php echo $url_app; ?>lista-alimentos" class="btn btn-w-m btn-primary">Atras</a>
								<?php if($datos_regla['id_usuario'] == 0){ ?>
								<button id="guardar_alimento" type="submit" class="btn btn-w-m btn-primary">Guardar</button>
								<?php }else{ ?>
								<button id="guardar_alimento" type="submit" class="btn btn-w-m btn-primary">Guardar</button>
								<?php } ?>
								</div>
							</div>
						</div>													 
					</div>					
				</div>
			</div>
			
		</div>
		<input id="supergrupo" type="hidden" name="supergrupo" value="<?php echo $datos_regla['supergrupo']; ?>">
		<input id="id_regla" type="hidden" name="id_regla" value="<?php echo $id; ?>">
		</form>	
		<!-- Fin buscador -->        
		</div>
                <div class="footer">
					<?php if(empty($datos_regla) || $datos_regla == ''){}else{ ?>
                    <?php include_once 'parts/footer.php'; ?>
					<?php } ?>
                </div>
            </div>
			<?php include_once 'parts/menu_derecho.php'; ?>
        </div>
        </div>      
    </div>
	<?php include 'parts/jquery_footer.php'; ?>	
	<!-- TouchSpin -->
    <script src="<?php echo $url_app; ?>js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>
	<script>
		//Llamamos los datos de la tabla en segundo plano para que carge mucho mas rapido
        $(document).ready(function(){
			$('#mensajes_footer').modal('show');
			$(".touchspin1, .touchspin2, .touchspin3").TouchSpin({
				min: 1,
				max: 99999,
				step: 1,
				decimals: 0,
				boostat: 5,
				maxboostedstep: 10,
				postfix: 'Unidad',
				buttondown_class: 'btn btn-white',
				buttonup_class: 'btn btn-white'
			});
			$(".touchspin4").TouchSpin({
				min: 1,  
				max: 99999, 
				step: 1,
				decimals: 0,
				boostat: 5,
				maxboostedstep: 10,
				postfix: 'Unidad'
			});	
        });			
    </script>	
	<?php $conn->close(); ?>
</body>
</html>
