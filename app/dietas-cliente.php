<?php
session_start();
include 'parts/conex.php';
$pagina = 'Visualización de Dietas';
$migas = array('Lista Clientes');
$migas_url = array('lista-clientes');

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';

//Buscar cliente
while ($post = each($_POST))
{
	if($post[0] != 'example_length') {
		//echo $post[0] . " = " . $post[1];
		//Obtener los datos del cliente				
		if(!empty($post[0])){	
			$cliente = obtener_datos_cliente_x_usuario ($post[0]);
			$id_cliente = $post[0];
		}
	}
}	

//redireccion dieta cliente
if($id_cliente == ''){
	$id_cliente = $_GET['id'];
}
?>
	<?php echo header_documento(); ?>
	<?php include 'parts/header.php'; ?>	
	<link href="<?php echo $url_app; ?>css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
	<link href="<?php echo $url_app; ?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">
	<!-- Morris -->
    <link href="<?php echo $url_app; ?>css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
	<link href="<?php echo $url_app; ?>css/animate.css" rel="stylesheet">
	<style>
	.table-responsive {
		overflow-x: hidden;
	}
	.dataTables_filter {
		display: none; 
	}
	#eliminar_dieta_cliente, #ver_dieta_cliente {
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
		<!-- Buscador -->		
		<div class="row"> 				
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<div class="ibox-tools">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">
									<i class="fa fa-wrench"></i> Opciones de la <?php echo $pagina; ?>  
								</a>
								<ul class="dropdown-menu dropdown-user">
									<li><a href="#" id="eliminar_dieta_cliente"> <i class="fa fa-low-vision text-navy"></i> Eliminar Dieta</a></li>
									<li><a href="#" id="ver_dieta_cliente"> <i class="fa fa-low-vision text-navy"></i> Ver Dieta</a></li>
								</ul>
                            </div>
					</div>
					<div class="ibox-content">
						<form id="formulario_dieta_guardada" action="" method="post">
						<table  id="example" class="table table-striped dataTables-example">
							<thead>
								<tr>
									<th style="width: 30px;">
										<div class="checkbox checkbox-success" style="position: absolute;margin-top: -5px; margin-left: -3px;">
											<input id="checkbox1" type="checkbox" class="marcar_todos">
											<label for="checkbox1"></label>
										</div>
									</th>
									<th>Fecha</th>
									<th>Kilocalorías/día</th>
									<th>Duración (días)</th>
									<th>Comidas por día</th>									
								</tr>
							</thead>
							<tbody>
								<?php echo gx_table_dietas_generadas($id_cliente); ?>
							</tbody>	
						</table>
						</form>
					</div>
				</div>
			</div>
		</div>				
		<!-- Fin buscador -->  		
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
	<!-- Morris -->
	<script src="<?php echo $url_app; ?>js/plugins/morris/raphael-2.1.0.min.js"></script>
	<script src="<?php echo $url_app; ?>js/plugins/morris/morris.js"></script>
	<script>
		//Llamamos los datos de la tabla en segundo plano para que carge mucho mas rapido
        $(document).ready(function(){			
			$('#mensajes_footer').modal('show');
			
			//Tablas
			var table_buscar = $('#example').DataTable({  
				responsive: true,
				processing: true,
				erverSide: true,											
				deferRender:    true,
				scrollCollapse: true,
				scroller:       false,
				serialize:		true,				
				iDisplayLength:	13,
				paging: 		true,					
				
			});
			
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
					$('#eliminar_dieta_cliente, #ver_dieta_cliente').css('display', 'none');
				}
				if(total_marcados >= 2){
					$('#eliminar_dieta_cliente, #ver_dieta_cliente').css('display', 'none');
				}
				if(total_marcados == 1){
					$('#eliminar_dieta_cliente, #ver_dieta_cliente').css('display', 'block');
				}
			}); 
			$('#example').on( 'click', 'tr', function () {
				var total_marcados = $('.marcar').filter(':checked').length
				if(total_marcados == 0){
					$('#eliminar_dieta_cliente, #ver_dieta_cliente').css('display', 'none');
				}
				if(total_marcados >= 2){
					$('#eliminar_dieta_cliente, #ver_dieta_cliente').css('display', 'none');
				}
				if(total_marcados == 1){
					$('#eliminar_dieta_cliente, #ver_dieta_cliente').css('display', 'block');
				}	
			});
			
			//->Eliminar dieta
			$("#eliminar_dieta_cliente").on("click", function () {
				$('#formulario_dieta_guardada').attr('action', "<?php echo $url_app; ?>eliminar-dieta-guardada");				
				$("#formulario_dieta_guardada" ).submit();
			});
			
			$("#ver_dieta_cliente").on("click", function () {
				$('#formulario_dieta_guardada').attr('action', "<?php echo $url_app; ?>ver-dieta-cliente");				
				$("#formulario_dieta_guardada" ).submit();
			});
        });

    </script>	
	<?php $conn->close(); ?>
</body>
</html>
