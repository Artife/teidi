<?php
session_start();
include 'parts/conex.php';
$pagina = 'Editar Receta';
$migas = array('Lista Recetas');
$migas_url = array('lista-recetas');

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';

$id    =  $_GET['id']; 
$todos_los_ingredientes_a_mostrar = [];

//Obtener_alimentos
$receta = obtener_receta($id);

//Validar que el usuario tenga acceso a esta receta
if($receta['id_usuario'] != $_SESSION['id_usuario'] AND $receta['id_usuario'] != 0){
	$_SESSION['mensaje'] = 'receta_de_otro_usuario';
	header('location:'.$url_app.'lista-recetas-desactivadas');
}

//Obtener ingestas 
$ingestas = obtener_ingestas($id);

//Obtener ingredientes
$ingredientes = obtener_ingredientes($id);

//Agregar los ingredientes a una lista
$todos_los_ingredientes = '';
$cantidad_de_ingredientes = 0;
$cantidad_total = 0;
foreach ($ingredientes as &$lista_ingredientes) { 
	if($lista_ingredientes['id_alimento'] != '') {
		 $todos_los_ingredientes .= $todos_los_ingredientes."'".$lista_ingredientes['id_alimento']."'".',';	
		 $cantidad_total = $cantidad_total+$lista_ingredientes['cantidad'];	
		 $cantidad_de_ingredientes++;
	}    
}
$cantidad_total;

// print_r ($ingestas); 
//Quitamos la ultima coma
if($cantidad_de_ingredientes > 0){
 $todos_los_ingredientes = substr($todos_los_ingredientes, 0, -1);
}

$listado_ingredientes = obtener_cantidades_recetas($todos_los_ingredientes, $id);
$i_continue = 0;
for ($i = 0; $i <= count($ingredientes); $i++) {	
	if(isset($ingredientes[$i]['id_alimento'])){
		$datos_alimento[$i] = obtener_informacion_nutricional($ingredientes[$i]['id_alimento'], $ingredientes[$i]['cantidad']); 
		$todos_los_ingredientes_a_mostrar[$i]['id'] = $ingredientes[$i]['id_alimento'];
		$todos_los_ingredientes_a_mostrar[$i]['cantidad'] = $ingredientes[$i]['cantidad'];
		$i_continue++;
	}
}


$ids_nuevos_ingredientes = [];
$s = 0;
//Nuevos ingredientes Anadidos
foreach($_POST as $nombre => $valor)  {	
	//echo $nombre.' - '.$valor.'<br>';
	//nuevo_ingrediente_
	if (substr($nombre, 0, 18) == 'nuevo_ingrediente_'){		
		$ids_nuevos_ingredientes[$s] = substr($nombre, 18);		
		$s++;
	}   
}
// print_r ($ids_nuevos_ingredientes);
// Array ( [0] => 12 [1] => 13 [2] => 22 )
if (!empty($_POST["tabla_agregar_alimento_length"])) {
	for ($i = 0; $i <= 50; $i++) {		 	
		if (substr($nombre, 0, 7) == 'indice_'){		
			if(!empty($ids_nuevos_ingredientes[$i])){
				// echo "xx b > ".$ids_nuevos_ingredientes[$i];
				$cantidad_buscar = $_POST['indice_'.$ids_nuevos_ingredientes[$i]];
				$datos_alimento[$i_continue] = obtener_informacion_nutricional($ids_nuevos_ingredientes[$i], $cantidad_buscar); 
				$todos_los_ingredientes_a_mostrar[$i_continue]['id'] = $ids_nuevos_ingredientes[$i];
				$todos_los_ingredientes_a_mostrar[$i_continue]['cantidad'] = $cantidad_buscar;
				$i_continue++;
			}			
		}
	}
}
// print_r ($id);
//'266','266','271','266','266','271','315','266','266','271','266','266','271','315','355','266','266','271','266','266','271','315','266','266','271','266','266','271','315','355','831'


// print_r($datos_alimento);
//Iniciamos las variables en 0
$total_hidratos_porc			= 0;
$total_kcal_100g				= 0;
$total_proteinas_porc			= 0;
$total_grasa_porc				= 0;
$total_kcal_100g_org			= 0;
//Esta no existe
// $alimento_info['kcal']					= $row["kcal"];			
$total_hidratos					= 0;
$total_proteinas				= 0;

//Ya no se usan
// $total_pc_porcentaje			= $alimento_info['pc_porcentaje'];
// $total_cal_kcal				= $alimento_info['cal_kcal'];
$total_agua_g					= 0;
$total_hc_g						= 0;
$total_prot_g					= 0;
$total_grasa_g					= 0;
$total_niacina					= 0;
$total_satur_g					= 0;
$total_mono_g					= 0;
$total_poli_g					= 0;
$total_col_mg					= 0;
$total_fibra_g					= 0;
$total_sodio_mg					= 0;
$total_potasio_mg				= 0;
$total_magnesio_mg				= 0;
$total_calcio_mg				= 0;
$total_fosf_mg					= 0;
$total_hierro_mg				= 0;
$total_cloro_mg					= 0;
$total_cinc_mg					= 0;
$total_cobre_mg					= 0;
$total_manganeso_mg				= 0;
$total_cromo_mg					= 0;
$total_cobalto_mg				= 0;
$total_molibde_mg				= 0;
$total_yodo_mg					= 0;
$total_fluor_mg					= 0;
$total_butirico_c4_0			= 0;
$total_caproico_c6_0			= 0;
$total_caprilico_c8_0			= 0;
$total_caprico_c10_0			= 0;
$total_laurico_c12_0			= 0;
$total_miristico_c14_0			= 0;
$total_c15_0					= 0;
$total_c15_00					= 0;
$total_palmitico_c16_0			= 0;
$total_c17_0					= 0;
$total_c17_00					= 0;
$total_estearico_c18_0			= 0;
$total_araquidi_c20_0			= 0;
$total_behenico_c22_0			= 0;
$total_miristol_c14_1			= 0;
$total_palmitole_c16_1			= 0;
$total_oleico_c18_1				= 0;
$total_eicoseno_c20_1			= 0;
$total_c22_1					= 0;
$total_linoleico_c18_2			= 0;
$total_linoleni_c18_3			= 0;
$total_c18_4					= 0;
$total_ara_ico_c20_4			= 0;
$total_c20_5					= 0;
$total_c22_5					= 0;
$total_c22_6					= 0;
$total_otrosatur0				= 0;
$total_otroinsat0				= 0;
$total_omega3_0					= 0;
$total_etanol0					= 0;
$total_vit_a					= 0;
$total_carotenos				= 0;
$total_tocoferol				= 0;
$total_vit_d					= 0;
$total_vit_b1					= 0;
$total_vit_b2					= 0;
$total_vit_b6					= 0;
//Esta fue eliminada de la tabla
// $alimento_info['nicotina']				= $alimento_info['nicotina'];
$total_ac_panto					= 0;
$total_biotina					= 0;
$total_folico					= 0;
$total_b12						= 0;
$total_vit_c					= 0;
$total_purinas					= 0;
$total_vit_k					= 0;
$total_vit_e					= 0;
$total_oxalico					= 0;

