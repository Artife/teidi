<?php
session_start();
include 'parts/conex.php';

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';


//Validamos que los datos del formulario estan llenos
if (!empty($_POST["id_cliente"])){	
	
	$id_cliente 	= $_POST["id_cliente"];
	//Datos Mediciones
	$bia_porc_grasa				= $_POST["bia_porc_grasa"];
	$bia_grasa_total			= $_POST["bia_grasa_total"];
	$bia_masa_grasa_total		= $_POST["bia_masa_grasa_total"];
	$bia_agua_total				= $_POST["bia_agua_total"];
	$bia_agua_intracelular		= $_POST["bia_agua_intracelular"];
	$bia_agua_extracelular		= $_POST["bia_agua_extracelular"];
	$bia_porc_masa_magra		= $_POST["bia_porc_masa_magra"];
	$bia_masa_muscular_total	= $_POST["bia_masa_muscular_total"];
	$bia_musc_brazo_dcho		= $_POST["bia_musc_brazo_dcho"];
	$bia_musc_brazo_izdo		= $_POST["bia_musc_brazo_izdo"];
	$bia_tronco					= $_POST["bia_tronco"];
	$bia_pierna_dcha			= $_POST["bia_pierna_dcha"];
	$bia_pierna_izda			= $_POST["bia_pierna_izda"];
	$bia_grasa_visceral			= $_POST["bia_grasa_visceral"];
	$perimetro_cefalico			= $_POST["perimetro_cefalico"];
	$perimetro_cuello			= $_POST["perimetro_cuello"];
	$perimetro_mesoesternal		= $_POST["perimetro_mesoesternal"];
	$perimetro_brazo_contraido	= $_POST["perimetro_brazo_contraido"];
	$perimetro_brazo_relajado	= $_POST["perimetro_brazo_relajado"];
	$perimetro_antebrazo		= $_POST["perimetro_antebrazo"];
	$perimetro_muneca			= $_POST["perimetro_muneca"];
	$perimetro_cadera			= $_POST["perimetro_cadera"];
	$perimetro_cintura			= $_POST["perimetro_cintura"];
	$perimetro_muslo			= $_POST["perimetro_muslo"];
	$perimetro_pantorrilla		= $_POST["perimetro_pantorrilla"];
	$perimetro_tobillo			= $_POST["perimetro_tobillo"];
	$ultrasonidos_grasa			= $_POST["ultrasonidos_grasa"];
	$ultrasonidos_grasa_total	= $_POST["ultrasonidos_grasa_total"];
	$ultrasonidos_masa_magra	= $_POST["ultrasonidos_masa_magra"];
	$infrarrojos_grasa			= $_POST["infrarrojos_grasa"];
	$infrarrojos_grasa_total	= $_POST["infrarrojos_grasa_total"];
	$infrarrojos_masa_magra		= $_POST["infrarrojos_masa_magra"];
	$plico_tricipital			= $_POST["plico_tricipital"];
	$plico_bicipital			= $_POST["plico_bicipital"];
	$plico_subescapular			= $_POST["plico_subescapular"];
	$plico_suprailiaco			= $_POST["plico_suprailiaco"];
	$plico_abdominal			= $_POST["plico_abdominal"];
	$plico_pectoral				= $_POST["plico_pectoral"];
	$plico_medioaxiliar			= $_POST["plico_medioaxiliar"];
	$plico_muslo 				= $_POST["plico_muslo"];
	$plico_pantorrilla			= $_POST["plico_pantorrilla"];
	$plico_suma_pliegues		= $_POST["plico_suma_pliegues"];
	$plico_porc_grasa			= $_POST["plico_porc_grasa"];
	$plico_total_grasa			= $_POST["plico_total_grasa"];
	$plico_masa_grasa			= $_POST["plico_masa_grasa"];
	$plico_densidad				= $_POST["plico_densidad"];
	
	$suma_todas_las_mediciones = 0;
	$suma_todas_las_mediciones = $bia_porc_grasa+$bia_grasa_total+$bia_masa_grasa_total+$bia_agua_total+$bia_agua_intracelular+$bia_agua_extracelular+$bia_porc_masa_magra+$bia_masa_muscular_total+$bia_musc_brazo_dcho+$bia_musc_brazo_izdo+$bia_tronco+$bia_pierna_dcha+$bia_pierna_izda+$bia_grasa_visceral+$perimetro_cefalico+$perimetro_cuello+$perimetro_mesoesternal+$perimetro_brazo_contraido+$perimetro_brazo_relajado+$perimetro_antebrazo+$perimetro_muneca+$perimetro_cadera+$perimetro_cintura+$perimetro_muslo+$perimetro_pantorrilla+$perimetro_tobillo+$ultrasonidos_grasa+$ultrasonidos_grasa_total+$ultrasonidos_masa_magra+$infrarrojos_grasa+$infrarrojos_grasa_total+$infrarrojos_masa_magra+$plico_tricipital+$plico_bicipital+$plico_subescapular+$plico_suprailiaco+$plico_abdominal+$plico_pectoral+$plico_medioaxiliar+$plico_muslo+$plico_pantorrilla+$plico_suma_pliegues+$plico_porc_grasa+$plico_total_grasa+$plico_masa_grasa+$plico_densidad;
	
	$fecha_de_alta		= date('d/m/Y');
	
	//Insertar mediciones si existe una nueva
	if($suma_todas_las_mediciones >= 1){
		ingresar_nueva_medicion_cliente ($id_cliente, $fecha_de_alta, $bia_porc_grasa, $bia_grasa_total, $bia_masa_grasa_total, $bia_agua_total, $bia_agua_intracelular, $bia_agua_extracelular, $bia_porc_masa_magra, $bia_masa_muscular_total, $bia_musc_brazo_dcho, $bia_musc_brazo_izdo, $bia_tronco, $bia_pierna_dcha, $bia_pierna_izda, $bia_grasa_visceral, $perimetro_cefalico, $perimetro_cuello, $perimetro_mesoesternal, $perimetro_brazo_contraido, $perimetro_brazo_relajado, $perimetro_antebrazo, $perimetro_muneca, $perimetro_cadera, $perimetro_cintura, $perimetro_muslo, $perimetro_pantorrilla, $perimetro_tobillo, $ultrasonidos_grasa, $ultrasonidos_grasa_total, $ultrasonidos_masa_magra, $infrarrojos_grasa, $infrarrojos_grasa_total, $infrarrojos_masa_magra, $plico_tricipital, $plico_bicipital, $plico_subescapular, $plico_suprailiaco, $plico_abdominal, $plico_pectoral, $plico_medioaxiliar, $plico_muslo, $plico_pantorrilla, $plico_suma_pliegues, $plico_porc_grasa, $plico_total_grasa, $plico_masa_grasa, $plico_densidad);
	}
	
	$_SESSION['mensaje'] = 'nuevo_cliente_creado';	
	header('location:'.$url_app.'asistente-paso-3/'.$id_cliente);	
	
	
}else{
	//en caso que esten vacios los datos del formulario reenviamos a la pagina
	$_SESSION['mensaje'] = 'datos_vacios_cliente';	
	header('location:'.$url_app.'asistente-paso-2');
}

?>