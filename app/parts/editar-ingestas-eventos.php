<?php
//Eventos de las ingestas de los alimentos
header('Cache-Control: no cache'); 
session_cache_limiter('private_no_expire');
session_start();
include 'conex.php';
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');
include 'configuracion.php';
include 'consultas_mysql.php';

$tipo_ingesta 	= $_POST['tipo_ingesta'];
$id_receta 		= $_POST['id_receta'];
$class_tipo 	= $_POST['class_tipo'];
$clase_css 		= $_POST['clase_css'];

//primero buscarmos si es original o no la receta
$receta = obtener_receta($id_receta);	
		

//Esta variable es la que indicara si debemos hacer desactivar o activar la ingestas
//$clase_css;

 
if($receta['origen'] == 'i-Diet'){
	if(empty($_SESSION['recetas_editadas_'.$id_receta])){	 
				
		//Desactivamos la receta		
		gx_desactivar_recetas_ingestas ($id_receta);			
			
		//Actualizamos la session de todas las recetas desactivas por el cliente
		$_SESSION['todas_las_recetas_desactivadas_por_el_usuario_sql']  = gx_todas_las_recetas_desactivadas_por_el_usuario_sql();		
			
		//Duplicamos la receta original
		$nuevo_id_receta = gx_duplicar_recetas_ingestas ($id_receta);		
		
			
		//Creamos los ingredientes para la receta duplicados
		crear_ingredientes_nueva_receta_ingestas ($id_receta, $nuevo_id_receta);			
					
		//Asignamos el nuevo id a la session 
		$_SESSION['recetas_editadas_'.$id_receta] = $nuevo_id_receta;
						
		$_SESSION['recetas_editadas_ids'][$id_receta] = $id_receta;		
			
		$receta_nueva = obtener_receta($_SESSION['recetas_editadas_'.$id_receta]);	
					
		$ingestas_actuales = $receta_nueva['ingestas'];
							
		if(empty($clase_css)){		
			$lista_ingestas = cadena_de_ingestas_agregar($ingestas_actuales, $tipo_ingesta);					
				
		}else{
			$lista_ingestas = cadena_de_ingestas_eliminar($ingestas_actuales, $tipo_ingesta);			
				
		}	
		
		gx_actualizar_ingestas($_SESSION['recetas_editadas_'.$id_receta], $lista_ingestas);	   
		
	}else{		
		
		$_SESSION['todas_las_recetas_desactivadas_por_el_usuario_sql']  = gx_todas_las_recetas_desactivadas_por_el_usuario_sql();
		
		//Si ya fue desactivada la receta original				
		$receta_nueva = obtener_receta($_SESSION['recetas_editadas_'.$id_receta]);	
		
		$ingestas_actuales = $receta_nueva['ingestas'];
		
		if(empty($clase_css)){		
			$lista_ingestas = cadena_de_ingestas_agregar($ingestas_actuales, $tipo_ingesta);	
						
		}else{
			$lista_ingestas = cadena_de_ingestas_eliminar($ingestas_actuales, $tipo_ingesta);			
		}	
				 				  
		gx_actualizar_ingestas($_SESSION['recetas_editadas_'.$id_receta], $lista_ingestas);	
		
	}			
}else{
	//si es una receta normal simplemente hacemos el update
	$ingestas_actuales = $receta['ingestas'];	
	
	if(empty($clase_css)){		
		$lista_ingestas = cadena_de_ingestas_agregar($ingestas_actuales, $tipo_ingesta);		
		
	}else{
		$lista_ingestas = cadena_de_ingestas_eliminar($ingestas_actuales, $tipo_ingesta);		
	}	
	
	gx_actualizar_ingestas($id_receta, $lista_ingestas);	
}	