//sumar
for ($i = 0; $i <= count($datos_alimento); $i++) {
	if(isset($datos_alimento[$i]['id_alimento'])){			
			$total_hidratos_porc			= $total_hidratos_porc+$datos_alimento[$i]['hidratos_porc'];
			$total_kcal_100g				= $total_kcal_100g+$datos_alimento[$i]['kcal_100g'];
			$total_proteinas_porc			= $total_proteinas_porc+$datos_alimento[$i]['proteinas_porc'];
			$total_grasa_porc				= $total_grasa_porc+$datos_alimento[$i]['grasa_porc'];
			$total_kcal_100g_org			= $total_kcal_100g_org+$datos_alimento[$i]['kcal_100g_org'];
			
			//Esta no existe
			// $alimento_info['kcal']					= $row["kcal"];			
			$total_hidratos					= $total_hidratos+$datos_alimento[$i]['hidratos'];
			$total_proteinas				= $total_proteinas+$datos_alimento[$i]['proteinas'];
			
			//Ya no se usan
			// $total_pc_porcentaje			= $alimento_info['pc_porcentaje'];
			// $total_cal_kcal				= $alimento_info['cal_kcal'];
			$total_agua_g					= $total_agua_g+$datos_alimento[$i]['agua_g'];			
			$total_hc_g						= $total_hc_g+$datos_alimento[$i]['hc_g'];
			$total_prot_g					= $total_prot_g+$datos_alimento[$i]['prot_g'];
			$total_grasa_g					= $total_grasa_g+$datos_alimento[$i]['grasa_g'];
			$total_niacina					= $total_niacina+$datos_alimento[$i]['niacina'];
			$total_satur_g					= $total_satur_g+$datos_alimento[$i]['satur_g'];
			$total_mono_g					= $total_mono_g+$datos_alimento[$i]['mono_g'];
			$total_poli_g					= $total_poli_g+$datos_alimento[$i]['poli_g'];
			$total_col_mg					= $total_col_mg+$datos_alimento[$i]['col_mg'];
			$total_fibra_g					= $total_fibra_g+$datos_alimento[$i]['fibra_g'];
			$total_sodio_mg					= $total_sodio_mg+$datos_alimento[$i]['sodio_mg'];
			$total_potasio_mg				= $total_potasio_mg+$datos_alimento[$i]['potasio_mg'];
			$total_magnesio_mg				= $total_magnesio_mg+$datos_alimento[$i]['magnesio_mg'];
			$total_calcio_mg				= $total_calcio_mg+$datos_alimento[$i]['calcio_mg'];
			$total_fosf_mg					= $total_fosf_mg+$datos_alimento[$i]['fosf_mg'];
			$total_hierro_mg				= $total_hierro_mg+$datos_alimento[$i]['hierro_mg'];
			$total_cloro_mg					= $total_cloro_mg+$datos_alimento[$i]['cloro_mg'];
			$total_cinc_mg					= $total_cinc_mg+$datos_alimento[$i]['cinc_mg'];
			$total_cobre_mg					= $total_cobre_mg+$datos_alimento[$i]['cobre_mg'];
			$total_manganeso_mg				= $total_manganeso_mg+$datos_alimento[$i]['manganeso_mg'];
			$total_cromo_mg					= $total_cromo_mg+$datos_alimento[$i]['cromo_mg'];
			$total_cobalto_mg				= $total_cobalto_mg+$datos_alimento[$i]['cobalto_mg'];
			$total_molibde_mg				= $total_molibde_mg+$datos_alimento[$i]['molibde_mg'];
			$total_yodo_mg					= $total_yodo_mg+$datos_alimento[$i]['yodo_mg'];
			$total_fluor_mg					= $total_fluor_mg+$datos_alimento[$i]['fluor_mg'];
			$total_butirico_c4_0			= $total_butirico_c4_0+$datos_alimento[$i]['butirico_c4_0'];
			$total_caproico_c6_0			= $total_caproico_c6_0+$datos_alimento[$i]['caproico_c6_0'];
			$total_caprilico_c8_0			= $total_caprilico_c8_0+$datos_alimento[$i]['caprilico_c8_0'];
			$total_caprico_c10_0			= $total_caprico_c10_0+$datos_alimento[$i]['caprico_c10_0'];
			$total_laurico_c12_0			= $total_laurico_c12_0+$datos_alimento[$i]['laurico_c12_0'];
			$total_miristico_c14_0			= $total_miristico_c14_0+$datos_alimento[$i]['miristico_c14_0'];
			$total_c15_0					= $total_c15_0+$datos_alimento[$i]['c15_0'];
			$total_c15_00					= $total_c15_00+$datos_alimento[$i]['c15_00'];
			$total_palmitico_c16_0			= $total_palmitico_c16_0+$datos_alimento[$i]['palmitico_c16_0'];
			$total_c17_0					= $total_c17_0+$datos_alimento[$i]['c17_0'];
			$total_c17_00					= $total_c17_00+$datos_alimento[$i]['c17_00'];
			$total_estearico_c18_0			= $total_estearico_c18_0+$datos_alimento[$i]['estearico_c18_0'];
			$total_araquidi_c20_0			= $total_araquidi_c20_0+$datos_alimento[$i]['araquidi_c20_0'];
			$total_behenico_c22_0			= $total_behenico_c22_0+$datos_alimento[$i]['behenico_c22_0'];
			$total_miristol_c14_1			= $total_miristol_c14_1+$datos_alimento[$i]['miristol_c14_1'];
			$total_palmitole_c16_1			= $total_palmitole_c16_1+$datos_alimento[$i]['palmitole_c16_1'];
			$total_oleico_c18_1				= $total_oleico_c18_1+$datos_alimento[$i]['oleico_c18_1'];
			$total_eicoseno_c20_1			= $total_eicoseno_c20_1+$datos_alimento[$i]['eicoseno_c20_1'];
			$total_c22_1					= $total_c22_1+$datos_alimento[$i]['c22_1'];
			$total_linoleico_c18_2			= $total_linoleico_c18_2+$datos_alimento[$i]['linoleico_c18_2'];
			$total_linoleni_c18_3			= $total_linoleni_c18_3+$datos_alimento[$i]['linoleni_c18_3'];
			$total_c18_4					= $total_c18_4+$datos_alimento[$i]['c18_4'];
			$total_ara_ico_c20_4			= $total_ara_ico_c20_4+$datos_alimento[$i]['ara_ico_c20_4'];
			$total_c20_5					= $total_c20_5+$datos_alimento[$i]['c20_5'];
			$total_c22_5					= $total_c22_5+$datos_alimento[$i]['c22_5'];
			$total_c22_6					= $total_c22_6+$datos_alimento[$i]['c22_6'];
			$total_otrosatur0				= $total_otrosatur0+$datos_alimento[$i]['otrosatur0'];
			$total_otroinsat0				= $total_otroinsat0+$datos_alimento[$i]['otroinsat0'];
			$total_omega3_0					= $total_omega3_0+$datos_alimento[$i]['omega3_0'];
			$total_etanol0					= $total_etanol0+$datos_alimento[$i]['etanol0'];
			$total_vit_a					= $total_vit_a+$datos_alimento[$i]['vit_a'];
			$total_carotenos				= $total_carotenos+$datos_alimento[$i]['carotenos'];
			$total_tocoferol				= $total_tocoferol+$datos_alimento[$i]['tocoferol'];
			$total_vit_d					= $total_vit_d+$datos_alimento[$i]['vit_d'];
			$total_vit_b1					= $total_vit_b1+$datos_alimento[$i]['vit_b1'];
			$total_vit_b2					= $total_vit_b2+$datos_alimento[$i]['vit_b2'];
			$total_vit_b6					= $total_vit_b6+$datos_alimento[$i]['vit_b6'];
			//Esta fue eliminada de la tabla
			// $alimento_info['nicotina']				= $alimento_info['nicotina'];
			$total_ac_panto					= $total_ac_panto+$datos_alimento[$i]['ac_panto'];
			$total_biotina					= $total_biotina+$datos_alimento[$i]['biotina'];
			$total_folico					= $total_folico+$datos_alimento[$i]['folico'];
			$total_b12						= $total_b12+$datos_alimento[$i]['b12'];
			$total_vit_c					= $total_vit_c+$datos_alimento[$i]['vit_c'];
			$total_purinas					= $total_purinas+$datos_alimento[$i]['purinas'];
			$total_vit_k					= $total_vit_k+$datos_alimento[$i]['vit_k'];
			$total_vit_e					= $total_vit_e+$datos_alimento[$i]['vit_e'];
			$total_oxalico					= $total_oxalico+$datos_alimento[$i]['oxalico'];	
	}
}
			/*
			$total_hidratos_porc			= $total_hidratos_porc+$datos_alimento[$i]['hidratos_porc'];
			$total_kcal_100g				= $total_kcal_100g+$datos_alimento[$i]['kcal_100g'];
			$total_proteinas_porc			= $total_proteinas_porc+$datos_alimento[$i]['proteinas_porc'];
			$total_grasa_porc				= $total_grasa_porc+$datos_alimento[$i]['grasa_porc'];
			
			//Esta no existe
			// $alimento_info['kcal']					= $row["kcal"];			
			$total_hidratos					= $total_hidratos+$datos_alimento[$i]['hidratos'];
			$total_proteinas				= $total_proteinas+$datos_alimento[$i]['proteinas'];
			*/
			//Ya no se usan
			// $total_pc_porcentaje			= $alimento_info['pc_porcentaje'];
			// $total_cal_kcal				= $alimento_info['cal_kcal'];
			$total_agua_g					= round(($total_agua_g*100)/$cantidad_total, 2);
			$total_hc_g						= round(($total_hc_g*100)/$cantidad_total, 2);					
			$total_prot_g					= round(($total_prot_g*100)/$cantidad_total, 2);					
			$total_grasa_g					= round(($total_grasa_g*100)/$cantidad_total, 2);					
			$total_niacina					= round(($total_niacina*100)/$cantidad_total, 2);					
			$total_satur_g					= round(($total_satur_g*100)/$cantidad_total, 2);					
			$total_mono_g					= round(($total_mono_g*100)/$cantidad_total, 2);					
			$total_poli_g					= round(($total_poli_g*100)/$cantidad_total, 2);
			$total_col_mg					= round(($total_col_mg*100)/$cantidad_total, 2);
			$total_fibra_g					= round(($total_fibra_g*100)/$cantidad_total, 2);
			$total_sodio_mg					= round(($total_sodio_mg*100)/$cantidad_total, 2);
			$total_potasio_mg				= round(($total_potasio_mg*100)/$cantidad_total, 2);
			$total_magnesio_mg				= round(($total_magnesio_mg*100)/$cantidad_total, 2);
			$total_calcio_mg				= round(($total_calcio_mg*100)/$cantidad_total, 2);
			$total_fosf_mg					= round(($total_fosf_mg*100)/$cantidad_total, 2);
			$total_hierro_mg				= round(($total_hierro_mg*100)/$cantidad_total, 2);
			$total_cloro_mg					= round(($total_cloro_mg*100)/$cantidad_total, 2);
			$total_cinc_mg					= round(($total_cinc_mg*100)/$cantidad_total, 2);
			$total_cobre_mg					= round(($total_cobre_mg*100)/$cantidad_total, 2);
			$total_manganeso_mg				= round(($total_manganeso_mg*100)/$cantidad_total, 2);
			$total_cromo_mg					= round(($total_cromo_mg*100)/$cantidad_total, 2);
			$total_cobalto_mg				= round(($total_cobalto_mg*100)/$cantidad_total, 2);
			$total_molibde_mg				= round(($total_molibde_mg*100)/$cantidad_total, 2);
			$total_yodo_mg					= round(($total_yodo_mg*100)/$cantidad_total, 2);
			$total_fluor_mg					= round(($total_fluor_mg*100)/$cantidad_total, 2);
			$total_butirico_c4_0			= round(($total_butirico_c4_0*100)/$cantidad_total, 2);
			$total_caproico_c6_0			= round(($total_caproico_c6_0*100)/$cantidad_total, 2);
			$total_caprilico_c8_0			= round(($total_caprilico_c8_0*100)/$cantidad_total, 2);
			$total_caprico_c10_0			= round(($total_caprico_c10_0*100)/$cantidad_total, 2);
			$total_laurico_c12_0			= round(($total_laurico_c12_0*100)/$cantidad_total, 2);
			$total_miristico_c14_0			= round(($total_miristico_c14_0*100)/$cantidad_total, 2);
			$total_c15_0					= round(($total_c15_0*100)/$cantidad_total, 2);
			$total_c15_00					= round(($total_c15_00*100)/$cantidad_total, 2);
			$total_palmitico_c16_0			= round(($total_palmitico_c16_0*100)/$cantidad_total, 2);
			$total_c17_0					= round(($total_c17_0*100)/$cantidad_total, 2);
			$total_c17_00					= round(($total_c17_00*100)/$cantidad_total, 2);
			$total_estearico_c18_0			= round(($total_estearico_c18_0*100)/$cantidad_total, 2);
			$total_araquidi_c20_0			= round(($total_araquidi_c20_0*100)/$cantidad_total, 2);
			$total_behenico_c22_0			= round(($total_behenico_c22_0*100)/$cantidad_total, 2);
			$total_miristol_c14_1			= round(($total_miristol_c14_1*100)/$cantidad_total, 2);
			$total_palmitole_c16_1			= round(($total_palmitole_c16_1*100)/$cantidad_total, 2);
			$total_oleico_c18_1				= round(($total_oleico_c18_1*100)/$cantidad_total, 2);
			$total_eicoseno_c20_1			= round(($total_eicoseno_c20_1*100)/$cantidad_total, 2);
			$total_c22_1					= round(($total_c22_1*100)/$cantidad_total, 2);
			$total_linoleico_c18_2			= round(($total_linoleico_c18_2*100)/$cantidad_total, 2);
			$total_linoleni_c18_3			= round(($total_linoleni_c18_3*100)/$cantidad_total, 2);
			$total_c18_4					= round(($total_c18_4*100)/$cantidad_total, 2);
			$total_ara_ico_c20_4			= round(($total_ara_ico_c20_4*100)/$cantidad_total, 2);
			$total_c20_5					= round(($total_c20_5*100)/$cantidad_total, 2);
			$total_c22_5					= round(($total_c22_5*100)/$cantidad_total, 2);
			$total_c22_6					= round(($total_c22_6*100)/$cantidad_total, 2);
			$total_otrosatur0				= round(($total_otrosatur0*100)/$cantidad_total, 2);
			$total_otroinsat0				= round(($total_otroinsat0*100)/$cantidad_total, 2);
			$total_omega3_0					= round(($total_omega3_0*100)/$cantidad_total, 2);
			$total_etanol0					= round(($total_etanol0*100)/$cantidad_total, 2);
			$total_vit_a					= round(($total_vit_a*100)/$cantidad_total, 2);
			$total_carotenos				= round(($total_carotenos*100)/$cantidad_total, 2);
			$total_tocoferol				= round(($total_tocoferol*100)/$cantidad_total, 2);
			$total_vit_d					= round(($total_vit_d*100)/$cantidad_total, 2);
			$total_vit_b1					= round(($total_vit_b1*100)/$cantidad_total, 2);
			$total_vit_b2					= round(($total_vit_b2*100)/$cantidad_total, 2);
			$total_vit_b6					= round(($total_vit_b6*100)/$cantidad_total, 2);
			//Esta fue eliminada de la tabla
			// $alimento_info['nicotina']				= $alimento_info['nicotina'];
			$total_ac_panto					= round(($total_ac_panto*100)/$cantidad_total, 2);
			$total_biotina					= round(($total_biotina*100)/$cantidad_total, 2);
			$total_folico					= round(($total_folico*100)/$cantidad_total, 2);
			$total_b12						= round(($total_b12*100)/$cantidad_total, 2);
			$total_vit_c					= round(($total_vit_c*100)/$cantidad_total, 2);
			$total_purinas					= round(($total_purinas*100)/$cantidad_total, 2);
			$total_vit_k					= round(($total_vit_k*100)/$cantidad_total, 2);
			$total_vit_e					= round(($total_vit_e*100)/$cantidad_total, 2);
			$total_oxalico					= round(($total_oxalico*100)/$cantidad_total, 2);	
			// echo $total_total_otroinsat0;  */
			
			// echo $total_kcal_100g;
			// echo $total_hidratos_porc;
