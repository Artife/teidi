<?php
session_start();
include 'parts/conex.php';
//ini_set('error_reporting', E_ALL);
//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include 'parts/consultas_mysql.php';


//Primera parte
$nombre						=	utf8_decode($_POST['nombre']);
$hidratos_porc				=	$_POST['hidratos_porc'];
$kcal_100g					=	$_POST['kcal_100g'];
$proteinas_porc				=	$_POST['proteinas_porc'];
$grupo						=	$_POST['grupo'];

$grasa_porc					=	$_POST['grasa_porc'];


//Segunda parte
$nombre_ing				=	$_POST['nombre_ing'];
$subgrupo				=	$_POST['subgrupo'];
$pc_porcentaje			=	$_POST['pc_porcentaje'];
$agua_g					=	$_POST['agua_g'];
$cal_kcal				=	$_POST['cal_kcal'];
$prot_g					=	$_POST['prot_g'];
$hc_g					=	$_POST['hc_g'];
$grasa_g				=	$_POST['grasa_g'];
$satur_g				=	$_POST['satur_g'];
$mono_g					=	$_POST['mono_g'];
$poli_g					=	$_POST['poli_g'];
$col_mg					=	$_POST['col_mg'];
$fibra_g				=	$_POST['fibra_g'];
$sodio_mg				=	$_POST['sodio_mg'];
$potasio_mg				=	$_POST['potasio_mg'];
$magnesio_mg			=	$_POST['magnesio_mg'];
$calcio_mg				=	$_POST['calcio_mg'];
$fosf_mg				=	$_POST['fosf_mg'];
$hierro_mg				=	$_POST['hierro_mg'];
$cloro_mg				=	$_POST['cloro_mg'];
$cinc_mg				=	$_POST['cinc_mg'];
$cobre_mg				=	$_POST['cobre_mg'];
$manganeso_mg			=	$_POST['manganeso_mg'];
$cromo_mg				=	$_POST['cromo_mg'];
$cobalto_mg				=	$_POST['cobalto_mg'];
$molibde_mg				=	$_POST['molibde_mg'];
$yodo_mg				=	$_POST['yodo_mg'];
$fluor_mg				=	$_POST['fluor_mg'];
$butirico_c4_0			=	$_POST['butirico_c4_0'];
$caproico_c6_0			=	$_POST['caproico_c6_0'];
$caprilico_c8_0			=	$_POST['caprilico_c8_0'];
$caprico_c10_0			=	$_POST['caprico_c10_0'];
$laurico_c12_0			=	$_POST['laurico_c12_0'];
$miristico_c14_0		=	$_POST['miristico_c14_0'];
$c15_0					=	$_POST['c15_0'];
$c15_00					=	$_POST['c15_00'];
$palmitico_c16_0		=	$_POST['palmitico_c16_0'];
$c17_0					=	$_POST['c17_0'];
$c17_00					=	$_POST['c17_00'];
$estearico_c18_0		=	$_POST['estearico_c18_0'];
$araquidi_c20_0			=	$_POST['araquidi_c20_0'];
$behenico_c22_0			=	$_POST['behenico_c22_0'];
$miristol_c14_1			=	$_POST['miristol_c14_1'];
$palmitole_c16_1		=	$_POST['palmitole_c16_1'];
$oleico_c18_1			=	$_POST['oleico_c18_1'];
$eicoseno_c20_1			=	$_POST['eicoseno_c20_1'];
$c22_1					=	$_POST['c22_1'];
$linoleico_c18_2		=	$_POST['linoleico_c18_2'];
$linoleni_c18_3			=	$_POST['linoleni_c18_3'];
$c18_4					=	$_POST['c18_4'];
$ara_ico_c20_4			=	$_POST['ara_ico_c20_4'];
$c20_5					=	$_POST['c20_5'];
$c22_5					=	$_POST['c22_5'];
$c22_6					=	$_POST['c22_6'];
$otrosatur0				=	$_POST['otrosatur0'];
$otroinsat0				=	$_POST['otroinsat0'];
$omega3_0				=	$_POST['omega3_0'];
$etanol0				=	$_POST['etanol0'];
$vit_a					=	$_POST['vit_a'];
$carotenos				=	$_POST['carotenos'];
$tocoferol				=	$_POST['tocoferol'];
$vit_d					=	$_POST['vit_d'];
$vit_b1					=	$_POST['vit_b1'];
$vit_b2					=	$_POST['vit_b2'];
$vit_b6					=	$_POST['vit_b6'];

$ac_panto				=	$_POST['ac_panto'];
$biotina				=	$_POST['biotina'];
$folico					=	$_POST['folico'];
$b12					=	$_POST['b12'];
$vit_c					=	$_POST['vit_c'];
$purinas				=	$_POST['purinas'];
$vit_k					=	$_POST['vit_k'];
$vit_e					=	$_POST['vit_e'];
$oxalico				=	$_POST['oxalico'];
$niacina				=	$_POST['niacina'];
 
//Datos sin valor
$hidratos = '';
$proteinas = '';
$grasa = '';

//Campo eliminado
//$nicotina				=	$_POST['nicotina'];

//Fecha
$fecha_creado = date('d-m-Y');

//Agregar la accion a la tabla de alimentos editados
$accion	= 'Nuevo';
//Grupos 
$id_supergrupos = ',';
foreach($_POST as $nombre_campo => $valor) 
{
	$agrupar_ids = substr($nombre_campo, 0, 6);    
	if($agrupar_ids == 'grupo_'){
	$id_supergrupos .=  $valor.','; 	
	}
}


if(!empty($nombre) || !empty($grupo)) {	
	//Crea alimento nuevo
	$_SESSION['mensaje'] = 'alimento_creado';	
	crear_nuevo_alimento ($_SESSION['id_usuario'], $nombre, $nombre_ing, $kcal_100g, $hidratos, $proteinas, $grasa, $grupo, $id_supergrupos, $proteinas_porc, $hidratos_porc, $grasa_porc, $subgrupo, $pc_porcentaje, $cal_kcal, $agua_g, $hc_g, $fibra_g, $prot_g, $grasa_g, $col_mg, $satur_g, $mono_g, $poli_g, $vit_a, $carotenos, $vit_b1, $vit_b2, $niacina, $ac_panto, $vit_b6, $biotina, $folico, $b12, $vit_c, $vit_d, $tocoferol, $vit_e, $vit_k, $oxalico, $purinas, $sodio_mg, $potasio_mg, $magnesio_mg, $calcio_mg, $fosf_mg, $hierro_mg, $cloro_mg, $cinc_mg, $cobre_mg, $manganeso_mg, $cromo_mg, $cobalto_mg, $molibde_mg, $yodo_mg, $fluor_mg, $butirico_c4_0, $caproico_c6_0, $caprilico_c8_0, $caprico_c10_0, $laurico_c12_0, $miristico_c14_0, $c15_0, $c15_00, $palmitico_c16_0, $c17_0, $c17_00, $estearico_c18_0, $araquidi_c20_0, $behenico_c22_0, $miristol_c14_1, $palmitole_c16_1, $oleico_c18_1, $eicoseno_c20_1, $c22_1, $linoleico_c18_2, $linoleni_c18_3, $c18_4, $ara_ico_c20_4, $c20_5, $c22_5, $c22_6, $otrosatur0, $otroinsat0, $omega3_0, $etanol0, $accion, $fecha_creado);					
	header('location:'.$url_app.'lista-alimentos');
	
}else{
	//Si los datos estan vacios
	$_SESSION['mensaje'] = 'datos_vacios';	
	header('location:'.$url_app.'nuevo-alimento');
}	

?>