function cadena_de_ingestas_agregar($ingestas_actuales, $tipo_ingesta){
	$cadena_1 = strpos($ingestas_actuales, 'ingesta_7');
	if (is_numeric($cadena_1) || $tipo_ingesta == 'ingesta_7') { $cadena_1 = "ingesta_7,"; }else{ $cadena_1 = '';}
	
	$cadena_2 = strpos($ingestas_actuales, 'ingesta_8');
	if (is_numeric($cadena_2) || $tipo_ingesta == 'ingesta_8') {  $cadena_2 = "ingesta_8,";  }else{ $cadena_2 = '';}
	
	$cadena_3 = strpos($ingestas_actuales, 'ingesta_9');
	if (is_numeric($cadena_3) || $tipo_ingesta == 'ingesta_9') { $cadena_3 = "ingesta_9,";  }else{ $cadena_3 = '';}
	
	$cadena_4 = strpos($ingestas_actuales, 'ingesta_10');
	if (is_numeric($cadena_4) || $tipo_ingesta == 'ingesta_10') { $cadena_4 = "ingesta_10,";  }else{ $cadena_4 = '';}
	
	$cadena_5 = strpos($ingestas_actuales, 'ingesta_11');
	if (is_numeric($cadena_5) || $tipo_ingesta == 'ingesta_11') { $cadena_5 = "ingesta_11,";  }else{ $cadena_5 = '';}
	
	$cadena_6 = strpos($ingestas_actuales, 'ingesta_12');
	if (is_numeric($cadena_6) || $tipo_ingesta == 'ingesta_12') {  $cadena_6 = "ingesta_12,";  }else{ $cadena_6 = '';}
	
	$cadena_7 = strpos($ingestas_actuales, 'ingesta_18');
	if (is_numeric($cadena_7) || $tipo_ingesta == 'ingesta_18') { $cadena_7 = "ingesta_18,";  }else{ $cadena_7 = '';}
	
	$cadena_8 = strpos($ingestas_actuales, 'ingesta_19');
	if (is_numeric($cadena_8) || $tipo_ingesta == 'ingesta_19') { $cadena_8 = "ingesta_19,";  }else{ $cadena_8 = '';}
	
	$cadena_9 = strpos($ingestas_actuales, 'ingesta_20');
	if (is_numeric($cadena_9) || $tipo_ingesta == 'ingesta_20') { $cadena_9 = "ingesta_20,";  }else{ $cadena_9 = '';}
	
	$cadena_10 = strpos($ingestas_actuales, 'ingesta_21');
	if (is_numeric($cadena_10) || $tipo_ingesta == 'ingesta_21' ) {  $cadena_10 = "ingesta_21,";  }else{ $cadena_10 = '';}			
	
	$lista_ingestas = $cadena_1.$cadena_2.$cadena_3.$cadena_4.$cadena_5.$cadena_6.$cadena_7.$cadena_8.$cadena_9.$cadena_10;
	
	return $lista_ingestas;
}


function cadena_de_ingestas_eliminar($ingestas_actuales, $tipo_ingesta){
	
	if($tipo_ingesta != 'ingesta_7'){
		$cadena_1 = strpos($ingestas_actuales, 'ingesta_7');
		if (is_numeric($cadena_1)) { $cadena_1 = "ingesta_7,"; }else{ $cadena_1 = '';}
	}else{ $cadena_1 = '';}
	
	if($tipo_ingesta != 'ingesta_8'){
		$cadena_2 = strpos($ingestas_actuales, 'ingesta_8');
		if (is_numeric($cadena_2)) {  $cadena_2 = "ingesta_8,";  }else{ $cadena_2 = '';}
	}else{ $cadena_2 = '';}
	
	if($tipo_ingesta != 'ingesta_9'){
		$cadena_3 = strpos($ingestas_actuales, 'ingesta_9');
		if (is_numeric($cadena_3)) { $cadena_3 = "ingesta_9,";  }else{ $cadena_3 = '';}
	}else{ $cadena_3 = '';}
	
	if($tipo_ingesta != 'ingesta_10'){
		$cadena_4 = strpos($ingestas_actuales, 'ingesta_10');
		if (is_numeric($cadena_4)) { $cadena_4 = "ingesta_10,"; }else{ $cadena_4 = '';}
	}else{ $cadena_4 = '';}

	if($tipo_ingesta != 'ingesta_11'){
		$cadena_5 = strpos($ingestas_actuales, 'ingesta_11');
		if (is_numeric($cadena_5)) { $cadena_5 = "ingesta_11,";  }else{ $cadena_5 = '';}
	}else{ $cadena_5 = '';}
	
	if($tipo_ingesta != 'ingesta_12'){
		$cadena_6 = strpos($ingestas_actuales, 'ingesta_12');
		if (is_numeric($cadena_6)) {  $cadena_6 = "ingesta_12,";  }else{ $cadena_6 = '';}
	}else{ $cadena_6 = '';}
	
	if($tipo_ingesta != 'ingesta_18'){
		$cadena_7 = strpos($ingestas_actuales, 'ingesta_18');
		if (is_numeric($cadena_7)) { $cadena_7 = "ingesta_18,";  }else{ $cadena_7 = '';}
	}else{ $cadena_7 = '';}
	
	if($tipo_ingesta != 'ingesta_19'){
		$cadena_8 = strpos($ingestas_actuales, 'ingesta_19');
		if (is_numeric($cadena_8)) { $cadena_8 = "ingesta_19,";  }else{ $cadena_8 = '';}
	}else{ $cadena_8 = '';}
	
	if($tipo_ingesta != 'ingesta_20'){
		$cadena_9 = strpos($ingestas_actuales, 'ingesta_20');
		if (is_numeric($cadena_9)) { $cadena_9 = "ingesta_20,";  }else{ $cadena_9 = '';}
	}else{ $cadena_9 = '';}
	
	if($tipo_ingesta != 'ingesta_21'){
		$cadena_10 = strpos($ingestas_actuales, 'ingesta_21');
		if (is_numeric($cadena_10)) {  $cadena_10 = "ingesta_21,";  }else{ $cadena_10 = '';}			
	}else{ $cadena_10 = '';}			
	
	$lista_ingestas = $cadena_1.$cadena_2.$cadena_3.$cadena_4.$cadena_5.$cadena_6.$cadena_7.$cadena_8.$cadena_9.$cadena_10;
	
	return $lista_ingestas;
}


?>