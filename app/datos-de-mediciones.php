<?php
header('Cache-Control: no cache'); 
session_cache_limiter('private_no_expire');
session_start();
include 'parts/conex.php';
$pagina = 'Dieta ';
$migas = array('Datos del cliente mediciones');
$migas_url = array('Descargas');

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';


	//echo includes();
	require_once 'PHPExcel/Classes/PHPExcel.php';
	$objPHPExcel = new PHPExcel();

	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "DNI");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', "Nombre");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', "Apellidos");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', "Fecha");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', "BIA Porcentaje Grasa");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', "BIA Grasa Total");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', "BIA Masa Grasa Total");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', "BIA Agua Total");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', "BIA Agua Intracelular");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J1', "BIA Agua Extracelular");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K1', "BIA Porcentaje Masa Magra");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L1', "BIA Masa Muscular Total");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M1', "BIA Músculo Brazo Dcho");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N1', "BIA Músculo Brazo Izdo");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O1', "BIA Tronco");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P1', "BIA Pierna Dcha");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q1', "BIA Pierna Izda");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('R1', "BIA Grasa Visceral");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('S1', "Ultrasonidos Grasa");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('T1', "Ultrasonidos Grasa Total");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('U1', "Ultrasonidos Masa Magra");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('V1', "Infrarrojos Grasa");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('W1', "Infrarrojos Grasa Total");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('X1', "Infrarrojos Masa Magra");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Y1', "Plicometría Tricipital");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Z1', "Plicometría Bicipital");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA1', "Plicometría Subescapular");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB1', "Plicometría Suprailíaco");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC1', "Plicometría Abdominal");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AD1', "Plicometría Pectoral");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AE1', "Plicometría Medioaxilar");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AF1', "Plicometría Muslo");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AG1', "Plicometría Pantorrilla");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AH1', "Plicometría Suma Pliegues");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AI1', "Plicometría Porcentaje Grasa");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AJ1', "Plicometría Total Grasa");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AK1', "Plicometría Masa Grasa");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AL1', "Plicometría Densidad");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AM1', "Perímetro Cadera");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AN1', "Perímetro Cintura");
	
	// echo $_SESSION["id_usuario"];	
	$mediciones = obtener_mediciones_del_cliente_x_usuario();
	
	$i = 2;
	$f = 0;	
	for ($f = 0; $f <= count($mediciones); $f++) {	
		if(!empty($mediciones[$f]["dni"])){
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, $mediciones[$f]["dni"]);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i, $mediciones[$f]["nombre"]);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i, $mediciones[$f]["apellidos"]);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$i, $mediciones[$f]["fecha"]);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$i, $mediciones[$f]["bia_porc_grasa"]." %");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$i, $mediciones[$f]["bia_grasa_total"]." Kg");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$i, $mediciones[$f]["bia_masa_grasa_total"]." Kg");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$i, $mediciones[$f]["bia_agua_total"]." Kg");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$i, $mediciones[$f]["bia_agua_intracelular"]." Kg");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$i, $mediciones[$f]["bia_agua_extracelular"]." Kg");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$i, $mediciones[$f]["bia_porc_masa_magra"]." Kg");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$i, $mediciones[$f]["bia_masa_muscular_total"]." Kg");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$i, $mediciones[$f]["bia_musc_brazo_dcho"]." Kg");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$i, $mediciones[$f]["bia_musc_brazo_izdo"]." Kg");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$i, $mediciones[$f]["bia_tronco"]." Kg");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$i, $mediciones[$f]["bia_pierna_dcha"]." Kg");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$i, $mediciones[$f]["bia_pierna_izda"]." Kg");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.$i, $mediciones[$f]["bia_grasa_visceral"]." Kg");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.$i, $mediciones[$f]["ultrasonidos_grasa"]." %");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.$i, $mediciones[$f]["ultrasonidos_grasa_total"]." Kg");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('U'.$i, $mediciones[$f]["ultrasonidos_masa_magra"]." Kg");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.$i, $mediciones[$f]["infrarrojos_grasa"]." %");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('W'.$i, $mediciones[$f]["infrarrojos_grasa_total"]." Kg");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('X'.$i, $mediciones[$f]["infrarrojos_masa_magra"]." Kg");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Y'.$i, $mediciones[$f]["plico_tricipital"]." mm");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Z'.$i, $mediciones[$f]["plico_bicipital"]." mm");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA'.$i, $mediciones[$f]["plico_subescapular"]." mm");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB'.$i, $mediciones[$f]["plico_suprailiaco"]." mm");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC'.$i, $mediciones[$f]["plico_abdominal"]." mm");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AD'.$i, $mediciones[$f]["plico_pectoral"]." mm");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AE'.$i, $mediciones[$f]["plico_medioaxiliar"]." mm");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AF'.$i, $mediciones[$f]["plico_muslo"]." mm");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AG'.$i, $mediciones[$f]["plico_pantorrilla"]." mm");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AH'.$i, $mediciones[$f]["plico_suma_pliegues"]);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AI'.$i, $mediciones[$f]["plico_porc_grasa"]." %");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AJ'.$i, $mediciones[$f]["plico_total_grasa"]." Kg");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AK'.$i, $mediciones[$f]["plico_masa_grasa"]." Kg");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AL'.$i, $mediciones[$f]["plico_densidad"]);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AM'.$i, $mediciones[$f]["perimetro_cadera"]);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AN'.$i, $mediciones[$f]["perimetro_cintura"]); 
			$i++;	
		}
	}	
	
	// print_r($objPHPExcel);

	$fecha = date("d/m/Y");
	$filename = "Copia de seguridad Mediciones de Clientes _ ".$fecha.".xlsx";

	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="'.$filename.'"');
	header('Cache-Control: max-age=0');

	$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
	$objWriter->save('php://output');  

?>
