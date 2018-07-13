<?php
session_start();
include 'parts/conex.php';
$pagina = 'Mediciones';
$migas = array('Lista Clientes');
$migas_url = array('lista-clientes');

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
	.dataTables_filter {
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
		<div class="wrapper wrapper-content">	
		<!-- Buscador -->
		<form action="<?php echo $url_app; ?>eliminar-mediciones" method="post">						
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
				<?php print_r($post[0]); ?>	
				<?php //print_r($listado_clientes); ?>	
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
							<div class="col-md-4">							
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
                                    </tr>
                                    </thead>
                                    <tbody>
										<?php 
										//Obtener el historial de pesos por clientes
										if(!empty($post[0])){
											$mediciones = obtener_mediciones_del_cliente ($post[0]);
										}
										?> 
										
										<?php for ($i = 0; $i <= count($mediciones); $i++) { ?>
											<?php if(!empty($mediciones[$i]['fecha'])){ ?>
												<tr>
													<td>
														<div class="checkbox checkbox-success">
															<input id="<?php echo $mediciones[$i]['id_medicion']; ?>" type="checkbox" name="<?php echo $mediciones[$i]['id_medicion']; ?>" class="marcar_<?php echo $post[0]; ?>"><label for="<?php echo $historial_pesos[$i]['id_medicion']; ?>"></label>
														</div>
													</td>
													<td><?php echo $mediciones[$i]['fecha']; ?></td>											
												</tr>
											<?php } ?>
										<?php } ?>
                                    </tbody>
                                </table>
								
								<?php //print_r($post[0]); ?>
								<?php //print_r($listado_clientes); ?>
							</div>
							<div class="col-md-8">		
								<!-- Graficos -->		
								<div class="row">
									<div class="col-md-6">
										<h3>BIA</h3>
										<div id="morris-bar-chart_bio_<?php echo $post[0]; ?>"></div>
										<br/>
									</div>	
									<div class="col-md-6">
										<h3>Ultrasonido</h3>
										<div id="morris-bar-chart_ultrasonido_<?php echo $post[0]; ?>"></div>
										<br/>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<h3>Infrarrojos</h3>
										<div id="morris-bar-chart_infrarojos_<?php echo $post[0]; ?>"></div>
										<br/>
									</div>	
									<div class="col-md-6">
										<h3>Plicometría</h3>
										<div id="morris-bar-chart_plicometria_<?php echo $post[0]; ?>"></div>
										<br/>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<h3>Perímetros</h3>
										<div id="morris-bar-chart_perimetros_<?php echo $post[0]; ?>"></div>
										<br/>
									</div>
								</div>
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
					$mediciones = obtener_mediciones_del_cliente ($cliente_id);
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
				
			});
			<?php if (!empty($mediciones)) { ?>		
			//Grafico Bio
			Morris.Bar({
				element: 'morris-bar-chart_bio_<?php echo $cliente_id; ?>',
				data: [
				<?php for ($i = 0; $i <= count($mediciones); $i++) { ?>
					<?php if(!empty($mediciones[$i]['fecha'])){ ?>	
					{ y: '<?php echo $mediciones[$i]['fecha']; ?>', a: <?php echo $mediciones[$i]['bia_porc_grasa']; ?>, b: <?php echo $mediciones[$i]['bia_grasa_total']; ?>, c: <?php echo $mediciones[$i]['bia_masa_grasa_total']; ?>, d: <?php echo $mediciones[$i]['bia_agua_total']; ?>, e: <?php echo $mediciones[$i]['bia_agua_intracelular']; ?>, f: <?php echo $mediciones[$i]['bia_agua_extracelular']; ?>, g: <?php echo $mediciones[$i]['bia_porc_masa_magra']; ?>, h: <?php echo $mediciones[$i]['bia_masa_muscular_total']; ?>, i: <?php echo $mediciones[$i]['bia_musc_brazo_dcho']; ?>, j: <?php echo $mediciones[$i]['bia_musc_brazo_izdo']; ?>, k: <?php echo $mediciones[$i]['bia_tronco']; ?>, l: <?php echo $mediciones[$i]['bia_pierna_dcha']; ?>, m: <?php echo $mediciones[$i]['bia_pierna_izda']; ?>, n: <?php echo $mediciones[$i]['bia_grasa_visceral']; ?> },
					<?php } ?>
				<?php } ?> ],
				xkey: 'y',
				ykeys: ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n'],
				labels: ['Grasa', 'Grasa Total', 'Masa Grasa Total', 'Agua Total', 'Agua Intracelular', 'Agua Extracelular', 'Masa Magra', 'Masa Muscular Total', 'Músculo Brazo Dcho', 'Músculo Brazo Izdo', 'Tronco', 'Pierna Derecha', 'Pierna Izquierda', 'Grasa Visceral'],
				hideHover: 'auto',
				resize: true,
				barColors: ['#993291', '#7cb84f'],
				parseTime: false
			});
			//Grafico Ultrasonidos
			Morris.Bar({
				element: 'morris-bar-chart_ultrasonido_<?php echo $cliente_id; ?>',
				data: [
				<?php for ($i = 0; $i <= count($mediciones); $i++) { ?>
					<?php if(!empty($mediciones[$i]['fecha'])){ ?>	
					{ y: '<?php echo $mediciones[$i]['fecha']; ?>', a: <?php echo $mediciones[$i]['ultrasonidos_grasa']; ?>, b: <?php echo $mediciones[$i]['ultrasonidos_grasa_total']; ?>, c: <?php echo $mediciones[$i]['ultrasonidos_masa_magra']; ?>},
					<?php } ?>
				<?php } ?> ],
				xkey: 'y',
				ykeys: ['a', 'b', 'c'],
				labels: ['Grasa', 'Grasa Total', 'Masa Grasa Total'],
				hideHover: 'auto',
				resize: true,
				barColors: ['#993291', '#7cb84f'],
				parseTime: false
			});
			//Grafico Infrarojos
			Morris.Bar({
				element: 'morris-bar-chart_infrarojos_<?php echo $cliente_id; ?>',
				data: [
				<?php for ($i = 0; $i <= count($mediciones); $i++) { ?>
					<?php if(!empty($mediciones[$i]['fecha'])){ ?>	
					{ y: '<?php echo $mediciones[$i]['fecha']; ?>', a: <?php echo $mediciones[$i]['infrarrojos_grasa']; ?>, b: <?php echo $mediciones[$i]['infrarrojos_grasa_total']; ?>, c: <?php echo $mediciones[$i]['infrarrojos_masa_magra']; ?>},
					<?php } ?>
				<?php } ?> ],
				xkey: 'y',
				ykeys: ['a', 'b', 'c'],
				labels: ['Grasa', 'Grasa Total', 'Masa Grasa Total'],
				hideHover: 'auto',
				resize: true,
				barColors: ['#993291', '#7cb84f'],
				parseTime: false
			});
			//Grafico Plicometria
			Morris.Bar({
				element: 'morris-bar-chart_plicometria_<?php echo $cliente_id; ?>',
				data: [
				<?php for ($i = 0; $i <= count($mediciones); $i++) { ?>
					<?php if(!empty($mediciones[$i]['fecha'])){ ?>	
					{ y: '<?php echo $mediciones[$i]['fecha']; ?>', a: <?php echo $mediciones[$i]['plico_tricipital']; ?>, b: <?php echo $mediciones[$i]['plico_bicipital']; ?>, c: <?php echo $mediciones[$i]['plico_subescapular']; ?>, d: <?php echo $mediciones[$i]['plico_suprailiaco']; ?>, e: <?php echo $mediciones[$i]['plico_abdominal']; ?>, f: <?php echo $mediciones[$i]['plico_pectoral']; ?>, g: <?php echo $mediciones[$i]['plico_medioaxiliar']; ?>, h: <?php echo $mediciones[$i]['plico_muslo']; ?>, i: <?php echo $mediciones[$i]['plico_pantorrilla']; ?>, j: <?php echo $mediciones[$i]['plico_suma_pliegues']; ?>, k: <?php echo $mediciones[$i]['plico_porc_grasa']; ?>, l: <?php echo $mediciones[$i]['plico_total_grasa']; ?>, m: <?php echo $mediciones[$i]['plico_masa_grasa']; ?>, n: <?php echo $mediciones[$i]['plico_densidad']; ?>},
					<?php } ?>
				<?php } ?> ],
				xkey: 'y',
				ykeys: ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n'],
				labels: ['Tricipital', 'Bicipital', 'Subescapular', 'Suprailíaco', 'Abdominal', 'Pectoral', 'Medioaxilar', 'Muslo', 'Pantorrilla', 'Suma Pliegues', 'Grasa', 'Total Grasa', 'Total Masa Magra', 'Densidad'],
				hideHover: 'auto',
				resize: true,
				barColors: ['#993291', '#7cb84f'],
				parseTime: false
			});
			//Grafico Perimetros
			Morris.Bar({
				element: 'morris-bar-chart_perimetros_<?php echo $cliente_id; ?>',
				data: [
				<?php for ($i = 0; $i <= count($mediciones); $i++) { ?>
					<?php if(!empty($mediciones[$i]['fecha'])){ ?>	
					{ y: '<?php echo $mediciones[$i]['fecha']; ?>', a: <?php echo $mediciones[$i]['perimetro_cefalico']; ?>, b: <?php echo $mediciones[$i]['perimetro_cuello']; ?>, c: <?php echo $mediciones[$i]['perimetro_mesoesternal']; ?>, d: <?php echo $mediciones[$i]['perimetro_brazo_contraido']; ?>, e: <?php echo $mediciones[$i]['perimetro_brazo_relajado']; ?>, f: <?php echo $mediciones[$i]['perimetro_antebrazo']; ?>, g: <?php echo $mediciones[$i]['perimetro_muneca']; ?>, h: <?php echo $mediciones[$i]['perimetro_cintura']; ?>, i: <?php echo $mediciones[$i]['perimetro_cadera']; ?>, j: <?php echo $mediciones[$i]['perimetro_muslo']; ?>, k: <?php echo $mediciones[$i]['perimetro_pantorrilla']; ?>, l: <?php echo $mediciones[$i]['perimetro_tobillo']; ?>},
					<?php } ?>
				<?php } ?> ],
				xkey: 'y',
				ykeys: ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l'],
				labels: ['Cefálico', 'Cuello', 'Mesoesternal', 'Brazo contraído', 'Brazo relajado', 'Antebrazo', 'Muñeca', 'Cintura', 'Cadera', 'Muslo', 'Pantorrilla', 'Tobillo'],
				hideHover: 'auto',
				resize: true,
				barColors: ['#993291', '#7cb84f'],
				parseTime: false
			});
			<?php }  ?>
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
		<?php }  ?>
			
        });

    </script>	
	<?php $conn->close(); ?>
</body>
</html>
