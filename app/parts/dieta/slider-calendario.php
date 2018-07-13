<?php 
session_start();
include '../../parts/conex.php';
//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once '../../parts/configuracion.php';
include_once '../../parts/ayuda.php';
include '../../parts/consultas_mysql.php';


if(isset($_GET['accion'])){
	$accion 		= $_GET['accion'];
	$id_receta 		= $_GET['id_receta'];
	$fila			= $_GET['fila'];
	$columna 		= $_GET['columna'];
	
	$semana 		= solo_numero($_GET['semana']);
	$dia 			= solo_numero($_GET['dia']);
	$tipo_comida	= $_GET['tipo_comida'];
	$kcal			= $_GET['kcal'];
	$gramos			= $_GET['gramos'];
	
	
	if($accion == 'copiar'){
		//buscamos la receta
		$_SESSION['dd']['id_receta_copiada'] 		= $id_receta; 
		$_SESSION['dd']['kcal_receta_copiada'] 		= $kcal; 
		$_SESSION['dd']['gramos_receta_copiada']	= $gramos; 		
		$_SESSION['dd']['receta_copiada'] 			= obtener_receta ($id_receta); 		
		
	}
	
	if($accion == 'pegar'){		

		switch ($tipo_comida) {
			case 'desayuno':
				$_SESSION['dd']['id_desayuno'][$semana][$dia]								= $_SESSION['dd']['id_receta_copiada'];
				$_SESSION['dd']['desayuno_nombre'][$semana][$dia] 							= $_SESSION['dd']['receta_copiada']['nombre'];
				$_SESSION['dd']['desayuno_calculo'][$semana][$dia]['kcal'] 					= $_SESSION['dd']['kcal_receta_copiada'];
				$_SESSION['dd']['desayuno_calculo'][$semana][$dia]['gramos']				= $_SESSION['dd']['gramos_receta_copiada'];
				break;
			case 'media_manana':
				$_SESSION['dd']['id_media_manana'][$semana][$dia]							= $_SESSION['dd']['id_receta_copiada'];
				$_SESSION['dd']['media_manana_nombre'][$semana][$dia] 						= $_SESSION['dd']['receta_copiada']['nombre'];
				$_SESSION['dd']['media_manana_calculo'][$semana][$dia]['kcal']				= $_SESSION['dd']['kcal_receta_copiada'];
				$_SESSION['dd']['media_manana_calculo'][$semana][$dia]['gramos'] 			= $_SESSION['dd']['gramos_receta_copiada'];
				break;
			case 'primer_plato_comida':
				$_SESSION['dd']['id_primer_plato_comida'][$semana][$dia] 					= $_SESSION['dd']['id_receta_copiada'];
				$_SESSION['dd']['primer_plato_comida_nombre'][$semana][$dia]				= $_SESSION['dd']['receta_copiada']['nombre'];
				$_SESSION['dd']['primer_plato_comida_calculo'][$semana][$dia]['kcal']		= $_SESSION['dd']['kcal_receta_copiada'];
				$_SESSION['dd']['primer_plato_comida_calculo'][$semana][$dia]['gramos'] 	= $_SESSION['dd']['gramos_receta_copiada'];
				break;
			case 'plato_principal_comida':
				$_SESSION['dd']['id_plato_principal_comida'][$semana][$dia] 				= $_SESSION['dd']['id_receta_copiada'];
				$_SESSION['dd']['plato_principal_comida_nombre'][$semana][$dia] 			= $_SESSION['dd']['receta_copiada']['nombre'];
				$_SESSION['dd']['plato_principal_comida_calculo'][$semana][$dia]['kcal']	= $_SESSION['dd']['kcal_receta_copiada'];
				$_SESSION['dd']['plato_principal_comida_calculo'][$semana][$dia]['gramos'] 	= $_SESSION['dd']['gramos_receta_copiada'];
				break;
			case 'postre_comida':
				$_SESSION['dd']['id_postre_comida'][$semana][$dia] 							= $_SESSION['dd']['id_receta_copiada'];
				$_SESSION['dd']['postre_comida_nombre'][$semana][$dia] 						= $_SESSION['dd']['receta_copiada']['nombre'];
				$_SESSION['dd']['postre_comida_calculo'][$semana][$dia]['kcal']				= $_SESSION['dd']['kcal_receta_copiada'];
				$_SESSION['dd']['postre_comida_calculo'][$semana][$dia]['gramos'] 			= $_SESSION['dd']['gramos_receta_copiada'];
				break;
			case 'merienda':
				$_SESSION['dd']['id_merienda'][$semana][$dia] 								= $_SESSION['dd']['id_receta_copiada'];
				$_SESSION['dd']['merienda_nombre'][$semana][$dia] 							= $_SESSION['dd']['receta_copiada']['nombre'];
				$_SESSION['dd']['merienda_calculo'][$semana][$dia]['kcal']					= $_SESSION['dd']['kcal_receta_copiada'];
				$_SESSION['dd']['merienda_calculo'][$semana][$dia]['gramos'] 				= $_SESSION['dd']['gramos_receta_copiada'];
				break;
			case 'primer_plato_cena':
				$_SESSION['dd']['id_primer_plato_cena'][$semana][$dia] 						= $_SESSION['dd']['id_receta_copiada'];
				$_SESSION['dd']['primer_plato_cena_nombre'][$semana][$dia] 					= $_SESSION['dd']['receta_copiada']['nombre'];
				$_SESSION['dd']['primer_plato_cena_calculo'][$semana][$dia]['kcal']			= $_SESSION['dd']['kcal_receta_copiada'];
				$_SESSION['dd']['primer_plato_cena_calculo'][$semana][$dia]['gramos']		= $_SESSION['dd']['gramos_receta_copiada'];
				break;
			case 'plato_principal_cena':
				$_SESSION['dd']['id_plato_principal_cena'][$semana][$dia] 					= $_SESSION['dd']['id_receta_copiada'];
				$_SESSION['dd']['plato_principal_cena_nombre'][$semana][$dia] 				= $_SESSION['dd']['receta_copiada']['nombre'];
				$_SESSION['dd']['plato_principal_cena_calculo'][$semana][$dia]['kcal']		= $_SESSION['dd']['kcal_receta_copiada'];
				$_SESSION['dd']['plato_principal_cena_calculo'][$semana][$dia]['gramos'] 	= $_SESSION['dd']['gramos_receta_copiada'];
				break;
			case 'postre_cena':
				$_SESSION['dd']['id_postre_cena'][$semana][$dia] 							= $_SESSION['dd']['id_receta_copiada'];
				$_SESSION['dd']['postre_cena_nombre'][$semana][$dia] 						= $_SESSION['dd']['receta_copiada']['nombre'];
				$_SESSION['dd']['postre_cena_calculo'][$semana][$dia]['kcal']				= $_SESSION['dd']['kcal_receta_copiada'];
				$_SESSION['dd']['postre_cena_calculo'][$semana][$dia]['gramos'] 			= $_SESSION['dd']['gramos_receta_copiada'];
				break;
			case 'recena':
				$_SESSION['dd']['id_recena'][$semana][$dia] 								= $_SESSION['dd']['id_receta_copiada'];
				$_SESSION['dd']['recena_nombre'][$semana][$dia] 							= $_SESSION['dd']['receta_copiada']['nombre'];
				$_SESSION['dd']['recena_calculo'][$semana][$dia]['kcal']					= $_SESSION['dd']['kcal_receta_copiada'];
				$_SESSION['dd']['recena_calculo'][$semana][$dia]['gramos'] 					= $_SESSION['dd']['gramos_receta_copiada'];
				break;			
		}			
		
			
		$total_kilokalorias = $_SESSION['dd']['kilocalorias_dia'][$semana][$dia]-$kcal;		
		$total_kilokalorias = $total_kilokalorias+$_SESSION['dd']['kcal_receta_copiada'];
		
		$_SESSION['dd']['kilocalorias_dia'][$semana][$dia] = number_format($total_kilokalorias, 2, ',', '');
		
	}
	
	if($accion == 'aplicar_toda_dieta'){
		
		$datos_completos_receta = obtener_receta ($id_receta); 	
		
		//-hacer ciclo por semana y dias
		//semanas
		for ($s = 1; $s <= $_SESSION['dd']['total_semanas_sliders']; $s++) { 
			//dias
			for ($i = 1; $i <= $_SESSION['dd']['contador_dias'][$s]; $i++) {
				switch ($tipo_comida) {
					case 'desayuno':
						if($_SESSION['dd']['status_desayuno'][$s][$i] == ''){
							$_SESSION['dd']['id_desayuno'][$s][$i] 								= $id_receta;
							$_SESSION['dd']['desayuno_nombre'][$s][$i] 							= $datos_completos_receta['nombre'];
							$_SESSION['dd']['desayuno_calculo'][$s][$i]['gramos'] 				= $gramos;
						}
						break;
					case 'media_manana':
						if($_SESSION['dd']['status_media_manana'][$s][$i] == ''){
							$_SESSION['dd']['id_media_manana'][$s][$i] 							= $id_receta;
							$_SESSION['dd']['media_manana_nombre'][$s][$i] 						= $datos_completos_receta['nombre'];
							$_SESSION['dd']['media_manana_calculo'][$s][$i]['gramos']			= $gramos;
						}
						break;
					case 'primer_plato_comida':
						if($_SESSION['dd']['status_primer_plato_comida'][$s][$i] == ''){
							$_SESSION['dd']['id_primer_plato_comida'][$s][$i]					= $id_receta;
							$_SESSION['dd']['primer_plato_comida_nombre'][$s][$i]				= $datos_completos_receta['nombre'];
							$_SESSION['dd']['primer_plato_comida_calculo'][$s][$i]['gramos'] 	= $gramos;
						}
						break;
					case 'plato_principal_comida':
						if($_SESSION['dd']['status_plato_principal_comida'][$s][$i] == ''){
							$_SESSION['dd']['id_plato_principal_comida'][$s][$i] 				= $id_receta;
							$_SESSION['dd']['plato_principal_comida_nombre'][$s][$i] 			= $datos_completos_receta['nombre'];
							$_SESSION['dd']['plato_principal_comida_calculo'][$s][$i]['gramos'] = $gramos;
						}
						break;
					case 'postre_comida':
						if($_SESSION['dd']['status_postre_comida'][$s][$i] == ''){
							$_SESSION['dd']['id_postre_comida'][$s][$i] 						= $id_receta;
							$_SESSION['dd']['postre_comida_nombre'][$s][$i] 					= $datos_completos_receta['nombre'];
							$_SESSION['dd']['postre_comida_calculo'][$s][$i]['gramos'] 			= $gramos;
						}
						break;
					case 'merienda':
						if($_SESSION['dd']['status_merienda'][$s][$i] == ''){
							$_SESSION['dd']['id_merienda'][$s][$i]								 = $id_receta;
							$_SESSION['dd']['merienda_nombre'][$s][$i]							 = $datos_completos_receta['nombre'];
							$_SESSION['dd']['merienda_calculo'][$s][$i]['gramos']				 = $gramos;
						}
						break;
					case 'primer_plato_cena':
						if($_SESSION['dd']['status_primer_plato_cena'][$s][$i] == ''){
							$_SESSION['dd']['id_primer_plato_cena'][$s][$i] 					= $id_receta;
							$_SESSION['dd']['primer_plato_cena_nombre'][$s][$i] 				= $datos_completos_receta['nombre'];
							$_SESSION['dd']['primer_plato_cena_calculo'][$s][$i]['gramos'] 		= $gramos;
						}	
						break;
					case 'plato_principal_cena':
						if($_SESSION['dd']['status_plato_principal_cena'][$s][$i] == ''){
							$_SESSION['dd']['id_plato_principal_cena'][$s][$i] 					= $id_receta;
							$_SESSION['dd']['plato_principal_cena_nombre'][$s][$i]				= $datos_completos_receta['nombre'];
							$_SESSION['dd']['plato_principal_cena_calculo'][$s][$i]['gramos'] 	= $gramos;
						}
						break;
					case 'postre_cena':
						if($_SESSION['dd']['status_postre_cena'][$s][$i] == ''){
							$_SESSION['dd']['id_postre_cena'][$s][$i] 							= $id_receta;
							$_SESSION['dd']['postre_cena_nombre'][$s][$i] 						= $datos_completos_receta['nombre'];
							$_SESSION['dd']['postre_cena_calculo'][$s][$i]['gramos'] 			= $gramos;
						}
						break;
					case 'recena':
						if($_SESSION['dd']['status_recena'][$s][$i] == ''){
							$_SESSION['dd']['id_recena'][$s][$i] 								= $id_receta;
							$_SESSION['dd']['recena_nombre'][$s][$i] 							= $datos_completos_receta['nombre'];
							$_SESSION['dd']['recena_calculo'][$s][$i]['gramos'] 				= $gramos;
						}
						break;			
				}
			}	
		}
		//-hacer ciclo por semana y dias
		$total_kilokalorias = '';
		//semanas
		for ($s = 1; $s <= $_SESSION['dd']['total_semanas_sliders']; $s++) { 
			//dias
			for ($i = 1; $i <= $_SESSION['dd']['contador_dias'][$s]; $i++) {
				switch ($tipo_comida) {
					case 'desayuno':
						if($_SESSION['dd']['status_desayuno'][$s][$i] == ''){
							$total_kilokalorias = $_SESSION['dd']['kilocalorias_dia'][$s][$i]-$_SESSION['dd']['desayuno_calculo'][$s][$i]['kcal'];
							$total_kilokalorias = $total_kilokalorias+$kcal;
							$_SESSION['dd']['kilocalorias_dia'][$s][$i] = number_format($total_kilokalorias, 2, ',', '');
						}
						break;
					case 'media_manana':
						if($_SESSION['dd']['status_media_manana'][$s][$i] == ''){
							$total_kilokalorias = $_SESSION['dd']['kilocalorias_dia'][$s][$i]-$_SESSION['dd']['media_manana_calculo'][$s][$i]['kcal'];
							$total_kilokalorias = $total_kilokalorias+$kcal;
							$_SESSION['dd']['kilocalorias_dia'][$s][$i] = number_format($total_kilokalorias, 2, ',', '');
						}
						break;
					case 'primer_plato_comida':
						if($_SESSION['dd']['status_primer_plato_comida'][$s][$i] == ''){
							$total_kilokalorias = $_SESSION['dd']['kilocalorias_dia'][$s][$i]-$_SESSION['dd']['primer_plato_comida_calculo'][$s][$i]['kcal'];
							$total_kilokalorias = $total_kilokalorias+$kcal;
							$_SESSION['dd']['kilocalorias_dia'][$s][$i] = number_format($total_kilokalorias, 2, ',', '');
						}
						break;
					case 'plato_principal_comida':
						if($_SESSION['dd']['status_plato_principal_comida'][$s][$i] == ''){
							$total_kilokalorias = $_SESSION['dd']['kilocalorias_dia'][$s][$i]-$_SESSION['dd']['plato_principal_comida_calculo'][$s][$i]['kcal'];
							$total_kilokalorias = $total_kilokalorias+$kcal;
							$_SESSION['dd']['kilocalorias_dia'][$s][$i] = number_format($total_kilokalorias, 2, ',', '');
						}
						break;
					case 'postre_comida':
						if($_SESSION['dd']['status_postre_comida'][$s][$i] == ''){
							$total_kilokalorias = $_SESSION['dd']['kilocalorias_dia'][$s][$i]-$_SESSION['dd']['postre_comida_calculo'][$s][$i]['kcal'];
							$total_kilokalorias = $total_kilokalorias+$kcal;
							$_SESSION['dd']['kilocalorias_dia'][$s][$i] = number_format($total_kilokalorias, 2, ',', '');
						}
						break;
					case 'merienda':
						if($_SESSION['dd']['status_merienda'][$s][$i] == ''){
							$total_kilokalorias = $_SESSION['dd']['kilocalorias_dia'][$s][$i]-$_SESSION['dd']['merienda_calculo'][$s][$i]['kcal'];
							$total_kilokalorias = $total_kilokalorias+$kcal;
							$_SESSION['dd']['kilocalorias_dia'][$s][$i] = number_format($total_kilokalorias, 2, ',', '');
						}
						break;
					case 'primer_plato_cena':
						if($_SESSION['dd']['status_primer_plato_cena'][$s][$i] == ''){
							$total_kilokalorias = $_SESSION['dd']['kilocalorias_dia'][$s][$i]-$_SESSION['dd']['primer_plato_cena_calculo'][$s][$i]['kcal'];
							$total_kilokalorias = $total_kilokalorias+$kcal;
							$_SESSION['dd']['kilocalorias_dia'][$s][$i] = number_format($total_kilokalorias, 2, ',', '');
						}
						break;
					case 'plato_principal_cena':
						if($_SESSION['dd']['status_plato_principal_cena'][$s][$i] == ''){
							$total_kilokalorias = $_SESSION['dd']['kilocalorias_dia'][$s][$i]-$_SESSION['dd']['plato_principal_cena_calculo'][$s][$i]['kcal'];
							$total_kilokalorias = $total_kilokalorias+$kcal;
							$_SESSION['dd']['kilocalorias_dia'][$s][$i] = number_format($total_kilokalorias, 2, ',', '');
						}
						break;
					case 'postre_cena':
						if($_SESSION['dd']['status_postre_cena'][$s][$i] == ''){
							$total_kilokalorias = $_SESSION['dd']['kilocalorias_dia'][$s][$i]-$_SESSION['dd']['postre_cena_calculo'][$s][$i]['kcal'];
							$total_kilokalorias = $total_kilokalorias+$kcal;
							$_SESSION['dd']['kilocalorias_dia'][$s][$i] = number_format($total_kilokalorias, 2, ',', '');
						}
						break;
					case 'recena':
						if($_SESSION['dd']['status_recena'][$s][$i] == ''){
							$total_kilokalorias = $_SESSION['dd']['kilocalorias_dia'][$s][$i]-$_SESSION['dd']['recena_calculo'][$s][$i]['kcal'];
							$total_kilokalorias = $total_kilokalorias+$kcal;
							$_SESSION['dd']['kilocalorias_dia'][$s][$i] = number_format($total_kilokalorias, 2, ',', '');
						}
						break;			
				}			
				
				
				
				
				$total_kilokalorias = '';
			}	
		}
	}
	
	//->Bloquear y Desbloquear	
	if($accion == 'bloquear_desbloquear'){
		
		$bloqueo_desbloqueo = $_GET['bloqueo_desbloqueo'];
		if($bloqueo_desbloqueo  == 'block_td'){
			$bloqueo_desbloqueo  = '';
		}else{
			$bloqueo_desbloqueo  = 'block_td';
		}
		
		switch ($tipo_comida) {
			case 'desayuno':				
				$_SESSION['dd']['status_desayuno'][$semana][$dia] 	= $bloqueo_desbloqueo;
				break;			
			case 'media_manana':
				$_SESSION['dd']['status_media_manana'][$semana][$dia] 	= $bloqueo_desbloqueo;
				break;			
			case 'primer_plato_comida':
				$_SESSION['dd']['status_primer_plato_comida'][$semana][$dia] 	= $bloqueo_desbloqueo;
				break;				
			case 'plato_principal_comida':
				$_SESSION['dd']['status_plato_principal_comida'][$semana][$dia] 	= $bloqueo_desbloqueo;
				break;			
			case 'postre_comida':				
				$_SESSION['dd']['status_postre_comida'][$semana][$dia] 	= $bloqueo_desbloqueo;
				break;
			case 'merienda':
				$_SESSION['dd']['status_merienda'][$semana][$dia] 	= $bloqueo_desbloqueo;
				break;
			case 'primer_plato_cena':
				$_SESSION['dd']['status_primer_plato_cena'][$semana][$dia] 	= $bloqueo_desbloqueo;
				break;
			case 'plato_principal_cena':
				$_SESSION['dd']['status_plato_principal_cena'][$semana][$dia] 	= $bloqueo_desbloqueo;
				break;
			case 'postre_cena':
				$_SESSION['dd']['status_postre_cena'][$semana][$dia] 	= $bloqueo_desbloqueo;
				break;
			case 'recena':
				$_SESSION['dd']['status_recena'][$semana][$dia] 	= $bloqueo_desbloqueo;
				break;			
		}	
		
	}
	
	//->cambiar receta
	if($accion == 'cambiar_receta'){
		$nueva_id_receta	= $_GET['nueva_id_receta'];
		$receta_a_cambiar = obtener_receta($nueva_id_receta);
		
		
		switch ($tipo_comida) {
			case 'desayuno':
				$_SESSION['dd']['id_desayuno'][$semana][$dia]								= $nueva_id_receta;
				$_SESSION['dd']['desayuno_nombre'][$semana][$dia] 							= $receta_a_cambiar['nombre'];				
				break;
			case 'media_manana':
				$_SESSION['dd']['id_media_manana'][$semana][$dia]							= $nueva_id_receta;
				$_SESSION['dd']['media_manana_nombre'][$semana][$dia] 						= $receta_a_cambiar['nombre'];				
				break;
			case 'primer_plato_comida':
				$_SESSION['dd']['id_primer_plato_comida'][$semana][$dia] 					= $nueva_id_receta;
				$_SESSION['dd']['primer_plato_comida_nombre'][$semana][$dia]				= $receta_a_cambiar['nombre'];				
				break;
			case 'plato_principal_comida':
				$_SESSION['dd']['id_plato_principal_comida'][$semana][$dia] 				= $nueva_id_receta;
				$_SESSION['dd']['plato_principal_comida_nombre'][$semana][$dia] 			= $receta_a_cambiar['nombre'];					
				break;
			case 'postre_comida':
				$_SESSION['dd']['id_postre_comida'][$semana][$dia] 							= $nueva_id_receta;
				$_SESSION['dd']['postre_comida_nombre'][$semana][$dia] 						= $receta_a_cambiar['nombre'];				
				break;
			case 'merienda':
				$_SESSION['dd']['id_merienda'][$semana][$dia] 								= $nueva_id_receta;
				$_SESSION['dd']['merienda_nombre'][$semana][$dia] 							= $receta_a_cambiar['nombre'];						
				break;
			case 'primer_plato_cena':
				$_SESSION['dd']['id_primer_plato_cena'][$semana][$dia] 						= $nueva_id_receta;
				$_SESSION['dd']['primer_plato_cena_nombre'][$semana][$dia] 					= $receta_a_cambiar['nombre'];					
				break;
			case 'plato_principal_cena':
				$_SESSION['dd']['id_plato_principal_cena'][$semana][$dia] 					= $nueva_id_receta;
				$_SESSION['dd']['plato_principal_cena_nombre'][$semana][$dia] 				= $receta_a_cambiar['nombre'];					
				break;
			case 'postre_cena':
				$_SESSION['dd']['id_postre_cena'][$semana][$dia] 							= $nueva_id_receta;
				$_SESSION['dd']['postre_cena_nombre'][$semana][$dia] 						= $receta_a_cambiar['nombre'];					
				break;
			case 'recena':
				$_SESSION['dd']['id_recena'][$semana][$dia] 								= $nueva_id_receta;
				$_SESSION['dd']['recena_nombre'][$semana][$dia] 							= $receta_a_cambiar['nombre'];					
				break;			
		}
	}

	//->Marcar Libre
	if($accion == 'marcar_libre'){
		
		switch ($tipo_comida) {
			case 'desayuno':
				$_SESSION['dd']['id_desayuno'][$semana][$dia]								= 0;
				$_SESSION['dd']['desayuno_nombre'][$semana][$dia] 							= 'Plato Libre';
				$_SESSION['dd']['desayuno_calculo'][$semana][$dia]['gramos']				= '';		
				$_SESSION['dd']['desayuno_calculo'][$semana][$dia]['g'] 					= '';	
				break;
			case 'media_manana':
				$_SESSION['dd']['id_media_manana'][$semana][$dia]							= 0;
				$_SESSION['dd']['media_manana_nombre'][$semana][$dia] 						= 'Plato Libre';				
				$_SESSION['dd']['media_manana_calculo'][$semana][$dia]['gramos']			= '';		
				$_SESSION['dd']['media_manana_calculo'][$semana][$dia]['g']					= '';	
				break;
			case 'primer_plato_comida':
				$_SESSION['dd']['id_primer_plato_comida'][$semana][$dia] 					= 0;
				$_SESSION['dd']['primer_plato_comida_nombre'][$semana][$dia]				= 'Plato Libre';	
				$_SESSION['dd']['primer_plato_comida_calculo'][$semana][$dia]['gramos']		= '';		
				$_SESSION['dd']['primer_plato_comida_calculo'][$semana][$dia]['g']  		 = '';	
				break;
			case 'plato_principal_comida':
				$_SESSION['dd']['id_plato_principal_comida'][$semana][$dia] 				= 0;
				$_SESSION['dd']['plato_principal_comida_nombre'][$semana][$dia] 			= 'Plato Libre';				
				$_SESSION['dd']['plato_principal_comida_calculo'][$semana][$dia]['gramos']	= '';		
				$_SESSION['dd']['plato_principal_comida_calculo'][$semana][$dia]['g']		= '';	
				break;
			case 'postre_comida':
				$_SESSION['dd']['id_postre_comida'][$semana][$dia] 							= 0;
				$_SESSION['dd']['postre_comida_nombre'][$semana][$dia] 						= 'Plato Libre';				
				$_SESSION['dd']['postre_comida_calculo'][$semana][$dia]['gramos']			= '';		
				$_SESSION['dd']['postre_comida_calculo'][$semana][$dia]['g']  	 			= '';	
				break;
			case 'merienda':
				$_SESSION['dd']['id_merienda'][$semana][$dia] 								= 0;
				$_SESSION['dd']['merienda_nombre'][$semana][$dia] 							= 'Plato Libre';		
				$_SESSION['dd']['merienda_calculo'][$semana][$dia]['gramos']				= '';			
				$_SESSION['dd']['merienda_calculo'][$semana][$dia]['g']  	 				= '';	
				break;
			case 'primer_plato_cena':
				$_SESSION['dd']['id_primer_plato_cena'][$semana][$dia] 						= 0;
				$_SESSION['dd']['primer_plato_cena_nombre'][$semana][$dia] 					= 'Plato Libre';
				$_SESSION['dd']['primer_plato_cena_calculo'][$semana][$dia]['gramos']		= '';			
				$_SESSION['dd']['primer_plato_cena_calculo'][$semana][$dia]['g']			= '';					
				break;
			case 'plato_principal_cena':
				$_SESSION['dd']['id_plato_principal_cena'][$semana][$dia] 					= 0;
				$_SESSION['dd']['plato_principal_cena_nombre'][$semana][$dia] 				= 'Plato Libre';	
				$_SESSION['dd']['plato_principal_cena_calculo'][$semana][$dia]['gramos']	= '';			
				$_SESSION['dd']['plato_principal_cena_calculo'][$semana][$dia]['g']			= '';						
				break;
			case 'postre_cena':
				$_SESSION['dd']['id_postre_cena'][$semana][$dia] 							= 0;
				$_SESSION['dd']['postre_cena_nombre'][$semana][$dia] 						= 'Plato Libre';	
				$_SESSION['dd']['postre_cena_calculo'][$semana][$dia]['gramos']				= '';			
				$_SESSION['dd']['postre_cena_calculo'][$semana][$dia]['g']					= '';	
				break;
			case 'recena':
				$_SESSION['dd']['id_recena'][$semana][$dia] 								= 0;
				$_SESSION['dd']['recena_nombre'][$semana][$dia] 							= 'Plato Libre';
				$_SESSION['dd']['recena_calculo'][$semana][$dia]['gramos']					= '';		
				$_SESSION['dd']['recena_calculo'][$semana][$dia]['g']						= '';
				break;			
		}
	}

	//->Marcar Libre
	if($accion == 'modificar_peso_comida'){
		
		$nuevo_valor_peso = $_GET['nuevo_valor_peso'];
		
		if(!empty($nuevo_valor_peso) || $nuevo_valor_peso != 0){					
				
			switch ($tipo_comida) {
				case 'desayuno':				
					$_SESSION['dd']['desayuno_calculo'][$semana][$dia]['gramos']		= $nuevo_valor_peso;
					$_SESSION['dd']['kilocalorias_dia'][$semana][$dia] 					= $_SESSION['dd']['kilocalorias_dia'][$semana][$dia]+$_SESSION['dd']['desayuno_calculo'][$semana][$dia]['kcal']*$nuevo_valor_peso/$_SESSION['dd']['desayuno_calculo'][$semana][$dia]['gramos']-$_SESSION['dd']['desayuno_calculo'][$semana][$dia]['kcal'];
					break;
				case 'media_manana':				
					$_SESSION['dd']['media_manana_calculo'][$semana][$idia]['gramos']			= $nuevo_valor_peso;				
					$_SESSION['dd']['kilocalorias_dia'][$semana][$dia] 					= $_SESSION['dd']['kilocalorias_dia'][$semana][$dia]+$_SESSION['dd']['media_manana_calculo'][$semana][$dia]['kcal']*$nuevo_valor_peso/$_SESSION['dd']['desayuno_calculo'][$semana][$dia]['gramos']-$_SESSION['dd']['desayuno_calculo'][$semana][$dia]['kcal'];
					break;
				case 'primer_plato_comida':				
					$_SESSION['dd']['primer_plato_comida_calculo'][$semana][$dia]['gramos'] 	= $nuevo_valor_peso;		
					$_SESSION['dd']['kilocalorias_dia'][$semana][$dia] 					= $_SESSION['dd']['kilocalorias_dia'][$semana][$dia]+$_SESSION['dd']['primer_plato_comida_calculo'][$semana][$dia]['kcal']*$nuevo_valor_peso/$_SESSION['dd']['desayuno_calculo'][$semana][$dia]['gramos']-$_SESSION['dd']['desayuno_calculo'][$semana][$dia]['kcal'];	
					break;
				case 'plato_principal_comida':				
					$_SESSION['dd']['plato_principal_comida_calculo'][$semana][$dia]['gramos'] = $nuevo_valor_peso;				
					$_SESSION['dd']['kilocalorias_dia'][$semana][$dia] 					= $_SESSION['dd']['kilocalorias_dia'][$semana][$dia]+$_SESSION['dd']['plato_principal_comida_calculo'][$semana][$dia]['kcal']*$nuevo_valor_peso/$_SESSION['dd']['desayuno_calculo'][$semana][$dia]['gramos']-$_SESSION['dd']['desayuno_calculo'][$semana][$dia]['kcal'];	
					break;
				case 'postre_comida':				
					$_SESSION['dd']['postre_comida_calculo'][$semana][$dia]['gramos'] 			= $nuevo_valor_peso;				
					$_SESSION['dd']['kilocalorias_dia'][$semana][$dia] 					= $_SESSION['dd']['kilocalorias_dia'][$semana][$dia]+$_SESSION['dd']['postre_comida_calculo'][$semana][$dia]['kcal']*$nuevo_valor_peso/$_SESSION['dd']['desayuno_calculo'][$semana][$dia]['gramos']-$_SESSION['dd']['desayuno_calculo'][$semana][$dia]['kcal'];	
					break;
				case 'merienda':				
					$_SESSION['dd']['merienda_calculo'][$semana][$dia]['gramos']				 = $nuevo_valor_peso;				
					$_SESSION['dd']['kilocalorias_dia'][$semana][$dia] 					= $_SESSION['dd']['kilocalorias_dia'][$semana][$dia]+$_SESSION['dd']['merienda_calculo'][$semana][$dia]['kcal']*$nuevo_valor_peso/$_SESSION['dd']['desayuno_calculo'][$semana][$dia]['gramos']-$_SESSION['dd']['desayuno_calculo'][$semana][$dia]['kcal'];	
					break;
				case 'primer_plato_cena':				
					$_SESSION['dd']['primer_plato_cena_calculo'][$semana][$dia]['gramos'] 		= $nuevo_valor_peso;					
					$_SESSION['dd']['kilocalorias_dia'][$semana][$dia] 					= $_SESSION['dd']['kilocalorias_dia'][$semana][$dia]+$_SESSION['dd']['primer_plato_cena_calculo'][$semana][$dia]['kcal']*$nuevo_valor_peso/$_SESSION['dd']['desayuno_calculo'][$semana][$dia]['gramos']-$_SESSION['dd']['desayuno_calculo'][$semana][$dia]['kcal'];	
					break;
				case 'plato_principal_cena':				
					$_SESSION['dd']['plato_principal_cena_calculo'][$semana][$dia]['gramos'] 	= $nuevo_valor_peso;				
					$_SESSION['dd']['kilocalorias_dia'][$semana][$dia] 					= $_SESSION['dd']['kilocalorias_dia'][$semana][$dia]+$_SESSION['dd']['plato_principal_cena_calculo'][$semana][$dia]['kcal']*$nuevo_valor_peso/$_SESSION['dd']['desayuno_calculo'][$semana][$dia]['gramos']-$_SESSION['dd']['desayuno_calculo'][$semana][$dia]['kcal'];	
					break;
				case 'postre_cena':				
					$_SESSION['dd']['postre_cena_calculo'][$semana][$dia]['gramos'] 			= $nuevo_valor_peso;				
					$_SESSION['dd']['kilocalorias_dia'][$semana][$dia] 					= $_SESSION['dd']['kilocalorias_dia'][$semana][$dia]+$_SESSION['dd']['postre_cena_calculo'][$semana][$dia]['kcal']*$nuevo_valor_peso/$_SESSION['dd']['desayuno_calculo'][$semana][$dia]['gramos']-$_SESSION['dd']['desayuno_calculo'][$semana][$dia]['kcal'];	
					break;
				case 'recena':							
					$_SESSION['dd']['recena_calculo'][$semana][$dia]['gramos'] 				= $nuevo_valor_peso;				
					$_SESSION['dd']['kilocalorias_dia'][$semana][$dia] 					= $_SESSION['dd']['kilocalorias_dia'][$semana][$dia]+$_SESSION['dd']['recena_calculo'][$semana][$dia]['kcal']*$nuevo_valor_peso/$_SESSION['dd']['desayuno_calculo'][$semana][$dia]['gramos']-$_SESSION['dd']['desayuno_calculo'][$semana][$dia]['kcal'];	
					break;			
			}
		}
				
		$_SESSION['dd']['kilocalorias_dia'][$semana][$dia] = number_format($_SESSION['dd']['kilocalorias_dia'][$semana][$dia], 2, ',', '');
	}	

}




