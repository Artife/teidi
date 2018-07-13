<?php
session_start();
include 'parts/conex.php';

$pagina = 'Lista de clientes desactivados';
$migas = array('');
$migas_url = array('');

//Solo permitir acceso a estos roles
//$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');
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
	#vinculo_reactivar_cliente, #vinculo_eliminar_cliente{
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
        <div class="row">
            <div class="col-lg-12">
                    <div class="ibox float-e-margins">						
                        <div class="ibox-title">
                            <div class="ibox-tools">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">
									<i class="fa fa-wrench"></i> Opciones de la <?php echo $pagina; ?>  
								</a>
								<ul class="dropdown-menu dropdown-user">									
									<li><a id="vinculo_reactivar_cliente" href="#"> <i class="fa fa-low-vision text-navy"></i> Reactivar Cliente</a></li>																		
									<li><a id="vinculo_eliminar_cliente" href="#"> <i class="fa fa-low-vision text-navy"></i> Eliminar Cliente</a></li>
								</ul>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
								<form action="<?php echo $url_app; ?>lista-usuarios" method="post">
								<input id="accion" name="accion" type="hidden" value="" required>
									<div class="col-sm-2 m-b-xs"><h5>Nombre: </h5> 
										<input id="cliente_nombre" type="text" placeholder="Buscar por nombre..." class="input-sm form-control" name="nombre">										
									</div>
									<div class="col-sm-2 m-b-xs"><h5>Apellidos: </h5> 									
										<input id="cliente_apellido" type="text" placeholder="Buscar por apellido..." class="input-sm form-control" name="apellido">										
									</div>
									<div class="col-sm-2 m-b-xs"><h5>DNI: </h5> 									
										<input id="cliente_dni" type="text" placeholder="Buscar por dni..." class="input-sm form-control" name="apellido">										
									</div>
									<div class="col-sm-2 m-b-xs">
										<button type="submit" class="btn btn-sm btn-primary" style="margin-top: 28px;"> Buscar!</button> 
									</div>
									<div class="col-sm-4 m-b-xs">										
									</div>
								</form> 								
                            </div>
                            <div class="table-responsive">
							<form id="formulario_usuarios" action="#" method="post">
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
                                        <th class="marcar_todos">DNI </th>
                                        <th>Nombre </th>
                                        <th>Apellidos</th>
                                        <th>Contacto</th>
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
	<script>
		//Flecha para subir		
		$("#subir-top").fadeOut();
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
			var table_buscar = $('#example').DataTable({  
				responsive: true,
				processing: true,
				erverSide: true,							
				ajax: "<?php echo $url_app; ?>crear-archivo-txt-clientes-desactivados.php",
				deferRender:    true,
				scrollCollapse: true,
				scroller:       false,
				serialize:		true,
				order: [[ 2, 'asc' ]],	
				<?php if (!empty($idiet_status_tabla) && $idiet_status_tabla == "0") {?>
				iDisplayLength:	<?php echo $tabla_lista; ?>,
				<?php }else{ ?>
				iDisplayLength:	3000,
				paging: 		false,
				<?php } ?>				
				dom: '<"html5buttons"B>lTfgitp',
				buttons: [
					{extend: 'copy', text: 'Copiar' },
					//{extend: 'csv', charset: 'ISO 8859-1',},
					{extend: 'excel', title: 'Listado Clientes'},
			     	{extend: 'pdf',   text: 'Imprimir',  exportOptions: {
						modifier: {
							page: 'current'
						}
					}}					
				],
				'fnCreatedRow': function (nRow, aData, iDataIndex) {
					$(nRow).attr('id', 'my' + iDataIndex); // or whatever you choose to set as the id
				}
				
			});
			$('#mensajes_footer').modal('show');
			
			//Filtros de la tabla
			$('#cliente_dni').on( 'keyup', function () {				
				table_buscar
					.columns(1)
					.search( this.value )
					.draw();
			});
			$('#cliente_nombre').on( 'keyup', function () {				
				table_buscar
					.columns(2)
					.search( this.value )
					.draw();
			});
			$('#cliente_apellido').on( 'keyup', function () {				
				table_buscar
					.columns(3)
					.search( this.value )
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
			var total_marcados = $('.marcar').filter(':checked').length
			if(total_marcados == 0){
				$('#vinculo_reactivar_cliente').css('display', 'none');
				$('#vinculo_eliminar_cliente').css('display', 'none');
			}
			if(total_marcados >= 1){
				$('#vinculo_reactivar_cliente').css('display', 'block');
				$('#vinculo_eliminar_cliente').css('display', 'block');
			}	
		});  
		$('#example').on( 'click', 'tr', function () {
			var total_marcados = $('.marcar').filter(':checked').length
			if(total_marcados == 0){
				$('#vinculo_reactivar_cliente').css('display', 'none');
				$('#vinculo_eliminar_cliente').css('display', 'none');
			}
			if(total_marcados >= 1){
				$('#vinculo_reactivar_cliente').css('display', 'block');
				$('#vinculo_eliminar_cliente').css('display', 'block');
			}
		});
		
		//Cambiar url del form para desactivar los usuarios
		$("#vinculo_reactivar_cliente").on("click", function () {
            $('#formulario_usuarios').attr('action', "<?php echo $url_app; ?>reactivar-clientes");
			$("#formulario_usuarios" ).submit();
        });
		
		//Cambiar url del form para activar los usuarios   
		$("#vinculo_eliminar_cliente").on("click", function () {
            $('#formulario_usuarios').attr('action', "<?php echo $url_app; ?>eliminar-clientes");
			$("#formulario_usuarios" ).submit();
        });	
		
		
	</script>
	<?php $conn->close(); ?>
	
</body>
</html>

