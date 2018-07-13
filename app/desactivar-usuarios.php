<?php
session_start();
include 'parts/conex.php';

//Solo permitir acceso a estos roles
$acceso_roles = array('admin');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include 'parts/consultas_mysql.php';

//Modificamos todas las variables para ver los id seleccionados
foreach($_POST as $variable => $id_usuario)  {	
	
	//Validamos que no esten vacias las variables
	if(!empty($id_usuario)){		
		// echo $variable." - ".$id_usuario;
		if(is_numeric($variable)) { 
			desactivar_usuario($variable);
		}		
	}
}

header('location:'.$url_app.'lista-usuarios');


?>