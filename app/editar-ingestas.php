<?php
session_start();
include 'parts/conex.php';

$pagina = 'Editar Ingestas';
$migas = array('');
$migas_url = array('');

//Solo permitir acceso a estos roles
//$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';

$_SESSION['todas_las_recetas_desactivadas_por_el_usuario_sql']  = gx_todas_las_recetas_desactivadas_por_el_usuario_sql();


//Si hacen una busqueda avanzada
if(!empty($_POST['alimento'])){
	$alimento = $_POST['alimento'];
}else{
	$alimento = '';

}

?>
	<?php echo header_documento(); ?>
	<?php include 'parts/header.php'; ?>
	<link href="<?php echo $url_app; ?>css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
	<link href="<?php echo $url_app; ?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">
	<link href="<?php echo $url_app; ?>css/plugins/chosen/chosen.css" rel="stylesheet">
	<style>
	.table-responsive {
		overflow-x: hidden;
	}		
	.class_desayuno{
		background-color: rgb(249, 188, 1);
	}
	.class_media_manana{
		background-color: rgb(255,204,102);
	}
	.class_primer_plato_comida{
		background-color: rgb(197,192,0);
	}
	.class_plato_principal_comida{
		background-color: rgb(153,153,51);
	}
	.class_postre{
		background-color: rgb(153,0,51);
	}
	.class_merienda{
		background-color: rgb(244,176,132);
	}
	.class_primer_plato_cena{
		background-color: rgb(204,204,255);
	}
	.class_plato_principal_cena{
		background-color: rgb(151,151,255);
	}
	.class_recena{
		background-color: rgb(102,0,153);
	}
	.class_otros{
		background-color: rgb(235,121,75);
	}
	td{
		cursor: pointer;
	}
	#vinculo_desactivar_recetas, #vinculo_duplicar_recetas{
		display:none;
	}	
	#buscador_avanzado {
		visibility:hidden;
		position: absolute;
		height:0px;
	}	
	.color_transparente {
		opacity:0;
	}
	.dataTables_filter,
	.dataTables_info {
	  display: none;
	}

	</style>
</head>

