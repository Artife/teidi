<?php
session_start();
require('parts/conex.php');

$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';
$pagina = 'Home';
$_SESSION['mensaje'] = '';

//Todos los Alimentos desactivados
$_SESSION['total_alimentos_desactivados_por_cliente_array'] = gx_todas_los_alimentos_desactivadas_por_el_usuario();
$_SESSION['total_alimentos_desactivados_por_cliente_sql'] = gx_todas_los_alimentos_desactivadas_por_el_usuario_sql();
$_SESSION['todas_las_recetas_desactivadas_por_el_usuario']  = gx_todas_las_recetas_desactivadas_por_el_usuario();
$_SESSION['todas_las_recetas_desactivadas_por_el_usuario_sql']  = gx_todas_las_recetas_desactivadas_por_el_usuario_sql();
$_SESSION['todas_las_reglas_desactivadas_por_el_usuario_sql']  = gx_todas_las_reglas_desactivadas_por_el_usuario_sql();


?>
	<?php echo header_documento(); ?>
	<?php include 'parts/header.php'; ?>
	<link href="<?php echo $url_app; ?>css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
	<link href="<?php echo $url_app; ?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">
	<style>
	#tabla_lista_citas span, dataTables_filter{
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
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content">
					<!--  Contenido  home -->					
        <div class="row">
			<div class="col-lg-3">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<span class="label label-success pull-right"><?php echo ucwords(strftime("%B %Y")); ?></span>
						<h5>Clientes</h5>
					</div>
					<div class="ibox-content">
						<h1 class="no-margins">Total Activos <?php $total_clientes = listado_clientes_x_usuario(); if(!empty($total_clientes)) { echo count($total_clientes); } ?></h1>
						<?php $total_clientes_x_mes = listado_clientes_x_usuario_en_mes(date("m/Y")); ?>
						<?php if (empty($total_clientes_x_mes) || $total_clientes_x_mes == 0){ ?>
							<div class="stat-percent font-bold text-success">0% <i class="fa fa-level-down"></i></div>
						<?php }else{ ?>
							<div class="stat-percent font-bold text-success"><?php  echo $total_clientes_x_mes; ?>% <i class="fa fa-level-up"></i></div>
						<?php } ?>	
						<small>Clientes activos en <?php echo ucwords(strftime("%B %Y")); ?></small>								
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<span class="label label-info pull-right"><?php echo ucwords(strftime("%B %Y")); ?></span>
						<h5>Recetas</h5>
					</div>
					<div class="ibox-content">
						<h1 class="no-margins">Total Recetas <?php echo $total_recetas_por_cliente = total_recetas_por_cliente(); ?></h1>
						<?php $total_recetas_por_cliente_mes = total_recetas_por_cliente_mes(date("m-Y")); ?>
						<?php if (empty($total_recetas_por_cliente_mes) || $total_recetas_por_cliente_mes == 0){ ?>
						<div class="stat-percent font-bold text-info">0% <i class="fa fa-level-down"></i></div>
						<?php }else{ ?>
							<div class="stat-percent font-bold text-info"><?php  echo $total_recetas_por_cliente_mes; ?>% <i class="fa fa-level-up"></i></div>
						<?php } ?>	
						<small>Recetas activas en <?php echo ucwords(strftime("%B %Y")); ?> </small>	
					</div>
				</div>
			</div>	
			<div class="col-lg-3">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<span class="label label-primary pull-right"><?php echo ucwords(strftime("%B %Y")); ?> </span>
						<h5>Alimentos</h5>
					</div>
					<div class="ibox-content">
						<h1 class="no-margins">Total Alimentos <?php  echo $total_alimentos_por_cliente = total_alimentos_por_cliente(); ?></h1>
						<?php $total_alimentos_por_cliente_en_mes = total_alimentos_por_cliente_en_mes(date("m-Y")); ?>
						<?php if (empty($total_alimentos_por_cliente_en_mes) || $total_alimentos_por_cliente_en_mes == 0){ ?>
							<div class="stat-percent font-bold text-navy">0% <i class="fa fa-level-down"></i></div>
						<?php } else {?>
							<div class="stat-percent font-bold text-navy"><?php echo $total_alimentos_por_cliente_en_mes; ?>% <i class="fa fa-level-up"></i></div>
						<?php } ?>		
						<small>Alimentos activos en <?php echo ucwords(strftime("%B %Y")); ?></small>	
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<span class="label label-warning pull-right"><?php echo ucwords(strftime("%B %Y")); ?></span>
						<h5>Dietas</h5>
					</div>
					<div class="ibox-content">
						<h1 class="no-margins">Total Dietas</h1>
						<div class="stat-percent font-bold text-warning">38% <i class="fa fa-level-down"></i></div>
						<small>Dietas generadas en <?php echo ucwords(strftime("%B %Y")); ?></small>
					</div>
				</div>
			</div>	
        </div> 
        <div class="row">
			<div class="col-lg-9">
				<div class="ibox float-e-margins">
					<div class="ibox-title text-center">
						<h1>Asistente de generación de dieta</h1>
						<a href="<?php echo $url_app; ?>asistente-paso-1" class="btn btn-w-m btn-guardar">Generar Dieta</a>
					</div>
					<div class="ibox-content" style="background-image: url(<?php echo $url_app; ?>img/fondo-home.jpg);  background-size: cover;  background-repeat: no-repeat;   height: 900px;    width: 100%;">						
						<div class="row">						
						</div>
					</div> 
					</div>
			</div>			
			<div class="col-lg-3">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<span class="label label-danger pull-right"><?php echo ucwords(strftime("%B %Y")); ?></span>
						<h5>Citas</h5>
					</div>
					<div class="ibox-content">
						<h1 class="no-margins">Total Citas <?php echo $total_citas_por_cliente = total_citas_por_cliente(); ?></h1>
						<?php $total_citas_por_cliente_en_mes = total_citas_por_cliente_en_mes(date("m/Y")); ?>
						<?php if (empty($total_citas_por_cliente_en_mes) || $total_citas_por_cliente_en_mes == 0){ ?>
							<div class="stat-percent font-bold text-danger">0% <i class="fa fa-level-down"></i></div>
						<?php } else {?>
							<div class="stat-percent font-bold text-danger"><?php echo $total_citas_por_cliente_en_mes; ?>% <i class="fa fa-level-up"></i></div>
						<?php } ?>						
						<small>Citas creadas en <?php echo ucwords(strftime("%B %Y")); ?></small>
					</div>
				</div>
				<!-- Listado citas-->
				<div class="ibox-content">			
				<?php //Obtener el historial de pesos por clientes
					$citas = todas_las_citas_activas ();
				?> 	
				<?php //print_r ($citas); ?>
				<table id="tabla_lista_citas" class="table table-striped dataTables-example">
					<thead>
					<tr>						
						<th>DNI </th>
						<th>Cliente </th>											
						<th>Fecha I.</th>
						<th>Fecha H.</th>
					</tr>
					</thead>
					<tbody>
						<!-- Todos vacios -->						
						<?php for ($i = 0; $i <= count($citas); $i++) { ?>										
							<?php if(!empty($citas[$i]['id'])){ ?>
							<?php if($citas[$i]['ordenar_inicio'] >= date("Ymd") AND $citas[$i]['ordenar_inicio'] <= date("Ymd")+7){ ?>
								<tr>									
									<td><?php echo $citas[$i]['dni']; ?></td>
									<td><?php echo $citas[$i]['nombre']; ?></td>									
									<td><span><?php echo substr($citas[$i]['inicio'], 6, 4).substr($citas[$i]['inicio'], 3, 2).substr($citas[$i]['inicio'], 0, 2); ?></span><?php echo $citas[$i]['inicio']; ?></td>
									<td><?php echo $citas[$i]['fin']; ?></td>
								</tr>
							<?php } ?>	
							<?php } ?>
						<?php } ?>
					</tbody>
				</table>
				<div class="text-center">
				<a href="<?php echo $url_app; ?>agenda" type="button" class="btn btn-danger">Ver Agenda</a>
				</div>
				</div>
				<!-- Fin Listado citas -->
				<!-- Menu -->
				<section><br>
					<div class="ibox-content">			
					<ul class="nav metismenu">						
						<li>		 
							<a href="<?php echo $url_app; ?>lista-reglas"><i class="fa fa-gears"></i> <span class="nav-label">Gestión de reglas</span></a>			
						</li>							
						<li>		 
							<a href="<?php echo $url_app; ?>lista-plantillas"><i class="fa fa-certificate"></i> <span class="nav-label">Gestión de plantillas</span></a>			
						</li>
						<li>		 
							<a href="<?php echo $url_app; ?>editar-ingestas"><i class="fa fa-arrows-h"></i> <span class="nav-label">Gestión de recetas-ingestas</span></a>			
						</li>
					</ul>
					</div><br><br><br><br>
				</section>
				<!-- Fin Menu -->
			</div>
		</div>
			<!-- fin contenido home -->
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
        $(document).ready(function() {
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
			bFilter: false, 
			bInfo: false,			
			order: [[ 2, 'asc' ]],	
			dom: '<"html5buttons"B>lTfgitp',
			columnDefs: [   {
                "targets": [ 3 ],
				"visible": false
			}],
			buttons: [],
			'fnCreatedRow': function (nRow, aData, iDataIndex) {
				$(nRow).attr('id', 'my' + iDataIndex); // or whatever you choose to set as the id
			}
			
		});	
           
        });
    </script>
	<?php $conn->close(); ?>
</body>
</html>

