<?php
session_start();
include 'parts/conex.php';

//Solo permitir acceso a estos roles
$acceso_roles = array('admin');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include 'parts/consultas_mysql.php';

$contador = 0;
//Modificamos todas las variables para ver los id seleccionados
foreach($_POST as $variable => $id_usuario)  {	
	
	//Validamos que no esten vacias las variables
	if(!empty($id_usuario)){				
		if(is_numeric($variable)) { 
			// echo $variable." - ".$id_usuario;
			gx_desactivar_reglas($variable);
			$contador++; 
		}		
	}
}

if($contador != 0){
	$_SESSION['todas_las_reglas_desactivadas_por_el_usuario_sql']  = gx_todas_las_reglas_desactivadas_por_el_usuario_sql();
	$_SESSION['mensaje'] = 'desactivar_reglas';
	header('location:'.$url_app.'lista-reglas');
}else{
	$_SESSION['mensaje'] = 'datos_vacios';
	header('location:'.$url_app.'lista-reglas');
}

?>