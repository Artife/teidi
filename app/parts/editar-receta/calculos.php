<?php
	//consultamos los ingredientes con las cantidaddes
	if(!empty($ingredientes_temporal)){
	foreach ($ingredientes_temporal as &$ingrediente) {			
		$datos_alimento_ciclo = obtener_informacion_nutricional($ingrediente['id_alimento'], $ingrediente['cantidad']); 		
		
		//Total Cantdidades
		$cantidad_total = $cantidad_total+$ingrediente['cantidad'];
			
			//parte 1							
			$total_kcal_100g				= $total_kcal_100g+$datos_alimento_ciclo['kcal_100g'];		
			$total_hidratos_porc			= $total_hidratos_porc+$datos_alimento_ciclo['hidratos_porc'];
			$total_proteinas_porc			= $total_proteinas_porc+$datos_alimento_ciclo['proteinas_porc'];	
			$total_grasa_porc				= $total_grasa_porc+$datos_alimento_ciclo['grasa_porc'];
			$total_kcal_100g_org			= $total_kcal_100g_org+$datos_alimento_ciclo['kcal_100g_org'];	
			$total_hidratos					= $total_hidratos+$datos_alimento_ciclo['hidratos'];
			$total_proteinas				= $total_proteinas+$datos_alimento_ciclo['proteinas'];

			
			//
			$total_agua_g					= $total_agua_g+$datos_alimento_ciclo['agua_g'];			
			$total_hc_g						= $total_hc_g+$datos_alimento_ciclo['hc_g'];
			$total_prot_g					= $total_prot_g+$datos_alimento_ciclo['prot_g'];
			$total_grasa_g					= $total_grasa_g+$datos_alimento_ciclo['grasa_g'];
			$total_niacina					= $total_niacina+$datos_alimento_ciclo['niacina'];
			$total_satur_g					= $total_satur_g+$datos_alimento_ciclo['satur_g'];
			$total_mono_g					= $total_mono_g+$datos_alimento_ciclo['mono_g'];
			$total_poli_g					= $total_poli_g+$datos_alimento_ciclo['poli_g'];
			$total_col_mg					= $total_col_mg+$datos_alimento_ciclo['col_mg'];
			$total_fibra_g					= $total_fibra_g+$datos_alimento_ciclo['fibra_g'];
			$total_sodio_mg					= $total_sodio_mg+$datos_alimento_ciclo['sodio_mg'];
			$total_potasio_mg				= $total_potasio_mg+$datos_alimento_ciclo['potasio_mg'];
			$total_magnesio_mg				= $total_magnesio_mg+$datos_alimento_ciclo['magnesio_mg'];
			$total_calcio_mg				= $total_calcio_mg+$datos_alimento_ciclo['calcio_mg'];
			$total_fosf_mg					= $total_fosf_mg+$datos_alimento_ciclo['fosf_mg'];
			$total_hierro_mg				= $total_hierro_mg+$datos_alimento_ciclo['hierro_mg'];
			$total_cloro_mg					= $total_cloro_mg+$datos_alimento_ciclo['cloro_mg'];
			$total_cinc_mg					= $total_cinc_mg+$datos_alimento_ciclo['cinc_mg'];
			$total_cobre_mg					= $total_cobre_mg+$datos_alimento_ciclo['cobre_mg'];
			$total_manganeso_mg				= $total_manganeso_mg+$datos_alimento_ciclo['manganeso_mg'];
			$total_cromo_mg					= $total_cromo_mg+$datos_alimento_ciclo['cromo_mg'];
			$total_cobalto_mg				= $total_cobalto_mg+$datos_alimento_ciclo['cobalto_mg'];
			$total_molibde_mg				= $total_molibde_mg+$datos_alimento_ciclo['molibde_mg'];
			$total_yodo_mg					= $total_yodo_mg+$datos_alimento_ciclo['yodo_mg'];
			$total_fluor_mg					= $total_fluor_mg+$datos_alimento_ciclo['fluor_mg'];
			$total_butirico_c4_0			= $total_butirico_c4_0+$datos_alimento_ciclo['butirico_c4_0'];
			$total_caproico_c6_0			= $total_caproico_c6_0+$datos_alimento_ciclo['caproico_c6_0'];
			$total_caprilico_c8_0			= $total_caprilico_c8_0+$datos_alimento_ciclo['caprilico_c8_0'];
			$total_caprico_c10_0			= $total_caprico_c10_0+$datos_alimento_ciclo['caprico_c10_0'];
			$total_laurico_c12_0			= $total_laurico_c12_0+$datos_alimento_ciclo['laurico_c12_0'];
			$total_miristico_c14_0			= $total_miristico_c14_0+$datos_alimento_ciclo['miristico_c14_0'];
			$total_c15_0					= $total_c15_0+$datos_alimento_ciclo['c15_0'];
			$total_c15_00					= $total_c15_00+$datos_alimento_ciclo['c15_00'];
			$total_palmitico_c16_0			= $total_palmitico_c16_0+$datos_alimento_ciclo['palmitico_c16_0'];
			$total_c17_0					= $total_c17_0+$datos_alimento_ciclo['c17_0'];
			$total_c17_00					= $total_c17_00+$datos_alimento_ciclo['c17_00'];
			$total_estearico_c18_0			= $total_estearico_c18_0+$datos_alimento_ciclo['estearico_c18_0'];
			$total_araquidi_c20_0			= $total_araquidi_c20_0+$datos_alimento_ciclo['araquidi_c20_0'];
			$total_behenico_c22_0			= $total_behenico_c22_0+$datos_alimento_ciclo['behenico_c22_0'];
			$total_miristol_c14_1			= $total_miristol_c14_1+$datos_alimento_ciclo['miristol_c14_1'];
			$total_palmitole_c16_1			= $total_palmitole_c16_1+$datos_alimento_ciclo['palmitole_c16_1'];
			$total_oleico_c18_1				= $total_oleico_c18_1+$datos_alimento_ciclo['oleico_c18_1'];
			$total_eicoseno_c20_1			= $total_eicoseno_c20_1+$datos_alimento_ciclo['eicoseno_c20_1'];
			$total_c22_1					= $total_c22_1+$datos_alimento_ciclo['c22_1'];
			$total_linoleico_c18_2			= $total_linoleico_c18_2+$datos_alimento_ciclo['linoleico_c18_2'];
			$total_linoleni_c18_3			= $total_linoleni_c18_3+$datos_alimento_ciclo['linoleni_c18_3'];
			$total_c18_4					= $total_c18_4+$datos_alimento_ciclo['c18_4'];
			$total_ara_ico_c20_4			= $total_ara_ico_c20_4+$datos_alimento_ciclo['ara_ico_c20_4'];
			$total_c20_5					= $total_c20_5+$datos_alimento_ciclo['c20_5'];
			$total_c22_5					= $total_c22_5+$datos_alimento_ciclo['c22_5'];
			$total_c22_6					= $total_c22_6+$datos_alimento_ciclo['c22_6'];
			$total_otrosatur0				= $total_otrosatur0+$datos_alimento_ciclo['otrosatur0'];
			$total_otroinsat0				= $total_otroinsat0+$datos_alimento_ciclo['otroinsat0'];
			$total_omega3_0					= $total_omega3_0+$datos_alimento_ciclo['omega3_0'];
			$total_etanol0					= $total_etanol0+$datos_alimento_ciclo['etanol0'];
			$total_vit_a					= $total_vit_a+$datos_alimento_ciclo['vit_a'];
			$total_carotenos				= $total_carotenos+$datos_alimento_ciclo['carotenos'];
			$total_tocoferol				= $total_tocoferol+$datos_alimento_ciclo['tocoferol'];
			$total_vit_d					= $total_vit_d+$datos_alimento_ciclo['vit_d'];
			$total_vit_b1					= $total_vit_b1+$datos_alimento_ciclo['vit_b1'];
			$total_vit_b2					= $total_vit_b2+$datos_alimento_ciclo['vit_b2'];
			$total_vit_b6					= $total_vit_b6+$datos_alimento_ciclo['vit_b6'];
			$total_ac_panto					= $total_ac_panto+$datos_alimento_ciclo['ac_panto'];
			$total_biotina					= $total_biotina+$datos_alimento_ciclo['biotina'];
			$total_folico					= $total_folico+$datos_alimento_ciclo['folico'];
			$total_b12						= $total_b12+$datos_alimento_ciclo['b12'];
			$total_vit_c					= $total_vit_c+$datos_alimento_ciclo['vit_c'];
			$total_purinas					= $total_purinas+$datos_alimento_ciclo['purinas'];
			$total_vit_k					= $total_vit_k+$datos_alimento_ciclo['vit_k'];
			$total_vit_e					= $total_vit_e+$datos_alimento_ciclo['vit_e'];
			$total_oxalico					= $total_oxalico+$datos_alimento_ciclo['oxalico'];	
		
	}
	}
	
	//Calculamos todas las variables
	if(!empty($total_agua_g) || $total_agua_g != 0){
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
	$total_ac_panto					= round(($total_ac_panto*100)/$cantidad_total, 2);
	$total_biotina					= round(($total_biotina*100)/$cantidad_total, 2);
	$total_folico					= round(($total_folico*100)/$cantidad_total, 2);
	$total_b12						= round(($total_b12*100)/$cantidad_total, 2);
	$total_vit_c					= round(($total_vit_c*100)/$cantidad_total, 2);
	$total_purinas					= round(($total_purinas*100)/$cantidad_total, 2);
	$total_vit_k					= round(($total_vit_k*100)/$cantidad_total, 2);
	$total_vit_e					= round(($total_vit_e*100)/$cantidad_total, 2);
	$total_oxalico					= round(($total_oxalico*100)/$cantidad_total, 2);	
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