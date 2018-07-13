<?php
session_start();
include 'parts/conex.php';

$pagina = 'Lista de usuarios';
$migas = array('');
$migas_url = array('');

//Solo permitir acceso a estos roles
$acceso_roles = array('admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';

//Urls por GET
if(!empty($_GET['mensaje'])){
	$mensaje    = substr($_GET['mensaje'], 5, 1); 
}

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
		<div class="wrapper wrapper-content animated fadeInRight">	
        <div class="row">
            <div class="col-lg-12">
                    <div class="ibox float-e-margins">						
						<!--- Fin Mensajes -->
                        <div class="ibox-title">
                            <div class="ibox-tools">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">
									<i class="fa fa-wrench"></i> Opciones de la <?php echo $pagina; ?>  
								</a>
								<ul class="dropdown-menu dropdown-user">
									<li><a href="#" data-toggle="modal" data-target="#desactivar_usuario" class="desactivar_usuarios"> <i class="fa fa-low-vision text-navy"></i> Desactivar Usuarios</a></li>
									<li><a href="#" data-toggle="modal" data-target="#actulizar_usuario" class="activar_usuarios"> <i class="fa fa-eye text-navy"></i> Activar Usuarios</a></li>
									</li>
								</ul>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
								<form action="<?php echo vinculo('lista-usuarios'); ?>" method="post">
									<div class="col-sm-2 m-b-xs"><h5>Filtrar estado: </h5> 
									<select id="estado" class="input-sm form-control input-s-sm inline" style="padding-top:0px;">
										<option>Todos</option>
										<option selected>Activo</option>
										<option>Desactivado</option>
									</select>
									</div>
									<div class="col-sm-2 m-b-xs"><h5>Tipo de cliente: </h5>										
										<div data-toggle="buttons" class="btn-group">									
											<select id="role" class="input-sm form-control input-s-sm inline" style="padding-top:0px;">
											<option value="">Todos</option>
											<?php $grupo_de_roles = grupo_de_roles(); ?>																			
											<?php for ($i = 0; $i <= count($grupo_de_roles); $i++) {?>	
												<?php if(!empty($grupo_de_roles[$i]['role']) || $grupo_de_roles[$i]['role'] != '' ) { ?>
													<?php if ($_POST['role'] == $grupo_de_roles[$i]['role']) { ?>
														<option value="<?php echo $grupo_de_roles[$i]['role']; ?>" selected><?php echo $grupo_de_roles[$i]['role']; ?></option>
													<?php } else { ?>	
														<option value="<?php echo $grupo_de_roles[$i]['role']; ?>"><?php echo $grupo_de_roles[$i]['role']; ?></option>
													<?php } ?>	
												<?php } ?>		
											<?php } ?>
											</select>										
										</div>
									</div>
									<div class="col-sm-2"><h5>Buscar por nombre: </h5>
										<div class="input-group">
										<input type="text" placeholder="Buscar por nombre..." class="input-sm form-control" id="nombre_usuario" name="nombre" value=""><span class="input-group-btn">
										<button type="submit" class="btn btn-sm btn-primary"> Buscar!</button> </span></div>
									</div>
									<div class="col-sm-6 m-b-xs">
									</div>
								</form> 								
                            </div>
							
                            <div class="table-responsive">
							<form id="formulario_usuarios" action="<?php echo vinculo('actualizar-usuarios'); ?>" method="post">
								<br /><br />
                                <table  id="example" class="table table-striped dataTables-example">
                                    <thead>
                                    <tr>
                                        <th style="width: 30px;">
											<div class="checkbox checkbox-success" style="position: absolute;margin-top: -5px; margin-left: -3px;">
												<input id="checkbox1" type="checkbox" class="marcar_todos">
												<label for="checkbox1"></label>
											</div>
										</th>
                                        <th class="marcar_todos">Nombre </th>
                                        <th>Login </th>
                                        <th>Email</th>
                                        <th>Tipo de cliente</th>
                                        <th>Estado</th>
										<th>Fecha alta</th>
										<th>Fin suscripción</th>
										<th>Observaciones</th>
										<th>DNI</th>
										<th>Poblacion</th>
										<th>Direccion</th>
										<th>Provincia</th>
										<th>Forma de pago</th>
										<th>Iban</th>
										<th>Colegio</th>
										<th>Numero de colegiado</th>										
										<th>Fecha de registro</th>
                                    </tr>
                                    </thead>
                                    <tbody>											   
                                    </tbody>
                                </table>
								<?php echo modal_boton_enviar ('desactivar_usuario', 'Desactivar usuario', '¿Estas seguro que quieres desactivar estos usuarios?', '', 'Desactivar!'); ?>
								<?php echo modal_boton_enviar ('actulizar_usuario', 'Activar usuario', '¿Estas seguro que quieres activar estos usuarios?', '', 'Activar!'); ?>								
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
	<script>
		//Flecha para subir		
		$("#subir-top").fadeOut();
		$('#mensajes_footer').modal('show');
		$(window).scroll(function(){			
			var windowHeight = $(window).scrollTop();
			var contenido2 = $(".ibox-title").offset();
			contenido2 = contenido2.top;			
				if(windowHeight >= contenido2  ){
				 $("#subir-top").fadeIn("fast");					
				}else{
				 $("#subir-top").fadeOut("fast");				 
			}
		});
		
		
		//Llamamos los datos de la tabla en segundo plano para que carge mucho mas rapido
        $(document).ready(function(){
			$('#example').DataTable({  
				responsive: true,
				processing: true,
				erverSide: true,								
				ajax: "<?php echo $url_app; ?>crear-archivo-txt-usuarios.php",
				deferRender:    true,
				scrollCollapse: true,
				scroller:       false,
				serialize:		true,
				<?php if (isset($idiet_status_tabla) && $idiet_status_tabla == 1) {?>
				iDisplayLength:	<?php echo $tabla_lista; ?>,
				<?php }else{ ?>
				iDisplayLength:	3000,
				paging: 		false,
				<?php } ?>				
				dom: '<"html5buttons"B>lTfgitp',
				buttons: [
					{extend: 'copy', text: 'Copiar' },
					//{extend: 'csv', charset: 'ISO 8859-1',},
					{extend: 'excel', title: 'Listado Usuarios'},
			     	{extend: 'pdf',   text: 'Imprimir', orientation: 'landscape', pageSize: 'LEGAL',  exportOptions: {
						modifier: {
							page: 'current'
						}
					},
					customize: function(doc) {
					   doc.defaultStyle.fontSize = 6; //<-- set fontsize to 16 instead of 10 
					   doc.styles.tableHeader.fontSize = 6;  
 				    }  	
					}
					/*
					{extend: 'print', text: 'Imprimir',
					 customize: function (win){
							$(win.document.body).addClass('white-bg');
							$(win.document.body).css('font-size', '10px');

							$(win.document.body).find('table')
									.addClass('compact')
									.css('font-size', 'inherit');
					}
					}*/
				],
				'fnCreatedRow': function (nRow, aData, iDataIndex) {
					$(nRow).attr('id', 'my' + iDataIndex); // or whatever you choose to set as the id
				}
				
			});
			
			$(function () {
				table
						.columns(5)
						.search('Activo')
						.draw();
			});
						
			var table = $('#example').DataTable();
			table.columns( [ 9, 10, 11, 12, 13, 14, 15, 16, 17 ] ).visible( false, false );						
			//Filtros de la tabla
			$('#nombre_usuario').on( 'keyup', function () {				
				table
					.columns(1)
					.search(this.value)
					.draw();
			});
			$('#estado').on( 'keyup change', function () {
				var cur_value = $('option:selected',this).text();
				if(cur_value == 'Todos'){
					cur_value = '';
				}
					table
						.columns(5)
						.search(cur_value)
						.draw();
			});
			$('#role').on( 'keyup change', function () {
				var cur_value = $('option:selected',this).text();
				if(cur_value == 'Todos'){
					cur_value = '';
				}
					table
						.columns(4)
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
			// console.log($.cookie('indice'));
			// console.log('existe');
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
		
		
		
		//Marcar checks
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
		
		//Cambiar url del form para desactivar los usuarios
		$(".desactivar_usuarios").on("click", function () {
            $('#formulario_usuarios').attr('action', "<?php echo vinculo('desactivar-usuarios'); ?>");
        });
		
		//Cambiar url del form para activar los usuarios
		$(".activar_usuarios").on("click", function () {
            $('#formulario_usuarios').attr('action', "<?php echo vinculo('activar-usuarios'); ?>");
        });	
		
		
	
	</script>
	<?php $conn->close(); ?>
	
</body>
</html>

