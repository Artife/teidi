<?php
header('Cache-Control: no cache'); 
session_cache_limiter('private_no_expire');
session_start();
include 'parts/conex.php';
$pagina = 'Desactivar cita';

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include 'parts/consultas_mysql.php';

$total_registros = 0;	
foreach($_POST as $variable => $value)  {	
	//Validamos que no esten vacias las variables
				
	if(!empty($variable)){			
		//Si todos los datos estan correctos agregamos la cita
		if(is_numeric($variable)) {			
			gx_desactivar_clientes($variable);
			$total_registros++;
		}
	}
}

if($total_registros != 0){
	//Sin datos
	$_SESSION['mensaje'] = 'desactivar_clientes';			
	header('location:'.$url_app.'lista-clientes');
	
}else{
	$_SESSION['mensaje'] = 'datos_vacios';			
	header('location:'.$url_app.'lista-clientes');	
}


?>