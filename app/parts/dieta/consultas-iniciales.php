<?php

//Consultas iniciales de clientes
$cliente = obtener_datos_cliente_x_usuario($id_cliente);	

//Iniciamos las variables
if(empty($_POST["usar_plantilla"])){	

	//Iniciamos la variable error
	$error = 'no';

	//Iniviamos plato libre
	$plato_libre = plato_libre();
		
	
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
	
	
	
	$_SESSION['dd']['num_comidas'] 		= $num_comidas;
	$_SESSION['dd']['platos_comidas'] 	= $platos_comidas;
	$_SESSION['dd']['comida_postre'] 	= $comida_postre;
	$_SESSION['dd']['plato_cena']		= $plato_cena;
	$_SESSION['dd']['cena_postre']		= $cena_postre;
	// $_SESSION['dd']['kilocalorias_dia']	= $kilocalorias_dia;
	$_SESSION['dd']['plantilla'] 		= 'no';
	$_SESSION['dd']['fecha_inicio']		= $fecha_inicio;
	$_SESSION['dd']['kilocalorias_dia_post']		= $kilocalorias_dia;
	$_SESSION['dd']['grasas_diarias']				= $grasas_diarias;
	$_SESSION['dd']['proteinas_diarias']			= $proteinas_diarias;
	$_SESSION['dd']['hidratos_diarios']				= $hidratos_diarios;
	$_SESSION['dd']['limitar_tamano']				= $limitar_tamano;
	$_SESSION['dd']['listado_plantillas']			= $listado_plantillas;
	
	
	//-PDF Lista de consultas
	$_SESSION['pdf']['id_cliente'] 		= $id_cliente;
	
	//->PDF Datos de la clinicas	
	$_SESSION['pdf']['datos_clinica'] = datos_clinica();
		
	//->PDF Datos clinicas
	$_SESSION['pdf']['datos_cliente'] = obtener_datos_cliente_x_usuario($id_cliente);

	//-> PDF Ultima medicion del cliente	
	$_SESSION['pdf']['ultimo_peso_cliente']	= gx_ultimo_peso_cliente($id_cliente);		
	
	//->PDF Obtener grupos excluidos
	$_SESSION['pdf']['grupos_excludios'] = obtener_grupos_excluidos_x_cliente($id_cliente);
		
	//->PDF Obtener grupos
	$_SESSION['pdf']['grupos_alimentos'] = mostrar_grupos_alimentos(); 

	//->PDF Total grupos excluidos
	$_SESSION['pdf']['total_grupos'] = count($_SESSION['pdf']['grupos_alimentos']);

	//->PDF Obtener alimentos excluidos
	$_SESSION['pdf']['alimentos_excluidos']  = obtener_alimentos_excluidos_x_cliente($id_cliente);

	//->PDF Obtener alimentos
	$_SESSION['pdf']['alimentos_activos']  = listado_de_alimentos_completo(); 

	//->PDF Total alimentos excluidos
	$_SESSION['pdf']['total_alimentos']  = count($_SESSION['pdf']['alimentos_activos']);

	//->PDF Historial de pesos
	$_SESSION['pdf']['historial_pesos_grafico']  = obtener_historial_peso_cliente ($id_cliente);

	//->PDF Obtener mediciones del cliente
	$_SESSION['pdf']['historial_pesos']  = obtener_ultima_medicion_del_cliente ($id_cliente);
	
	//Total de dias que se van a mostrar en el slider
	$total_dias_dieta = '';
	//->Total Maximo de dias
	if($duracion >= 30){
		$total_dias_dieta = 30;
	}else{
		$total_dias_dieta = $duracion;
	}
	
	$_SESSION['dd']['duracion'] = $total_dias_dieta;
	
	//Eliminar
	$plato_libre = plato_libre();
	
	//Eliminar
	//Obtenemos los super grupos
	$super_grupos = gx_obtener_supergrupos();
	
	//Obtenemos los super grupos para el GetSupergrupos Array
	$super_grupos_array = gx_consultar_supergrupos_array();
	
	
	$estadisticas_dieta = generarEstadisticas($num_comidas, $platos_comidas, $comida_postre, $plato_cena, $cena_postre);
	
	$recetas = obtener_recetas_para_generar_dieta();
	
	
	// print_r($_SESSION['todas_las_recetas_desactivadas_por_el_usuario_sql']);
	
	
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
		
	//->Sin postres
	if(empty($postre_comida) AND $comida_postre == 'si' || empty($postre_comida) AND $cena_postre == 'si'){ 
		$error = 'si';
		$_SESSION['mensaje'] = 'sin_postre';	
		header('location:'.$url_app.'configurar-dieta/'.$id_cliente);
	}
	
	//Dividir en semanas
	$semana= '';
	$total_semanas = $duracion/7;
	$total_semanas_sliders = ceil($total_semanas);
	$_SESSION['dd']['total_semanas_sliders'] = $total_semanas_sliders;
	
	$total_dias_asignados  = '';	
	for ($i = 1; $i <= $total_semanas+1; $i++) {	
		$semana[$i]['semana']= $i;
		$_SESSION['dd']['contador_semana'][$i] = $i;
		if($duracion+7-($i*7) >= 7) {
			$semana[$i]['dias']= 7; 
			$_SESSION['dd']['contador_dias'][$i] = 7; 
			$total_dias_asignados += 7; 
		}else{				 	
			$semana[$i]['dias']=  abs($duracion-$total_dias_asignados); 	
			$_SESSION['dd']['contador_dias'][$i] =  abs($duracion-$total_dias_asignados); 	 
		}

	}
	
	//Borrar tabla con el usuario y cliente exacto
	borrar_gx_dieta_calendario_temporal($id_cliente);
	
	//Insertar toda la tabla con todas las recetas y cantidades	
	gx_insertar_dieta_calendario_temporal($id_cliente, $cliente['nombre'], $cliente['apellidos'], $cliente['sexo'], $cliente['peso'], $cliente['altura'], $cliente['fecha_nacimiento'], $cliente['email'],
	$cliente['recomendaciones'], $cliente['nombre_completo'], $cliente['actividad'], $cliente['imcf'], $cliente['metabolismo'], $cliente['gasto_energetico'],
	$duracion, $num_comidas, $platos_comidas, $comida_postre, $plato_cena, $cena_postre, $fecha_inicio, $kilocalorias_dia,
	$grasas_diarias, $proteinas_diarias, $hidratos_diarios, $limitar_tamano, $listado_plantillas, $total_semanas);	
	
	
	//Desordenamos los arrays
	shuffle($desayuno);
	$total_desayuno = count($desayuno)-1;
	
	//->Plato principal comida
	shuffle($plato_principal_comida);
	$total_plato_principal_comida = count($plato_principal_comida)-1; 
	
	if($num_comidas >= 5){
		shuffle($media_manana);
		$total_media_manana = count($media_manana)-1; 
	}
	if($platos_comidas == 2){
		shuffle($primer_plato_comida);
		$total_primer_plato_comida = count($primer_plato_comida)-1;
	}
	if($num_comidas >= 4){
		$total_merienda = count($merienda)-1; 
		shuffle($merienda);
	}
	if($plato_cena == 2){
		$total_primer_plato_cena = count($primer_plato_cena)-1; 
		shuffle($primer_plato_cena);
	}
	shuffle($plato_principal_cena);
	$total_plato_principal_cena = count($plato_principal_cena)-1;
	if($num_comidas >= 6){	
		$total_recena = count($recena)-1; 
		shuffle($recena);
	}	
	if($cena_postre == 'si' || $comida_postre == 'si'){
		$total_postre_comida = count($postre_comida)-1; 
		$total_postre_cena = count($postre_cena)-1; 
		shuffle($postre_comida);
		shuffle($postre_cena);	
	}				
	
	$tipo_funcion = 'standar';
	
	//Agregamos por cada dia	
	for ($s = 1; $s <= $total_semanas_sliders; $s++) { 		
		for ($i = 1; $i <= $semana[$s]['dias']; $i++) {
		
			
			$_SESSION['dd']['semana'][$s][$i]				= $s;
			$_SESSION['dd']['dia'][$s][$i]					= $i;
			
			$ronda_desayuno = rand(0,$total_desayuno);
			$_SESSION['dd']['desayuno'][$s][$i]					= 'Desayuno';
			$_SESSION['dd']['id_desayuno'][$s][$i]				= $desayuno[$ronda_desayuno]['id_receta'];
			$_SESSION['dd']['desayuno_nombre'][$s][$i]			= $desayuno[$ronda_desayuno]['nombre'];
			$_SESSION['dd']['desayuno_descripcion'][$s][$i]		= $desayuno[$ronda_desayuno]['descripcion'];
			$_SESSION['dd']['desayuno_calculo'][$s][$i]			= gx_calculo_kcal_dieta('desayuno', $kilocalorias_dia, $num_comidas, $platos_comidas, $plato_cena, $comida_postre, $cena_postre, $desayuno[$ronda_desayuno]['kcal_por_100g']);
			$_SESSION['dd']['status_desayuno'][$s][$i] 			= '';
			//->Media mañana
			if($num_comidas >= 5) {
				$ronda_media_manana = rand(0,$total_media_manana);	
				$_SESSION['dd']['media_manana'][$s][$i]					= 'Media mañana';
				$_SESSION['dd']['id_media_manana'][$s][$i]				= $media_manana[$ronda_media_manana]['id_receta'];
				$_SESSION['dd']['media_manana_nombre'][$s][$i]			= $media_manana[$ronda_media_manana]['nombre'];
				$_SESSION['dd']['media_manana_descripcion'][$s][$i]		= $media_manana[$ronda_media_manana]['descripcion'];
				$_SESSION['dd']['media_manana_calculo'][$s][$i]			= gx_calculo_kcal_dieta('media_manana', $kilocalorias_dia, $num_comidas, $platos_comidas, $plato_cena, $comida_postre, $cena_postre, $media_manana[$ronda_media_manana]['kcal_por_100g']);
				$_SESSION['dd']['status_media_manana'][$s][$i] 			= '';					
			}
			
			//->Primer plato comida
			if($platos_comidas == 2) {			
				$ronda_primer_plato_comida = rand(0,$total_primer_plato_comida);	
				$_SESSION['dd']['primer_plato_comida'][$s][$i]					= 'Primer plato comida';
				$_SESSION['dd']['id_primer_plato_comida'][$s][$i]				=  $primer_plato_comida[$ronda_primer_plato_comida]['id_receta'];				
				$_SESSION['dd']['primer_plato_comida_nombre'][$s][$i]			= $primer_plato_comida[$ronda_primer_plato_comida]['nombre'];
				$_SESSION['dd']['primer_plato_comida_descripcion'][$s][$i]		= $primer_plato_comida[$ronda_primer_plato_comida]['descripcion'];
				$_SESSION['dd']['primer_plato_comida_calculo'][$s][$i]			= gx_calculo_kcal_dieta('primer_plato_comida', $kilocalorias_dia, $num_comidas, $platos_comidas, $plato_cena, $comida_postre, $cena_postre, $primer_plato_comida[$ronda_primer_plato_comida]['kcal_por_100g']);
				$_SESSION['dd']['status_primer_plato_comida'][$s][$i] 			= '';
			}
			
			//->Plato principal comida	
			$ronda_plato_principal_comida = rand(0,$total_plato_principal_comida); 			
			$_SESSION['dd']['plato_principal_comida'][$s][$i]					= 'Plato principal comida';
			$_SESSION['dd']['id_plato_principal_comida'][$s][$i]				=  $plato_principal_comida[$ronda_plato_principal_comida]['id_receta'];
			$_SESSION['dd']['plato_principal_comida_nombre'][$s][$i]			= $plato_principal_comida[$ronda_plato_principal_comida]['nombre'];
			$_SESSION['dd']['plato_principal_comida_descripcion'][$s][$i]		= $plato_principal_comida[$ronda_plato_principal_comida]['descripcion'];
			$_SESSION['dd']['plato_principal_comida_calculo'][$s][$i]			= gx_calculo_kcal_dieta('plato_principal_comida', $kilocalorias_dia, $num_comidas, $platos_comidas, $plato_cena, $comida_postre, $cena_postre, $plato_principal_comida[$ronda_plato_principal_comida]['kcal_por_100g']);
			$_SESSION['dd']['status_plato_principal_comida'][$s][$i] 				= '';
			//->Postre comida			
			if($comida_postre == 'si'){				
				$ronda_postre_comida = rand(0,$total_postre_comida); 				
				$_SESSION['dd']['postre_comida'][$s][$i]				= 'Postre comida';
				$_SESSION['dd']['id_postre_comida'][$s][$i]				= $postre_comida[$ronda_postre_comida]['id_receta'];				
				$_SESSION['dd']['postre_comida_nombre'][$s][$i]			= $postre_comida[$ronda_postre_comida]['nombre'];
				$_SESSION['dd']['postre_comida_descripcion'][$s][$i]	= $postre_comida[$ronda_postre_comida]['descripcion'];
				$_SESSION['dd']['postre_comida_calculo'][$s][$i]		= gx_calculo_kcal_dieta('postre_comida', $kilocalorias_dia, $num_comidas, $platos_comidas, $plato_cena, $comida_postre, $cena_postre, $postre_comida[$ronda_postre_comida]['kcal_por_100g']);
				$_SESSION['dd']['status_postre_comida'][$s][$i]	= '';
			}
			
			
			//->Merienda
			if($num_comidas >= 4) {
				$ronda_merienda = rand(0,$total_merienda);
				$_SESSION['dd']['merienda'][$s][$i]						= 'Merienda';
				$_SESSION['dd']['id_merienda'][$s][$i]					= $merienda[$ronda_merienda]['id_receta'];							
				$_SESSION['dd']['merienda_nombre'][$s][$i]				= $merienda[$ronda_merienda]['nombre'];
				$_SESSION['dd']['merienda_descripcion'][$s][$i]			= $merienda[$ronda_merienda]['descripcion'];
				$_SESSION['dd']['merienda_calculo'][$s][$i]				= gx_calculo_kcal_dieta('merienda', $kilocalorias_dia, $num_comidas, $platos_comidas, $plato_cena, $comida_postre, $cena_postre, $merienda[$ronda_merienda]['kcal_por_100g']);
				$_SESSION['dd']['status_merienda'][$s][$i] 	= '';
			}
			
			//->Primer plato cena
			if($plato_cena == 2) {					
				$ronda_primer_plato_cena = rand(0,$total_primer_plato_cena); 
				$_SESSION['dd']['primer_plato_cena'][$s][$i]						= 'Primer plato cena';
				$_SESSION['dd']['id_primer_plato_cena'][$s][$i]						= $primer_plato_cena[$ronda_primer_plato_cena]['id_receta'];				
				$_SESSION['dd']['primer_plato_cena_nombre'][$s][$i]					= $primer_plato_cena[$ronda_primer_plato_cena]['nombre'];
				$_SESSION['dd']['primer_plato_cena_descripcion'][$s][$i]			= $primer_plato_cena[$ronda_primer_plato_cena]['descripcion'];
				$_SESSION['dd']['primer_plato_cena_calculo'][$s][$i]				= gx_calculo_kcal_dieta('primer_plato_cena', $kilocalorias_dia, $num_comidas, $platos_comidas, $plato_cena, $comida_postre, $cena_postre, $primer_plato_cena[$ronda_primer_plato_cena]['kcal_por_100g']);
				$_SESSION['dd']['status_primer_plato_cena'][$s][$i] 	= '';
			}
			
			//->Plato principal cena					
			$ronda_plato_principal_cena = rand(0,$total_plato_principal_cena); 
			$_SESSION['dd']['plato_principal_cena'][$s][$i]						= 'Plato principal cena';
			$_SESSION['dd']['id_plato_principal_cena'][$s][$i]					= $plato_principal_cena[$ronda_plato_principal_cena]['id_receta'];
			$_SESSION['dd']['plato_principal_cena_nombre'][$s][$i]				= $plato_principal_cena[$ronda_plato_principal_cena]['nombre'];
			$_SESSION['dd']['plato_principal_cena_descripcion'][$s][$i]			= $plato_principal_cena[$ronda_plato_principal_cena]['descripcion'];
			$_SESSION['dd']['plato_principal_cena_calculo'][$s][$i]				= gx_calculo_kcal_dieta('plato_principal_cena', $kilocalorias_dia, $num_comidas, $platos_comidas, $plato_cena, $comida_postre, $cena_postre, $plato_principal_cena[$ronda_plato_principal_cena]['kcal_por_100g']);
			$_SESSION['dd']['status_plato_principal_cena'][$s][$i] 	= '';
			
			//->Postre cena			
			if($cena_postre == 'si'){	
				$ronda_postre_cena = rand(0,$total_postre_cena); 
				$_SESSION['dd']['postre_cena'][$s][$i]						= 'Postre cena';
				$_SESSION['dd']['id_postre_cena'][$s][$i]					= $postre_cena[$ronda_postre_cena]['id_receta'];				
				$_SESSION['dd']['postre_cena_nombre'][$s][$i]				= $postre_cena[$ronda_postre_cena]['nombre'];
				$_SESSION['dd']['postre_cena_descripcion'][$s][$i]			= $postre_cena[$ronda_postre_cena]['descripcion'];
				$_SESSION['dd']['postre_cena_calculo'][$s][$i]				= gx_calculo_kcal_dieta('postre_cena', $kilocalorias_dia, $num_comidas, $platos_comidas, $plato_cena, $comida_postre, $cena_postre, $postre_cena[$ronda_postre_cena]['kcal_por_100g']);
				$_SESSION['dd']['status_postre_cena'][$s][$i] 	= '';	
			
			}
			
			//->Recena	
			if($num_comidas >= 6) {
				$ronda_recena = rand(0, $total_recena); 
				$_SESSION['dd']['recena'][$s][$i]		= 'Recena';
				$_SESSION['dd']['id_recena'][$s][$i]	= $recena[$ronda_recena]['id_receta'];				
				$_SESSION['dd']['recena_nombre'][$s][$i]		= $recena[$ronda_recena]['nombre'];
				$_SESSION['dd']['recena_descripcion'][$s][$i]		= $recena[$ronda_recena]['descripcion'];
				$_SESSION['dd']['recena_calculo'][$s][$i]		= gx_calculo_kcal_dieta('recena', $kilocalorias_dia, $num_comidas, $platos_comidas, $plato_cena, $comida_postre, $cena_postre, $recena[$ronda_recena]['kcal_por_100g']);
				$_SESSION['dd']['status_recena'][$s][$i] 	= '';
			}
			
			$_SESSION['dd']['kilocalorias_dia'][$s][$i] = number_format($kilocalorias_dia, 2, ',', '');
		}
		
	}
	
}else{
	
}

?>