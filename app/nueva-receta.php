<?php
session_start();
include 'parts/conex.php';
$pagina = 'Nueva Receta';
$migas = array('Lista Recetas');
$migas_url = array('lista-recetas');

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include 'parts/consultas_mysql.php';
include_once 'parts/ayuda.php';


$i=0; 
$cantidad_total = 0;
$lista_temporal = '';
foreach($_POST as $nombre => $valor)  {		
	//nuevo_ingrediente_
	// echo $nombre.' - '.$valor.'<br>';
	if (substr($nombre, 0, 7) == 'indice_' && !empty($valor)){				
		// echo $nombre.' - '.$valor.'<br>';
		$id_alimento_nuevo = substr($nombre, 7);				
		$valor_alimento_nuevo = $valor;	
		
		$datos_alimento[$i] = obtener_informacion_nutricional($id_alimento_nuevo, $valor_alimento_nuevo); 
		$cantidad_total = $cantidad_total+$valor_alimento_nuevo;	
		
		
		//Listado temporal
		$lista_temporal[$i]['id_alimento'] = $id_alimento_nuevo;
		$lista_temporal[$i]['cantidad'] = $valor_alimento_nuevo;
		
		$i++;
	}   
}


//Recibir variables post
if(!empty($_POST["temp_nombre"])) { $temp_nombre = $_POST["temp_nombre"]; }
if(!empty($_POST["temp_descripcion"])) { $temp_descripcion = $_POST["temp_descripcion"]; }
if(!empty($_POST["temp_peso_minimo"])) { $temp_peso_minimo = $_POST["temp_peso_minimo"]; }
if(!empty($_POST["temp_peso_maximo"])) { $temp_peso_maximo = $_POST["temp_peso_maximo"]; }
if(!empty($_POST["temp_incluir_desayuno"])) { $temp_incluir_desayuno = $_POST["temp_incluir_desayuno"]; }
if(!empty($_POST["temp_incluir_media_manana"])) { $temp_incluir_media_manana = $_POST["temp_incluir_media_manana"]; }
if(!empty($_POST["temp_incluir_plato_comida"])) { $temp_incluir_plato_comida = $_POST["temp_incluir_plato_comida"]; }
if(!empty($_POST["temp_incluir_plato_comida_principal"])) { $temp_incluir_plato_comida_principal = $_POST["temp_incluir_plato_comida_principal"]; }
if(!empty($_POST["temp_incluir_postre"])) { $temp_incluir_postre = $_POST["temp_incluir_postre"]; }
if(!empty($_POST["temp_incluir_merienda"])) { $temp_incluir_merienda = $_POST["temp_incluir_merienda"]; }
if(!empty($_POST["temp_incluir_plato_cena"])) { $temp_incluir_plato_cena = $_POST["temp_incluir_plato_cena"]; }
if(!empty($_POST["temp_incluir_plato_cena_principal"])) { $temp_incluir_plato_cena_principal = $_POST["temp_incluir_plato_cena_principal"]; }
if(!empty($_POST["temp_incluir_recena"])) { $temp_incluir_recena = $_POST["temp_incluir_recena"]; }
if(!empty($_POST["temp_incluir_otros"])) { $temp_incluir_otros = $_POST["temp_incluir_otros"]; }


//Iniciamos las variables en 0

$total_hidratos_porc			= 0;
$total_kcal_100g				= 0;
$total_proteinas_porc			= 0;
$total_grasa_porc				= 0;
$total_kcal_100g_org			= 0;

