<?php
session_start();
include 'conex.php';
$pagina = 'Editar Receta';
$migas = array('Lista Recetas');
$migas_url = array('lista-recetas');

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'configuracion.php';
include_once 'ayuda.php';
include 'consultas_mysql.php';

$id    			=  $_POST['id_receta']; 
$dieta_gramos	=  $_POST['gramos']; 

$id    = intval(preg_replace('/[^0-9]+/', '', $id), 10);

//Obtener_alimentos
$receta = obtener_receta($id);

//Redireccionar si no le pertenece a este usuario
if($receta['id_usuario'] != $_SESSION['id_usuario'] AND $receta['id_usuario'] != 0){
	$_SESSION['mensaje'] = 'receta_de_otro_usuario';
	header('location:'.$url_app.'lista-recetas/');
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
if (!empty($_POST['gramos'])) {
	$dieta_gramos =  $_POST['gramos']; 
		if($cantidad_total==0) {
			$factor=1;
		} else {
		$factor=$dieta_gramos/$cantidad_total;
		}
}
else
{
	$factor=1;
}


// print_r ($ingestas);
//Quitamos la ultima coma
if($cantidad_de_ingredientes > 0){
 $todos_los_ingredientes = substr($todos_los_ingredientes, 0, -1);
}

$listado_ingredientes = obtener_cantidades_recetas($todos_los_ingredientes, $id);
for ($i = 0; $i <= count($ingredientes); $i++) {	
	if(isset($ingredientes[$i]['id_alimento'])){
		$datos_alimento[$i] = obtener_informacion_nutricional($ingredientes[$i]['id_alimento'], $ingredientes[$i]['cantidad']); 
	}
}


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
			$datos_alimento[$i]['cantidad']	= round($factor*$datos_alimento[$i]['cantidad'], 2);

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
			$total_agua_g					= round(($factor*$total_agua_g*100)/$cantidad_total, 2);
			$total_hc_g						= round(($factor*$total_hc_g*100)/$cantidad_total, 2);					
			$total_prot_g					= round(($factor*$total_prot_g*100)/$cantidad_total, 2);					
			$total_grasa_g					= round(($factor*$total_grasa_g*100)/$cantidad_total, 2);					
			$total_niacina					= round(($factor*$total_niacina*100)/$cantidad_total, 2);					
			$total_satur_g					= round(($factor*$total_satur_g*100)/$cantidad_total, 2);					
			$total_mono_g					= round(($factor*$total_mono_g*100)/$cantidad_total, 2);					
			$total_poli_g					= round(($factor*$total_poli_g*100)/$cantidad_total, 2);
			$total_col_mg					= round(($factor*$total_col_mg*100)/$cantidad_total, 2);
			$total_fibra_g					= round(($factor*$total_fibra_g*100)/$cantidad_total, 2);
			$total_sodio_mg					= round(($factor*$total_sodio_mg*100)/$cantidad_total, 2);
			$total_potasio_mg				= round(($factor*$total_potasio_mg*100)/$cantidad_total, 2);
			$total_magnesio_mg				= round(($factor*$total_magnesio_mg*100)/$cantidad_total, 2);
			$total_calcio_mg				= round(($factor*$total_calcio_mg*100)/$cantidad_total, 2);
			$total_fosf_mg					= round(($factor*$total_fosf_mg*100)/$cantidad_total, 2);
			$total_hierro_mg				= round(($factor*$total_hierro_mg*100)/$cantidad_total, 2);
			$total_cloro_mg					= round(($factor*$total_cloro_mg*100)/$cantidad_total, 2);
			$total_cinc_mg					= round(($factor*$total_cinc_mg*100)/$cantidad_total, 2);
			$total_cobre_mg					= round(($factor*$total_cobre_mg*100)/$cantidad_total, 2);
			$total_manganeso_mg				= round(($factor*$total_manganeso_mg*100)/$cantidad_total, 2);
			$total_cromo_mg					= round(($factor*$total_cromo_mg*100)/$cantidad_total, 2);
			$total_cobalto_mg				= round(($factor*$total_cobalto_mg*100)/$cantidad_total, 2);
			$total_molibde_mg				= round(($factor*$total_molibde_mg*100)/$cantidad_total, 2);
			$total_yodo_mg					= round(($factor*$total_yodo_mg*100)/$cantidad_total, 2);
			$total_fluor_mg					= round(($factor*$total_fluor_mg*100)/$cantidad_total, 2);
			$total_butirico_c4_0			= round(($factor*$total_butirico_c4_0*100)/$cantidad_total, 2);
			$total_caproico_c6_0			= round(($factor*$total_caproico_c6_0*100)/$cantidad_total, 2);
			$total_caprilico_c8_0			= round(($factor*$total_caprilico_c8_0*100)/$cantidad_total, 2);
			$total_caprico_c10_0			= round(($factor*$total_caprico_c10_0*100)/$cantidad_total, 2);
			$total_laurico_c12_0			= round(($factor*$total_laurico_c12_0*100)/$cantidad_total, 2);
			$total_miristico_c14_0			= round(($factor*$total_miristico_c14_0*100)/$cantidad_total, 2);
			$total_c15_0					= round(($factor*$total_c15_0*100)/$cantidad_total, 2);
			$total_c15_00					= round(($factor*$total_c15_00*100)/$cantidad_total, 2);
			$total_palmitico_c16_0			= round(($factor*$total_palmitico_c16_0*100)/$cantidad_total, 2);
			$total_c17_0					= round(($factor*$total_c17_0*100)/$cantidad_total, 2);
			$total_c17_00					= round(($factor*$total_c17_00*100)/$cantidad_total, 2);
			$total_estearico_c18_0			= round(($factor*$total_estearico_c18_0*100)/$cantidad_total, 2);
			$total_araquidi_c20_0			= round(($factor*$total_araquidi_c20_0*100)/$cantidad_total, 2);
			$total_behenico_c22_0			= round(($factor*$total_behenico_c22_0*100)/$cantidad_total, 2);
			$total_miristol_c14_1			= round(($factor*$total_miristol_c14_1*100)/$cantidad_total, 2);
			$total_palmitole_c16_1			= round(($factor*$total_palmitole_c16_1*100)/$cantidad_total, 2);
			$total_oleico_c18_1				= round(($factor*$total_oleico_c18_1*100)/$cantidad_total, 2);
			$total_eicoseno_c20_1			= round(($factor*$total_eicoseno_c20_1*100)/$cantidad_total, 2);
			$total_c22_1					= round(($factor*$total_c22_1*100)/$cantidad_total, 2);
			$total_linoleico_c18_2			= round(($factor*$total_linoleico_c18_2*100)/$cantidad_total, 2);
			$total_linoleni_c18_3			= round(($factor*$total_linoleni_c18_3*100)/$cantidad_total, 2);
			$total_c18_4					= round(($factor*$total_c18_4*100)/$cantidad_total, 2);
			$total_ara_ico_c20_4			= round(($factor*$total_ara_ico_c20_4*100)/$cantidad_total, 2);
			$total_c20_5					= round(($factor*$total_c20_5*100)/$cantidad_total, 2);
			$total_c22_5					= round(($factor*$total_c22_5*100)/$cantidad_total, 2);
			$total_c22_6					= round(($factor*$total_c22_6*100)/$cantidad_total, 2);
			$total_otrosatur0				= round(($factor*$total_otrosatur0*100)/$cantidad_total, 2);
			$total_otroinsat0				= round(($factor*$total_otroinsat0*100)/$cantidad_total, 2);
			$total_omega3_0					= round(($factor*$total_omega3_0*100)/$cantidad_total, 2);
			$total_etanol0					= round(($factor*$total_etanol0*100)/$cantidad_total, 2);
			$total_vit_a					= round(($factor*$total_vit_a*100)/$cantidad_total, 2);
			$total_carotenos				= round(($factor*$total_carotenos*100)/$cantidad_total, 2);
			$total_tocoferol				= round(($factor*$total_tocoferol*100)/$cantidad_total, 2);
			$total_vit_d					= round(($factor*$total_vit_d*100)/$cantidad_total, 2);
			$total_vit_b1					= round(($factor*$total_vit_b1*100)/$cantidad_total, 2);
			$total_vit_b2					= round(($factor*$total_vit_b2*100)/$cantidad_total, 2);
			$total_vit_b6					= round(($factor*$total_vit_b6*100)/$cantidad_total, 2);
			//Esta fue eliminada de la tabla
			// $alimento_info['nicotina']				= $alimento_info['nicotina'];
			$total_ac_panto					= round(($factor*$total_ac_panto*100)/$cantidad_total, 2);
			$total_biotina					= round(($factor*$total_biotina*100)/$cantidad_total, 2);
			$total_folico					= round(($factor*$total_folico*100)/$cantidad_total, 2);
			$total_b12						= round(($factor*$total_b12*100)/$cantidad_total, 2);
			$total_vit_c					= round(($factor*$total_vit_c*100)/$cantidad_total, 2);
			$total_purinas					= round(($factor*$total_purinas*100)/$cantidad_total, 2);
			$total_vit_k					= round(($factor*$total_vit_k*100)/$cantidad_total, 2);
			$total_vit_e					= round(($factor*$total_vit_e*100)/$cantidad_total, 2);
			$total_oxalico					= round(($factor*$total_oxalico*100)/$cantidad_total, 2);	
			// echo $total_total_otroinsat0;  */
			
			// echo $total_kcal_100g;
			// echo $total_hidratos_porc;

//Mostrar Kcal, Hidratos Proteinas y Grasas		
$mostrar_kcal_100g = '';	
$mostrar_hidratos_porc = '';
$mostrar_proteinas_porc = '';
$mostrar_grasa_porc = ''; 

if(!empty($cantidad_total)){
	$mostrar_kcal_100g			= round($total_kcal_100g/$cantidad_total);
	$mostrar_hidratos_porc 		= round($total_hidratos_porc/$cantidad_total);	
	$mostrar_proteinas_porc 	= round($total_proteinas_porc/$cantidad_total);	
	$mostrar_grasa_porc			= round($total_grasa_porc/$cantidad_total);	
	
	$sumar_todo = $mostrar_hidratos_porc+$mostrar_proteinas_porc+$mostrar_grasa_porc;
	if($sumar_todo < 100){		
		$restante = 100-$sumar_todo;
		if($mostrar_hidratos_porc > $mostrar_proteinas_porc AND $mostrar_hidratos_porc > $mostrar_grasa_porc) {
			$mostrar_hidratos_porc = $mostrar_hidratos_porc+$restante;
		}
		if($mostrar_proteinas_porc > $mostrar_hidratos_porc AND $mostrar_proteinas_porc > $mostrar_grasa_porc) {
			$mostrar_proteinas_porc = $mostrar_proteinas_porc+$restante;
		}
		if($mostrar_grasa_porc > $mostrar_hidratos_porc AND $mostrar_grasa_porc > $mostrar_proteinas_porc) {
			$mostrar_grasa_porc = $mostrar_grasa_porc+$restante;
		}
	}
	if($sumar_todo > 100){
		$sumar_todo;
		$sobrante = $sumar_todo-100;
		if($mostrar_hidratos_porc > $mostrar_proteinas_porc AND $mostrar_hidratos_porc > $mostrar_grasa_porc) {
			$mostrar_hidratos_porc = $mostrar_hidratos_porc - $sobrante;
		}
		if($mostrar_proteinas_porc > $mostrar_hidratos_porc AND $mostrar_proteinas_porc > $mostrar_grasa_porc) {
			$mostrar_proteinas_porc = $mostrar_proteinas_porc-$sobrante;
		}
		if($mostrar_grasa_porc > $mostrar_hidratos_porc AND $mostrar_grasa_porc > $mostrar_proteinas_porc) {
			$mostrar_grasa_porc = $mostrar_grasa_porc-$sobrante;
		}
	}	
}
			
?>
<div style="margin-left: 10%; margin-right: 10%;">
<div class="row">
	<div class="col-lg-12">
		<h1><strong>Nombre:<br>	</strong> <?php echo salida_nombre($receta['nombre']); ?></h1><br>	
		<p style="text-align: left;"><?php if(!empty($receta['descripcion'])){  echo str_replace('\r\n','<br>', salida_nombre($receta['descripcion']));  } ?></p>										
	</div>
</div><br><br>	
<div class="row">
	<div class="col-lg-4 text-left">
		<p><strong>Datos Información</strong> </p>	
		<p><strong>Kcal/100g</strong> <?php echo $mostrar_kcal_100g; ?> </p>	
		<p><strong>Hidratos</strong> <?php echo $mostrar_hidratos_porc; ?> %</p>	
		<p><strong>Proteínas</strong> <?php echo $mostrar_proteinas_porc; ?> %</p>	
		<p><strong>Grasa</strong> <?php echo $mostrar_grasa_porc; ?> %</p>	
	</div>
	<div class="col-lg-8 text-left">
		<div class="row">
			<div class="col-md-6">
				<div class="checkbox checkbox-success">											
					<?php $marcar_desayuno = ''; ?>
					<?php if(!empty($ingestas)){ ?>	
						<?php for ($i = 0; $i <= count($ingestas); $i++) { ?>
							<?php if (isset($ingestas[$i]) AND  $ingestas[$i] == 7) { $marcar_desayuno = 'checked=""'; } else { } ?>													
						<?php } ?>
					<?php } ?>	
					<?php if (!empty($temp_incluir_desayuno)) { $marcar_desayuno = 'checked=""'; } else { } ?>
					<input id="desayuno" name="incluir_desayuno" type="checkbox" <?php echo $marcar_desayuno; ?> value="7" readonly disabled>
					<label for="desayuno" readonly>
						Desayuno
					</label>
				</div>
				<div class="checkbox checkbox-success">
					<?php $marcar_media_manana = ''; ?>
					<?php if(!empty($ingestas)){ ?>
						<?php for ($i = 0; $i <= count($ingestas); $i++) { ?>
							<?php if (isset($ingestas[$i]) AND  $ingestas[$i] == 8) { $marcar_media_manana = 'checked=""'; }  else { } ?>
						<?php } ?>
					<?php } ?>	
					<?php if (!empty($temp_incluir_media_manana)) { $marcar_media_manana = 'checked=""'; } else { } ?>
					<input id="media_manana"  name="incluir_media_manana"  type="checkbox" <?php echo $marcar_media_manana; ?> value="8" readonly disabled>
					<label for="media_manana">
						Media mañana
					</label>
				</div>
				<div class="checkbox checkbox-success">
					<?php $marcar_plato_comida = ''; ?>
					<?php if(!empty($ingestas)){ ?>												
						<?php for ($i = 0; $i <= count($ingestas); $i++) { ?>
							<?php if (isset($ingestas[$i]) AND  $ingestas[$i] == 9) { $marcar_plato_comida = 'checked=""'; }  else { } ?>
						<?php } ?>
					<?php } ?>	
					<?php if (!empty($temp_incluir_plato_comida)) { $marcar_plato_comida = 'checked=""'; } else { } ?>
					<input id="plato_comida" name="incluir_plato_comida" type="checkbox" <?php echo $marcar_plato_comida; ?> value="9" readonly disabled>
					<label for="plato_comida">
						1ª plato Comida
					</label>
				</div>
				<div class="checkbox checkbox-success">
					<?php $plato_comida_principal = ''; ?>
					<?php if(!empty($ingestas)){ ?>												
						<?php for ($i = 0; $i <= count($ingestas); $i++) { ?>
							<?php if (isset($ingestas[$i]) AND  $ingestas[$i] == 19) { $plato_comida_principal = 'checked=""'; } else { } ?>
						<?php } ?>
					<?php } ?>	
					<?php if (!empty($temp_incluir_plato_comida_principal)) { $plato_comida_principal = 'checked=""'; } else { } ?>
					<input id="plato_comida_principal" name="incluir_plato_comida_principal" type="checkbox" <?php echo $plato_comida_principal; ?> value="19" readonly disabled>
					<label for="plato_comida_principal">
						Plato principal comida
					</label>
				</div>
				<div class="checkbox checkbox-success">
					<?php $marcar_postre = ''; ?>
					<?php if(!empty($ingestas)){ ?>												
						<?php for ($i = 0; $i <= count($ingestas); $i++) { ?>
							<?php if (isset($ingestas[$i]) AND  $ingestas[$i] == 21) { $marcar_postre = 'checked=""'; }  else { } ?>
						<?php } ?>
					<?php } ?>	
					<?php if (!empty($temp_incluir_postre)) { $marcar_postre = 'checked=""'; } else { } ?>
					<input id="postre" name="incluir_postre" type="checkbox" <?php echo $marcar_postre; ?> value="21" readonly disabled>
					<label for="postre">
						Postre
					</label>
				</div>
			</div>
			<div class="col-md-6">
				<div class="checkbox checkbox-success">
					<?php $marcar_merienda = ''; ?>
					<?php if(!empty($ingestas)){ ?>												
						<?php for ($i = 0; $i <= count($ingestas); $i++) { ?>
							<?php if (isset($ingestas[$i]) AND  $ingestas[$i] == 10) { $marcar_merienda = 'checked=""'; }  else { } ?>
						<?php } ?>
					<?php } ?>	
					<?php if (!empty($temp_incluir_merienda)) { $marcar_merienda = 'checked=""'; } else { } ?>
					<input id="merienda"  name="incluir_merienda" type="checkbox" <?php echo $marcar_merienda; ?> value="10" readonly disabled>
					<label for="merienda">
						Merienda
					</label>
				</div>
				<div class="checkbox checkbox-success">
					<?php $marcar_plato_cena = ''; ?>
					<?php if(!empty($ingestas)){ ?>												
						<?php for ($i = 0; $i <= count($ingestas); $i++) { ?>
							<?php if (isset($ingestas[$i]) AND  $ingestas[$i] == 11) { $marcar_plato_cena = 'checked=""'; }  else { } ?>
						<?php } ?>
					<?php } ?>	
					<?php if (!empty($temp_incluir_plato_cena)) { $marcar_plato_cena = 'checked=""'; } else { } ?>
					<input id="plato_cena" name="incluir_plato_cena" type="checkbox" <?php echo $marcar_plato_cena; ?> value="11" readonly disabled>
					<label for="plato_cena">
						1ª plato Cena
					</label>
				</div>
				<div class="checkbox checkbox-success">
					<?php $marcar_plato_cena_principal = ''; ?>
					<?php if(!empty($ingestas)){ ?>												
						<?php for ($i = 0; $i <= count($ingestas); $i++) { ?>
							<?php if (isset($ingestas[$i]) AND  $ingestas[$i] == 20) { $marcar_plato_cena_principal = 'checked=""'; }  else { } ?>
						<?php } ?>
					<?php } ?>
					<?php if (!empty($temp_incluir_plato_cena_principal)) { $marcar_plato_cena_principal = 'checked=""'; } else { } ?>
					<input id="plato_cena_principal" name="incluir_plato_cena_principal" type="checkbox" <?php echo $marcar_plato_cena_principal; ?> value="20" readonly disabled>
					<label for="plato_cena_principal">
						Plato principal cena
					</label>
				</div>
				<div class="checkbox checkbox-success">
					<?php $marcar_recena = ''; ?>
					<?php if(!empty($ingestas)){ ?>												
						<?php for ($i = 0; $i <= count($ingestas); $i++) { ?>
							<?php if (isset($ingestas[$i]) AND  $ingestas[$i] == 12) { $marcar_recena = 'checked=""'; }  else { } ?>
						<?php } ?>
					<?php } ?>	
					<?php if (!empty($temp_incluir_recena)) { $marcar_recena = 'checked=""'; } else { } ?>
					<input id="recena" name="incluir_recena" type="checkbox" <?php echo $marcar_recena; ?> value="12" readonly disabled>
					<label for="recena">
						Recena
					</label>
				</div>																														
				<div class="checkbox checkbox-success">
					<?php $marcar_otros = ''; ?>
					<?php if(!empty($ingestas)){ ?>												
						<?php for ($i = 0; $i <= count($ingestas); $i++) { ?>
							<?php if (isset($ingestas[$i]) AND  $ingestas[$i] == 18) { $marcar_otros = 'checked=""'; } else { } ?>
						<?php } ?>
					<?php } ?>	
					<?php if (!empty($temp_incluir_otros)) { $marcar_otros = 'checked=""'; } else { } ?>
					<input id="otros" name="incluir_otros" type="checkbox" <?php echo $marcar_otros; ?> value="18" readonly disabled>
					<label for="otros">
						Otros
					</label>
				</div>										 
			</div>					
		</div>
	</div>
</div>	
<!-- Parte 2 -->
<br><br>	
<div class="row">
	<div class="col-lg-12 text-left">
		<h1>Ingredientes</h1>								
		<table id="ingredientes" class="table table-striped dataTables-example select-filter">
		<thead>
			<tr>										
				<th>Alimento</th>										
				<th style="min-width:200px; text-align:right;">Cantidad </th>
				<th style="text-align:right;">Kcal/100g</th>											
			</tr>
		</thead>								
		<tbody>
			<?php $total_cantidad_mostrar = 0;?>
			<?php if(!empty($datos_alimento)) { ?>
			<?php for ($i = 0; $i <= count($datos_alimento); $i++) { ?>									
				<?php if(!empty($datos_alimento[$i]['id_alimento'])){ ?>
					<tr id="<?php echo $datos_alimento[$i]['id_alimento'];  ?>">												
						<?php if (in_array($datos_alimento[$i]['id_alimento'], $_SESSION['total_alimentos_desactivados_por_cliente_array'])) { ?>												
							<td><a class="tooltips desactivado_en_receta"><span> Este alimento esta desactivado o eliminado</span><?php echo salida_nombre($datos_alimento[$i]['nombre']); ?></a></td>	
						<?php } else { ?>	
							<td><?php echo salida_nombre($datos_alimento[$i]['nombre']); ?></td>	
						<?php } ?>		
						<td class="text-right"><?php echo $datos_alimento[$i]['cantidad']; $total_cantidad_mostrar =  $total_cantidad_mostrar+$datos_alimento[$i]['cantidad']; ?></td>		
						<td class="text-right"><?php echo round($datos_alimento[$i]['kcal_100g_org']); ?></td>
					</tr>
				<?php } ?>
			<?php } ?>
			<?php } ?>
		</tbody>
		<tfoot>
			<tr>				
				<th></th>
				<th style="text-align:right; padding-right: 8px !important;">Total Cantidad <?php echo $total_cantidad_mostrar; ?>g </th>	
				<th style="text-align:right; padding-right: 8px !important;"><?php echo $mostrar_kcal_100g; ?> Kcal/100g</th>										
			</tr>
		</tfoot>
		</table>
	</div>	
</div>
<!-- Parte 3 -->
<br><br>	
<div class="row">
	<div class="col-lg-12 text-left">	
		<!-- posible -->
		<h1>Información nutricional</h1>							
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
				
