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

$id_dieta 		= $_POST['id_dieta'];
$id_cliente 	= $_POST['id_cliente'];

if(isset($id_cliente ) && isset($id_dieta)){

	gx_eliminar_dieta_cliente ($id_cliente, $id_dieta);	
	$_SESSION['mensaje'] = 'eliminar_dieta';			
	header('location:'.$url_app.'dietas-cliente/'.$id_cliente);	
}else{
	$_SESSION['mensaje'] = 'error_eliminar_dieta';			
	header('location:'.$url_app.'dietas-cliente/'.$id_cliente);	
}
	

?>