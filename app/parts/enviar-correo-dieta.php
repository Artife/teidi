<?php
session_start();
require('../parts/conex.php');

$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');
include_once '../parts/configuracion.php';
include_once '../parts/ayuda.php';
include '../parts/consultas_mysql.php';

//->id cliente
$id_cliente = $_POST['id_cliente'];

$id_cliente = $_POST['id_cliente'];
$id_cliente = $_POST['id_cliente'];
$id_cliente = $_POST['id_cliente'];
$id_cliente = $_POST['id_cliente'];
$id_cliente = $_POST['id_cliente'];

//->Datos de la clinicas
$datos_clinica = datos_clinica();

//->Datos del cliente
$cliente = obtener_datos_cliente_x_usuario ($id_cliente);	

//->Obtener grupos excluidos
$grupos_excludios = obtener_grupos_excluidos_x_cliente($id_cliente);
	
//->Obtener grupos
$grupos_alimentos = mostrar_grupos_alimentos(); 

//->Total grupos excluidos
$total_grupos	= count($grupos_alimentos);

//->Obtener alimentos excluidos
$alimentos_excluidos = obtener_alimentos_excluidos_x_cliente($id_cliente);

//->Obtener alimentos
$alimentos_activos = listado_de_alimentos_completo(); 

//->Total alimentos excluidos
$total_alimentos  = count($alimentos_activos);


//->Historial de pesos
$historial_pesos_grafico = obtener_historial_peso_cliente ($id_cliente);

//->Obtener mediciones del cliente
$historial_pesos = obtener_ultima_medicion_del_cliente ($id_cliente);

//->Consultar la ultima dieta guardada	
$consulta_de_dieta = gx_consultar_ultima_dieta_guardada(); 

//-> Nombre del archivo
$nombre_archivo = 'Dieta | '.$cliente['nombre'].' '.$cliente['apellidos'].' Fecha: '.date('d-m-Y');

$_SESSION['imagen_ruta'] = $url_app.'img/clinicas/'.$datos_clinica['logo'];
$_SESSION['nombre_clinica'] = $datos_clinica['nombre'];

$_SESSION['paciente'] = $cliente['nombre'].', '.$cliente['apellidos'];

// Include the main TCPDF library (search for installation path).
require_once('../pdf-completo/lib/tcpdf.php');

class MYPDF extends TCPDF {

