<?php
session_start();
include 'parts/conex.php';

$pagina = 'Lista de Recetas Activas';
$migas = array('');
$migas_url = array('');

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';

//Si hacen una busqueda avanzada
if(!empty($_POST['alimento'])){
	$alimento = $_POST['alimento'];
}else{
	$alimento = '';

}


//Limpiar todas
borrar_todas_las_tablas_temporal();

?>
	<?php echo header_documento(); ?>
	<?php include 'parts/header.php'; ?>
	<link href="<?php echo $url_app; ?>css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
	<link href="<?php echo $url_app; ?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">
	<link href="<?php echo $url_app; ?>css/plugins/chosen/chosen.css" rel="stylesheet">
	<style> 
	.table-responsive {
		overflow-x: hidden;
	}
	a.tooltips {
	  position: relative;
	  display: inline;
	}
	a.tooltips span {
	  position: absolute;
	  width:800px;
	  color: #FFFFFF;
	  background: #000000;
	  height: 30px;
	  line-height: 30px;
		padding-left: 10px;
		text-align: left;
	  visibility: hidden;
	  border-radius: 6px;
	}
	a.tooltips span:after {
	  content: '';
	  position: absolute;
	  top: 100%;
	  left: 55px;
	  margin-left: -8px;
	  width: 0; height: 0;
	  border-top: 8px solid #000000;
	  border-right: 8px solid transparent;
	  border-left: 8px solid transparent;
	}
	a:hover.tooltips span {
	  visibility: visible;
	  opacity: 0.8;
	  bottom: 30px;
	  left: 50%;
	  margin-left: -76px;
	  z-index: 999;
	}	
	.desactivado_en_receta {
		color: #f70000;
	}
	#vinculo_desactivar_recetas, #vinculo_duplicar_recetas{
		display:none;
	}	
	#buscador_avanzado {
		visibility:hidden;
		position: absolute;
		height:0px;
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
		<div class="row">
            <div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-content">
						<div class="row">							
							<div class="col-sm-2"><h5>Filtrar ingesta: </h5>																		
								<select id="filtro_ingesta" class="input-sm form-control input-s-sm inline" style="padding-top:0px;" name="grupo">						
									<option>Todos</option>
									<?php if(empty($_POST['alimento'])){ ?>
									<option selected>Desayuno</option>
									<?php }else{ ?>
									<option>Desayuno</option>
									<?php } ?>
									<option>Media mañana</option>
									<option>1ª plato Comida</option>
									<option>Plato principal comida</option>
									<option>Postre</option>
									<option>Merienda</option>
									<option>1ª plato Cena</option>
									<option>Plato principal cena</option>
									<option>Recena</option>
									<option>Otros</option>
								</select>	
							</div>
							<div class="col-sm-2"><h5>Nombre del plato: </h5> 							
							<input id="nombre_receta" type="text" placeholder="Buscar por nombre..." class="input-sm form-control" name="nombre">																	
							</div>
							<div class="col-sm-2">
								<h5>Filtrar origen: </h5>
								<select id="filtro_origen" class="input-sm form-control input-s-sm inline" style="padding-top:0px;" name="grupo">
									<option>Todos</option>
									<option>i-Diet</option>
									<option>Nuevo</option>
									<option>Editado</option>
									<option>Duplicado</option>
								</select>
							</div>						
							<div class="col-sm-2 m-b-xs">
								<button id="boton_busqueda_avanzada" type="submit" class="btn btn-sm btn-primary" style="margin-top: 28px;"> Busqueda Avanzada!</button> 
							</div>
							<div class="col-sm-2"></div>						
						</div>	
					</div>
				</div>
			</div>
		</div>	
		<!-- Fin buscador -->
		<!-- Buscador Avanzado -->
		<div class="row" id="buscador_avanzado">
		<form action="" method="post">	
            <div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-content">
						<div class="row">														
							<div class="col-sm-3"><h5>Nombre del Alimento: </h5> 														
								<select data-placeholder="Buscar por alimento..." class="chosen-select" style="width:350px;" tabindex="2" name="alimento">
								<option value="">Buscar por alimento...</option>
								<?php echo gx_selecct_alimientos(); ?>
								</select>
							</div>							
							<div class="col-sm-2 m-b-xs">
								<button type="submit" class="btn btn-sm btn-primary" style="margin-top: 28px;"> Buscar!</button> 
							</div>
							<div class="col-sm-2"></div>						
						</div>						
					</div>
				</div>
			</div>
		</form>	
		</div>
		<!-- Fin buscador Avanzado -->
        <div class="row">
            <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <div class="ibox-tools">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">
									<i class="fa fa-wrench"></i> Opciones de la <?php echo $pagina; ?>  
								</a>
								<ul class="dropdown-menu dropdown-user">
									<li id="vinculo_desactivar_recetas"><a href="#"> <i class="fa fa-low-vision text-navy"></i> Desactivar Recetas</a></li>
									<li id="vinculo_duplicar_recetas"><a href="#"> <i class="fa fa-files-o text-navy"></i> Duplicar Recetas</a></li>
								</ul>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
							<form id="listado_de_recetas" action="" method="post"> 
								<table id="example" class="table table-striped dataTables-example select-filter tabla_lista_recetas">
									<thead>
										<tr> 
											<th style="width: 30px;">											
											<div class="checkbox checkbox-success" style="position: absolute;margin-top: -5px; margin-left: -3px;">
												<input id="checkbox1" type="checkbox" class="marcar_todos">
												<label for="checkbox1"></label>
											</div>
											</th>
											<th class="marcar_todos">Nombre</th>											
											<th>Kcal/100g </th>
											<th>%_Hidratos</th>
											<th>% Proteínas</th>
											<th>% Grasas</th>
											<th>Origen</th>
											<th>Ingesta</th>
											<th>Con Error</th>											
										</tr>
									</thead>									
									<tbody>
									</tbody>
								</table>								
							</form> 	
                            </div>
						</div>
					</div> 
			</div>
		</div>
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
	<script src="<?php echo $url_app; ?>js/plugins/chosen/chosen.jquery.js"></script>
	<script>		
		//Llamamos los datos de la tabla en segundo plano para que carge mucho mas rapido
        $(document).ready(function(){
			$('#mensajes_footer').modal('show');
			$('[data-toggle="tooltip"]').tooltip();  
			var table_buscar = $('#example').DataTable({ 
				responsive: true,
				processing: true,
				// stateSave: true,
				erverSide: true,		
				order: [[ 1, 'asc' ]],	
				<?php if(!empty($alimento)){ ?>	
				ajax: "<?php echo $url_app; ?>crear-archivo-txt-recetas.php?alimento=<?php echo $alimento; ?>",
				<?php }else{ ?>	
				ajax: "<?php echo $url_app; ?>crear-archivo-txt-recetas.php",
				<?php } ?>	
				deferRender:    true,
				scrollCollapse: true,
				scroller:       false,
				serialize:		true,
				<?php if (isset($tabla_lista) && $idiet_status_tabla == 1) {?>
				iDisplayLength:	<?php echo $tabla_lista; ?>,
				<?php }else{ ?>
				iDisplayLength:	3000,
				paging: 		false,
				<?php } ?>			
				
			});
			
			//Filtrar por carga al inicio
			<?php if(empty($_POST['alimento'])){ ?>
			$(function () {
				var cur_value = $('option:selected',this).text();				
					cur_value = 'Desayuno';				
					table_buscar
						.columns(7)
						.search(cur_value)
						.draw();
			});
			<?php } ?>
			
			table_buscar.columns( [ 8 ] ).visible( false, false );
			
			//Filtros de la tabla
			$('#nombre_receta').on( 'keyup', function () {				
				table_buscar
					.columns(1)
					.search( this.value )
					.draw();
			});
			$('#filtro_ingesta').on( 'keyup change', function () {
				var cur_value = $('option:selected',this).text();
				if(cur_value == 'Todos'){
					cur_value = '';
				}
					table_buscar
						.columns(7)
						.search(cur_value)
						.draw();
			});
			$('#filtro_origen').on( 'keyup change', function () {
				var cur_value = $('option:selected',this).text();
				if(cur_value == 'Todos'){
					cur_value = '';
				}
					table_buscar
						.columns(6)
						.search(cur_value)
						.draw();
			});
			$('#filtro_incompletas').on( 'keyup change', function () {
				var cur_value = $('option:selected',this).text();
				if(cur_value == 'Todos'){
					cur_value = '';
				}
					table_buscar
						.columns(8)
						.search(cur_value)
						.draw();
			});
			
        });		
		
		//Indice de edicion
		$('#example').on( 'click', 'tr', function () {		  
		    var indice_id = ($(this).attr('id'));	
			$.cookie('indice', indice_id);	
		});
		
		//Contador de seleccionados
		$('#example').on( 'click', 'tr', function () {
			var total_marcados = $('.marcar').filter(':checked').length
			if(total_marcados == 0){
				$('#vinculo_desactivar_recetas').css('display', 'none');
				$('#vinculo_duplicar_recetas').css('display', 'none');
			}
			if(total_marcados >= 1){
				$('#vinculo_desactivar_recetas').css('display', 'block');
				$('#vinculo_duplicar_recetas').css('display', 'block'); 
			}  
			if(total_marcados >= 10){
				$('#vinculo_desactivar_recetas').css('display', 'none');
				$('#vinculo_duplicar_recetas').css('display', 'none');
			}
		});
		
		var busqueda_avanzada = 'ocultar';
		//Contador de seleccionados
		$('#boton_busqueda_avanzada').on("click", function () {
			if(busqueda_avanzada == 'ocultar'){			
				// $('#buscador_avanzado').css('display', 'visible');	
				$('#buscador_avanzado').css('visibility', 'visible');
				$('#buscador_avanzado').css('height', 'auto');	
				$('#buscador_avanzado').css('position', 'static');		
				busqueda_avanzada = 'mostrar';
			}else{			
				// $('#buscador_avanzado').css('display', 'hidden');
				$('#buscador_avanzado').css('visibility', 'hidden');	
				$('#buscador_avanzado').css('height', '0px');	
				$('#buscador_avanzado').css('position', 'absolute');	
				busqueda_avanzada = 'ocultar';
			}
		});
		
		
		//Desactivar recetas
		$("#vinculo_desactivar_recetas").on("click", function () {
            $('#listado_de_recetas').attr('action', "<?php echo $url_app; ?>desactivar-recetas");			
			$("#listado_de_recetas" ).submit();
        });
		
		//Duplicar recetas
		$("#vinculo_duplicar_recetas").on("click", function () {
            $('#listado_de_recetas').attr('action', "<?php echo $url_app; ?>duplicar-recetas");			
			$("#listado_de_recetas" ).submit();
        });
		
		//Si la cookie existe usar scroll
		if (!!$.cookie('indice') && $.cookie('indice') != '') {	
			console.log($.cookie('indice'));
			console.log('existe');
			setTimeout(function(){
				var p = $('#'+$.cookie("indice"));
				var offset = p.offset();
				var positi = (offset.top-200);
				$('#'+$.cookie("indice")).css('background-color', 'rgba(129, 215, 66, 0.23) !important');			
				$('#'+$.cookie("indice")).css('color', '#000000 !important');			
				$('html, body').animate({scrollTop:positi}, 'slow');	
			},500);			
		}
		setTimeout(function() {
			$.cookie('indice', '');	
		},510);
				
		$(".marcar_todos").on("click", function () {
			var marcado = $(this).is(':checked'); 
			
			if(marcado == true){				
				$('.marcar').prop('checked',true);
				$(".marcar").attr('value', '1');					
			}else{				
				$('.marcar').prop('checked',false);
				$(".marcar").attr('value', '0');				
			}
		});
		
		//Flecha para subir				
		$(window).scroll(function(){			
			var windowHeight = $(window).scrollTop();
			var contenido2 = $(".ibox-title").offset();
			contenido2 = contenido2.top;			
				if(windowHeight >= contenido2  ){
					$("#subir-top").css({'visibility':'visible'});				
				}else{
					$("#subir-top").css({'visibility':'hidden'});	
			}
		});		
		 var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:"95%"}
                }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }	
    </script>	
	<?php $conn->close(); ?>
</body>
</html>
