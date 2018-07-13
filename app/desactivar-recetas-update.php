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
foreach($_POST as $campo => $valor) 
{			
	if($campo != 'accion' and $campo !='example_length'){			
		if(is_numeric($campo)) {		
			gx_desactivar_recetas ($campo);
		}
		$contador++;
	}
}

if($contador >=1){	
	$_SESSION['todas_las_recetas_desactivadas_por_el_usuario']  = gx_todas_las_recetas_desactivadas_por_el_usuario();
	$_SESSION['todas_las_recetas_desactivadas_por_el_usuario_sql']  = gx_todas_las_recetas_desactivadas_por_el_usuario_sql();
	$_SESSION['mensaje'] = 'recetas_desactivadas';
	header('location:'.$url_app.'lista-recetas');	
}else{
	//Si los datos estan vacios
	$_SESSION['mensaje'] = 'datos_vacios';	
	header('location:'.$url_app.'lista-recetas');
}

?>