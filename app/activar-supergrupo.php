<?php
session_start();
include 'parts/conex.php';

//Solo permitir acceso a estos roles
$acceso_roles = array('admin');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include 'parts/consultas_mysql.php';
$i = 0;
//Modificamos todas las variables para ver los id seleccionados
foreach($_POST as $variable => $id_usuario)  {	
	//Validamos que no esten vacias las variables
	if(!empty($id_usuario)){		
		//enviamos la variable del id del cliente a la funcion del update
		if(is_numeric($variable)) { 			
			gx_activar_supergrupos($variable);
			$i++;
		}
	}
}

if($i > 1){
	$_SESSION['mensaje'] = 'supergrupo_activados';	
}else{
	$_SESSION['mensaje'] = 'supergrupo_activo';		
}
header('location:'.vinculo_completo('lista-super-grupo'));	

?>