$semana_activa = 1;
if(isset($semana)){ $semana_activa = $semana; }

?>
<!-- Calendario -->		
<div id="contenedor_slider" class="carousel slide" data-ride="carousel" data-type="multi" data-interval="false">
	<div class="carousel-inner">	
<?php $s = 1; ?>
<?php for ($s = 1; $s <= $_SESSION['dd']['total_semanas_sliders']; $s++) { ?>				
<div class="ibox-content item <?php if($s == $semana_activa){  echo 'active';  }else { }?>">
	<h3>Semana <?php  echo flecha_prev ($_SESSION['dd']['contador_semana'][$s], $_SESSION['dd']['total_semanas_sliders'] ); ?> de <?php echo flecha_next ($_SESSION['dd']['contador_semana'][$s], $_SESSION['dd']['total_semanas_sliders'] ); ?></h3>	
	<table id="example" class="table table-striped dataTables-example tabla_semana_<?php echo $s; ?>">
		<thead>
		  <tr>
			<th>Tipo de comida</th>
			<?php for ($i = 1; $i <= $_SESSION['dd']['contador_dias'][$s]; $i++) { ?>
			<th>Dia <?php echo $i; ?> <span class="gramos_title">g</span></th>		
			<?php $pdf_dias[$i]['dia']= $i; ?>
			<?php } ?>
		  </tr>
		</thead>							
		<tbody>
			<tr>
				<td>Desayuno</td>
				<?php for ($i = 1; $i <= $_SESSION['dd']['contador_dias'][$s]; $i++) { ?>																		
				<td  data-toggle="modal" data-target="#listado_opciones" class="semana_<?php echo $s; ?> dia_<?php echo $i; ?> desayuno <?php echo $_SESSION['dd']['status_desayuno'][$s][$i]; ?>" 
				kcal="<?php echo $_SESSION['dd']['desayuno_calculo'][$s][$i]['kcal']; ?>" 
				code="<?php echo $_SESSION['dd']['id_desayuno'][$s][$i]; ?>" 
				gramos="<?php echo $_SESSION['dd']['desayuno_calculo'][$s][$i]['gramos']; ?>">
				<p class="detalle_comida"><?php echo salida_nombre($_SESSION['dd']['desayuno_nombre'][$s][$i]); ?></p>									
				<p class="gramos"><i><?php echo $_SESSION['dd']['desayuno_calculo'][$s][$i]['gramos']; ?></i><?php echo $_SESSION['dd']['desayuno_calculo'][$s][$i]['g']; ?></p>
				</td>									
				<?php } ?>
			</tr>
			<?php if($_SESSION['dd']['num_comidas'] >= 5) { ?>
			<tr>
				<td>Media mañana</td>
				<?php for ($i = 1; $i <= $_SESSION['dd']['contador_dias'][$s]; $i++) { ?>																										
				<td data-toggle="modal" data-target="#listado_opciones"  class="semana_<?php echo $s; ?> dia_<?php echo $i; ?> media_manana <?php echo $_SESSION['dd']['status_media_manana'][$s][$i]; ?>"  
				kcal="<?php echo $_SESSION['dd']['media_manana_calculo'][$s][$i]['kcal']; ?>" 
				code="<?php echo $_SESSION['dd']['id_media_manana'][$s][$i]; ?>" 
				gramos="<?php echo $_SESSION['dd']['media_manana_calculo'][$s][$i]['gramos']; ?>">
				<p class="detalle_comida"><?php echo salida_nombre($_SESSION['dd']['media_manana_nombre'][$s][$i]); ?></p>									
				<p class="gramos"><i><?php echo $_SESSION['dd']['media_manana_calculo'][$s][$i]['gramos']; ?></i><?php echo $_SESSION['dd']['media_manana_calculo'][$s][$i]['g']; ?></p>									
				</td>									
				<?php } ?>
			</tr>
			<?php } ?>
			<?php if($_SESSION['dd']['platos_comidas'] == 2) { ?>
			<tr>
				<td>Primer plato comida</td>
				<?php for ($i = 1; $i <= $_SESSION['dd']['contador_dias'][$s]; $i++) { ?>	
				<td data-toggle="modal" data-target="#listado_opciones" class="semana_<?php echo $s; ?> dia_<?php echo $i; ?> primer_plato_comida <?php echo $_SESSION['dd']['status_primer_plato_comida'][$s][$i]; ?>" 
				kcal="<?php echo $_SESSION['dd']['primer_plato_comida_calculo'][$s][$i]['kcal']; ?>" 
				code="<?php echo $_SESSION['dd']['id_primer_plato_comida'][$s][$i]; ?>" 
				gramos="<?php echo $_SESSION['dd']['primer_plato_comida_calculo'][$s][$i]['gramos']; ?>">
				<p class="detalle_comida"><?php echo salida_nombre($_SESSION['dd']['primer_plato_comida_nombre'][$s][$i]); ?></p>									
				<p class="gramos"><i><?php echo $_SESSION['dd']['primer_plato_comida_calculo'][$s][$i]['gramos']; ?></i><?php echo $_SESSION['dd']['primer_plato_comida_calculo'][$s][$i]['g']; ?></p>										
				</td>	
				<?php } ?>
			</tr>
			<?php } ?>
			<tr>
				<td>Plato principal comida</td>
				<?php for ($i = 1; $i <= $_SESSION['dd']['contador_dias'][$s]; $i++) { ?>
				<td data-toggle="modal" data-target="#listado_opciones"  class="semana_<?php echo $s; ?> dia_<?php echo $i; ?> plato_principal_comida <?php echo $_SESSION['dd']['status_plato_principal_comida'][$s][$i]; ?>" 
				kcal="<?php echo $_SESSION['dd']['plato_principal_comida_calculo'][$s][$i]['kcal']; ?>" 
				code="<?php echo $_SESSION['dd']['id_plato_principal_comida'][$s][$i]; ?>" 
				gramos="<?php echo $_SESSION['dd']['plato_principal_comida_calculo'][$s][$i]['gramos']; ?>">
				<p class="detalle_comida"><?php echo salida_nombre($_SESSION['dd']['plato_principal_comida_nombre'][$s][$i]); ?></p>									
				<p class="gramos"><i><?php echo $_SESSION['dd']['plato_principal_comida_calculo'][$s][$i]['gramos']; ?></i><?php echo $_SESSION['dd']['plato_principal_comida_calculo'][$s][$i]['g']; ?></p>										
				</td>	
				<?php } ?>
			</tr>
			<?php if($_SESSION['dd']['comida_postre'] == 'si') {?>
			<tr>
				<td>Postre comida</td>
				<?php for ($i = 1; $i <= $_SESSION['dd']['contador_dias'][$s]; $i++) { ?>
				<td data-toggle="modal" data-target="#listado_opciones" class="semana_<?php echo $s; ?> dia_<?php echo $i; ?> postre_comida <?php echo $_SESSION['dd']['status_postre_comida'][$s][$i]; ?>" 
				kcal="<?php echo $_SESSION['dd']['postre_comida_calculo'][$s][$i]['kcal']; ?>" 
				code="<?php echo $_SESSION['dd']['id_postre_comida'][$s][$i]; ?>" 
				gramos="<?php echo $_SESSION['dd']['postre_comida_calculo'][$s][$i]['gramos']; ?>">
				<p class="detalle_comida"><?php echo salida_nombre($_SESSION['dd']['postre_comida_nombre'][$s][$i]); ?></p>									
				<p class="gramos"><i><?php echo $_SESSION['dd']['postre_comida_calculo'][$s][$i]['gramos']; ?></i><?php echo $_SESSION['dd']['postre_comida_calculo'][$s][$i]['g']; ?></p>									
				</td>
				<?php } ?>
			</tr>
			<?php } ?>
			<?php if($_SESSION['dd']['num_comidas'] >= 4) {?>
			<tr>
				<td>Merienda</td>
				<?php for ($i = 1; $i <= $_SESSION['dd']['contador_dias'][$s]; $i++) { ?>
				<td data-toggle="modal" data-target="#listado_opciones" class="semana_<?php echo $s; ?> dia_<?php echo $i; ?> merienda <?php echo $_SESSION['dd']['status_merienda'][$s][$i]; ?>" 
				kcal="<?php echo $_SESSION['dd']['merienda_calculo'][$s][$i]['kcal']; ?>" 
				code="<?php echo $_SESSION['dd']['id_merienda'][$s][$i]; ?>" 
				gramos="<?php echo $_SESSION['dd']['merienda_calculo'][$s][$i]['gramos']; ?>">
				<p class="detalle_comida"><?php echo salida_nombre($_SESSION['dd']['merienda_nombre'][$s][$i]); ?></p>									
				<p class="gramos"><i><?php echo $_SESSION['dd']['merienda_calculo'][$s][$i]['gramos']; ?></i><?php echo $_SESSION['dd']['merienda_calculo'][$s][$i]['g']; ?></p>									
				</td>
				<?php } ?>
			</tr>
			<?php } ?>
			<?php if($_SESSION['dd']['plato_cena'] == 2) {?>
			<tr>
				<td>Primer plato cena</td>
				<?php for ($i = 1; $i <= $_SESSION['dd']['contador_dias'][$s]; $i++) { ?>
				<td data-toggle="modal" data-target="#listado_opciones" class="semana_<?php echo $s; ?> dia_<?php echo $i; ?> primer_plato_cena <?php echo $_SESSION['dd']['status_primer_plato_cena'][$s][$i]; ?>" 
				kcal="<?php echo $_SESSION['dd']['primer_plato_cena_calculo'][$s][$i]['kcal']; ?>" 
				code="<?php echo $_SESSION['dd']['id_primer_plato_cena'][$s][$i]; ?>"
				gramos="<?php echo $_SESSION['dd']['primer_plato_cena_calculo'][$s][$i]['gramos']; ?>">
				<p class="detalle_comida"><?php echo salida_nombre($_SESSION['dd']['primer_plato_cena_nombre'][$s][$i]); ?></p>									
				<p class="gramos"><i><?php echo $_SESSION['dd']['primer_plato_cena_calculo'][$s][$i]['gramos']; ?></i><?php echo $_SESSION['dd']['primer_plato_cena_calculo'][$s][$i]['g']; ?></p>										
				</td>
				<?php } ?>
			</tr>
			<?php } ?>
			<tr>
				<td>Plato principal cena</td>
				<?php for ($i = 1; $i <= $_SESSION['dd']['contador_dias'][$s]; $i++) { ?>
				<td data-toggle="modal" data-target="#listado_opciones" class="semana_<?php echo $s; ?> dia_<?php echo $i; ?> plato_principal_cena <?php echo $_SESSION['dd']['status_plato_principal_cena'][$s][$i]; ?>" 
				kcal="<?php echo $_SESSION['dd']['plato_principal_cena_calculo'][$s][$i]['kcal']; ?>" 
				code="<?php echo $_SESSION['dd']['id_plato_principal_cena'][$s][$i]; ?>"
				gramos="<?php echo $_SESSION['dd']['plato_principal_cena_calculo'][$s][$i]['gramos']; ?>">
				<p class="detalle_comida"><?php echo salida_nombre($_SESSION['dd']['plato_principal_cena_nombre'][$s][$i]); ?></p>									
				<p class="gramos"><i><?php echo $_SESSION['dd']['plato_principal_cena_calculo'][$s][$i]['gramos']; ?></i><?php echo $_SESSION['dd']['plato_principal_cena_calculo'][$s][$i]['g']; ?></p>									
				</td>
				<?php } ?>
			</tr>
			<?php if($_SESSION['dd']['cena_postre'] == 'si') {?>
			<tr>
				<td>Postre cena</td>									
				<?php for ($i = 1; $i <= $_SESSION['dd']['contador_dias'][$s]; $i++) { ?>
				<td data-toggle="modal" data-target="#listado_opciones" class="semana_<?php echo $s; ?> dia_<?php echo $i; ?> postre_cena <?php echo $_SESSION['dd']['status_postre_cena'][$s][$i]; ?>" 
				kcal="<?php echo $_SESSION['dd']['postre_cena_calculo'][$s][$i]['kcal']; ?>" 
				code="<?php echo $_SESSION['dd']['id_postre_cena'][$s][$i]; ?>"
				gramos="<?php echo $_SESSION['dd']['postre_cena_calculo'][$s][$i]['gramos']; ?>">
				<p class="detalle_comida"><?php echo salida_nombre($_SESSION['dd']['postre_cena_nombre'][$s][$i]); ?></p>									
				<p class="gramos"><i><?php echo $_SESSION['dd']['postre_cena_calculo'][$s][$i]['gramos']; ?></i><?php echo $_SESSION['dd']['postre_cena_calculo'][$s][$i]['g']; ?></p>									
				</td>
				<?php } ?>
			</tr>
			<?php } ?>
			<?php if($_SESSION['dd']['num_comidas'] >= 6) {?>
			<tr>
				<td>Recena</td>
				<?php for ($i = 1; $i <= $_SESSION['dd']['contador_dias'][$s]; $i++) { ?>
				<td data-toggle="modal" data-target="#listado_opciones" class="semana_<?php echo $s; ?> dia_<?php echo $i; ?> recena <?php echo $_SESSION['dd']['status_recena'][$s][$i]; ?>" 
				kcal="<?php echo $_SESSION['dd']['recena_calculo'][$s][$i]['kcal']; ?>" 
				code="<?php echo $_SESSION['dd']['id_recena'][$s][$i]; ?>" 
				gramos="<?php echo $_SESSION['dd']['recena_calculo'][$s][$i]['gramos']; ?>">
				<p class="detalle_comida"><?php echo salida_nombre($_SESSION['dd']['recena_nombre'][$s][$i]); ?></p>									
				<p class="gramos"><i><?php echo $_SESSION['dd']['recena_calculo'][$s][$i]['gramos']; ?></i><?php echo $_SESSION['dd']['recena_calculo'][$s][$i]['g']; ?></p>										
				</td>
				<?php } ?>
			</tr>
			<?php } ?>
		</tbody>
		<tfoot>
			<tr>
				<th class="pdf_eliminar"></th>
				<?php for ($i = 1; $i <= $_SESSION['dd']['contador_dias'][$s]; $i++) { ?>
				<th class="pdf_eliminar"><i><?php echo $_SESSION['dd']['kilocalorias_dia'][$s][$i]; ?> </i> kcal</th>
				<?php } ?>
			</tr>
		</tfoot>
  </table>	 
</div>
<?php  }  ?>
	</div>
</div>

<!-- Fin Calendario -->