<?php
session_start();
include 'parts/conex.php';
// ini_set('error_reporting', E_ALL);
//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include 'parts/ayuda.php';
include_once 'parts/configuracion.php';
include 'parts/consultas_mysql.php';


$id  = $_POST['id_receta_editada'];
$receta = obtener_receta($id);	

if ($receta['origen'] == 'i-Diet') { 
	//si es original
	$nuevo_id = receta_temporal_a_receta($id);
	
	gx_alimento_receta_editadas_a_gx_alimento_receta($id, $nuevo_id);
	
	
	
}else  {
	//si es ya del cliente
	$nuevo_id = receta_temporal_a_receta_edit($id);
	
	gx_alimento_receta_editadas_a_gx_alimento_receta_edit($id, $nuevo_id);
}

borrar_ingredientes_tabla_temporal($id);
borrar_gx_recetas_editadas($id);
$_SESSION['mensaje'] = 'receta_editada';
header('location:'.$url_app.'lista-recetas');

//Fecha
/*
$fecha = date('d-m-Y');
if(!empty($_POST['id_alimento'])) {		
	if($_POST['id_usuario'] == 0) {		
		//Si es un alimento original lo duplicamos solamente 
		gx_duplicar_alimento_original ($_POST['id_alimento']);		
	}	
	$_SESSION['mensaje'] = 'receta_editada';
	header('location:'.$url_app.'lista-alimentos');
}else{
	$_SESSION['mensaje'] = 'datos_vacios';	
	header('location:'.$url_app.'lista-alimentos');
}	
*/
?>



