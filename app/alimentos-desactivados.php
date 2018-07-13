<?php
session_start();
include 'parts/conex.php';
ini_set('error_reporting', E_ALL);
$pagina = 'Lista de Alimentos Desactivados';
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
		<div class="row">
            <div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-content">
						<div class="row">	
						<form action="<?php echo vinculo('lista-alimentos'); ?>" method="post">
							<div class="col-sm-4"><h5>Nombre del alimento: </h5>										
								<input id="nombre_alimento" type="text" placeholder="Buscar por nombre..." class="input-sm form-control" name="nombre" value="<?php if(isset($_POST['nombre'])) { echo $_POST['nombre']; } ?>">										
							</div>
							<div class="col-sm-2 m-b-xs"><h5>Filtrar grupo: </h5> 							
							<select id="filtro_grupo" class="input-sm form-control input-s-sm inline" style="padding-top:0px;" name="grupo">
								<?php echo grupo_de_alimentos_options(); ?>	
							</select>							
							</div>
							<div class="col-sm-2 m-b-xs">
								<button type="submit" class="btn btn-sm btn-primary" style="margin-top: 28px;"> Buscar!</button> 
							</div>
							<div class="col-sm-4 m-b-xs">
							</div>
						</form> 
						</div>
					</div>
				</div>
			</div>
		</div>	
		<!-- Fin buscador -->
        <div class="row">
		<form id="mover" action="#" method="post">		
		<input id="accion" name="accion" type="hidden" value="" required>
            <div class="col-lg-12">
                    <div class="ibox float-e-margins"> 
						<div class="ibox-title">
                            <div class="ibox-tools">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">
									<i class="fa fa-wrench"></i> Opciones de la <?php echo $pagina; ?>  
								</a>
								<ul class="dropdown-menu dropdown-user">
									<li><a id="link_reactivar_alimentos" data-toggle="modal" data-target="#desactivar_alimentos_mensaje"> <i class="fa fa-low-vision text-navy"></i> Reactivar Alimentos</a></li>
									<li><a id="link_eliminar_alimentos" data-toggle="modal" data-target="#duplicar_alimentos_mensaje"> <i class="fa fa-files-o text-navy"></i> Eliminar Alimentos</a></li>
								</ul>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
							<form id="tabla_larga" action="<?php echo $url_app; ?>desactivar-alimentos" method="post">																							
								<table id="example" class="table table-striped dataTables-example select-filter">
									<thead>
										<tr> 
											<th style="width: 30px;">											
											<div class="checkbox checkbox-success" style="position: absolute;margin-top: -5px; margin-left: -3px;">
												<input id="checkbox1" type="checkbox" class="marcar_todos">
												<label for="checkbox1"></label>
											</div>
											</th>
											<th class="marcar_todos">Nombre</th>
											<th>Grupo </th>
											<th>Kcal/100g</th>
											<th>% Hidratos</th>
											<th>% Proteínas</th>
											<th>% Grasas</th>
											<th>Origen</th>
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
				ajax: "<?php echo $url_app; ?>crear-archivo-txt-alimentos-desactivados.php",
				deferRender:    true,
				scrollCollapse: true,
				scroller:       false,
				serialize:		true,
				order: [[ 1, 'asc' ]],	
				<?php if (isset($idiet_status_tabla) && $idiet_status_tabla == 1) {?>
				iDisplayLength:	<?php echo $tabla_lista; ?>,
				<?php }else{ ?>
				iDisplayLength:	3000,
				paging: 		false,
				<?php } ?>
				
			});
			//Filtros de la tabla
			$('#nombre_alimento').on( 'keyup', function () {				
				table_buscar
					.columns(1)
					.search( this.value )
					.draw();
			});
			$('#filtro_grupo').on( 'keyup change', function () {
				var cur_value = $('option:selected',this).text();
				if(cur_value == 'Todos'){
					cur_value = '';
				}
					table_buscar
						.columns(2)
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
		
		//Mandar para duplicar o desactivar
		$("#link_reactivar_alimentos").click(function() {
			$('#mover').attr('action', "<?php echo $url_app; ?>reactivar-alimentos/");			
			$("#mover").submit();
		});
		$("#link_eliminar_alimentos").click(function() {
			$('#mover').attr('action', "<?php echo $url_app; ?>eliminar-alimentos/");			
			$("#mover").submit();
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
