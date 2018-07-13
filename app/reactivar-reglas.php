<?php
session_start();
include 'parts/conex.php';
include 'parts/ayuda.php';

//Solo permitir acceso a estos roles
$acceso_roles = array('admin');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include 'parts/consultas_mysql.php';

$contador = 0;
$contador_reglas_activas = 0;
$contador_reglas_inactivas = 0;
$no_hacer_nada = 'si'; 
 
 
$reglas_activas = gx_obtener_regla_activas_por_id();

$supergrupo_check[] ='';
//Modificamos todas las variables para ver los id seleccionados
foreach($_POST as $variable => $id_usuario)  {		
	//Validamos que no esten vacias las variables
	if(!empty($id_usuario)){				
		if(is_numeric($variable)) { 		
			$regla_xid = gx_obtener_regla_por_id($variable);			
			$supergrupo_check[] = $regla_xid['supergrupo'];		
					
		}
	}
}

$total_valores_repetidos = contar_valores_duplicados($supergrupo_check);

//Si un grupo fue seleccionado mas de una vez
foreach ($total_valores_repetidos as &$valores_repetidos) {
   
	if($valores_repetidos >=2){ $no_hacer_nada = 'no'; }

}


if($no_hacer_nada == 'no'){
	$_SESSION['todas_las_reglas_desactivadas_por_el_usuario_sql']  = gx_todas_las_reglas_desactivadas_por_el_usuario_sql();
	$_SESSION['mensaje'] = 'reactivar_reglas_no_hacer_nada';
	header('location:'.$url_app.'lista-reglas-desactivadas');
}else{
	foreach($_POST as $variable => $id_usuario)  {		
		//Validamos que no esten vacias las variables
		if(!empty($id_usuario)){				
			if(is_numeric($variable)) { 			
				//Cargamos todos los datos de la regla seleccionada
				$regla_xid = gx_obtener_regla_por_id($variable);
								
					//Asignamos el grupo al array
					
					//revisamos si la regla seleccionada se encuentra entre algunas de las activas
					$keys = array_keys(array_column($reglas_activas, 'supergrupo'), $regla_xid['supergrupo']);
						
					if(empty($keys)){			
						gx_reactivar_reglas($variable);
						$contador_reglas_inactivas++; 
						// echo  $regla_xid['supergrupo'];
						// echo "<br><br><br>";
					}else{
						$contador_reglas_activas++; 
						$todos_supergrupo[] = $regla_xid['supergrupo'];						
					} 			
				$contador++; 				
			}
		}
	}
	
	//En caso de hacer la actualizacion	
	if($contador >=2){
		$todos_supergrupo = array_unique($todos_supergrupo);
	}
	$td_supergrupo_mostrar  = '';

	if(count($todos_supergrupo) >= 2){
		foreach ($todos_supergrupo as &$td_supergrupo) {
		   
			if ($td_supergrupo === end($todos_supergrupo)) {
				$td_supergrupo_mostrar .= ' y '.$td_supergrupo;	
			}else{
				$td_supergrupo_mostrar .= $td_supergrupo.', ';	
			}

		}
		$_SESSION['todos_supergrupo']  = $td_supergrupo_mostrar;
	}else{
		foreach ($todos_supergrupo as &$td_supergrupo) {		  
				$td_supergrupo_mostrar = $td_supergrupo;	
		}
		$_SESSION['todos_supergrupo']  = $td_supergrupo_mostrar;
	}



	if($contador == 0){
		$_SESSION['mensaje'] = 'datos_vacios';
		header('location:'.$url_app.'lista-reglas-desactivadas');
	}

	if($contador_reglas_activas >= 1){
		$_SESSION['todas_las_reglas_desactivadas_por_el_usuario_sql']  = gx_todas_las_reglas_desactivadas_por_el_usuario_sql();
		$_SESSION['mensaje'] = 'reactivar_reglas_problema';
		header('location:'.$url_app.'lista-reglas-desactivadas');
		// $ahi = 'si';
	}else{
		$_SESSION['todas_las_reglas_desactivadas_por_el_usuario_sql']  = gx_todas_las_reglas_desactivadas_por_el_usuario_sql();
		$_SESSION['mensaje'] = 'reactivar_reglas';
		header('location:'.$url_app.'lista-reglas-desactivadas');
		// $ahi = 'si 2';
	}

	
	
}
// echo $ahi;
// echo "<br><br><br>";
// echo 'contador_reglas_inactivas '.$contador_reglas_activas;
// echo "<br><br><br>";
// echo 'contador_reglas_activas '.$contador_reglas_activas;
// echo "<br><br><br>";
// print_r($total_valores_repetidos);


?>