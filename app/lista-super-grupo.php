<?php
session_start();
include 'parts/conex.php';

$pagina = 'Lista super grupos';
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
	#vinculo_desactivar, #vinculo_activar {
		display: none;
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
									<li><a id="vinculo_desactivar" href="#"> <i class="fa fa-low-vision text-navy"></i> Desactivar super grupo</a></li>
									<li><a id="vinculo_activar"  href="#"> <i class="fa fa-eye text-navy"></i> Activar super grupo</a></li>
									</li>
								</ul>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
								<form action="#" method="post">
									<div class="col-sm-2 m-b-xs"><h5>Filtrar estado: </h5> 
									<select id="estado" class="input-sm form-control input-s-sm inline" style="padding-top:0px;">
										<option>Todos</option>
										<option selected>Activo</option>
										<option>Desactivado</option>
									</select>
									</div>									
									<div class="col-sm-2"><h5>Buscar por nombre: </h5>
										<div class="input-group">
										<input type="text" placeholder="Buscar por nombre..." class="input-sm form-control" id="nombre" name="nombre" value=""><span class="input-group-btn">
										<button type="submit" class="btn btn-sm btn-primary"> Buscar!</button> </span></div>
									</div>
									<div class="col-sm-6 m-b-xs">
									</div>
								</form> 								
                            </div>
							
                            <div class="table-responsive">
							<form id="formulario_super_grupo" action="#" method="post">
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
										<th class="marcar_todos">Slug </th>		
                                        <th>Estado </th>
                                    </thead>
                                    <tbody>
										<?php echo gx_table_supergrupos(); ?>
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
				scroller:       false,
				serialize:		true,
				<?php if (isset($idiet_status_tabla) && $idiet_status_tabla == 1) {?>
				iDisplayLength:	<?php echo $tabla_lista; ?>,
				<?php }else{ ?>
				iDisplayLength:	3000,
				paging: 		false,
				<?php } ?>				
				
			});
			
			$(function () {
				table
						.columns(3)
						.search('Activo')
						.draw();
			});
						
			var table = $('#example').DataTable();				
			//Filtros de la tabla
			$('#nombre').on( 'keyup', function () {				
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
						.columns(3)
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
		$("#vinculo_desactivar").on("click", function () {
            $('#formulario_super_grupo').attr('action', "<?php echo vinculo('desactivar-supergrupo'); ?>");
			$('#formulario_super_grupo').submit();
        });
		
		//Cambiar url del form para activar los usuarios
		$("#vinculo_activar").on("click", function () {
            $('#formulario_super_grupo').attr('action', "<?php echo vinculo('activar-supergrupo'); ?>");
			$('#formulario_super_grupo').submit();
        });	
		
		$('#example').on( 'click', 'tr', function () {
			var total_marcados = $('.marcar').filter(':checked').length
			if(total_marcados == 0){
				$('#vinculo_desactivar').css('display', 'none');
				$('#vinculo_activar').css('display', 'none');
			}
			if(total_marcados >= 1){				
				$('#vinculo_desactivar').css('display', 'block');
				$('#vinculo_activar').css('display', 'block');
			}
		});
		
	</script>
	<?php $conn->close(); ?>
	
</body>
</html>

