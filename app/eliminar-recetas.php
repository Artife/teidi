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
$id_receta_nuevo = '';
$contador = '';
foreach($_POST as $campo => $valor) {
	if(!empty($campo) && $campo != 'example_length'){	
		if(is_numeric($campo)) {
			gx_eliminar_recetas ($campo);
			$contador++;
		}	
	}
}	


if($contador != '') {			
	$_SESSION['todas_las_recetas_desactivadas_por_el_usuario']  = gx_todas_las_recetas_desactivadas_por_el_usuario();
	$_SESSION['todas_las_recetas_desactivadas_por_el_usuario_sql']  = gx_todas_las_recetas_desactivadas_por_el_usuario_sql();
	$_SESSION['mensaje'] = 'eliminar_recetas';
	header('location:'.$url_app.'lista-recetas-desactivadas');	
}else{
	$_SESSION['mensaje'] = 'datos_vacios';	
	header('location:'.$url_app.'lista-recetas-desactivadas');
}	

?>



