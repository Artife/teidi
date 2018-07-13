<?php
session_start();
include 'parts/conex.php';
$pagina = 'Agenda Desactivados';
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
		<div class="row" style="display:none;">
            <div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-content">
						<div class="row">							
							<div class="col-sm-4"><h5>Nombre del alimento: </h5>										
								<input id="nombre_alimento" type="text" placeholder="Buscar por nombre..." class="input-sm form-control" name="nombre" value="<?php if(isset($_POST['nombre'])) { echo $_POST['nombre']; } ?>">										
							</div>
							<div class="col-sm-2 m-b-xs"><h5>Filtrar grupo: </h5> 							
							<select id="filtro_grupo" class="input-sm form-control input-s-sm inline" style="padding-top:0px;" name="grupo">								
							</select>							
							</div>
							<div class="col-sm-2 m-b-xs"><h5>Filtrar origen: </h5> 
								<select id="filtro_origen" class="input-sm form-control input-s-sm inline" style="padding-top:0px;" name="grupo">
									<option>Todos</option>
									<option>i-Diet</option>
									<option>Nuevo</option>									
									<option>Editado</option>
									<option>Duplicado</option>
								</select>
							</div>
							<div class="col-sm-4 m-b-xs">
								<button type="submit" class="btn btn-sm btn-primary" style="margin-top: 28px;"> Buscar!</button> 
							</div>						
						</div>
					</div>
				</div>
			</div>
		</div>	
		<!-- Fin buscador -->
        <div class="row">
		<form id="formulario_de_citas" action="#" method="post">		
		<input id="accion" name="accion" type="hidden" value="" required>
            <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <div class="ibox-tools">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">
									<i class="fa fa-wrench"></i> Opciones de la <?php echo $pagina; ?>  
								</a>
								<ul class="dropdown-menu dropdown-user">
									<li><a id="btn_reactivar_citas"> <i class="fa fa-low-vision text-navy"></i> Reactivar Citas</a></li>
									<li><a id="btn_eliminar_citas"> <i class="fa fa-files-o text-navy"></i> Eliminar Citas</a></li>
								</ul>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
							<form id="tabla_larga" action="<?php echo vinculo('desactivar-alimentos'); ?>" method="post">																							
								<table id="tabla_lista_citas" class="table table-striped dataTables-example">
								<thead>
								<tr>
									<th style="width: 30px;">
										<div class="checkbox checkbox-success" style="position: absolute;margin-top: -5px; margin-left: -3px;">
											<input id="checkbox1" type="checkbox" class="marcar_todos_desactivar">
											<label for="checkbox1"></label>
										</div>
									</th>
									<th>Nombre </th>
									<th>Apellido </th>
									<th>Email</th>								
									<th>Fecha Inicio</th>
									<th>Fecha Fin</th>
								</tr>
								</thead>
								<tbody>
									<?php //Obtener el historial de pesos por clientes
										$citas = todas_las_citas_desactivadas ();
									?> 
									<?php for ($i = 0; $i <= count($citas); $i++) { ?>
										<?php if(!empty($citas[$i]['id'])){ ?>
											<tr>
												<td>
													<div class="checkbox checkbox-success">
														<input id="desactivar_<?php echo $citas[$i]['id']; ?>" type="checkbox" name="desactivar_<?php echo $citas[$i]['id']; ?>" class="marcar_desactivar"><label for="desactivar_<?php echo $citas[$i]['id']; ?>"></label>
													</div>
												</td>
												<td><?php echo $citas[$i]['dni']; ?></td>
												<td><?php echo $citas[$i]['nombre']; ?></td>
												<td><?php echo $citas[$i]['telefono_movil']; ?></td>												
												<td><?php echo $citas[$i]['inicio']; ?></td>
												<td><?php echo $citas[$i]['fin']; ?></td>
											</tr>
										<?php } ?>
									<?php } ?>
								</tbody>
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
		
			var tabla_lista_citas = $('#tabla_lista_citas').DataTable({  
				responsive: true,
				processing: true,
				erverSide: true,											
				deferRender:    true,
				scrollCollapse: true,
				scroller:       false,
				serialize:		true,				
				iDisplayLength:	10,
				paging: 		true,	
				order: [[ 4, 'desc' ]]
				
			});			
			
        });		
		
		//Indice de edicion
		$('#example').on( 'click', 'tr', function () {		  
		    var indice_id = ($(this).attr('id'));	
			$.cookie('indice', indice_id);	
		});
		
		//Todos los marcados para desactivarlos
		$(".marcar_todos_desactivar").on("click", function () {
			var marcado = $(this).is(':checked'); 			
			if(marcado == true){				
				$('.marcar_desactivar').prop('checked',true);
				$(".marcar_desactivar").attr('value', '1');
			}else{				
				$('.marcar_desactivar').prop('checked',false);
				$('.marcar_desactivar').attr('value', '0');
			}
		});
		
		//Mandar para duplicar o desactivar
		$("#btn_desactivar_alimentos_mensaje" ).click(function() {
			$("#accion").attr('value', 'Desactivado');
			$("#mover" ).submit();
		});
		$("#btn_duplicar_alimentos_mensaje" ).click(function() {
			$("#accion").attr('value', 'Duplicado');
			$("#mover" ).submit();
		});
		
		$("#btn_reactivar_citas").on("click", function () {
            $('#formulario_de_citas').attr('action', "<?php echo vinculo('reactivar-citas'); ?>");			
			$("#formulario_de_citas" ).submit();
        });
		$("#btn_eliminar_citas").on("click", function () {
            $('#formulario_de_citas').attr('action', "<?php echo vinculo('eliminar-citas'); ?>");			
			$("#formulario_de_citas" ).submit();
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
