<?php
session_start();
include 'parts/conex.php';
$pagina = 'Dieta';
$migas = array('Lista Clientes');
$migas_url = array('lista-clientes');

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';

$cliente_id = $_POST["cliente_id"];
if(empty($cliente_id)){
	$_SESSION['mensaje'] = 'datos_vacios';	
	header('location:'.$url_app.'lista-clientes');
}

$cliente = obtener_datos_cliente_x_usuario ($cliente_id);	


//Iniciamos las variables
$error = 'no';
if(empty($_POST["usar_plantilla"])){
	
	$duracion 				= $_POST["duracion"];
	$num_comidas			= $_POST["num_comidas"];
	$platos_comidas 		= $_POST["platos_comidas"]; 
	$comida_postre 			= $_POST["comida_postre"];
	$plato_cena 			= $_POST["plato_cena"];
	$cena_postre 			= $_POST["cena_postre"];
	$fecha_inicio 			= $_POST["fecha_inicio"];
	$kilocalorias_dia 		= $_POST["kilocalorias_dia"];
	$grasas_diarias 		= $_POST["grasas_diarias"];
	$proteinas_diarias 		= $_POST["proteinas_diarias"];
	$hidratos_diarios 		= $_POST["hidratos_diarios"];
	$limitar_tamano 		= $_POST["limitar_tamano"];	
	$listado_plantillas 	= 'sin plantilla';
	
	//->Total Maximo de dias
	if($duracion >= 30){
		$total_dias_dieta = 30;
	}else{
		$total_dias_dieta = $duracion;
	}
	//Generamos plato libre
	$plato_libre = plato_libre();
	
	//Obtenemos los super grupos
	$super_grupos = gx_obtener_supergrupos();
	
	
	generarEstadisticas($num_comidas);
	
	$recetas = obtener_recetas_para_generar_dieta();
	
	//Platos Comidas
	$postre = '';
	$desayuno = '';
	$plato_principal_comida = ''; 
	
	
	for ($i = 0; $i <= count($recetas); $i++) {
		// echo $recetas[$i]['ingestas'];
		if(!empty($recetas[$i]['ingestas'])){
			
			//->Desayuno
			$si_existe_desayuno = strpos($recetas[$i]['ingestas'], 'ingesta_7');
			if (is_numeric($si_existe_desayuno)) {
				$desayuno[] = $recetas[$i];
			}

			//->Media manana
			if($num_comidas >= 5){			
				$si_existe_media_manana = strpos($recetas[$i]['ingestas'], 'ingesta_8');
				if (is_numeric($si_existe_media_manana)) {
					$media_manana[] = $recetas[$i];
				}
			}
			
			//->Primer plato comida
			if($platos_comidas == 2){			
				$si_existe_primer_plato_comida = strpos($recetas[$i]['ingestas'], 'ingesta_9');
				if (is_numeric($si_existe_primer_plato_comida)) {
					$primer_plato_comida[] = $recetas[$i];
				}
			}
			
			//->Plato Principal comida
			$si_existe_pp_comida = strpos($recetas[$i]['ingestas'], 'ingesta_19');
			if (is_numeric($si_existe_pp_comida)) {
				$plato_principal_comida[] = $recetas[$i];
			}
			
			//->Merienda
			if($num_comidas >= 4){			
				$si_existe_merienda = strpos($recetas[$i]['ingestas'], 'ingesta_10');
				if (is_numeric($si_existe_merienda)) {
					$merienda[] = $recetas[$i];
				}
			}
			//->Primer plato cena
			if($plato_cena == 2){ 			
				$si_existe_primer_plato_cena = strpos($recetas[$i]['ingestas'], 'ingesta_11');
				if (is_numeric($si_existe_primer_plato_cena)) {
					$primer_plato_cena[] = $recetas[$i];
				}
			}
			
			//->Plato principal cena
			$si_existe_plato_principal_cena = strpos($recetas[$i]['ingestas'], 'ingesta_20');
			if (is_numeric($si_existe_plato_principal_cena)) {
				$plato_principal_cena[] = $recetas[$i];
			}
			
			//->Recena
			if($num_comidas >= 6){				
				$si_existe_recena = strpos($recetas[$i]['ingestas'], 'ingesta_12');
				if (is_numeric($si_existe_recena)) {
					$recena[] = $recetas[$i];
				}
			}
			if($cena_postre == 'si' || $comida_postre == 'si'){
				$si_existe_postre = strpos($recetas[$i]['ingestas'], 'ingesta_21');
				if (is_numeric($si_existe_postre)) {
					$postre_comida[] = $recetas[$i];
					$postre_cena[]	 = $recetas[$i];
				}
			}	
		}		
	}
	
	//Desordenamos los arrays
	shuffle($desayuno);
	shuffle($plato_principal_comida);
	if($num_comidas >= 5){
		shuffle($media_manana);
	}
	if($platos_comidas == 2){
		shuffle($primer_plato_comida);
	}
	if($num_comidas >= 4){
		shuffle($merienda);
	}
	if($plato_cena == 2){
		shuffle($primer_plato_cena);
	}
	shuffle($plato_principal_cena);
	
		shuffle($recena);
	if($num_comidas >= 6){	
	}
	
	if($cena_postre == 'si' || $comida_postre == 'si'){
		shuffle($postre_comida);
		shuffle($postre_cena);	
	}
				
		
	//->Sin postres
	if(empty($postre_comida) AND $comida_postre == 'si' || empty($postre_comida) AND $cena_postre == 'si'){ 
		$error = 'si';
		$_SESSION['mensaje'] = 'sin_postre';	
		header('location:'.$url_app.'configurar-dieta/'.$cliente_id);
	}
	
	
}else{
	
}

//Dividir en semanas
$semana= '';
$total_semanas = $duracion/7;
$total_semanas_sliders = ceil($total_semanas);
$total_dias_asignados  = '';	
for ($i = 1; $i <= $total_semanas+1; $i++) {
	// $semana[$total_semanas] = $duracion-($total_semanas*7);
	$semana[$i]['semana']= $i;
	if($duracion+7-($i*7) >= 7) {
		$semana[$i]['dias']= 7; 
		$total_dias_asignados += 7; 
	}else{		
		// $semana[$i]['dias']=  abs($duracion-($i*7)); 	
		$semana[$i]['dias']=  abs($duracion-$total_dias_asignados); 	
	}

}

 
?>
	<?php echo header_documento(); ?>
	<?php include 'parts/header.php'; ?>	
	<link href="<?php echo $url_app; ?>css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
	<link href="<?php echo $url_app; ?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">
	<link href="<?php echo $url_app; ?>css/plugins/chosen/chosen.css" rel="stylesheet">	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>

	<style>
	.table-responsive {
		overflow-x: hidden;
	}
	#example_filter, example_length{
		display:none;
	}
	.gramos_title {
		text-align: center;
		width: 50px;
		right: 10px;
		float: right;		
	}
	.gramos {
		text-align: right;			
		right: 0px;
		float: right;
		padding-right: 21px;	
	}
	.detalle_comida{
		float: left;
		left: 0px;
	}
	.ibox-tools {		
		float: right;
		right: 36px;
		position: absolute;
		font-size: 24px;
		top: 9px;
	}
	.ibox-tools a {
		color: #81d742;
		padding-right: 21px;
	}
	.ibox-tools a:hover {
		color: #6eb33c;
	}
	tfoot tr th{
		text-align: right;
		padding-right: 30px !important;
	}	
	.btn-info.btn-outline {
		background: #772e71;
		color: white;
		min-width: 250px;
		border-color: transparent;		
		font-weight: 600;
	}
	.input_peso{
		min-width: 250px;
	}
	td+td{
		cursor:pointer;
	}
	td+td:hover {
		background-color: #81d74266;	
	}

	#div_pegar, #div_modificar_peso_input, .pdf_opciones_avanzadas, .pdf_opciones_avanzadas_2{
		display:none;
	}
	.btn-info.btn-outline:focus {
	    background-color: #a2439b;
		border-color: #a2439b;
	}
	.btn-info {
		margin-top:10px;
	}
	.block_td {
		background-color: #772e714a;		
	}
	#vinculo_imprimir_dieta, #vinculo_enviar_correo{ 
		text-decoration: none;
		cursor: default;
		opacity: 0.5; 
	}
	
	.ok{
		color: #80d741;
	}
	#mensaje_guardar_plantilla{
	    color: red;
		font-weight: 600;
		padding-top: 25px;
	}
	.js-example-basic-single{
		z-index: 3051;
	}
	.derecha_f {
		float:left;
		cursor:pointer;
	}
	body {
		padding: 0px !important;
	}
	.pdf_botones {	    
		font-size: 14px;
		float: left;
		padding-right: 5px;
		padding-top: 3px;
	}
	.porcentaje_malo{
		color: red;
		font-weight: 800;
	}
	.porcentaje_bueno{
		color: #89c546;
		font-weight: 800;
	}
	.porcentaje_standar{
		color: #772e71;
		font-weight: 800;
	}
	#pdf_listado_vertical{						
		display:none;
	}	
	#lista_definitiva_alimentos{
		display:none;
	}
	</style>
</head>
<?php

