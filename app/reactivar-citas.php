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
		//Si todos los datos estan correctos agregamos la cita
		if(substr($variable, 0 , 11) == 'desactivar_'){				
			reactivar_citas(substr($variable, 11));
			$total_registros++;
		}
	}
}
if($total_registros == 0){
	//Sin datos
	$_SESSION['mensaje'] = 'seleccionar_cliente';			
	header('location:'.$url_app.'agenda');
	
}else{
	$_SESSION['mensaje'] = 'reactivar_citas';			
	header('location:'.$url_app.'agenda-desactivados');	
}
 

?>