//Esta no existe
// $alimento_info['kcal']		= $row["kcal"];			
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
if(!empty($datos_alimento)){
for ($i = 0; $i <= count($datos_alimento); $i++) {
	if(isset($datos_alimento[$i]['id_alimento'])){				
			
			$datos_alimento[$i]['kcal_100g'];			
			$total_kcal_100g				= $total_kcal_100g+$datos_alimento[$i]['kcal_100g'];
			$total_hidratos_porc			= $total_hidratos_porc+$datos_alimento[$i]['hidratos_porc'];
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
}	


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
	.mini_bottom_confirmar {
		/* display:none; */
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
		<form id="formulario_nueva_receta" action="<?php echo $url_app; ?>insert-receta" method="post">		
		<div class="row">
             <div class="col-lg-12">
				<div class="ibox float-e-margins">											
					<div class="row">
						<div class="col-md-8">
							<div class="ibox-content" id="datos_obligatorios">
								<h1>Datos obligatorios</h1>	
								<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre de la receta" required="" value="<?php if(!empty($receta['nombre'])){ echo utf8_encode($receta['nombre']); } ?><?php if(!empty($temp_nombre)){ echo utf8_encode($temp_nombre); } ?>">								
								<input type="hidden" class="form-control" name="descripcion" id="descripcion" placeholder="Título" required="" value="<?php if(!empty($receta['descripcion'])){ echo str_replace('\r\n','<br>',utf8_encode($receta['descripcion'])); } ?><?php if(!empty($temp_descripcion)){ echo utf8_encode($temp_descripcion); } ?>">
								<br/>
								<div class="ibox-content no-padding">
									<div id="summernote" class="summernote">
										<?php if(!empty($receta['descripcion'])){ echo str_replace('\r\n','<br>',utf8_encode($receta['descripcion'])); } ?><?php if(!empty($temp_descripcion)){ echo $temp_descripcion; } ?>
									</div>										
								</div>	
									<div class="row" style="position: absolute; margin-top: 0px; top: 20px; right: 45px;">
										<div class="col-md-12">								
											<div class="form-group text-center">
											<a href="<?php echo $url_app; ?>lista-recetas" class="btn btn-w-m btn-atras">Atras</a>
											<button id="guardar_receta" type="submit" class="btn btn-w-m btn-guardar" title="La suma de Hidratos, Proteínas y Grasas debe dar 100" disabled>Guardar</button>
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
									<div class="col-md-4"><div class="input-group m-b"><input type="text" class="form-control" name="kcal_por_100g" id="kcal_por_100g" placeholder="Kcal/100g" readonly="" value="<?php echo $mostrar_kcal_100g; ?>"></div></div>
									<div class="col-md-6"></div>
								</div>									
								<div class="row margin_top_receta">
									<div class="col-md-2"><p>Hidratos</p></div>
									<div class="col-md-4"><div class="input-group m-b"><input type="text" placeholder="Hidratos" class="form-control" id="hidratos_porc" name="hidratos_porc" value="<?php echo $mostrar_hidratos_porc; ?>" readonly=""><span class="input-group-addon">%</span></div></div>
									<div class="col-md-6"></div>
								</div>									
								<div class="row margin_top_receta">
									<div class="col-md-2"><p>Proteínas</p></div>
									<div class="col-md-4"><div class="input-group m-b"><input type="text" placeholder="Proteínas" class="form-control" id="proteinas_porc" name="proteinas_porc" value="<?php echo $mostrar_proteinas_porc; ?>" readonly=""><span class="input-group-addon">%</span></div></div>
									<div class="col-md-6"></div>
								</div>								
								<div class="row margin_top_receta">
									<div class="col-md-2"><p>Grasa</p></div>
									<div class="col-md-4"><div class="input-group m-b"><input type="text" placeholder="Grasa" class="form-control"  id="grasas_porc" name="grasas_porc" value="<?php echo $mostrar_grasa_porc; ?>" readonly=""><span class="input-group-addon">%</span></div></div>
									<div class="col-md-6"></div>
								</div>
							</div>
							<!-- Tamaño del plato -->
							<div class="ibox-content">	
								<div class="row margin_top_receta">
									<div class="col-md-12">
										<div class="input-group m-b"><span class="input-group-addon">Tamaño del plato entre</span><input type="text" placeholder="Peso Minimo" class="form-control"  id="peso_minimo" name="peso_minimo" value="<?php if(!empty($receta['peso_minimo'])){ echo $receta['peso_minimo']; } ?><?php if(!empty($temp_peso_minimo)){ echo utf8_encode($temp_peso_minimo); } ?>" required><span class="input-group-addon">y</span><input type="text" placeholder="Peso Maxímo" class="form-control" id="peso_maximo" name="peso_maximo" value="<?php if(!empty($receta['peso_maximo'])){ echo $receta['peso_maximo']; } ?><?php if(!empty($temp_peso_maximo)){ echo utf8_encode($temp_peso_maximo); } ?>" required><span class="input-group-addon">gramos</span></div>
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
											<?php if(!empty($ingestas)){ ?>	
												<?php for ($i = 0; $i <= count($ingestas); $i++) { ?>
													<?php if (isset($ingestas[$i]) AND  $ingestas[$i] == 7) { $marcar_desayuno = 'checked=""'; } else { } ?>													
												<?php } ?>
											<?php } ?>	
											<?php if (!empty($temp_incluir_desayuno)) { $marcar_desayuno = 'checked=""'; } else { } ?>
                                            <input id="desayuno" name="incluir_desayuno" type="checkbox" <?php echo $marcar_desayuno; ?> value="7">
                                            <label for="desayuno">
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
                                            <input id="media_manana"  name="incluir_media_manana"  type="checkbox" <?php echo $marcar_media_manana; ?> value="8">
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
                                            <input id="plato_comida" name="incluir_plato_comida" type="checkbox" <?php echo $marcar_plato_comida; ?> value="9">
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
                                            <input id="plato_comida_principal" name="incluir_plato_comida_principal" type="checkbox" <?php echo $plato_comida_principal; ?> value="19">
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
                                            <input id="postre" name="incluir_postre" type="checkbox" <?php echo $marcar_postre; ?> value="21">
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
                                            <input id="merienda"  name="incluir_merienda" type="checkbox" <?php echo $marcar_merienda; ?> value="10">
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
                                            <input id="plato_cena" name="incluir_plato_cena" type="checkbox" <?php echo $marcar_plato_cena; ?> value="11">
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
                                            <input id="plato_cena_principal" name="incluir_plato_cena_principal" type="checkbox" <?php echo $marcar_plato_cena_principal; ?> value="20">
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
                                            <input id="recena" name="incluir_recena" type="checkbox" <?php echo $marcar_recena; ?> value="12">
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
                                            <input id="otros" name="incluir_otros" type="checkbox" <?php echo $marcar_otros; ?> value="18">
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
								<div class="row" style="float: right;">
									<div class="col-md-12">								
										<div class="form-group">
										<a id="boton_eliminar_alimento" href="#" class="btn btn-w-m btn-eliminar" disabled>Eliminar</a>
										<a id="agregar_temp" class="btn btn-w-m btn-primary" data-toggle="modal" data-target="#myModal" title="Añadir nuevo alimento">Añadir</a>
										</div>
									</div>
								</div>
								<h1>Ingredientes</h1>								
								<table id="example" class="table table-striped dataTables-example select-filter">
								<thead>
									<tr> 
										<th style="width: 30px;">											
										<div class="checkbox checkbox-success" style="position: absolute;margin-top: -5px; margin-left: -3px;">
											<input id="checkbox1" type="checkbox" class="marcar_todos">
											<label for="checkbox1"></label>
										</div>
										</th>
										<th>Alimento</th>										
										<th style="min-width:200px;">Cantidad </th>
										<th>Kcal/100g</th>											
									</tr>
								</thead>								
								<tbody>
									<?php $total_cantidad_mostrar = 0;?>
									<?php if(!empty($datos_alimento)) { ?>
									<?php for ($i = 0; $i <= count($datos_alimento); $i++) { ?>									
										<?php if(!empty($datos_alimento[$i]['id_alimento'])){ ?>
											<tr id="<?php echo $datos_alimento[$i]['id_alimento'];  ?>">
												<td>
													<div class="checkbox checkbox-success">
														<input id="mostrar_ingrediente_<?php echo $datos_alimento[$i]['id_alimento']; ?>" type="checkbox" name="ingrediente_agregado_<?php echo $datos_alimento[$i]['id_alimento']; ?>" class="mostrar_ingrediente" value="<?php echo $i; ?>"><label for="mostrar_ingrediente_<?php echo $datos_alimento[$i]['id_alimento']; ?>"></label>
													</div>
												</td>
												<?php if (in_array($datos_alimento[$i]['id_alimento'], $_SESSION['total_alimentos_desactivados_por_cliente_array'])) { ?>												
													<td><a class="tooltips desactivado_en_receta"><span> Este alimento esta desactivado o eliminado</span><?php echo utf8_encode($datos_alimento[$i]['nombre']); ?></a></td>	
												<?php } else { ?>	
													<td><?php echo utf8_encode($datos_alimento[$i]['nombre']); ?></td>	
												<?php } ?>		
												<td><?php echo $datos_alimento[$i]['cantidad']; $total_cantidad_mostrar =  $total_cantidad_mostrar+$datos_alimento[$i]['cantidad']; ?></td>		
												<td><?php echo round($datos_alimento[$i]['kcal_100g_org']); ?></td>
											</tr>
										<?php } ?>
									<?php } ?>
									<?php } ?>
								</tbody>
								<tfoot>
									<tr>
										<th></th>
										<th></th>
										<th><?php echo $total_cantidad_mostrar; ?>g Total Cantidad</th>	
										<th><?php echo $mostrar_kcal_100g; ?> Kcal/100g</th>										
									</tr>
								</tfoot>
							</table>								
								<!-- llevar los ingredientes al insert -->
								<?php if(!empty($datos_alimento)) { ?>
								<?php for ($i = 0; $i <= count($datos_alimento); $i++) { ?>									
									<?php if(!empty($datos_alimento[$i]['id_alimento'])){ ?>
										<input type="hidden" id="insert_alimento_<?php echo $i; ?>"  name="insert_alimento_<?php echo $datos_alimento[$i]['id_alimento']; ?>" value="<?php echo $datos_alimento[$i]['cantidad']; ?>">										
									<?php } ?>
								<?php } ?>
								<?php } ?>	
								<input type="hidden" id="modificar_existentes"  name="modificar_existentes" value="">										
								<!-- llevar los ingredientes al insert -->
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
												<input type="text" placeholder="0" class="input-sm form-control" name="agua_g" value="<?php echo $total_agua_g; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 Hidratos de carbono, Total (g)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="hc_g" value="<?php echo  $total_hc_g; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 Fibra (g)	
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="fibra_g" value="<?php echo  $total_fibra_g; ?>" readonly required>								
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
												<input type="text" placeholder="0" class="input-sm form-control" name="prot_g" value="<?php echo  $total_prot_g; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 Grasas, total (g) 								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="grasa_g" value="<?php echo  $total_grasa_g; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 Colesterol (mg)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="col_mg" value="<?php echo  $total_col_mg; ?>" readonly required>								
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
												<input type="text" placeholder="0" class="input-sm form-control" name="satur_g" value="<?php echo  $total_satur_g; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 AGM totales (g)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="mono_g" value="<?php echo  $total_mono_g; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 AGP totales (g)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="poli_g" value="<?php echo  $total_poli_g; ?>" readonly required>								
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
												<input type="text" placeholder="0" class="input-sm form-control" name="vit_a" value="<?php echo  $total_vit_a; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 Carotenos (mg) 								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="carotenos" value="<?php echo  $total_carotenos; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 Tiamina B1 (mg)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="vit_b1" value="<?php echo  $total_vit_b1; ?>" readonly required>								
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
												<input type="text" placeholder="0" class="input-sm form-control" name="vit_b2" value="<?php echo  $total_vit_b2; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 Niacina B3 (mg)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="niacina" value="<?php echo  $total_niacina; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 Ac. Pantoténico B5 (mg)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="ac_panto" value="<?php echo  $total_ac_panto; ?>" readonly required>								
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
												<input type="text" placeholder="0" class="input-sm form-control" name="vit_b6" value="<?php echo  $total_vit_b6; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 Biotina (ug)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="biotina" value="<?php echo  $total_biotina; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 Ac. Fólico B9 (ug)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="folico" value="<?php echo  $total_folico; ?>" readonly required>								
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
												<input type="text" placeholder="0" class="input-sm form-control" name="b12" value="<?php echo  $total_b12; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 Vit C (mg)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="vit_c" value="<?php echo  $total_vit_c; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 Vit D (ug)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="vit_d" value="<?php echo  $total_vit_d; ?>" readonly required>								
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
												<input type="text" placeholder="0" class="input-sm form-control" name="tocoferol" value="<?php echo  $total_tocoferol; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 Vit E (mg)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="vit_e" value="<?php echo  $total_vit_e; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 Vit K (ug)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="vit_k" value="<?php echo  $total_vit_k; ?>" readonly required>								
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
												<input type="text" placeholder="0" class="input-sm form-control" name="oxalico" value="<?php echo  $total_oxalico; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 Purinas (mg)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="purinas" value="<?php echo  $total_purinas; ?>" readonly required>								
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
										<input type="text" placeholder="0" class="input-sm form-control" name="sodio_mg" value="<?php echo  $total_sodio_mg; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Potasio (mg)								
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="potasio_mg" value="<?php echo  $total_potasio_mg; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Magnesio (mg)
									</div>
									<div class="col-md-2">	
										<input type="text" placeholder="0" class="input-sm form-control" name="magnesio_mg" value="<?php echo  $total_magnesio_mg; ?>" readonly required>
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
										<input type="text" placeholder="0" class="input-sm form-control" name="calcio_mg" value="<?php echo  $total_calcio_mg; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Fósforo (mg)							
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="fosf_mg" value="<?php echo  $total_fosf_mg; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Hierro (mg)
									</div>
									<div class="col-md-2">	
										<input type="text" placeholder="0" class="input-sm form-control" name="hierro_mg" value="<?php echo  $total_hierro_mg; ?>" readonly required>
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
										<input type="text" placeholder="0" class="input-sm form-control" name="cloro_mg" value="<?php echo  $total_cloro_mg; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Zinc (mg)						
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="cinc_mg" value="<?php echo  $total_cinc_mg; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Cobre (ug)
									</div>
									<div class="col-md-2">	
										<input type="text" placeholder="0" class="input-sm form-control" name="cobre_mg" value="<?php echo  $total_cobre_mg; ?>" readonly required>
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
										<input type="text" placeholder="0" class="input-sm form-control" name="manganeso_mg" value="<?php echo  $total_manganeso_mg; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Cromo (mg)						
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="cromo_mg" value="<?php echo  $total_cromo_mg; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Cobalto (mg)
									</div>
									<div class="col-md-2">	
										<input type="text" placeholder="0" class="input-sm form-control" name="cobalto_mg" value="<?php echo  $total_cobalto_mg; ?>" readonly required>
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
										<input type="text" placeholder="0" class="input-sm form-control" name="molibde_mg" value="<?php echo  $total_molibde_mg; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Yodo (mg)					
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="yodo_mg" value="<?php echo  $total_yodo_mg; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Fluor (ug)
									</div>
									<div class="col-md-2">	
										<input type="text" placeholder="0" class="input-sm form-control" name="fluor_mg" value="<?php echo  $total_fluor_mg; ?>" readonly required>
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
										<input type="text" placeholder="0" class="input-sm form-control" name="butirico_c4_0" value="<?php echo  $total_butirico_c4_0; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Caproico C6:0 (mg)						
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="caproico_c6_0" value="<?php echo  $total_caproico_c6_0; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										 Caprílico C8:0 (mg)								
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="caprilico_c8_0" value="<?php echo  $total_caprilico_c8_0; ?>" readonly required>								
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
										<input type="text" placeholder="0" class="input-sm form-control" name="caprico_c10_0" value="<?php echo  $total_caprico_c10_0; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Lárico C12:0 (mg)					
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="laurico_c12_0" value="<?php echo  $total_laurico_c12_0; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Mirístico C14:0 (mg)								
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="miristico_c14_0" value="<?php echo  $total_miristico_c14_0; ?>" readonly required>								
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
										<input type="text" placeholder="0" class="input-sm form-control" name="c15_0" value="<?php echo  $total_c15_0; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										C15:00 (mg)				
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="c15_00" value="<?php echo  $total_c15_00; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Palmítico C16:0 (mg)								
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="palmitico_c16_0" value="<?php echo  $total_palmitico_c16_0; ?>" readonly required>								
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
										<input type="text" placeholder="0" class="input-sm form-control" name="c17_0" value="<?php echo  $total_c17_0; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										C17:00 (mg)		
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="c17_00" value="<?php echo  $total_c17_00; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Esteárico C18:0 (mg)							
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="estearico_c18_0" value="<?php echo  $total_estearico_c18_0; ?>" readonly required>								
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
										<input type="text" placeholder="0" class="input-sm form-control" name="araquidi_c20_0" value="<?php echo  $total_araquidi_c20_0; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Behénico C22:0 (mg)	
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="behenico_c22_0" value="<?php echo  $total_behenico_c22_0; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Miristol C14:1 (mg)							
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="miristol_c14_1" value="<?php echo  $total_miristol_c14_1; ?>" readonly required>								
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
										<input type="text" placeholder="0" class="input-sm form-control" name="palmitole_c16_1" value="<?php echo  $total_palmitole_c16_1; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Oleico C18:1 (mg)
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="oleico_c18_1" value="<?php echo  $total_oleico_c18_1; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Eicoseno C20:1 (mg)				
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="eicoseno_c20_1" value="<?php echo  $total_eicoseno_c20_1; ?>" readonly required>								
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
										<input type="text" placeholder="0" class="input-sm form-control" name="c22_1" value="<?php echo  $total_c22_1; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Linoleico C18:2 (mg)
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="linoleico_c18_2" value="<?php echo  $total_linoleico_c18_2; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Linolénico C18:3 (mg)			
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="linoleni_c18_3" value="<?php echo  $total_linoleni_c18_3; ?>" readonly required>								
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
										<input type="text" placeholder="0" class="input-sm form-control" name="c18_4" value="<?php echo  $total_c18_4; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Araquidónico C20:4 (mg)
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="ara_ico_c20_4" value="<?php echo  $total_ara_ico_c20_4; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										C20:5 (mg)			
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="c20_5" value="<?php echo  $total_c20_5; ?>" readonly required>								
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
										<input type="text" placeholder="0" class="input-sm form-control" name="c22_5" value="<?php echo  $total_c22_5; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										C22:6 (mg)
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="c22_6" value="<?php echo  $total_c22_6; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Otros satura (mg)			
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="otrosatur0" value="<?php echo $total_otrosatur0; ?>" readonly required>								
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
										<input type="text" placeholder="0" class="input-sm form-control" name="otroinsat0" value="<?php echo $total_otroinsat0; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Omega 3:0 (mg)
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="omega3_0" value="<?php echo $total_omega3_0; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Etanol (mg)			
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="etanol0" value="<?php echo $total_etanol0; ?>" readonly required>								
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
		</form>		
		</div>
	
                <div class="footer">
                    <?php include_once 'parts/footer.php'; ?>
                </div>
            </div>
			<?php include_once 'parts/menu_derecho.php'; ?>
        </div>
        </div>      
    </div>	
	<!-- Modal nuevo alimento -->
	<div id="myModal" class="modal fade" role="dialog">
		<form id="formulario_seleccionar_nuevo_ingrediente" action="<?php echo $url_app; ?>nueva-receta" method="post">	
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
							$cantidad_mostrar = 0; 
						?> 
						<?php for ($i = 0; $i <= count($listado_completo); $i++) { ?>
							<?php if(!empty($listado_completo[$i]['id_definitivo'])){ ?>							
								<tr>
									<td>
										<div class="checkbox checkbox-success">		
											<?php if (!empty($lista_temporal)) { ?>
											<?php if(array_search($listado_completo[$i]['id_definitivo'], array_column($lista_temporal, 'id_alimento')) !== False) { $l2_check = 'checked'; } else{ $l2_check = ''; }?>
											<?php }else{ $l2_check = ''; } ?>
											<input id="<?php echo $listado_completo[$i]['id_definitivo']; ?>" type="checkbox" name="nuevo_ingrediente_<?php echo $listado_completo[$i]['id_definitivo']; ?>" class="marcar_ni" <?php echo $l2_check; ?> value="<?php echo $i; ?>"><label for="<?php echo $listado_completo[$i]['id_definitivo']; ?>"></label>
										</div>
									</td>
									<td><?php echo utf8_encode($listado_completo[$i]['nombre']); ?></td>
									<?php if ($l2_check == '') {?>
									<td><?php echo $cantidad_mostrar; ?></td>
									<?php }else{?>
									<td><?php $en_indice = array_search($listado_completo[$i]['id_definitivo'], array_column($lista_temporal, 'id_alimento')); echo $lista_temporal[$en_indice]['cantidad']; ?></td>
									<?php }  ?>
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
							<?php $cantidad_mostrar = '0'; ?>
							<?php if (!empty($lista_temporal)) { ?>
								<?php if(array_search($listado_completo[$i]['id_definitivo'], array_column($lista_temporal, 'id_alimento')) !== False) { ?>
									<?php $en_indice = array_search($listado_completo[$i]['id_definitivo'], array_column($lista_temporal, 'id_alimento')); ?>
									<input type="hidden" id="valor_<?php echo $i; ?>"  name="indice_<?php echo $listado_completo[$i]['id_definitivo']; ?>" value="<?php echo $lista_temporal[$en_indice]['cantidad']; ?>">
								<?php }else{ ?>
								<input type="hidden" id="valor_<?php echo $i; ?>"  name="indice_<?php echo $listado_completo[$i]['id_definitivo']; ?>" value="<?php echo $cantidad_mostrar; ?>">
								<?php } ?>
							<?php }else{ ?>	
								<input type="hidden" id="valor_<?php echo $i; ?>"  name="indice_<?php echo $listado_completo[$i]['id_definitivo']; ?>" value="<?php echo $cantidad_mostrar; ?>">
							<?php } ?>
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
					<button type="submit" class="btn btn-w-m btn-guardar">Guardar</button>
					</div>
				</div>	<br><br>
			  </div>		  
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			  </div>
			</div>
			<input type="hidden" id="temp_nombre"  name="temp_nombre" value="">	
			<input type="hidden" id="temp_descripcion"  name="temp_descripcion" value="">
			<input type="hidden" id="temp_incluir_desayuno"  name="temp_incluir_desayuno" value="">	
			<input type="hidden" id="temp_incluir_media_manana"  name="temp_incluir_media_manana" value="">	
			<input type="hidden" id="temp_incluir_plato_comida"  name="temp_incluir_plato_comida" value="">	
			<input type="hidden" id="temp_incluir_plato_comida_principal"  name="temp_incluir_plato_comida_principal" value="">	
			<input type="hidden" id="temp_incluir_postre"  name="temp_incluir_postre" value="">	
			<input type="hidden" id="temp_incluir_merienda"  name="temp_incluir_merienda" value="">	
			<input type="hidden" id="temp_incluir_plato_cena"  name="temp_incluir_plato_cena" value="">	
			<input type="hidden" id="temp_incluir_plato_cena_principal"  name="temp_incluir_plato_cena_principal" value="">
			<input type="hidden" id="temp_incluir_recena"  name="temp_incluir_recena" value="">
			<input type="hidden" id="temp_incluir_otros"  name="temp_incluir_otros" value="">
			<input type="hidden" id="temp_peso_minimo"  name="temp_peso_minimo" value="">
			<input type="hidden" id="temp_peso_maximo"  name="temp_peso_maximo" value="">
		</form>		
	</div>
	<!-- Fin nuevo alimento -->
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
			
			// Boton de guardado
			var habilitar_guardado = 'disabled';
			var total_porcentaje;
			var a =parseInt($("#hidratos_porc").val());
			var b =parseInt($("#proteinas_porc").val());	
			var c =parseInt($("#grasas_porc").val());
			var total_porcentaje = a + b + c;
			if(total_porcentaje == 100){
				$("#guardar_receta").prop('disabled', false);								
			}else{
				$("#guardar_receta").prop('disabled', true);							
			}
			
			 
			
			//->Tabla 1 
			//->Agregar Alimentos
			table_final = $('#example').DataTable();	
			table_final.MakeCellsEditable({
				"onUpdate": myCallbackFunction,
				"inputCss":'my-input-class',
				"columns": [2],
				"allowNulls": {
					"columns": [2],
					"errorClass": 'error'
				},
				"confirmationButton": { // could also be true
					"confirmCss": 'mini_bottom_confirmar',
					"cancelCss": 'mini_bottom_cancelar'
				},
				"inputTypes": [
					{
						"column": 2,
						"type": "text",
						"options": null
					}
				]
			});	
			//->Tabla 2 
			//->Agregar Alimentos	
			table = $('#tabla_agregar_alimento').DataTable(
				{
				fnCreatedRow: function (nRow, aData, iDataIndex) {
					$(nRow).attr('id', iDataIndex); // or whatever you choose to set as the id
				}
				});			
			table.MakeCellsEditable({
				"onUpdate": myCallbackFunction,
				"inputCss":'my-input-class',
				"columns": [2],
				"allowNulls": {
					"columns": [2],
					"errorClass": 'error'
				},
				"confirmationButton": { // could also be true
					"confirmCss": 'mini_bottom_confirmar',
					"cancelCss": 'mini_bottom_cancelar'
				},
				"inputTypes": [
					{
						"column": 2,
						"type": "text",
						"options": null
					}
				]
			});						
						
			$(".marcar_todos").on("click", function () {
				var marcado = $(this).is(':checked'); 
				
				if(marcado == true){				
					$('.mostrar_ingrediente').prop('checked',true);
					$(".mostrar_ingrediente").attr('value', '1');					
				}else{				
					$('.mostrar_ingrediente').prop('checked',false);
					$(".mostrar_ingrediente").attr('value', '0');				
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
			
			//Agregar variables a temporal
			$("#agregar_temp").on("click", function () {
				pasar_a_temporal_variables(); 
			});
			$("#boton_eliminar_alimento").on("click", function () {
				pasar_a_temporal_variables();
				$("input[name = 'indice_"+indice_orgi+"']").attr('value', 0);				
				$('#formulario_seleccionar_nuevo_ingrediente').attr('action', "<?php echo $url_app; ?>nueva-receta");
				$("#formulario_seleccionar_nuevo_ingrediente" ).submit();	
			});
			
			//Esconder configuracion del html
			$('.note-toolbar .note-insert, .note-toolbar .note-table, .note-toolbar .note-style:first, .note-toolbar .note-para, .note-view, .note-fontname, .note-color').remove();
		
		});	
		
		$("#summernote").summernote();
		
		var indice_id = '';
		var indice_orgi = '';
		var tipo_tabla = '';
		var eliminar_alimento = '';
		
		$('#example').on( 'click', 'tr', function () {		  			
		    indice_orgi = ($(this).attr('id'));				
			tipo_tabla = 'editar_alimento';
			var total_marcados = $('.mostrar_ingrediente').filter(':checked').length
			if(total_marcados == 0){
				$('#boton_eliminar_alimento').attr('disabled', true); 
			}
			if(total_marcados == 1 ){
				$('#boton_eliminar_alimento').removeAttr("disabled");
			}
			if(total_marcados >= 2 ){
				$('#boton_eliminar_alimento').attr('disabled', true); 
			}
			console.log(indice_orgi);
		});
		$('#tabla_agregar_alimento').on( 'click', 'tr', function () {		  			
		    indice_id = ($(this).attr('id'));	
			tipo_tabla = 'agregar_alimento';			
		});			
		
		//Si edita un alimento ya agregado
		$('#example').on( 'click', 'tr .mini_bottom_confirmar', function () {		  			
		   
		});
		
		function myCallbackFunction (updatedCell, updatedRow, oldValue) {	
			if(tipo_tabla == 'editar_alimento'){
				pasar_a_temporal_variables();				
				$("input[name = 'indice_"+indice_orgi+"']").attr('value', updatedCell.data());		
  			    $('#formulario_seleccionar_nuevo_ingrediente').attr('action', "<?php echo $url_app; ?>nueva-receta");
				$("#formulario_seleccionar_nuevo_ingrediente" ).submit();						
			}else{
				$("#valor_"+indice_id).attr('value', updatedCell.data());		
			}
		}	
		
		//Pasar todas las variables a temporal
		function pasar_a_temporal_variables () {	
				var temp_nombre = $('#nombre').val();
				var temp_descripcion_encode = $('.note-editable').html();				
				var temp_descripcion = (encode_var(temp_descripcion_encode));
				var temp_peso_minimo = $('#peso_minimo').val();
				var temp_peso_maximo = $('#peso_maximo').val();
				
				//checkboxes
				if ($('#desayuno').is(':checked')) {
					var temp_incluir_desayuno = $('#desayuno').val();
				}else{
					var temp_incluir_desayuno = '';
				}	
				if ($('#media_manana').is(':checked')) {
					var temp_incluir_media_manana = $('#media_manana').val();
				}else{
					var temp_incluir_media_manana = '';
				}		
				if ($('#plato_comida').is(':checked')) {
					var temp_incluir_plato_comida = $('#plato_comida').val();
				}else{
					var temp_incluir_plato_comida = '';
				}	
				if ($('#plato_comida_principal').is(':checked')) {	
					var temp_incluir_plato_comida_principal = $('#plato_comida_principal').val();
				}else{
					var temp_incluir_plato_comida_principal = '';
				}	
				if ($('#postre').is(':checked')) {	
					var temp_incluir_postre = $('#postre').val();
				}else{
					var temp_incluir_postre = '';
				}	
				if ($('#merienda').is(':checked')) {	
					var temp_incluir_merienda = $('#merienda').val();
				}else{
					var temp_incluir_merienda = '';
				}	
				if ($('#plato_cena').is(':checked')) {	
					var	temp_incluir_plato_cena = $('#plato_cena').val();
				}else{
					var temp_incluir_plato_cena = '';
				}	
				if ($('#plato_cena_principal').is(':checked')) {	
					var temp_incluir_plato_cena_principal = $('#plato_cena_principal').val();
				}else{
					var temp_incluir_plato_cena_principal = '';
				}	
				if ($('#recena').is(':checked')) {	
					var temp_incluir_recena = $('#recena').val();
				}else{
					var temp_incluir_recena = '';
				}	
				if ($('#otros').is(':checked')) {	
					var temp_incluir_otros = $('#otros').val();
				}else{
					var temp_incluir_otros = '';
				}	
				
				//Si no estan vacios
				if(temp_nombre != ''){
					$("#temp_nombre").attr('value', temp_nombre);					
				}
				if(temp_descripcion != ''){
					$("#temp_descripcion").attr('value', decode_var(temp_descripcion));							
				}
				if(temp_peso_minimo != ''){
					$("#temp_peso_minimo").attr('value', temp_peso_minimo);	
					console.log(temp_peso_minimo);	
				}
				if(temp_peso_maximo != ''){
					$("#temp_peso_maximo").attr('value', temp_peso_maximo);						
				}
				if(temp_incluir_desayuno != ''){
					$("#temp_incluir_desayuno").attr('value', temp_incluir_desayuno);		
				}
				if(temp_incluir_media_manana != ''){
					$("#temp_incluir_media_manana").attr('value', temp_incluir_media_manana);		
				}
				if(temp_incluir_plato_comida != ''){
					$("#temp_incluir_plato_comida").attr('value', temp_incluir_plato_comida);		
				}
				if(temp_incluir_plato_comida_principal != ''){
					$("#temp_incluir_plato_comida_principal").attr('value', temp_incluir_plato_comida_principal);		
				}
				if(temp_incluir_postre != ''){
					$("#temp_incluir_postre").attr('value', temp_incluir_postre);		
				}
				if(temp_incluir_merienda != ''){
					$("#temp_incluir_merienda").attr('value', temp_incluir_merienda);		
				}
				if(temp_incluir_plato_cena != ''){
					$("#temp_incluir_plato_cena").attr('value', temp_incluir_plato_cena);		
				}
				if(temp_incluir_plato_cena_principal != ''){
					$("#temp_incluir_plato_cena_principal").attr('value', temp_incluir_plato_cena_principal);		
				}
				if(temp_incluir_recena != ''){
					$("#temp_incluir_recena").attr('value', temp_incluir_recena);		
				}
				if(temp_incluir_otros != ''){
					$("#temp_incluir_otros").attr('value', temp_incluir_otros);		
				}
		}
		function encode_var (str) {
			var buf = [];
			
			for (var i=str.length-1;i>=0;i--) {
				buf.unshift(['&#', str[i].charCodeAt(), ';'].join(''));
			}
			
			return buf.join('');
		}
		function decode_var (str) {
			return str.replace(/&#(\d+);/g, function(match, dec) {
				return String.fromCharCode(dec);
			});
		}
    </script>	
	<?php $conn->close(); ?>
</body>
</html>


