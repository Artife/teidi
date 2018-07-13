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

//Agregar la accion a la tabla de alimentos editados
$accion	= 'Actualizado';

if(!empty($_POST['accion'])) {
	//Crea alimento nuevo
	if($_POST['accion'] == 'Desactivado') {
		$_SESSION['mensaje'] = 'desactivar_alimento';
		while ($post = each($_POST))
		{			
			if($post[0] != 'accion' and $post[0] !='example_length'){
				accion_desactivar ($_SESSION['id_usuario'], $post[0], $fecha);
			}
		}
		$_SESSION['mensaje'] = 'desactivar_alimentos';		
		header('location:'.vinculo_completo('lista-alimentos'));	
	}
	if($_POST['accion'] == 'Duplicado') {
		
		//echo "duplicar";
		
		while ($post = each($_POST))
		{				
			if($post[0] != 'accion' and $post[0] !='example_length'){						
				accion_duplicar_alimento ($_SESSION['id_usuario'], $post[0], $fecha);
			}
			
		}	
		$_SESSION['mensaje'] = 'duplicar_alimentos';
		header('location:'.vinculo_completo('lista-alimentos'));	
	}			
}else{
	//Si los datos estan vacios
	$_SESSION['mensaje'] = 'datos_vacios';		
	header('location:'.vinculo_completo('nuevo-alimento'));	
}	

?>