?>
<!DOCTYPE html>
<html lang="es-ES">
<head>
	<!-- TouchSpin -->	
	<link href="<?php echo $url_app; ?>css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="<?php echo $url_app; ?>css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
	<?php include 'parts/header.php'; ?>
	<link href="<?php echo $url_app; ?>css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">
	<link href="<?php echo $url_app; ?>css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
	<link href="<?php echo $url_app; ?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">	
	<style>
	.table-responsive {
		overflow-x: hidden;
	}	
	.margin_top_receta{
		margin-top: 10px;
	}
	.datos_informacion p {
		padding-top:6px;
	}
	.ibox-content {
		margin-left: 10px;
		margin-right: 10px;
	}
	#datos_obligatorios {
		min-height:634px; 
	}
	.note-editable {
		min-height:420px; 
	}
	.note-color, note-fontname{
		display:none;
	}
	.desactivado_en_receta {
		color: #f70000;
	}
	a.tooltips {
	  position: relative;
	  display: inline;
	}
	a.tooltips span {
	  position: absolute;
	  width:300px;
	  color: #FFFFFF;
	  background: #000000;
	  height: 30px;
	  line-height: 30px;
		padding-left: 10px;
		text-align: left;
	  visibility: hidden;
	  border-radius: 6px;
	}
	a.tooltips span:after {
	  content: '';
	  position: absolute;
	  top: 100%;
	  left: 55px;
	  margin-left: -8px;
	  width: 0; height: 0;
	  border-top: 8px solid #000000;
	  border-right: 8px solid transparent;
	  border-left: 8px solid transparent;
	}
	a:hover.tooltips span {
	  visibility: visible;
	  opacity: 0.8;
	  bottom: 30px;
	  left: 50%;
	  margin-left: -76px;
	  z-index: 999;
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
		<div class="row">
             <div class="col-lg-12">
				<div class="ibox float-e-margins">											
					<div class="row">
						<div class="col-md-8">
							<div class="ibox-content" id="datos_obligatorios">
								<h1>Datos obligatorios</h1>	
								<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Título" required="" value="<?php echo utf8_encode($receta['nombre']); ?>	" readonly>								
								<input type="hidden" class="form-control" name="descripcion" id="descripcion" placeholder="Título" required="" value="<?php  echo str_replace('\r\n','<br>',utf8_encode($receta['descripcion']));  ?>" readonly>
								<br/>
								<div class="ibox-content no-padding">
									<div class="summernote">
										<?php  echo str_replace('\r\n','<br>',utf8_encode($receta['descripcion']));  ?>
									</div>	
								</div>	
									<div class="row" style="position: absolute; margin-top: 0px; top: 20px; right: 45px;">
										<div class="col-md-12">								
											<div class="form-group text-center">
											<a href="<?php echo $url_app; ?>lista-recetas-desactivadas" class="btn btn-w-m btn-primary">Atras</a>											
											</div>
										</div>
									</div>
							</div>
						</div>		
						<div id="datos_informacion" class="col-md-4 datos_informacion">
							<div class="ibox-content">
								<h1>Datos Información</h1>
								<div class="row margin_top_receta">
									<div class="col-md-2"><p>Kcal/100g</p></div>
									<div class="col-md-4"><div class="input-group m-b"><input type="text" class="form-control" name="kcal_por_100g" id="kcal_por_100g" placeholder="Kcal/100g" readonly="" value="<?php echo $receta['kcal_por_100g']; ?>"></div></div>
									<div class="col-md-6"></div>
								</div>									
								<div class="row margin_top_receta">
									<div class="col-md-2"><p>Hidratos</p></div>
									<div class="col-md-4"><div class="input-group m-b"><input type="text" placeholder="Hidratos" class="form-control" name="hidratos" value="<?php echo $receta['hidratos']; ?>" readonly=""><span class="input-group-addon">%</span></div></div>
									<div class="col-md-6"></div>
								</div>									
								<div class="row margin_top_receta">
									<div class="col-md-2"><p>Proteínas</p></div>
									<div class="col-md-4"><div class="input-group m-b"><input type="text" placeholder="Proteínas" class="form-control"  name="proteinas" value="<?php echo $receta['proteinas']; ?>" readonly=""><span class="input-group-addon">%</span></div></div>
									<div class="col-md-6"></div>
								</div>								
								<div class="row margin_top_receta">
									<div class="col-md-2"><p>Grasa</p></div>
									<div class="col-md-4"><div class="input-group m-b"><input type="text" placeholder="Grasa" class="form-control"  name="grasas" value="<?php echo $receta['grasas']; ?>" readonly=""><span class="input-group-addon">%</span></div></div>
									<div class="col-md-6"></div>
								</div>
							</div>
							<!-- Tamaño del plato -->
							<div class="ibox-content">	
								<div class="row margin_top_receta">
									<div class="col-md-12">
										<div class="input-group m-b"><span class="input-group-addon">Tamaño del plato entre</span><input type="text" placeholder="Grasa" class="form-control"  name="grasas" value="<?php echo $receta['peso_minimo']; ?>" readonly><span class="input-group-addon">y</span><input type="text" placeholder="Grasa" class="form-control"  name="grasas" value="<?php echo $receta['peso_maximo']; ?>" readonly><span class="input-group-addon">gramos</span></div>
									</div>																			
								</div>	
							</div>	
							<!-- Ingestas -->
							<div class="ibox-content">								
								<h1>Ingestas</h1>
								<div class="row margin_top_receta">
									<div class="col-md-6">
										<div class="checkbox checkbox-success">
											<?php $marcar_desayuno = ''; ?>
											<?php for ($i = 0; $i <= count($ingestas); $i++) { ?>
												<?php if (isset($ingestas[$i]) AND  $ingestas[$i] == 7) { $marcar_desayuno = 'checked=""'; } else { } ?>
											<?php } ?>
                                            <input id="desayuno" type="checkbox" <?php echo $marcar_desayuno; ?> disabled>
                                            <label for="desayuno">
                                                Desayuno
                                            </label>
                                        </div>
										<div class="checkbox checkbox-success">
											<?php $marcar_media_manana = ''; ?>
											<?php for ($i = 0; $i <= count($ingestas); $i++) { ?>
												<?php if (isset($ingestas[$i]) AND  $ingestas[$i] == 8) { $marcar_media_manana = 'checked=""'; }  else { } ?>
											<?php } ?>
                                            <input id="media_manana" type="checkbox" <?php echo $marcar_media_manana; ?> disabled>
                                            <label for="media_manana">
                                                Media mañana
                                            </label>
                                        </div>
										<div class="checkbox checkbox-success">
											<?php $marcar_plato_comida = ''; ?>
											<?php for ($i = 0; $i <= count($ingestas); $i++) { ?>
												<?php if (isset($ingestas[$i]) AND  $ingestas[$i] == 9) { $marcar_plato_comida = 'checked=""'; }  else { } ?>
											<?php } ?>
                                            <input id="plato_comida" type="checkbox" <?php echo $marcar_plato_comida; ?> disabled>
                                            <label for="plato_comida">
                                                1ª plato Comida
                                            </label>
                                        </div>
										<div class="checkbox checkbox-success">
											<?php $plato_comida_principal = ''; ?>
											<?php for ($i = 0; $i <= count($ingestas); $i++) { ?>
												<?php if (isset($ingestas[$i]) AND  $ingestas[$i] == 19) { $plato_comida_principal = 'checked=""'; } else { } ?>
											<?php } ?>
                                            <input id="plato_comida_principal" type="checkbox" <?php echo $plato_comida_principal; ?> disabled>
                                            <label for="plato_comida_principal">
                                                Plato principal comida
                                            </label>
                                        </div>
										<div class="checkbox checkbox-success">
											<?php $marcar_postre = ''; ?>
											<?php for ($i = 0; $i <= count($ingestas); $i++) { ?>
												<?php if (isset($ingestas[$i]) AND  $ingestas[$i] == 21) { $marcar_postre = 'checked=""'; }  else { } ?>
											<?php } ?>
                                            <input id="postre" type="checkbox" <?php echo $marcar_postre; ?> disabled>
                                            <label for="postre">
                                                Postre
                                            </label>
                                        </div>
									</div>
									<div class="col-md-6">
										<div class="checkbox checkbox-success">
											<?php $marcar_merienda = ''; ?>
											<?php for ($i = 0; $i <= count($ingestas); $i++) { ?>
												<?php if (isset($ingestas[$i]) AND  $ingestas[$i] == 10) { $marcar_merienda = 'checked=""'; }  else { } ?>
											<?php } ?>
                                            <input id="merienda" type="checkbox" <?php echo $marcar_merienda; ?> disabled>
                                            <label for="merienda">
                                                Merienda
                                            </label>
                                        </div>
										<div class="checkbox checkbox-success">
											<?php $marcar_plato_cena = ''; ?>
											<?php for ($i = 0; $i <= count($ingestas); $i++) { ?>
												<?php if (isset($ingestas[$i]) AND  $ingestas[$i] == 11) { $marcar_plato_cena = 'checked=""'; }  else { } ?>
											<?php } ?>
                                            <input id="plato_cena" type="checkbox" <?php echo $marcar_plato_cena; ?> disabled>
                                            <label for="plato_cena">
                                                1ª plato Cena
                                            </label>
                                        </div>
										<div class="checkbox checkbox-success">
											<?php $marcar_plato_cena_principal = ''; ?>
											<?php for ($i = 0; $i <= count($ingestas); $i++) { ?>
												<?php if (isset($ingestas[$i]) AND  $ingestas[$i] == 20) { $marcar_plato_cena_principal = 'checked=""'; }  else { } ?>
											<?php } ?>
                                            <input id="plato_cena_principal" type="checkbox" <?php echo $marcar_plato_cena_principal; ?> disabled>
                                            <label for="plato_cena_principal">
                                                Plato principal cena
                                            </label>
                                        </div>
										<div class="checkbox checkbox-success">
											<?php $marcar_recena = ''; ?>
											<?php for ($i = 0; $i <= count($ingestas); $i++) { ?>
												<?php if (isset($ingestas[$i]) AND  $ingestas[$i] == 12) { $marcar_recena = 'checked=""'; }  else { } ?>
											<?php } ?>
                                            <input id="recena" type="checkbox" <?php echo $marcar_recena; ?> disabled> 
                                            <label for="recena">
                                                Recena
                                            </label>
                                        </div>																														
										<div class="checkbox checkbox-success">
											<?php $marcar_otros = ''; ?>
											<?php for ($i = 0; $i <= count($ingestas); $i++) { ?>
												<?php if (isset($ingestas[$i]) AND  $ingestas[$i] == 18) { $marcar_otros = 'checked=""'; } else { } ?>
											<?php } ?>
                                            <input id="otros" type="checkbox" <?php echo $marcar_otros; ?> disabled>
                                            <label for="otros">
                                                Otros
                                            </label>
                                        </div>										 
									</div>					
								</div>	
							</div>	
						</div>
					</div>
					<!-- Fin primera parte-->
					<!-- Ingredientes -->
					<br/>
					<div class="ibox-content">						
						<div class="row margin_top_receta">
							<div class="col-md-6">								
								<h1>Ingredientes</h1>								
								<table id="example" class="table table-striped dataTables-example select-filter">
								<thead>
									<tr>
										<th>Alimento</th>										
										<th style="min-width:200px;">Cantidad </th>
										<th>Kcal/100g</th>											
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th></th>
										<th></th>										
										<th><?php echo $receta['kcal_por_100g']; ?> Kcal/100g</th>										
									</tr>
								</tfoot>
								<tbody>
									<?php for ($i = 0; $i <= $i_continue; $i++) { ?>									
										<?php if(!empty($datos_alimento[$i]['id_alimento'])){ ?>
											<tr>												
												<?php if (in_array($datos_alimento[$i]['id_alimento'], $_SESSION['total_alimentos_desactivados_por_cliente_array'])) { ?>												
													<td><a class="tooltips desactivado_en_receta"><span> Este alimento esta desactivado o eliminado</span><?php echo utf8_encode($datos_alimento[$i]['nombre']); ?></a></td>	
												<?php } else { ?>	
													<td><?php echo utf8_encode($datos_alimento[$i]['nombre']); ?></td>	
												<?php } ?>	
												<td><?php echo $datos_alimento[$i]['cantidad']; ?></td>		
												<td><?php echo $datos_alimento[$i]['kcal_100g_org']; ?></td>
											</tr>
										<?php } ?>
									<?php } ?>
								</tbody>
							</table>																
							</div>							
							<div class="col-md-6" style="padding-left:50px;">
								<!-- posible -->
								<h1>Información nutricional (100g)</h1>							
								<br />
								<div class="row">
									<div class="col-md-6" style="width: auto;">
										<strong style="color: #732f76;">General  </strong>
									</div>	
									<div class="col-md-6">								
									</div>
								</div>								
								<br />
								<div class="recargar-informacion-nutricional">								
								</div>	
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-2">
												 Agua (g)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="agua_g" value="<?php echo $total_agua_g; ?>" disabled required>								
											</div>
											<div class="col-md-2">
												 Hidratos de carbono, Total (g)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="hc_g" value="<?php echo  $total_hc_g; ?>" disabled required>								
											</div>
											<div class="col-md-2">
												 Fibra (g)	
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="fibra_g" value="<?php echo  $total_fibra_g; ?>" disabled required>								
											</div>
										</div>
									</div>	
								</div>	
								<br />
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-2">
												 Proteínas, total (g)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="prot_g" value="<?php echo  $total_prot_g; ?>" disabled required>								
											</div>
											<div class="col-md-2">
												 Grasas, total (g) 								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="grasa_g" value="<?php echo  $total_grasa_g; ?>" disabled required>								
											</div>
											<div class="col-md-2">
												 Colesterol (mg)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="col_mg" value="<?php echo  $total_col_mg; ?>" disabled required>								
											</div>
										</div>
									</div>	
								</div>	
								<br />
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-2">
												 AGS totales (g)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="satur_g" value="<?php echo  $total_satur_g; ?>" disabled required>								
											</div>
											<div class="col-md-2">
												 AGM totales (g)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="mono_g" value="<?php echo  $total_mono_g; ?>" disabled required>								
											</div>
											<div class="col-md-2">
												 AGP totales (g)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="poli_g" value="<?php echo  $total_poli_g; ?>" disabled required>								
											</div>
										</div>
									</div>	
								</div>
								<br />
								<div class="row">
									<div class="col-md-6" style="width: auto;">
										 <strong style="color: #732f76;">Vitaminas y otros </strong>  
									</div>	
									<div class="col-md-6">								
									</div>
								</div>	
								<br />
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-2">
												 Vit A (ug) 								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="vit_a" value="<?php echo  $total_vit_a; ?>" disabled required>								
											</div>
											<div class="col-md-2">
												 Carotenos (mg) 								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="carotenos" value="<?php echo  $total_carotenos; ?>" disabled required>								
											</div>
											<div class="col-md-2">
												 Tiamina B1 (mg)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="vit_b1" value="<?php echo  $total_vit_b1; ?>" disabled required>								
											</div>
										</div>
									</div>	
								</div>	
								<br />
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-2">
												 Riboflavina B2 (mg)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="vit_b2" value="<?php echo  $total_vit_b2; ?>" disabled required>								
											</div>
											<div class="col-md-2">
												 Niacina B3 (mg)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="niacina" value="<?php echo  $total_niacina; ?>" disabled required>								
											</div>
											<div class="col-md-2">
												 Ac. Pantoténico B5 (mg)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="ac_panto" value="<?php echo  $total_ac_panto; ?>" disabled required>								
											</div>
										</div>
									</div>	
								</div>	
								<br />
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-2">
												 Piridoxina B6 (mg)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="vit_b6" value="<?php echo  $total_vit_b6; ?>" disabled required>								
											</div>
											<div class="col-md-2">
												 Biotina (ug)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="biotina" value="<?php echo  $total_biotina; ?>" disabled required>								
											</div>
											<div class="col-md-2">
												 Ac. Fólico B9 (ug)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="folico" value="<?php echo  $total_folico; ?>" disabled required>								
											</div>
										</div>
									</div>	
								</div>	
								<br />
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-2">
												 Cobalamina B12 (ug) 								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="b12" value="<?php echo  $total_b12; ?>" disabled required>								
											</div>
											<div class="col-md-2">
												 Vit C (mg)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="vit_c" value="<?php echo  $total_vit_c; ?>" disabled required>								
											</div>
											<div class="col-md-2">
												 Vit D (ug)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="vit_d" value="<?php echo  $total_vit_d; ?>" disabled required>								
											</div>
										</div>
									</div>	
								</div>
								<br />
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-2">
												 Tocoferol (mg)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="tocoferol" value="<?php echo  $total_tocoferol; ?>" disabled required>								
											</div>
											<div class="col-md-2">
												 Vit E (mg)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="vit_e" value="<?php echo  $total_vit_e; ?>" disabled required>								
											</div>
											<div class="col-md-2">
												 Vit K (ug)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="vit_k" value="<?php echo  $total_vit_k; ?>" disabled required>								
											</div>
										</div>
									</div>	
								</div>
								<br />
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-2">
												 Oxálico (ug) 								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="oxalico" value="<?php echo  $total_oxalico; ?>" disabled required>								
											</div>
											<div class="col-md-2">
												 Purinas (mg)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="purinas" value="<?php echo  $total_purinas; ?>" disabled required>								
											</div>
											<div class="col-md-2">										
											</div>
											<div class="col-md-2">										
											</div>
										</div>
									</div>	
								</div>
						<!-- Minerales -->
						<br />
						<div class="row">
							<div class="col-md-6" style="width: auto;">
								 <strong style="color: #732f76;">Minerales </strong>  
							</div>	
							<div class="col-md-6">								
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										Sodio (mg) 								
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="sodio_mg" value="<?php echo  $total_sodio_mg; ?>" disabled required>								
									</div>
									<div class="col-md-2">
										Potasio (mg)								
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="potasio_mg" value="<?php echo  $total_potasio_mg; ?>" disabled required>								
									</div>
									<div class="col-md-2">
										Magnesio (mg)
									</div>
									<div class="col-md-2">	
										<input type="text" placeholder="0" class="input-sm form-control" name="magnesio_mg" value="<?php echo  $total_magnesio_mg; ?>" disabled required>
									</div>
								</div>
							</div>	
						</div>
						<br />
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										Calcio (mg)						
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="calcio_mg" value="<?php echo  $total_calcio_mg; ?>" disabled required>								
									</div>
									<div class="col-md-2">
										Fósforo (mg)							
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="fosf_mg" value="<?php echo  $total_fosf_mg; ?>" disabled required>								
									</div>
									<div class="col-md-2">
										Hierro (mg)
									</div>
									<div class="col-md-2">	
										<input type="text" placeholder="0" class="input-sm form-control" name="hierro_mg" value="<?php echo  $total_hierro_mg; ?>" disabled required>
									</div>
								</div>
							</div>	
						</div>
						<br />
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										Cloro (mg)					
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="cloro_mg" value="<?php echo  $total_cloro_mg; ?>" disabled required>								
									</div>
									<div class="col-md-2">
										Zinc (mg)						
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="cinc_mg" value="<?php echo  $total_cinc_mg; ?>" disabled required>								
									</div>
									<div class="col-md-2">
										Cobre (ug)
									</div>
									<div class="col-md-2">	
										<input type="text" placeholder="0" class="input-sm form-control" name="cobre_mg" value="<?php echo  $total_cobre_mg; ?>" disabled required>
									</div>
								</div>
							</div>	
						</div>
						<br />
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										Manganeso (ug)					
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="manganeso_mg" value="<?php echo  $total_manganeso_mg; ?>" disabled required>								
									</div>
									<div class="col-md-2">
										Cromo (mg)						
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="cromo_mg" value="<?php echo  $total_cromo_mg; ?>" disabled required>								
									</div>
									<div class="col-md-2">
										Cobalto (mg)
									</div>
									<div class="col-md-2">	
										<input type="text" placeholder="0" class="input-sm form-control" name="cobalto_mg" value="<?php echo  $total_cobalto_mg; ?>" disabled required>
									</div>
								</div>
							</div>	
						</div>
						<br />
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										Molibde (mg)					
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="molibde_mg" value="<?php echo  $total_molibde_mg; ?>" disabled required>								
									</div>
									<div class="col-md-2">
										Yodo (mg)					
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="yodo_mg" value="<?php echo  $total_yodo_mg; ?>" disabled required>								
									</div>
									<div class="col-md-2">
										Fluor (ug)
									</div>
									<div class="col-md-2">	
										<input type="text" placeholder="0" class="input-sm form-control" name="fluor_mg" value="<?php echo  $total_fluor_mg; ?>" disabled required>
									</div>
								</div>
							</div>	
						</div>
						<!-- Ácidos grasos -->
						<br />
						<div class="row">
							<div class="col-md-6" style="width: auto;">
								 <strong style="color: #732f76;">Ácidos grasos </strong>  
							</div>	
							<div class="col-md-6">								
							</div>
						</div>	
						<br />
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										 Butírico C4:0 (mg)								
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="butirico_c4_0" value="<?php echo  $total_butirico_c4_0; ?>" disabled required>								
									</div>
									<div class="col-md-2">
										Caproico C6:0 (mg)						
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="caproico_c6_0" value="<?php echo  $total_caproico_c6_0; ?>" disabled required>								
									</div>
									<div class="col-md-2">
										 Caprílico C8:0 (mg)								
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="caprilico_c8_0" value="<?php echo  $total_caprilico_c8_0; ?>" disabled required>								
									</div>
								</div>
							</div>	
						</div>
						<br />
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										Cáprico C10:0 (mg)							
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="caprico_c10_0" value="<?php echo  $total_caprico_c10_0; ?>" disabled required>								
									</div>
									<div class="col-md-2">
										Lárico C12:0 (mg)					
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="laurico_c12_0" value="<?php echo  $total_laurico_c12_0; ?>" disabled required>								
									</div>
									<div class="col-md-2">
										Mirístico C14:0 (mg)								
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="miristico_c14_0" value="<?php echo  $total_miristico_c14_0; ?>" disabled required>								
									</div>
								</div>
							</div>	
						</div>
						<br />
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										C15:0 (mg)							
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="c15_0" value="<?php echo  $total_c15_0; ?>" disabled required>								
									</div>
									<div class="col-md-2">
										C15:00 (mg)				
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="c15_00" value="<?php echo  $total_c15_00; ?>" disabled required>								
									</div>
									<div class="col-md-2">
										Palmítico C16:0 (mg)								
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="palmitico_c16_0" value="<?php echo  $total_palmitico_c16_0; ?>" disabled required>								
									</div>
								</div>
							</div>	
						</div>
						<br />
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										C17:0 (mg)							
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="c17_0" value="<?php echo  $total_c17_0; ?>" disabled required>								
									</div>
									<div class="col-md-2">
										C17:00 (mg)		
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="c17_00" value="<?php echo  $total_c17_00; ?>" disabled required>								
									</div>
									<div class="col-md-2">
										Esteárico C18:0 (mg)							
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="estearico_c18_0" value="<?php echo  $total_estearico_c18_0; ?>" disabled required>								
									</div>
								</div>
							</div>	
						</div>
						<br />	
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										Araquídico C20:0 (mg)							
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="araquidi_c20_0" value="<?php echo  $total_araquidi_c20_0; ?>" disabled required>								
									</div>
									<div class="col-md-2">
										Behénico C22:0 (mg)	
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="behenico_c22_0" value="<?php echo  $total_behenico_c22_0; ?>" disabled required>								
									</div>
									<div class="col-md-2">
										Miristol C14:1 (mg)							
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="miristol_c14_1" value="<?php echo  $total_miristol_c14_1; ?>" disabled required>								
									</div>
								</div>
							</div>	
						</div>
						<br />
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										Palmitole C16:1 (mg)							
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="palmitole_c16_1" value="<?php echo  $total_palmitole_c16_1; ?>" disabled required>								
									</div>
									<div class="col-md-2">
										Oleico C18:1 (mg)
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="oleico_c18_1" value="<?php echo  $total_oleico_c18_1; ?>" disabled required>								
									</div>
									<div class="col-md-2">
										Eicoseno C20:1 (mg)				
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="eicoseno_c20_1" value="<?php echo  $total_eicoseno_c20_1; ?>" disabled required>								
									</div>
								</div>
							</div>	
						</div>
						<br />
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										C22:1 (mg)						
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="c22_1" value="<?php echo  $total_c22_1; ?>" disabled required>								
									</div>
									<div class="col-md-2">
										Linoleico C18:2 (mg)
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="linoleico_c18_2" value="<?php echo  $total_linoleico_c18_2; ?>" disabled required>								
									</div>
									<div class="col-md-2">
										Linolénico C18:3 (mg)			
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="linoleni_c18_3" value="<?php echo  $total_linoleni_c18_3; ?>" disabled required>								
									</div>
								</div>
							</div>	
						</div>
						<br />
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										C18:4 (mg)					
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="c18_4" value="<?php echo  $total_c18_4; ?>" disabled required>								
									</div>
									<div class="col-md-2">
										Araquidónico C20:4 (mg)
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="ara_ico_c20_4" value="<?php echo  $total_ara_ico_c20_4; ?>" disabled required>								
									</div>
									<div class="col-md-2">
										C20:5 (mg)			
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="c20_5" value="<?php echo  $total_c20_5; ?>" disabled required>								
									</div>
								</div>
							</div>	
						</div>
						<br />
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										C22:5 (mg)					
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="c22_5" value="<?php echo  $total_c22_5; ?>" disabled required>								
									</div>
									<div class="col-md-2">
										C22:6 (mg)
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="c22_6" value="<?php echo  $total_c22_6; ?>" disabled required>								
									</div>
									<div class="col-md-2">
										Otros satura (mg)			
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="otrosatur0" value="<?php echo $total_otrosatur0; ?>" disabled required>								
									</div>
								</div>
							</div>	
						</div>
						<br />	
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										Otros insatura (mg)					
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="otroinsat0" value="<?php echo $total_otroinsat0; ?>" disabled required>								
									</div>
									<div class="col-md-2">
										Omega 3:0 (mg)
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="omega3_0" value="<?php echo $total_omega3_0; ?>" disabled required>								
									</div>
									<div class="col-md-2">
										Etanol (mg)			
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="etanol0" value="<?php echo $total_etanol0; ?>" disabled required>								
									</div>
								</div>
							</div>	
						</div>						
								<!-- posible -->
							</div>
						</div>
					</div>	 
					<!-- Fin Ingredientes -->
					<br />					
				</div>
			</div>	
		</div>		
		<!-- Fin buscador -->        
		</div>
                <div class="footer">
					<?php if($receta['id_usuario'] != $_SESSION['id_usuario'] AND $receta['id_usuario'] != 0){ }else{ ?>
                    <?php include_once 'parts/footer.php'; ?>
					<?php } ?>
                </div>
            </div>
			<?php include_once 'parts/menu_derecho.php'; ?>
        </div>
        </div>      
    </div>
	<!-- Modal Lista de alimentos -->	
	<div id="myModal" class="modal fade" role="dialog">
	
	  <div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Selecciona el nuevo ingrediente</h4>
		  </div>
		  <div class="modal-body">
			<table id="tabla_agregar_alimento" class="table table-striped dataTables-example select-filter">
				<thead>
					<tr>
						<th style="width: 30px;">											
						<div class="checkbox checkbox-success" style="position: absolute;margin-top: -5px; margin-left: -3px;">
							<input id="checkbox2" type="checkbox" class="marcar_nuevos_alimentos">
							<label for="checkbox2"></label>
						</div>
						</th>
						<th>Nombre</th>
						<th style="min-width:150px;">Cantidad</th>
						<th>Kcal/100g</th>
						<th>%_Hidratos</th>
						<th>%_Proteínas</th>
						<th>%_Grasas</th>						
					</tr>
				</thead>
				<tbody>
					<?php //Obtener el historial de pesos por clientes
						$listado_completo = listado_de_alimentos_completo ();
						// print_r($listado_completo);
					?> 
					<?php for ($i = 0; $i <= count($listado_completo); $i++) { ?>
						<?php if(!empty($listado_completo[$i]['id_definitivo'])){ ?>
							<tr>
								<td>
									<div class="checkbox checkbox-success">										
										<?php if (in_array($listado_completo[$i]['id_definitivo'], $ids_nuevos_ingredientes)) { 
										$checkbox_check = 'checked'; $cantidad_mostrar = $_POST['indice_'.$listado_completo[$i]['id_definitivo']]; 					
										}else{ $checkbox_check = '';  $cantidad_mostrar = '100'; } ?>
										<input id="<?php echo $listado_completo[$i]['id_definitivo']; ?>" type="checkbox" name="nuevo_ingrediente_<?php echo $listado_completo[$i]['id_definitivo']; ?>" class="marcar_ni" value="<?php echo $i; ?>" <?php echo $checkbox_check; ?>><label for="<?php echo $listado_completo[$i]['id_definitivo']; ?>"></label>
									</div>
								</td>
								<td><?php echo utf8_encode($listado_completo[$i]['nombre']); ?></td>
								<td><?php echo $cantidad_mostrar; ?></td>
								<td><?php echo $listado_completo[$i]['kcal_100g']; ?></td>
								<td><?php echo $listado_completo[$i]['hidratos']; ?></td>
								<td><?php echo $listado_completo[$i]['proteinas']; ?></td>
								<td><?php echo $listado_completo[$i]['grasa']; ?></td>								
							</tr>
						<?php } ?>
					<?php } ?>
				</tbody>
			</table>
				<?php for ($i = 0; $i <= count($listado_completo); $i++) { ?>
					<?php if(!empty($listado_completo[$i]['id_definitivo'])){ ?>
						<?php if (in_array($listado_completo[$i]['id_definitivo'], $ids_nuevos_ingredientes)) { 
						$cantidad_mostrar = $_POST['indice_'.$listado_completo[$i]['id_definitivo']]; 					
						}else{ $cantidad_mostrar = '100'; } ?>
						<input type="hidden" id="valor_<?php echo $i; ?>"  name="indice_<?php echo $listado_completo[$i]['id_definitivo']; ?>" value="<?php echo $cantidad_mostrar; ?>">
					<?php } ?>
				<?php } ?>		
			<br><br><br>
			<div class="row">
			<div class="col-md-12">								
				<div class="form-group text-center">
				<p><strong>Nota:</strong> Para que los alimentos se incorporen a la receta deben estar seleccionados de color verde.</p>
				</div>
			</div>	
		  </div>		  
			<div class="row">
			<div class="col-md-12">								
				<div class="form-group text-center">
				<a href="#" data-dismiss="modal"  class="btn btn-w-m btn-atras">Atras</a>
				<button id="guardar_alimento" type="submit" class="btn btn-w-m btn-guardar">Guardar</button>
				</div>
			</div>	<br><br>
		  </div>		  
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		  </div>
		</div>

	  </div>	
	</div>	
	</div>
	
	<?php include 'parts/jquery_footer.php'; ?>	
	<!-- TouchSpin -->
    <script src="<?php echo $url_app; ?>js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>
	<script src="<?php echo $url_app; ?>js/plugins/dataTables/datatables.min.js"></script>
	<script src="<?php echo $url_app; ?>js/plugins/dataTables/dataTables.cellEdit.js"></script>
	<script src="<?php echo $url_app; ?>js/plugins/summernote/summernote.min.js"></script>	
	<script>
		var editor; // Usamos una variable global
		var table1;
		var table;
		//Llamamos los datos de la tabla en segundo plano para que carge mucho mas rapido
        $(document).ready(function(){
			$('#mensajes_footer').modal('show');
			//->Tabla 1 
			//->Agregar Alimentos
			table1 = $('#example').DataTable({ 
				responsive: true,
				processing: true,
				erverSide: true,												
				deferRender:    true,
				scrollCollapse: true,
				scroller:       false,
				serialize:		true,
				<?php if (isset($idiet_status_tabla) && $idiet_status_tabla == 1) {?>
				iDisplayLength:	<?php echo $tabla_lista; ?>,
				<?php }else{ ?>
				iDisplayLength:	3000,
				paging: 		false,
				<?php } ?>
				
			});			
			
			var totallll = 0;
			//Agregar en la linea #example_info el total de las cantidades de los alimentos/
			$("#example tr").find('td:eq(2)').each(function () {
			 
			 //obtenemos el valor de la celda
			  valor = $(this).html();
			 
			 //sumamos, recordar parsear, si no se concatenara.
			 totallll += parseInt(valor)
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
			});
			
			//Para marcar todos los alimentos a agregar
			$(".marcar_nuevos_alimentos").on("click", function () {
				var marcado = $(this).is(':checked'); 
				
				if(marcado == true){				
					$('.marcar_ni').prop('checked',true);
					$(".marcar_ni").attr('value', '1');					
				}else{				
					$('.marcar_ni').prop('checked',false);
					$(".marcar_ni").attr('value', '0');				
				}
			});
			
			//Esconder configuracion del html
			$('.note-toolbar .note-insert, .note-toolbar .note-table, .note-toolbar .note-style:first, .note-toolbar .note-para, .note-view, .note-fontname, .note-color').remove();
		});	
		
		//Descripcion
		$('.summernote').summernote('disable');
		
		
		
    </script>	
	<?php $conn->close(); ?>
</body>
</html>
