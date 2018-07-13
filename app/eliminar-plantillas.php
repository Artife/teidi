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
foreach($_POST as $variable => $id_usuario)  {	
	//Validamos que no esten vacias las variables
				
	if(!empty($id_usuario)){						
		gx_eliminar_plantillas($variable);
		$total_registros++;
		
	}
}
if($total_registros == 0){
	//Sin datos
	$_SESSION['mensaje'] = 'seleccionar_plantilla';			
	header('location:'.$url_app.'lista-plantillas-desactivadas');
	
}else{
	$_SESSION['mensaje'] = 'eliminar_plantilla';			
	header('location:'.$url_app.'lista-plantillas-desactivadas');	
}


?>