<body class="<?php echo crear_textos_amigables($pagina); ?>">
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
		<div class="wrapper wrapper-content" style="padding-bottom:0px !important;">		
		<!-- Buscador -->
		<div class="row">
            <div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-content">
						<div class="row">							
							<div class="col-sm-2"><h5>Filtrar ingesta: </h5>																		
								<select id="filtro_ingesta" class="input-sm form-control input-s-sm inline" style="padding-top:0px;" name="grupo">						
									<option>Todos</option>
									<?php if(empty($_POST['alimento'])){ ?>
									<option selected>Desayuno</option>
									<?php }else{ ?>
									<option>Desayuno</option>
									<?php } ?>
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
							<form action="<?php echo $url_app; ?>editar-ingestas" method="post">		
							<div class="col-sm-3"><h5>Nombre del Alimento: </h5> 														
								<select data-placeholder="Buscar por alimento..." class="chosen-select" style="width:350px;" tabindex="2" name="alimento">
								<option value="">Buscar por alimento...</option>								
								<?php echo gx_selecct_alimientos(); ?>								
								</select>
							</div>							
							<div class="col-sm-2 m-b-xs">
								<button type="submit" class="btn btn-sm btn-primary" style="margin-top: 28px;"> Buscar!</button> 
							</div>
							</form>		
						</div>	
					</div>
				</div>
			</div>
		</div>	
		</div>	
		<!-- Fin buscador -->		
		<div class="wrapper wrapper-content animated fadeInRight">	
        <div class="row">
            <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">                           
                            <div class="table-responsive">							
								<br /><br />
								<?php if(!empty($alimento)){ ?>	
								<?php $recetas = gx_obtener_recetas_para_generar_dieta_filtro_alimento($alimento); ?>
								<?php }else{ ?>	
								<?php $recetas = gx_obtener_recetas_para_generar_dieta(); ?>
								<?php } ?>	
                                <table  id="example" class="table table-striped dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>Receta</th>
                                        <th>Desayuno</th>
                                        <th>Media mañana</th>
										<th>1ª plato Comida</th>
										<th>Plato principal comida</th>
										<th>Postre</th>										
										<th>Merienda</th>                                        
                                        <th>1ª plato Cena</th>										
                                        <th>Plato principal cena</th>                                        
                                        <th>Recena</th>
										<th>Otros</th>
										<th><span class="color_transparente">all ingestas</span></th>
                                    </tr>
                                    </thead>									
                                    <tbody>
										<?php foreach($recetas as $receta) { ?>
										<?php if(!empty($receta['fecha_creado']) && $receta['fecha_creado'] != '' && $receta['nombre'] != ''){ ?>
										<tr class="<?php echo $receta['id_receta']; ?>">	
											<td><?php echo utf8_encode($receta['nombre']); ?></td>
											<td code="<?php echo $receta['id_receta']; ?>" class="<?php $class_1 = strpos($receta['ingestas'], 'ingesta_7'); if(is_numeric($class_1)) { echo 'class_desayuno'; } ?>"></td>
											<td code="<?php echo $receta['id_receta']; ?>" class="<?php $class_2 = strpos($receta['ingestas'], 'ingesta_8'); if(is_numeric($class_2))  { echo 'class_media_manana'; } ?>"></td>
											<td code="<?php echo $receta['id_receta']; ?>" class="<?php $class_3 = strpos($receta['ingestas'], 'ingesta_9'); if(is_numeric($class_3))  { echo 'class_primer_plato_comida'; } ?>"></td>
											<td code="<?php echo $receta['id_receta']; ?>" class="<?php $class_4 = strpos($receta['ingestas'], 'ingesta_19'); if(is_numeric($class_4))  { echo 'class_plato_principal_comida'; } ?>"></td>
											<td code="<?php echo $receta['id_receta']; ?>" class="<?php $class_5 = strpos($receta['ingestas'], 'ingesta_21'); if(is_numeric($class_5))  { echo 'class_postre'; } ?>"></td>
											<td code="<?php echo $receta['id_receta']; ?>" class="<?php $class_6 = strpos($receta['ingestas'], 'ingesta_10'); if(is_numeric($class_6))  { echo 'class_merienda'; } ?>"></td>
											<td code="<?php echo $receta['id_receta']; ?>" class="<?php $class_7 = strpos($receta['ingestas'], 'ingesta_11'); if(is_numeric($class_7))  { echo 'class_primer_plato_cena'; } ?>"></td>
											<td code="<?php echo $receta['id_receta']; ?>" class="<?php $class_8 = strpos($receta['ingestas'], 'ingesta_20'); if(is_numeric($class_8))  { echo 'class_plato_principal_cena'; } ?>"></td>
											<td code="<?php echo $receta['id_receta']; ?>" class="<?php $class_9 = strpos($receta['ingestas'], 'ingesta_12'); if(is_numeric($class_9))  { echo 'class_recena'; } ?>"></td>
											<td code="<?php echo $receta['id_receta']; ?>" class="<?php $class_10 = strpos($receta['ingestas'], 'ingesta_18'); if(is_numeric($class_10))  { echo 'class_otros'; } ?>"></td>
											<td code="<?php echo $receta['id_receta']; ?>" class="all_ingestas"><span class="color_transparente"><?php echo $receta['all_ingestas']; ?></span></td>
										</tr>
										<?php } ?>
										<?php } ?>
                                    </tbody>
                                </table>															
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
	<script src="<?php echo $url_app; ?>js/plugins/chosen/chosen.jquery.js"></script>
	<?php include 'js/idiet.php'; ?>
	<?php $conn->close(); ?>
</body>
</html>


