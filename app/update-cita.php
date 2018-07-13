<?php
header('Cache-Control: no cache'); 
session_cache_limiter('private_no_expire');
session_start();
include 'parts/conex.php';
$pagina = 'Modificar cita';

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include 'parts/consultas_mysql.php';


if(!empty($_POST["id"])){
//Modificamos todas las variables para ver los id seleccionados	
	$id 				= $_POST["id"];	
	$inicio 			= $_POST["inicio"];	
	$inicio_dia 		= substr($inicio, 0,2); 	
	$inicio_mes			= substr($inicio, 3, 2); 	
	$inicio_ano 		= substr($inicio, 6, 4); 	
	$inicio_hora 		= substr($inicio, 11, 2);	
	$inicio_min 		= substr($inicio, 14, 2);
	$fin 	  			= $_POST["inicio"];
	$fin_dia 			= substr($fin, 0,2); 
	$fin_mes 			= substr($fin, 3, 2); 
	$fin_ano            = substr($fin, 6, 4); 
	$fin_hora 			= substr($inicio, 11, 2);	
	$fin_min 			= substr($inicio, 14, 2);
	$titulo 			= $_POST["titulo"];	
	$tipo_cita 			= $_POST["tipo_cita"];	
		
	modificar_citas($id, $inicio, $inicio_dia, $inicio_mes, $inicio_ano, $inicio_hora, $inicio_min, $fin, $fin_dia, $fin_mes, $fin_ano, $fin_hora, $fin_min, $titulo, $tipo_cita);
	
	$_SESSION['mensaje'] = 'modificar_cita';			
	header('location:'.$url_app.'agenda');	
	
}else{
	//Sin datos
	$_SESSION['mensaje'] = 'datos_vacios';	
	header('location:'.$url_app.'agenda');
	
}

?>