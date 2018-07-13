<?php
session_start();
include 'parts/conex.php';

$pagina = 'Historial Pesos';
$migas = array('Lista Clientes');
$migas_url = array('lista-cliestes');

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
	<!-- Morris -->
    <link href="<?php echo $url_app; ?>css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
	<link href="<?php echo $url_app; ?>css/animate.css" rel="stylesheet">
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
		<form action="<?php echo $url_app; ?>eliminar-historial-peso" method="post">						
		<div class="row"> 
				<?php
				while ($post = each($_POST))
					{
						if($post[0] != 'example_length') {
							//echo $post[0] . " = " . $post[1];
							//Obtener los datos del cliente				
							if(!empty($post[0])){	
								$cliente = obtener_datos_cliente_x_usuario ($post[0]);
							}
							$listado_clientes[] = $post[0];
				?>
				<?php //print_r($cliente); ?>	
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<div class="ibox-tools">							
							<button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i> Eliminar Registros de peso de <?php echo $cliente['apellidos'].', '.$cliente['nombre']; ?></button>
						</div>
					</div>
					<div class="ibox-content">
						<h1><strong>Cliente:</strong> <?php echo $cliente['apellidos'].', '.$cliente['nombre']; ?></h1>						
						<br />
						<div class="row">
							<div class="col-md-6">							
								<!-- Lista de pesos -->
								<table id="example_<?php echo $post[0]; ?>" class="table table-striped dataTables-example">
                                    <thead>
                                    <tr>
                                        <th style="width: 30px;">
											<div class="checkbox checkbox-success" style="position: absolute;margin-top: -5px; margin-left: -3px;">
												<input id="checkbox1" type="checkbox" class="marcar_todos_<?php echo $post[0]; ?>">
												<label for="checkbox1"></label>
											</div>
										</th>
                                        <th>Fecha </th>
                                        <th>Peso </th>
                                        <th>Metabolismo basal</th>
                                        <th>Gasto energético total</th>
										<th>Índice Masa Corporal</th>										
                                    </tr>
                                    </thead>
                                    <tbody>
										<?php 
										//Obtener el historial de pesos por clientes
										if(!empty($post[0])){
											$historial_pesos = obtener_historial_peso_cliente ($post[0]);
										}
										?> 
										
										<?php for ($i = 0; $i <= count($historial_pesos); $i++) { ?>
											<?php if(!empty($historial_pesos[$i]['fecha'])){ ?>
												<tr>
													<td>
														<div class="checkbox checkbox-success">
															<input id="<?php echo $historial_pesos[$i]['id']; ?>" type="checkbox" name="<?php echo $historial_pesos[$i]['id']; ?>" class="marcar_<?php echo $post[0]; ?>"><label for="<?php echo $historial_pesos[$i]['id']; ?>"></label>
														</div>
													</td>
													<td><?php echo $historial_pesos[$i]['fecha']; ?></td>
													<td><?php echo $historial_pesos[$i]['peso']; ?></td>
													<td><?php echo $historial_pesos[$i]['metabolisto_basal']; ?></td>
													<td><?php echo $historial_pesos[$i]['gasto_energetico_total']; ?></td>
													<td><?php echo $historial_pesos[$i]['inice_masa_corporal']; ?></td>													
												</tr>
											<?php } ?>
										<?php } ?>
                                    </tbody>
                                </table>
								
								<?php //print_r($post[0]); ?>
								<?php //print_r($listado_clientes); ?>
							</div>
							<div class="col-md-6">		
								<!-- Graficos -->									
								<div id="morris-area-chart_<?php echo $post[0]; ?>"></div>
								<div id="morris-bar-chart_<?php echo $post[0]; ?>"></div>
							</div>	
						</div>
						<br /><br />									 
					</div>
				</div>
			</div>
			<?php } } ?>	
		</div>		
		</form>	
		<!-- Fin buscador -->  
		<?php //print_r( $alimentos_activos ); ?>	
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
			<?php
				//Generar grafico por cada usuario
				foreach ($listado_clientes as $cliente_id) {
				?>
				<?php 
				//Obtener el historial de pesos por clientes
				if(!empty($cliente_id)){
					$historial_pesos = obtener_historial_peso_cliente ($cliente_id);
				}
				?> 
			//Tablas
			var table_buscar = $('#example_<?php echo $cliente_id; ?>').DataTable({  
				responsive: true,
				processing: true,
				erverSide: true,											
				deferRender:    true,
				scrollCollapse: true,
				scroller:       false,
				serialize:		true,				
				iDisplayLength:	13,
				paging: 		true,					
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
			//Graficos 
			Morris.Area({
				element: 'morris-area-chart_<?php echo $cliente_id; ?>',
				data: [ 
				<?php for ($i = 0; $i <= count($historial_pesos); $i++) { ?>
					<?php if(!empty($historial_pesos[$i]['fecha'])){ ?>
				{ periodo: '<?php echo $historial_pesos[$i]['fecha']; ?>', Metabolismo_basal: <?php echo $historial_pesos[$i]['metabolisto_basal']; ?>, Gasto_energético_total: <?php echo $historial_pesos[$i]['gasto_energetico_total']; ?>, Indice_Masa_Corporal: <?php echo $historial_pesos[$i]['inice_masa_corporal']; ?> },
					<?php } ?>
				<?php } ?>],
				xkey: 'periodo',
				ykeys: ['Metabolismo_basal', 'Gasto_energético_total', 'Indice_Masa_Corporal'],
				labels: ['Metabolismo basal', 'Gasto energético total', 'Índice Masa Corporal'],
				pointSize: 2,
				hideHover: 'auto',
				resize: true,
				lineColors: ['#772e71', '#579e24', '#e27802'],
				lineWidth:2,
				pointSize:1,
				parseTime: false
			});

			
			//Graficos 2
			Morris.Bar({
				element: 'morris-bar-chart_<?php echo $cliente_id; ?>',
				data: [
				<?php for ($i = 0; $i <= count($historial_pesos); $i++) { ?>
					<?php if(!empty($historial_pesos[$i]['fecha'])){ ?>	
					{ y: '<?php echo $historial_pesos[$i]['fecha']; ?>', a: <?php echo $historial_pesos[$i]['metabolisto_basal']; ?>, b: <?php echo $historial_pesos[$i]['gasto_energetico_total']; ?>, c: <?php echo $historial_pesos[$i]['inice_masa_corporal']; ?> },
					<?php } ?>
				<?php } ?> ],
				xkey: 'y',
				ykeys: ['a', 'b', 'c'],
				labels: ['Metabolismo basal', 'Gasto energético total', 'Índice Masa Corporal'],
				hideHover: 'auto',
				resize: true,
				barColors: ['#772e71', '#579e24', '#e27802'],
				parseTime: false
			});
			
			//Marcar checks
			$(".marcar_todos_<?php echo $cliente_id; ?>").on("click", function () {
				var marcado = $(this).is(':checked');
				
				if(marcado == true){				
					$('.marcar_<?php echo $cliente_id; ?>').prop('checked',true);
					$(".marcar_<?php echo $cliente_id; ?>").attr('value', '1');					
				}else{				
					$('.marcar_<?php echo $cliente_id; ?>').prop('checked',false);
					$(".marcar_<?php echo $cliente_id; ?>").attr('value', '0');				
				}
			});
		<?php } ?>
			
        });

    </script>	
	<?php $conn->close(); ?>
</body>
</html>
