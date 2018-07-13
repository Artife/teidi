<?php
header('Cache-Control: no cache'); 
session_cache_limiter('private_no_expire');
session_start();
include 'parts/conex.php';

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include 'parts/consultas_mysql.php';




//Agregar la accion a la tabla de alimentos editados

$contador = 0;
while ($post = each($_POST))
{			
	if($post[0] != 'accion' and $post[0] !='example_length'){		
		reactivar_alimentos ($post[0]);		
		$contador++;
	}
}

if($contador >=1){	
	$_SESSION['mensaje'] = 'reactivar_alimentos';
	header('location:'.$url_app.'alimentos-desactivados');	
}else{
	//Si los datos estan vacios
	$_SESSION['mensaje'] = 'datos_vacios';	
	header('location:'.$url_app.'alimentos-desactivados');
}
		
?>