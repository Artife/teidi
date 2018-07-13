<?php
session_start();
include 'parts/conex.php';
$pagina = 'Editar plantilla';
$migas = array('Lista Clientes');
$migas_url = array('lista-clientes');

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';


if(!empty($_GET['id'])){
	$plantilla = gx_obtener_plantilla($_GET['id']);		
}else{
	//si no tiene variable get redireccionar
	$_SESSION['mensaje'] = 'datos_vacios';
	header('location:'.$url_app.'lista-reglas');
}

?>
	<?php echo header_documento(); ?>
	<?php include 'parts/header.php'; ?>	
	<link href="<?php echo $url_app; ?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">
	<style>
	.table-responsive {
		overflow-x: hidden;
	}
	#example_filter, example_length{
		display:none;
	}
	.gramos_title {
		text-align: center;
		width: 50px;
		right: 10px;
		float: right;		
	}
	.gramos {
		text-align: right;			
		right: 0px;
		float: right;
		padding-right: 21px;	
	}
	.detalle_comida{
		float: left;
		left: 0px;
	}
	.ibox-tools {		
		float: right;
		right: 36px;
		position: absolute;
		font-size: 24px;
		top: 9px;
	}
	.ibox-tools a {
		color: #81d742;
		padding-right: 21px;
	}
	.ibox-tools a:hover {
		color: #6eb33c;
	}
	tfoot tr th{
		text-align: right;
		padding-right: 30px !important;
	}	
	.btn-info.btn-outline {
		background: #772e71;
		color: white;
		min-width: 250px;
		border-color: transparent;		
		font-weight: 600;
	}
	.input_peso{
		min-width: 250px;
	}
	td+td{
		cursor:pointer;
	}
	td+td:hover {
		background-color: #81d74266;	
	}

	#vinculo_actualizar_dieta, #vinculo_enviar_correo, #div_pegar, #div_modificar_peso_input{
		display:none;
	}
	.btn-info.btn-outline:focus {
	    background-color: #a2439b;
		border-color: #a2439b;
	}
	.btn-info {
		margin-top:10px;
	}
	.block_td {
		background-color: #772e714a;		
	}
	#vinculo_guardar_dieta, #vinculo_guardar_plantilla_dieta, #vinculo_enviar_correo{ 
		text-decoration: none;
		cursor: default;
		opacity: 0.5;
	}
	#modal_ver_plato .modal-lg{
		min-width: 1200px;
	}
	.ok{
		color: #80d741;
	}
	#mensaje_guardar_plantilla{
	    color: red;
		font-weight: 600;
		padding-top: 25px;
	}
	</style>
</head>
<?php

