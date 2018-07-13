<?php

ini_set('max_execution_time', 2000);

// Includes
include 'bbdd/bbdd.php';
include 'comun.php';
//include("error_handler.php");

function generarEstadisticas()
{
	$media_hidratos = 0;
    $media_proteinas = 0;
    $media_grasas = 0;
    $media_calorias = 0;
	
	$platos_porDia = $_SESSION["num_comidas"];

    if ($_SESSION["platos_comida"] == 2)
     	$platos_porDia++;
    if ($_SESSION["postre_comida"] == TRUE)
    	$platos_porDia++;
    if ($_SESSION["platos_cena"] == 2)
    	$platos_porDia++;
    if ($_SESSION["postre_cena"] == TRUE)
    	$platos_porDia++;

    $semana = 0;
    crearMatrices();

    for ($i = 0; $i < $_SESSION["num_dias"]; $i++)
    {
		//echo " 14".$i." " .time();
        $semana = floor($i/7);

		//echo " desayunos ";
		$media_grasas += $_SESSION["desayunos"][$i]->grasa;
        $media_hidratos += $_SESSION["desayunos"][$i]->hidratos;
        $media_proteinas += $_SESSION["desayunos"][$i]->proteinas;
		
		$_SESSION["media_pc_porcentaje"][$i] += $_SESSION["desayunos"][$i]->pc_porcentaje*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_agua_g"][$i] += $_SESSION["desayunos"][$i]->agua_g*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_cal_kcal"][$i] += $_SESSION["desayunos"][$i]->cal_kcal*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_prot_g"][$i] += $_SESSION["desayunos"][$i]->prot_g*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_hc_g"][$i] += $_SESSION["desayunos"][$i]->hc_g*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_grasa_g"][$i] += $_SESSION["desayunos"][$i]->grasa_g*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_satur_g"][$i] += $_SESSION["desayunos"][$i]->satur_g*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_mono_g"][$i] += $_SESSION["desayunos"][$i]->mono_g*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_poli_g"][$i] += $_SESSION["desayunos"][$i]->poli_g*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_col_mg"][$i] += $_SESSION["desayunos"][$i]->col_mg*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_fibra_g"][$i] += $_SESSION["desayunos"][$i]->fibra_g*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_sodio_mg"][$i] += $_SESSION["desayunos"][$i]->sodio_mg*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_potasio_mg"][$i] += $_SESSION["desayunos"][$i]->potasio_mg*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_magnesio_mg"][$i] += $_SESSION["desayunos"][$i]->magnesio_mg*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_calcio_mg"][$i] += $_SESSION["desayunos"][$i]->calcio_mg*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_fosf_mg"][$i] += $_SESSION["desayunos"][$i]->fosf_mg*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_hierro_mg"][$i] += $_SESSION["desayunos"][$i]->hierro_mg*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_cloro_mg"][$i] += $_SESSION["desayunos"][$i]->cloro_mg*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_cinc_mg"][$i] += $_SESSION["desayunos"][$i]->cinc_mg*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_cobre_mg"][$i] += $_SESSION["desayunos"][$i]->cobre_mg*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_manganeso_mg"][$i] += $_SESSION["desayunos"][$i]->manganeso_mg*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_cromo_mg"][$i] += $_SESSION["desayunos"][$i]->cromo_mg*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_cobalto_mg"][$i] += $_SESSION["desayunos"][$i]->cobalto_mg*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_molibde_mg"][$i] += $_SESSION["desayunos"][$i]->molibde_mg*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_yodo_mg"][$i] += $_SESSION["desayunos"][$i]->yodo_mg*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_fluor_mg"][$i] += $_SESSION["desayunos"][$i]->fluor_mg*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_butirico_c4_0"][$i] += $_SESSION["desayunos"][$i]->butirico_c4_0*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_caproico_c6_0"][$i] += $_SESSION["desayunos"][$i]->caproico_c6_0*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_caprilico_c8_0"][$i] += $_SESSION["desayunos"][$i]->caprilico_c8_0*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_caprico_c10_0"][$i] += $_SESSION["desayunos"][$i]->caprico_c10_0*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_laurico_c12_0"][$i] += $_SESSION["desayunos"][$i]->laurico_c12_0*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_miristico_c14_0"][$i] += $_SESSION["desayunos"][$i]->miristico_c14_0*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_c15_0"][$i] += $_SESSION["desayunos"][$i]->c15_0*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_c15_00"][$i] += $_SESSION["desayunos"][$i]->c15_00*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_palmitico_c16_0"][$i] += $_SESSION["desayunos"][$i]->palmitico_c16_0*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_c17_0"][$i] += $_SESSION["desayunos"][$i]->c17_0*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_c17_00"][$i] += $_SESSION["desayunos"][$i]->c17_00*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_estearico_c18_0"][$i] += $_SESSION["desayunos"][$i]->estearico_c18_0*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_araquidi_c20_0"][$i] += $_SESSION["desayunos"][$i]->araquidi_c20_0*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_behenico_c22_0"][$i] += $_SESSION["desayunos"][$i]->behenico_c22_0*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_miristol_c14_1"][$i] += $_SESSION["desayunos"][$i]->miristol_c14_1*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_palmitole_c16_1"][$i] += $_SESSION["desayunos"][$i]->palmitole_c16_1*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_oleico_c18_1"][$i] += $_SESSION["desayunos"][$i]->oleico_c18_1*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_eicoseno_c20_1"][$i] += $_SESSION["desayunos"][$i]->eicoseno_c20_1*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_c22_1"][$i] += $_SESSION["desayunos"][$i]->c22_1*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_linoleico_c18_2"][$i] += $_SESSION["desayunos"][$i]->linoleico_c18_2*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_linoleni_c18_3"][$i] += $_SESSION["desayunos"][$i]->linoleni_c18_3*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_c18_4"][$i] += $_SESSION["desayunos"][$i]->c18_4*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_ara_ico_c20_4"][$i] += $_SESSION["desayunos"][$i]->ara_ico_c20_4*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_c20_5"][$i] += $_SESSION["desayunos"][$i]->c20_5*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_c22_5"][$i] += $_SESSION["desayunos"][$i]->c22_5*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_c22_6"][$i] += $_SESSION["desayunos"][$i]->c22_6*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_otrosatur0"][$i] += $_SESSION["desayunos"][$i]->otrosatur0*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_otroinsat0"][$i] += $_SESSION["desayunos"][$i]->otroinsat0*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_omega3_0"][$i] += $_SESSION["desayunos"][$i]->omega3_0*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_etanol0"][$i] += $_SESSION["desayunos"][$i]->etanol0*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_vit_a"][$i] += $_SESSION["desayunos"][$i]->vit_a*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_carotenos"][$i] += $_SESSION["desayunos"][$i]->carotenos*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_tocoferol"][$i] += $_SESSION["desayunos"][$i]->tocoferol*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_vit_d"][$i] += $_SESSION["desayunos"][$i]->vit_d*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_vit_b1"][$i] += $_SESSION["desayunos"][$i]->vit_b1*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_vit_b2"][$i] += $_SESSION["desayunos"][$i]->vit_b2*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_vit_b6"][$i] += $_SESSION["desayunos"][$i]->vit_b6*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_niacina"][$i] += $_SESSION["desayunos"][$i]->niacina*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_ac_panto"][$i] += $_SESSION["desayunos"][$i]->ac_panto*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_biotina"][$i] += $_SESSION["desayunos"][$i]->biotina*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_folico"][$i] += $_SESSION["desayunos"][$i]->folico*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_b12"][$i] += $_SESSION["desayunos"][$i]->b12*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_vit_c"][$i] += $_SESSION["desayunos"][$i]->vit_c*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_purinas"][$i] += $_SESSION["desayunos"][$i]->purinas*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_vit_k"][$i] += $_SESSION["desayunos"][$i]->vit_k*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_vit_e"][$i] += $_SESSION["desayunos"][$i]->vit_e*$_SESSION["desayunos"][$i]->peso/100;
		$_SESSION["media_oxalico"][$i] += $_SESSION["desayunos"][$i]->oxalico*$_SESSION["desayunos"][$i]->peso/100;

        rellenaMatrices($_SESSION["desayunos"][$i]->id_plato, $i, $semana);

		//echo " mediamananas ";
        if ($_SESSION["kcalorias_mediamanana"] != 0)
        {
        	$media_grasas += $_SESSION["mediamananas"][$i]->grasa;
	        $media_hidratos += $_SESSION["mediamananas"][$i]->hidratos;
	        $media_proteinas += $_SESSION["mediamananas"][$i]->proteinas;

			$_SESSION["media_pc_porcentaje"][$i] += $_SESSION["mediamananas"][$i]->pc_porcentaje*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_agua_g"][$i] += $_SESSION["mediamananas"][$i]->agua_g*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_cal_kcal"][$i] += $_SESSION["mediamananas"][$i]->cal_kcal*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_prot_g"][$i] += $_SESSION["mediamananas"][$i]->prot_g*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_hc_g"][$i] += $_SESSION["mediamananas"][$i]->hc_g*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_grasa_g"][$i] += $_SESSION["mediamananas"][$i]->grasa_g*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_satur_g"][$i] += $_SESSION["mediamananas"][$i]->satur_g*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_mono_g"][$i] += $_SESSION["mediamananas"][$i]->mono_g*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_poli_g"][$i] += $_SESSION["mediamananas"][$i]->poli_g*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_col_mg"][$i] += $_SESSION["mediamananas"][$i]->col_mg*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_fibra_g"][$i] += $_SESSION["mediamananas"][$i]->fibra_g*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_sodio_mg"][$i] += $_SESSION["mediamananas"][$i]->sodio_mg*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_potasio_mg"][$i] += $_SESSION["mediamananas"][$i]->potasio_mg*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_magnesio_mg"][$i] += $_SESSION["mediamananas"][$i]->magnesio_mg*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_calcio_mg"][$i] += $_SESSION["mediamananas"][$i]->calcio_mg*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_fosf_mg"][$i] += $_SESSION["mediamananas"][$i]->fosf_mg*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_hierro_mg"][$i] += $_SESSION["mediamananas"][$i]->hierro_mg*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_cloro_mg"][$i] += $_SESSION["mediamananas"][$i]->cloro_mg*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_cinc_mg"][$i] += $_SESSION["mediamananas"][$i]->cinc_mg*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_cobre_mg"][$i] += $_SESSION["mediamananas"][$i]->cobre_mg*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_manganeso_mg"][$i] += $_SESSION["mediamananas"][$i]->manganeso_mg*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_cromo_mg"][$i] += $_SESSION["mediamananas"][$i]->cromo_mg*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_cobalto_mg"][$i] += $_SESSION["mediamananas"][$i]->cobalto_mg*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_molibde_mg"][$i] += $_SESSION["mediamananas"][$i]->molibde_mg*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_yodo_mg"][$i] += $_SESSION["mediamananas"][$i]->yodo_mg*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_fluor_mg"][$i] += $_SESSION["mediamananas"][$i]->fluor_mg*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_butirico_c4_0"][$i] += $_SESSION["mediamananas"][$i]->butirico_c4_0*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_caproico_c6_0"][$i] += $_SESSION["mediamananas"][$i]->caproico_c6_0*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_caprilico_c8_0"][$i] += $_SESSION["mediamananas"][$i]->caprilico_c8_0*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_caprico_c10_0"][$i] += $_SESSION["mediamananas"][$i]->caprico_c10_0*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_laurico_c12_0"][$i] += $_SESSION["mediamananas"][$i]->laurico_c12_0*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_miristico_c14_0"][$i] += $_SESSION["mediamananas"][$i]->miristico_c14_0*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_c15_0"][$i] += $_SESSION["mediamananas"][$i]->c15_0*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_c15_00"][$i] += $_SESSION["mediamananas"][$i]->c15_00*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_palmitico_c16_0"][$i] += $_SESSION["mediamananas"][$i]->palmitico_c16_0*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_c17_0"][$i] += $_SESSION["mediamananas"][$i]->c17_0*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_c17_00"][$i] += $_SESSION["mediamananas"][$i]->c17_00*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_estearico_c18_0"][$i] += $_SESSION["mediamananas"][$i]->estearico_c18_0*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_araquidi_c20_0"][$i] += $_SESSION["mediamananas"][$i]->araquidi_c20_0*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_behenico_c22_0"][$i] += $_SESSION["mediamananas"][$i]->behenico_c22_0*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_miristol_c14_1"][$i] += $_SESSION["mediamananas"][$i]->miristol_c14_1*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_palmitole_c16_1"][$i] += $_SESSION["mediamananas"][$i]->palmitole_c16_1*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_oleico_c18_1"][$i] += $_SESSION["mediamananas"][$i]->oleico_c18_1*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_eicoseno_c20_1"][$i] += $_SESSION["mediamananas"][$i]->eicoseno_c20_1*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_c22_1"][$i] += $_SESSION["mediamananas"][$i]->c22_1*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_linoleico_c18_2"][$i] += $_SESSION["mediamananas"][$i]->linoleico_c18_2*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_linoleni_c18_3"][$i] += $_SESSION["mediamananas"][$i]->linoleni_c18_3*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_c18_4"][$i] += $_SESSION["mediamananas"][$i]->c18_4*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_ara_ico_c20_4"][$i] += $_SESSION["mediamananas"][$i]->ara_ico_c20_4*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_c20_5"][$i] += $_SESSION["mediamananas"][$i]->c20_5*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_c22_5"][$i] += $_SESSION["mediamananas"][$i]->c22_5*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_c22_6"][$i] += $_SESSION["mediamananas"][$i]->c22_6*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_otrosatur0"][$i] += $_SESSION["mediamananas"][$i]->otrosatur0*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_otroinsat0"][$i] += $_SESSION["mediamananas"][$i]->otroinsat0*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_omega3_0"][$i] += $_SESSION["mediamananas"][$i]->omega3_0*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_etanol0"][$i] += $_SESSION["mediamananas"][$i]->etanol0*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_vit_a"][$i] += $_SESSION["mediamananas"][$i]->vit_a*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_carotenos"][$i] += $_SESSION["mediamananas"][$i]->carotenos*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_tocoferol"][$i] += $_SESSION["mediamananas"][$i]->tocoferol*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_vit_d"][$i] += $_SESSION["mediamananas"][$i]->vit_d*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_vit_b1"][$i] += $_SESSION["mediamananas"][$i]->vit_b1*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_vit_b2"][$i] += $_SESSION["mediamananas"][$i]->vit_b2*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_vit_b6"][$i] += $_SESSION["mediamananas"][$i]->vit_b6*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_niacina"][$i] += $_SESSION["mediamananas"][$i]->niacina*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_ac_panto"][$i] += $_SESSION["mediamananas"][$i]->ac_panto*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_biotina"][$i] += $_SESSION["mediamananas"][$i]->biotina*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_folico"][$i] += $_SESSION["mediamananas"][$i]->folico*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_b12"][$i] += $_SESSION["mediamananas"][$i]->b12*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_vit_c"][$i] += $_SESSION["mediamananas"][$i]->vit_c*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_purinas"][$i] += $_SESSION["mediamananas"][$i]->purinas*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_vit_k"][$i] += $_SESSION["mediamananas"][$i]->vit_k*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_vit_e"][$i] += $_SESSION["mediamananas"][$i]->vit_e*$_SESSION["mediamananas"][$i]->peso/100;
			$_SESSION["media_oxalico"][$i] += $_SESSION["mediamananas"][$i]->oxalico*$_SESSION["mediamananas"][$i]->peso/100;

	        rellenaMatrices($_SESSION["mediamananas"][$i]->id_plato, $i, $semana);
        }
		
		//echo " comidas1 ";
        if ($_SESSION["kcalorias_comida1"] != 0)
        {
        	$media_grasas += $_SESSION["comidas1"][$i]->grasa;
	        $media_hidratos += $_SESSION["comidas1"][$i]->hidratos;
	        $media_proteinas += $_SESSION["comidas1"][$i]->proteinas;
			
			$_SESSION["media_pc_porcentaje"][$i] += $_SESSION["comidas1"][$i]->pc_porcentaje*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_agua_g"][$i] += $_SESSION["comidas1"][$i]->agua_g*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_cal_kcal"][$i] += $_SESSION["comidas1"][$i]->cal_kcal*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_prot_g"][$i] += $_SESSION["comidas1"][$i]->prot_g*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_hc_g"][$i] += $_SESSION["comidas1"][$i]->hc_g*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_grasa_g"][$i] += $_SESSION["comidas1"][$i]->grasa_g*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_satur_g"][$i] += $_SESSION["comidas1"][$i]->satur_g*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_mono_g"][$i] += $_SESSION["comidas1"][$i]->mono_g*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_poli_g"][$i] += $_SESSION["comidas1"][$i]->poli_g*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_col_mg"][$i] += $_SESSION["comidas1"][$i]->col_mg*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_fibra_g"][$i] += $_SESSION["comidas1"][$i]->fibra_g*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_sodio_mg"][$i] += $_SESSION["comidas1"][$i]->sodio_mg*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_potasio_mg"][$i] += $_SESSION["comidas1"][$i]->potasio_mg*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_magnesio_mg"][$i] += $_SESSION["comidas1"][$i]->magnesio_mg*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_calcio_mg"][$i] += $_SESSION["comidas1"][$i]->calcio_mg*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_fosf_mg"][$i] += $_SESSION["comidas1"][$i]->fosf_mg*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_hierro_mg"][$i] += $_SESSION["comidas1"][$i]->hierro_mg*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_cloro_mg"][$i] += $_SESSION["comidas1"][$i]->cloro_mg*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_cinc_mg"][$i] += $_SESSION["comidas1"][$i]->cinc_mg*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_cobre_mg"][$i] += $_SESSION["comidas1"][$i]->cobre_mg*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_manganeso_mg"][$i] += $_SESSION["comidas1"][$i]->manganeso_mg*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_cromo_mg"][$i] += $_SESSION["comidas1"][$i]->cromo_mg*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_cobalto_mg"][$i] += $_SESSION["comidas1"][$i]->cobalto_mg*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_molibde_mg"][$i] += $_SESSION["comidas1"][$i]->molibde_mg*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_yodo_mg"][$i] += $_SESSION["comidas1"][$i]->yodo_mg*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_fluor_mg"][$i] += $_SESSION["comidas1"][$i]->fluor_mg*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_butirico_c4_0"][$i] += $_SESSION["comidas1"][$i]->butirico_c4_0*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_caproico_c6_0"][$i] += $_SESSION["comidas1"][$i]->caproico_c6_0*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_caprilico_c8_0"][$i] += $_SESSION["comidas1"][$i]->caprilico_c8_0*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_caprico_c10_0"][$i] += $_SESSION["comidas1"][$i]->caprico_c10_0*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_laurico_c12_0"][$i] += $_SESSION["comidas1"][$i]->laurico_c12_0*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_miristico_c14_0"][$i] += $_SESSION["comidas1"][$i]->miristico_c14_0*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_c15_0"][$i] += $_SESSION["comidas1"][$i]->c15_0*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_c15_00"][$i] += $_SESSION["comidas1"][$i]->c15_00*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_palmitico_c16_0"][$i] += $_SESSION["comidas1"][$i]->palmitico_c16_0*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_c17_0"][$i] += $_SESSION["comidas1"][$i]->c17_0*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_c17_00"][$i] += $_SESSION["comidas1"][$i]->c17_00*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_estearico_c18_0"][$i] += $_SESSION["comidas1"][$i]->estearico_c18_0*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_araquidi_c20_0"][$i] += $_SESSION["comidas1"][$i]->araquidi_c20_0*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_behenico_c22_0"][$i] += $_SESSION["comidas1"][$i]->behenico_c22_0*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_miristol_c14_1"][$i] += $_SESSION["comidas1"][$i]->miristol_c14_1*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_palmitole_c16_1"][$i] += $_SESSION["comidas1"][$i]->palmitole_c16_1*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_oleico_c18_1"][$i] += $_SESSION["comidas1"][$i]->oleico_c18_1*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_eicoseno_c20_1"][$i] += $_SESSION["comidas1"][$i]->eicoseno_c20_1*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_c22_1"][$i] += $_SESSION["comidas1"][$i]->c22_1*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_linoleico_c18_2"][$i] += $_SESSION["comidas1"][$i]->linoleico_c18_2*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_linoleni_c18_3"][$i] += $_SESSION["comidas1"][$i]->linoleni_c18_3*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_c18_4"][$i] += $_SESSION["comidas1"][$i]->c18_4*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_ara_ico_c20_4"][$i] += $_SESSION["comidas1"][$i]->ara_ico_c20_4*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_c20_5"][$i] += $_SESSION["comidas1"][$i]->c20_5*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_c22_5"][$i] += $_SESSION["comidas1"][$i]->c22_5*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_c22_6"][$i] += $_SESSION["comidas1"][$i]->c22_6*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_otrosatur0"][$i] += $_SESSION["comidas1"][$i]->otrosatur0*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_otroinsat0"][$i] += $_SESSION["comidas1"][$i]->otroinsat0*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_omega3_0"][$i] += $_SESSION["comidas1"][$i]->omega3_0*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_etanol0"][$i] += $_SESSION["comidas1"][$i]->etanol0*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_vit_a"][$i] += $_SESSION["comidas1"][$i]->vit_a*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_carotenos"][$i] += $_SESSION["comidas1"][$i]->carotenos*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_tocoferol"][$i] += $_SESSION["comidas1"][$i]->tocoferol*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_vit_d"][$i] += $_SESSION["comidas1"][$i]->vit_d*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_vit_b1"][$i] += $_SESSION["comidas1"][$i]->vit_b1*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_vit_b2"][$i] += $_SESSION["comidas1"][$i]->vit_b2*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_vit_b6"][$i] += $_SESSION["comidas1"][$i]->vit_b6*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_niacina"][$i] += $_SESSION["comidas1"][$i]->niacina*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_ac_panto"][$i] += $_SESSION["comidas1"][$i]->ac_panto*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_biotina"][$i] += $_SESSION["comidas1"][$i]->biotina*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_folico"][$i] += $_SESSION["comidas1"][$i]->folico*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_b12"][$i] += $_SESSION["comidas1"][$i]->b12*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_vit_c"][$i] += $_SESSION["comidas1"][$i]->vit_c*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_purinas"][$i] += $_SESSION["comidas1"][$i]->purinas*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_vit_k"][$i] += $_SESSION["comidas1"][$i]->vit_k*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_vit_e"][$i] += $_SESSION["comidas1"][$i]->vit_e*$_SESSION["comidas1"][$i]->peso/100;
			$_SESSION["media_oxalico"][$i] += $_SESSION["comidas1"][$i]->oxalico*$_SESSION["comidas1"][$i]->peso/100;

	        rellenaMatrices($_SESSION["comidas1"][$i]->id_plato, $i, $semana);
        }

		//echo " comidas ";
        $media_grasas += $_SESSION["comidas"][$i]->grasa;
        $media_hidratos += $_SESSION["comidas"][$i]->hidratos;
        $media_proteinas += $_SESSION["comidas"][$i]->proteinas;
		
		$_SESSION["media_pc_porcentaje"][$i] += $_SESSION["comidas"][$i]->pc_porcentaje*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_agua_g"][$i] += $_SESSION["comidas"][$i]->agua_g*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_cal_kcal"][$i] += $_SESSION["comidas"][$i]->cal_kcal*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_prot_g"][$i] += $_SESSION["comidas"][$i]->prot_g*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_hc_g"][$i] += $_SESSION["comidas"][$i]->hc_g*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_grasa_g"][$i] += $_SESSION["comidas"][$i]->grasa_g*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_satur_g"][$i] += $_SESSION["comidas"][$i]->satur_g*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_mono_g"][$i] += $_SESSION["comidas"][$i]->mono_g*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_poli_g"][$i] += $_SESSION["comidas"][$i]->poli_g*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_col_mg"][$i] += $_SESSION["comidas"][$i]->col_mg*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_fibra_g"][$i] += $_SESSION["comidas"][$i]->fibra_g*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_sodio_mg"][$i] += $_SESSION["comidas"][$i]->sodio_mg*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_potasio_mg"][$i] += $_SESSION["comidas"][$i]->potasio_mg*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_magnesio_mg"][$i] += $_SESSION["comidas"][$i]->magnesio_mg*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_calcio_mg"][$i] += $_SESSION["comidas"][$i]->calcio_mg*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_fosf_mg"][$i] += $_SESSION["comidas"][$i]->fosf_mg*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_hierro_mg"][$i] += $_SESSION["comidas"][$i]->hierro_mg*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_cloro_mg"][$i] += $_SESSION["comidas"][$i]->cloro_mg*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_cinc_mg"][$i] += $_SESSION["comidas"][$i]->cinc_mg*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_cobre_mg"][$i] += $_SESSION["comidas"][$i]->cobre_mg*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_manganeso_mg"][$i] += $_SESSION["comidas"][$i]->manganeso_mg*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_cromo_mg"][$i] += $_SESSION["comidas"][$i]->cromo_mg*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_cobalto_mg"][$i] += $_SESSION["comidas"][$i]->cobalto_mg*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_molibde_mg"][$i] += $_SESSION["comidas"][$i]->molibde_mg*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_yodo_mg"][$i] += $_SESSION["comidas"][$i]->yodo_mg*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_fluor_mg"][$i] += $_SESSION["comidas"][$i]->fluor_mg*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_butirico_c4_0"][$i] += $_SESSION["comidas"][$i]->butirico_c4_0*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_caproico_c6_0"][$i] += $_SESSION["comidas"][$i]->caproico_c6_0*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_caprilico_c8_0"][$i] += $_SESSION["comidas"][$i]->caprilico_c8_0*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_caprico_c10_0"][$i] += $_SESSION["comidas"][$i]->caprico_c10_0*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_laurico_c12_0"][$i] += $_SESSION["comidas"][$i]->laurico_c12_0*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_miristico_c14_0"][$i] += $_SESSION["comidas"][$i]->miristico_c14_0*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_c15_0"][$i] += $_SESSION["comidas"][$i]->c15_0*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_c15_00"][$i] += $_SESSION["comidas"][$i]->c15_00*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_palmitico_c16_0"][$i] += $_SESSION["comidas"][$i]->palmitico_c16_0*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_c17_0"][$i] += $_SESSION["comidas"][$i]->c17_0*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_c17_00"][$i] += $_SESSION["comidas"][$i]->c17_00*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_estearico_c18_0"][$i] += $_SESSION["comidas"][$i]->estearico_c18_0*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_araquidi_c20_0"][$i] += $_SESSION["comidas"][$i]->araquidi_c20_0*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_behenico_c22_0"][$i] += $_SESSION["comidas"][$i]->behenico_c22_0*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_miristol_c14_1"][$i] += $_SESSION["comidas"][$i]->miristol_c14_1*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_palmitole_c16_1"][$i] += $_SESSION["comidas"][$i]->palmitole_c16_1*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_oleico_c18_1"][$i] += $_SESSION["comidas"][$i]->oleico_c18_1*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_eicoseno_c20_1"][$i] += $_SESSION["comidas"][$i]->eicoseno_c20_1*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_c22_1"][$i] += $_SESSION["comidas"][$i]->c22_1*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_linoleico_c18_2"][$i] += $_SESSION["comidas"][$i]->linoleico_c18_2*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_linoleni_c18_3"][$i] += $_SESSION["comidas"][$i]->linoleni_c18_3*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_c18_4"][$i] += $_SESSION["comidas"][$i]->c18_4*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_ara_ico_c20_4"][$i] += $_SESSION["comidas"][$i]->ara_ico_c20_4*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_c20_5"][$i] += $_SESSION["comidas"][$i]->c20_5*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_c22_5"][$i] += $_SESSION["comidas"][$i]->c22_5*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_c22_6"][$i] += $_SESSION["comidas"][$i]->c22_6*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_otrosatur0"][$i] += $_SESSION["comidas"][$i]->otrosatur0*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_otroinsat0"][$i] += $_SESSION["comidas"][$i]->otroinsat0*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_omega3_0"][$i] += $_SESSION["comidas"][$i]->omega3_0*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_etanol0"][$i] += $_SESSION["comidas"][$i]->etanol0*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_vit_a"][$i] += $_SESSION["comidas"][$i]->vit_a*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_carotenos"][$i] += $_SESSION["comidas"][$i]->carotenos*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_tocoferol"][$i] += $_SESSION["comidas"][$i]->tocoferol*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_vit_d"][$i] += $_SESSION["comidas"][$i]->vit_d*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_vit_b1"][$i] += $_SESSION["comidas"][$i]->vit_b1*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_vit_b2"][$i] += $_SESSION["comidas"][$i]->vit_b2*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_vit_b6"][$i] += $_SESSION["comidas"][$i]->vit_b6*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_niacina"][$i] += $_SESSION["comidas"][$i]->niacina*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_ac_panto"][$i] += $_SESSION["comidas"][$i]->ac_panto*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_biotina"][$i] += $_SESSION["comidas"][$i]->biotina*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_folico"][$i] += $_SESSION["comidas"][$i]->folico*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_b12"][$i] += $_SESSION["comidas"][$i]->b12*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_vit_c"][$i] += $_SESSION["comidas"][$i]->vit_c*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_purinas"][$i] += $_SESSION["comidas"][$i]->purinas*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_vit_k"][$i] += $_SESSION["comidas"][$i]->vit_k*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_vit_e"][$i] += $_SESSION["comidas"][$i]->vit_e*$_SESSION["comidas"][$i]->peso/100;
		$_SESSION["media_oxalico"][$i] += $_SESSION["comidas"][$i]->oxalico*$_SESSION["comidas"][$i]->peso/100;
		
        rellenaMatrices($_SESSION["comidas"][$i]->id_plato, $i, $semana);

		//echo " postres_comida ";
        if ($_SESSION["kcalorias_comida_postre"] != 0)
        {
        	$media_grasas += $_SESSION["postres_comida"][$i]->grasa;
	        $media_hidratos += $_SESSION["postres_comida"][$i]->hidratos;
	        $media_proteinas += $_SESSION["postres_comida"][$i]->proteinas;

			$_SESSION["media_pc_porcentaje"][$i] += $_SESSION["postres_comida"][$i]->pc_porcentaje*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_agua_g"][$i] += $_SESSION["postres_comida"][$i]->agua_g*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_cal_kcal"][$i] += $_SESSION["postres_comida"][$i]->cal_kcal*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_prot_g"][$i] += $_SESSION["postres_comida"][$i]->prot_g*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_hc_g"][$i] += $_SESSION["postres_comida"][$i]->hc_g*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_grasa_g"][$i] += $_SESSION["postres_comida"][$i]->grasa_g*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_satur_g"][$i] += $_SESSION["postres_comida"][$i]->satur_g*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_mono_g"][$i] += $_SESSION["postres_comida"][$i]->mono_g*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_poli_g"][$i] += $_SESSION["postres_comida"][$i]->poli_g*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_col_mg"][$i] += $_SESSION["postres_comida"][$i]->col_mg*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_fibra_g"][$i] += $_SESSION["postres_comida"][$i]->fibra_g*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_sodio_mg"][$i] += $_SESSION["postres_comida"][$i]->sodio_mg*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_potasio_mg"][$i] += $_SESSION["postres_comida"][$i]->potasio_mg*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_magnesio_mg"][$i] += $_SESSION["postres_comida"][$i]->magnesio_mg*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_calcio_mg"][$i] += $_SESSION["postres_comida"][$i]->calcio_mg*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_fosf_mg"][$i] += $_SESSION["postres_comida"][$i]->fosf_mg*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_hierro_mg"][$i] += $_SESSION["postres_comida"][$i]->hierro_mg*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_cloro_mg"][$i] += $_SESSION["postres_comida"][$i]->cloro_mg*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_cinc_mg"][$i] += $_SESSION["postres_comida"][$i]->cinc_mg*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_cobre_mg"][$i] += $_SESSION["postres_comida"][$i]->cobre_mg*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_manganeso_mg"][$i] += $_SESSION["postres_comida"][$i]->manganeso_mg*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_cromo_mg"][$i] += $_SESSION["postres_comida"][$i]->cromo_mg*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_cobalto_mg"][$i] += $_SESSION["postres_comida"][$i]->cobalto_mg*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_molibde_mg"][$i] += $_SESSION["postres_comida"][$i]->molibde_mg*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_yodo_mg"][$i] += $_SESSION["postres_comida"][$i]->yodo_mg*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_fluor_mg"][$i] += $_SESSION["postres_comida"][$i]->fluor_mg*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_butirico_c4_0"][$i] += $_SESSION["postres_comida"][$i]->butirico_c4_0*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_caproico_c6_0"][$i] += $_SESSION["postres_comida"][$i]->caproico_c6_0*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_caprilico_c8_0"][$i] += $_SESSION["postres_comida"][$i]->caprilico_c8_0*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_caprico_c10_0"][$i] += $_SESSION["postres_comida"][$i]->caprico_c10_0*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_laurico_c12_0"][$i] += $_SESSION["postres_comida"][$i]->laurico_c12_0*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_miristico_c14_0"][$i] += $_SESSION["postres_comida"][$i]->miristico_c14_0*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_c15_0"][$i] += $_SESSION["postres_comida"][$i]->c15_0*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_c15_00"][$i] += $_SESSION["postres_comida"][$i]->c15_00*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_palmitico_c16_0"][$i] += $_SESSION["postres_comida"][$i]->palmitico_c16_0*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_c17_0"][$i] += $_SESSION["postres_comida"][$i]->c17_0*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_c17_00"][$i] += $_SESSION["postres_comida"][$i]->c17_00*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_estearico_c18_0"][$i] += $_SESSION["postres_comida"][$i]->estearico_c18_0*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_araquidi_c20_0"][$i] += $_SESSION["postres_comida"][$i]->araquidi_c20_0*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_behenico_c22_0"][$i] += $_SESSION["postres_comida"][$i]->behenico_c22_0*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_miristol_c14_1"][$i] += $_SESSION["postres_comida"][$i]->miristol_c14_1*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_palmitole_c16_1"][$i] += $_SESSION["postres_comida"][$i]->palmitole_c16_1*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_oleico_c18_1"][$i] += $_SESSION["postres_comida"][$i]->oleico_c18_1*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_eicoseno_c20_1"][$i] += $_SESSION["postres_comida"][$i]->eicoseno_c20_1*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_c22_1"][$i] += $_SESSION["postres_comida"][$i]->c22_1*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_linoleico_c18_2"][$i] += $_SESSION["postres_comida"][$i]->linoleico_c18_2*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_linoleni_c18_3"][$i] += $_SESSION["postres_comida"][$i]->linoleni_c18_3*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_c18_4"][$i] += $_SESSION["postres_comida"][$i]->c18_4*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_ara_ico_c20_4"][$i] += $_SESSION["postres_comida"][$i]->ara_ico_c20_4*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_c20_5"][$i] += $_SESSION["postres_comida"][$i]->c20_5*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_c22_5"][$i] += $_SESSION["postres_comida"][$i]->c22_5*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_c22_6"][$i] += $_SESSION["postres_comida"][$i]->c22_6*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_otrosatur0"][$i] += $_SESSION["postres_comida"][$i]->otrosatur0*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_otroinsat0"][$i] += $_SESSION["postres_comida"][$i]->otroinsat0*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_omega3_0"][$i] += $_SESSION["postres_comida"][$i]->omega3_0*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_etanol0"][$i] += $_SESSION["postres_comida"][$i]->etanol0*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_vit_a"][$i] += $_SESSION["postres_comida"][$i]->vit_a*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_carotenos"][$i] += $_SESSION["postres_comida"][$i]->carotenos*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_tocoferol"][$i] += $_SESSION["postres_comida"][$i]->tocoferol*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_vit_d"][$i] += $_SESSION["postres_comida"][$i]->vit_d*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_vit_b1"][$i] += $_SESSION["postres_comida"][$i]->vit_b1*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_vit_b2"][$i] += $_SESSION["postres_comida"][$i]->vit_b2*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_vit_b6"][$i] += $_SESSION["postres_comida"][$i]->vit_b6*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_niacina"][$i] += $_SESSION["postres_comida"][$i]->niacina*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_ac_panto"][$i] += $_SESSION["postres_comida"][$i]->ac_panto*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_biotina"][$i] += $_SESSION["postres_comida"][$i]->biotina*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_folico"][$i] += $_SESSION["postres_comida"][$i]->folico*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_b12"][$i] += $_SESSION["postres_comida"][$i]->b12*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_vit_c"][$i] += $_SESSION["postres_comida"][$i]->vit_c*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_purinas"][$i] += $_SESSION["postres_comida"][$i]->purinas*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_vit_k"][$i] += $_SESSION["postres_comida"][$i]->vit_k*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_vit_e"][$i] += $_SESSION["postres_comida"][$i]->vit_e*$_SESSION["postres_comida"][$i]->peso/100;
			$_SESSION["media_oxalico"][$i] += $_SESSION["postres_comida"][$i]->oxalico*$_SESSION["postres_comida"][$i]->peso/100;

	        rellenaMatrices($_SESSION["postres_comida"][$i]->id_plato, $i, $semana);
        }

		//echo " meriendas ";
        if ($_SESSION["kcalorias_merienda"] != 0)
        {
        	$media_grasas += $_SESSION["meriendas"][$i]->grasa;
	        $media_hidratos += $_SESSION["meriendas"][$i]->hidratos;
	        $media_proteinas += $_SESSION["meriendas"][$i]->proteinas;
			
			$_SESSION["media_pc_porcentaje"][$i] += $_SESSION["meriendas"][$i]->pc_porcentaje*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_agua_g"][$i] += $_SESSION["meriendas"][$i]->agua_g*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_cal_kcal"][$i] += $_SESSION["meriendas"][$i]->cal_kcal*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_prot_g"][$i] += $_SESSION["meriendas"][$i]->prot_g*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_hc_g"][$i] += $_SESSION["meriendas"][$i]->hc_g*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_grasa_g"][$i] += $_SESSION["meriendas"][$i]->grasa_g*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_satur_g"][$i] += $_SESSION["meriendas"][$i]->satur_g*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_mono_g"][$i] += $_SESSION["meriendas"][$i]->mono_g*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_poli_g"][$i] += $_SESSION["meriendas"][$i]->poli_g*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_col_mg"][$i] += $_SESSION["meriendas"][$i]->col_mg*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_fibra_g"][$i] += $_SESSION["meriendas"][$i]->fibra_g*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_sodio_mg"][$i] += $_SESSION["meriendas"][$i]->sodio_mg*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_potasio_mg"][$i] += $_SESSION["meriendas"][$i]->potasio_mg*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_magnesio_mg"][$i] += $_SESSION["meriendas"][$i]->magnesio_mg*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_calcio_mg"][$i] += $_SESSION["meriendas"][$i]->calcio_mg*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_fosf_mg"][$i] += $_SESSION["meriendas"][$i]->fosf_mg*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_hierro_mg"][$i] += $_SESSION["meriendas"][$i]->hierro_mg*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_cloro_mg"][$i] += $_SESSION["meriendas"][$i]->cloro_mg*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_cinc_mg"][$i] += $_SESSION["meriendas"][$i]->cinc_mg*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_cobre_mg"][$i] += $_SESSION["meriendas"][$i]->cobre_mg*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_manganeso_mg"][$i] += $_SESSION["meriendas"][$i]->manganeso_mg*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_cromo_mg"][$i] += $_SESSION["meriendas"][$i]->cromo_mg*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_cobalto_mg"][$i] += $_SESSION["meriendas"][$i]->cobalto_mg*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_molibde_mg"][$i] += $_SESSION["meriendas"][$i]->molibde_mg*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_yodo_mg"][$i] += $_SESSION["meriendas"][$i]->yodo_mg*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_fluor_mg"][$i] += $_SESSION["meriendas"][$i]->fluor_mg*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_butirico_c4_0"][$i] += $_SESSION["meriendas"][$i]->butirico_c4_0*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_caproico_c6_0"][$i] += $_SESSION["meriendas"][$i]->caproico_c6_0*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_caprilico_c8_0"][$i] += $_SESSION["meriendas"][$i]->caprilico_c8_0*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_caprico_c10_0"][$i] += $_SESSION["meriendas"][$i]->caprico_c10_0*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_laurico_c12_0"][$i] += $_SESSION["meriendas"][$i]->laurico_c12_0*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_miristico_c14_0"][$i] += $_SESSION["meriendas"][$i]->miristico_c14_0*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_c15_0"][$i] += $_SESSION["meriendas"][$i]->c15_0*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_c15_00"][$i] += $_SESSION["meriendas"][$i]->c15_00*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_palmitico_c16_0"][$i] += $_SESSION["meriendas"][$i]->palmitico_c16_0*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_c17_0"][$i] += $_SESSION["meriendas"][$i]->c17_0*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_c17_00"][$i] += $_SESSION["meriendas"][$i]->c17_00*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_estearico_c18_0"][$i] += $_SESSION["meriendas"][$i]->estearico_c18_0*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_araquidi_c20_0"][$i] += $_SESSION["meriendas"][$i]->araquidi_c20_0*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_behenico_c22_0"][$i] += $_SESSION["meriendas"][$i]->behenico_c22_0*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_miristol_c14_1"][$i] += $_SESSION["meriendas"][$i]->miristol_c14_1*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_palmitole_c16_1"][$i] += $_SESSION["meriendas"][$i]->palmitole_c16_1*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_oleico_c18_1"][$i] += $_SESSION["meriendas"][$i]->oleico_c18_1*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_eicoseno_c20_1"][$i] += $_SESSION["meriendas"][$i]->eicoseno_c20_1*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_c22_1"][$i] += $_SESSION["meriendas"][$i]->c22_1*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_linoleico_c18_2"][$i] += $_SESSION["meriendas"][$i]->linoleico_c18_2*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_linoleni_c18_3"][$i] += $_SESSION["meriendas"][$i]->linoleni_c18_3*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_c18_4"][$i] += $_SESSION["meriendas"][$i]->c18_4*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_ara_ico_c20_4"][$i] += $_SESSION["meriendas"][$i]->ara_ico_c20_4*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_c20_5"][$i] += $_SESSION["meriendas"][$i]->c20_5*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_c22_5"][$i] += $_SESSION["meriendas"][$i]->c22_5*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_c22_6"][$i] += $_SESSION["meriendas"][$i]->c22_6*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_otrosatur0"][$i] += $_SESSION["meriendas"][$i]->otrosatur0*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_otroinsat0"][$i] += $_SESSION["meriendas"][$i]->otroinsat0*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_omega3_0"][$i] += $_SESSION["meriendas"][$i]->omega3_0*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_etanol0"][$i] += $_SESSION["meriendas"][$i]->etanol0*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_vit_a"][$i] += $_SESSION["meriendas"][$i]->vit_a*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_carotenos"][$i] += $_SESSION["meriendas"][$i]->carotenos*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_tocoferol"][$i] += $_SESSION["meriendas"][$i]->tocoferol*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_vit_d"][$i] += $_SESSION["meriendas"][$i]->vit_d*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_vit_b1"][$i] += $_SESSION["meriendas"][$i]->vit_b1*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_vit_b2"][$i] += $_SESSION["meriendas"][$i]->vit_b2*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_vit_b6"][$i] += $_SESSION["meriendas"][$i]->vit_b6*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_niacina"][$i] += $_SESSION["meriendas"][$i]->niacina*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_ac_panto"][$i] += $_SESSION["meriendas"][$i]->ac_panto*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_biotina"][$i] += $_SESSION["meriendas"][$i]->biotina*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_folico"][$i] += $_SESSION["meriendas"][$i]->folico*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_b12"][$i] += $_SESSION["meriendas"][$i]->b12*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_vit_c"][$i] += $_SESSION["meriendas"][$i]->vit_c*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_purinas"][$i] += $_SESSION["meriendas"][$i]->purinas*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_vit_k"][$i] += $_SESSION["meriendas"][$i]->vit_k*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_vit_e"][$i] += $_SESSION["meriendas"][$i]->vit_e*$_SESSION["meriendas"][$i]->peso/100;
			$_SESSION["media_oxalico"][$i] += $_SESSION["meriendas"][$i]->oxalico*$_SESSION["meriendas"][$i]->peso/100;

	        rellenaMatrices($_SESSION["meriendas"][$i]->id_plato, $i, $semana);
        }

		//echo " cenas1 ";
        if ($_SESSION["kcalorias_cena1"] != 0)
        {
        	$media_grasas += $_SESSION["cenas1"][$i]->grasa;
	        $media_hidratos += $_SESSION["cenas1"][$i]->hidratos;
	        $media_proteinas += $_SESSION["cenas1"][$i]->proteinas;

			$_SESSION["media_pc_porcentaje"][$i] += $_SESSION["cenas1"][$i]->pc_porcentaje*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_agua_g"][$i] += $_SESSION["cenas1"][$i]->agua_g*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_cal_kcal"][$i] += $_SESSION["cenas1"][$i]->cal_kcal*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_prot_g"][$i] += $_SESSION["cenas1"][$i]->prot_g*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_hc_g"][$i] += $_SESSION["cenas1"][$i]->hc_g*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_grasa_g"][$i] += $_SESSION["cenas1"][$i]->grasa_g*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_satur_g"][$i] += $_SESSION["cenas1"][$i]->satur_g*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_mono_g"][$i] += $_SESSION["cenas1"][$i]->mono_g*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_poli_g"][$i] += $_SESSION["cenas1"][$i]->poli_g*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_col_mg"][$i] += $_SESSION["cenas1"][$i]->col_mg*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_fibra_g"][$i] += $_SESSION["cenas1"][$i]->fibra_g*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_sodio_mg"][$i] += $_SESSION["cenas1"][$i]->sodio_mg*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_potasio_mg"][$i] += $_SESSION["cenas1"][$i]->potasio_mg*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_magnesio_mg"][$i] += $_SESSION["cenas1"][$i]->magnesio_mg*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_calcio_mg"][$i] += $_SESSION["cenas1"][$i]->calcio_mg*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_fosf_mg"][$i] += $_SESSION["cenas1"][$i]->fosf_mg*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_hierro_mg"][$i] += $_SESSION["cenas1"][$i]->hierro_mg*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_cloro_mg"][$i] += $_SESSION["cenas1"][$i]->cloro_mg*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_cinc_mg"][$i] += $_SESSION["cenas1"][$i]->cinc_mg*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_cobre_mg"][$i] += $_SESSION["cenas1"][$i]->cobre_mg*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_manganeso_mg"][$i] += $_SESSION["cenas1"][$i]->manganeso_mg*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_cromo_mg"][$i] += $_SESSION["cenas1"][$i]->cromo_mg*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_cobalto_mg"][$i] += $_SESSION["cenas1"][$i]->cobalto_mg*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_molibde_mg"][$i] += $_SESSION["cenas1"][$i]->molibde_mg*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_yodo_mg"][$i] += $_SESSION["cenas1"][$i]->yodo_mg*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_fluor_mg"][$i] += $_SESSION["cenas1"][$i]->fluor_mg*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_butirico_c4_0"][$i] += $_SESSION["cenas1"][$i]->butirico_c4_0*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_caproico_c6_0"][$i] += $_SESSION["cenas1"][$i]->caproico_c6_0*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_caprilico_c8_0"][$i] += $_SESSION["cenas1"][$i]->caprilico_c8_0*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_caprico_c10_0"][$i] += $_SESSION["cenas1"][$i]->caprico_c10_0*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_laurico_c12_0"][$i] += $_SESSION["cenas1"][$i]->laurico_c12_0*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_miristico_c14_0"][$i] += $_SESSION["cenas1"][$i]->miristico_c14_0*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_c15_0"][$i] += $_SESSION["cenas1"][$i]->c15_0*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_c15_00"][$i] += $_SESSION["cenas1"][$i]->c15_00*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_palmitico_c16_0"][$i] += $_SESSION["cenas1"][$i]->palmitico_c16_0*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_c17_0"][$i] += $_SESSION["cenas1"][$i]->c17_0*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_c17_00"][$i] += $_SESSION["cenas1"][$i]->c17_00*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_estearico_c18_0"][$i] += $_SESSION["cenas1"][$i]->estearico_c18_0*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_araquidi_c20_0"][$i] += $_SESSION["cenas1"][$i]->araquidi_c20_0*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_behenico_c22_0"][$i] += $_SESSION["cenas1"][$i]->behenico_c22_0*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_miristol_c14_1"][$i] += $_SESSION["cenas1"][$i]->miristol_c14_1*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_palmitole_c16_1"][$i] += $_SESSION["cenas1"][$i]->palmitole_c16_1*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_oleico_c18_1"][$i] += $_SESSION["cenas1"][$i]->oleico_c18_1*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_eicoseno_c20_1"][$i] += $_SESSION["cenas1"][$i]->eicoseno_c20_1*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_c22_1"][$i] += $_SESSION["cenas1"][$i]->c22_1*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_linoleico_c18_2"][$i] += $_SESSION["cenas1"][$i]->linoleico_c18_2*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_linoleni_c18_3"][$i] += $_SESSION["cenas1"][$i]->linoleni_c18_3*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_c18_4"][$i] += $_SESSION["cenas1"][$i]->c18_4*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_ara_ico_c20_4"][$i] += $_SESSION["cenas1"][$i]->ara_ico_c20_4*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_c20_5"][$i] += $_SESSION["cenas1"][$i]->c20_5*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_c22_5"][$i] += $_SESSION["cenas1"][$i]->c22_5*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_c22_6"][$i] += $_SESSION["cenas1"][$i]->c22_6*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_otrosatur0"][$i] += $_SESSION["cenas1"][$i]->otrosatur0*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_otroinsat0"][$i] += $_SESSION["cenas1"][$i]->otroinsat0*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_omega3_0"][$i] += $_SESSION["cenas1"][$i]->omega3_0*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_etanol0"][$i] += $_SESSION["cenas1"][$i]->etanol0*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_vit_a"][$i] += $_SESSION["cenas1"][$i]->vit_a*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_carotenos"][$i] += $_SESSION["cenas1"][$i]->carotenos*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_tocoferol"][$i] += $_SESSION["cenas1"][$i]->tocoferol*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_vit_d"][$i] += $_SESSION["cenas1"][$i]->vit_d*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_vit_b1"][$i] += $_SESSION["cenas1"][$i]->vit_b1*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_vit_b2"][$i] += $_SESSION["cenas1"][$i]->vit_b2*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_vit_b6"][$i] += $_SESSION["cenas1"][$i]->vit_b6*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_niacina"][$i] += $_SESSION["cenas1"][$i]->niacina*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_ac_panto"][$i] += $_SESSION["cenas1"][$i]->ac_panto*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_biotina"][$i] += $_SESSION["cenas1"][$i]->biotina*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_folico"][$i] += $_SESSION["cenas1"][$i]->folico*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_b12"][$i] += $_SESSION["cenas1"][$i]->b12*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_vit_c"][$i] += $_SESSION["cenas1"][$i]->vit_c*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_purinas"][$i] += $_SESSION["cenas1"][$i]->purinas*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_vit_k"][$i] += $_SESSION["cenas1"][$i]->vit_k*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_vit_e"][$i] += $_SESSION["cenas1"][$i]->vit_e*$_SESSION["cenas1"][$i]->peso/100;
			$_SESSION["media_oxalico"][$i] += $_SESSION["cenas1"][$i]->oxalico*$_SESSION["cenas1"][$i]->peso/100;

	        rellenaMatrices($_SESSION["cenas1"][$i]->id_plato, $i, $semana);
        }

		//echo " cenas ";
        $media_grasas += $_SESSION["cenas"][$i]->grasa;
        $media_hidratos += $_SESSION["cenas"][$i]->hidratos;
        $media_proteinas += $_SESSION["cenas"][$i]->proteinas;

		$_SESSION["media_pc_porcentaje"][$i] += $_SESSION["cenas"][$i]->pc_porcentaje*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_agua_g"][$i] += $_SESSION["cenas"][$i]->agua_g*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_cal_kcal"][$i] += $_SESSION["cenas"][$i]->cal_kcal*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_prot_g"][$i] += $_SESSION["cenas"][$i]->prot_g*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_hc_g"][$i] += $_SESSION["cenas"][$i]->hc_g*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_grasa_g"][$i] += $_SESSION["cenas"][$i]->grasa_g*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_satur_g"][$i] += $_SESSION["cenas"][$i]->satur_g*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_mono_g"][$i] += $_SESSION["cenas"][$i]->mono_g*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_poli_g"][$i] += $_SESSION["cenas"][$i]->poli_g*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_col_mg"][$i] += $_SESSION["cenas"][$i]->col_mg*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_fibra_g"][$i] += $_SESSION["cenas"][$i]->fibra_g*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_sodio_mg"][$i] += $_SESSION["cenas"][$i]->sodio_mg*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_potasio_mg"][$i] += $_SESSION["cenas"][$i]->potasio_mg*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_magnesio_mg"][$i] += $_SESSION["cenas"][$i]->magnesio_mg*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_calcio_mg"][$i] += $_SESSION["cenas"][$i]->calcio_mg*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_fosf_mg"][$i] += $_SESSION["cenas"][$i]->fosf_mg*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_hierro_mg"][$i] += $_SESSION["cenas"][$i]->hierro_mg*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_cloro_mg"][$i] += $_SESSION["cenas"][$i]->cloro_mg*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_cinc_mg"][$i] += $_SESSION["cenas"][$i]->cinc_mg*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_cobre_mg"][$i] += $_SESSION["cenas"][$i]->cobre_mg*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_manganeso_mg"][$i] += $_SESSION["cenas"][$i]->manganeso_mg*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_cromo_mg"][$i] += $_SESSION["cenas"][$i]->cromo_mg*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_cobalto_mg"][$i] += $_SESSION["cenas"][$i]->cobalto_mg*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_molibde_mg"][$i] += $_SESSION["cenas"][$i]->molibde_mg*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_yodo_mg"][$i] += $_SESSION["cenas"][$i]->yodo_mg*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_fluor_mg"][$i] += $_SESSION["cenas"][$i]->fluor_mg*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_butirico_c4_0"][$i] += $_SESSION["cenas"][$i]->butirico_c4_0*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_caproico_c6_0"][$i] += $_SESSION["cenas"][$i]->caproico_c6_0*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_caprilico_c8_0"][$i] += $_SESSION["cenas"][$i]->caprilico_c8_0*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_caprico_c10_0"][$i] += $_SESSION["cenas"][$i]->caprico_c10_0*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_laurico_c12_0"][$i] += $_SESSION["cenas"][$i]->laurico_c12_0*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_miristico_c14_0"][$i] += $_SESSION["cenas"][$i]->miristico_c14_0*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_c15_0"][$i] += $_SESSION["cenas"][$i]->c15_0*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_c15_00"][$i] += $_SESSION["cenas"][$i]->c15_00*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_palmitico_c16_0"][$i] += $_SESSION["cenas"][$i]->palmitico_c16_0*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_c17_0"][$i] += $_SESSION["cenas"][$i]->c17_0*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_c17_00"][$i] += $_SESSION["cenas"][$i]->c17_00*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_estearico_c18_0"][$i] += $_SESSION["cenas"][$i]->estearico_c18_0*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_araquidi_c20_0"][$i] += $_SESSION["cenas"][$i]->araquidi_c20_0*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_behenico_c22_0"][$i] += $_SESSION["cenas"][$i]->behenico_c22_0*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_miristol_c14_1"][$i] += $_SESSION["cenas"][$i]->miristol_c14_1*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_palmitole_c16_1"][$i] += $_SESSION["cenas"][$i]->palmitole_c16_1*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_oleico_c18_1"][$i] += $_SESSION["cenas"][$i]->oleico_c18_1*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_eicoseno_c20_1"][$i] += $_SESSION["cenas"][$i]->eicoseno_c20_1*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_c22_1"][$i] += $_SESSION["cenas"][$i]->c22_1*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_linoleico_c18_2"][$i] += $_SESSION["cenas"][$i]->linoleico_c18_2*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_linoleni_c18_3"][$i] += $_SESSION["cenas"][$i]->linoleni_c18_3*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_c18_4"][$i] += $_SESSION["cenas"][$i]->c18_4*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_ara_ico_c20_4"][$i] += $_SESSION["cenas"][$i]->ara_ico_c20_4*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_c20_5"][$i] += $_SESSION["cenas"][$i]->c20_5*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_c22_5"][$i] += $_SESSION["cenas"][$i]->c22_5*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_c22_6"][$i] += $_SESSION["cenas"][$i]->c22_6*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_otrosatur0"][$i] += $_SESSION["cenas"][$i]->otrosatur0*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_otroinsat0"][$i] += $_SESSION["cenas"][$i]->otroinsat0*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_omega3_0"][$i] += $_SESSION["cenas"][$i]->omega3_0*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_etanol0"][$i] += $_SESSION["cenas"][$i]->etanol0*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_vit_a"][$i] += $_SESSION["cenas"][$i]->vit_a*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_carotenos"][$i] += $_SESSION["cenas"][$i]->carotenos*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_tocoferol"][$i] += $_SESSION["cenas"][$i]->tocoferol*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_vit_d"][$i] += $_SESSION["cenas"][$i]->vit_d*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_vit_b1"][$i] += $_SESSION["cenas"][$i]->vit_b1*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_vit_b2"][$i] += $_SESSION["cenas"][$i]->vit_b2*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_vit_b6"][$i] += $_SESSION["cenas"][$i]->vit_b6*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_niacina"][$i] += $_SESSION["cenas"][$i]->niacina*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_ac_panto"][$i] += $_SESSION["cenas"][$i]->ac_panto*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_biotina"][$i] += $_SESSION["cenas"][$i]->biotina*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_folico"][$i] += $_SESSION["cenas"][$i]->folico*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_b12"][$i] += $_SESSION["cenas"][$i]->b12*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_vit_c"][$i] += $_SESSION["cenas"][$i]->vit_c*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_purinas"][$i] += $_SESSION["cenas"][$i]->purinas*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_vit_k"][$i] += $_SESSION["cenas"][$i]->vit_k*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_vit_e"][$i] += $_SESSION["cenas"][$i]->vit_e*$_SESSION["cenas"][$i]->peso/100;
		$_SESSION["media_oxalico"][$i] += $_SESSION["cenas"][$i]->oxalico*$_SESSION["cenas"][$i]->peso/100;

		rellenaMatrices($_SESSION["cenas"][$i]->id_plato, $i, $semana);

		//echo " postres_cena ";
        if ($_SESSION["kcalorias_cena_postre"] != 0)
        {
        	$media_grasas += $_SESSION["postres_cena"][$i]->grasa;
	        $media_hidratos += $_SESSION["postres_cena"][$i]->hidratos;
	        $media_proteinas += $_SESSION["postres_cena"][$i]->proteinas;

			$_SESSION["media_pc_porcentaje"][$i] += $_SESSION["postres_cena"][$i]->pc_porcentaje*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_agua_g"][$i] += $_SESSION["postres_cena"][$i]->agua_g*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_cal_kcal"][$i] += $_SESSION["postres_cena"][$i]->cal_kcal*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_prot_g"][$i] += $_SESSION["postres_cena"][$i]->prot_g*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_hc_g"][$i] += $_SESSION["postres_cena"][$i]->hc_g*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_grasa_g"][$i] += $_SESSION["postres_cena"][$i]->grasa_g*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_satur_g"][$i] += $_SESSION["postres_cena"][$i]->satur_g*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_mono_g"][$i] += $_SESSION["postres_cena"][$i]->mono_g*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_poli_g"][$i] += $_SESSION["postres_cena"][$i]->poli_g*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_col_mg"][$i] += $_SESSION["postres_cena"][$i]->col_mg*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_fibra_g"][$i] += $_SESSION["postres_cena"][$i]->fibra_g*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_sodio_mg"][$i] += $_SESSION["postres_cena"][$i]->sodio_mg*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_potasio_mg"][$i] += $_SESSION["postres_cena"][$i]->potasio_mg*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_magnesio_mg"][$i] += $_SESSION["postres_cena"][$i]->magnesio_mg*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_calcio_mg"][$i] += $_SESSION["postres_cena"][$i]->calcio_mg*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_fosf_mg"][$i] += $_SESSION["postres_cena"][$i]->fosf_mg*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_hierro_mg"][$i] += $_SESSION["postres_cena"][$i]->hierro_mg*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_cloro_mg"][$i] += $_SESSION["postres_cena"][$i]->cloro_mg*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_cinc_mg"][$i] += $_SESSION["postres_cena"][$i]->cinc_mg*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_cobre_mg"][$i] += $_SESSION["postres_cena"][$i]->cobre_mg*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_manganeso_mg"][$i] += $_SESSION["postres_cena"][$i]->manganeso_mg*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_cromo_mg"][$i] += $_SESSION["postres_cena"][$i]->cromo_mg*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_cobalto_mg"][$i] += $_SESSION["postres_cena"][$i]->cobalto_mg*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_molibde_mg"][$i] += $_SESSION["postres_cena"][$i]->molibde_mg*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_yodo_mg"][$i] += $_SESSION["postres_cena"][$i]->yodo_mg*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_fluor_mg"][$i] += $_SESSION["postres_cena"][$i]->fluor_mg*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_butirico_c4_0"][$i] += $_SESSION["postres_cena"][$i]->butirico_c4_0*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_caproico_c6_0"][$i] += $_SESSION["postres_cena"][$i]->caproico_c6_0*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_caprilico_c8_0"][$i] += $_SESSION["postres_cena"][$i]->caprilico_c8_0*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_caprico_c10_0"][$i] += $_SESSION["postres_cena"][$i]->caprico_c10_0*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_laurico_c12_0"][$i] += $_SESSION["postres_cena"][$i]->laurico_c12_0*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_miristico_c14_0"][$i] += $_SESSION["postres_cena"][$i]->miristico_c14_0*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_c15_0"][$i] += $_SESSION["postres_cena"][$i]->c15_0*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_c15_00"][$i] += $_SESSION["postres_cena"][$i]->c15_00*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_palmitico_c16_0"][$i] += $_SESSION["postres_cena"][$i]->palmitico_c16_0*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_c17_0"][$i] += $_SESSION["postres_cena"][$i]->c17_0*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_c17_00"][$i] += $_SESSION["postres_cena"][$i]->c17_00*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_estearico_c18_0"][$i] += $_SESSION["postres_cena"][$i]->estearico_c18_0*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_araquidi_c20_0"][$i] += $_SESSION["postres_cena"][$i]->araquidi_c20_0*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_behenico_c22_0"][$i] += $_SESSION["postres_cena"][$i]->behenico_c22_0*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_miristol_c14_1"][$i] += $_SESSION["postres_cena"][$i]->miristol_c14_1*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_palmitole_c16_1"][$i] += $_SESSION["postres_cena"][$i]->palmitole_c16_1*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_oleico_c18_1"][$i] += $_SESSION["postres_cena"][$i]->oleico_c18_1*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_eicoseno_c20_1"][$i] += $_SESSION["postres_cena"][$i]->eicoseno_c20_1*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_c22_1"][$i] += $_SESSION["postres_cena"][$i]->c22_1*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_linoleico_c18_2"][$i] += $_SESSION["postres_cena"][$i]->linoleico_c18_2*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_linoleni_c18_3"][$i] += $_SESSION["postres_cena"][$i]->linoleni_c18_3*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_c18_4"][$i] += $_SESSION["postres_cena"][$i]->c18_4*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_ara_ico_c20_4"][$i] += $_SESSION["postres_cena"][$i]->ara_ico_c20_4*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_c20_5"][$i] += $_SESSION["postres_cena"][$i]->c20_5*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_c22_5"][$i] += $_SESSION["postres_cena"][$i]->c22_5*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_c22_6"][$i] += $_SESSION["postres_cena"][$i]->c22_6*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_otrosatur0"][$i] += $_SESSION["postres_cena"][$i]->otrosatur0*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_otroinsat0"][$i] += $_SESSION["postres_cena"][$i]->otroinsat0*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_omega3_0"][$i] += $_SESSION["postres_cena"][$i]->omega3_0*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_etanol0"][$i] += $_SESSION["postres_cena"][$i]->etanol0*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_vit_a"][$i] += $_SESSION["postres_cena"][$i]->vit_a*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_carotenos"][$i] += $_SESSION["postres_cena"][$i]->carotenos*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_tocoferol"][$i] += $_SESSION["postres_cena"][$i]->tocoferol*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_vit_d"][$i] += $_SESSION["postres_cena"][$i]->vit_d*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_vit_b1"][$i] += $_SESSION["postres_cena"][$i]->vit_b1*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_vit_b2"][$i] += $_SESSION["postres_cena"][$i]->vit_b2*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_vit_b6"][$i] += $_SESSION["postres_cena"][$i]->vit_b6*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_niacina"][$i] += $_SESSION["postres_cena"][$i]->niacina*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_ac_panto"][$i] += $_SESSION["postres_cena"][$i]->ac_panto*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_biotina"][$i] += $_SESSION["postres_cena"][$i]->biotina*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_folico"][$i] += $_SESSION["postres_cena"][$i]->folico*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_b12"][$i] += $_SESSION["postres_cena"][$i]->b12*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_vit_c"][$i] += $_SESSION["postres_cena"][$i]->vit_c*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_purinas"][$i] += $_SESSION["postres_cena"][$i]->purinas*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_vit_k"][$i] += $_SESSION["postres_cena"][$i]->vit_k*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_vit_e"][$i] += $_SESSION["postres_cena"][$i]->vit_e*$_SESSION["postres_cena"][$i]->peso/100;
			$_SESSION["media_oxalico"][$i] += $_SESSION["postres_cena"][$i]->oxalico*$_SESSION["postres_cena"][$i]->peso/100;

	        rellenaMatrices($_SESSION["postres_cena"][$i]->id_plato, $i, $semana);
        }

		//echo " recenas ";
        if ($_SESSION["kcalorias_recena"] != 0)
        {
        	$media_grasas += $_SESSION["recenas"][$i]->grasa;
	        $media_hidratos += $_SESSION["recenas"][$i]->hidratos;
	        $media_proteinas += $_SESSION["recenas"][$i]->proteinas;

			$_SESSION["media_pc_porcentaje"][$i] += $_SESSION["recenas"][$i]->pc_porcentaje*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_agua_g"][$i] += $_SESSION["recenas"][$i]->agua_g*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_cal_kcal"][$i] += $_SESSION["recenas"][$i]->cal_kcal*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_prot_g"][$i] += $_SESSION["recenas"][$i]->prot_g*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_hc_g"][$i] += $_SESSION["recenas"][$i]->hc_g*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_grasa_g"][$i] += $_SESSION["recenas"][$i]->grasa_g*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_satur_g"][$i] += $_SESSION["recenas"][$i]->satur_g*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_mono_g"][$i] += $_SESSION["recenas"][$i]->mono_g*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_poli_g"][$i] += $_SESSION["recenas"][$i]->poli_g*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_col_mg"][$i] += $_SESSION["recenas"][$i]->col_mg*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_fibra_g"][$i] += $_SESSION["recenas"][$i]->fibra_g*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_sodio_mg"][$i] += $_SESSION["recenas"][$i]->sodio_mg*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_potasio_mg"][$i] += $_SESSION["recenas"][$i]->potasio_mg*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_magnesio_mg"][$i] += $_SESSION["recenas"][$i]->magnesio_mg*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_calcio_mg"][$i] += $_SESSION["recenas"][$i]->calcio_mg*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_fosf_mg"][$i] += $_SESSION["recenas"][$i]->fosf_mg*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_hierro_mg"][$i] += $_SESSION["recenas"][$i]->hierro_mg*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_cloro_mg"][$i] += $_SESSION["recenas"][$i]->cloro_mg*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_cinc_mg"][$i] += $_SESSION["recenas"][$i]->cinc_mg*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_cobre_mg"][$i] += $_SESSION["recenas"][$i]->cobre_mg*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_manganeso_mg"][$i] += $_SESSION["recenas"][$i]->manganeso_mg*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_cromo_mg"][$i] += $_SESSION["recenas"][$i]->cromo_mg*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_cobalto_mg"][$i] += $_SESSION["recenas"][$i]->cobalto_mg*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_molibde_mg"][$i] += $_SESSION["recenas"][$i]->molibde_mg*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_yodo_mg"][$i] += $_SESSION["recenas"][$i]->yodo_mg*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_fluor_mg"][$i] += $_SESSION["recenas"][$i]->fluor_mg*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_butirico_c4_0"][$i] += $_SESSION["recenas"][$i]->butirico_c4_0*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_caproico_c6_0"][$i] += $_SESSION["recenas"][$i]->caproico_c6_0*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_caprilico_c8_0"][$i] += $_SESSION["recenas"][$i]->caprilico_c8_0*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_caprico_c10_0"][$i] += $_SESSION["recenas"][$i]->caprico_c10_0*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_laurico_c12_0"][$i] += $_SESSION["recenas"][$i]->laurico_c12_0*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_miristico_c14_0"][$i] += $_SESSION["recenas"][$i]->miristico_c14_0*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_c15_0"][$i] += $_SESSION["recenas"][$i]->c15_0*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_c15_00"][$i] += $_SESSION["recenas"][$i]->c15_00*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_palmitico_c16_0"][$i] += $_SESSION["recenas"][$i]->palmitico_c16_0*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_c17_0"][$i] += $_SESSION["recenas"][$i]->c17_0*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_c17_00"][$i] += $_SESSION["recenas"][$i]->c17_00*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_estearico_c18_0"][$i] += $_SESSION["recenas"][$i]->estearico_c18_0*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_araquidi_c20_0"][$i] += $_SESSION["recenas"][$i]->araquidi_c20_0*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_behenico_c22_0"][$i] += $_SESSION["recenas"][$i]->behenico_c22_0*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_miristol_c14_1"][$i] += $_SESSION["recenas"][$i]->miristol_c14_1*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_palmitole_c16_1"][$i] += $_SESSION["recenas"][$i]->palmitole_c16_1*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_oleico_c18_1"][$i] += $_SESSION["recenas"][$i]->oleico_c18_1*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_eicoseno_c20_1"][$i] += $_SESSION["recenas"][$i]->eicoseno_c20_1*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_c22_1"][$i] += $_SESSION["recenas"][$i]->c22_1*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_linoleico_c18_2"][$i] += $_SESSION["recenas"][$i]->linoleico_c18_2*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_linoleni_c18_3"][$i] += $_SESSION["recenas"][$i]->linoleni_c18_3*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_c18_4"][$i] += $_SESSION["recenas"][$i]->c18_4*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_ara_ico_c20_4"][$i] += $_SESSION["recenas"][$i]->ara_ico_c20_4*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_c20_5"][$i] += $_SESSION["recenas"][$i]->c20_5*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_c22_5"][$i] += $_SESSION["recenas"][$i]->c22_5*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_c22_6"][$i] += $_SESSION["recenas"][$i]->c22_6*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_otrosatur0"][$i] += $_SESSION["recenas"][$i]->otrosatur0*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_otroinsat0"][$i] += $_SESSION["recenas"][$i]->otroinsat0*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_omega3_0"][$i] += $_SESSION["recenas"][$i]->omega3_0*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_etanol0"][$i] += $_SESSION["recenas"][$i]->etanol0*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_vit_a"][$i] += $_SESSION["recenas"][$i]->vit_a*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_carotenos"][$i] += $_SESSION["recenas"][$i]->carotenos*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_tocoferol"][$i] += $_SESSION["recenas"][$i]->tocoferol*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_vit_d"][$i] += $_SESSION["recenas"][$i]->vit_d*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_vit_b1"][$i] += $_SESSION["recenas"][$i]->vit_b1*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_vit_b2"][$i] += $_SESSION["recenas"][$i]->vit_b2*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_vit_b6"][$i] += $_SESSION["recenas"][$i]->vit_b6*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_niacina"][$i] += $_SESSION["recenas"][$i]->niacina*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_ac_panto"][$i] += $_SESSION["recenas"][$i]->ac_panto*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_biotina"][$i] += $_SESSION["recenas"][$i]->biotina*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_folico"][$i] += $_SESSION["recenas"][$i]->folico*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_b12"][$i] += $_SESSION["recenas"][$i]->b12*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_vit_c"][$i] += $_SESSION["recenas"][$i]->vit_c*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_purinas"][$i] += $_SESSION["recenas"][$i]->purinas*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_vit_k"][$i] += $_SESSION["recenas"][$i]->vit_k*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_vit_e"][$i] += $_SESSION["recenas"][$i]->vit_e*$_SESSION["recenas"][$i]->peso/100;
			$_SESSION["media_oxalico"][$i] += $_SESSION["recenas"][$i]->oxalico*$_SESSION["recenas"][$i]->peso/100;
			
	        rellenaMatrices($_SESSION["recenas"][$i]->id_plato, $i, $semana);
        }

        $media_calorias += $_SESSION["suma_kcal"][$i];
		
		$j = $_SESSION["num_dias"];
		$_SESSION["media_pc_porcentaje"][$j] += $_SESSION["media_pc_porcentaje"][$i];
		$_SESSION["media_agua_g"][$j] += $_SESSION["media_agua_g"][$i];
		$_SESSION["media_cal_kcal"][$j] += $_SESSION["media_cal_kcal"][$i];
		$_SESSION["media_prot_g"][$j] += $_SESSION["media_prot_g"][$i];
		$_SESSION["media_hc_g"][$j] += $_SESSION["media_hc_g"][$i];
		$_SESSION["media_grasa_g"][$j] += $_SESSION["media_grasa_g"][$i];
		$_SESSION["media_satur_g"][$j] += $_SESSION["media_satur_g"][$i];
		$_SESSION["media_mono_g"][$j] += $_SESSION["media_mono_g"][$i];
		$_SESSION["media_poli_g"][$j] += $_SESSION["media_poli_g"][$i];
		$_SESSION["media_col_mg"][$j] += $_SESSION["media_col_mg"][$i];
		$_SESSION["media_fibra_g"][$j] += $_SESSION["media_fibra_g"][$i];
		$_SESSION["media_sodio_mg"][$j] += $_SESSION["media_sodio_mg"][$i];
		$_SESSION["media_potasio_mg"][$j] += $_SESSION["media_potasio_mg"][$i];
		$_SESSION["media_magnesio_mg"][$j] += $_SESSION["media_magnesio_mg"][$i];
		$_SESSION["media_calcio_mg"][$j] += $_SESSION["media_calcio_mg"][$i];
		$_SESSION["media_fosf_mg"][$j] += $_SESSION["media_fosf_mg"][$i];
		$_SESSION["media_hierro_mg"][$j] += $_SESSION["media_hierro_mg"][$i];
		$_SESSION["media_cloro_mg"][$j] += $_SESSION["media_cloro_mg"][$i];
		$_SESSION["media_cinc_mg"][$j] += $_SESSION["media_cinc_mg"][$i];
		$_SESSION["media_cobre_mg"][$j] += $_SESSION["media_cobre_mg"][$i];
		$_SESSION["media_manganeso_mg"][$j] += $_SESSION["media_manganeso_mg"][$i];
		$_SESSION["media_cromo_mg"][$j] += $_SESSION["media_cromo_mg"][$i];
		$_SESSION["media_cobalto_mg"][$j] += $_SESSION["media_cobalto_mg"][$i];
		$_SESSION["media_molibde_mg"][$j] += $_SESSION["media_molibde_mg"][$i];
		$_SESSION["media_yodo_mg"][$j] += $_SESSION["media_yodo_mg"][$i];
		$_SESSION["media_fluor_mg"][$j] += $_SESSION["media_fluor_mg"][$i];
		$_SESSION["media_butirico_c4_0"][$j] += $_SESSION["media_butirico_c4_0"][$i];
		$_SESSION["media_caproico_c6_0"][$j] += $_SESSION["media_caproico_c6_0"][$i];
		$_SESSION["media_caprilico_c8_0"][$j] += $_SESSION["media_caprilico_c8_0"][$i];
		$_SESSION["media_caprico_c10_0"][$j] += $_SESSION["media_caprico_c10_0"][$i];
		$_SESSION["media_laurico_c12_0"][$j] += $_SESSION["media_laurico_c12_0"][$i];
		$_SESSION["media_miristico_c14_0"][$j] += $_SESSION["media_miristico_c14_0"][$i];
		$_SESSION["media_c15_0"][$j] += $_SESSION["media_c15_0"][$i];
		$_SESSION["media_c15_00"][$j] += $_SESSION["media_c15_00"][$i];
		$_SESSION["media_palmitico_c16_0"][$j] += $_SESSION["media_palmitico_c16_0"][$i];
		$_SESSION["media_c17_0"][$j] += $_SESSION["media_c17_0"][$i];
		$_SESSION["media_c17_00"][$j] += $_SESSION["media_c17_00"][$i];
		$_SESSION["media_estearico_c18_0"][$j] += $_SESSION["media_estearico_c18_0"][$i];
		$_SESSION["media_araquidi_c20_0"][$j] += $_SESSION["media_araquidi_c20_0"][$i];
		$_SESSION["media_behenico_c22_0"][$j] += $_SESSION["media_behenico_c22_0"][$i];
		$_SESSION["media_miristol_c14_1"][$j] += $_SESSION["media_miristol_c14_1"][$i];
		$_SESSION["media_palmitole_c16_1"][$j] += $_SESSION["media_palmitole_c16_1"][$i];
		$_SESSION["media_oleico_c18_1"][$j] += $_SESSION["media_oleico_c18_1"][$i];
		$_SESSION["media_eicoseno_c20_1"][$j] += $_SESSION["media_eicoseno_c20_1"][$i];
		$_SESSION["media_c22_1"][$j] += $_SESSION["media_c22_1"][$i];
		$_SESSION["media_linoleico_c18_2"][$j] += $_SESSION["media_linoleico_c18_2"][$i];
		$_SESSION["media_linoleni_c18_3"][$j] += $_SESSION["media_linoleni_c18_3"][$i];
		$_SESSION["media_c18_4"][$j] += $_SESSION["media_c18_4"][$i];
		$_SESSION["media_ara_ico_c20_4"][$j] += $_SESSION["media_ara_ico_c20_4"][$i];
		$_SESSION["media_c20_5"][$j] += $_SESSION["media_c20_5"][$i];
		$_SESSION["media_c22_5"][$j] += $_SESSION["media_c22_5"][$i];
		$_SESSION["media_c22_6"][$j] += $_SESSION["media_c22_6"][$i];
		$_SESSION["media_otrosatur0"][$j] += $_SESSION["media_otrosatur0"][$i];
		$_SESSION["media_otroinsat0"][$j] += $_SESSION["media_otroinsat0"][$i];
		$_SESSION["media_omega3_0"][$j] += $_SESSION["media_omega3_0"][$i];
		$_SESSION["media_etanol0"][$j] += $_SESSION["media_etanol0"][$i];
		$_SESSION["media_vit_a"][$j] += $_SESSION["media_vit_a"][$i];
		$_SESSION["media_carotenos"][$j] += $_SESSION["media_carotenos"][$i];
		$_SESSION["media_tocoferol"][$j] += $_SESSION["media_tocoferol"][$i];
		$_SESSION["media_vit_d"][$j] += $_SESSION["media_vit_d"][$i];
		$_SESSION["media_vit_b1"][$j] += $_SESSION["media_vit_b1"][$i];
		$_SESSION["media_vit_b2"][$j] += $_SESSION["media_vit_b2"][$i];
		$_SESSION["media_vit_b6"][$j] += $_SESSION["media_vit_b6"][$i];
		$_SESSION["media_niacina"][$j] += $_SESSION["media_niacina"][$i];
		$_SESSION["media_ac_panto"][$j] += $_SESSION["media_ac_panto"][$i];
		$_SESSION["media_biotina"][$j] += $_SESSION["media_biotina"][$i];
		$_SESSION["media_folico"][$j] += $_SESSION["media_folico"][$i];
		$_SESSION["media_b12"][$j] += $_SESSION["media_b12"][$i];
		$_SESSION["media_vit_c"][$j] += $_SESSION["media_vit_c"][$i];
		$_SESSION["media_purinas"][$j] += $_SESSION["media_purinas"][$i];
		$_SESSION["media_vit_k"][$j] += $_SESSION["media_vit_k"][$i];
		$_SESSION["media_vit_e"][$j] += $_SESSION["media_vit_e"][$i];
		$_SESSION["media_oxalico"][$j] += $_SESSION["media_oxalico"][$i];
    }

    // Calculamos las estadisticas con Comidas y Cenas
    $media_proteinas = round($media_proteinas / ($_SESSION["num_dias"] * $platos_porDia), 1);
    $media_hidratos = round($media_hidratos / ($_SESSION["num_dias"] * $platos_porDia), 1);
    $media_grasas = round($media_grasas / ($_SESSION["num_dias"] * $platos_porDia), 1);
    $media_calorias = round($media_calorias / $_SESSION["num_dias"], 1);

	/*$media_pc_porcentaje = round($media_pc_porcentaje / ($_SESSION["num_dias"] * 1), 1);
	$media_agua_g = round($media_agua_g / ($_SESSION["num_dias"] * 1), 1);
	$media_cal_kcal = round($media_cal_kcal / ($_SESSION["num_dias"] * 1), 1);
	$media_prot_g = round($media_prot_g / ($_SESSION["num_dias"] * 1), 1);
	$media_hc_g = round($media_hc_g / ($_SESSION["num_dias"] * 1), 1);
	$media_grasa_g = round($media_grasa_g / ($_SESSION["num_dias"] * 1), 1);
	$media_satur_g = round($media_satur_g / ($_SESSION["num_dias"] * 1), 1);
	$media_mono_g = round($media_mono_g / ($_SESSION["num_dias"] * 1), 1);
	$media_poli_g = round($media_poli_g / ($_SESSION["num_dias"] * 1), 1);
	$media_col_mg = round($media_col_mg / ($_SESSION["num_dias"] * 1), 1);
	$media_fibra_g = round($media_fibra_g / ($_SESSION["num_dias"] * 1), 1);
	$media_sodio_mg = round($media_sodio_mg / ($_SESSION["num_dias"] * 1), 1);
	$media_potasio_mg = round($media_potasio_mg / ($_SESSION["num_dias"] * 1), 1);
	$media_magnesio_mg = round($media_magnesio_mg / ($_SESSION["num_dias"] * 1), 1);
	$media_calcio_mg = round($media_calcio_mg / ($_SESSION["num_dias"] * 1), 1);
	$media_fosf_mg = round($media_fosf_mg / ($_SESSION["num_dias"] * 1), 1);
	$media_hierro_mg = round($media_hierro_mg / ($_SESSION["num_dias"] * 1), 1);
	$media_cloro_mg = round($media_cloro_mg / ($_SESSION["num_dias"] * 1), 1);
	$media_cinc_mg = round($media_cinc_mg / ($_SESSION["num_dias"] * 1), 1);
	$media_cobre_mg = round($media_cobre_mg / ($_SESSION["num_dias"] * 1), 1);
	$media_manganeso_mg = round($media_manganeso_mg / ($_SESSION["num_dias"] * 1), 1);
	$media_cromo_mg = round($media_cromo_mg / ($_SESSION["num_dias"] * 1), 1);
	$media_cobalto_mg = round($media_cobalto_mg / ($_SESSION["num_dias"] * 1), 1);
	$media_molibde_mg = round($media_molibde_mg / ($_SESSION["num_dias"] * 1), 1);
	$media_yodo_mg = round($media_yodo_mg / ($_SESSION["num_dias"] * 1), 1);
	$media_fluor_mg = round($media_fluor_mg / ($_SESSION["num_dias"] * 1), 1);
	$media_butirico_c4_0 = round($media_butirico_c4_0 / ($_SESSION["num_dias"] * 1), 1);
	$media_caproico_c6_0 = round($media_caproico_c6_0 / ($_SESSION["num_dias"] * 1), 1);
	$media_caprilico_c8_0 = round($media_caprilico_c8_0 / ($_SESSION["num_dias"] * 1), 1);
	$media_caprico_c10_0 = round($media_caprico_c10_0 / ($_SESSION["num_dias"] * 1), 1);
	$media_laurico_c12_0 = round($media_laurico_c12_0 / ($_SESSION["num_dias"] * 1), 1);
	$media_miristico_c14_0 = round($media_miristico_c14_0 / ($_SESSION["num_dias"] * 1), 1);
	$media_c15_0 = round($media_c15_0 / ($_SESSION["num_dias"] * 1), 1);
	$media_c15_00 = round($media_c15_00 / ($_SESSION["num_dias"] * 1), 1);
	$media_palmitico_c16_0 = round($media_palmitico_c16_0 / ($_SESSION["num_dias"] * 1), 1);
	$media_c17_0 = round($media_c17_0 / ($_SESSION["num_dias"] * 1), 1);
	$media_c17_00 = round($media_c17_00 / ($_SESSION["num_dias"] * 1), 1);
	$media_estearico_c18_0 = round($media_estearico_c18_0 / ($_SESSION["num_dias"] * 1), 1);
	$media_araquidi_c20_0 = round($media_araquidi_c20_0 / ($_SESSION["num_dias"] * 1), 1);
	$media_behenico_c22_0 = round($media_behenico_c22_0 / ($_SESSION["num_dias"] * 1), 1);
	$media_miristol_c14_1 = round($media_miristol_c14_1 / ($_SESSION["num_dias"] * 1), 1);
	$media_palmitole_c16_1 = round($media_palmitole_c16_1 / ($_SESSION["num_dias"] * 1), 1);
	$media_oleico_c18_1 = round($media_oleico_c18_1 / ($_SESSION["num_dias"] * 1), 1);
	$media_eicoseno_c20_1 = round($media_eicoseno_c20_1 / ($_SESSION["num_dias"] * 1), 1);
	$media_c22_1 = round($media_c22_1 / ($_SESSION["num_dias"] * 1), 1);
	$media_linoleico_c18_2 = round($media_linoleico_c18_2 / ($_SESSION["num_dias"] * 1), 1);
	$media_linoleni_c18_3 = round($media_linoleni_c18_3 / ($_SESSION["num_dias"] * 1), 1);
	$media_c18_4 = round($media_c18_4 / ($_SESSION["num_dias"] * 1), 1);
	$media_ara_ico_c20_4 = round($media_ara_ico_c20_4 / ($_SESSION["num_dias"] * 1), 1);
	$media_c20_5 = round($media_c20_5 / ($_SESSION["num_dias"] * 1), 1);
	$media_c22_5 = round($media_c22_5 / ($_SESSION["num_dias"] * 1), 1);
	$media_c22_6 = round($media_c22_6 / ($_SESSION["num_dias"] * 1), 1);
	$media_otrosatur0 = round($media_otrosatur0 / ($_SESSION["num_dias"] * 1), 1);
	$media_otroinsat0 = round($media_otroinsat0 / ($_SESSION["num_dias"] * 1), 1);
	$media_omega3_0 = round($media_omega3_0 / ($_SESSION["num_dias"] * 1), 1);
	$media_etanol0 = round($media_etanol0 / ($_SESSION["num_dias"] * 1), 1);
	$media_vit_a = round($media_vit_a / ($_SESSION["num_dias"] * 1), 1);
	$media_carotenos = round($media_carotenos / ($_SESSION["num_dias"] * 1), 1);
	$media_tocoferol = round($media_tocoferol / ($_SESSION["num_dias"] * 1), 1);
	$media_vit_d = round($media_vit_d / ($_SESSION["num_dias"] * 1), 1);
	$media_vit_b1 = round($media_vit_b1 / ($_SESSION["num_dias"] * 1), 1);
	$media_vit_b2 = round($media_vit_b2 / ($_SESSION["num_dias"] * 1), 1);
	$media_vit_b6 = round($media_vit_b6 / ($_SESSION["num_dias"] * 1), 1);
	$media_niacina = round($media_niacina / ($_SESSION["num_dias"] * 1), 1);
	$media_ac_panto = round($media_ac_panto / ($_SESSION["num_dias"] * 1), 1);
	$media_biotina = round($media_biotina / ($_SESSION["num_dias"] * 1), 1);
	$media_folico = round($media_folico / ($_SESSION["num_dias"] * 1), 1);
	$media_b12 = round($media_b12 / ($_SESSION["num_dias"] * 1), 1);
	$media_vit_c = round($media_vit_c / ($_SESSION["num_dias"] * 1), 1);
	$media_purinas = round($media_purinas / ($_SESSION["num_dias"] * 1), 1);
	$media_vit_k = round($media_vit_k / ($_SESSION["num_dias"] * 1), 1);
	$media_vit_e = round($media_vit_e / ($_SESSION["num_dias"] * 1), 1);
	$media_oxalico = round($media_oxalico / ($_SESSION["num_dias"] * 1), 1);*/

    $acierto_grasas = (100 - abs($media_grasas - $_SESSION["porcentaje_grasas"]));
    $acierto_proteinas = (100 - abs($media_proteinas - $_SESSION["porcentaje_proteinas"]));
    $acierto_hidratos = (100 - abs($media_hidratos - $_SESSION["porcentaje_hidratos"]));
    $acierto_calorias = round(100 - ((abs($media_calorias - $_SESSION["kcalorias"]) / $_SESSION["kcalorias"] ) * 100), 1);

	// $_SESSION["labelAciertoProteinas"] = $acierto_proteinas . " %";
    // $_SESSION["labelAciertoHidratos"] = $acierto_hidratos . " %";
    // $_SESSION["labelAciertoGrasas"] = $acierto_grasas . " %";
    // $_SESSION["labelAciertoCalorias"] = $acierto_calorias . " %";
    // $_SESSION["labelAciertoGeneral"] = round( ($acierto_calorias + $acierto_grasas + $acierto_hidratos + $acierto_proteinas) / 4) . " %";

	$_SESSION["labelAciertoProteinas"] = $media_proteinas . "% (". $acierto_proteinas . "% acierto)";
    $_SESSION["labelAciertoHidratos"] = $media_hidratos . "% (". $acierto_hidratos . "% acierto)"; 
    $_SESSION["labelAciertoGrasas"] = $media_grasas . "% (". $acierto_grasas . "% acierto)";
    $_SESSION["labelAciertoCalorias"] = $media_calorias . " (". $acierto_calorias . "% acierto)";
    $_SESSION["labelAciertoGeneral"] = round( ($acierto_calorias + $acierto_grasas + $acierto_hidratos + $acierto_proteinas) / 4) . " %";
    
	/*$_SESSION["media_pc_porcentaje"] = $media_pc_porcentaje;
	$_SESSION["media_agua_g"] = $media_agua_g;
	$_SESSION["media_cal_kcal"] = $media_cal_kcal;
	$_SESSION["media_prot_g"] = $media_prot_g;
	$_SESSION["media_hc_g"] = $media_hc_g;
	$_SESSION["media_grasa_g"] = $media_grasa_g;
	$_SESSION["media_satur_g"] = $media_satur_g;
	$_SESSION["media_mono_g"] = $media_mono_g;
	$_SESSION["media_poli_g"] = $media_poli_g;
	$_SESSION["media_col_mg"] = $media_col_mg;
	$_SESSION["media_fibra_g"] = $media_fibra_g;
	$_SESSION["media_sodio_mg"] = $media_sodio_mg;
	$_SESSION["media_potasio_mg"] = $media_potasio_mg;
	$_SESSION["media_magnesio_mg"] = $media_magnesio_mg;
	$_SESSION["media_calcio_mg"] = $media_calcio_mg;
	$_SESSION["media_fosf_mg"] = $media_fosf_mg;
	$_SESSION["media_hierro_mg"] = $media_hierro_mg;
	$_SESSION["media_cloro_mg"] = $media_cloro_mg;
	$_SESSION["media_cinc_mg"] = $media_cinc_mg;
	$_SESSION["media_cobre_mg"] = $media_cobre_mg;
	$_SESSION["media_manganeso_mg"] = $media_manganeso_mg;
	$_SESSION["media_cromo_mg"] = $media_cromo_mg;
	$_SESSION["media_cobalto_mg"] = $media_cobalto_mg;
	$_SESSION["media_molibde_mg"] = $media_molibde_mg;
	$_SESSION["media_yodo_mg"] = $media_yodo_mg;
	$_SESSION["media_fluor_mg"] = $media_fluor_mg;
	$_SESSION["media_butirico_c4_0"] = $media_butirico_c4_0;
	$_SESSION["media_caproico_c6_0"] = $media_caproico_c6_0;
	$_SESSION["media_caprilico_c8_0"] = $media_caprilico_c8_0;
	$_SESSION["media_caprico_c10_0"] = $media_caprico_c10_0;
	$_SESSION["media_laurico_c12_0"] = $media_laurico_c12_0;
	$_SESSION["media_miristico_c14_0"] = $media_miristico_c14_0;
	$_SESSION["media_c15_0"] = $media_c15_0;
	$_SESSION["media_c15_00"] = $media_c15_00;
	$_SESSION["media_palmitico_c16_0"] = $media_palmitico_c16_0;
	$_SESSION["media_c17_0"] = $media_c17_0;
	$_SESSION["media_c17_00"] = $media_c17_00;
	$_SESSION["media_estearico_c18_0"] = $media_estearico_c18_0;
	$_SESSION["media_araquidi_c20_0"] = $media_araquidi_c20_0;
	$_SESSION["media_behenico_c22_0"] = $media_behenico_c22_0;
	$_SESSION["media_miristol_c14_1"] = $media_miristol_c14_1;
	$_SESSION["media_palmitole_c16_1"] = $media_palmitole_c16_1;
	$_SESSION["media_oleico_c18_1"] = $media_oleico_c18_1;
	$_SESSION["media_eicoseno_c20_1"] = $media_eicoseno_c20_1;
	$_SESSION["media_c22_1"] = $media_c22_1;
	$_SESSION["media_linoleico_c18_2"] = $media_linoleico_c18_2;
	$_SESSION["media_linoleni_c18_3"] = $media_linoleni_c18_3;
	$_SESSION["media_c18_4"] = $media_c18_4;
	$_SESSION["media_ara_ico_c20_4"] = $media_ara_ico_c20_4;
	$_SESSION["media_c20_5"] = $media_c20_5;
	$_SESSION["media_c22_5"] = $media_c22_5;
	$_SESSION["media_c22_6"] = $media_c22_6;
	$_SESSION["media_otrosatur0"] = $media_otrosatur0;
	$_SESSION["media_otroinsat0"] = $media_otroinsat0;
	$_SESSION["media_omega3_0"] = $media_omega3_0;
	$_SESSION["media_etanol0"] = $media_etanol0;
	$_SESSION["media_vit_a"] = $media_vit_a;
	$_SESSION["media_carotenos"] = $media_carotenos;
	$_SESSION["media_tocoferol"] = $media_tocoferol;
	$_SESSION["media_vit_d"] = $media_vit_d;
	$_SESSION["media_vit_b1"] = $media_vit_b1;
	$_SESSION["media_vit_b2"] = $media_vit_b2;
	$_SESSION["media_vit_b6"] = $media_vit_b6;
	$_SESSION["media_niacina"] = $media_niacina;
	$_SESSION["media_ac_panto"] = $media_ac_panto;
	$_SESSION["media_biotina"] = $media_biotina;
	$_SESSION["media_folico"] = $media_folico;
	$_SESSION["media_b12"] = $media_b12;
	$_SESSION["media_vit_c"] = $media_vit_c;
	$_SESSION["media_purinas"] = $media_purinas;
	$_SESSION["media_vit_k"] = $media_vit_k;
	$_SESSION["media_vit_e"] = $media_vit_e;
	$_SESSION["media_oxalico"] = $media_oxalico;*/
	
	$_SESSION["media_pc_porcentaje"][$_SESSION["num_dias"]] = $_SESSION["media_pc_porcentaje"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_agua_g"][$_SESSION["num_dias"]] = $_SESSION["media_agua_g"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_cal_kcal"][$_SESSION["num_dias"]] = $_SESSION["media_cal_kcal"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_prot_g"][$_SESSION["num_dias"]] = $_SESSION["media_prot_g"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_hc_g"][$_SESSION["num_dias"]] = $_SESSION["media_hc_g"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_grasa_g"][$_SESSION["num_dias"]] = $_SESSION["media_grasa_g"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_satur_g"][$_SESSION["num_dias"]] = $_SESSION["media_satur_g"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_mono_g"][$_SESSION["num_dias"]] = $_SESSION["media_mono_g"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_poli_g"][$_SESSION["num_dias"]] = $_SESSION["media_poli_g"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_col_mg"][$_SESSION["num_dias"]] = $_SESSION["media_col_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_fibra_g"][$_SESSION["num_dias"]] = $_SESSION["media_fibra_g"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_sodio_mg"][$_SESSION["num_dias"]] = $_SESSION["media_sodio_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_potasio_mg"][$_SESSION["num_dias"]] = $_SESSION["media_potasio_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_magnesio_mg"][$_SESSION["num_dias"]] = $_SESSION["media_magnesio_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_calcio_mg"][$_SESSION["num_dias"]] = $_SESSION["media_calcio_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_fosf_mg"][$_SESSION["num_dias"]] = $_SESSION["media_fosf_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_hierro_mg"][$_SESSION["num_dias"]] = $_SESSION["media_hierro_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_cloro_mg"][$_SESSION["num_dias"]] = $_SESSION["media_cloro_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_cinc_mg"][$_SESSION["num_dias"]] = $_SESSION["media_cinc_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_cobre_mg"][$_SESSION["num_dias"]] = $_SESSION["media_cobre_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_manganeso_mg"][$_SESSION["num_dias"]] = $_SESSION["media_manganeso_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_cromo_mg"][$_SESSION["num_dias"]] = $_SESSION["media_cromo_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_cobalto_mg"][$_SESSION["num_dias"]] = $_SESSION["media_cobalto_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_molibde_mg"][$_SESSION["num_dias"]] = $_SESSION["media_molibde_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_yodo_mg"][$_SESSION["num_dias"]] = $_SESSION["media_yodo_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_fluor_mg"][$_SESSION["num_dias"]] = $_SESSION["media_fluor_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_butirico_c4_0"][$_SESSION["num_dias"]] = $_SESSION["media_butirico_c4_0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_caproico_c6_0"][$_SESSION["num_dias"]] = $_SESSION["media_caproico_c6_0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_caprilico_c8_0"][$_SESSION["num_dias"]] = $_SESSION["media_caprilico_c8_0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_caprico_c10_0"][$_SESSION["num_dias"]] = $_SESSION["media_caprico_c10_0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_laurico_c12_0"][$_SESSION["num_dias"]] = $_SESSION["media_laurico_c12_0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_miristico_c14_0"][$_SESSION["num_dias"]] = $_SESSION["media_miristico_c14_0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_c15_0"][$_SESSION["num_dias"]] = $_SESSION["media_c15_0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_c15_00"][$_SESSION["num_dias"]] = $_SESSION["media_c15_00"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_palmitico_c16_0"][$_SESSION["num_dias"]] = $_SESSION["media_palmitico_c16_0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_c17_0"][$_SESSION["num_dias"]] = $_SESSION["media_c17_0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_c17_00"][$_SESSION["num_dias"]] = $_SESSION["media_c17_00"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_estearico_c18_0"][$_SESSION["num_dias"]] = $_SESSION["media_estearico_c18_0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_araquidi_c20_0"][$_SESSION["num_dias"]] = $_SESSION["media_araquidi_c20_0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_behenico_c22_0"][$_SESSION["num_dias"]] = $_SESSION["media_behenico_c22_0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_miristol_c14_1"][$_SESSION["num_dias"]] = $_SESSION["media_miristol_c14_1"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_palmitole_c16_1"][$_SESSION["num_dias"]] = $_SESSION["media_palmitole_c16_1"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_oleico_c18_1"][$_SESSION["num_dias"]] = $_SESSION["media_oleico_c18_1"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_eicoseno_c20_1"][$_SESSION["num_dias"]] = $_SESSION["media_eicoseno_c20_1"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_c22_1"][$_SESSION["num_dias"]] = $_SESSION["media_c22_1"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_linoleico_c18_2"][$_SESSION["num_dias"]] = $_SESSION["media_linoleico_c18_2"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_linoleni_c18_3"][$_SESSION["num_dias"]] = $_SESSION["media_linoleni_c18_3"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_c18_4"][$_SESSION["num_dias"]] = $_SESSION["media_c18_4"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_ara_ico_c20_4"][$_SESSION["num_dias"]] = $_SESSION["media_ara_ico_c20_4"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_c20_5"][$_SESSION["num_dias"]] = $_SESSION["media_c20_5"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_c22_5"][$_SESSION["num_dias"]] = $_SESSION["media_c22_5"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_c22_6"][$_SESSION["num_dias"]] = $_SESSION["media_c22_6"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_otrosatur0"][$_SESSION["num_dias"]] = $_SESSION["media_otrosatur0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_otroinsat0"][$_SESSION["num_dias"]] = $_SESSION["media_otroinsat0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_omega3_0"][$_SESSION["num_dias"]] = $_SESSION["media_omega3_0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_etanol0"][$_SESSION["num_dias"]] = $_SESSION["media_etanol0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_vit_a"][$_SESSION["num_dias"]] = $_SESSION["media_vit_a"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_carotenos"][$_SESSION["num_dias"]] = $_SESSION["media_carotenos"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_tocoferol"][$_SESSION["num_dias"]] = $_SESSION["media_tocoferol"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_vit_d"][$_SESSION["num_dias"]] = $_SESSION["media_vit_d"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_vit_b1"][$_SESSION["num_dias"]] = $_SESSION["media_vit_b1"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_vit_b2"][$_SESSION["num_dias"]] = $_SESSION["media_vit_b2"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_vit_b6"][$_SESSION["num_dias"]] = $_SESSION["media_vit_b6"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_niacina"][$_SESSION["num_dias"]] = $_SESSION["media_niacina"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_ac_panto"][$_SESSION["num_dias"]] = $_SESSION["media_ac_panto"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_biotina"][$_SESSION["num_dias"]] = $_SESSION["media_biotina"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_folico"][$_SESSION["num_dias"]] = $_SESSION["media_folico"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_b12"][$_SESSION["num_dias"]] = $_SESSION["media_b12"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_vit_c"][$_SESSION["num_dias"]] = $_SESSION["media_vit_c"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_purinas"][$_SESSION["num_dias"]] = $_SESSION["media_purinas"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_vit_k"][$_SESSION["num_dias"]] = $_SESSION["media_vit_k"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_vit_e"][$_SESSION["num_dias"]] = $_SESSION["media_vit_e"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	$_SESSION["media_oxalico"][$_SESSION["num_dias"]] = $_SESSION["media_oxalico"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];
	
	calculaPiramide();

}

