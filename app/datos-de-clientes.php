<?php
header('Cache-Control: no cache'); 
session_cache_limiter('private_no_expire');
session_start();
include 'parts/conex.php';
$pagina = 'Dieta ';
$migas = array('Datos del cliente');
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
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', "Sexo");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', "Peso");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', "Altura");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', "Metabolismo basal");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', "Gasto energético total");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', "Índice Masa Corporal");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J1', "Actividad");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K1', "Fecha de nacimiento");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L1', "E-mail");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M1', "Teléfono fijo");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N1', "Teléfono móvil");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O1', "Dirección");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P1', "Código postal");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q1', "Localidad");
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('R1', "Comentarios");
	
	
	$clientes = obtener_listado_clientes();
	
	$i = 2;
	$f = 0;
	
	for ($f = 0; $f <= count($clientes); $f++) { 
		if(!empty($clientes[$f]["email"])){
		$actividad = $clientes[$f]["actividad"];
		$sexo = $clientes[$f]["sexo"];
		$altura = $clientes[$f]["altura"];
		$peso = $clientes[$f]["peso"];

		$imcf = ($peso * 10000) / ($altura * $altura);
	    $metabolismo="";
	    $factor_actividad_hombre = 0;
	    $factor_actividad_mujer = 0;
	    $fecha_nacimiento = $clientes[$f]["fecha_nacimiento"];
	    $fecha_aux = explode("-", $fecha_nacimiento);
		$anio_nacimiento = $fecha_aux[0];
	    $anio = date("Y");
	    $edad = $anio - $anio_nacimiento;

	    if ($sexo == "Hombre")
	        $metabolismo = (66.5 + 13.74 * $peso + 5.03 * $altura - 6.75 * $edad);
	    else if ($sexo == "Mujer")
	        $metabolismo = (655.1 + 9.65 * $peso + 1.85 * $altura - 4.68 * $edad);

	    if ($actividad == "Reposo en cama")
	    {
	        $factor_actividad_hombre = 1;
	        $factor_actividad_mujer = 1;
	    }
	    else if ($actividad == "Ligera")
	    {
	        $factor_actividad_hombre = 1.55;
	        $factor_actividad_mujer = 1.56;
	    }
	    else if ($actividad == "Moderada")
	    {
	        $factor_actividad_hombre = 1.78;
	        $factor_actividad_mujer = 1.64;
	    }
	    else
	    {
	        $factor_actividad_hombre = 2.10;
	        $factor_actividad_mujer = 1.82;
	    }

	    if ($sexo == "Hombre")
	        $gasto_energetico = $metabolismo * $factor_actividad_hombre;
	    else
	        $gasto_energetico = $metabolismo * $factor_actividad_mujer;

		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, $clientes[$f]["dni"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i, $clientes[$f]["nombre"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i, $clientes[$f]["apellidos"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$i, $clientes[$f]["sexo"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$i, $clientes[$f]["peso"]." Kg");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$i, $clientes[$f]["altura"]." cm");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$i, $metabolismo);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$i, $gasto_energetico);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$i, $imcf);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$i, $clientes[$f]["actividad"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$i, $clientes[$f]["fecha_nacimiento"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$i, $clientes[$f]["email"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$i, $clientes[$f]["telefono_fijo"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$i, $clientes[$f]["telefono_movil"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$i, $clientes[$f]["direccion"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$i, $clientes[$f]["cp"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$i, $clientes[$f]["localidad"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.$i, strip_tags($clientes[$f]["comentarios"]));
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.$i, $clientes[$f]["fecha_de_alta"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.$i, $clientes[$f]["fecha_de_baja"]);

		$i++; 
		$f++;
		}
	}
	
	$fecha = date("d/m/Y");
	$filename = "Copia de seguridad Clientes _ ".$fecha.".xlsx";

	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="'.$filename.'"');
	header('Cache-Control: max-age=0');

	$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
	$objWriter->save('php://output'); 

?>