// Semana <a href="#contenedor_slider" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>1 de 3 <a href="#contenedor_slider" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
?>
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
			<?php echo migas_de_pan($pagina.' '.date('d/m/Y'), $migas, $migas_url, ''); ?>                
            </div>
		<div class="wrapper wrapper-content">	
		<!-- Buscador -->
		<div id="respuesta">		
		</div>
		<form id="formulario_completo" action="<?php echo $url_app; ?>dieta/" method="post">						
		<div class="row"> 				
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5><strong>Plantilla: </strong> <?php  echo $plantilla['nombre']; ?> </h5>	
						<div class="ibox-tools">
							<a id="vinculo_actualizar_dieta" href="#" title="Generar nueva dieta">
								<i class="fa fa-refresh" aria-hidden="true"></i>
                            </a>
                            <a id="vinculo_guardar_dieta" href="#" title="Guardar dieta">
								<i class="fa fa-floppy-o" aria-hidden="true"></i>
                            </a>
                            <a id="vinculo_guardar_plantilla_dieta" href="#" title="Guardar plantilla">
								<i class="fa fa-address-card-o" aria-hidden="true"></i>
                            </a>
                            <a id="vinculo_imprimir_dieta" href="#" title="Imprimir dieta">
								<i class="fa fa-print" aria-hidden="true"></i>
                            </a>
                            <a  id="vinculo_enviar_correo" href="#" title="Enviar dieta por correo">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                            </a>
                        </div>
					</div>					
					<div id="contenedor_slider" class="carousel slide" data-ride="carousel" data-type="multi" data-interval="false">
					<?php echo html_entity_decode($plantilla['dieta_plantilla']); ?>
					</div>					
					<!-- fin contenedor del slider -->
				</div>
			</div>
		</div>
		<input type="hidden" value="" name="td_columna" />	
		<input type="hidden" value="" name="td_fila" />	
		<input type="hidden" value="" name="td_actual" />	
		</form>	

		<!-- Fin buscador --> 
		<!-- Modal Opciones Comida -->
		<div id="listado_opciones" class="modal fade charts-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		  <div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel">Opciones:</h4>
				</div>
				<div class="text-center">
					<div class="row" id="div_copiar"> 				
						<div class="col-lg-12">
							<button type="button" id="btn_copiar" class="btn btn-outline btn-info">Copiar</button>
						</div>
					</div>
					<div class="row" id="div_pegar"> 				
						<div class="col-lg-12 text-center">
							<button type="button" id="btn_pegar" class="btn btn-outline btn-info">Pegar</button>
						</div>
					</div>
					<div class="row" id="div_aplicar_toda_dieta"> 				
						<div class="col-lg-12">
							<button type="button" id="btn_aplicar_toda_dieta" class="btn btn-outline btn-info">Aplicar a toda la dieta</button>
						</div>
					</div>
					<div class="row" id="div_bloquear_desbloquear"> 				
						<div class="col-lg-12">
							<button type="button" id="btn_bloquear_desbloquear" class="btn btn-outline btn-info">Bloquear/Desbloquear</button>
						</div>
					</div>
					<div class="row" id="div_ver_informacion"> 				
						<div class="col-lg-12">
							<button type="button" id="btn_ver_informacion" class="btn btn-outline btn-info">Ver información del plato</button>
						</div>
					</div>
					<div class="row" id="div_buscar_plato_equi"> 				
						<div class="col-lg-12">
							<button type="button" id="btn_buscar_plato_equi" class="btn btn-outline btn-info">Buscar plato equivalente</button>
						</div>
					</div>
					<div class="row" id="div_marcar_libre"> 				
						<div class="col-lg-12">
							<button type="button" id="btn_marcar_libre" class="btn btn-outline btn-info">Marcar como libre</button>
						</div>
					</div>
					<div class="row" id="div_modificar_peso"> 				
						<div class="col-lg-12">
							<button type="button" id="btn_modificar_peso" class="btn btn-outline btn-info">Modificar peso de comida</button>
						</div>
					</div>	
					<div class="row" id="div_modificar_peso_input"> 				
						<div class="col-lg-12">
							<br/>
							<p>Modificar el peso de esta comida desajustará la ingesta calórica para ese día ¿Desea continuar?</p>							
							<input type="number" class="input_peso" placeholder="Nuevo peso gr"><br />
							<button type="button">Agregar</button>	<button type="button">Cancelar</button>
							<br/><br/><br/>
						</div>
					</div>	
				</div>
				<div id="area-example"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				</div>    
			</div>
		  </div>
		</div>
		<!-- Fin Modal Opciones Comida -->	
		<!-- Modal guardar Temporal -->
		<div id="modal_guardar_temporal" class="modal fade charts-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		  <div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel">Guardar Dieta</h4>
				</div>
				<div class="text-center">
					<div class="row" id="div_copiar"> 				
						<div class="col-lg-12">	
							<br /><br />
							<form id="formulario_guardar_dieta" action="#" method="post">						
							<a id="guardar_dieta_temporal" class="btn btn-outline btn-info">Guardar</a>
							<?php if(empty($_POST["usar_plantilla"])){ ?>
							<input type="hidden" id="temporal_plantilla" name="temporal_plantilla" value="no">
							<input type="hidden" id="temporal_id_cliente" name="temporal_id_cliente" value="<?php echo $cliente_id; ?>">
							<input type="hidden" id="temporal_duracion" name="temporal_duracion" value="<?php echo $duracion; ?>">
							<input type="hidden" id="temporal_num_comidas" name="temporal_num_comidas" value="<?php echo $num_comidas; ?>">
							<input type="hidden" id="temporal_platos_comidas" name="temporal_platos_comidas" value="<?php echo $platos_comidas; ?>">
							<input type="hidden" id="temporal_comida_postre" name="temporal_comida_postre" value="<?php echo $comida_postre; ?>">
							<input type="hidden" id="temporal_plato_cena" name="temporal_plato_cena" value="<?php echo $plato_cena; ?>">
							<input type="hidden" id="temporal_cena_postre" name="temporal_cena_postre" value="<?php echo $cena_postre; ?>">
							<input type="hidden" id="temporal_fecha_inicio" name="temporal_fecha_inicio" value="<?php echo $fecha_inicio; ?>">
							<input type="hidden" id="temporal_kilocalorias_dia" name="temporal_kilocalorias_dia" value="<?php echo $kilocalorias_dia; ?>">
							<input type="hidden" id="temporal_grasas_diarias" name="temporal_grasas_diarias" value="<?php echo $grasas_diarias; ?>">
							<input type="hidden" id="temporal_proteinas_diarias" name="temporal_proteinas_diarias" value="<?php echo $proteinas_diarias; ?>">
							<input type="hidden" id="temporal_hidratos_diarios" name="temporal_hidratos_diarios" value="<?php echo $hidratos_diarios; ?>">
							<input type="hidden" id="temporal_limitar_tamano" name="temporal_limitar_tamano" value="<?php echo $limitar_tamano; ?>">
							<input type="hidden" id="temporal_listado_plantillas" name="temporal_listado_plantillas" value="<?php echo $listado_plantillas; ?>">
							<input type="hidden" id="temporal_dieta_plantilla" name="temporal_dieta_plantilla" value="">						
							<?php } ?>
							</form> 
							<br /><br />
						</div>
					</div>						
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				</div>    
			</div>
		  </div>
		</div>
		<!-- Fin Modal Guardar Temporal -->	
		<!-- Modal guardar plantilla -->
		<div id="modal_guardar_plantilla" class="modal fade charts-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		  <div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel">Guardar Plantilla Dieta</h4>
				</div>
				<div class="text-center">
					<div class="row" id="div_copiar"> 				
						<div class="col-lg-12">	
							<br /><br />
							<form id="formulario_guardar_plantilla_dieta" action="#" method="post">	
							<div class="row">	
								<div class="col-lg-4"></div>	
								<div class="col-lg-4"><input type="text" class="input-sm form-control" id="p_nombre" name="p_nombre" value="" placeholder="Nombre de la plantilla" required>	
								<div id="mensaje_guardar_plantilla"></div>
								<br><br><br></div>
								<div class="col-lg-4"></div>	
							</div>	
							<a id="guardar_plantilla_dieta_temporal" class="btn btn-outline btn-info">Guardar</a>
							<?php if(empty($_POST["usar_plantilla"])){ ?>
							<input type="hidden" id="p_temporal_plantilla" name="p_temporal_plantilla" value="no">
							<input type="hidden" id="p_temporal_id_cliente" name="p_temporal_id_cliente" value="<?php echo $cliente_id; ?>">
							<input type="hidden" id="p_temporal_duracion" name="p_temporal_duracion" value="<?php echo $duracion; ?>">
							<input type="hidden" id="p_temporal_num_comidas" name="p_temporal_num_comidas" value="<?php echo $num_comidas; ?>">
							<input type="hidden" id="p_temporal_platos_comidas" name="p_temporal_platos_comidas" value="<?php echo $platos_comidas; ?>">
							<input type="hidden" id="p_temporal_comida_postre" name="p_temporal_comida_postre" value="<?php echo $comida_postre; ?>">
							<input type="hidden" id="p_temporal_plato_cena" name="p_temporal_plato_cena" value="<?php echo $plato_cena; ?>">
							<input type="hidden" id="p_temporal_cena_postre" name="p_temporal_cena_postre" value="<?php echo $cena_postre; ?>">
							<input type="hidden" id="p_temporal_fecha_inicio" name="p_temporal_fecha_inicio" value="<?php echo $fecha_inicio; ?>">
							<input type="hidden" id="p_temporal_kilocalorias_dia" name="p_temporal_kilocalorias_dia" value="<?php echo $kilocalorias_dia; ?>">
							<input type="hidden" id="p_temporal_grasas_diarias" name="p_temporal_grasas_diarias" value="<?php echo $grasas_diarias; ?>">
							<input type="hidden" id="p_temporal_proteinas_diarias" name="p_temporal_proteinas_diarias" value="<?php echo $proteinas_diarias; ?>">
							<input type="hidden" id="p_temporal_hidratos_diarios" name="p_temporal_hidratos_diarios" value="<?php echo $hidratos_diarios; ?>">
							<input type="hidden" id="p_temporal_limitar_tamano" name="p_temporal_limitar_tamano" value="<?php echo $limitar_tamano; ?>">
							<input type="hidden" id="p_temporal_listado_plantillas" name="p_temporal_listado_plantillas" value="<?php echo $listado_plantillas; ?>">
							<input type="hidden" id="p_temporal_dieta_plantilla" name="p_temporal_dieta_plantilla" value="">						
							<?php } ?>
							</form> 
							<br /><br />
						</div>
					</div>						
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				</div>    
			</div>
		  </div>
		</div>
		<!-- Fin Modal Guardar plantilla -->
		<!-- Modal ver iniformacion plato -->
		<div id="modal_ver_plato" class="modal fade charts-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		  <div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel">Ver información del plato</h4>
				</div>
				<div class="text-center">
					<div class="row" id="mostrar_receta_vista"> 										
					</div>						
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				</div>    
			</div>
		  </div>
		</div>
		<!-- Fin Modal ver iniformacion plato -->			
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
	<script src="<?php echo $url_app; ?>js/plugins/dataTables/datatables.min.js"></script>			
	<script>
		$(document).ready(function(){
			var comida_libre = '<p class="detalle_comida">Plato libre</p><p class="gramos">0g</p>';
			var myCol = '';
			var $tr = '';
			var myRow = '';
			var contenido = '';
			var contenido_copiado = '';
			var numero_filas = $("#example tr").length;
			var numero_columnas = $("#example tr:last td").length;
			var ver_receta = '';
			// console.log("x");
			// console.log(numero_filas);
			// console.log(numero_columnas);
			 
			//Asignamos la columna y la fila a los TD
			$('td').click(function() {
				myCol = $(this).index()+1;				
				$tr = $(this).closest('tr');
				myRow = $tr.index()+1;
				ver_receta = $('.ibox-content.item.active #example tbody tr:nth-child('+myRow+')  td:nth-child('+myCol+') p.detalle_comida').attr('class').split(' ')[1];										
				contenido = $('#example tbody tr:nth-child('+myRow+') td:nth-child('+myCol+')').html();
				// console.log(myCol);
				// console.log(myRow);
				// console.log(contenido);				
				if($('.ibox-content.item.active .dataTables-example tbody tr:nth-child('+myRow+') td:nth-child('+myCol+')').hasClass('block_td')) {					
					//Si esta bloqueado
					$('#btn_copiar').prop('disabled', true); 
					$('#btn_pegar').prop('disabled', true);  
					$('#btn_buscar_plato_equi').prop('disabled', true); 
					$('#btn_marcar_libre').prop('disabled', true); 
					$('#btn_modificar_peso').prop('disabled', true); 
				}else{
					//Si esta libre				
					$('#btn_copiar').prop('disabled', false);  
					$('#btn_pegar').prop('disabled', false); 
					$('#btn_buscar_plato_equi').prop('disabled', false); 
					$('#btn_marcar_libre').prop('disabled', false); 
					$('#btn_modificar_peso').prop('disabled', false);  
				}		
			});
			
			
			//Botones acciones
			//->Copiar
			$('#btn_copiar').click(function() {				
				$('#listado_opciones').modal('toggle'); 
				$('#div_pegar').css('display', 'block'); 
				contenido_copiado = contenido;
			});
			//->Pegar
			$('#btn_pegar').click(function() {
				var clase_table = $('.ibox-content.item.active .dataTables-example', '').attr('class').split(' ')[3];							
				$('#listado_opciones').modal('toggle'); 
				$('#div_pegar').css('display', 'none'); 
				$('.'+clase_table+' tbody tr:nth-child('+myRow+') td:nth-child('+myCol+')').html(contenido_copiado);					
				contenido_copiado = '';
				activar_guardar_y_plantilla();
			});		
			//->Bloquear ó Desbloquear
			$('#btn_bloquear_desbloquear').click(function() {				
				$('#listado_opciones').modal('toggle'); 
				var clase_table = $('.ibox-content.item.active .dataTables-example', '').attr('class').split(' ')[3];									
				if($('.'+clase_table+' tbody tr:nth-child('+myRow+') td:nth-child('+myCol+')').hasClass('block_td')) {					
					$('.'+clase_table+' tbody tr:nth-child('+myRow+') td:nth-child('+myCol+')').removeClass("block_td");					
				}else{
					$('.'+clase_table+' tbody tr:nth-child('+myRow+') td:nth-child('+myCol+')').addClass("block_td");					
				}
			});
			//->Ver informacion del plato
			$('#btn_ver_informacion').click(function() {	
				var url_ver_receta = "<?php echo $url_app; ?>parts/ver-receta-vista.php";    			
				$('#listado_opciones').modal('toggle'); 
				$('#modal_ver_plato').modal('toggle');	
				$.ajax({                        
					type: "POST",                 
					url: url_ver_receta,                    
					data:'id_receta='+ver_receta,
					success: function(data){
						$('#mostrar_receta_vista').html(data);    
					}
					
				});			
			});	
			//->Marcar Libre
			$('#btn_marcar_libre').click(function() {	
				var clase_table = $('.ibox-content.item.active .dataTables-example', '').attr('class').split(' ')[3];						
				$('#listado_opciones').modal('toggle'); 
				$('.'+clase_table+' tbody tr:nth-child('+myRow+') td:nth-child('+myCol+')').html(comida_libre);
				activar_guardar_y_plantilla();	
			});					
			//->Aplicar a toda la dieta
			$('#btn_aplicar_toda_dieta').click(function() {					
				$('#listado_opciones').modal('toggle'); 
				$('#example tbody tr:nth-child('+myRow+') td+td:not(.block_td)').html(contenido);		
				activar_guardar_y_plantilla();
			});				
			//->Modificar Peso
			$('#btn_modificar_peso').click(function() {	
				$('#div_modificar_peso_input').css('display', 'block');  
				activar_guardar_y_plantilla();
			});		
			
			//Crear tabla en array
			var contenido_peso;						
			var list = [];
			var listita  = new Array;			
			var i; 
			
			for (t = 0; t < numero_filas ; t++) {				
				for (i = 0; i < numero_columnas+1; i++) {								
					contenido_peso = $("#example tbody tr:nth-child("+t+") td:nth-child("+i+") .gramos").html();
					// console.log(contenido_peso);	
					// console.log("\n");
					if (contenido_peso === undefined || contenido_peso === null) {}else{					
						contenido_peso = contenido_peso.replace('g', '');							
						list.push(contenido_peso);
					} 					
				} 				
				listita[t] = list;
				list = [];				
			}
			var total=0;
			
		
		});
		
		var loading = '<div class="ibox-content"><div class="row"><div class="col-lg-12 text-center"><div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div></div></div>';
		
		//->Botones top
		$('#vinculo_actualizar_dieta').click(function() {
			location.reload();
		});
		
		//->Guardar En Temporal modal
		$('#vinculo_guardar_dieta').click(function() {			
			$('#modal_guardar_temporal').modal('toggle'); 
		    var toda_la_plantilla = $("#contenedor_slider").html();			
			$('#temporal_dieta_plantilla').val(toda_la_plantilla);
		});
		//->Guardar En Temporal
		$('#guardar_dieta_temporal').click(function() {	
			var url_guardar_dieta = "<?php echo $url_app; ?>parts/guadar-dieta.php";    
			$('#vinculo_imprimir_dieta').css('cursor', 'pointer');  	
			$('#vinculo_imprimir_dieta').css('opacity', '1');  	
			$('#vinculo_enviar_correo').css('cursor', 'pointer');  	
			$('#vinculo_enviar_correo').css('opacity', '1');  
			$('#modal_guardar_temporal').modal('toggle');	
			$.ajax({                        
				type: "POST",                 
				url: url_guardar_dieta,                    
				data: $("#formulario_guardar_dieta").serialize(),
				success: function(data){
					$('#respuesta').html(data);    
				}
				
			});
		});
		
		//->Guardar plantilla modal
		$('#vinculo_guardar_plantilla_dieta').click(function() {			
			$("#mensaje_guardar_plantilla").hide();
			$('#modal_guardar_plantilla').modal('toggle'); 
		    var toda_la_plantilla = $("#contenedor_slider").html();			
			$('#p_temporal_dieta_plantilla').val(toda_la_plantilla);
		});
		
		
		//->Guardar Plantilla
		$('#guardar_plantilla_dieta_temporal').click(function() {						
		
			var nombre_plantilla = $("#p_nombre").val().length;
			
			if(nombre_plantilla == 0 || nombre_plantilla == ''){
				$("#mensaje_guardar_plantilla" ).html("El nombre de la plantilla esta vacio");
				$("#mensaje_guardar_plantilla").show();	
			}
			if(nombre_plantilla >= 1 && nombre_plantilla <= 5){
				$("#mensaje_guardar_plantilla" ).html("El nombre de la plantilla es muy corto");
				console.log("x");
				$("#mensaje_guardar_plantilla").show();	
			}
			if(nombre_plantilla >= 6){
			//Si todo esta bien guardamos la plantilla
				var url_guardar_plantilla = "<?php echo $url_app; ?>parts/guadar-plantilla.php";
				$('#respuesta').html(loading);  
				$('#modal_guardar_plantilla').modal('toggle');				
				$.ajax({                        
					type: "POST",                 
					url: url_guardar_plantilla,                    
					data: $("#formulario_guardar_plantilla_dieta").serialize(),				
					success: function(data){
						$('#respuesta').html(data); 
						$("#mensaje_guardar_plantilla").html(data);
												
					}
					
				}); 
				//Luego limpiamos el nombre
				$("#p_nombre").val("");
			}	
			
		});
		
		function activar_guardar_y_plantilla(){
			$('#vinculo_guardar_dieta').css('cursor', 'pointer');  	
			$('#vinculo_guardar_dieta').css('opacity', '1');  
			$('#vinculo_guardar_plantilla_dieta').css('cursor', 'pointer');  	
			$('#vinculo_guardar_plantilla_dieta').css('opacity', '1');  
		}	
	</script>		
	<?php $conn->close(); ?>
</body>
</html> 