function info_dieta()
{
	$ruta_piramide = "img/piramide.png";
	$ruta_ia = "img/IA.png";

	$reglas = "";
	$cont_cereales = 0;
    $cont_frutas = 0;
    $cont_grasas = 0;
    $cont_proteinas = 0;
    $cont = 0;
    $suma_cereales = 0;
    $suma_frutas = 0;
    $suma_grasas = 0;
    $suma_proteinas = 0;
    $suma = 0;

	foreach ($_SESSION["reglas"] as $r)
	{
		$grupo = $_SESSION["dictGruposAlimentos"][$r->supergrupo];
		$reglas .= $r->supergrupo . " ";
		if ($r->min_unidades == $r->max_unidades)
            $reglas .= " " . $r->min_unidades . " unidades/";
        else if ($r->min_unidades == 0)
            $reglas .= " hasta " . $r->max_unidades . " unidades/";
        else if ($r->max_unidades == 99999)
            $reglas .= " " . $r->min_unidades . " o m&aacute;s unidades/";
        else
            $reglas .= " (" . $r->min_unidades . ", " . $r->max_unidades . ") unidades/";
        $porcentaje = 0;
        $porcentajeTotal = 0;
        $sumaPorcentajes = 0;
        $min = $r->min_unidades;
        $max = $r->max_unidades;
        if ($r->frecuencia == "Diaria")
        {
            $reglas .= "d&iacute;a";
            $reglas .= "<br>Ajustes por d&iacute;a: ";
            for ($dia = 0; $dia < $_SESSION["num_dias"]; $dia++)
            {
                if ($dia == 0)
                	$reglas .= "<p style='text-indent: 4em; margin-bottom:0px;'>";
                //if ((($dia % 4) == 0) && ($dia != 0))
                //	$reglas .= "</p><p style='text-indent: 4em; margin-bottom:0px;'>";

                if (($_SESSION["grupo_dia"][$grupo][$dia] >= $min) && ($_SESSION["grupo_dia"][$grupo][$dia] <= $max))
                    $porcentaje = 100;
                else if ($_SESSION["grupo_dia"][$grupo][$dia] > ($max * 2))
                    $porcentaje = 0;
                else if ($_SESSION["grupo_dia"][$grupo][$dia] < $min)
                    $porcentaje = 100 - ((($min - $_SESSION["grupo_dia"][$grupo][$dia]) / $min) * 100);
                else if ($_SESSION["grupo_dia"][$grupo][$dia] > $max)
                    $porcentaje = 100 + ((($_SESSION["grupo_dia"][$grupo][$dia] - $max) / $max) * 100);

                $reglas .= ($dia + 1) . ": ";

                if($porcentaje >= 50 && $porcentaje <= 150)
                	$reglas .= "<font color='green'>";
                else
                	$reglas .= "<font color='red'>";

                $reglas .= round($porcentaje,2) . "% </font>";
                $sumaPorcentajes += $porcentaje;
            }

            $reglas .= "</p>Porcentaje: ";
            $porcentajeTotal = round($sumaPorcentajes / $_SESSION["num_dias"], 2);
            if ($porcentajeTotal >= 50 && $porcentajeTotal <= 150)
                $reglas .= "<font color='green'>";
            else
                $reglas .= "<font color='red'>";
            $reglas .= $porcentajeTotal . " %</font>";

            $reglas .= "<br><br>";
        }
        else
        {
            $reglas .= "semana";
            $reglas .= "<br>Ajustes por semana: ";
            $porcentaje = 0;
            $porcentajeTotal = 0;
            $sumaPorcentajes = 0;
            for ($semana = 0; $semana < $_SESSION["num_semanas"]; $semana++)
            {
                $min = $r->min_unidades;
                $max = $r->max_unidades;
                if ($semana == 0)
                	$reglas .= "<p style='text-indent: 4em; margin-bottom:0px;'>";
                //if ((($semana % 4) == 0) && ($semana != 0))
                //	$reglas .= "</p><p style='text-indent: 4em; margin-bottom:0px;'>";

                if (($_SESSION["grupo_semana"][$grupo][$semana] >= $min) && ($_SESSION["grupo_semana"][$grupo][$semana] <= $max))
                    $porcentaje = 100;
                else if ($_SESSION["grupo_semana"][$grupo][$semana] > ($max * 2))
                    $porcentaje = 0;
                else if ($_SESSION["grupo_semana"][$grupo][$semana] < $min)
                    $porcentaje = 100 - ((($min - $_SESSION["grupo_semana"][$grupo][$semana]) / $min) * 100);
                else if ($_SESSION["grupo_semana"][$grupo][$semana] > $max)
                    $porcentaje = 100 + ((($_SESSION["grupo_semana"][$grupo][$semana] - $max) / $max) * 100);

                $reglas .= ($semana + 1) . ": ";

                if($porcentaje >= 50 && $porcentaje <= 150)
                	$reglas .= "<font color='green'>";
                else
                	$reglas .= "<font color='red'>";

                $reglas .= round($porcentaje,2) . "% </font>";

                $sumaPorcentajes += $porcentaje;
            }

            $reglas .= "</p>Porcentaje: ";
            $porcentajeTotal = round($sumaPorcentajes / $_SESSION["num_semanas"], 2);
            if ($porcentajeTotal >= 50 && $porcentajeTotal <= 150)
                $reglas .= "<font color='green'>";
            else
                $reglas .= "<font color='red'>";
            $reglas .= $porcentajeTotal . " %</font>";

            $reglas .= "<br><br>";
        }
        $reglas .= "<br>";

        //CÃ¡lculo de estadÃ­sticas
        if ($r->nivel == 0)
        {
             $cont_cereales++;
             $suma_cereales += $porcentajeTotal;
        }
        else if ($r->nivel == 1)
        {
            $cont_frutas++;
            $suma_frutas += $porcentajeTotal;
        }
        else if ($r->nivel == 2)
        {
            $cont_proteinas++;
            $suma_proteinas += $porcentajeTotal;
        }
        else if ($r->nivel == 3)
        {
            $cont_grasas++;
            $suma_grasas += $porcentajeTotal;
        }

        $cont++;
        $suma += $porcentajeTotal;
	}

	if ($cont != 0)
        $labelTotal = ($suma / $cont) . " %";

    if ($cont_cereales != 0)
        $labelMediaCerealesIn = ($suma_cereales / $cont_cereales) . "%";

    if ($cont_frutas != 0)
        $labelMediaFrutasIn = ($suma_frutas / $cont_frutas) . "%";

    if ($cont_proteinas != 0)
        $labelMediaProteinasIn = ($suma_proteinas / $cont_proteinas) . "%";

    if ($cont_grasas != 0)
        $labelMediaGrasasIn = ($suma_grasas / $cont_grasas) . "%";

	/*$reglas = "Regla 1: FRUTA 3-4 unidades/d&iacute;a
		<br>Ajustes por d&iacute;a:
		<p style='text-indent: 4em; margin-bottom:0px;'>
			<font color='green'>1</font>
			<font color='green'>2</font>
			<font color='green'>3</font>
			<font color='green'>4</font>
			<font color='green'>5</font>
			<font color='green'>6</font>
			<font color='green'>7</font>
		</p>
		<p style='text-indent: 4em; margin-bottom:0px;'>
			<font color='red'>8</font>
			<font color='red'>9</font>
		</p>
		Porcentaje: <font color='green'>100%</font>
		";*/

	if ($_SESSION["role"] == "admin" || $_SESSION["role"] == "Avanzado" || $_SESSION["role"] == "Formacion")
{
	$info_nutricional =  '<ul class="nav nav-tabs">';
	$info_nutricional .= '<li class="active">';
	$info_nutricional .= '<a href="#dia'.$_SESSION["num_dias"].'" data-toggle="tab">Media</a></li>';
	for ($i = 0; $i < $_SESSION["num_dias"]; $i++)
	{
		$info_nutricional .= '<li>';
		$info_nutricional .= '<a href="#dia'.$i.'" data-toggle="tab">D&iacute;a '.($i+1).'</a></li>';
	}
	$info_nutricional .= '</ul>';
	$info_nutricional .= '<div class="tab-content">';
	
	$info_nutricional .= '<div class="tab-pane fade in active" id="dia'.$_SESSION["num_dias"].'">';

	for ($i = $_SESSION["num_dias"]; $i <= $_SESSION["num_dias"]; $i++)
	{
		$info_nutricional .= '
												<!--
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> PC (%) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="pc_porcentaje" id="pc_porcentaje" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_pc_porcentaje"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> cal (kcal) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="cal_kcal" id="cal_kcal" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_cal_kcal"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												-->
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;font-weight:bold;color:#57244C;">
													General
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Agua (g) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="agua_g" id="agua_g" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_agua_g"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Hidratos de carbono, total (g) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="hc_g" id="hc_g" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_hc_g"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Fibra (g) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="fibra_g" id="fibra_g" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_fibra_g"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Prote&iacute;nas, total (g) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="prot_g" id="prot_g" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_prot_g"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Grasas, total (g) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="grasa_g" id="grasa_g" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_grasa_g"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Colesterol (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="col_mg" id="col_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_col_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> AGS totales (g) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="satur_g" id="satur_g" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_satur_g"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> AGM totales (g) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="mono_g" id="mono_g" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_mono_g"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> AGP totales (g) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="poli_g" id="poli_g" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_poli_g"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;font-weight:bold;color:#57244C;">
													Vitaminas y otros
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Vit A (ug) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="vit_a" id="vit_a" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_vit_a"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Carotenos (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="carotenos" id="carotenos" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_carotenos"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Tiamina B1 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="vit_b1" id="vit_b1" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_vit_b1"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Riboflavina B2 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="vit_b2" id="vit_b2" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_vit_b2"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Niacina B3 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="niacina" id="niacina" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_niacina"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Ac. Pantot&eacute;nico B5 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="ac_panto" id="ac_panto" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_ac_panto"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Piridoxina B6 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="vit_b6" id="vit_b6" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_vit_b6"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Biotina (ug) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="biotina" id="biotina" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_biotina"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Ac. F&oacute;lico B9 (ug) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="folico" id="folico" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_folico"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Cobalamina B12 (ug) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="b12" id="b12" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_b12"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Vit C (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="vit_c" id="vit_c" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_vit_c"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Vit D (ug) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="vit_d" id="vit_d" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_vit_d"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Tocoferol (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="tocoferol" id="tocoferol" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_tocoferol"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Vit E (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="vit_e" id="vit_e" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_vit_e"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Vit K (ug) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="vit_k" id="vit_k" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_vit_k"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Ox&aacute;lico (ug) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="oxalico" id="oxalico" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_oxalico"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Purinas (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="purinas" id="purinas" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_purinas"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;font-weight:bold;color:#57244C;">
													Minerales
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Sodio (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="sodio_mg" id="sodio_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_sodio_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Potasio (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="potasio_mg" id="potasio_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_potasio_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Magnesio (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="magnesio_mg" id="magnesio_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_magnesio_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Calcio (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="calcio_mg" id="calcio_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_calcio_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> F&oacute;sforo (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="fosf_mg" id="fosf_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_fosf_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Hierro (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="hierro_mg" id="hierro_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_hierro_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Cloro (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="cloro_mg" id="cloro_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_cloro_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Zinc (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="cinc_mg" id="cinc_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_cinc_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Cobre (ug) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="cobre_mg" id="cobre_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_cobre_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Manganeso (ug) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="manganeso_mg" id="manganeso_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_manganeso_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Cromo (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="cromo_mg" id="cromo_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_cromo_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Cobalto (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="cobalto_mg" id="cobalto_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_cobalto_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Molibde (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="molibde_mg" id="molibde_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_molibde_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Yodo (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="yodo_mg" id="yodo_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_yodo_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Fluor (ug) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="fluor_mg" id="fluor_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_fluor_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;font-weight:bold;color:#57244C;">
													&Aacute;cidos grasos
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> But&iacute;rico C4:0 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="butirico_c4_0" id="butirico_c4_0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_butirico_c4_0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Caproico C6:0 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="caproico_c6_0" id="caproico_c6_0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_caproico_c6_0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Capr&iacute;lico C8:0 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="caprilico_c8_0" id="caprilico_c8_0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_caprilico_c8_0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> C&aacute;prico C10:0 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="caprico_c10_0" id="caprico_c10_0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_caprico_c10_0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> L&aacute;rico C12:0 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="laurico_c12_0" id="laurico_c12_0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_laurico_c12_0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Mir&iacute;stico C14:0 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="miristico_c14_0" id="miristico_c14_0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_miristico_c14_0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> C15:0 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="c15_0" id="c15_0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_c15_0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> C15:00 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="c15_00" id="c15_00" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_c15_00"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Palm&iacute;tico C16:0 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="palmitico_c16_0" id="palmitico_c16_0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_palmitico_c16_0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> C17:0 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="c17_0" id="c17_0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_c17_0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> C17:00 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="c17_00" id="c17_00" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_c17_00"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Este&aacute;rico C18:0 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="estearico_c18_0" id="estearico_c18_0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_estearico_c18_0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Araqu&iacute;dico C20:0 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="araquidi_c20_0" id="araquidi_c20_0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_araquidi_c20_0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Beh&eacute;nico C22:0 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="behenico_c22_0" id="behenico_c22_0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_behenico_c22_0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Miristol C14:1 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="miristol_c14_1" id="miristol_c14_1" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_miristol_c14_1"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Palmitole C16:1 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="palmitole_c16_1" id="palmitole_c16_1" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_palmitole_c16_1"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Oleico C18:1 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="oleico_c18_1" id="oleico_c18_1" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_oleico_c18_1"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Eicoseno C20:1 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="eicoseno_c20_1" id="eicoseno_c20_1" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_eicoseno_c20_1"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> C22:1 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="c22_1" id="c22_1" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_c22_1"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Linoleico C18:2 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="linoleico_c18_2" id="linoleico_c18_2" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_linoleico_c18_2"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Linol&eacute;nico C18:3 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="linoleni_c18_3" id="linoleni_c18_3" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_linoleni_c18_3"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> C18:4 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="c18_4" id="c18_4" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_c18_4"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Araquid&oacute;nico C20:4 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="ara_ico_c20_4" id="ara_ico_c20_4" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_ara_ico_c20_4"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> C20:5 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="c20_5" id="c20_5" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_c20_5"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> C22:5 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="c22_5" id="c22_5" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_c22_5"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> C22:6 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="c22_6" id="c22_6" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_c22_6"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Otros satura (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="otrosatur0" id="otrosatur0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_otrosatur0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Otros insatura (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="otroinsat0" id="otroinsat0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_otroinsat0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Omega 3:0 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="omega3_0" id="omega3_0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_omega3_0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Etanol (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="etanol0" id="etanol0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_etanol0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
											</div>
		';		
	}
	
	for ($i = 0; $i < $_SESSION["num_dias"]; $i++)
	{
		$info_nutricional .= '<div class="tab-pane fade" id="dia'.$i.'">';
		$info_nutricional .= '
												<!--
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> PC (%) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="pc_porcentaje" id="pc_porcentaje" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_pc_porcentaje"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> cal (kcal) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="cal_kcal" id="cal_kcal" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_cal_kcal"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												-->
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;font-weight:bold;color:#57244C;">
													General
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Agua (g) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="agua_g" id="agua_g" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_agua_g"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Hidratos de carbono, total (g) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="hc_g" id="hc_g" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_hc_g"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Fibra (g) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="fibra_g" id="fibra_g" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_fibra_g"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Prote&iacute;nas, total (g) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="prot_g" id="prot_g" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_prot_g"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Grasas, total (g) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="grasa_g" id="grasa_g" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_grasa_g"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Colesterol (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="col_mg" id="col_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_col_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> AGS totales (g) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="satur_g" id="satur_g" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_satur_g"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> AGM totales (g) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="mono_g" id="mono_g" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_mono_g"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> AGP totales (g) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="poli_g" id="poli_g" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_poli_g"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;font-weight:bold;color:#57244C;">
													Vitaminas y otros
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Vit A (ug) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="vit_a" id="vit_a" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_vit_a"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Carotenos (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="carotenos" id="carotenos" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_carotenos"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Tiamina B1 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="vit_b1" id="vit_b1" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_vit_b1"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Riboflavina B2 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="vit_b2" id="vit_b2" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_vit_b2"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Niacina B3 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="niacina" id="niacina" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_niacina"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Ac. Pantot&eacute;nico B5 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="ac_panto" id="ac_panto" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_ac_panto"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Piridoxina B6 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="vit_b6" id="vit_b6" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_vit_b6"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Biotina (ug) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="biotina" id="biotina" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_biotina"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Ac. F&oacute;lico B9 (ug) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="folico" id="folico" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_folico"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Cobalamina B12 (ug) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="b12" id="b12" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_b12"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Vit C (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="vit_c" id="vit_c" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_vit_c"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Vit D (ug) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="vit_d" id="vit_d" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_vit_d"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Tocoferol (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="tocoferol" id="tocoferol" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_tocoferol"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Vit E (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="vit_e" id="vit_e" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_vit_e"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Vit K (ug) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="vit_k" id="vit_k" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_vit_k"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Ox&aacute;lico (ug) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="oxalico" id="oxalico" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_oxalico"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Purinas (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="purinas" id="purinas" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_purinas"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;font-weight:bold;color:#57244C;">
													Minerales
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Sodio (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="sodio_mg" id="sodio_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_sodio_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Potasio (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="potasio_mg" id="potasio_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_potasio_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Magnesio (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="magnesio_mg" id="magnesio_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_magnesio_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Calcio (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="calcio_mg" id="calcio_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_calcio_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> F&oacute;sforo (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="fosf_mg" id="fosf_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_fosf_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Hierro (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="hierro_mg" id="hierro_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_hierro_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Cloro (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="cloro_mg" id="cloro_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_cloro_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Zinc (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="cinc_mg" id="cinc_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_cinc_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Cobre (ug) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="cobre_mg" id="cobre_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_cobre_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Manganeso (ug) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="manganeso_mg" id="manganeso_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_manganeso_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Cromo (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="cromo_mg" id="cromo_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_cromo_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Cobalto (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="cobalto_mg" id="cobalto_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_cobalto_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Molibde (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="molibde_mg" id="molibde_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_molibde_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Yodo (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="yodo_mg" id="yodo_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_yodo_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Fluor (ug) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="fluor_mg" id="fluor_mg" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_fluor_mg"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;font-weight:bold;color:#57244C;">
													&Aacute;cidos grasos
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> But&iacute;rico C4:0 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="butirico_c4_0" id="butirico_c4_0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_butirico_c4_0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Caproico C6:0 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="caproico_c6_0" id="caproico_c6_0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_caproico_c6_0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Capr&iacute;lico C8:0 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="caprilico_c8_0" id="caprilico_c8_0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_caprilico_c8_0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> C&aacute;prico C10:0 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="caprico_c10_0" id="caprico_c10_0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_caprico_c10_0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> L&aacute;rico C12:0 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="laurico_c12_0" id="laurico_c12_0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_laurico_c12_0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Mir&iacute;stico C14:0 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="miristico_c14_0" id="miristico_c14_0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_miristico_c14_0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> C15:0 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="c15_0" id="c15_0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_c15_0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> C15:00 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="c15_00" id="c15_00" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_c15_00"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Palm&iacute;tico C16:0 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="palmitico_c16_0" id="palmitico_c16_0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_palmitico_c16_0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> C17:0 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="c17_0" id="c17_0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_c17_0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> C17:00 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="c17_00" id="c17_00" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_c17_00"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Este&aacute;rico C18:0 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="estearico_c18_0" id="estearico_c18_0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_estearico_c18_0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Araqu&iacute;dico C20:0 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="araquidi_c20_0" id="araquidi_c20_0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_araquidi_c20_0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Beh&eacute;nico C22:0 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="behenico_c22_0" id="behenico_c22_0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_behenico_c22_0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Miristol C14:1 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="miristol_c14_1" id="miristol_c14_1" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_miristol_c14_1"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Palmitole C16:1 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="palmitole_c16_1" id="palmitole_c16_1" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_palmitole_c16_1"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Oleico C18:1 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="oleico_c18_1" id="oleico_c18_1" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_oleico_c18_1"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Eicoseno C20:1 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="eicoseno_c20_1" id="eicoseno_c20_1" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_eicoseno_c20_1"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> C22:1 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="c22_1" id="c22_1" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_c22_1"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Linoleico C18:2 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="linoleico_c18_2" id="linoleico_c18_2" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_linoleico_c18_2"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Linol&eacute;nico C18:3 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="linoleni_c18_3" id="linoleni_c18_3" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_linoleni_c18_3"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> C18:4 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="c18_4" id="c18_4" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_c18_4"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Araquid&oacute;nico C20:4 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="ara_ico_c20_4" id="ara_ico_c20_4" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_ara_ico_c20_4"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> C20:5 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="c20_5" id="c20_5" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_c20_5"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> C22:5 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="c22_5" id="c22_5" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_c22_5"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> C22:6 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="c22_6" id="c22_6" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_c22_6"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Otros satura (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="otrosatur0" id="otrosatur0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_otrosatur0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
												<div class="row" style="padding-top:10px; padding-left:28px; padding-right:35px;">
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Otros insatura (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="otroinsat0" id="otroinsat0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_otroinsat0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Omega 3:0 (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="omega3_0" id="omega3_0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_omega3_0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
													<div class="col-xs-2">
														<label style="font-weight: normal; padding-top:5px;"> Etanol (mg) </label>
													</div>
													<div class="col-xs-2">
														<input type="text" class="form-control" name="etanol0" id="etanol0" style="text-align:right;" required
														';
		
						$info_nutricional .= ' value="'.round($_SESSION["media_etanol0"][$i], 2).'" readonly ';
		
					$info_nutricional .=
														'>
													</div>
												</div>
											</div>
		';
	}
	$info_nutricional .= '</div>';
}
	
	$html = '
		<div style="font-size:12px;">
				<div class="row">
				    <div class="col-xs-1 col-xs-offset-6" style="text-align: right; padding-top:8px;">
				    	<img src="'.$ruta_ia.'" width="50px" HEIGHT="50px"/>
				    </div>
				    <div class="col-xs-2" style="font-weight: bold; padding-top:8px;">
				    	<center>
				    		Inteligencia artificial<br>
				    		Predicci&oacute;n del peso <br> tras la dieta
				    		<font color="green">'.$_SESSION["labelPesoIA"].'</font>
				    	</center>
				    </div>
				    <div class="col-xs-1" style="padding-top:8px;">
				    	<img src="'.$ruta_piramide.'" width="50px" HEIGHT="50px"/>
				    </div>
				    <div class="col-xs-2" style="font-weight: bold">
				    	Porcentaje de acierto: <br>
				    	Pir&aacute;mide <font color="green">'.$_SESSION["labelAciertoPiramide"].'</font>
				    	<br>General <font color="green">'.$_SESSION["labelAciertoGeneral"].'</font>
				    	<br><a data-toggle="modal" data-target="#modalEstadisticas" class="modalEstadisticas">Ver estad&iacute;sticas</a>
				    </div>
				</div>
		</div>
	';

	$html .= '
		<div class="modal fade" id="modalEstadisticas" tabindex="-1" role="dialog" aria-labelledby="modalEstadisticasLabel" aria-hidden="true">
			<div class="modal-dialog">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		        		<h4 class="modal-title" id="modalEstadisticasLabel">Estad&iacute;sticas</h4>
		      		</div>
		      		<div class="modal-body" style="font-size:12px;">
		      			<div class="row">
						    <div class="col-xs-1 col-xs-offset-1" style="padding-top:25px;">
						    	<img src="'.$ruta_ia.'" width="50px" HEIGHT="50px"/>
						    </div>
						    <div class="col-xs-3" style="font-weight: bold; padding-top:25px;">
						    	<center>
						    		Inteligencia artificial<br>
						    		Predicci&oacute;n del peso <br> tras la dieta
						    		<font color="green">'.$_SESSION["labelPesoIA"].'</font>
						    	</center>
						    </div>
						    <div class="col-xs-6" style="font-weight: bold;">
						    	<center>
						    		Porcentaje de acierto
						    	</center>
						    	<div class="row">
						    		<div class="col-xs-3" style="padding-top:20px;">
								    	<center>
								    		General <br>
								    		<font color="green">'.$_SESSION["labelAciertoGeneral"].'</font>
								    	</center>
								    </div>
								    <div class="col-xs-9" style="font-weight: bold; padding-bottom:15px; padding-top:5px;">
								    	Calor&iacute;as <font color="purple">'.$_SESSION["labelAciertoCalorias"].'</font>
								    	<br>Prote&iacute;nas <font color="purple">'.$_SESSION["labelAciertoProteinas"].'</font>
								    	<br>Hidratos <font color="purple">'.$_SESSION["labelAciertoHidratos"].'</font>
								    	<br>Grasas <font color="purple"> '.$_SESSION["labelAciertoGrasas"].'</font>
								    </div>
						    	</div>
						    </div>
						</div>
						<div class="row">';
$html .= '				    <div class="col-xs-5">
								<div class="row"  style="font-weight: bold; padding-top:30px;">
									<center>Pir&aacute;mide Nutricional</center>
									<div class="col-xs-1 col-xs-offset-1" style="padding-top:20px;">
										<img src="'.$ruta_piramide.'" width="60px" HEIGHT="60px"/>
									</div>
									<div class="col-xs-4" style="padding-top:30px;">
										<center>
											Ajuste a Pir&aacute;mide Nutricional<br>
											<font color="green">'.$_SESSION["labelAciertoPiramide"].'</font>
										</center>
									</div>
								</div>
								<div class="row"  style="font-weight: bold; padding-top:30px;">
									<div class="col-xs-12 col-xs-offset-1">
										'.$reglas.'
									</div>
								</div>
							</div>';
	if ($_SESSION["role"] == "admin" || $_SESSION["role"] == "Avanzado" || $_SESSION["role"] == "Formacion")
{
$html .= '				    <div class="col-xs-7">
								<div class="row"  style="padding-top:30px;">
									<div class="panel-heading">
										<h3 class="panel-title">Informaci&oacute;n nutricional</h3>
									</div>
									<div class="panel-body">';
$html .= 								$info_nutricional;
$html .= '								
									</div>
								</div>
							</div>';
}	
$html .= '				</div>
		          		<div class="modal-footer">
			        		<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			      		</div>
		      		</div>
		    	</div>
		  	</div>
		</div>
	';

	return $html;
}

iniciar_sesion();

if (!isset($_SESSION["login"]))
	echo recargarPagina("index.php");

elseif (!isset($_SESSION["usuarioActivo"]) || $_SESSION["usuarioActivo"] == 0) {
	echo "<script>alert('Usuario inactivo, no puede acceder');</script>";
	echo cerrar_sesion();
}

else {
	if (!isset($_SESSION["id_cliente"]))
		echo recargarPagina("dieta_1.php");

	if (isset($_POST["estado"]) && $_POST["estado"] == 'procesar')
	{
//echo " 1 " .time();
		$link = conectar();

		if (isset($_SESSION["id_dieta"]))
			unset($_SESSION["id_dieta"]);

		if (isset($_SESSION["es_plantilla"]))
			unset($_SESSION["es_plantilla"]);

		if (isset($_SESSION["id_plantilla"]))
			unset($_SESSION["id_plantilla"]);

		if (isset($_SESSION["fecha_inicio"]))
			unset($_SESSION["fecha_inicio"]);

		if (isset($_SESSION["num_dias"]))
			unset($_SESSION["num_dias"]);

		if (isset($_SESSION["num_semanas"]))
			unset($_SESSION["num_semanas"]);

		if (isset($_SESSION["num_comidas"]))
			unset($_SESSION["num_comidas"]);

		if (isset($_SESSION["platos_comida"]))
			unset($_SESSION["platos_comida"]);

		if (isset($_SESSION["postre_comida"]))
			unset($_SESSION["postre_comida"]);

		if (isset($_SESSION["platos_cena"]))
			unset($_SESSION["platos_cena"]);

		if (isset($_SESSION["postre_cena"]))
			unset($_SESSION["postre_cena"]);

		if (isset($_SESSION["limitar_peso"]))
			unset($_SESSION["limitar_peso"]);

		if (isset($_SESSION["kcalorias"]))
			unset($_SESSION["kcalorias"]);

		if (isset($_SESSION["porcentaje_proteinas"]))
			unset($_SESSION["porcentaje_proteinas"]);

		if (isset($_SESSION["porcentaje_grasas"]))
			unset($_SESSION["porcentaje_grasas"]);

		if (isset($_SESSION["porcentaje_hidratos"]))
			unset($_SESSION["porcentaje_hidratos"]);

		if (isset($_SESSION["id_dieta_almacenada"]))
			unset($_SESSION["id_dieta_almacenada"]);

		if (isset($_SESSION["dictGruposAlimentos"]))
			unset($_SESSION["dictGruposAlimentos"]);

		/*foreach ($_SESSION["dictGruposAlimentos"] as $clave => $valor) {
		    echo "$clave -> $valor<br>";
		}*/

		$_SESSION["platoLibre"] = new Comida();
		$_SESSION["platoLibre"]->preparacion = "-";
		$_SESSION["platoLibre"]->id_plato = getIDRecetaLibre($link);
		$_SESSION["platoLibre"]->fijo = 0;
		$_SESSION["platoLibre"]->peso = 0;
		$_SESSION["platoLibre"]->kcal = 0;
		$_SESSION["platoLibre"]->hidratos = 0;
		$_SESSION["platoLibre"]->grasa = 0;
		$_SESSION["platoLibre"]->proteinas = 0;
		$_SESSION["platoLibre"]->nombre = "LIBRE";

		$_SESSION["platoLibre"]->pc_porcentaje = 0;
		$_SESSION["platoLibre"]->agua_g = 0;
		$_SESSION["platoLibre"]->cal_kcal = 0;
		$_SESSION["platoLibre"]->prot_g = 0;
		$_SESSION["platoLibre"]->hc_g = 0;
		$_SESSION["platoLibre"]->grasa_g = 0;
		$_SESSION["platoLibre"]->satur_g = 0;
		$_SESSION["platoLibre"]->mono_g = 0;
		$_SESSION["platoLibre"]->poli_g = 0;
		$_SESSION["platoLibre"]->col_mg = 0;
		$_SESSION["platoLibre"]->fibra_g = 0;
		$_SESSION["platoLibre"]->sodio_mg = 0;
		$_SESSION["platoLibre"]->potasio_mg = 0;
		$_SESSION["platoLibre"]->magnesio_mg = 0;
		$_SESSION["platoLibre"]->calcio_mg = 0;
		$_SESSION["platoLibre"]->fosf_mg = 0;
		$_SESSION["platoLibre"]->hierro_mg = 0;
		$_SESSION["platoLibre"]->cloro_mg = 0;
		$_SESSION["platoLibre"]->cinc_mg = 0;
		$_SESSION["platoLibre"]->cobre_mg = 0;
		$_SESSION["platoLibre"]->manganeso_mg = 0;
		$_SESSION["platoLibre"]->cromo_mg = 0;
		$_SESSION["platoLibre"]->cobalto_mg = 0;
		$_SESSION["platoLibre"]->molibde_mg = 0;
		$_SESSION["platoLibre"]->yodo_mg = 0;
		$_SESSION["platoLibre"]->fluor_mg = 0;
		$_SESSION["platoLibre"]->butirico_c4_0 = 0;
		$_SESSION["platoLibre"]->caproico_c6_0 = 0;
		$_SESSION["platoLibre"]->caprilico_c8_0 = 0;
		$_SESSION["platoLibre"]->caprico_c10_0 = 0;
		$_SESSION["platoLibre"]->laurico_c12_0 = 0;
		$_SESSION["platoLibre"]->miristico_c14_0 = 0;
		$_SESSION["platoLibre"]->c15_0 = 0;
		$_SESSION["platoLibre"]->c15_00 = 0;
		$_SESSION["platoLibre"]->palmitico_c16_0 = 0;
		$_SESSION["platoLibre"]->c17_0 = 0;
		$_SESSION["platoLibre"]->c17_00 = 0;
		$_SESSION["platoLibre"]->estearico_c18_0 = 0;
		$_SESSION["platoLibre"]->araquidi_c20_0 = 0;
		$_SESSION["platoLibre"]->behenico_c22_0 = 0;
		$_SESSION["platoLibre"]->miristol_c14_1 = 0;
		$_SESSION["platoLibre"]->palmitole_c16_1 = 0;
		$_SESSION["platoLibre"]->oleico_c18_1 = 0;
		$_SESSION["platoLibre"]->eicoseno_c20_1 = 0;
		$_SESSION["platoLibre"]->c22_1 = 0;
		$_SESSION["platoLibre"]->linoleico_c18_2 = 0;
		$_SESSION["platoLibre"]->linoleni_c18_3 = 0;
		$_SESSION["platoLibre"]->c18_4 = 0;
		$_SESSION["platoLibre"]->ara_ico_c20_4 = 0;
		$_SESSION["platoLibre"]->c20_5 = 0;
		$_SESSION["platoLibre"]->c22_5 = 0;
		$_SESSION["platoLibre"]->c22_6 = 0;
		$_SESSION["platoLibre"]->otrosatur0 = 0;
		$_SESSION["platoLibre"]->otroinsat0 = 0;
		$_SESSION["platoLibre"]->omega3_0 = 0;
		$_SESSION["platoLibre"]->etanol0 = 0;
		$_SESSION["platoLibre"]->vit_a = 0;
		$_SESSION["platoLibre"]->carotenos = 0;
		$_SESSION["platoLibre"]->tocoferol = 0;
		$_SESSION["platoLibre"]->vit_d = 0;
		$_SESSION["platoLibre"]->vit_b1 = 0;
		$_SESSION["platoLibre"]->vit_b2 = 0;
		$_SESSION["platoLibre"]->vit_b6 = 0;
		$_SESSION["platoLibre"]->niacina = 0;
		$_SESSION["platoLibre"]->ac_panto = 0;
		$_SESSION["platoLibre"]->biotina = 0;
		$_SESSION["platoLibre"]->folico = 0;
		$_SESSION["platoLibre"]->b12 = 0;
		$_SESSION["platoLibre"]->vit_c = 0;
		$_SESSION["platoLibre"]->purinas = 0;
		$_SESSION["platoLibre"]->vit_k = 0;
		$_SESSION["platoLibre"]->vit_e = 0;
		$_SESSION["platoLibre"]->oxalico = 0;
				
		$_SESSION["dictGruposAlimentos"] = getSupergruposArray($link);
				
		$r = getReglas($_SESSION["id_usuario"], $link);
		$_SESSION["reglas"] = array();
		$i = 0;
		while ($row = $r->fetch_assoc())
		{
			$_SESSION["reglas"][$i] = new infoRegla();
			$_SESSION["reglas"][$i]->id_regla = $row["id_regla"];
			$_SESSION["reglas"][$i]->frecuencia = $row["frecuencia"];
			$_SESSION["reglas"][$i]->max_unidades = $row["max_unidades"];
			$_SESSION["reglas"][$i]->min_unidades = $row["min_unidades"];
			$_SESSION["reglas"][$i]->nivel = $row["nivel"];
			$_SESSION["reglas"][$i]->supergrupo = $row["supergrupo"];
			$i++;
		}
		
		$ap = getAlimentosPlatos($link);
		$_SESSION["alimentoPlato"] = array();
		$i = 0;
		while ($row = $ap->fetch_assoc())
		{
			$_SESSION["alimentoPlato"][$i] = new infoPlato();
			$_SESSION["alimentoPlato"][$i]->idPlato = $row["id_plato"];
			$_SESSION["alimentoPlato"][$i]->idAlimento = $row["id_alimento"];
			$_SESSION["alimentoPlato"][$i]->grupo = $row["grupo"];
			$i++;
		}
		
		$as = getAlimentosSupergrupos($link);
		$_SESSION["alimentoSupergrupo"] = array();
		$i = 0;
		while ($row = $as->fetch_assoc())
		{
			$_SESSION["alimentoSupergrupo"][$i] = new infoAlimento();
			$_SESSION["alimentoSupergrupo"][$i]->idAlimento = $row["id_alimento"];
			$_SESSION["alimentoSupergrupo"][$i]->supergrupo = $row["supergrupo"];
			$i++;
		}

		$ps = getPlatosSupergrupos($link);
		$_SESSION["platosSupergrupos"] = array();
		while ($row = $ps->fetch_assoc())
		{
			//echo "<br>".$row["id_plato"];
			if (!isset( $_SESSION["platosSupergrupos"][$row["id_plato"]]))
				$_SESSION["platosSupergrupos"][$row["id_plato"]][] = $row["supergrupo"];
			else if (!in_array($row["supergrupo"], $_SESSION["platosSupergrupos"][$row["id_plato"]]))
				$_SESSION["platosSupergrupos"][$row["id_plato"]][] = $row["supergrupo"];
		}
		//var_dump($_SESSION["platosSupergrupos"]);

		if (isset($_POST["cbPlantilla"]))
		{
			$_SESSION["es_plantilla"] = TRUE;
			$_SESSION["id_plantilla"] = $_POST["plantilla"];
			$_SESSION["fecha_inicio"] = $_POST["fecha"];
			if (isset($_POST["limitePlatos"]))
				$_SESSION["limitar_peso"] = TRUE;
			else
				$_SESSION["limitar_peso"] = FALSE;
			$_SESSION["kcalorias"] = $_POST["kcal"];
			$_SESSION["porcentaje_proteinas"] = $_POST["proteinas"];
			$_SESSION["porcentaje_grasas"] = $_POST["grasas"];
			$_SESSION["porcentaje_hidratos"] = $_POST["hidratos"];
			$id_dieta = getDietaPlantilla ($_SESSION["id_plantilla"], $link);
			$_SESSION["id_dieta"] = $id_dieta;
			$num_dias = getDiasDieta ($id_dieta, $link);
			$_SESSION["num_dias"] = $num_dias;
			$_SESSION["num_semanas"] = ceil($_SESSION["num_dias"]/7);
			$num_comidas = getComidasDieta ($id_dieta, $link);
			$_SESSION["num_comidas"] = $num_comidas;

			$_SESSION["platos_comida"] = 1;
			$_SESSION["platos_cena"] = 1;
			$_SESSION["postre_comida"] = FALSE;
			$_SESSION["postre_cena"] = FALSE;


			$comidas = getTipoPlatosDieta ($id_dieta, $link);
			while ($comida = $comidas->fetch_assoc())
			{
				if ($comida["texto"] == "Comida(1)")
				{
					$_SESSION["platos_comida"] = 2;
				}
				else if ($comida["texto"] == "Comida(postre)")
				{
					$_SESSION["postre_comida"] = TRUE;
				}
				else if ($comida["texto"] == "Cena(1)")
				{
					$_SESSION["platos_cena"] = 2;
				}
				else if ($comida["texto"] == "Cena(postre)")
				{
					$_SESSION["postre_cena"] = TRUE;
				}
			}
			
			crearMatrices();
			//Cálculo de kcal para cada comida
			calculo_kcal_dieta();
						
			//Generando la dieta
			generarDietaPlantilla("", $id_dieta, $link);
		}
		else
		{
			$_SESSION["es_plantilla"] = FALSE;
			$_SESSION["num_dias"] = $_POST["duracion"];
			$_SESSION["num_semanas"] = ceil($_SESSION["num_dias"]/7);
			$_SESSION["num_comidas"] = $_POST["numComidas"];
			$_SESSION["platos_comida"] = $_POST["platosComida"];
			if (isset($_POST["postreComida"]))
				$_SESSION["postre_comida"] = TRUE;
			else
				$_SESSION["postre_comida"] = FALSE;
			$_SESSION["platos_cena"] = $_POST["platosCena"];
			if (isset($_POST["postreCena"]))
				$_SESSION["postre_cena"] = TRUE;
			else
				$_SESSION["postre_cena"] = FALSE;
			$_SESSION["fecha_inicio"] = $_POST["fecha"];
			if (isset($_POST["limitePlatos"]))
				$_SESSION["limitar_peso"] = TRUE;
			else
				$_SESSION["limitar_peso"] = FALSE;
			$_SESSION["kcalorias"] = $_POST["kcal"];
			$_SESSION["porcentaje_proteinas"] = $_POST["proteinas"];
			$_SESSION["porcentaje_grasas"] = $_POST["grasas"];
			$_SESSION["porcentaje_hidratos"] = $_POST["hidratos"];

			$_SESSION["grupos_imprimir"] = "";
			$grupos_excluidos = getArrayGruposExcluidos($_SESSION["id_cliente"],$link);
			//$_SESSION["alimentos_excluidos"] = getArrayAlimentosExcluidos($id_cliente);
			$cont = 0;
			foreach ($grupos_excluidos as $grupo)
			{
				if ($cont != 0)
					$_SESSION["grupos_imprimir"] .= ", ";
				$_SESSION["grupos_imprimir"] .= utf8_encode(getGrupoById($grupo, $link));
				$cont++;
			}
			if ($_SESSION["grupos_imprimir"] == "")
				$_SESSION["grupos_imprimir"] = "Ninguno";

			
			$_SESSION["alimentos_imprimir"] = "";
			$alimentos_excluidos = getArrayAlimentosExcluidos($_SESSION["id_cliente"], $link);
			$cont = 0;
			foreach ($alimentos_excluidos as $id_alimento)
			{
				if ($cont != 0)
					$_SESSION["alimentos_imprimir"] .= ", ";
				$consulta = getAlimentoById($id_alimento, $link);
				$alimento = $consulta->fetch_assoc();
				$_SESSION["alimentos_imprimir"] .= utf8_encode($alimento['nombre']);
				$cont++;
			}
			if ($_SESSION["alimentos_imprimir"] == "")
				$_SESSION["alimentos_imprimir"] = "Ninguno";

			/*if (isset($_POST["gruposExcluidos"]))
			{
				$grupos = $_POST["gruposExcluidos"];
				for ($i=0; $i<count($grupos); $i++)
				{
					if ($i != 0)
					{
						$_SESSION["excluir_grupo"] .= ", ";
						$_SESSION["grupos_imprimir"] .= ", ";
					}
					$_SESSION["excluir_grupo"] .= "'".$grupos[$i]."'";
					$_SESSION["grupos_imprimir"] .= utf8_encode(getGrupoById($grupos[$i], $link));
				}
			}
			$_SESSION["excluir_grupo"] .= ")";
			if ($_SESSION["grupos_imprimir"] == "")
				$_SESSION["grupos_imprimir"] = "Ninguno";
			*/

			/*if (!isset($_SESSION["excluir_alimentos"]))
			{
				$_SESSION["alimentos_imprimir"] = "Ninguno";
				$_SESSION["excluir_alimentos"] = "()";
			}*/

			crearMatrices();

			//Cálculo de kcal para cada comida
			calculo_kcal_dieta();

//echo " 2 " .time();
			//Generando la dieta
			generarDieta("", $link);
		}
		
//echo " 3 " .time();
		//Realizamos estimación del peso con el módulo de IA
		$_SESSION["labelPesoIA"] = estimacionPesoIA($_SESSION["id_cliente"], $_SESSION["num_dias"], $_SESSION["num_comidas"], $link);

		calculaSumaKcalDieta();

//echo " 4 " .time();

		generarEstadisticas();

		$_SESSION["semana"] = 1;

		if (isset($_SESSION["comida_copiada"]))
			unset($_SESSION["comida_copiada"]);
		desconectar($link);
	}

//echo " 5 " .time();

	if (isset($_GET["semana"]))
	{
		$_SESSION["semana"] = $_GET["semana"];
		echo recargarPagina("dieta.php");
	}

	if (isset($_GET["accion"]) && $_GET["accion"] == "mail")
	{
		$pdf = imprimir(false, false, false, true);

		$link = conectar();
		$cliente = getClienteById ($_SESSION["id_cliente"], $link);
		desconectar($link);
		$para = $cliente["email"];
		$nombre = $cliente["nombre"]." ".$cliente["apellidos"];
		$asunto = "i-Diet - mi dieta";

		$usuario = getUsuarioById ($_SESSION["id_usuario"]);
		$config = getConfiguracion($_SESSION["id_usuario"]);
	    $nombre_clinica = '<font color="#AEC91B">i-</font>Diet';
	    if ($row = $config->fetch_assoc())
	    {
	    	$nombre_clinica = $row["nombre"];
	    }
		$from = $usuario["email"];
		$separator = md5(time());
		$eol = PHP_EOL;
		$filename = "Mi dieta.pdf";
		$pdfdoc = $pdf->Output("", "S");
		$attachment = chunk_split(base64_encode($pdfdoc));
		$headers  = "From: ".$from.$eol;
		$headers .= "MIME-Version: 1.0".$eol;
		$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"".$eol.$eol;
		$msg = "Content-Transfer-Encoding: 7bit".$eol;
		//$msg .= "This is a MIME encoded message.".$eol.$eol;
		
		$mensaje ='
		<html>
			<head>
				<title>i-Diet - mi dieta</title>
			</head>
			<body>
			<h1 style="background-color: #57244C; color:white; padding: 10px; padding-left:25px;">'.$nombre_clinica.'</h1>

			<div style="color: #57244C; padding:25px; padding-bottom: 0; padding-top: 10px;">
				<p>
					'.$nombre.', puede encontrar su dieta como archivo adjunto.
				</p>
				<h2 style="font-family: idiet; margin-bottom: 20px;">
					Gracias por su confianza.
				</h2>

			</div>

			<h3 style="font-family: idiet; background-color: #57244C; color:white; padding: 5px; text-align:right; margin:0; padding-right: 40px;">
				<font color="#AEC91B">i-</font>Diet &copy;
			</h3>
			</body>
		</html>';

		$msg .= "--".$separator.$eol;
		$msg .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
		$msg .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
		$msg .= $mensaje.$eol.$eol;
		$msg .= "--".$separator.$eol;
		$msg .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol;
		$msg .= "Content-Transfer-Encoding: base64".$eol;
		$msg .= "Content-Disposition: attachment".$eol.$eol;
		$msg .= $attachment.$eol.$eol;
		$msg .= "--".$separator."--";
		if (mail($para, $asunto, $msg, $headers))
		{
			echo "<script>
				var txt = 'Dieta enviada con \u00e9xito a ".$nombre." (".$para.")';
				alert(txt);
			</script>";
			echo recargarPagina("dieta.php");
		}
	}

	if (isset($_GET["accion"]) && $_GET["accion"] == "recalcular")
	{
		$link = conectar();
		if ($_SESSION["es_plantilla"] == FALSE)
		{
			generarDieta("recalcular", $link);
		}
		else
		{
			generarDietaPlantilla("recalcular", $_SESSION["id_dieta"], $link);
		}
		desconectar($link);
		calculaSumaKcalDieta();
		generarEstadisticas();
		$_SESSION["semana"] = 1;
		echo recargarPagina("dieta.php");
	}

	if (isset($_GET["accion"]) && $_GET["accion"] == "copiar")
	{
		$_SESSION["comida_copiada"] = $_SESSION[$_GET["tipo"]][$_GET["indice"]];
		$_SESSION["tipo_comida_copiada"] = $_GET["tipo"];
		echo recargarPagina("dieta.php");
	}

	if (isset($_GET["accion"]) && $_GET["accion"] == "pegar")
	{
		if ($_SESSION[$_GET["tipo"]][$_GET["indice"]]->fijo == 1)
		{
			echo "<script>alert('No se puede pegar sobre un elemento bloqueado');</script>";
		}
		else
		{
			if (!isset($_SESSION["comida_copiada"]))
			{
				echo "<script>alert('Para poder pegar, antes debe copiar');</script>";
			}
			else if ($_GET["tipo"] != $_SESSION["tipo_comida_copiada"])
			{
				echo "<script>alert('No es posible copiar entre comidas diferentes');</script>";
			}
			else
			{
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->preparacion = $_SESSION["comida_copiada"]->preparacion;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->id_plato = $_SESSION["comida_copiada"]->id_plato;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->fijo = 0;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->peso = $_SESSION["comida_copiada"]->peso;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->kcal = $_SESSION["comida_copiada"]->kcal;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->hidratos = $_SESSION["comida_copiada"]->hidratos;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->grasa = $_SESSION["comida_copiada"]->grasa;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->proteinas = $_SESSION["comida_copiada"]->proteinas;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->nombre = $_SESSION["comida_copiada"]->nombre;
				
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->pc_porcentaje = $_SESSION["comida_copiada"]->pc_porcentaje;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->agua_g = $_SESSION["comida_copiada"]->agua_g;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->cal_kcal = $_SESSION["comida_copiada"]->cal_kcal;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->prot_g = $_SESSION["comida_copiada"]->prot_g;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->hc_g = $_SESSION["comida_copiada"]->hc_g;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->grasa_g = $_SESSION["comida_copiada"]->grasa_g;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->satur_g = $_SESSION["comida_copiada"]->satur_g;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->mono_g = $_SESSION["comida_copiada"]->mono_g;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->poli_g = $_SESSION["comida_copiada"]->poli_g;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->col_mg = $_SESSION["comida_copiada"]->col_mg;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->fibra_g = $_SESSION["comida_copiada"]->fibra_g;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->sodio_mg = $_SESSION["comida_copiada"]->sodio_mg;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->potasio_mg = $_SESSION["comida_copiada"]->potasio_mg;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->magnesio_mg = $_SESSION["comida_copiada"]->magnesio_mg;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->calcio_mg = $_SESSION["comida_copiada"]->calcio_mg;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->fosf_mg = $_SESSION["comida_copiada"]->fosf_mg;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->hierro_mg = $_SESSION["comida_copiada"]->hierro_mg;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->cloro_mg = $_SESSION["comida_copiada"]->cloro_mg;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->cinc_mg = $_SESSION["comida_copiada"]->cinc_mg;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->cobre_mg = $_SESSION["comida_copiada"]->cobre_mg;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->manganeso_mg = $_SESSION["comida_copiada"]->manganeso_mg;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->cromo_mg = $_SESSION["comida_copiada"]->cromo_mg;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->cobalto_mg = $_SESSION["comida_copiada"]->cobalto_mg;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->molibde_mg = $_SESSION["comida_copiada"]->molibde_mg;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->yodo_mg = $_SESSION["comida_copiada"]->yodo_mg;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->fluor_mg = $_SESSION["comida_copiada"]->fluor_mg;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->butirico_c4_0 = $_SESSION["comida_copiada"]->butirico_c4_0;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->caproico_c6_0 = $_SESSION["comida_copiada"]->caproico_c6_0;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->caprilico_c8_0 = $_SESSION["comida_copiada"]->caprilico_c8_0;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->caprico_c10_0 = $_SESSION["comida_copiada"]->caprico_c10_0;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->laurico_c12_0 = $_SESSION["comida_copiada"]->laurico_c12_0;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->miristico_c14_0 = $_SESSION["comida_copiada"]->miristico_c14_0;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->c15_0 = $_SESSION["comida_copiada"]->c15_0;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->c15_00 = $_SESSION["comida_copiada"]->c15_00;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->palmitico_c16_0 = $_SESSION["comida_copiada"]->palmitico_c16_0;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->c17_0 = $_SESSION["comida_copiada"]->c17_0;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->c17_00 = $_SESSION["comida_copiada"]->c17_00;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->estearico_c18_0 = $_SESSION["comida_copiada"]->estearico_c18_0;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->araquidi_c20_0 = $_SESSION["comida_copiada"]->araquidi_c20_0;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->behenico_c22_0 = $_SESSION["comida_copiada"]->behenico_c22_0;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->miristol_c14_1 = $_SESSION["comida_copiada"]->miristol_c14_1;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->palmitole_c16_1 = $_SESSION["comida_copiada"]->palmitole_c16_1;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->oleico_c18_1 = $_SESSION["comida_copiada"]->oleico_c18_1;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->eicoseno_c20_1 = $_SESSION["comida_copiada"]->eicoseno_c20_1;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->c22_1 = $_SESSION["comida_copiada"]->c22_1;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->linoleico_c18_2 = $_SESSION["comida_copiada"]->linoleico_c18_2;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->linoleni_c18_3 = $_SESSION["comida_copiada"]->linoleni_c18_3;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->c18_4 = $_SESSION["comida_copiada"]->c18_4;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->ara_ico_c20_4 = $_SESSION["comida_copiada"]->ara_ico_c20_4;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->c20_5 = $_SESSION["comida_copiada"]->c20_5;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->c22_5 = $_SESSION["comida_copiada"]->c22_5;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->c22_6 = $_SESSION["comida_copiada"]->c22_6;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->otrosatur0 = $_SESSION["comida_copiada"]->otrosatur0;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->otroinsat0 = $_SESSION["comida_copiada"]->otroinsat0;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->omega3_0 = $_SESSION["comida_copiada"]->omega3_0;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->etanol0 = $_SESSION["comida_copiada"]->etanol0;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->vit_a = $_SESSION["comida_copiada"]->vit_a;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->carotenos = $_SESSION["comida_copiada"]->carotenos;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->tocoferol = $_SESSION["comida_copiada"]->tocoferol;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->vit_d = $_SESSION["comida_copiada"]->vit_d;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->vit_b1 = $_SESSION["comida_copiada"]->vit_b1;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->vit_b2 = $_SESSION["comida_copiada"]->vit_b2;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->vit_b6 = $_SESSION["comida_copiada"]->vit_b6;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->niacina = $_SESSION["comida_copiada"]->niacina;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->ac_panto = $_SESSION["comida_copiada"]->ac_panto;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->biotina = $_SESSION["comida_copiada"]->biotina;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->folico = $_SESSION["comida_copiada"]->folico;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->b12 = $_SESSION["comida_copiada"]->b12;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->vit_c = $_SESSION["comida_copiada"]->vit_c;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->purinas = $_SESSION["comida_copiada"]->purinas;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->vit_k = $_SESSION["comida_copiada"]->vit_k;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->vit_e = $_SESSION["comida_copiada"]->vit_e;
				$_SESSION[$_GET["tipo"]][$_GET["indice"]]->oxalico = $_SESSION["comida_copiada"]->oxalico;
				
				calculaSumaKcalDieta();
				generarEstadisticas();
			}
		}
		echo recargarPagina("dieta.php");
	}

	if (isset($_GET["accion"]) && $_GET["accion"] == "copiar_todos")
	{
		$comida = $_SESSION[$_GET["tipo"]][$_GET["indice"]];
		$tipo = $_GET["tipo"];
		for ($i = 0; $i < $_SESSION["num_dias"]; $i++)
		{
			if ($_SESSION[$tipo][$i]->fijo == 0)
			{
				$_SESSION[$tipo][$i]->preparacion = $comida->preparacion;
				$_SESSION[$tipo][$i]->id_plato = $comida->id_plato;
				$_SESSION[$tipo][$i]->fijo = 0;
				$_SESSION[$tipo][$i]->peso = $comida->peso;
				$_SESSION[$tipo][$i]->kcal = $comida->kcal;
				$_SESSION[$tipo][$i]->hidratos = $comida->hidratos;
				$_SESSION[$tipo][$i]->grasa = $comida->grasa;
				$_SESSION[$tipo][$i]->proteinas = $comida->proteinas;
				$_SESSION[$tipo][$i]->nombre = $comida->nombre;

				$_SESSION[$tipo][$i]->pc_porcentaje = $comida->pc_porcentaje;
				$_SESSION[$tipo][$i]->agua_g = $comida->agua_g;
				$_SESSION[$tipo][$i]->cal_kcal = $comida->cal_kcal;
				$_SESSION[$tipo][$i]->prot_g = $comida->prot_g;
				$_SESSION[$tipo][$i]->hc_g = $comida->hc_g;
				$_SESSION[$tipo][$i]->grasa_g = $comida->grasa_g;
				$_SESSION[$tipo][$i]->satur_g = $comida->satur_g;
				$_SESSION[$tipo][$i]->mono_g = $comida->mono_g;
				$_SESSION[$tipo][$i]->poli_g = $comida->poli_g;
				$_SESSION[$tipo][$i]->col_mg = $comida->col_mg;
				$_SESSION[$tipo][$i]->fibra_g = $comida->fibra_g;
				$_SESSION[$tipo][$i]->sodio_mg = $comida->sodio_mg;
				$_SESSION[$tipo][$i]->potasio_mg = $comida->potasio_mg;
				$_SESSION[$tipo][$i]->magnesio_mg = $comida->magnesio_mg;
				$_SESSION[$tipo][$i]->calcio_mg = $comida->calcio_mg;
				$_SESSION[$tipo][$i]->fosf_mg = $comida->fosf_mg;
				$_SESSION[$tipo][$i]->hierro_mg = $comida->hierro_mg;
				$_SESSION[$tipo][$i]->cloro_mg = $comida->cloro_mg;
				$_SESSION[$tipo][$i]->cinc_mg = $comida->cinc_mg;
				$_SESSION[$tipo][$i]->cobre_mg = $comida->cobre_mg;
				$_SESSION[$tipo][$i]->manganeso_mg = $comida->manganeso_mg;
				$_SESSION[$tipo][$i]->cromo_mg = $comida->cromo_mg;
				$_SESSION[$tipo][$i]->cobalto_mg = $comida->cobalto_mg;
				$_SESSION[$tipo][$i]->molibde_mg = $comida->molibde_mg;
				$_SESSION[$tipo][$i]->yodo_mg = $comida->yodo_mg;
				$_SESSION[$tipo][$i]->fluor_mg = $comida->fluor_mg;
				$_SESSION[$tipo][$i]->butirico_c4_0 = $comida->butirico_c4_0;
				$_SESSION[$tipo][$i]->caproico_c6_0 = $comida->caproico_c6_0;
				$_SESSION[$tipo][$i]->caprilico_c8_0 = $comida->caprilico_c8_0;
				$_SESSION[$tipo][$i]->caprico_c10_0 = $comida->caprico_c10_0;
				$_SESSION[$tipo][$i]->laurico_c12_0 = $comida->laurico_c12_0;
				$_SESSION[$tipo][$i]->miristico_c14_0 = $comida->miristico_c14_0;
				$_SESSION[$tipo][$i]->c15_0 = $comida->c15_0;
				$_SESSION[$tipo][$i]->c15_00 = $comida->c15_00;
				$_SESSION[$tipo][$i]->palmitico_c16_0 = $comida->palmitico_c16_0;
				$_SESSION[$tipo][$i]->c17_0 = $comida->c17_0;
				$_SESSION[$tipo][$i]->c17_00 = $comida->c17_00;
				$_SESSION[$tipo][$i]->estearico_c18_0 = $comida->estearico_c18_0;
				$_SESSION[$tipo][$i]->araquidi_c20_0 = $comida->araquidi_c20_0;
				$_SESSION[$tipo][$i]->behenico_c22_0 = $comida->behenico_c22_0;
				$_SESSION[$tipo][$i]->miristol_c14_1 = $comida->miristol_c14_1;
				$_SESSION[$tipo][$i]->palmitole_c16_1 = $comida->palmitole_c16_1;
				$_SESSION[$tipo][$i]->oleico_c18_1 = $comida->oleico_c18_1;
				$_SESSION[$tipo][$i]->eicoseno_c20_1 = $comida->eicoseno_c20_1;
				$_SESSION[$tipo][$i]->c22_1 = $comida->c22_1;
				$_SESSION[$tipo][$i]->linoleico_c18_2 = $comida->linoleico_c18_2;
				$_SESSION[$tipo][$i]->linoleni_c18_3 = $comida->linoleni_c18_3;
				$_SESSION[$tipo][$i]->c18_4 = $comida->c18_4;
				$_SESSION[$tipo][$i]->ara_ico_c20_4 = $comida->ara_ico_c20_4;
				$_SESSION[$tipo][$i]->c20_5 = $comida->c20_5;
				$_SESSION[$tipo][$i]->c22_5 = $comida->c22_5;
				$_SESSION[$tipo][$i]->c22_6 = $comida->c22_6;
				$_SESSION[$tipo][$i]->otrosatur0 = $comida->otrosatur0;
				$_SESSION[$tipo][$i]->otroinsat0 = $comida->otroinsat0;
				$_SESSION[$tipo][$i]->omega3_0 = $comida->omega3_0;
				$_SESSION[$tipo][$i]->etanol0 = $comida->etanol0;
				$_SESSION[$tipo][$i]->vit_a = $comida->vit_a;
				$_SESSION[$tipo][$i]->carotenos = $comida->carotenos;
				$_SESSION[$tipo][$i]->tocoferol = $comida->tocoferol;
				$_SESSION[$tipo][$i]->vit_d = $comida->vit_d;
				$_SESSION[$tipo][$i]->vit_b1 = $comida->vit_b1;
				$_SESSION[$tipo][$i]->vit_b2 = $comida->vit_b2;
				$_SESSION[$tipo][$i]->vit_b6 = $comida->vit_b6;
				$_SESSION[$tipo][$i]->niacina = $comida->niacina;
				$_SESSION[$tipo][$i]->ac_panto = $comida->ac_panto;
				$_SESSION[$tipo][$i]->biotina = $comida->biotina;
				$_SESSION[$tipo][$i]->folico = $comida->folico;
				$_SESSION[$tipo][$i]->b12 = $comida->b12;
				$_SESSION[$tipo][$i]->vit_c = $comida->vit_c;
				$_SESSION[$tipo][$i]->purinas = $comida->purinas;
				$_SESSION[$tipo][$i]->vit_k = $comida->vit_k;
				$_SESSION[$tipo][$i]->vit_e = $comida->vit_e;
				$_SESSION[$tipo][$i]->oxalico = $comida->oxalico;
			}
		}
		calculaSumaKcalDieta();
		generarEstadisticas();
		echo recargarPagina("dieta.php");
	}

	if (isset($_GET["accion"]) && $_GET["accion"] == "bloquear")
	{
		if ($_SESSION[$_GET["tipo"]][$_GET["indice"]]->fijo == 0)
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->fijo = 1;
		else if ($_SESSION[$_GET["tipo"]][$_GET["indice"]]->fijo == 1)
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->fijo = 0;
		echo recargarPagina("dieta.php");
	}

	if (isset($_GET["accion"]) && $_GET["accion"] == "platoLibre")
	{
		if ($_SESSION[$_GET["tipo"]][$_GET["indice"]]->fijo == 1)
		{
			echo "<script>alert('No se puede modificar un elemento bloqueado');</script>";
		}
		else
		{
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->preparacion = $_SESSION["platoLibre"]->preparacion;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->id_plato = $_SESSION["platoLibre"]->id_plato;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->fijo = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->peso = $_SESSION["platoLibre"]->peso;
			//$_SESSION[$_GET["tipo"]][$_GET["indice"]]->kcal = $_SESSION[$_GET["tipo"]][$_GET["indice"]]->kcal;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->hidratos = $_SESSION["porcentaje_hidratos"];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->grasa = $_SESSION["porcentaje_grasas"];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->proteinas = $_SESSION["porcentaje_proteinas"];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->nombre = "Plato libre";
			
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->pc_porcentaje = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->agua_g = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->cal_kcal = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->prot_g = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->hc_g = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->grasa_g = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->satur_g = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->mono_g = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->poli_g = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->col_mg = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->fibra_g = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->sodio_mg = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->potasio_mg = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->magnesio_mg = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->calcio_mg = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->fosf_mg = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->hierro_mg = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->cloro_mg = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->cinc_mg = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->cobre_mg = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->manganeso_mg = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->cromo_mg = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->cobalto_mg = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->molibde_mg = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->yodo_mg = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->fluor_mg = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->butirico_c4_0 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->caproico_c6_0 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->caprilico_c8_0 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->caprico_c10_0 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->laurico_c12_0 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->miristico_c14_0 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->c15_0 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->c15_00 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->palmitico_c16_0 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->c17_0 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->c17_00 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->estearico_c18_0 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->araquidi_c20_0 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->behenico_c22_0 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->miristol_c14_1 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->palmitole_c16_1 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->oleico_c18_1 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->eicoseno_c20_1 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->c22_1 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->linoleico_c18_2 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->linoleni_c18_3 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->c18_4 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->ara_ico_c20_4 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->c20_5 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->c22_5 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->c22_6 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->otrosatur0 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->otroinsat0 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->omega3_0 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->etanol0 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->vit_a = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->carotenos = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->tocoferol = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->vit_d = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->vit_b1 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->vit_b2 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->vit_b6 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->niacina = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->ac_panto = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->biotina = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->folico = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->b12 = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->vit_c = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->purinas = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->vit_k = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->vit_e = 0;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->oxalico = 0;

			generarEstadisticas();
		}
		echo recargarPagina("dieta.php");
	}

	if (isset($_GET["accion"]) && $_GET["accion"] == "modificarPeso")
	{
		if ($_SESSION[$_GET["tipo"]][$_GET["indice"]]->fijo == 1)
		{
			echo "<script>alert('No se puede modificar un elemento bloqueado');</script>";
		}
		else if ($_SESSION[$_GET["tipo"]][$_GET["indice"]]->id_plato == $_SESSION["platoLibre"]->id_plato)
		{
			echo "<script>alert('No se puede modificar el peso de un plato libre');</script>";
		}
		else
		{
			$kcal_new = round($_GET["peso"] * ($_SESSION[$_GET["tipo"]][$_GET["indice"]]->kcal / $_SESSION[$_GET["tipo"]][$_GET["indice"]]->peso));
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->peso = $_GET["peso"];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->kcal = $kcal_new;
			$info = explode("g de ", $_SESSION[$_GET["tipo"]][$_GET["indice"]]->nombre);
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->nombre = $_GET["peso"] . "g de " . $info[1];
			calculaSumaKcalDieta();
			generarEstadisticas();
		}
		echo recargarPagina("dieta.php");
	}

	if (isset($_GET["accion"]) && $_GET["accion"] == "platoAlternativo")
	{
		if ($_SESSION[$_GET["tipo"]][$_GET["indice"]]->fijo == 1)
		{
			echo "<script>alert('No se puede modificar un elemento bloqueado');</script>";
		}
		else
		{
			$id_plato = $_GET["id_plato"];
			$plato = getPlatoById($id_plato);
			$plato = $plato->fetch_assoc();
			$kcal = $_SESSION[$_GET["tipo"]][$_GET["indice"]]->kcal;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->preparacion =  $plato['descripcion'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->id_plato = $id_plato;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->fijo = 0;
			$peso = ($kcal / $plato['kcal_por_100g']) * 100;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->peso = round($peso);
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->kcal = $kcal;
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->hidratos = $plato['hidratos'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->grasa = $plato['grasas'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->proteinas = $plato['proteinas'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->nombre = round($peso) . "g de " . $plato['nombre'];
			
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->pc_porcentaje = $plato['pc_porcentaje'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->agua_g = $plato['agua_g'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->cal_kcal = $plato['cal_kcal'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->prot_g = $plato['prot_g'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->hc_g = $plato['hc_g'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->grasa_g = $plato['grasa_g'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->satur_g = $plato['satur_g'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->mono_g = $plato['mono_g'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->poli_g = $plato['poli_g'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->col_mg = $plato['col_mg'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->fibra_g = $plato['fibra_g'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->sodio_mg = $plato['sodio_mg'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->potasio_mg = $plato['potasio_mg'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->magnesio_mg = $plato['magnesio_mg'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->calcio_mg = $plato['calcio_mg'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->fosf_mg = $plato['fosf_mg'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->hierro_mg = $plato['hierro_mg'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->cloro_mg = $plato['cloro_mg'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->cinc_mg = $plato['cinc_mg'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->cobre_mg = $plato['cobre_mg'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->manganeso_mg = $plato['manganeso_mg'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->cromo_mg = $plato['cromo_mg'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->cobalto_mg = $plato['cobalto_mg'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->molibde_mg = $plato['molibde_mg'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->yodo_mg = $plato['yodo_mg'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->fluor_mg = $plato['fluor_mg'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->butirico_c4_0 = $plato['butirico_c4_0'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->caproico_c6_0 = $plato['caproico_c6_0'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->caprilico_c8_0 = $plato['caprilico_c8_0'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->caprico_c10_0 = $plato['caprico_c10_0'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->laurico_c12_0 = $plato['laurico_c12_0'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->miristico_c14_0 = $plato['miristico_c14_0'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->c15_0 = $plato['c15_0'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->c15_00 = $plato['c15_00'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->palmitico_c16_0 = $plato['palmitico_c16_0'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->c17_0 = $plato['c17_0'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->c17_00 = $plato['c17_00'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->estearico_c18_0 = $plato['estearico_c18_0'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->araquidi_c20_0 = $plato['araquidi_c20_0'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->behenico_c22_0 = $plato['behenico_c22_0'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->miristol_c14_1 = $plato['miristol_c14_1'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->palmitole_c16_1 = $plato['palmitole_c16_1'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->oleico_c18_1 = $plato['oleico_c18_1'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->eicoseno_c20_1 = $plato['eicoseno_c20_1'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->c22_1 = $plato['c22_1'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->linoleico_c18_2 = $plato['linoleico_c18_2'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->linoleni_c18_3 = $plato['linoleni_c18_3'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->c18_4 = $plato['c18_4'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->ara_ico_c20_4 = $plato['ara_ico_c20_4'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->c20_5 = $plato['c20_5'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->c22_5 = $plato['c22_5'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->c22_6 = $plato['c22_6'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->otrosatur0 = $plato['otrosatur0'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->otroinsat0 = $plato['otroinsat0'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->omega3_0 = $plato['omega3_0'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->etanol0 = $plato['etanol0'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->vit_a = $plato['vit_a'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->carotenos = $plato['carotenos'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->tocoferol = $plato['tocoferol'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->vit_d = $plato['vit_d'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->vit_b1 = $plato['vit_b1'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->vit_b2 = $plato['vit_b2'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->vit_b6 = $plato['vit_b6'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->niacina = $plato['niacina'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->ac_panto = $plato['ac_panto'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->biotina = $plato['biotina'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->folico = $plato['folico'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->b12 = $plato['b12'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->vit_c = $plato['vit_c'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->purinas = $plato['purinas'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->vit_k = $plato['vit_k'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->vit_e = $plato['vit_e'];
			$_SESSION[$_GET["tipo"]][$_GET["indice"]]->oxalico = $plato['oxalico'];
			
			calculaSumaKcalDieta();
			generarEstadisticas();
		}
		echo recargarPagina("dieta.php");
	}

	if (isset($_GET["accion"]) && $_GET["accion"] == "guardar")
	{
		guardar_dieta();
		echo recargarPagina("dieta.php");
	}

	if (isset($_GET["accion"]) && $_GET["accion"] == "guardar_plantilla")
	{
		$id_dieta = guardar_dieta();
		guardar_plantilla($id_dieta, $_SESSION["id_usuario"], $_GET["plantilla"]);
		echo recargarPagina("dieta.php");
	}

	if (isset($_POST["accion"]) && $_POST["accion"] == "imprimir")
	{
		$introduccion = false;
		$mediciones = false;
		$version_reducida =false;
		if (isset($_POST["introduccion"]))
			$introduccion = true;
		if (isset($_POST["mediciones"]))
			$mediciones = true;
		if (isset($_POST["version_reducida"]))
			$version_reducida = true;
		imprimir($introduccion, $mediciones, $version_reducida, false);
		//echo recargarPagina("dieta.php");
	}

	$titulo = "Dieta (" .$_SESSION["fecha_inicio"]. ")";
	$activo= "inicio";
	//var_dump($_SESSION["grupo_dia"]);
	//var_dump($_SESSION["grupo_semana"]);

	echo includes();

	echo info_pagina($titulo);

	echo abrir_body();

	echo barra_superior();

	echo barra_lateral($activo);

	echo inicio_contenido();

	echo abrir_row();

	echo abrir_columnas(12);

	echo breadcrumb_dieta($titulo);

	$nombre_paciente = getNombreCompleto($_SESSION["id_cliente"]);

	echo tituloPaciente($nombre_paciente);

	echo tituloSemanaDieta($_SESSION["semana"], $_SESSION["num_semanas"]);
//echo " 6 " .time();
	echo cuerpo_dieta($_SESSION["semana"]);
//echo " 7 " .time();
	echo info_dieta();

	echo cerrar_columnas();

	echo cerrar_row();

	echo fin_contenido();

	echo cerrar_body();

	$_SESSION["prev"] = "dieta_3";

//echo " 10 " .time();
	}
?>
