<?php
	session_start();
	require('../parts/conex.php');
	require_once('tcpdf/config/lang/eng.php');
	require_once('tcpdf/tcpdf.php');
	
	$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');
	include_once '../parts/configuracion.php';
	include_once '../parts/ayuda.php';
	include '../parts/consultas_mysql.php';
	
	
	//->Datos de la clinicas/
	$datos_clinica = datos_clinica();
	
	//->Datos del cliente
	$cliente = obtener_datos_cliente_x_usuario ($_GET['id']);	
	
	//->Obtener grupos excluidos
	$grupos_excludios = obtener_grupos_excluidos_x_cliente($id_cliente);
	
	//->Total grupos excluidos
	$total_grupos_exculidos = count($grupos_excludios);
	
	//->Obtener grupos
	$grupos_alimentos = mostrar_grupos_alimentos(); 
	
	//->Obtener alimentos excluidos
	$alimentos = obtener_alimentos_excluidos_x_cliente($id_cliente);
	
	//-> Nombre del archivo
	$nombre_archivo = 'Dieta | '.$cliente['nombre'].' '.$cliente['apellidos'].' Fecha: '.date('d-m-Y');
	
	$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
	$pdf->SetTitle($nombre_archivo); //Titlo del pdf
	$pdf->setPrintHeader(false); //No se imprime cabecera
	$pdf->setPrintFooter(false); //No se imprime pie de pagina
	$pdf->SetMargins(20, 20, 20, false); //Se define margenes izquierdo, alto, derecho
	$pdf->SetAutoPageBreak(true, 20); //Se define un salto de pagina con un limite de pie de pagina
	$pdf->addPage();
		
		$html_header .= '<!DOCTYPE html><html><head>
			<style>
			body {
			   color: #676a6c;
			}

			h1 {
			text-align: center;
			}

			p {
			font-family: verdana;
			font-size: 20px;
			}
			.medio {
				text-align: center;
			}
			.tc_azul{
				color: #0ea7f3;
			}
			.tt30{
				font-size: 100px;
			}
			p{
				font-size: 40px;
			}
			</style>
			</head>';
		$html .= $html_header;
		$html .= '<body>';			
			$html .= '<p class="medio"><img src="'.$url_app.'img/clinicas/'.$datos_clinica['logo'].'"></p>';
			$html .= '<h1>'.$datos_clinica['nombre'].'</h1>';
			$html .= '<h2 class="medio">'.$datos_clinica['direccion'].' - '.$datos_clinica['localidad'].'</h2>';			
			$html .= '<h3 class="medio">'.$datos_clinica['telefono'].'</h3>';
			$html .= '<p></p><p></p><p></p><p></p>';
			$html .= '<h1 class="medio tc_azul tt30">ESTUDIO <br> PERSONALIZADO</h1>';
			$html .= '<h1 class="medio tc_azul">'.$cliente['nombre'].' '.$cliente['apellidos'].'</h1>';
			$html .= '<p></p><p></p><p></p><p></p>';
			$html .= '<p></p><p></p><p></p><p></p>';
		$html .= '</body>';
		$html .= '</html>';
		
		
		$estados_y_necedidades ='';
		$estados_y_necedidades .= $html_header;
		$estados_y_necedidades .='<body>';
			$estados_y_necedidades .= '<h1>AVANZADO</h1>';
			$estados_y_necedidades .= '<h1>ESTADO Y NECESIDADES DEL PACIENTE</h1>';
			$estados_y_necedidades .= '<p><strong>Nombre del paciente:</strong> '.$cliente['nombre'].' '.$cliente['apellidos'].' </p>';
			$estados_y_necedidades .= '<p><strong>Fecha de nacimiento:</strong> '.$cliente['fecha_nacimiento'].' </p>';
			$estados_y_necedidades .= '<p><strong>Peso:</strong> '.$cliente['peso'].' Kg</p>';
			$estados_y_necedidades .= '<p><strong>Altura:</strong> '.$cliente['altura'].' cm</p>';
			$estados_y_necedidades .= '<p><strong>Actividad física:</strong> '.$cliente['actividad'].' </p>';
			$estados_y_necedidades .= '<p><strong>Índice de masa corporal:</strong> '.$cliente['imcf'].' </p>';
			$estados_y_necedidades .= '<p></p><p></p><p></p><p></p>';
			
			$estados_y_necedidades .= '<h2>Necesidades energéticas</h2>';
			$estados_y_necedidades .= '<p><strong>Metabolismo basal: </strong> '.$cliente['metabolismo'].' </p>';
			$estados_y_necedidades .= '<p><strong>Consumo por actividad física: </strong> '.($cliente['gasto_energetico'] - $cliente['metabolismo']).'  calorías diarias</p>';
			$estados_y_necedidades .= '<p><strong>Necesita en total '.$cliente['gasto_energetico'].' calorías para mantener su peso actual</strong></p>';
			$estados_y_necedidades .= '<p></p><p></p><p></p><p></p>';
			
			$estados_y_necedidades .= '<h2>Exclusiones realizadas</h2>';
			$estados_y_necedidades .= '<p><strong>Total Grupos excluidos: </strong> '.$total_grupos_exculidos .' </p>';
			$estados_y_necedidades .= '<p><strong>Grupos de alimentos: </strong> '.$grupos_alimentos[1]['grupo'];
				if($total_grupos_exculidos >= 1){
					for ($i = 1; $i <= count($grupos_alimentos); $i++) {
						if(!empty($grupos_alimentos[$i]['grupo'])){
							if (in_array($grupos_alimentos[$i]['grupo'], $grupos_excludios)) {
							$estados_y_necedidades .= utf8_encode($grupos_alimentos[$i]['grupo']).', ';
							}
						}
					}
				}
			$estados_y_necedidades .= '</p>';
			$estados_y_necedidades .= '<p><strong>Consumo por actividad física: </strong> '.($cliente['gasto_energetico'] - $cliente['metabolismo']).'  calorías diarias</p>';
			$estados_y_necedidades .= '<p><strong>Necesita en total '.$cliente['gasto_energetico'].' calorías para mantener su peso actual</strong></p>';
			
		$estados_y_necedidades .='</body>';

	$pdf->SetFont('Helvetica', '', 10);
	$pdf->writeHTML($html, true, 0, true, 0);
	$pdf->writeHTML($estados_y_necedidades, true, 0, true, 0);
	
	
	$pdf->lastPage();	
	$pdf->output($nombre_archivo, 'I');

	
	
	
?>
