<?php
session_start();
include 'parts/conex.php';

$pagina = 'Lista de Recetas Desactivadas';
$migas = array('');
$migas_url = array('');

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';


?>
	<?php echo header_documento(); ?>
	<?php include 'parts/header.php'; ?>
	<link href="<?php echo $url_app; ?>css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
	<link href="<?php echo $url_app; ?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">
	<style>
	.table-responsive {
		overflow-x: hidden;
	}
	#vinculo_reactivar_recetas, #vinculo_eliminar_recetas {
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
		<div class="wrapper wrapper-content animated fadeInRight">	
		<!-- Buscador -->
		<div class="row">
            <div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-content">
						<div class="row">	
						<form action="<?php echo $url_app; ?>lista-alimentos" method="post">
							<div class="col-sm-2"><h5>Filtrar ingesta: </h5>																		
								<select id="filtro_ingesta" class="input-sm form-control input-s-sm inline" style="padding-top:0px;" name="grupo">						
									<option selected>Todos</option>
									<option>Desayuno</option>
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
								<h5>Origen: </h5>
								<select id="filtro_origen" class="input-sm form-control input-s-sm inline" style="padding-top:0px;" name="grupo">
									<option>Todos</option>
									<option>i-Diet</option>
									<option>Nuevo</option>
									<option>Editado</option>
									<option>Duplicado</option>
								</select>
							</div>							
							<div class="col-sm-2"></div>
						</form> 
						</div>
					</div>
				</div>
			</div>
		</div>	
		<!-- Fin buscador -->
        <div class="row">
		<form id="listado_de_recetas_desactivadas" action="#" method="post">																							
            <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <div class="ibox-tools">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">
									<i class="fa fa-wrench"></i> Opciones de la <?php echo $pagina; ?>  
								</a>
								<ul class="dropdown-menu dropdown-user">
									<li><a id="vinculo_reactivar_recetas" href="#"> <i class="fa fa-low-vision text-navy"></i> Reactivar Recetas</a></li>
									<li><a id="vinculo_eliminar_recetas" href="#"> <i class="fa fa-low-vision text-navy"></i> Eliminar Recetas</a></li>
								</ul>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
							<form id="tabla_larga" action="<?php echo $url_app; ?>desactivar-alimentos" method="post">																							
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
									</tbody>
									<tbody>
								</table>								
							</form> 	
                            </div>
						</div>
					</div>
			</div>
		</form>	
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
	<script>
		//Llamamos los datos de la tabla en segundo plano para que carge mucho mas rapido
        $(document).ready(function(){
			$('#mensajes_footer').modal('show');
			
			var table_buscar = $('#example').DataTable({ 
				responsive: true,
				processing: true,
				erverSide: true,								
				ajax: "<?php echo $url_app; ?>crear-archivo-txt-recetas-desactivadas.php",
				deferRender:    true,
				scrollCollapse: true,
				scroller:       false,
				serialize:		true,
				order: [[ 1, 'asc' ]],	
				<?php if (isset($tabla_lista) && $idiet_status_tabla == 1) {?>
				iDisplayLength:	<?php echo $tabla_lista; ?>,
				<?php }else{ ?>
				iDisplayLength:	3000,
				paging: 		false,
				<?php } ?>			
				
			});
			
			//Filtrar por carga al inicio
			$(function () {
				var cur_value = $('option:selected',this).text();				
					cur_value = '';				
					table_buscar
						.columns(7)
						.search(cur_value)
						.draw();
			});
			
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
        });		
		
		//Indice de edicion
		$('#example').on( 'click', 'tr', function () {		  
		    var indice_id = ($(this).attr('id'));	
			$.cookie('indice', indice_id);	
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
		
		//Contador de seleccionados
		$('#example').on( 'click', 'tr', function () {
			var total_marcados = $('.marcar').filter(':checked').length
			if(total_marcados == 0){
				$('#vinculo_reactivar_recetas').css('display', 'none');
				$('#vinculo_eliminar_recetas').css('display', 'none');
			}
			if(total_marcados >= 1){
				$('#vinculo_reactivar_recetas').css('display', 'block');
				$('#vinculo_eliminar_recetas').css('display', 'block');
			}
		});
		
		//Desactivar recetas
		$("#vinculo_reactivar_recetas").on("click", function () {
            $('#listado_de_recetas_desactivadas').attr('action', "<?php echo $url_app; ?>reactivar-recetas");			
			$("#listado_de_recetas_desactivadas" ).submit();
        });
		
		//Duplicar recetas
		$("#vinculo_eliminar_recetas").on("click", function () {
            $('#listado_de_recetas_desactivadas').attr('action', "<?php echo $url_app; ?>eliminar-recetas");			
			$("#listado_de_recetas_desactivadas" ).submit();
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
			
    </script>	
	<?php $conn->close(); ?>
</body>
</html>
