<?php
	session_start();
	require('../parts/conex.php');
	require_once('tcpdf/config/lang/eng.php');
	require_once('tcpdf/tcpdf.php');
	// require_once('html2pdf.class.php');
	
	$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');
	include_once '../parts/configuracion.php';
	include_once '../parts/ayuda.php';
	include '../parts/consultas_mysql.php';
	
	//->id cliente
	$id_cliente = $_GET['id'];
	
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
	
	//-<Consultar la ultima dieta guardada	
	$consulta_de_dieta = gx_consultar_ultima_dieta_guardada(); 
	
	//-> Nombre del archivo
	$nombre_archivo = 'Dieta | '.$cliente['nombre'].' '.$cliente['apellidos'].' Fecha: '.date('d-m-Y');
	
	//->caratula (obligatorio)
	//introduccion
	//equivalencias medidas caceras
	//->Estado del paciente (obligatorio)
	//mediciones
	//->Texto escrito por el doctor (obl)
	//Dieta por dias  (obl) //->varia forma de cocinarlo
	//Dieta recuadro  (obl)
	//lista compra
	
	
	$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
	$pdf->SetTitle($nombre_archivo); //Titlo del pdf	
	$pdf->setPrintHeader(false);		
	$pdf->setPrintFooter(false);
	
	// Extend the TCPDF class to create custom Header and Footer
	$pdf->SetMargins(20, 20, 20, false); //Se define margenes izquierdo, alto, derecho
	$pdf->SetAutoPageBreak(true, 20); //Se define un salto de pagina con un limite de pie de pagina
	$pdf->addPage();
		
		$text_header = '<p class="header_nombre"> P&aacute;gina [[page_cu]]/[[page_nb]] <img class="top" src="'.$url_app.'img/clinicas/'.$datos_clinica['logo'].'"> '.$datos_clinica['nombre'].'</p>';
		// $text_header = '';
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
				color: #772e71;
			}
			.tt30{
				font-size: 100px;
			}
			p{
				font-size: 30px;
			}
			.top{
				width:40px;
				top:20px;
				margin-top:20px;
				position: absolute;
				float: left;
			}
			.header_nombre{
				top:-20px !important;
				margin-top:-20px !important;
				position: absolute !important;
				left: 0px !important;
				margin-left: 0px !important;
				text-align: left !important;
				float: left !important;
				width:150px;
				font-size: 20px;
			}
			.contenido_intro p, .contenido_mediciones p{
				font-size: 30px;
				text-align: justify;
			}
			table {
				font-family: arial, sans-serif;
				border-collapse: collapse;
				width: 100%;
			}

			td, th {
				border: 1px solid #d4c2d0;
				text-align: left;
				padding: 8px;
			}

			.line_gris {
				background-color: #d4c2d0;
			}
			.tr{
				text-align: right;
			}
			.titutlo_table{				
				font-size: 30px;
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
		
		
		//->Introduccion
		$introduccion ='';
		$introduccion .= $html_header;
		$introduccion .='<body>'.$text_header;			
			if($cliente['sexo'] == 'Hombre'){
				$introduccion .= '<h1 class="tc_azul">BIENVENIDO</h1>';
				$introduccion .= '<p><strong>Estimado '.$cliente['nombre'].' </strong></p>';
			}else{
				$introduccion .= '<h1 class="tc_azul">BIENVENIDA</h1>';
				$introduccion .= '<p><strong>Estimada '.$cliente['nombre'].' </strong></p>';
			}
			$introduccion .= '<div class="contenido_intro">';
			$introduccion .= '<p>Usted acude a nosotros porque ha considerado que debe realizar un control sobre su alimentación,aprovechamos para darle la bienvenida y animarle a aprovechar esta oportunidad para mejorar de manera notoria su calidad de vida. No debe tener ninguna duda de que puede mejorar, tan solo necesita un poco de constancia y descubrirá un progreso importante en poco tiempo.</p>';		
			$introduccion .= '<p>Tanto los procedimientos para realizar los estudios antropomórficos como su resultado final, la dieta a realizar, siguen los parámetros marcados por las más importantes instituciones y entidades que trabajan en el campo de la nutrición tanto a nivel nacional como internacional. La Dieta proporcionada nada tiene que ver con las famosas ?dietas milagro? con aparentes beneficios a corto plazo en términos de pérdidas de peso, pero que tienen efectos secundarios claramente nocivos para la salud y un conocido efecto rebote que hace que termine con más kilos de los que tenía antes de comenzar la dieta.</p>';		
			$introduccion .= '<p>Con nuestro asesoramiento tiene la oportunidad de cambiar sus hábitos alimenticios, mejorar su ingesta, incluso si lo desea descubrir nuevos platos que le pueden proporcionar una gran satisfacción personal, no debe pues ver la dieta como un proceso penoso y que le va a producir ansiedad, y que, incluso, va a hacer pasar hambre, la realidad es que es probable que coma más veces al día, con una alimentación más variada y más equilibrada. </p>';
			$introduccion .= '<p>El estudio que le entregamos le proporciona información sobre sus necesidades en proteínas, grasas, vitaminas, minerales y el resto de componentes que necesita para una correcta alimentación.</p>'; 	
			$introduccion .= '<p>Está dieta está realizada exclusivamente para usted, se corresponde con las necesidades detectadas a partir del estudio resultado de la antropometría que ha realizado en nuestra clínica, así como de sus gustos gastronómicos, no debe utilizar está información para terceras personas porque pueden tener necesidades completamente diferenciadas y por consiguiente ocasionar un perjuicio no deseable.</p>'; 						
			$introduccion .= '<p>Realizar deporte, con moderación, contribuye a obtener resultados en un menor tiempo, para ello no necesita ser un gran deportista, siempre que ninguna lesión o enfermedad le perjudique, caminar todos los días, entre 45 y 60 minutos a una velocidad media-alta contribuirá a mejorar su calidad de vida de una manera notoria.</p>';			
			$introduccion .= '<p>Le comentamos brevemente algunos puntos extractados del libro del Doctor Ramón de Cangas titulado "111 Mitos y leyendas Alimentarias" publicada por Ediciones Parnaso que le pueden ser de utilidad para seguir la dieta:</p>';
			$introduccion .= '<p class="tc_azul"><strong>A) Muchos creen: " Si quito la miga al pan, engorda menos"</strong></p>';
			$introduccion .= '<p>¿Quién no ha quitado alguna vez la miga al pan? Como vemos que la miga es pastosa, "harinosa" etc., creemos que quitándola ahuyentamos gran parte de los males del pan. En realidad ya hemos visto que el pan no aporta tantas Kilocalorías como pensábamos. Es la corteza - todo lo contrario a lo que la gente cree y no la miga, la que aporta más Kilocalorías.</p>';
			$introduccion .= '<p>¿Cómo es posible esto? Pues simplemente ocurre que la miga tiene más agua y aire que la corteza, y por eso (entre otras cosas) es más blanda y esponjosa. La corteza es más concentrada y a igualdad de peso aporta más calorías que la miga. </p>';
			$introduccion .= '<p>En definitiva: no quitemos la miga al pan. No son muchas las Kilocalorías que ahorro y me estoy privando de un placer. Tampoco quitemos la corteza porque el problema no es el pan, sino las salsas que mojo o lo que el pan lleva dentro.</p>';
			$introduccion .= '<p class="tc_azul"><strong>B) Dicen: " El aceite de oliva no engorda si es crudo" </strong></p>';
			$introduccion .= '<p>El aceite de oliva virgen extra es una buena fuente de Vitamina E y ciertas sustancias antioxidantes, es rico en grasas monoinsaturadas que son buenas para la salud, pero lo cierto es que un gramo de aceite de oliva, o de cualquier otro tipo de aceite, aporta unas 9 kilocalorías, sea crudo o tras someterlo a una fritura. La única diferencia es que en el proceso de las frituras se generan, entre otras cosas, los llamados compuestos polares que no son saludables y que hacen que después de usarlo varias veces el aceite se deba desechar, pero eso no tiene nada que ver con que sea preferible el crudo porque aporte menos</p>'; 
			$introduccion .= '<p>calorías. Además en el proceso de fritura se perderán sus antioxidantes etc. Pero crudo o cocinado un gramo de aceite aporta unas 9 kilocalorías, con lo que a poco que seamos generosos con su uso disparamos las Kilocalorías del plato. </p>';			
			$introduccion .= '<p>1 gramo de aceite aporta 9 Kilocalorías. Se recomienda tomar entre 3?5 raciones de grasas al día. Un exceso de aceite, sea como sea, disparará la energía que ingerimos.</p>';	
			$introduccion .= '<p class="tc_azul"><strong>C) Muchas veces hemos oído decir a alguien: " Me han dicho que tomar fruta antes de las comidas me hará adelgazar, pero que si la tomo después de la comida me engorda" </strong></p>';
			$introduccion .= '<p>Es un mito muy extendido, pero la realidad es que la fruta se caracteriza por su alto contenido en agua. Debido a ello (unido a que apenas tiene grasa salvo el coco o el aguacate) su densidad energética no es demasiado alta. La fruta tiene las calorías que tiene sea tomada antes de comer, después de comer, o durante la comida. No hay ninguna razón que explique que la fruta engorde al tomarla después de comer. Se dice que tomada después de comer puede fermentar en el estómago, ¿fermentar?, fermenta la leche gracias a las bacterias lácticas, o la cerveza en el proceso llevado a cabo por levaduras, pero hablar de una fermentación de la fruta en el estómago es una idea absurda.</p>';		
			$introduccion .= '<p>Ingerir la fruta antes de comer el resto de alimentos no adelgaza. Únicamente puede existir una razón por la que se explique que hacer esto puede ayudar a algunas personas a controlar el peso y es el hecho de que si una persona se come la manzana antes de comer, sentirá plenitud y probablemente ingiera después menos cantidad del resto de los platos. Imaginemos que me voy a tomar una fabada asturiana de primero, un cordero asado con patatas fritas de segundo y una buena porción de tarta de queso con sirope de cacao de postre. Si yo me como dos manzanas y bebo un litro de agua un rato antes de la comida, está claro que después podré probablemente consumir la fabada, pero es muy probable que no pueda acabar el segundo plato (el cordero), o al menos con su guarnición (las patatas fritas) y me costará mucho poder consumir el postre, con lo que me ahorraré ingerir un buen puñado de Kilocalorías.</p>';
			$introduccion .= '<p>Una pieza de fruta aporta exactamente las mismas Kilocalorías si la ingiero antes de comer, durante la comida, o después de la comida.</p>';
			$introduccion .= '<p class="tc_azul"><strong>D) Muchas personas dicen: "El plátano engorda más que la mayoría de las frutas, por eso en muchas dietas te dan una manzana de postre y no un plátano". </strong></p>';
			$introduccion .= '<p>Esta afirmación está muy extendida, incluso entre profesionales relacionados con el mundo sanitario. De hecho, en muchas dietas no se ofrecen plátanos ni uvas de postre. En verdad, retirar el plátano de las dietas hipocalóricas es absurdo y carente de toda lógica, y hacerlo significa no profundizar en la dietética lo suficiente, quedándose en una simple lectura superficial de las tablas de composición de alimentos. Y es que 100 gramos de plátano aportan más calorías que 100 gramos de manzana, sin embargo un plátano suele pesar unos 120 gramos (uno normal) y una manzana puede pesar fácilmente 230 gramos. 100 gramos de plátano son unas 90 Kilocalorías, mientras que 100 gramos de manzana aportan unas 52 kilocalorías.</p>';
			$introduccion .= '<p>Si yo me tomo una manzana de un tamaño habitual que puede venir a pesar unos 230 gramos, estoy ingiriendo unas 119,6 Kilocalorías, mientras que un plátano de tamaño habitual (unos 130 gramos) me aporta unas 117 Kilocalorías. Vemos con ello que una pieza de plátano equivale a una pieza de manzana, por lo que es absurdo y carente de toda lógica retirar el plátano y las uvas (un racimo pequeño equivale también a una manzana) en una dieta, o de nuestra alimentación habitual. </p>';
			$introduccion .= '<p>1 plátano equivale a 1 pieza de manzana. Podemos ver, por tanto, que es un error comparar los alimentos simplemente por su valor calórico por 100 gramos en las tablas de composición de alimentos. ¡ Debemos acostumbrarnos a comparar, entre las raciones habituales!.</p>';
			$introduccion .='</div>';
		$introduccion .='</body>';
		$introduccion .= '</html>';	
		//->Fin introduccion
		
		//-> medidas_caceras
		$medidas_caceras ='';
		$medidas_caceras .= $html_header;
		$medidas_caceras .='<body>';
				$medidas_caceras .= '<h1 class="tc_azul">AYUDA PARA EL CÁLCULO DE LAS RACIONES: EQUIVALENCIA EN MEDIDAS CASERAS</h1>';
				$medidas_caceras .= '<div class="contenido_mediciones">';
				$medidas_caceras .= '<p>Con el fin de que usted pueda tener una buena aproximación del tamaño de las raciones les indicamos estas medidas, tal y como se realizan del modo tradicional, para poder estimar el tamaño de algunos ingredientes, para una medida precisa de los platos es necesario utilizar una báscula de cocina que le dará el peso ideal de cada componente de cada plato.</p>';
				$medidas_caceras .= '<p>Estos datos se basan en estimaciones realizadas por nuestro propio equipo de dietistas-nutricionistas Deben tener claro que son siempre valores aproximados. </p>';
				$medidas_caceras .= '<p>Algunos de los alimentos indicados con 0 gramos de peso, como las especias o el vinagre, son de libre utilización (salvo que por alguna patología su médico así se lo indique).</p>';
				$medidas_caceras .='</div>';
				$medidas_caceras .= '<table>
							  <tr class="line_gris">
								<th class="titutlo_table" style="width:80%">MEDIDA CASERA</th>
								<th class="titutlo_table tr" style="width:20%; text-align:center;">EQUIVALENCIA PESO EN GR</th>								
							  </tr>
							  <tr>
								<td>1 cucharada sopera de arroz</td>								
								<td class="tr">17 gr</td>
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
							  <tr>
								<td>Un plátano mediano (sin piel) </td>								
								<td class="tr">85 gr</td>
							  </tr>
							  <tr class="line_gris">
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
		$medidas_caceras .='</body>';
		$medidas_caceras .= '</html>';			
		//->Fin medidas_caceras
		
		$estados_y_necedidades ='';
		$estados_y_necedidades .= $html_header;
		$estados_y_necedidades .='<body>'.$text_header;
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
			$estados_y_necedidades .= '<div class="contenido_intro">';
			$estados_y_necedidades .= '<p><strong>Grupos de alimentos: </strong> '.$grupos_alimentos[1]['grupo'];
				if($total_grupos_exculidos >= 1){
					for ($i = 0; $i <= $total_grupos; $i++) {
						if(!empty($grupos_alimentos[$i]['grupo'])){
							if (in_array($grupos_alimentos[$i]['grupo'], $grupos_excludios)) {
							$estados_y_necedidades .= utf8_encode($grupos_alimentos[$i]['grupo']).', ';
							}
						}
					}
				}
			$estados_y_necedidades .= '</p>';
			$estados_y_necedidades .= '</p>';			
			$estados_y_necedidades .= '<div class="contenido_intro">';
			$estados_y_necedidades .= '<p><strong>Alimentos: </strong>';
						
				for ($i = 0; $i <= $total_alimentos; $i++) {							
						if(!empty($alimentos_activos[$i]['id_definitivo'])){											
							if (in_array($alimentos_activos[$i]['id_definitivo'],  $alimentos_excluidos)) {								
							$estados_y_necedidades .= utf8_encode($alimentos_activos[$i]['nombre']).', ';							
							}
						}
					}
			$estados_y_necedidades .= '</p>';			
			$estados_y_necedidades .= '</div>';
		$estados_y_necedidades .='</body>';
		$estados_y_necedidades .= '</html>';			
		
		//->listado de dieta por todos los dias
		$listado_dieta ='';
		$listado_dieta .= $html_header;
		$listado_dieta .='<body>'.$text_header;
			for ($i = 1; $i <= $consulta_de_dieta['duracion']; $i++) {
			$listado_dieta .= '<p>DÍA '.$i.'</p>';
			$listado_dieta .= '<p><strong>Nombre del paciente:</strong> x </p>';
			$listado_dieta .= '<p><strong>Fecha de nacimiento:</strong> x </p>';
			$listado_dieta .= '</p>';	
			}	
		$listado_dieta .='</body>';
		$listado_dieta .= '</html>';	
		
		
	//Caratula
	$pdf->SetFont('Helvetica', '', 10);	
	$pdf->writeHTML($html, true, 0, true, 0);
	
	//Introduccion
	$pdf->AddPage('P', 'mm', 'A4');
	$pdf->writeHTML($introduccion, true, 0, true, 0);
	
	//equivalencias medidas caceras
	$pdf->AddPage('P', 'mm', 'A4');
	$pdf->writeHTML($medidas_caceras, true, 0, true, 0);
	$pdf->AddPage('P', 'mm', 'A4');
	
	//->Estado del paciente (obligatorio)
	$pdf->writeHTML($estados_y_necedidades, true, 0, true, 0);
	$pdf->AddPage('P', 'mm', 'A4');
	
	//mediciones
	
	$pdf->writeHTML($listado_dieta, true, 0, true, 0);
	$pdf->AddPage('L', 'A4');	
	$pdf->writeHTML($consulta_de_dieta['dieta_plantilla'], true, 0, true, 0);
	
		
	$pdf->lastPage();	
	$pdf->output($nombre_archivo, 'I');

	
	
	
?>
