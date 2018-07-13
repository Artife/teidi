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
			// echo $campo;
			// echo "<br>";
			$id_receta_nuevo = gx_duplicar_recetas ($campo);
			$contador++;
		}	
	}
}	



if($contador != '') {			
	$_SESSION['mensaje'] = 'duplicar_recetas';
	header('location:'.$url_app.'lista-recetas');	
}else{
	$_SESSION['mensaje'] = 'datos_vacios';	
	header('location:'.$url_app.'lista-recetas');
}	

?>



