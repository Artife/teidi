<?php  
session_start();
include 'parts/conex.php';

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/ayuda.php';
include_once 'parts/consultas_mysql.php';
include_once 'parts/configuracion.php';


if(!empty($_GET['alimento'])){
	$alimento = utf8_decode($_GET['alimento']);
}else{
	$alimento = '';
}

//Ingestas creadas
//->Crear ingestas para la nueva receta

	//Ejecutar texto plano
	$html = ''; 
	$html .='{ "aaData": [';
	
	//Consulta de las recetas	
	if($alimento == ''){
		$query = "SELECT * FROM `gx_recetas` 	
		WHERE `id_usuario` = 0 AND `gx_recetas`.`id_receta` NOT IN (".$_SESSION['todas_las_recetas_desactivadas_por_el_usuario_sql'].")
		OR `id_usuario` = '".$_SESSION['id_usuario']."' AND `gx_recetas`.`id_receta` NOT IN (".$_SESSION['todas_las_recetas_desactivadas_por_el_usuario_sql'].")
		ORDER BY id_receta DESC";
	}else{
		$query = "SELECT *
		FROM `gx_recetas` 
		INNER JOIN `gx_alimento_receta` ON `gx_recetas`.`id_receta` = `gx_alimento_receta`.`id_receta` 
		WHERE `id_usuario` = 0 AND `gx_recetas`.`id_receta` NOT IN (".$_SESSION['todas_las_recetas_desactivadas_por_el_usuario_sql'].") AND `gx_alimento_receta`.`alimento` LIKE '%".$alimento."%'
		OR `id_usuario` = '".$_SESSION['id_usuario']."' AND `gx_recetas`.`id_receta` NOT IN (".$_SESSION['todas_las_recetas_desactivadas_por_el_usuario_sql'].") AND `gx_alimento_receta`.`alimento` LIKE '%".$alimento."%'";		
	}		
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));			
		$i = 0;
		$contador = 0;
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
			$contador++;	
		}
		
		if($contador >= 1)	{	
		for ($i = 0; $i <= count($receta); $i++) {		
			if(!empty($receta[$i]['id_receta']) && !empty($receta[$i]['nombre'])){
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
				
				// $ingestas = '';
				$nombres_alimentos_desactivados = '';	
				
				if(!empty($nombres_alimentos_desactivados)){
				//Editar Receta
					$nombre = "<a class='tooltips desactivado_en_receta' href='".$url_app."editar-receta/".$receta[$i]['id_receta']."'><span> Esta receta tiene desactivados o eliminados estos alimentos: ".$nombres_alimentos_desactivados."</span>".salida_nombre($receta[$i]['nombre'])."</a>";
					$con_error = "Le faltan alimentos";
				}else{
					$nombre = "<a  href='".$url_app."editar-receta/".$receta[$i]['id_receta']."'>".salida_nombre($receta[$i]['nombre'])."</a>";	
					$con_error = "";
				}
				
				$html .='[ "'.$input.'", "'.$nombre.'", "'.$receta[$i]['kcal_por_100g'].'", "'.$receta[$i]['hidratos'].'", "'.$receta[$i]['proteinas'].'", "'.$receta[$i]['grasas'].'", "'.$receta[$i]['origen'].'", "'.$ingestas.'", "'.$con_error.'" ],';	
				$input = "";
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
			}			
		}
		}
	// print_r($receta_listado);
	//Quitamos la ultima de la fila
	if($contador >= 1){
		$html = substr($html, 0, -3); 
	}
	
	$html .=']] }';
	if($i == 0 || $contador == 0){			
		$html = '{ "aaData": [[ "", " Sin registros", "", "", "", "", "", "", "" ]] }';				
	}
	echo $html;	
?>