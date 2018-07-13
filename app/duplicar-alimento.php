<?php
session_start();
include 'parts/conex.php';
//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include 'parts/consultas_mysql.php';


//Fecha
$fecha = date('d-m-Y');

if(!empty($_POST['id_alimento'])) {	
	if(empty($_POST['id_usuario']) or  $_POST['id_usuario'] == '') {
		//Si es un alimento original
		//primero desactivamos y luego duplicamos
		accion_desactivar ($_SESSION['id_usuario'], $_POST['id_alimento'], $fecha);
		accion_duplicar_alimento_original ($_SESSION['id_usuario'], $_POST['id_alimento'], $fecha);		
	}else{
		//no es posible que lleguen aqui pero se coloca por seguridad
		//Si no es original simplemente lo editamos
		accion_duplicar_alimento_original ($_SESSION['id_usuario'], $_POST['id_alimento'], $fecha);		
	}		
	$_SESSION['mensaje'] = 'actualizar_alimento';
	header('location:'.$url_app.'lista-alimentos');
}else{
	//Si los datos estan vacios
	$_SESSION['mensaje'] = 'datos_vacios';	
	header('location:'.$url_app.'nuevo-alimento');
}	

?>