    //Page header
    public function Header() {  		
        // Title
		if ($this->page == 1) {
			 
		}else{
			// Logo		
			$image_file = $_SESSION['imagen_ruta'];
			
			$this->Image($image_file, 10, 0, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
			// Set font
			$this->SetFont('helvetica', 'B', 8);
			$this->Cell(0, 23, $_SESSION['nombre_clinica'], 0, false, 'R', 0, '', 0, false, 'T', 'M');
			// $this->Cell(0, 17, '<hr>', 0, false, 'R', 0, '', 0, false, 'T', 'M');
			$html = '<hr>';
			$this->writeHTMLCell($w = 0, $h = 0, $x = '', $y = 14, $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);
			// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
			
		}
    }

    // Page footer
    public function Footer() {
		 // Title
		if ($this->page == 1) {
			 
		}else{
			// Position at 15 mm from bottom
			$total = $this->getNumPages();		
			$total = $this->getAliasNbPages();
			$pagina_grupo =	$this->pagegroups;
			$this->SetY(-15);			
			
			$altura_pagina = $this->pagedim[$this->page]['h'];
			// Set font
			$this->SetFont('helvetica', 'I', 8);
			// Page number
			$html = '<hr>';
			
			if($altura_pagina < 800){
				$this->writeHTMLCell($w = 0, $h = 0, $x = '', $y = 200, $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'bottom', $autopadding = true);
				$this->Cell(0, 0, 'i-Diet '.date('Y').' - Paciente: '.$_SESSION['paciente'], 0, false, 'L', 0, '', 0, false, 'T', 'M');
				// $this->getAliasNumPage().'/'.$this->getAliasNbPages()
				$this->Cell(0, 0, 'Página '.$this->page.'/'.$total, 0, false, 'R', 0, '', 0, false, 'T', 'M');
			}else{
				$this->writeHTMLCell($w = 0, $h = 0, $x = '', $y = 285, $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'bottom', $autopadding = true);
				$this->Cell(0, 0, 'i-Diet '.date('Y').' - Paciente: '.$_SESSION['paciente'], 0, false, 'L', 0, '', 0, false, 'T', 'M');
				// $this->getAliasNumPage().'/'.$this->getAliasNbPages()
				$this->Cell(0, 0, 'Página '.$this->page.'/'.$total, 0, false, 'R', 0, '', 0, false, 'T', 'M');
			}
		}
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('i-Diet');
$pdf->SetTitle($nombre_archivo);
$pdf->SetSubject('i-Diet');
$pdf->SetKeywords('i-Diet');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 061', PDF_HEADER_STRING);

// set header and footer fonts
// $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
// $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(10, 20, 10, 20);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);
// $pdf->setPrintHeader(false);		
// $pdf->setPrintFooter(false);


// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------



/* NOTE:
 * *********************************************************
 * You can load external XHTML using :
 *
 * $html = file_get_contents('/path/to/your/file.html');
 *
 * External CSS files will be automatically loaded.
 * Sometimes you need to fix the path of the external CSS.
 * *********************************************************
 */

// define some HTML content with style		
		$html_header = '';
		$html_header .= '<!DOCTYPE html><html><head>
			<style>
			.text_center{
				text-align:center;
			}
			.texto_primario{
				color: #772e71;				
			}
			.line_gris {
				background-color: #d4c2d0;
			}
			.tr{
				text-align:right;
			}
			.super_tr{
				padding:8px;
			}
			.tabla_semana_1 {
				font-family: arial, sans-serif;
				border-collapse: collapse;
				width: 100%;
			}
			
			td, th {
				border: 2px solid #dddddd;
				text-align: left;
				padding: 8px;
			}

			tr:nth-child(even) {
				background-color: #dddddd;
			}
			body{
				text-align:justify;
			}
			</style>
			</head>';
			
		$portada = '';	
		$portada .= $html_header;
		$portada .= '<body>';			
			$portada .= '<p class="text_center"><img src="'.$url_app.'img/clinicas/'.$datos_clinica['logo'].'" style="width:500px"></p>';
			$portada .= '<h1 class="text_center">'.$datos_clinica['nombre'].'</h1>';
			$portada .= '<h2 class="text_center">'.$datos_clinica['direccion'].' - '.$datos_clinica['localidad'].'</h2>';			
			$portada .= '<h3 class="text_center">'.$datos_clinica['telefono'].'</h3>';			
			$portada .= '<h4 class="text_center texto_primario" style="font-size:30px;">ESTUDIO <br> PERSONALIZADO</h1>';
			$portada .= '<h1 class="text_center texto_primario">'.$cliente['nombre'].' '.$cliente['apellidos'].'</h1>';							
		$portada .= '</body>';
		$portada .= '</html>';	
		
		
		//->Introduccion
		$introduccion ='';
		$introduccion .= $html_header;		
		$introduccion .='<body class="introduccion">';			
		if($cliente['sexo'] == 'Hombre'){
			$introduccion .= '<h1 class="texto_primario">BIENVENIDO</h1>';
			$introduccion .= '<p><strong>Estimado '.$cliente['nombre'].' </strong></p>';
		}else{
			$introduccion .= '<h1 class="texto_primario">BIENVENIDA</h1>';
			$introduccion .= '<p><strong>Estimada '.$cliente['nombre'].' </strong></p>';
		}		
		$introduccion .= '<p>Usted acude a nosotros porque ha considerado que debe realizar un control sobre su alimentación,aprovechamos para darle la bienvenida y animarle a aprovechar esta oportunidad para mejorar de manera notoria su calidad de vida. No debe tener ninguna duda de que puede mejorar, tan solo necesita un poco de constancia y descubrirá un progreso importante en poco tiempo.</p>';		
		$introduccion .= '<p>Tanto los procedimientos para realizar los estudios antropomórficos como su resultado final, la dieta a realizar, siguen los parámetros marcados por las más importantes instituciones y entidades que trabajan en el campo de la nutrición tanto a nivel nacional como internacional. La Dieta proporcionada nada tiene que ver con las famosas "dietas milagro" con aparentes beneficios a corto plazo en términos de pérdidas de peso, pero que tienen efectos secundarios claramente nocivos para la salud y un conocido efecto rebote que hace que termine con más kilos de los que tenía antes de comenzar la dieta.</p>';		
		$introduccion .= '<p>Con nuestro asesoramiento tiene la oportunidad de cambiar sus hábitos alimenticios, mejorar su ingesta, incluso si lo desea descubrir nuevos platos que le pueden proporcionar una gran satisfacción personal, no debe pues ver la dieta como un proceso penoso y que le va a producir ansiedad, y que, incluso, va a hacer pasar hambre, la realidad es que es probable que coma más veces al día, con una alimentación más variada y más equilibrada. </p>';
		$introduccion .= '<p>El estudio que le entregamos le proporciona información sobre sus necesidades en proteínas, grasas, vitaminas, minerales y el resto de componentes que necesita para una correcta alimentación.</p>'; 	
		$introduccion .= '<p>Está dieta está realizada exclusivamente para usted, se corresponde con las necesidades detectadas a partir del estudio resultado de la antropometría que ha realizado en nuestra clínica, así como de sus gustos gastronómicos, no debe utilizar está información para terceras personas porque pueden tener necesidades completamente diferenciadas y por consiguiente ocasionar un perjuicio no deseable.</p>'; 						
		$introduccion .= '<p>Realizar deporte, con moderación, contribuye a obtener resultados en un menor tiempo, para ello no necesita ser un gran deportista, siempre que ninguna lesión o enfermedad le perjudique, caminar todos los días, entre 45 y 60 minutos a una velocidad media-alta contribuirá a mejorar su calidad de vida de una manera notoria.</p>';			
		$introduccion .= '<p>Le comentamos brevemente algunos puntos extractados del libro del Doctor Ramón de Cangas titulado "111 Mitos y leyendas Alimentarias" publicada por Ediciones Parnaso que le pueden ser de utilidad para seguir la dieta:</p>';
		$introduccion .= '<p class="texto_primario"><strong>A) Muchos creen: " Si quito la miga al pan, engorda menos"</strong></p>';
		$introduccion .= '<p>¿Quién no ha quitado alguna vez la miga al pan? Como vemos que la miga es pastosa, "harinosa" etc., creemos que quitándola ahuyentamos gran parte de los males del pan. En realidad ya hemos visto que el pan no aporta tantas Kilocalorías como pensábamos. Es la corteza - todo lo contrario a lo que la gente cree y no la miga, la que aporta más Kilocalorías.</p>';
		$introduccion .= '<p>¿Cómo es posible esto? Pues simplemente ocurre que la miga tiene más agua y aire que la corteza, y por eso (entre otras cosas) es más blanda y esponjosa. La corteza es más concentrada y a igualdad de peso aporta más calorías que la miga. </p>';
		$introduccion .= '<p>En definitiva: no quitemos la miga al pan. No son muchas las Kilocalorías que ahorro y me estoy privando de un placer. Tampoco quitemos la corteza porque el problema no es el pan, sino las salsas que mojo o lo que el pan lleva dentro.</p>';					
		$introduccion .= '</body>';
		$introduccion .= '</html>';
			
			
		$introduccion_2 ='';
		$introduccion_2 .= $html_header;		
		$introduccion_2 .='<body class="introduccion_2">';	
		$introduccion_2 .= '<p class="texto_primario"><strong>B) Dicen: " El aceite de oliva no engorda si es crudo" </strong></p>';			
		$introduccion_2 .= '<p>El aceite de oliva virgen extra es una buena fuente de Vitamina E y ciertas sustancias antioxidantes, es rico en grasas monoinsaturadas que son buenas para la salud, pero lo cierto es que un gramo de aceite de oliva, o de cualquier otro tipo de aceite, aporta unas 9 kilocalorías, sea crudo o tras someterlo a una fritura. La única diferencia es que en el proceso de las frituras se generan, entre otras cosas, los llamados compuestos polares que no son saludables y que hacen que después de usarlo varias veces el aceite se deba desechar, pero eso no tiene nada que ver con que sea preferible el crudo porque aporte menos</p>'; 			
		$introduccion_2 .= '<p>calorías. Además en el proceso de fritura se perderán sus antioxidantes etc. Pero crudo o cocinado un gramo de aceite aporta unas 9 kilocalorías, con lo que a poco que seamos generosos con su uso disparamos las Kilocalorías del plato. </p>';			
		$introduccion_2 .= '<p>1 gramo de aceite aporta 9 Kilocalorías. Se recomienda tomar entre 3-5 raciones de grasas al día. Un exceso de aceite, sea como sea, disparará la energía que ingerimos.</p>';	
		$introduccion_2 .= '<p class="texto_primario"><strong>C) Muchas veces hemos oído decir a alguien: " Me han dicho que tomar fruta antes de las comidas me hará adelgazar, pero que si la tomo después de la comida me engorda" </strong></p>';
		$introduccion_2 .= '<p>Es un mito muy extendido, pero la realidad es que la fruta se caracteriza por su alto contenido en agua. Debido a ello (unido a que apenas tiene grasa salvo el coco o el aguacate) su densidad energética no es demasiado alta. La fruta tiene las calorías que tiene sea tomada antes de comer, después de comer, o durante la comida. No hay ninguna razón que explique que la fruta engorde al tomarla después de comer. Se dice que tomada después de comer puede fermentar en el estómago, "fermentar", fermenta la leche gracias a las bacterias lácticas, o la cerveza en el proceso llevado a cabo por levaduras, pero hablar de una fermentación de la fruta en el estómago es una idea absurda.</p>';		
		$introduccion_2 .= '<p>Ingerir la fruta antes de comer el resto de alimentos no adelgaza. Únicamente puede existir una razón por la que se explique que hacer esto puede ayudar a algunas personas a controlar el peso y es el hecho de que si una persona se come la manzana antes de comer, sentirá plenitud y probablemente ingiera después menos cantidad del resto de los platos. Imaginemos que me voy a tomar una fabada asturiana de primero, un cordero asado con patatas fritas de segundo y una buena porción de tarta de queso con sirope de cacao de postre. Si yo me como dos manzanas y bebo un litro de agua un rato antes de la comida, está claro que después podré probablemente consumir la fabada, pero es muy probable que no pueda acabar el segundo plato (el cordero), o al menos con su guarnición (las patatas fritas) y me costará mucho poder consumir el postre, con lo que me ahorraré ingerir un buen puñado de Kilocalorías.</p>';
		$introduccion_2 .= '<p>Una pieza de fruta aporta exactamente las mismas Kilocalorías si la ingiero antes de comer, durante la comida, o después de la comida.</p>';
		$introduccion_2 .= '<p class="texto_primario"><strong>D) Muchas personas dicen: "El plátano engorda más que la mayoría de las frutas, por eso en muchas dietas te dan una manzana de postre y no un plátano". </strong></p>';
		$introduccion_2 .= '<p>Esta afirmación está muy extendida, incluso entre profesionales relacionados con el mundo sanitario. De hecho, en muchas dietas no se ofrecen plátanos ni uvas de postre. En verdad, retirar el plátano de las dietas hipocalóricas es absurdo y carente de toda lógica, y hacerlo significa no profundizar en la dietética lo suficiente, quedándose en una simple lectura superficial de las tablas de composición de alimentos. Y es que 100 gramos de plátano aportan más calorías que 100 gramos de manzana, sin embargo un plátano suele pesar unos 120 gramos (uno normal) y una manzana puede pesar fácilmente 230 gramos. 100 gramos de plátano son unas 90 Kilocalorías, mientras que 100 gramos de manzana aportan unas 52 kilocalorías. Si1 plátano equivale a 1 pieza de manzana. Podemos ver, por tanto, que es un error comparar los alimentos simplemente por su valor calórico por 100 gramos en las tablas de composición de alimentos. ¡ Debemos acostumbrarnos a comparar, entre las raciones habituales!.</p>';
		$introduccion_2 .= '</body>';
		$introduccion_2 .= '</html>';	
		//->Fin introduccion
		
		//-> medidas_caceras
		$medidas_caceras ='';
		$medidas_caceras .= $html_header;		
		$medidas_caceras .='<body class="medidas_caceras">';
			$medidas_caceras .= '<h1 class="text_center texto_primario">AYUDA PARA EL CÁLCULO DE LAS RACIONES: EQUIVALENCIA EN MEDIDAS CASERAS</h1>';				
			$medidas_caceras .= '<p>Con el fin de que usted pueda tener una buena aproximación del tamaño de las raciones les indicamos estas medidas, tal y como se realizan del modo tradicional, para poder estimar el tamaño de algunos ingredientes, para una medida precisa de los platos es necesario utilizar una báscula de cocina que le dará el peso ideal de cada componente de cada plato.</p>';
			$medidas_caceras .= '<p>Estos datos se basan en estimaciones realizadas por nuestro propio equipo de dietistas-nutricionistas Deben tener claro que son siempre valores aproximados. </p>';
			$medidas_caceras .= '<p>Algunos de los alimentos indicados con 0 gramos de peso, como las especias o el vinagre, son de libre utilización (salvo que por alguna patología su médico así se lo indique).</p>';
			$medidas_caceras .= '<table>
							  <tr class="line_gris">
								<th class="tpp titutlo_table" style="width:80%">MEDIDA CASERA</th>
								<th class="tpp titutlo_table tr" style="width:20%; text-align:center;">EQUIVALENCIA PESO EN GR</th>								
							  </tr>
							  <tr class="super_tr">
								<td>1 cucharada sopera de arroz</td>								
								<td class="tr tpp">17 gr</td>
							  </tr>
							  <tr class="line_gris">
								<td>1 cucharada sopera de aceite o azúcar</td>								
								<td class="tr">12 gr</td>
							  </tr>
							   <tr>
								<td>1 cucharada tamaño de café de aceite, cacao o azúcar o mantequilla</td>	 							
								<td class="tr">4 gr</td>
							  </tr>
							   <tr class="line_gris">
								<td>1/2 plato plano de pasta</td>								
								<td class="tr">80 gr</td>
							  </tr>
							   <tr>
								<td>1 cucharada sopera de queso de untar</td>								
								<td class="tr">22 gr</td>
							  </tr>
							   <tr class="line_gris">
								<td>Ración habitual de pescado: Un filete normal de lenguado, 2 rodajas de merluza pequeñas, una trucha pequeña</td>								
								<td class="tr">150 gr</td>
							  </tr>
							   <tr>
								<td>Ración recomendada de carne: Un filete pequeño de pavo, ternera, pollo, cerdo..</td>								
								<td class="tr">130 gr</td>
							  </tr>
							  <tr class="line_gris">
								<td>Un plato normal de legumbres </td>								
								<td class="tr">70 gr</td>
							  </tr>
							  <tr>
								<td>Un puñado de nueces, avellanas o almendras</td>								
								<td class="tr">35 gr</td>
							  </tr>
							  <tr class="line_gris">
								<td>Un tazón de leche de vaca</td>								
								<td class="tr">240 ml</td>
							  </tr>
							  <tr>
								<td>1 rebanada de queso ( loncha fina)</td>								
								<td class="tr">12 gr</td>
							  </tr>
							  <tr class="line_gris">
								<td>1 loncha de queso tipo tranchete</td>								
								<td class="tr">20 gr</td>
							  </tr>
							  <tr>
								<td>Un quesito tipo El Caserío </td>								
								<td class="tr">20 gr</td>
							  </tr>
							  <tr class="line_gris">
								<td>1 quesito minibabibel</td>								
								<td class="tr">20 gr</td>
							  </tr>
							  <tr>
								<td>Una loncha de pavo tipo finísimo de Campofrío</td>								
								<td class="tr">12 gr</td>
							  </tr>
							  <tr class="line_gris">
								<td>Una loncha de jamón serrano o york o mortadela </td>								
								<td class="tr">20 gr</td>
							  </tr>
							  <tr>
								<td>Una tarrina de yogurt frutas o natural o trozos de fruta</td>								
								<td class="tr">125 gr</td>
							  </tr>
							  <tr class="line_gris">
								<td>Una rebanada de pan blanco o integral </td>								
								<td class="tr">25 gr</td>
							  </tr>
							  <tr>
								<td>Una rebanada de pan de molde tipo silueta integral de Bimbo</td>								
								<td class="tr">20 gr</td>
							  </tr>
							   <tr class="line_gris">
								<td>Una lata pequeña de atún </td>								
								<td class="tr">56 gr</td>
							  </tr>
							  <tr>
								<td>Una cucharadita de café de sal </td>								
								<td class="tr">5 gr</td>
							  </tr>
							  <tr class="line_gris">
								<td>Un huevo mediano</td>								
								<td class="tr">55 gr</td>
							  </tr>
							  <tr>
								<td>Una taza de harina</td>								
								<td class="tr">25 gr</td>
							  </tr>
							  <tr class="line_gris">
								<td>Una cucharada sopera de harina</td>								
								<td class="tr">11 gr</td>
							  </tr>
							  <tr>
								<td>Una manzana mediana</td>								
								<td class="tr">160 gr</td>
							  </tr>
							  <tr class="line_gris">
								<td>Una pera grande</td>								
								<td class="tr">150 gr</td>
							  </tr>
							  <tr>
								<td>Una patata mediana </td>								
								<td class="tr">160 gr</td>
							  </tr>
							  <tr class="line_gris">
								<td>Una zanahoria mediana</td>								
								<td class="tr">110 gr</td>
							  </tr>
							  <tr>
								<td>Un tomate mediano</td>								
								<td class="tr">115 gr</td>
							  </tr>
							  <tr class="line_gris">
								<td>Una mandarina</td>								
								<td class="tr">85 gr</td>
							  </tr>
							  <tr>
								<td>Un limón mediano</td>								
								<td class="tr">90 gr</td>
							  </tr>
							  <tr class="line_gris">
								<td>Una tarrina de queso de Burgos tipo Arias</td>								
								<td class="tr">75 gr</td>
							  </tr>
							  <tr>
								<td>Una cebolla mediana</td>								
								<td class="tr">80 gr</td>
							  </tr>
							  <tr class="line_gris">
								<td>Una cucharada sopera de miel o mermelada</td>								
								<td class="tr">18 gr</td>
							  </tr>
							  <tr>
								<td>Un vasito de vino tinto o blanco</td>								
								<td class="tr">100 ml</td>
							  </tr>
							  <tr class="line_gris">
								<td>Una cucharada sopera de leche</td>								
								<td class="tr">15 ml</td>
							  </tr>
							  </table>';			
		$medidas_caceras .='</body>';
		$medidas_caceras .= '</html>';
		
		$medidas_caceras_2 ='';
		$medidas_caceras_2 .= $html_header;		
		$medidas_caceras_2 .='<body class="medidas_caceras"><br><br>';
		$medidas_caceras_2 .= '<table><tr>
								<td>Un plátano mediano (sin piel) </td>								
								<td class="tr">85 gr</td>
							  </tr><tr class="line_gris">
								<td>Una cereza</td>								
								<td class="tr">7 gr</td>
							  </tr>
							  <tr>
								<td>Una fresa</td>								
								<td class="tr">15 gr</td>
							  </tr>
							  <tr class="line_gris">
								<td>Un racimo de uvas</td>								
								<td class="tr">250 gr</td>
							  </tr>
							  <tr>
								<td>Una uva</td>								
								<td class="tr">20 gr</td>
							  </tr>
							  <tr class="line_gris">
								<td>Una tajada de sandía</td>								
								<td class="tr">200 gr</td>
							  </tr>
							  <tr>
								<td>Una tajada de melón</td>								
								<td class="tr">200 gr</td>
							  </tr>
							  <tr class="line_gris">
								<td>Un kiwi</td>								
								<td class="tr">90 gr</td>
							  </tr>
							  <tr>
								<td>Un muslo de pollo</td>								
								<td class="tr">250 gr con hueso<br>
								130 gr sin hueso</td>
							  </tr>
							  <tr class="line_gris">
								<td>Una tarrina de gelatina </td>								
								<td class="tr">100 gr</td>
							  </tr>
							  <tr>
								<td>Una cucharada sopera de leche condensada</td>								
								<td class="tr">21 gr</td>
							  </tr>
							  <tr class="line_gris">
								<td>Media taza de brécol</td>								
								<td class="tr">80 gr</td>
							  </tr>
							  <tr>
								<td>1 alcachofa</td>								
								<td class="tr">120 gr</td>
							  </tr>
							  <tr class="line_gris">
								<td>Un apio</td>								
								<td class="tr">120 gr</td>
							  </tr>
							  <tr>
								<td>Una naranja mediana</td>								
								<td class="tr">150 gr</td>
							  </tr>
							   <tr class="line_gris">
								<td>Una hamburguesa</td>								
								<td class="tr">100 gr</td>
							  </tr>
							   <tr>
								<td>1 caramelo</td>								
								<td class="tr">5 gr</td>
							  </tr>
							   <tr class="line_gris">
								<td>Una galleta María </td>								
								<td class="tr">6 gr</td>
							  </tr>
							   <tr>
								<td>Una alita de pollo</td>								
								<td class="tr">40 gr</td>
							  </tr>
							   <tr class="line_gris">
								<td>Un pimiento grande </td>								
								<td class="tr">270 gr</td>
							  </tr>							   
							</table>';			
		$medidas_caceras_2 .='</body>';
		$medidas_caceras_2 .= '</html>';			
		//->Fin medidas_caceras
		
		//->Estado del paciente
		$estados_y_necedidades ='';
		$estados_y_necedidades .= $html_header;
		$estados_y_necedidades .= $text_header;
		$estados_y_necedidades .='<body class="estados_y_necedidades">';
		$estados_y_necedidades .='<h1 class="texto_primario text_center">ESTADO Y NECESIDADES DEL PACIENTE</h1>';		
		$estados_y_necedidades .='<strong>Nombre del paciente: </strong>'.$cliente['nombre'].' '.$cliente['apellidos'].'<br>';
		$estados_y_necedidades .='<strong>Fecha de nacimiento: </strong>'.$cliente['fecha_nacimiento'].'<br>';
		$estados_y_necedidades .='<strong>Peso: </strong>'.$cliente['peso'].'Kg'.'<br>';
		$estados_y_necedidades .='<strong>Altura: </strong>'.$cliente['altura'].'cm'.'<br>';
		$estados_y_necedidades .='<strong>Actividad física: </strong>'.$cliente['actividad'].'<br>';
		$estados_y_necedidades .='<strong>Índice de masa corporal: </strong>'.$cliente['imcf'].'<br>';
		
		
	if(count($historial_pesos_grafico) >= 2){ 
		$estados_y_necedidades .='<h2>Historial de pesos</h2>';
		$estados_y_necedidades .='<img src="'.$url_app.'pdf-completo/generar-grafico-de-barras.php?id='.$id_cliente.'" />';	
		$estados_y_necedidades .='<p></p><p></p>';
	 } 
	$estados_y_necedidades .='<h2>Necesidades energéticas</h2>';
	$estados_y_necedidades .='<strong>Metabolismo basal: </strong>'.$cliente['metabolismo'].'<br />';
	$estados_y_necedidades .='<strong>Consumo por actividad física: </strong>'.($cliente['gasto_energetico'] - $cliente['metabolismo']).'calorías diarias<br />';
	$estados_y_necedidades .='<strong>Necesita en total '.$cliente['gasto_energetico'].'alorías para mantener su peso actual</strong></p>';
	
	$estados_y_necedidades .='<h2>Exclusiones realizadas</h2>';	
	$estados_y_necedidades .='<p style="text-align:justify;"><strong>Grupos de alimentos: </strong>';
	if(count($grupos_excludios) >= 1){
		for ($i = 0; $i <= $total_grupos; $i++) {
			if(!empty($grupos_alimentos[$i]['id_grupo'])){
				if (in_array($grupos_alimentos[$i]['id_grupo'], $grupos_excludios)) {
					$estados_y_necedidades .= utf8_encode($grupos_alimentos[$i]['grupo']).', ';
				}
			}
		}
	}  	
	$estados_y_necedidades .='</p>';	
	$estados_y_necedidades .='<p style="text-align:justify;"><strong>Alimentos: </strong>';
	for ($i = 0; $i <= $total_alimentos; $i++) {							
		if(!empty($alimentos_activos[$i]['id_definitivo'])){											
			if (in_array($alimentos_activos[$i]['id_definitivo'],  $alimentos_excluidos)) {								
				$estados_y_necedidades .= utf8_encode($alimentos_activos[$i]['nombre']).', ';							
			}
		}
	} 	
	$estados_y_necedidades .='</p>';
	$estados_y_necedidades .='</body>';
	$estados_y_necedidades .= '</html>';	
	
	
	
	//->Estado del paciente
	$recomendaciones_y_mediciones ='';
	$recomendaciones_y_mediciones .= $html_header;	
	$recomendaciones_y_mediciones .='<body class="recomendaciones_y_mediciones">';	
		if(!empty($recomendaciones)){
			$recomendaciones_y_mediciones .='<h1 class="texto_primario text_center">Recomendaciones: </h1>';		
		}
		if(!empty($historial_pesos)){
			$recomendaciones_y_mediciones .='<h1 class="texto_primario text_center">Última medición: </h1>';		
			if(!empty($historial_pesos["bia_porc_grasa"])) { $recomendaciones_y_mediciones .= 'Bia Grasa: '.$historial_pesos["bia_porc_grasa"].'%<<br />'; }
			if(!empty($historial_pesos["bia_grasa_total"])) { $recomendaciones_y_mediciones .= 'Bia Grasa Total: '.$historial_pesos["bia_grasa_total"].'kg<br />'; }
			if(!empty($historial_pesos["bia_masa_grasa_total"])) { $recomendaciones_y_mediciones .= 'Bia Masa Grasa Total: '.$historial_pesos["bia_masa_grasa_total"].'kg<br />'; }
			if(!empty($historial_pesos["bia_agua_total"])) { $recomendaciones_y_mediciones .= 'Bia Agua Total: '.$historial_pesos["bia_agua_total"].'kg</p>'; }
			if(!empty($historial_pesos["bia_agua_intracelular"])) { $recomendaciones_y_mediciones .= 'Bia Agua Intracelular: '.$historial_pesos["bia_agua_intracelular"].'kg<br />'; }
			if(!empty($historial_pesos["bia_agua_extracelular"])) { $recomendaciones_y_mediciones .= 'Bia Agua Extracelular: '.$historial_pesos["bia_agua_extracelular"].'kg<br />'; }					
			if(!empty($historial_pesos["bia_porc_masa_magra"])) { $recomendaciones_y_mediciones .= 'Bia Masa Magra: '.$historial_pesos["bia_porc_masa_magra"].'kg</p>'; }
			if(!empty($historial_pesos["bia_masa_muscular_total"])) { $recomendaciones_y_mediciones .= 'Bia Masa Muscular Total: '.$historial_pesos["bia_masa_muscular_total"].'kg<br />'; }
			if(!empty($historial_pesos["bia_musc_brazo_dcho"])) { $recomendaciones_y_mediciones .= 'Bia Músculo Brazo Dcho: '.$historial_pesos["bia_musc_brazo_dcho"].'kg<br />'; }
			if(!empty($historial_pesos["bia_musc_brazo_izdo"])) { $recomendaciones_y_mediciones .= 'Bia Músculo Brazo Izdo: '.$historial_pesos["bia_musc_brazo_izdo"].'kg<br />'; }
			if(!empty($historial_pesos["bia_tronco"])) { $recomendaciones_y_mediciones .= 'Bia Tronco: '.$historial_pesos["bia_tronco"].'</p>'; }
			if(!empty($historial_pesos["bia_pierna_dcha"])) { $recomendaciones_y_mediciones .= 'Bia Pierna Derecha: '.$historial_pesos["bia_pierna_dcha"].'kg<br />'; }
			if(!empty($historial_pesos["bia_pierna_izda"])) { $recomendaciones_y_mediciones .= 'Bia Pierna Izquierda: '.$historial_pesos["bia_pierna_izda"].'kg<br />'; }
			if(!empty($historial_pesos["bia_grasa_visceral"])) { $recomendaciones_y_mediciones .= 'Bia Grasa Visceral: '.$historial_pesos["bia_grasa_visceral"].'kg<br /><br />'; }
			
			if(!empty($historial_pesos["perimetro_cefalico"])) { $recomendaciones_y_mediciones .= 'Perímetro Cefálico: '.$historial_pesos["perimetro_cefalico"].'%<br />'; }
			if(!empty($historial_pesos["perimetro_cuello"])) { $recomendaciones_y_mediciones .= 'Perímetro Cuello: '.$historial_pesos["perimetro_cuello"].'kg<br />'; }
			if(!empty($historial_pesos["perimetro_mesoesternal"])) { $recomendaciones_y_mediciones .= 'Perímetro Mesoesternal: '.$historial_pesos["perimetro_mesoesternal"].'kg<br />'; }
			if(!empty($historial_pesos["perimetro_brazo_contraido"])) { $recomendaciones_y_mediciones .= 'Perímetro Brazo contraído: '.$historial_pesos["perimetro_brazo_contraido"].'kg<br />'; }
			if(!empty($historial_pesos["perimetro_brazo_relajado"])) { $recomendaciones_y_mediciones .= 'Perímetro Brazo relajado: '.$historial_pesos["perimetro_brazo_relajado"].'kg<br />'; }
			if(!empty($historial_pesos["perimetro_antebrazo"])) { $recomendaciones_y_mediciones .= 'Perímetro Antebrazo: '.$historial_pesos["perimetro_antebrazo"].'kg<br />'; }
			if(!empty($historial_pesos["perimetro_muneca"])) { $recomendaciones_y_mediciones .= 'Perímetro Muñeca: '.$historial_pesos["perimetro_muneca"].'kg<br />'; }
			if(!empty($historial_pesos["perimetro_cadera"])) { $recomendaciones_y_mediciones .= 'Perímetro Cadera: '.$historial_pesos["perimetro_cadera"].'kg<br />'; }
			if(!empty($historial_pesos["perimetro_cintura"])) { $recomendaciones_y_mediciones .= 'Perímetro Cintura: '.$historial_pesos["perimetro_cintura"].'kg<br />'; }
			if(!empty($historial_pesos["perimetro_muslo"])) { $recomendaciones_y_mediciones .= 'Perímetro Muslo: '.$historial_pesos["perimetro_muslo"].'<br />'; }
			if(!empty($historial_pesos["perimetro_pantorrilla"])) { $recomendaciones_y_mediciones .= 'Perímetro Pantorrilla: '.$historial_pesos["perimetro_pantorrilla"].'kg<br />'; }
			if(!empty($historial_pesos["perimetro_tobillo"])) { $recomendaciones_y_mediciones .= 'Perímetro Tobillo: '.$historial_pesos["perimetro_tobillo"].'kg<br /><br />'; }
			
			if(!empty($historial_pesos["ultrasonidos_grasa"])) { $recomendaciones_y_mediciones .= 'Ultrasonidos Grasa: '.$historial_pesos["ultrasonidos_grasa"].'%<br />'; }
			if(!empty($historial_pesos["ultrasonidos_grasa_total"])) { $recomendaciones_y_mediciones .= 'Ultrasonidos Grasa Total: '.$historial_pesos["ultrasonidos_grasa_total"].'kg<br />'; }
			if(!empty($historial_pesos["ultrasonidos_masa_magra"])) { $recomendaciones_y_mediciones .= 'Ultrasonidos Masa Magra Total: '.$historial_pesos["ultrasonidos_masa_magra"].'kg<br /><br />'; }
			
			if(!empty($historial_pesos["infrarrojos_grasa"])) { $recomendaciones_y_mediciones .= 'Infrarrojos Grasa: '.$historial_pesos["infrarrojos_grasa"].'<br />'; }
			if(!empty($historial_pesos["infrarrojos_grasa_total"])) { $recomendaciones_y_mediciones .= 'Infrarrojos Grasa Total: '.$historial_pesos["infrarrojos_grasa_total"].'<br />'; }
			if(!empty($historial_pesos["infrarrojos_masa_magra"])) { $recomendaciones_y_mediciones .= 'Infrarrojos Masa Magra Total: '.$historial_pesos["infrarrojos_masa_magra"].'<br /><br />'; }
			
			if(!empty($historial_pesos["plico_tricipital"])) { $recomendaciones_y_mediciones .= '<p>Plicometría Tricipital: '.$historial_pesos["plico_tricipital"].'</p>'; }
			if(!empty($historial_pesos["plico_bicipital"])) { $recomendaciones_y_mediciones .= '<p>Plicometría Bicipital: '.$historial_pesos["plico_bicipital"].'</p>'; }
			if(!empty($historial_pesos["plico_subescapular"])) { $recomendaciones_y_mediciones .= '<p>Plicometría Subescapular: '.$historial_pesos["plico_subescapular"].'</p>'; }
			if(!empty($historial_pesos["plico_suprailiaco"])) { $recomendaciones_y_mediciones .= '<p>Plicometría Suprailíaco: '.$historial_pesos["plico_suprailiaco"].'</p>'; }
			if(!empty($historial_pesos["plico_abdominal"])) { $recomendaciones_y_mediciones .= '<p>Plicometría Abdominal: '.$historial_pesos["plico_abdominal"].'</p>'; }
			if(!empty($historial_pesos["plico_pectoral"])) { $recomendaciones_y_mediciones .= '<p>Plicometría Pectoral: '.$historial_pesos["plico_pectoral"].'</p>'; }
			if(!empty($historial_pesos["plico_medioaxiliar"])) { $recomendaciones_y_mediciones .= '<p>Plicometría Medioaxilar: '.$historial_pesos["plico_medioaxiliar"].'</p>'; }
			if(!empty($historial_pesos["plico_muslo"])) { $recomendaciones_y_mediciones .= '<p>Plicometría Muslo: '.$historial_pesos["plico_muslo"].'</p>'; }
			if(!empty($historial_pesos["plico_pantorrilla"])) { $recomendaciones_y_mediciones .= '<p>Plicometría Pantorrilla: '.$historial_pesos["plico_pantorrilla"].'</p>'; }
			if(!empty($historial_pesos["plico_suma_pliegues"])) { $recomendaciones_y_mediciones .= '<p>Plicometría Suma Pliegues: '.$historial_pesos["plico_suma_pliegues"].'</p>'; }
			if(!empty($historial_pesos["plico_porc_grasa"])) { $recomendaciones_y_mediciones .= '<p>Plicometría Grasa: '.$historial_pesos["plico_porc_grasa"].'</p>'; }
			if(!empty($historial_pesos["plico_total_grasa"])) { $recomendaciones_y_mediciones .= '<p>Plicometría Total Grasa: '.$historial_pesos["plico_total_grasa"].'</p>'; }
			if(!empty($historial_pesos["plico_masa_grasa"])) { $recomendaciones_y_mediciones .= '<p>Plicometría Total Masa Magra: '.$historial_pesos["plico_masa_grasa"].'</p>'; }
			if(!empty($historial_pesos["plico_densidad"])) { $recomendaciones_y_mediciones .= '<p>Plicometría Densidad: '.$historial_pesos["plico_densidad"].'</p>'; }					
		}						
	$recomendaciones_y_mediciones .='</body>';
	$recomendaciones_y_mediciones .= '</html>';
	
	
	//->lista vertical de la dieta
	$lista_vertical_dieta ='';
	$lista_vertical_dieta .= $html_header;	
	$lista_vertical_dieta .='<body class="recomendaciones_y_mediciones">';		
	$lista_vertical_dieta .= strip_tags(html_entity_decode($consulta_de_dieta['dieta_vertical']), '<strong><h1><h2><br>');	
	$lista_vertical_dieta .='</body>';
	$lista_vertical_dieta .= '</html>';
	
	
	//->lista lista_horizontal_dieta
	$lista_horizontal_dieta ='';
	$lista_horizontal_dieta .= $html_header;	
	$lista_horizontal_dieta .='<body class="recomendaciones_y_mediciones">';		
	$lista_horizontal_dieta .= strip_tags(html_entity_decode($consulta_de_dieta['dieta_plantilla']), '<table><td><tr><th>');	
	$lista_horizontal_dieta .='</body>';
	$lista_horizontal_dieta .= '</html>';
	

		//->Fin Estado del paciente
// set font
$pdf->SetFont('helvetica', '', 10);
$pdf->startPageGroup();
// add a page
$pdf->AddPage();		
// output the HTML content
$pdf->writeHTML($portada, true, false, true, false, '');

//-> Introduccion
$pdf->AddPage();
$pdf->writeHTML($introduccion, true, false, true, false, '');
$pdf->AddPage();
$pdf->writeHTML($introduccion_2, true, false, true, false, '');
//->Medidas Caseras
$pdf->AddPage();
$pdf->writeHTML($medidas_caceras, true, false, true, false, '');
$pdf->AddPage();
$pdf->writeHTML($medidas_caceras_2, true, false, true, false, '');
//->Medidas Caseras

//->Estado del paciente
$pdf->AddPage();
$pdf->writeHTML($estados_y_necedidades, true, false, true, false, '');


//->recomendaciones_y_mediciones
$pdf->AddPage();
$pdf->writeHTML($recomendaciones_y_mediciones, true, false, true, false, '');


//->lista_vertical_dieta
// $pdf->AddPage();
// $pdf->writeHTML($lista_vertical_dieta, true, false, true, false, '');

for ($i = 1; $i <= $consulta_de_dieta['duracion']; $i++) {
	
	$buscar = 'pdfc_dia_'.$i;
	$buscar_fin = 'pdfc_dia_fin_'.$i;
	$pos_1 	 = strpos($consulta_de_dieta['dieta_vertical'], $buscar);
	$pos_1 = $pos_1+20;
	$pos_fin = strpos($consulta_de_dieta['dieta_vertical'], $buscar_fin);
	$pos_2 = $pos_fin-$pos_1;
	$mostrar = substr($consulta_de_dieta['dieta_vertical'], $pos_1, $pos_2);
	
	
	$lista_vertical_dieta ='';
	$lista_vertical_dieta .= $html_header;	
	$lista_vertical_dieta .='<body class="recomendaciones_y_mediciones">';		
	$lista_vertical_dieta .= strip_tags(html_entity_decode($mostrar), '<strong><h1><h2><br>');	
	$lista_vertical_dieta .='</body>';
	$lista_vertical_dieta .= '</html>';	
	
	$pdf->AddPage();
	$pdf->writeHTML($lista_vertical_dieta, true, false, true, false, '');	
	
 
}

$total_semanas = $consulta_de_dieta['duracion']/7;
$total_semanas_sliders = ceil($total_semanas);

for ($i = 1; $i <= $total_semanas_sliders; $i++) {
	
	$buscar = 'tabla_semana_'.$i;
	$buscar_fin = '</table></div>';
	$pos_1 	 = strpos($consulta_de_dieta['dieta_plantilla'], $buscar);
	$pos_1 = $pos_1-84;
	
	$pos_fin = strpos($consulta_de_dieta['dieta_plantilla'], $buscar_fin, $i-1);
	$pos_2 = $pos_fin-$pos_1;
	$pos_2 = $pos_2+120;
	
	 
	
	
	
	$mostrar = substr($consulta_de_dieta['dieta_plantilla'], $pos_1, $pos_2);
	$mostrar = html_entity_decode($mostrar);
	$mostrar = str_replace('<span class="gramos_title">g</span>', '', $mostrar);
	$mostrar = preg_replace('/<p class="gramos">(.*?)<\/p>/', '', $mostrar);
	$mostrar = preg_replace('/<th class="pdf_eliminar">(.*?)<\/th>/', '', $mostrar);
	
	
	
	 
	// $mostrar = str_replace($mostrar,  "black", "<body text='%body%'>");
	
	$pos_g_1 =  strpos($mostrar, 'gramos_title');
	
	$lista_horizontal_dieta ='';
	$lista_horizontal_dieta .= $html_header;	
	$lista_horizontal_dieta .='<body class="recomendaciones_y_mediciones">';		
	$lista_horizontal_dieta .='<h1 class="text_center texto_primario">Semana '.$i.' de '.$total_semanas_sliders.'</h1>';
	// $lista_horizontal_dieta .= $mostrar;	
	// $lista_horizontal_dieta .= html_entity_decode($mostrar);	
	$lista_horizontal_dieta .= strip_tags($mostrar, '<table><td><tr><th><br><tfoot><thead><tbody>');	
	$lista_horizontal_dieta .='</body>';
	$lista_horizontal_dieta .= '</html>';
	
	// print_r(html_entity_decode($lista_horizontal_dieta));
	//->lista_horizontal_dieta
	$pdf->startPageGroup();
	$pdf->SetFooterData('pagina_horizontal');
	$pdf->AddPage('L', 'A4');
	$pdf->writeHTML($lista_horizontal_dieta, true, false, true, false, '');
	

}



//-> Lista de la compra
$pdf->startPageGroup();

$lista_de_la_compra ='';
$lista_de_la_compra .= $html_header;	
$lista_de_la_compra .='<body class="recomendaciones_y_mediciones">';		
$lista_de_la_compra .='<h1 class="text_center texto_primario">Lista de la compra</h1>';
$lista_de_la_compra .= html_entity_decode($consulta_de_dieta['lista_definitiva_alimentos']);
$lista_de_la_compra .='</body>';
$lista_de_la_compra .= '</html>';
	
	
$pdf->AddPage('P', 'A4');
$pdf->writeHTML($lista_de_la_compra, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
// $fileatt = $pdf->Output($nombre_archivo.'.pdf', 'E');
// $filename = $pdf->Output($_SERVER['DOCUMENT_ROOT'].'app/all-pdf/prue.pdf', 'F');

//============================================================+
// END OF FILE
//============================================================+
$nombre = $cliente['nombre'];
$nombre_clinica = $datos_clinica['nombre'];
// $from = $usuario["email"];
$from = 'artife@gmail.com';
$para =  'artife@gmail.com';
$asunto = $datos_clinica['nombre'].': Mi Dieta';
$separator = md5(time());
$eol = PHP_EOL;
$filename = "Mi dieta.pdf";
$pdfdoc = $pdf->Output("", "S");
$attachment = chunk_split(base64_encode($pdfdoc));
$headers  = "From: ".$from.$eol;
$headers .= "MIME-Version: 1.0".$eol;
$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"".$eol.$eol;
$msg = "Content-Transfer-Encoding: 7bit".$eol;

$mensaje ='
<html>
	<head>
		<title>i-Diet - mi dieta</title>
	</head>
	<body>
	<h1 style="background-color: #57244C; color:white; padding: 10px; padding-left:25px;">'.$nombre_clinica.'</h1>
	<div style="color: #57244C; padding:25px; padding-bottom: 0; padding-top: 10px;">
	<p>'.$nombre.', puede encontrar su dieta como archivo adjunto.</p>
		<h2 style="font-family: idiet; margin-bottom: 20px;">Gracias por su confianza.</h2>
	</div>
	<h3 style="font-family: idiet; background-color: #57244C; color:white; padding: 5px; text-align:right; margin:0; padding-right: 40px;"><font color="#AEC91B">i-</font>Diet &copy;</h3>
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
if (mail($para, $asunto, $msg, $headers)){
	echo $mostrar_mensaje='
	<div class="ibox-content">
		<div class="row">
			<div class="col-lg-12">				
				<h1 class="ok text-center"><strong>El correo fue enviado con éxito</strong></h1>
			</div>
		</div>
	</div><br><br>';
}else{
	echo $mostrar_mensaje='
	<div class="ibox-content">
		<div class="row">
			<div class="col-lg-12">				
				<h1 class="ok text-center"><strong>Error en el envío</strong></h1>
			</div>
		</div>
	</div><br><br>';
}		
?>
