<?php  
session_start();
include 'parts/conex.php';

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/ayuda.php';
include_once 'parts/consultas_mysql.php';
include_once 'parts/configuracion.php';

	//Ejecutar texto plano
	$html = ''; 
	$html .='{ "aaData": [';
	
	//Consulta lista de desactivados		
	$query = "SELECT *, gx_recetas.id_receta  FROM `gx_recetas_desactivadas` 
	LEFT JOIN `gx_recetas` ON `gx_recetas_desactivadas`.`id_receta` =  `gx_recetas`.`id_receta`
	WHERE `gx_recetas`.`id_receta` IS NOT NULL AND `gx_recetas_desactivadas`.`id_usuario` = '".$_SESSION["id_usuario"]."' AND `gx_recetas_desactivadas`.`status` = 2  AND `gx_recetas`.`nombre` != 'LIBRE'
	GROUP BY gx_recetas_desactivadas.id_receta";	
	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	$tota_registros = $result->num_rows;		
		$i = 0;
		while($row = $result->fetch_assoc()) {
			$receta[$i]['id_receta']				= $row["id_receta"];			
			$receta[$i]['id_usuario']				= $row["id_usuario"];
			$receta[$i]['nombre']					= $row["nombre"];			
			$receta[$i]['kcal_por_100g']			= $row["kcal_por_100g"];
			$receta[$i]['hidratos']					= $row["hidratos"];
			$receta[$i]['proteinas']				= $row["proteinas"];
			$receta[$i]['grasas']					= $row["grasas"];		
			$receta[$i]['ingestas']					= $row["ingestas"];	
			$receta[$i]['nombre_tipo_comida']		= $row["nombre_tipo_comida"];			
			if(empty($row["origen"])){
				$receta[$i]['origen']					= 'i-Diet';
			}else{
				$receta[$i]['origen']					= $row["origen"];
			}
			$receta[$i]['fecha_creado']				= $row["fecha_creado"];
			$i++;	
		}	
	
		// print_r($receta);
		$i = 0;
		for ($i = 0; $i <= count($receta); $i++) {	
			//Seguir escribiendo el texto plano
			if(!empty($receta[$i]['id_receta'])){
				$input  = "<div class='checkbox checkbox-success'>";
				$input .= "<input id='".$receta[$i]['id_receta']."' type='checkbox' name='".$receta[$i]['id_receta']."' class='marcar'>";
				$input .= "<label for='".$receta[$i]['id_receta']."'></label>";
				$input .= "</div>";
				
				
				$ingestas = '';
				$cadena_1 = '';
				$cadena_2 = '';
				$cadena_3 = '';
				$cadena_4 = '';
				$cadena_5 = '';
				$cadena_6 = '';
				$cadena_7 = '';
				$cadena_8 = '';
				$cadena_9 = '';
				$cadena_10 = '';
				
				
				$cadena_1 = strpos($receta[$i]['ingestas'], 'ingesta_7');
				if (is_numeric($cadena_1)) { $cadena_1 = "<span class='label label-default pull-left color_ingesta_7'>Desayuno</span><br />"; }else{ $cadena_1 = '';}
				
				$cadena_2 = strpos($receta[$i]['ingestas'], 'ingesta_8');
				if (is_numeric($cadena_2)) {  $cadena_2 = "<span class='label label-default pull-left color_ingesta_8'>Media mañana</span><br />";  }else{ $cadena_2 = '';}
				
				$cadena_3 = strpos($receta[$i]['ingestas'], 'ingesta_9');
				if (is_numeric($cadena_3)) { $cadena_3 = "<span class='label label-default pull-left color_ingesta_9'>1ª plato Comida</span><br />";  }else{ $cadena_3 = '';}
				
				$cadena_4 = strpos($receta[$i]['ingestas'], 'ingesta_10');
				if (is_numeric($cadena_4)) { $cadena_4 = "<span class='label label-default pull-left color_ingesta_10'>Merienda</span><br />";  }else{ $cadena_4 = '';}
				
				$cadena_5 = strpos($receta[$i]['ingestas'], 'ingesta_11');
				if (is_numeric($cadena_5)) { $cadena_5 = "<span class='label label-default pull-left color_ingesta_11'>1ª plato Cena</span><br />";  }else{ $cadena_5 = '';}
				
				$cadena_6 = strpos($receta[$i]['ingestas'], 'ingesta_12');
				if (is_numeric($cadena_6)) {  $cadena_6 = "<span class='label label-default pull-left color_ingesta_12'>Recena</span><br />";  }else{ $cadena_6 = '';}
				
				$cadena_7 = strpos($receta[$i]['ingestas'], 'ingesta_18');
				if (is_numeric($cadena_7)) { $cadena_7 = "<span class='label label-default pull-left color_ingesta_18'>Otros</span><br />";  }else{ $cadena_7 = '';}
				
				$cadena_8 = strpos($receta[$i]['ingestas'], 'ingesta_19');
				if (is_numeric($cadena_8)) { $cadena_8 = "<span class='label label-default pull-left color_ingesta_19'>Plato principal comida</span><br />";  }else{ $cadena_8 = '';}
				
				$cadena_9 = strpos($receta[$i]['ingestas'], 'ingesta_20');
				if (is_numeric($cadena_9)) { $cadena_9 = "<span class='label label-default pull-left color_ingesta_20'>Plato principal cena</span><br />";  }else{ $cadena_9 = '';}
				
				$cadena_10 = strpos($receta[$i]['ingestas'], 'ingesta_21');
				if (is_numeric($cadena_10)) {  $cadena_10 = "<span class='label label-default pull-left color_ingesta_21'>Postre</span><br />";  }else{ $cadena_10 = '';}
				
				
				$ingestas = $cadena_1.$cadena_2.$cadena_3.$cadena_4.$cadena_5.$cadena_6.$cadena_7.$cadena_8.$cadena_9.$cadena_10;
				
				$con_error = '';
				
				//Editar Receta
				$nombre = utf8_encode(trim($receta[$i]['nombre']));
				
				$html .='[ "'.$input.'", "'.salida_nombre($nombre).'", "'.$receta[$i]['kcal_por_100g'].'", "'.$receta[$i]['hidratos'].'", "'.$receta[$i]['proteinas'].'", "'.$receta[$i]['grasas'].'", "'.$receta[$i]['origen'].'", "'.$ingestas.'", "'.$con_error.'" ],';	
				$input = "";				
			}
		}
	
	//Quitamos la ultima de la fila
	$html = substr($html, 0, -3); 
	
	$html .=']] }';	
	if($tota_registros == 0){			
		$html = '{ "aaData": [[ "", " Sin registros", "", "", "", "", "", "", "" ]] }';		
		
	}
	echo $html;	
?>