<?php
session_start();
include 'parts/conex.php';

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';



//Validamos que los datos del formulario estan llenos
if ($_SESSION['id_usuario']!= '' && isset($_POST["pass_actual"])  && isset($_POST["pass_nuevo"]) && isset($_POST["repetir_pass_nuevo"])){
	
	$pass_actual 			= strip_tags($_POST["pass_actual"]);
	$pass_nuevo 			= strip_tags($_POST["pass_nuevo"]);
	$repetir_pass_nuevo 	= strip_tags($_POST["repetir_pass_nuevo"]);
	
	
	if ($_SESSION['contrasena'] == crypt($pass_actual, $_SESSION['contrasena'])){
		
		//Validamos que los 2 pass sean iguales
		if ($pass_nuevo === $repetir_pass_nuevo){
			
			cambiar_password($_SESSION['id_usuario'], $pass_nuevo);			
			//El pass fue cambiado con exito
			$_SESSION['mensaje'] = 'cambiar_contrasena';	
			header('location:'.$url_app.'cambiar-password');
		}else{
			//los pass no coinciden
			$_SESSION['mensaje'] = 'las_contrasenas_no_coinciden';	
			header('location:'.$url_app.'cambiar-password');
		}
	}else{
		//Pass actual incorrecto
		$_SESSION['mensaje'] = 'la_contrasena_actual_es_incorrecta';	
		header('location:'.$url_app.'cambiar-password');
	}	
}else{
	//en caso que esten vacios los datos del formulario reenviamos a la pagina
	$_SESSION['mensaje'] = 'datos_vacios';	
	header('location:'.$url_app.'cambiar-password');
	
}
//Errores
/*
1 = formulario vacios
3 = todo correcto
 
*/


?>