// Semana <a href="#contenedor_slider" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>1 de 3 <a href="#contenedor_slider" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
?>
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
			<?php echo migas_de_pan($pagina.' '.date('d/m/Y'), $migas, $migas_url, ''); ?>                
            </div>
		<div class="wrapper wrapper-content" style="padding-bottom: 0px;">	
		<!-- Buscador -->
		<div id="respuesta"></div>
		<form id="formulario_completo" action="<?php echo $url_app; ?>dieta" method="post">						
		<div class="row"> 				
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5><strong>Cliente:</strong> <?php echo $cliente['apellidos'].', '.$cliente['nombre']; ?> </h5>	
						<div class="ibox-tools">
							<a id="vinculo_actualizar_dieta" href="#" title="Generar nueva dieta">
								<i class="fa fa-refresh" aria-hidden="true"></i>
                            </a>
                            <a id="vinculo_guardar_dieta" href="#" title="Guardar dieta">
								<i class="fa fa-floppy-o" aria-hidden="true"></i>
                            </a>
                            <a id="vinculo_guardar_plantilla_dieta" href="#" title="Guardar plantilla">
								<i class="fa fa-address-card-o" aria-hidden="true"></i>
                            </a>
                            <a id="vinculo_imprimir_dieta" href="#" title="Imprimir dieta">
								<i class="fa fa-print" aria-hidden="true"></i>
                            </a>
                            <a  id="vinculo_enviar_correo" href="#" title="Enviar dieta por correo">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                            </a>
                        </div>
					</div>					
					<div id="contenedor_slider" class="carousel slide" data-ride="carousel" data-type="multi" data-interval="false">
					<div class="carousel-inner">
					<!-- Semana 1 -->	
					<?php for ($s = 1; $s <= $total_semanas_sliders; $s++) { ?>
					<?php $total_fila = ''; ?>
					<div class="ibox-content item <?php if($s == 1){  echo 'active';  }else { }?>">
						<h3>Semana <?php echo flecha_prev ($semana[$s]['semana'], $total_semanas_sliders ); ?> de <?php echo flecha_next ($semana[$s]['semana'], $total_semanas_sliders ); ?></h3>
						<table id="example" class="table table-striped dataTables-example tabla_semana_<?php echo $s; ?>">
							<thead>
							  <tr>
								<th>Tipo de comida</th>
								<?php for ($i = 1; $i <= $semana[$s]['dias']; $i++) { ?>
								<th>Dia <?php echo $i; ?> <span class="gramos_title">g</span></th>		
								<?php $pdf_dias[$i]['dia']= $i; ?>
								<?php } ?>
							  </tr>
							</thead>							
							<tbody>
								<tr>
									<td>Desayuno</td>
									<?php for ($i = 1; $i <= $semana[$s]['dias']; $i++) { ?>
									<?php $total_desayuno = count($desayuno)-1; ?>
									<?php $ronda = rand(0,$total_desayuno); ?>
									<?php $mostrar_desayuno = gx_calculo_kcal_dieta('desayuno', $kilocalorias_dia, $num_comidas, $platos_comidas, $plato_cena, $comida_postre, $cena_postre, $desayuno[$ronda]['kcal_por_100g']); ?>	
									<td data-toggle="modal" data-target="#listado_opciones"  class="id_receta_<?php echo $desayuno[$ronda]['id_receta']; ?>" kcal="<?php echo $mostrar_desayuno['kcal']; ?>" kcal_original="<?php echo $mostrar_desayuno['kcal']; ?>">
									<p class="detalle_comida"><?php echo utf8_encode(contar_texto(($desayuno[$ronda]['nombre']))); ?></p>									
									<p class="gramos"><i><?php echo $mostrar_desayuno['gramos']; ?></i> g</p>										
									</td>
									<?php $pdf_desayuno_ronda[] = $ronda; ?>
									<?php $pdf_desayuno_ids[] = $desayuno[$ronda]['id_receta']; ?>
									<?php $pdf_desayuno_nombre[] = utf8_encode($desayuno[$ronda]['nombre']); ?>
									<?php $pdf_desayuno_descripcion[] = $desayuno[$ronda]['descripcion']; ?>	
									<?php $pdf_desayuno_gramos[] = $mostrar_desayuno['gramos']; ?>									
									<?php } ?>
								</tr>
								<?php if($num_comidas >= 5) {?>
								<tr>
									<td>Media mañana</td>
									<?php for ($i = 1; $i <= $semana[$s]['dias']; $i++) { ?>	
									<?php $total_media_manana = count($media_manana)-1; ?>									
									<?php $ronda = rand(0,$total_media_manana); ?>		
									<?php $mostrar_media_manana  =  gx_calculo_kcal_dieta('media_manana', $kilocalorias_dia, $num_comidas, $platos_comidas, $plato_cena, $comida_postre, $cena_postre, $media_manana[$ronda]['kcal_por_100g']); ?>
									<td data-toggle="modal" data-target="#listado_opciones" class="id_receta_<?php echo $media_manana[$ronda]['id_receta']; ?>" kcal="<?php echo $mostrar_media_manana['kcal']; ?>"  kcal_original="<?php echo $mostrar_media_manana['kcal']; ?>">
									<p class="detalle_comida"><?php echo utf8_encode(contar_texto(($media_manana[$ronda]['nombre']))); ?></p>																		
									<p class="gramos"><i><?php echo $mostrar_media_manana['gramos']; ?></i> g</p>
									</td>
									<?php $pdf_media_manana_ronda[] = $ronda; ?>
									<?php $pdf_media_manana_ids[] = $media_manana[$ronda]['id_receta']; ?>
									<?php $pdf_media_manana_nombre[] = utf8_encode($media_manana[$ronda]['nombre']); ?>
									<?php $pdf_media_manana_descripcion[] = $media_manana[$ronda]['descripcion']; ?>	
									<?php $pdf_media_manana_gramos[] =  $mostrar_media_manana['gramos']; ?>	
									<?php } ?>
								</tr>
								<?php } ?>
								<?php if($platos_comidas == 2) {?>
								<tr>
									<td>Primer plato comida</td>
									<?php for ($i = 1; $i <= $semana[$s]['dias']; $i++) { ?>									
									<?php $total_primer_plato_comida = count($primer_plato_comida)-1; ?>
									<?php $ronda = rand(0,$total_primer_plato_comida); ?>	
									<?php $mostrar_primer_plato_comida  =  gx_calculo_kcal_dieta('primer_plato_comida', $kilocalorias_dia, $num_comidas, $platos_comidas, $plato_cena, $comida_postre, $cena_postre, $primer_plato_comida[$ronda]['kcal_por_100g']); ?>
									<td data-toggle="modal" data-target="#listado_opciones" class="id_receta_<?php echo $primer_plato_comida[$ronda]['id_receta']; ?>" kcal="<?php echo $mostrar_primer_plato_comida['kcal']; ?>" kcal_original="<?php echo $mostrar_primer_plato_comida['kcal']; ?>">
									<p class="detalle_comida"><?php echo utf8_encode(contar_texto(($primer_plato_comida[$ronda]['nombre']))); ?></p>
									<p class="gramos"><i><?php echo $mostrar_primer_plato_comida['gramos']; ?></i> g</p>									
									</td>	
									<?php $pdf_primer_plato_comida_ronda[] = $ronda; ?>
									<?php $pdf_primer_plato_comida_ids[] = $primer_plato_comida[$ronda]['id_receta']; ?>
									<?php $pdf_primer_plato_nombre[] = utf8_encode($primer_plato_comida[$ronda]['nombre']); ?>
									<?php $pdf_primer_plato_descripcion[] = $primer_plato_comida[$ronda]['descripcion']; ?>	
									<?php $pdf_primer_plato_comida_gramos[] =  $mostrar_primer_plato_comida['gramos']; ?>		
									<?php } ?>
								</tr>
								<?php } ?>
								<tr>
									<td>Plato principal comida</td>
									<?php for ($i = 1; $i <= $semana[$s]['dias']; $i++) { ?>									
									<?php $total_plato_principal_comida = count($plato_principal_comida)-1; ?>			
									<?php $ronda = rand(0,$total_plato_principal_comida); ?>	
									<?php $mostrar_plato_principal_comida  =  gx_calculo_kcal_dieta('plato_principal_comida', $kilocalorias_dia, $num_comidas, $platos_comidas, $plato_cena, $comida_postre, $cena_postre, $plato_principal_comida[$ronda]['kcal_por_100g']); ?>	
									<td data-toggle="modal" data-target="#listado_opciones" class="id_receta_<?php echo $plato_principal_comida[$ronda]['id_receta']; ?>" kcal="<?php echo $mostrar_plato_principal_comida['kcal']; ?>"  kcal_original="<?php echo $mostrar_plato_principal_comida['kcal']; ?>">
									<p class="detalle_comida"><?php echo utf8_encode(contar_texto(($plato_principal_comida[$ronda]['nombre']))); ?></p>																		
									<p class="gramos"><i><?php echo $mostrar_plato_principal_comida['gramos']; ?></i> g</p>
									</td>
									<?php $pdf_plato_principal_ronda[] = $ronda; ?>
									<?php $pdf_plato_principal_ids[] = $plato_principal_comida[$ronda]['id_receta']; ?>
									<?php $pdf_plato_principal_nombre[] = utf8_encode($plato_principal_comida[$ronda]['nombre']); ?>
									<?php $pdf_plato_principal_descripcion[] = $plato_principal_comida[$ronda]['descripcion']; ?>	
									<?php $pdf_plato_principal_gramos[] =  $mostrar_plato_principal_comida['gramos']; ?>		
									<?php } ?>
								</tr>
								<?php if(!empty($_POST["comida_postre"])) {?>
								<tr>
									<td>Postre comida</td>
									<?php for ($i = 1; $i <= $semana[$s]['dias']; $i++) { ?>										
									<?php $total_postre_comida = count($postre_comida)-1; ?>			
									<?php $ronda = rand(0,$total_postre_comida); ?>	
									<?php $mostrar_postre_comida  =  gx_calculo_kcal_dieta('postre_comida', $kilocalorias_dia, $num_comidas, $platos_comidas, $plato_cena, $comida_postre, $cena_postre, $postre_comida[$ronda]['kcal_por_100g']); ?>		
									<td data-toggle="modal" data-target="#listado_opciones" class="id_receta_<?php echo $postre_comida[$ronda]['id_receta']; ?>" kcal="<?php echo $mostrar_postre_comida['kcal']; ?>" kcal_original="<?php echo $mostrar_postre_comida['kcal']; ?>">
									<p class="detalle_comida"><?php echo utf8_encode(contar_texto(($postre_comida[$ronda]['nombre']))); ?></p>																		
									<p class="gramos"><i><?php echo $mostrar_postre_comida['gramos']; ?></i> g</p>
									</td>
									<?php $pdf_postre_comida_ronda[] = $ronda; ?>
									<?php $pdf_postre_comida_ids[] = $postre_comida[$ronda]['id_receta']; ?>
									<?php $pdf_postre_comida_nombre[] = utf8_encode($postre_comida[$ronda]['nombre']); ?>
									<?php $pdf_postre_comida_descripcion[] = $postre_comida[$ronda]['descripcion']; ?>	
									<?php $pdf_postre_comida_gramos[] =  $mostrar_postre_comida['gramos']; ?>		
									<?php } ?>
								</tr>
								<?php } ?>
								<?php if($num_comidas >= 4) {?>
								<tr>
									<td>Merienda</td>
									<?php for ($i = 1; $i <= $semana[$s]['dias']; $i++) { ?>
									<?php $total_merienda = count($merienda)-1; ?>			
									<?php $ronda = rand(0,$total_merienda); ?>
									<?php $mostrar_merienda  =  gx_calculo_kcal_dieta('merienda', $kilocalorias_dia, $num_comidas, $platos_comidas, $plato_cena, $comida_postre, $cena_postre, $merienda[$ronda]['kcal_por_100g']); ?>			
									<td data-toggle="modal" data-target="#listado_opciones" class="id_receta_<?php echo $merienda[$ronda]['id_receta']; ?>"  kcal="<?php echo $mostrar_merienda['kcal']; ?>"   kcal_original="<?php echo $mostrar_merienda['kcal']; ?>">
									<p class="detalle_comida"><?php echo utf8_encode(contar_texto(($merienda[$ronda]['nombre']))); ?></p>									
									<p class="gramos"><i><?php echo $mostrar_merienda['gramos']; ?></i> g</p>
									</td>	
									<?php $pdf_merienda_ronda[] = $ronda; ?>
									<?php $pdf_merienda_ids[] = $merienda[$ronda]['id_receta']; ?>
									<?php $pdf_merienda_nombre[] = utf8_encode($merienda[$ronda]['nombre']); ?>
									<?php $pdf_merienda_descripcion[] = $merienda[$ronda]['descripcion']; ?>
									<?php $pdf_merienda_gramos[] =  $mostrar_merienda['gramos']; ?>		
									<?php } ?>
								</tr>
								<?php } ?>
								<?php if($plato_cena == 2) {?>
								<tr>
									<td>Primer plato cena</td>
									<?php for ($i = 1; $i <= $semana[$s]['dias']; $i++) { ?>
									<?php $total_primer_plato_cena = count($primer_plato_cena)-1; ?>			
									<?php $ronda = rand(0,$total_primer_plato_cena); ?>
									<?php $mostrar_primer_plato_cena  =  gx_calculo_kcal_dieta('primer_plato_cena', $kilocalorias_dia, $num_comidas, $platos_comidas, $plato_cena, $comida_postre, $cena_postre, $primer_plato_cena[$ronda]['kcal_por_100g']); ?>				
									<td data-toggle="modal" data-target="#listado_opciones" class="id_receta_<?php echo $primer_plato_cena[$ronda]['id_receta']; ?>" kcal="<?php echo $mostrar_primer_plato_cena['kcal']; ?>"  kcal_original="<?php echo $mostrar_primer_plato_cena['kcal']; ?>">
									<p class="detalle_comida"><?php echo utf8_encode(contar_texto(($primer_plato_cena[$ronda]['nombre']))); ?></p>																		
									<p class="gramos"><i><?php echo $mostrar_primer_plato_cena['gramos']; ?></i> g</p>
									</td>	
									<?php $pdf_primer_plato_cena_ronda[] = $ronda; ?>
									<?php $pdf_primer_plato_cena_ids[] = $primer_plato_cena[$ronda]['id_receta']; ?>
									<?php $pdf_primer_plato_cena_nombre[] = utf8_encode($primer_plato_cena[$ronda]['nombre']); ?>
									<?php $pdf_primer_plato_cena_descripcion[] = $primer_plato_cena[$ronda]['descripcion']; ?>
									<?php $pdf_primer_plato_cena_gramos[] =  $mostrar_primer_plato_cena['gramos']; ?>		
									<?php } ?>
								</tr>
								<?php } ?>
								<tr>
									<td>Plato principal cena</td>
									<?php for ($i = 1; $i <= $semana[$s]['dias']; $i++) { ?>
									<?php $total_plato_principal_cena = count($plato_principal_cena)-1; ?>			
									<?php $ronda = rand(0,$total_plato_principal_cena); ?>	
									<?php $mostrar_plato_principal_cena  =  gx_calculo_kcal_dieta('plato_principal_cena', $kilocalorias_dia, $num_comidas, $platos_comidas, $plato_cena, $comida_postre, $cena_postre, $plato_principal_cena[$ronda]['kcal_por_100g']); ?>				
									<td data-toggle="modal" data-target="#listado_opciones" class="id_receta_<?php echo $plato_principal_cena[$ronda]['id_receta']; ?>" kcal="<?php echo $mostrar_plato_principal_cena['kcal']; ?>"  kcal_original="<?php echo $mostrar_plato_principal_cena['kcal']; ?>">
									<p class="detalle_comida"><?php echo utf8_encode(contar_texto(($plato_principal_cena[$ronda]['nombre']))); ?></p>																		
									<p class="gramos"><i><?php echo $mostrar_plato_principal_cena['gramos']; ?></i> g</p>
									</td>
									<?php $pdf_plato_principal_cena_ronda[] = $ronda; ?>
									<?php $pdf_plato_principal_cena_ids[] = $plato_principal_cena[$ronda]['id_receta']; ?>
									<?php $pdf_plato_principal_cena_nombre[] = utf8_encode($plato_principal_cena[$ronda]['nombre']); ?>
									<?php $pdf_plato_principal_cena_descripcion[] = $plato_principal_cena[$ronda]['descripcion']; ?>
									<?php $pdf_plato_principal_cena_gramos[] =  $mostrar_plato_principal_cena['gramos']; ?>	
									<?php } ?>
								</tr>
								<?php if(!empty($_POST["cena_postre"])) {?>
								<tr>
									<td>Postre cena</td>									
									<?php for ($i = 1; $i <= $semana[$s]['dias']; $i++) { ?>
									<?php $total_postre_cena = count($postre_cena)-1; ?>			
									<?php $ronda = rand(0,$total_postre_cena); ?>	
									<?php $mostrar_postre_cena  =  gx_calculo_kcal_dieta('postre_cena', $kilocalorias_dia, $num_comidas, $platos_comidas, $plato_cena, $comida_postre, $cena_postre, $postre_cena[$ronda]['kcal_por_100g']); ?>				
									<td data-toggle="modal" data-target="#listado_opciones" class="id_receta_<?php echo $postre_cena[$ronda]['id_receta']; ?>" kcal="<?php echo $mostrar_postre_cena['kcal']; ?>"  kcal_original="<?php echo $mostrar_postre_cena['kcal']; ?>">
									<p class="detalle_comida"><?php echo utf8_encode(contar_texto(($postre_cena[$ronda]['nombre']))); ?></p>																		
									<p class="gramos"><i><?php echo $mostrar_postre_cena['gramos']; ?></i> g</p>
									</td>
									<?php $pdf_postre_cena_ronda[] = $ronda; ?>
									<?php $pdf_postre_cena_ids[] = $postre_cena[$ronda]['id_receta']; ?>
									<?php $pdf_postre_cena_nombre[] = utf8_encode($postre_cena[$ronda]['nombre']); ?>
									<?php $pdf_postre_cena_descripcion[] = $postre_cena[$ronda]['descripcion']; ?>
									<?php $pdf_postre_cena_gramos[] =  $mostrar_postre_cena['gramos']; ?>		
									<?php } ?>
								</tr>
								<?php } ?>
								<?php if($num_comidas >= 6) {?>
								<tr>
									<td>Recena</td>
									<?php for ($i = 1; $i <= $semana[$s]['dias']; $i++) { ?>									
									<?php $ronda_recena = rand(0, count($recena)-1); ?>	
									<?php $mostrar_recena  =  gx_calculo_kcal_dieta('recena', $kilocalorias_dia, $num_comidas, $platos_comidas, $plato_cena, $comida_postre, $cena_postre, $recena[$ronda]['kcal_por_100g']); ?>				
									<td data-toggle="modal" data-target="#listado_opciones" class="id_receta_<?php echo $recena[$ronda]['id_receta']; ?>" kcal="<?php echo $mostrar_recena['kcal']; ?>" kcal_original="<?php echo $mostrar_recena['kcal']; ?>">
									<p class="detalle_comida"><?php echo utf8_encode(contar_texto(($recena[$ronda_recena]['nombre']))); ?></p>																		
									<p class="gramos"><i><?php echo $mostrar_recena['gramos']; ?></i> g</p>
									</td>									
									<?php $pdf_recena_ronda[] = $ronda_recena; ?>
									<?php $pdf_recena_cena_ids[] = $recena[$ronda]['id_receta']; ?>
									<?php $pdf_recena_cena_nombre[] = utf8_encode($recena[$ronda]['nombre']); ?>
									<?php $pdf_recena_cena_descripcion[] = $recena[$ronda]['descripcion']; ?>
									<?php $pdf_recena_gramos[] =  $mostrar_recena['gramos']; ?>	
									<?php } ?>
								</tr>
								<?php } ?>
							</tbody>
							<tfoot>
								<tr>
									<th class="pdf_eliminar"></th>
									<?php for ($i = 1; $i <= $semana[$s]['dias']; $i++) { ?>
									<th class="pdf_eliminar"><i><?php echo $kilocalorias_dia; ?> </i> kcal</th>
									<?php } ?>
								</tr>
							</tfoot>
					  </table>	
					</div>
					<?php } ?>
					<!-- Fin Semana 1 -->						
					</div>
					</div>					
					<!-- fin contenedor del slider -->					
				</div>
			</div>		
		</form>	
		<!-- Fin buscador --> 
		<!-- Modal Opciones Comida -->
		<div id="listado_opciones" class="modal fade charts-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		  <div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel">Opciones:</h4>
				</div>
				<div class="text-center">
					<div class="row" id="div_copiar"> 				
						<div class="col-lg-12">
							<button type="button" id="btn_copiar" class="btn btn-outline btn-info">Copiar</button>
						</div>
					</div>
					<div class="row" id="div_pegar"> 				
						<div class="col-lg-12 text-center">
							<button type="button" id="btn_pegar" class="btn btn-outline btn-info">Pegar</button>
						</div>
					</div>
					<div class="row" id="div_aplicar_toda_dieta"> 				
						<div class="col-lg-12">
							<button type="button" id="btn_aplicar_toda_dieta" class="btn btn-outline btn-info">Aplicar a toda la dieta</button>
						</div>
					</div>
					<div class="row" id="div_bloquear_desbloquear"> 				
						<div class="col-lg-12">
							<button type="button" id="btn_bloquear_desbloquear" class="btn btn-outline btn-info">Bloquear/Desbloquear</button>
						</div>
					</div>
					<div class="row" id="div_ver_informacion"> 				
						<div class="col-lg-12">
							<button type="button" id="btn_ver_informacion" class="btn btn-outline btn-info">Ver información de la receta</button>
						</div>
					</div>
					<div class="row" id="div_buscar_plato_equi"> 				
						<div class="col-lg-12">
							<button type="button" id="btn_buscar_plato_equi" class="btn btn-outline btn-info">Buscar receta equivalente</button>
						</div>
					</div>
					<div class="row" id="div_marcar_libre"> 				
						<div class="col-lg-12">
							<button type="button" id="btn_marcar_libre" class="btn btn-outline btn-info">Marcar como libre</button>
						</div>
					</div>
					<div class="row" id="div_modificar_peso"> 				
						<div class="col-lg-12">
							<button type="button" id="btn_modificar_peso" class="btn btn-outline btn-info">Modificar peso de comida</button>
						</div>
					</div>	
					<div class="row" id="div_modificar_peso_input"> 				
						<div class="col-lg-2"></div>
						<div class="col-lg-8 text-center">
							<br/>
							<p>Modificar el peso de esta comida desajustará la ingesta calórica para ese día ¿Desea continuar?</p>							
							<input id="nuevo_peso_input" name="nuevo_peso_input" type="number" class="input_peso input-sm form-control" placeholder="Nuevo peso gr" max="50000" required><br />
							<a  href="#" class="btn btn-w-m btn-atras" style="width: 150px; " data-dismiss="modal" >Cancelar</a> <a id="link_modificar_peso" href="#" class="btn btn-outline btn-info" style="width: 150px; margin-left: 30px; min-width: auto; margin-top: 0px; ">Agregar</a>	
							<br/><br/><br/>
						</div>
						<div class="col-lg-2"></div>
					</div>
					<br><br><br>
				</div>
				<div id="area-example"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				</div>    
			</div>
		  </div>
		</div>
		<!-- Fin Modal Opciones Comida -->	
		<!-- Modal guardar Temporal -->
		<div id="modal_guardar_temporal" class="modal fade charts-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		  <div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel">Guardar Dieta</h4>
				</div>
				<div class="text-center">
					<div class="row" id="div_copiar"> 				
						<div class="col-lg-12">	
							<br /><br />
							<form id="formulario_guardar_dieta" action="#" method="post">						
							<a id="guardar_dieta_temporal" class="btn btn-outline btn-info">Guardar</a>
							<?php if(empty($_POST["usar_plantilla"])){ ?>
							<input type="hidden" id="temporal_plantilla" name="temporal_plantilla" value="no">
							<input type="hidden" id="temporal_id_cliente" name="temporal_id_cliente" value="<?php echo $cliente_id; ?>">
							<input type="hidden" id="temporal_duracion" name="temporal_duracion" value="<?php echo $duracion; ?>">
							<input type="hidden" id="temporal_num_comidas" name="temporal_num_comidas" value="<?php echo $num_comidas; ?>">
							<input type="hidden" id="temporal_platos_comidas" name="temporal_platos_comidas" value="<?php echo $platos_comidas; ?>">
							<input type="hidden" id="temporal_comida_postre" name="temporal_comida_postre" value="<?php echo $comida_postre; ?>">
							<input type="hidden" id="temporal_plato_cena" name="temporal_plato_cena" value="<?php echo $plato_cena; ?>">
							<input type="hidden" id="temporal_cena_postre" name="temporal_cena_postre" value="<?php echo $cena_postre; ?>">
							<input type="hidden" id="temporal_fecha_inicio" name="temporal_fecha_inicio" value="<?php echo $fecha_inicio; ?>">
							<input type="hidden" id="temporal_kilocalorias_dia" name="temporal_kilocalorias_dia" value="<?php echo $kilocalorias_dia; ?>">
							<input type="hidden" id="temporal_grasas_diarias" name="temporal_grasas_diarias" value="<?php echo $grasas_diarias; ?>">
							<input type="hidden" id="temporal_proteinas_diarias" name="temporal_proteinas_diarias" value="<?php echo $proteinas_diarias; ?>">
							<input type="hidden" id="temporal_hidratos_diarios" name="temporal_hidratos_diarios" value="<?php echo $hidratos_diarios; ?>">
							<input type="hidden" id="temporal_limitar_tamano" name="temporal_limitar_tamano" value="<?php echo $limitar_tamano; ?>">
							<input type="hidden" id="temporal_listado_plantillas" name="temporal_listado_plantillas" value="<?php echo $listado_plantillas; ?>">
							<input type="hidden" id="temporal_dieta_plantilla" name="temporal_dieta_plantilla" value="">
							<input type="hidden" id="pdf_input_listado_vertical" name="pdf_input_listado_vertical" value="">	
							<input type="hidden" id="temporal_lista_de_compra" name="temporal_lista_de_compra" value="">	
							<input type="hidden" id="tabla_semana_1" name="tabla_semana_1" value="">						
							<?php } ?>
							</form> 
							<br /><br />
						</div>
					</div>						
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				</div>    
			</div>
		  </div>
		</div>
		<!-- Fin Modal Guardar Temporal -->	
		<!-- Modal guardar plantilla -->
		<div id="modal_guardar_plantilla" class="modal fade charts-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		  <div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel">Guardar Plantilla Dieta</h4>
				</div>
				<div class="text-center">
					<div class="row" id="div_copiar"> 				
						<div class="col-lg-12">	
							<br /><br />
							<form id="formulario_guardar_plantilla_dieta" action="#" method="post">	
							<div class="row">	
								<div class="col-lg-4"></div>	
								<div class="col-lg-4"><input type="text" class="input-sm form-control" id="p_nombre" name="p_nombre" value="" placeholder="Nombre de la plantilla" required>	
								<div id="mensaje_guardar_plantilla"></div>
								<br><br><br></div>
								<div class="col-lg-4"></div>	
							</div>	
							<a id="guardar_plantilla_dieta_temporal" class="btn btn-outline btn-info">Guardar</a>
							<?php if(empty($_POST["usar_plantilla"])){ ?>
							<input type="hidden" id="p_temporal_plantilla" name="p_temporal_plantilla" value="no">
							<input type="hidden" id="p_temporal_id_cliente" name="p_temporal_id_cliente" value="<?php echo $cliente_id; ?>">
							<input type="hidden" id="p_temporal_duracion" name="p_temporal_duracion" value="<?php echo $duracion; ?>">
							<input type="hidden" id="p_temporal_num_comidas" name="p_temporal_num_comidas" value="<?php echo $num_comidas; ?>">
							<input type="hidden" id="p_temporal_platos_comidas" name="p_temporal_platos_comidas" value="<?php echo $platos_comidas; ?>">
							<input type="hidden" id="p_temporal_comida_postre" name="p_temporal_comida_postre" value="<?php echo $comida_postre; ?>">
							<input type="hidden" id="p_temporal_plato_cena" name="p_temporal_plato_cena" value="<?php echo $plato_cena; ?>">
							<input type="hidden" id="p_temporal_cena_postre" name="p_temporal_cena_postre" value="<?php echo $cena_postre; ?>">
							<input type="hidden" id="p_temporal_fecha_inicio" name="p_temporal_fecha_inicio" value="<?php echo $fecha_inicio; ?>">
							<input type="hidden" id="p_temporal_kilocalorias_dia" name="p_temporal_kilocalorias_dia" value="<?php echo $kilocalorias_dia; ?>">
							<input type="hidden" id="p_temporal_grasas_diarias" name="p_temporal_grasas_diarias" value="<?php echo $grasas_diarias; ?>">
							<input type="hidden" id="p_temporal_proteinas_diarias" name="p_temporal_proteinas_diarias" value="<?php echo $proteinas_diarias; ?>">
							<input type="hidden" id="p_temporal_hidratos_diarios" name="p_temporal_hidratos_diarios" value="<?php echo $hidratos_diarios; ?>">
							<input type="hidden" id="p_temporal_limitar_tamano" name="p_temporal_limitar_tamano" value="<?php echo $limitar_tamano; ?>">
							<input type="hidden" id="p_temporal_listado_plantillas" name="p_temporal_listado_plantillas" value="<?php echo $listado_plantillas; ?>">
							<input type="hidden" id="p_temporal_dieta_plantilla" name="p_temporal_dieta_plantilla" value="">
							<input type="hidden" id="p_tabla_semana_1" name="p_tabla_semana_1" value="">
							<?php } ?>
							</form> 
							<br /><br />
						</div>
					</div>						
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				</div>    
			</div>
		  </div>
		</div>
		<!-- Fin Modal Guardar plantilla -->
		<!-- Modal Buscar Receta -->
		<div id="modal_buscar_receta" class="modal fade" role="dialog" style="overflow:hidden;">
		  <div class="modal-dialog modal-lg"> 
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel">Ver recetas equivalentes</h4>
				</div>
				<br><h1 class="modal-title text-center">Recetas equivalentes</h1><br><br>
				<div class="text-center" style="max-height: 600px; min-height: 400px;">					
					<div class="row">
						<div class="col-md-4"></div>	
						<div class="col-md-4 text-left"><div id="mostrar_receta_equivalente" style="margin: 0px;"></div></div>
						<div class="col-md-4"></div>
					</div><br><br><br>
					<div class="row">
						<div class="col-md-4"></div>	
						<div class="col-md-4 text-center"><a href="#" class="btn btn-w-m btn-guardar">Cambiar Receta</a></div>
						<div class="col-md-4"></div>
					</div>							
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				</div>    
			</div>
		  </div>		
		</div>
		<!-- Fin Modal Buscar Receta -->
		<!-- Modal Enviar Correo -->	
		<div id="modal_enviar_correo" class="modal fade charts-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		  <div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel">Enviar dieta por Correo</h4>
				</div>	
				<form id="formulario_enviar_dieta_correo_estandar" action="#" method="post">	
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-10">
						<h1>Opciones de envio de correo:</h1>
							<br><br>
								<h3><a id="corre_estandar_pdf" style="color:#772e71;" href="#">&squf; <strong>Estándar</strong> (Estado del paciente, Dieta con recetas, Tabla resumen y Lista de la compra)</a></h3>
								<br><br>
								<h3><a style="color:#772e71;" id="mostrar_pdf_avanzado_2" href="#">&squf; <strong>Avanzada:</strong></a></h3>						
								<br /><br /><br />
						</div>	
						<div class="row pdf_opciones_avanzadas_2">
							<div class="col-md-3"></div>
							<div class="col-md-9"><i style="color: #81d742; "class="fa fa-plus-square-o pdf_botones"></i><strong>Añadir </strong> (selección múltiple)</div>	
							<br><br>
						</div>	  
						<div class="row pdf_opciones_avanzadas_2">
							<div class="col-md-3"></div>
							<div class="col-md-3"> 
								<div class="checkbox checkbox-success">	
								<input id="pdf_introduccion"  name="pdf_introduccion"  type="checkbox"  value="1">
								<label for="pdf_introduccion">
									Introducción
								</label>
								</div>
							</div>
							<div class="col-md-3"> 
								<div class="checkbox checkbox-success">	
								<input id="pdf_equivalencia_medidas_caceras"  name="pdf_equivalencia_medidas_caceras"  type="checkbox" value="1">
								<label for="pdf_equivalencia_medidas_caceras">
									Equivalencia medidas caseras
								</label>
								</div>
							</div>
							<div class="col-md-3"> 
								<div class="checkbox checkbox-success">	
								<input id="pdf_mediciones"  name="pdf_mediciones"  type="checkbox" value="1">
								<label for="pdf_mediciones">
									Mediciones
								</label>
								</div>
							</div>
							<div class="col-md-1"></div>
						</div>
						<div class="row pdf_opciones_avanzadas_2">
							<br>
							<div class="col-md-3"></div>
							<div class="col-md-9"><i style="color: red;" class="fa fa-minus-square-o pdf_botones"></i><strong>Suprimir</strong> (desmarcar para suprimir del informe)</div>	
							<br><br>	
						</div>				
						<div class="row pdf_opciones_avanzadas_2">
							<div class="col-md-3"></div>
							<div class="col-md-3"> 
								<div class="checkbox checkbox-success">	
								<input id="pdf_recetas"  name="pdf_recetas"  type="checkbox" value="1" checked="checked">
								<label for="pdf_recetas">
									Recetas
								</label>
								</div>
							</div>
							<div class="col-md-3"> 
								<div class="checkbox checkbox-success">	
								<input id="pdf_lista_de_compra"  name="pdf_lista_de_compra"  type="checkbox" value="1" checked="checked">
								<label for="pdf_lista_de_compra">
									Lista de compra
								</label>
								</div>
							</div>
							<div class="col-md-3"></div>
							<div class="col-md-1"></div>	
						</div>
						<div class="row pdf_opciones_avanzadas_2">
							<br><br><br><br>
							<div class="col-md-2"></div>
							<div class="col-md-8 text-center"> 
								<a id="enviar_dieta_por_correo" class="btn btn-primary">Enviar PDF</a>
							</div>					
							<div class="col-md-2"></div>	
						</div>	
						<br /><br /><br />
						<input type="hidden" name="id_cliente" value="<?php echo $cliente_id; ?>">												
				</form> 
				<br /><br />												
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				</div>    
			</div>
		  </div>
		</div>
		<!-- Fin Modal Enviar Correo -->	
                <div class="footer">
					<?php if($error == 'no'){ ?>	
                    <?php include_once 'parts/footer.php'; ?>
					<?php } ?>	
                </div>
		</div>
			<!-- Triangulo -->
			<div class="wrapper wrapper-content">	
				<div class="row">
					<div class="col-md-12">
						<div class="ibox-content text-left">
							<div class="row">
							<div class="col-md-8"></div>
							<div class="col-md-2">
								<a class="derecha_f" href=""><img src="<?php echo $url_app; ?>img/cabeza.png" style="width:50px; margin-top: 10px; margin-right: 15px;"></a>
								<p class="derecha_f" >Inteligencia artificial<br>
								Predicción del peso<br> 
								tras la dieta <strong>155.2Kg</strong><br>
								</p>
							</div>										
							<div class="col-md-2 open_triangulo">
								<a class="derecha_f" href="#"><img src="<?php echo $url_app; ?>img/triangulo.png" style="width:50px; margin-top: 10px; margin-right: 15px;"></a>
								<p class="derecha_f" >Porcentaje de acierto: <br> 
								Pirámide  <strong>70 %</strong> <br> 
								General  <strong>96 % </strong><br> 
								<strong>Ver estadísticas</strong><br> 
								</p>
							</div>
							</div>		
						</div>					
					</div>
				</div>
			</div><br><br><br>
			<!-- Fin Triangulo -->
			<?php include_once 'parts/menu_derecho.php'; ?>
        </div>
        </div> 
		<!-- Modal Buscar Receta -->
		<div id="modal_triangulo" class="modal fade" role="dialog" style="overflow:hidden;">		  
		  <div class="modal-dialog modal-lg" style="overflow-y: scroll; max-height:85%; "> 
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel">Estadísticas</h4>
				</div>
				<div class="text-left" style="padding-left:30px; padding-right:30px; padding-top:30px;">					
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-4">
							<a class="derecha_f" href=""><img src="<?php echo $url_app; ?>img/cabeza.png" style="width:50px; margin-top: 10px; margin-right: 15px;"></a>
							<p class="derecha_f" >Inteligencia artificial<br>
							Predicción del peso<br> 
							tras la dieta <i class="porcentaje_bueno">155.2Kg</i><br>
							</p>
						</div>						
						<div class="col-md-4">
							<p>Porcentaje de acierto</p>
							<p>General <i class="porcentaje_malo">96 %</i></p>
							<p>Calorías <i class="porcentaje_standar">5497 (100% acierto)</i></p>
							<p>Proteínas <i class="porcentaje_standar">22.9% (92.1% acierto)</i></p>
							<p>Hidratos <i class="porcentaje_standar">55.5% (99.5% acierto)</i></p>
							<p>Grasas <i class="porcentaje_standar">21.5% (91.5% acierto)</i></p>
						</div>
						<div class="col-md-2"></div>
					</div>
					<br><br><br>
					<div class="row">
						<div class="col-md-6">							
							<h1>Pirámide Nutricional</h1>
							<img src="<?php echo $url_app; ?>img/triangulo.png" style="width:50px; margin-top: 10px; margin-right: 15px;">
							<br>
							<p>Ajuste a Pirámide Nutricional <i class="porcentaje_malo">63 %</i></p>
							<div class="row">
								<div class="col-md-12">ARROZ (1, 2) unidades/semana<br>
								Ajustes por semana:</div>
							</div>														
							<div class="row">
								<div class="col-md-12">
									<?php for ($i = 1; $i <= $total_semanas_sliders; $i++) { ?>
									<?php echo $i.':'; ?>
									<i class="porcentaje_malo">200%</i>	
									&nbsp;
									<?php } ?>
								</div>
							</div>			
							<div class="row">		
								<div class="col-md-12">Porcentaje: <i class="porcentaje_malo">66.67 %</i></div>							
							</div>
							<br><br>
							<!-- 2-->
							<div class="row">
								<div class="col-md-12">PATATAS (1, 2) unidades/semana<br>
								Ajustes por semana:</div>
							</div>	
							<div class="row">
								<div class="col-md-12">
									<?php for ($i = 1; $i <= $total_semanas_sliders; $i++) { ?>
									<?php echo $i.':'; ?>
									<i class="porcentaje_bueno">200%</i>	
									&nbsp;
									<?php } ?>									
								</div>
							</div>
							<div class="row">		
								<div class="col-md-12">Porcentaje: <i class="porcentaje_bueno">66.67 %</i></div>
							</div>
							<br><br>
							<!-- 3-->							
							<div class="row">
								<div class="col-md-12">PESCADO (4, 5) unidades/semana<br>
								Ajustes por semana:</div>
							</div>	
							<div class="row">
								<div class="col-md-12">
									<?php for ($i = 1; $i <= $total_semanas_sliders; $i++) { ?>
									<?php echo $i.':'; ?>
									<i class="porcentaje_bueno">200%</i>	
									&nbsp;
									<?php } ?>
								</div>
							</div>
							<div class="row">		
								<div class="col-md-12">Porcentaje: <i class="porcentaje_bueno">66.67 %</i></div>
							</div>
							<br><br>
							<div class="row">
								<div class="col-md-12">CARNE (3, 4) unidades/semana<br>
								Ajustes por semana:</div>
							</div>	
							<div class="row">
								<div class="col-md-12">
									<?php for ($i = 1; $i <= $total_semanas_sliders; $i++) { ?>
									<?php echo $i.':'; ?>
									<i class="porcentaje_standar">200%</i>	
									&nbsp;
									<?php } ?>									
								</div>
							</div>
							<div class="row">		
								<div class="col-md-12">Porcentaje: <i class="porcentaje_standar">66.67 %</i></div>
							</div>
							<br><br>	
							<div class="row">
								<div class="col-md-12">LACTEOS 3 unidades/día<br>
								Ajustes por día:</div>
							</div>	
							<div class="row">
								<div class="col-md-12">
									<?php for ($i = 1; $i <= $total_dias_dieta; $i++) { ?>
									<?php echo $i.':'; ?>
									<i class="porcentaje_malo"><?php echo rand(10, 200); ?>%</i>	
									&nbsp;
									<?php } ?>									
								</div>
							</div>
							<div class="row">		
								<div class="col-md-12">Porcentaje: <i class="porcentaje_malo">66.67 %</i></div>
							</div>
							<!-- VERDURAS Y HORTALIZAS 2 o más unidades/día -->		
							<br><br>							
							<div class="row">
								<div class="col-md-12">VERDURAS Y HORTALIZAS 2 o más unidades/día<br>
								Ajustes por día:</div>
							</div>	
							<div class="row">
								<div class="col-md-12">
									<?php for ($i = 1; $i <= $total_dias_dieta; $i++) { ?>
									<?php echo $i.':'; ?>
									<i class="porcentaje_malo"><?php echo rand(10, 200); ?>%</i>	
									&nbsp;
									<?php } ?>									
								</div>
							</div>
							<div class="row">		
								<div class="col-md-12">Porcentaje: <i class="porcentaje_malo">66.67 %</i></div>
							</div>
							<!-- FRUTA 3 o más unidades/día -->		
							<br><br>							
							<div class="row">
								<div class="col-md-12">FRUTA 3 o más unidades/día<br>
								Ajustes por día:</div>
							</div>	
							<div class="row">
								<div class="col-md-12">
									<?php for ($i = 1; $i <= $total_dias_dieta; $i++) { ?>
									<?php echo $i.':'; ?>
									<i class="porcentaje_bueno"><?php echo rand(10, 200); ?>%</i>	
									&nbsp;
									<?php } ?>									
								</div>
							</div>
							<div class="row">		
								<div class="col-md-12">Porcentaje: <i class="porcentaje_bueno">66.67 %</i></div>
							</div>
							<!-- LEGUMBRES (2, 3) unidades/semana -->		
							<br><br>							
							<div class="row">
								<div class="col-md-12">LEGUMBRES (2, 3) unidades/semana<br>
								Ajustes por semana:</div>
							</div>	
							<div class="row">
								<div class="col-md-12">
									<?php for ($i = 1; $i <= $total_semanas_sliders; $i++) { ?>
									<?php echo $i.':'; ?>
									<i class="porcentaje_bueno"><?php echo rand(10, 200); ?>%</i>	
									&nbsp;
									<?php } ?>									
								</div>
							</div>
							<div class="row">		
								<div class="col-md-12">Porcentaje: <i class="porcentaje_bueno">66.67 %</i></div>
							</div>
							<!-- HUEVOS (3, 4) unidades/semana -->		
							<br><br>							
							<div class="row">
								<div class="col-md-12">HUEVOS (3, 4) unidades/semana<br>
								Ajustes por semana:</div>
							</div>	
							<div class="row">
								<div class="col-md-12">
									<?php for ($i = 1; $i <= $total_semanas_sliders; $i++) { ?>
									<?php echo $i.':'; ?>
									<i class="porcentaje_bueno"><?php echo rand(10, 200); ?>%</i>	
									&nbsp;
									<?php } ?>									
								</div>
							</div>
							<div class="row">		
								<div class="col-md-12">Porcentaje: <i class="porcentaje_bueno">66.67 %</i></div>
							</div>
							<!-- CARNE (3, 4) unidades/día -->		
							<br><br>							
							<div class="row">
								<div class="col-md-12">CARNE (3, 4) unidades/día<br>
								Ajustes por día:</div>
							</div>	
							<div class="row">
								<div class="col-md-12">
									<?php for ($i = 1; $i <= $total_dias_dieta; $i++) { ?>
									<?php echo $i.':'; ?>
									<i class="porcentaje_standar"><?php echo rand(10, 200); ?>%</i>	
									&nbsp;
									<?php } ?>									
								</div>
							</div>
							<div class="row">		
								<div class="col-md-12">Porcentaje: <i class="porcentaje_bueno">66.67 %</i></div>
							</div>
							<!-- CEREALES (4, 6) unidades/día -->		
							<br><br>							
							<div class="row">
								<div class="col-md-12">CARNE (3, 4) unidades/día<br>
								Ajustes por día:</div>
							</div>	
							<div class="row">
								<div class="col-md-12">
									<?php for ($i = 1; $i <= $total_dias_dieta; $i++) { ?>
									<?php echo $i.':'; ?>
									<i class="porcentaje_bueno"><?php echo rand(10, 200); ?>%</i>	
									&nbsp;
									<?php } ?>									
								</div>
							</div>
							<div class="row">		
								<div class="col-md-12">Porcentaje: <i class="porcentaje_bueno">66.67 %</i></div>
							</div>
						</div>
						<div class="col-md-6">
							<h1>Información nutricional</h1>							
							<!-- Slider -->
							<div id="contenedor_slider_2" class="carousel slide" data-ride="carousel"  data-interval="false">		
							<!-- Wrapper for slides -->
							<div class="carousel-inner">
								<?php  for ($s = 0; $s <= $total_dias_dieta; $s++) { ?>									
								<div class="item <?php if($s == 0){  echo 'active';  }else { }?>"> 
									<h3><?php echo flecha_prev_2 ($s, $total_dias_dieta); ?> de <?php echo flecha_next_2 ($s, $total_dias_dieta); ?></h3>
									<?php include 'parts/dieta_informacion_nutricional.php'; ?>
								</div>								
								<?php }  ?>
							</div>
							</div>
							<!-- Fin Slider -->
						</div>
					</div>							
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				</div>    
			</div>
		  </div>		
		</div>
		<!-- Fin Modal Buscar Receta -->
		<!-- Modal PDF -->
		<div id="modal_pdf" class="modal fade" role="dialog" style="overflow:hidden;">
		<form id="formuario_pdf_avanzado" action="<?php echo $url_app; ?>dieta-avanzada-pdf" target="_blank" method="post">
		  <div class="modal-dialog modal-lg"> 
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel">Opciones impresión</h4>
				</div>
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-10">
						<h1>Opciones de impresión:</h1>
						<br><br>
						<h3><a style="color:#772e71;" href="<?php echo $url_app; ?>dieta-pdf/<?php echo $cliente_id; ?>" target="_blank">&squf; <strong>Estándar</strong> (Estado del paciente, Dieta con recetas, Tabla resumen y Lista de la compra)</a></h3>
						<br><br>
						<h3><a style="color:#772e71;" id="mostrar_pdf_avanzado" href="#">&squf; <strong>Avanzada:</strong></a></h3>						
					</div>	
				</div>
				<br>
				<div class="row pdf_opciones_avanzadas">
					<div class="col-md-3"></div>
					<div class="col-md-9"><i style="color: #81d742; "class="fa fa-plus-square-o pdf_botones"></i><strong>Añadir </strong> (selección múltiple)</div>	
					<br><br>
				</div>	  
				<div class="row pdf_opciones_avanzadas">
					<div class="col-md-3"></div>
					<div class="col-md-3"> 
						<div class="checkbox checkbox-success">	
						<input id="pdf_introduccion"  name="pdf_introduccion"  type="checkbox"  value="1">
						<label for="pdf_introduccion">
							Introducción
						</label>
						</div>
					</div>
					<div class="col-md-3"> 
						<div class="checkbox checkbox-success">	
						<input id="pdf_equivalencia_medidas_caceras"  name="pdf_equivalencia_medidas_caceras"  type="checkbox" value="1">
						<label for="pdf_equivalencia_medidas_caceras">
							Equivalencia medidas caseras
						</label>
						</div>
					</div>
					<div class="col-md-3"> 
						<div class="checkbox checkbox-success">	
						<input id="pdf_mediciones"  name="pdf_mediciones"  type="checkbox" value="1">
						<label for="pdf_mediciones">
							Mediciones
						</label>
						</div>
					</div>
					<div class="col-md-1"></div>
				</div>
				<div class="row pdf_opciones_avanzadas">
					<br>
					<div class="col-md-3"></div>
					<div class="col-md-9"><i style="color: red;" class="fa fa-minus-square-o pdf_botones"></i><strong>Suprimir</strong> (desmarcar para suprimir del informe)</div>	
					<br><br>	
				</div>				
				<div class="row pdf_opciones_avanzadas">
					<div class="col-md-3"></div>
					<div class="col-md-3"> 
						<div class="checkbox checkbox-success">	
						<input id="pdf_recetas"  name="pdf_recetas"  type="checkbox" value="1" checked="checked">
						<label for="pdf_recetas">
							Recetas
						</label>
						</div>
					</div>
					<div class="col-md-3"> 
						<div class="checkbox checkbox-success">	
						<input id="pdf_lista_de_compra"  name="pdf_lista_de_compra"  type="checkbox" value="1" checked="checked">
						<label for="pdf_lista_de_compra">
							Lista de compra
						</label>
						</div>
					</div>
					<div class="col-md-3"></div>
					<div class="col-md-1"></div>	
				</div>
				<div class="row pdf_opciones_avanzadas">
					<br><br><br><br>
					<div class="col-md-2"></div>
					<div class="col-md-8 text-center"> 
						<a id="generar_pdf_avanzado" class="btn btn-primary">Mostrar PDF</a>
					</div>					
					<div class="col-md-2"></div>	
				</div>	
				<input type="hidden" name="id_cliente" value="<?php echo $cliente_id; ?>">
				
				<br><br><br>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				</div>    
			</div>
			</div>
			</form>
		  </div>		
		</div>
		<!-- Fin Modal Buscar Receta -->	
		<!-- Modal ver informacion plato -->
		<div id="modal_ver_plato" class="modal fade charts-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg" style="overflow-y: scroll; max-height:85%; "> 
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
						<h4 class="modal-title" id="myModalLabel">Ver información del plato</h4>
					</div>
					<div class="text-center">
						<div style="margin-left: 10%; margin-right: 10%;">	
							<div class="row" id="mostrar_receta_vista" style="margin: 0px;"></div>					
						</div>							
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
					</div>    
				</div>
			</div>
		</div>
		<!-- Fin Modal ver iniformacion plato -->	
    </div>
	<script>
		var total_agua_g = [];
		var total_hc_g 		= 0;
		var total_prot_g	= 0;
		var total_grasa_g	= 0;
		var total_niacina	= 0;
		var total_satur_g	= 0;
		var total_mono_g	= 0;
		var total_poli_g	= 0;
		var total_col_mg	= 0;
		var total_fibra_g	= 0;
		var total_sodio_mg		= 0;
		var total_potasio_mg	= 0;
		var total_magnesio_mg	= 0;
		var total_calcio_mg		= 0;
		var total_fosf_mg		= 0;
		var total_hierro_mg		= 0;
		var total_cloro_mg		= 0;
		var total_cinc_mg		= 0;
		var total_cobre_mg		= 0;
		var total_manganeso_mg		= 0;
		var total_cromo_mg		= 0;
		var total_cobalto_mg		= 0;
		var total_molibde_mg		= 0;
		var total_yodo_mg		= 0;
		var total_fluor_mg		= 0;
		var total_butirico_c4_0		= 0;
		var total_caproico_c6_0		= 0;
		var total_caprilico_c8_0	= 0;
		var total_caprico_c10_0	= 0;
		var total_laurico_c12_0	= 0;
		var total_miristico_c14_0	= 0;
		var total_c15_0	= 0;
		var total_c15_00	= 0;
		var total_palmitico_c16_0	= 0;
		var total_c17_0	= 0;
		var total_c17_00	= 0;
		var total_estearico_c18_0	= 0;
		var total_araquidi_c20_0	= 0;
		var total_behenico_c22_0	= 0;
		var total_miristol_c14_1	= 0;
		var total_palmitole_c16_1	= 0;
		var total_oleico_c18_1	= 0;
		var total_eicoseno_c20_1	= 0;
		var total_c22_1	= 0;
		var total_linoleico_c18_2	= 0;
		var total_linoleni_c18_3	= 0;
		var total_c18_4	= 0;
		var total_ara_ico_c20_4	= 0;
		var total_c20_5	= 0;
		var total_c22_5	= 0;
		var total_c22_6	= 0;
		var total_otrosatur0	= 0;
		var total_otroinsat0	= 0;
		var total_omega3_0	= 0;
		var total_etanol0	= 0;
		var total_vit_a	= 0;
		var total_carotenos	= 0;
		var total_tocoferol	= 0;
		var total_vit_d	= 0;
		var total_vit_b1	= 0;
		var total_vit_b2	= 0;
		var total_vit_b6	= 0;
		//Esta fue eliminada de la tabla
		// var alimento_info['nicotina']				= var alimento_info['nicotina'];
		var total_ac_panto	= 0;
		var total_biotina	= 0;
		var total_folico	= 0;
		var total_b12	= 0;
		var total_vit_c	= 0;
		var total_purinas	= 0;
		var total_vit_k	= 0;
		var total_vit_e	= 0;
		var total_oxalico	= 0;
	</script>
	<!-- Listado PDF -->
	<div id="pdf_listado_vertical">	
	<?php for ($s = 1; $s <= $total_semanas_sliders; $s++) { ?>			
		<div class="pdfc_semana_<?php echo $s; ?>">
		<h1>Semana <?php echo $s; ?></h1>
		<?php for ($i = 1; $i <= $semana[$s]['dias']; $i++) { ?>
		<div class="pdfc_dia_<?php echo $i; ?>">
		<h1 class="text_center texto_primario">Día <?php echo $i; ?></h1>			
			<?php if(isset($pdf_desayuno_ronda)) { ?>			
				<?php $f=$i-1;  ?>
				<?php  $ingredientes = obtener_ingredientes($pdf_desayuno_ids[$f]); ?>					
					<div id="<?php echo $pdf_desayuno_ids[$f]; ?>">
					<p><strong>Desayuno</strong></p><br />
					<p><strong><?php echo $pdf_desayuno_nombre[$f]; ?></strong></p><br />
					<p id="elaboracion"><strong>Elaboración: </strong><?php echo str_replace('\r\n','<br>',utf8_encode($pdf_desayuno_descripcion[$f])); ?></p><br />
					<p><strong>Ingredientes:</strong><?php 					
					foreach ($ingredientes as & $valor) {						
						print '<i id="pdf_gramos">'.$valor['kcal_100g'].'</i>'; 
						echo 'g. de &nbsp;';
						print '<i id="pdf_nombre_alimento">'.utf8_encode($valor['alimento']).'</i>'; 						
						$pdf_ingredientes[$valor['id_alimento']] = array('id_alimento' => $valor['id_alimento'], 'alimento' => $valor['alimento'], 'kcal_100g' => $pdf_ingredientes[$valor['id_alimento']]['kcal_100g']+$valor['kcal_100g']);						
						if ($valor === end($ingredientes)) {											
						}else{
							echo ', &nbsp;';	
						}						
					}	
					?></p><br /><br />					
					</div>
			<?php } ?>			
			<?php print_r($piramide); ?>
			<?php if(isset($pdf_media_manana_ronda)) { ?>
				<?php $f=$i-1;  ?>
				<?php  $ingredientes = obtener_ingredientes($pdf_media_manana_ids[$f]); ?>					
					<div id="<?php echo $pdf_media_manana_ids[$f]; ?>">
					<p><strong>Media mañana</strong></p><br />
					<p><strong><?php echo $pdf_media_manana_nombre[$f]; ?></strong></p><br />
					<p id="elaboracion"><strong>Elaboración:</strong> <?php echo str_replace('\r\n','<br>',utf8_encode($pdf_media_manana_descripcion[$f])); ?></p><br />
					<p><strong>Ingredientes: </strong><?php 					
					foreach ($ingredientes as & $valor) {
						print '<i id="pdf_gramos">'.$valor['kcal_100g'].'</i>'; 
						echo 'g. de &nbsp;';
						print utf8_encode($valor['alimento']);  
						$pdf_ingredientes[$valor['id_alimento']] = array('id_alimento' => $valor['id_alimento'], 'alimento' => $valor['alimento'], 'kcal_100g' => $pdf_ingredientes[$valor['id_alimento']]['kcal_100g']+$valor['kcal_100g']);						
						if ($valor === end($ingredientes)) {											
						}else{
							echo ', &nbsp;';	
						}										
					}	
					?></p><br /><br />
					</div>			
			<?php } ?>
			<?php if(isset($pdf_primer_plato_comida_ronda)) { ?>
				<?php $f=$i-1;  ?>
				<?php  $ingredientes = obtener_ingredientes($pdf_primer_plato_comida_ids[$f]); ?>
					<div id="<?php echo $pdf_primer_plato_comida_ids[$f]; ?>">
					<p><strong>Primer plato comida</strong></p><br />
					<p><strong><?php echo $pdf_primer_plato_nombre[$f]; ?></strong></p><br />
					<p id="elaboracion"><strong>Elaboración: </strong><?php echo str_replace('\r\n','<br>',utf8_encode($pdf_primer_plato_descripcion[$f])); ?></p><br />
					<p><strong>Ingredientes: </strong><?php 					
					foreach ($ingredientes as & $valor) {
						print '<i id="pdf_gramos">'.$valor['kcal_100g'].'</i>'; 
						echo 'g. de &nbsp;';
						print utf8_encode($valor['alimento']);  
						$pdf_ingredientes[$valor['id_alimento']] = array('id_alimento' => $valor['id_alimento'], 'alimento' => $valor['alimento'], 'kcal_100g' => $pdf_ingredientes[$valor['id_alimento']]['kcal_100g']+$valor['kcal_100g']);						
						if ($valor === end($ingredientes)) {											
						}else{
							echo ', &nbsp;';	
						}										
					}	
					?></p><br /><br />
					</div>						
			<?php } ?>
			<?php if(isset($pdf_plato_principal_ronda)) { ?>
				<?php $f=$i-1;  ?>
				<?php  $ingredientes = obtener_ingredientes($pdf_plato_principal_ids[$f]); ?>
					<div id="<?php echo $pdf_plato_principal_ids[$f]; ?>">
					<p><strong>Plato principal comida</strong></p><br />
					<p><strong><?php echo $pdf_plato_principal_nombre[$f]; ?></strong></p><br />
					<p id="elaboracion"><strong>Elaboración: </strong><?php echo str_replace('\r\n','<br>',utf8_encode($pdf_plato_principal_descripcion[$f])); ?></p><br />
					<p><strong>Ingredientes: </strong><?php 					
					foreach ($ingredientes as & $valor) {
						print '<i id="pdf_gramos">'.$valor['kcal_100g'].'</i>'; 
						echo 'g. de &nbsp;';
						print utf8_encode($valor['alimento']);  
						$pdf_ingredientes[$valor['id_alimento']] = array('id_alimento' => $valor['id_alimento'], 'alimento' => $valor['alimento'], 'kcal_100g' => $pdf_ingredientes[$valor['id_alimento']]['kcal_100g']+$valor['kcal_100g']);						
						if ($valor === end($ingredientes)) {											
						}else{
							echo ', &nbsp;';	
						}										
					}	
					?></p><br /><br />
					</div>						
			<?php } ?>
			<?php if(isset($pdf_postre_comida_ronda)) { ?>
				<?php $f=$i-1;  ?>
				<?php  $ingredientes = obtener_ingredientes($pdf_postre_comida_ids[$f]); ?>
					<div id="<?php echo $pdf_postre_comida_ids[$f]; ?>">
					<p><strong>Postre comida</strong></p><br />
					<p><strong><?php echo $pdf_postre_comida_nombre[$f]; ?></strong></p><br />
					<p id="elaboracion"><strong>Elaboración:</strong><?php echo str_replace('\r\n','<br>',utf8_encode($pdf_postre_comida_descripcion[$f])); ?></p><br />
					<p><strong>Ingredientes: </strong><?php 					
					foreach ($ingredientes as & $valor) {
						print '<i id="pdf_gramos">'.$valor['kcal_100g'].'</i>'; 
						echo 'g. de &nbsp;';
						print utf8_encode($valor['alimento']);  
						$pdf_ingredientes[$valor['id_alimento']] = array('id_alimento' => $valor['id_alimento'], 'alimento' => $valor['alimento'], 'kcal_100g' => $pdf_ingredientes[$valor['id_alimento']]['kcal_100g']+$valor['kcal_100g']);						
						if ($valor === end($ingredientes)) {											
						}else{
							echo ', &nbsp;';	
						}										
					}	
					?></p><br /><br />
					</div>						
			<?php } ?>
			<?php if(isset($pdf_merienda_ronda)) { ?>
				<?php $f=$i-1;  ?>
				<?php  $ingredientes = obtener_ingredientes($pdf_merienda_ids[$f]); ?>
					<div id="<?php echo $pdf_merienda_ids[$f]; ?>">
					<p><strong>Postre comida</strong></p><br />
					<p><strong><?php echo $pdf_merienda_nombre[$f]; ?></strong></p><br />
					<p id="elaboracion"><strong>Elaboración:</strong> <?php echo str_replace('\r\n','<br>',utf8_encode($pdf_merienda_descripcion[$f])); ?></p><br />
					<p><strong>Ingredientes:</strong><?php 					
					foreach ($ingredientes as & $valor) {
						print '<i id="pdf_gramos">'.$valor['kcal_100g'].'</i>'; 
						echo 'g. de &nbsp;';
						print utf8_encode($valor['alimento']);  
						$pdf_ingredientes[$valor['id_alimento']] = array('id_alimento' => $valor['id_alimento'], 'alimento' => $valor['alimento'], 'kcal_100g' => $pdf_ingredientes[$valor['id_alimento']]['kcal_100g']+$valor['kcal_100g']);						
						if ($valor === end($ingredientes)) {											
						}else{
							echo ', &nbsp;';	
						}										
					}	
					?></p><br /><br />
					</div>						
			<?php } ?>
			<?php if(isset($pdf_primer_plato_cena_ronda)) { ?>
				<?php $f=$i-1;  ?>
				<?php  $ingredientes = obtener_ingredientes($pdf_primer_plato_cena_ids[$f]); ?>
					<div id="<?php echo $pdf_primer_plato_cena_ids[$f]; ?>">
					<p><strong>Postre comida</strong></p><br />
					<p><strong><?php echo $pdf_primer_plato_cena_nombre[$f]; ?></strong></p><br />
					<p id="elaboracion"><strong>Elaboración: </strong><?php echo str_replace('\r\n','<br>',utf8_encode($pdf_primer_plato_cena_descripcion[$f])); ?></p><br />
					<p><strong>Ingredientes:</strong><?php 					
					foreach ($ingredientes as & $valor) {
						print '<i id="pdf_gramos">'.$valor['kcal_100g'].'</i>'; 
						echo 'g. de &nbsp;';
						print utf8_encode($valor['alimento']);  
						$pdf_ingredientes[$valor['id_alimento']] = array('id_alimento' => $valor['id_alimento'], 'alimento' => $valor['alimento'], 'kcal_100g' => $pdf_ingredientes[$valor['id_alimento']]['kcal_100g']+$valor['kcal_100g']);						
						if ($valor === end($ingredientes)) {											
						}else{
							echo ', &nbsp;';	
						}										
					}	
					?></p><br /><br />
					</div>						
			<?php } ?>
			<?php if(isset($pdf_plato_principal_cena_ronda)) { ?>
				<?php $f=$i-1;  ?>
				<?php  $ingredientes = obtener_ingredientes($pdf_plato_principal_cena_ids[$f]); ?>
					<div id="<?php echo $pdf_plato_principal_cena_ids[$f]; ?>">
					<p><strong>Postre comida</strong></p><br />
					<p><strong><?php echo $pdf_plato_principal_cena_nombre[$f]; ?></strong></p><br />
					<p id="elaboracion"><strong>Elaboración: </strong><?php echo str_replace('\r\n','<br>',utf8_encode($pdf_plato_principal_cena_descripcion[$f])); ?></p><br />
					<p><strong>Ingredientes:</strong><?php 					
					foreach ($ingredientes as & $valor) {
						print '<i id="pdf_gramos">'.$valor['kcal_100g'].'</i>'; 
						echo 'g. de &nbsp;';
						print utf8_encode($valor['alimento']);  
						$pdf_ingredientes[$valor['id_alimento']] = array('id_alimento' => $valor['id_alimento'], 'alimento' => $valor['alimento'], 'kcal_100g' => $pdf_ingredientes[$valor['id_alimento']]['kcal_100g']+$valor['kcal_100g']);						
						if ($valor === end($ingredientes)) {											
						}else{
							echo ', &nbsp;';	
						}										
					}	
					?></p><br /><br />
					</div>						
			<?php } ?>
			<?php if(isset($pdf_postre_cena_ronda)) { ?>
				<?php $f=$i-1;  ?>
				<?php  $ingredientes = obtener_ingredientes($pdf_postre_cena_ids[$f]); ?>
					<div id="<?php echo $pdf_postre_cena_ids[$f]; ?>">
					<p><strong>Postre comida</strong></p><br />
					<p><strong><?php echo $pdf_postre_cena_nombre[$f]; ?></strong></p><br />
					<p id="elaboracion"><strong>Elaboración: </strong><?php echo str_replace('\r\n','<br>',utf8_encode($pdf_postre_cena_descripcion[$f])); ?></p><br />
					<p><strong>Ingredientes:</strong><?php 					
					foreach ($ingredientes as & $valor) {
						print '<i id="pdf_gramos">'.$valor['kcal_100g'].'</i>'; 
						echo 'g. de &nbsp;';
						print utf8_encode($valor['alimento']);  
						$pdf_ingredientes[$valor['id_alimento']] = array('id_alimento' => $valor['id_alimento'], 'alimento' => $valor['alimento'], 'kcal_100g' => $pdf_ingredientes[$valor['id_alimento']]['kcal_100g']+$valor['kcal_100g']);						
						if ($valor === end($ingredientes)) {											
						}else{
							echo ', &nbsp;';	
						}										
					}	
					?></p><br /><br />
					</div>						
			<?php } ?>
			<?php if(isset($pdf_recena_ronda)) { ?>
				<?php $f=$i-1;  ?>
				<?php  $ingredientes = obtener_ingredientes($pdf_recena_cena_ids[$f]); ?>
					<div id="<?php echo $pdf_recena_cena_ids[$f]; ?>">
					<p><strong>Postre comida</strong></p><br />
					<p><strong><?php echo $pdf_recena_cena_nombre[$f]; ?></strong></p><br />
					<p id="elaboracion"><strong>Elaboración: </strong><?php echo str_replace('\r\n','<br>',utf8_encode($pdf_recena_cena_descripcion[$f])); ?></p><br />
					<p><strong>Ingredientes: </strong><?php 					
					foreach ($ingredientes as & $valor) {
						print '<i id="pdf_gramos">'.$valor['kcal_100g'].'</i>'; 
						echo 'g. de &nbsp;';
						print utf8_encode($valor['alimento']);  
						$pdf_ingredientes[$valor['id_alimento']] = array('id_alimento' => $valor['id_alimento'], 'alimento' => $valor['alimento'], 'kcal_100g' => $pdf_ingredientes[$valor['id_alimento']]['kcal_100g']+$valor['kcal_100g']);						
						if ($valor === end($ingredientes)) {											
						}else{
							echo ', &nbsp;';	
						}										
					}	
					?></p><br /><br />
					</div>						
			<?php } ?>			
		<div class="pdfc_dia_fin_<?php echo $i; ?>"></div></div>
		<?php } ?>
		<div class="pdfc_semana_fin_<?php echo $s; ?>"></div></div>
	<?php } ?>
	</table>	
	</div>
	<!-- Fin Listado PDF -->	
	<div id="lista_definitiva_alimentos"><div id="lista_definitiva_alimentos_mostrar">		
	<table class="sin_lineas">			
	<?php $table_indice = 1; ?>
	<?php foreach (array_chunk($pdf_ingredientes, 2) as $ingrediente) { ?>
		<tr>
		<?php foreach ($ingrediente as $value) { ?>			
			<td><img src="<?php echo $url_app;?>/img/check_en_blanco.png"><?php echo $value['kcal_100g']; ?>g. de <?php echo utf8_encode($value['alimento']); ?> - <?php $table_indice = $table_indice+1; ?><?php if($table_indice == 65) { echo "<br /><br /><br /><br /><br />"; }?></td>			
		<?php } ?>
		</tr>
	<?php } ?>
	</table>
	</div></div>		
	<?php include 'parts/jquery_footer.php'; ?>
	<script src="<?php echo $url_app; ?>js/plugins/dataTables/datatables.min.js"></script>			
	<script src="<?php echo $url_app; ?>js/plugins/chosen/chosen.jquery.js"></script>
	<script>
		$(document).ready(function(){
			
			//Variables estandar
			var comida_libre = '<p class="detalle_comida">Plato libre</p><p class="gramos"></p>';
			var myCol = '';
			var $tr = '';
			var myRow = '';
			var contenido = '';
			var contenido_copiado = '';
			var kcal_select_copiado = '';
			var numero_filas = $("#example tr").length;
			var numero_columnas = $("#example tr:last td").length;
			var ver_receta = '';
			var gramos_select = '';
			var kcal_temporal = 0;
			var kcal_select = '';
			var kcal_select_original = '';
			var tabla_semana_1 = '';
			
			
			 
			//Asignamos la columna y la fila a los TD
			$('td').click(function() {
				myCol = $(this).index()+1;				
				$tr = $(this).closest('tr');
				myRow = $tr.index()+1;				
				ver_receta = $('.ibox-content.item.active #example tbody tr:nth-child('+myRow+')  td:nth-child('+myCol+')').attr('class');										
				contenido = $('#example tbody tr:nth-child('+myRow+') td:nth-child('+myCol+')').html();
				kcal_select = $(this).attr("kcal");
				kcal_select_original = $(this).attr("kcal_original");
				gramos_select = $('#example tbody tr:nth-child('+myRow+') td:nth-child('+myCol+') .gramos i').html();				
				// console.log(myRow);
				// console.log(contenido);
				// console.log(ver_receta);	
				$('#div_modificar_peso_input').css('display', 'none');  				
				if($('.ibox-content.item.active .dataTables-example tbody tr:nth-child('+myRow+') td:nth-child('+myCol+')').hasClass('block_td')) {					
					//Si esta bloqueado
					$('#btn_copiar').prop('disabled', true); 
					$('#btn_pegar').prop('disabled', true);  
					$('#btn_buscar_plato_equi').prop('disabled', true); 
					$('#btn_marcar_libre').prop('disabled', true); 
					$('#btn_modificar_peso').prop('disabled', true); 
					if(ver_receta == '' || ver_receta == null) {
						$('#btn_ver_informacion').prop('disabled', true); 
					}else{
						$('#btn_ver_informacion').prop('disabled', false); 
					}
				}else{
					//Si esta libre				
					$('#btn_copiar').prop('disabled', false);  
					$('#btn_pegar').prop('disabled', false); 
					$('#btn_buscar_plato_equi').prop('disabled', false); 
					$('#btn_marcar_libre').prop('disabled', false); 
					$('#btn_modificar_peso').prop('disabled', false);  
					if(ver_receta == '' || ver_receta == null) {
						$('#btn_ver_informacion').prop('disabled', true); 
						$('#btn_marcar_libre').prop('disabled', true); 
						$('#btn_buscar_plato_equi').prop('disabled', true); 
						$('#btn_modificar_peso').prop('disabled', true); 
					}else{
						$('#btn_ver_informacion').prop('disabled', false); 
						$('#btn_marcar_libre').prop('disabled', false); 
						$('#btn_buscar_plato_equi').prop('disabled', false); 
						$('#btn_modificar_peso').prop('disabled', false); 
					}
				}
				$('.tabla_semana_1 tbody td').class(
					function(c) {
						console.log(c);  
					}
				);
			});
			
			
			//Botones acciones
			//->Copiar
			$('#btn_copiar').click(function() {				
				$('#listado_opciones').modal('toggle'); 
				$('#div_pegar').css('display', 'block'); 
				contenido_copiado = contenido;
				kcal_select_copiado = kcal_select;
				desactivar_impresion_y_pdf();
			});
			//->Pegar
			$('#btn_pegar').click(function() {
				var clase_table = $('.ibox-content.item.active .dataTables-example', '').attr('class').split(' ')[3];							
				$('#listado_opciones').modal('toggle'); 
				$('#div_pegar').css('display', 'none'); 
				$('.'+clase_table+' tbody tr:nth-child('+myRow+') td:nth-child('+myCol+')').html(contenido_copiado);					
				var clase_table_semana = $('.ibox-content.item.active .dataTables-example', '').attr('class').split(' ')[3];	
				total_kilokalorias = $('.'+clase_table_semana+' tfoot tr th:nth-child('+myCol+') i').html();
				
				total_kilokalorias  = parseFloat(total_kilokalorias)-parseFloat(kcal_select);
				total_kilokalorias  = parseFloat(total_kilokalorias)+parseFloat(kcal_select_copiado);
				
				$('.'+clase_table_semana+' tbody tr td:nth-child('+myCol+')').attr('kcal', kcal_select_copiado);
				
				$('.'+clase_table_semana+' tfoot tr th:nth-child('+myCol+')').html('<i>'+total_kilokalorias+'</i> kcal');		
								
				contenido_copiado = '';
				kcal_select_copiado = '';
				desactivar_impresion_y_pdf();
				
			});		
			//->Bloquear ó Desbloquear
			$('#btn_bloquear_desbloquear').click(function() {				
				$('#listado_opciones').modal('toggle'); 
				var clase_table = $('.ibox-content.item.active .dataTables-example', '').attr('class').split(' ')[3];									
				if($('.'+clase_table+' tbody tr:nth-child('+myRow+') td:nth-child('+myCol+')').hasClass('block_td')) {					
					$('.'+clase_table+' tbody tr:nth-child('+myRow+') td:nth-child('+myCol+')').removeClass("block_td");					
				}else{
					$('.'+clase_table+' tbody tr:nth-child('+myRow+') td:nth-child('+myCol+')').addClass("block_td");					
				}				
			});
			//->Ver informacion del plato
			$('#btn_ver_informacion').click(function() {	
				var url_ver_receta = "<?php echo $url_app; ?>parts/ver-receta-vista.php";    			
				$('#listado_opciones').modal('toggle'); 
				$('#modal_ver_plato').modal('toggle');	
				$.ajax({                        
					type: "POST",                 
					url: url_ver_receta,                    
					data:'id_receta='+ver_receta+'&gramos='+gramos_select,					
					success: function(data){
						$('#mostrar_receta_vista').html(data);    						
					}
					
				});			
			});	
			//->Buscar receta equivalente
			$('#btn_buscar_plato_equi').click(function() {	
				var url_ver_receta = "<?php echo $url_app; ?>parts/buscar-receta-equivalente.php";    			
				$('#listado_opciones').modal('toggle'); 
				$('#modal_buscar_receta').modal('toggle');	
				$.ajax({                        
					type: "POST",                 
					url: url_ver_receta,                    
					data:'id_receta='+ver_receta,
					success: function(data){
						$('#mostrar_receta_equivalente').html(data);	
						$(".chosen-select").chosen(); 		
					}
					
				});	
				desactivar_impresion_y_pdf();	
			});
			//->Marcar Libre
			$('#btn_marcar_libre').click(function() {	
				var clase_table = $('.ibox-content.item.active .dataTables-example', '').attr('class').split(' ')[3];						
				$('#listado_opciones').modal('toggle'); 
				$('.'+clase_table+' tbody tr:nth-child('+myRow+') td:nth-child('+myCol+')').html(comida_libre);					
				$("#example tr td ").removeClass(ver_receta);		
				
				//Agregar las kcal originales en los 2 campos
				var clase_table_semana = $('.ibox-content.item.active .dataTables-example', '').attr('class').split(' ')[3];	
				$('.'+clase_table_semana+' tbody tr td:nth-child('+myCol+')').attr('kcal', kcal_select_original);
				 
				desactivar_impresion_y_pdf();
			});					
			//->Aplicar a toda la dieta
			$('#btn_aplicar_toda_dieta').click(function() {					
				$('#listado_opciones').modal('toggle'); 
				$('#example tbody tr:nth-child('+myRow+') td+td:not(.block_td)').html(contenido);						
				desactivar_impresion_y_pdf();
			});				
			//->Modificar Peso
			$('#btn_modificar_peso').click(function() {	
				$('#div_modificar_peso_input').css('display', 'block');  								
			});	
			//->Modificar Peso Input
			$('#link_modificar_peso').click(function() {	
				$('#listado_opciones').modal('toggle'); 				
					var nuevo_valor_peso = $('#nuevo_peso_input').val();  
				if (nuevo_valor_peso !== null && nuevo_valor_peso !== undefined) {
					
					$('.'+ver_receta+' .gramos i').html(nuevo_valor_peso);	
					$('#nuevo_peso_input').val('');	
					var clase_table_semana = $('.ibox-content.item.active .dataTables-example', '').attr('class').split(' ')[3];	
					total_kilokalorias = $('.'+clase_table_semana+' tfoot tr th:nth-child('+myCol+') i').html();
					
					//-> Gramos anteriores
					//50
					gramos_select;
					//-> Gramos nuevos
					nuevo_valor_peso;					
					//->kilokalorias postre
					//-> 272,22
					kcal_select										
					total_kilokalorias = parseFloat(total_kilokalorias)+parseFloat(kcal_select)*parseFloat(nuevo_valor_peso)/parseFloat(gramos_select)-parseFloat(kcal_select);
										
					kcal_select = parseFloat(kcal_select)*parseFloat(nuevo_valor_peso)/parseFloat(gramos_select);
					
					
					$('.'+clase_table_semana+' tbody tr td:nth-child('+myCol+')').attr('kcal', kcal_select);
					
					//-> aqui llenamos el footer
					$('.'+clase_table_semana+' tfoot tr th:nth-child('+myCol+')').html('<i>'+total_kilokalorias+'</i> kcal');		
					
				}
				desactivar_impresion_y_pdf();
			});		
			
			
			//->Triangulo
			$('.open_triangulo').click(function() {	
				// var url_ver_receta = "<?php echo $url_app; ?>parts/ver-receta-vista.php";    			
				// $('#listado_opciones').modal('toggle'); 
				$('#modal_triangulo').modal('toggle');					
				/*
				$.ajax({                        
					type: "POST",                 
					url: url_ver_receta,                    
					data:'id_receta='+ver_receta,
					success: function(data){
						$('#mostrar_receta_vista').html(data);    						
					}
					
				});	*/		
			});	
			
			
			//Crear tabla en array
			var contenido_peso;						
			var list = [];
			var listita  = new Array;			
			var i; 
			
			for (t = 0; t < numero_filas ; t++) {				
				for (i = 0; i < numero_columnas+1; i++) {								
					contenido_peso = $("#example tbody tr:nth-child("+t+") td:nth-child("+i+") .gramos").html();
					// console.log(contenido_peso);	
					// console.log("\n");
					if (contenido_peso === undefined || contenido_peso === null) {}else{					
						contenido_peso = contenido_peso.replace('g', '');							
						list.push(contenido_peso);
					} 					
				} 				
				listita[t] = list;
				list = [];				
			}
			var total=0;		
			
		});
		
		var loading = '<div class="ibox-content"><div class="row"><div class="col-lg-12 text-center"><div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div></div></div>';
		
		//->Botones top
		$('#vinculo_actualizar_dieta').click(function() {
			location.reload();
		});
		
		//->Guardar En Temporal modal
		$('#vinculo_guardar_dieta').click(function() {			
			$('#modal_guardar_temporal').modal('toggle'); 
		    var toda_la_plantilla = $("#contenedor_slider").html();			
			$('#temporal_dieta_plantilla').val(toda_la_plantilla);
			tabla_semana_1 = $('.tabla_semana_1 tbody').html();			
			
			$('#tabla_semana_1').val(tabla_semana_1);
			
			//listado vertical
			var pdf_listado_vertical = $('#pdf_listado_vertical').html();			
			$('#pdf_input_listado_vertical').val(pdf_listado_vertical);
			
			var lista_definitiva_alimentos = $('#lista_definitiva_alimentos').html();						
			$('#temporal_lista_de_compra').val(lista_definitiva_alimentos);
			
			
			
		});
		//->Guardar En Temporal
		$('#guardar_dieta_temporal').click(function() {	
			var url_guardar_dieta = "<?php echo $url_app; ?>parts/guadar-dieta.php"; 
			$('#respuesta').html(loading);	
			$('#vinculo_imprimir_dieta').css('cursor', 'pointer');  	
			$('#vinculo_imprimir_dieta').css('opacity', '1');  	
			$('#vinculo_enviar_correo').css('cursor', 'pointer');  	
			$('#vinculo_enviar_correo').css('opacity', '1');  
			$('#modal_guardar_temporal').modal('toggle');	
			$.ajax({                        
				type: "POST",                 
				url: url_guardar_dieta,                    
				data: $("#formulario_guardar_dieta").serialize(),
				success: function(data){
					$('#respuesta').html(data);    					
				}
				
			});
		});
		
		//->Guardar plantilla modal
		$('#vinculo_guardar_plantilla_dieta').click(function() {			
			$("#mensaje_guardar_plantilla").hide();
			$('#modal_guardar_plantilla').modal('toggle'); 
		    var toda_la_plantilla = $("#contenedor_slider").html();			
			$('#p_temporal_dieta_plantilla').val(toda_la_plantilla);
		});
		
		
		//->Guardar Plantilla
		$('#guardar_plantilla_dieta_temporal').click(function() {
			var nombre_plantilla = $("#p_nombre").val().length;			
			if(nombre_plantilla == 0 || nombre_plantilla == ''){
				$("#mensaje_guardar_plantilla" ).html("El nombre de la plantilla esta vacio");
				$("#mensaje_guardar_plantilla").show();	
			}
			if(nombre_plantilla >= 1 && nombre_plantilla <= 5){
				$("#mensaje_guardar_plantilla" ).html("El nombre de la plantilla es muy corto");				
				$("#mensaje_guardar_plantilla").show();	
			}
			if(nombre_plantilla >= 6){
			//Si todo esta bien guardamos la plantilla
				var url_guardar_plantilla = "<?php echo $url_app; ?>parts/guadar-plantilla.php";
				$('#respuesta').html(loading);  
				$('#modal_guardar_plantilla').modal('toggle');				
				$.ajax({                        
					type: "POST",                 
					url: url_guardar_plantilla,                    
					data: $("#formulario_guardar_plantilla_dieta").serialize(),				
					success: function(data){
						$('#respuesta').html(data); 
						$("#mensaje_guardar_plantilla").html(data);
												
					}
					
				}); 
				//Luego limpiamos el nombre
				$("#p_nombre").val("");
			}	
			
		});
				
		//->PARA ENVIAR POR CORREO		
		$('#vinculo_imprimir_dieta').click(function() {	
			if($("#vinculo_imprimir_dieta").css("cursor") == "pointer"){
				$('#modal_pdf').modal('toggle'); 	
			}			
		});
		
		//->Enviar PDF por correo estandar
		$('#generar_pdf_avanzado').click(function() {						
			if($("#vinculo_imprimir_dieta").css("cursor") == "pointer"){
				var url_guardar_plantilla = "<?php echo $url_app; ?>dieta-avanzada-pdf.php";			
				$("#formuario_pdf_avanzado").submit();
				$('#modal_pdf').modal('toggle'); 		
			}
		});
		
		//->Enviar dieta correo
		$('#vinculo_enviar_correo').click(function() {		
			if($("#vinculo_imprimir_dieta").css("cursor") == "pointer"){
				$('#modal_enviar_correo').modal('toggle'); 			   
			}	
		});
		
		//->Enviar PDF por corrreo
		$('#enviar_dieta_por_correo').click(function() {		
			if($("#vinculo_imprimir_dieta").css("cursor") == "pointer"){
				var url_guardar_plantilla = "<?php echo $url_app; ?>enviar-correo-dieta.php";
				$('#respuesta').html(loading);  
				$('#modal_enviar_correo').modal('toggle');				
				$.ajax({                        
					type: "POST",                 
					url: url_guardar_plantilla,                    
					data: $("#formulario_enviar_dieta_correo_estandar").serialize(),				
					success: function(data){
						$('#respuesta').html(data); 
					}
					
				}); 
			}
		});
		
		//->Enviar PDF por correo estandar
		$('#corre_estandar_pdf').click(function() {			
			var url_guardar_plantilla = "<?php echo $url_app; ?>enviar-correo-dieta-estandar.php";
			$('#respuesta').html(loading);  
			$('#modal_enviar_correo').modal('toggle');				
			$.ajax({                        
				type: "POST",                 
				url: url_guardar_plantilla,                    
				data: $("#formulario_enviar_dieta_correo_estandar").serialize(),				
				success: function(data){
					$('#respuesta').html(data); 
				}
				
			}); 
		});
		

		
		
		//-> Otras opciones
		//-> Mostar las opciones del pdf avanzado
		$('#mostrar_pdf_avanzado').click(function() {						
			if($(".pdf_opciones_avanzadas").css("display") == "block"){
				$('.pdf_opciones_avanzadas').css('display', 'none'); 
			}else{
				$('.pdf_opciones_avanzadas').css('display', 'block'); 
			}	
		});
		
		//-> Otras opciones correo
		//-> Mostar las opciones del pdf avanzado
		$('#mostrar_pdf_avanzado_2').click(function() {						
			if($(".pdf_opciones_avanzadas_2").css("display") == "block"){
				$('.pdf_opciones_avanzadas_2').css('display', 'none'); 
			}else{
				$('.pdf_opciones_avanzadas_2').css('display', 'block'); 
			}	
		});
		
		
		//Selector dinamico
		
		//->Sumar los datos del footer				
		var sumar_datos_footer = function(myRow, myCol, semana, kcal_select) {
			myRow = myRow-1;
			// var = nuevo_valor = 10;
			//Crear tabla en array
			var numero_filas = $("#example tr").length;
			var numero_columnas = $("#example tr:last td").length;
			var total=0;			
			var temporal_suma = 0;				
			$('.tabla_semana_'+semana+' tr').each(function(){						
			temporal_suma = $('td p i', this).eq(myRow).text();						
				if (!isNaN(temporal_suma))
				{
					total += Number(temporal_suma);											
				}				
			});									
			var total_final = parseFloat(kcal_select)/parseFloat(total)*100;
			total_final = Math.round(total_final);
			console.log(total_final);	
			$('.tabla_semana_'+semana+' tfoot tr th:nth-child('+myCol+')').html('<i>'+total_final+'</i>kcal');			
		};
		
		function getNumbersInString(string) {
		  var tmp = string.split("");
		  var map = tmp.map(function(current) {
			if (!isNaN(parseInt(current))) {
			  return current;
			}
		  });

		  var numbers = map.filter(function(value) {
			return value != undefined;
		  });

		  return numbers.join("");
		}
		/*
		$('#crear_imagen_jpg').click(function() {	
			
			window.takeScreenShot = function() {
				html2canvas(document.getElementsByClassName("tabla_semana_1"), {
					onrendered: function (canvas) {
						document.body.appendChild(canvas);
					},
					width:320,
					height:220
				});
			}
			html2canvas($(".tabla_semana_1"), {
				onrendered: function(canvas) {
					// canvas is the final rendered <canvas> element
					var myImage = canvas.toDataURL("image/png");
					window.open(myImage);
				}
			}
		}); */
		
		$("#crear_imagen_jpg").click(function(){
			html2canvas($(".footer"), {
				onrendered: function(canvas) {
					// canvas is the final rendered <canvas> element
					var myImage = canvas.toDataURL("image/png");
					// window.open(myImage);
					// console.log(myImage);
					document.body.appendChild(myImage);
				}
			});
		});

		function desactivar_impresion_y_pdf(){
			$('#vinculo_imprimir_dieta').css('cursor', 'default');  	
			$('#vinculo_imprimir_dieta').css('opacity', '0.5');  	
			$('#vinculo_imprimir_dieta').css('text-decoration:', 'none'); 
			$('#vinculo_enviar_correo').css('cursor', 'default');  	
			$('#vinculo_enviar_correo').css('opacity', '0.5');  	
			$('#vinculo_enviar_correo').css('text-decoration:', 'none'); 			
		}
	</script>		
	<?php $conn->close(); ?>
</body>
</html> 