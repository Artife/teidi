<?php
session_start();
include 'parts/conex.php';
// ini_set('error_reporting', E_ALL);
//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include 'parts/consultas_mysql.php';


//Fecha
$fecha = date('d-m-Y');
if(!empty($_POST['id_alimento'])) {		
	if($_POST['id_usuario'] == 0) {		
		//Si es un alimento original lo duplicamos solamente
		gx_duplicar_alimento_original ($_POST['id_alimento']);		
	}	
	$_SESSION['mensaje'] = 'duplicar_alimento';
	header('location:'.$url_app.'lista-alimentos');
}else{
	$_SESSION['mensaje'] = 'datos_vacios';	
	header('location:'.$url_app.'lista-alimentos');
}	

?>



