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
if ($_POST["supergrupo"] != ''){		
		
	// Insertar la nueva regla
	gx_crear_nueva_regla($_POST["min_unidades"], $_POST["max_unidades"], $_POST["supergrupo"], $_POST["frecuencia"]);
	
	//Desactivamos la regla original
	gx_desactivar_reglas($_POST["id_regla"]);
	
	$_SESSION['todas_las_reglas_desactivadas_por_el_usuario_sql']  = gx_todas_las_reglas_desactivadas_por_el_usuario_sql();
		
	$_SESSION['mensaje'] = 'nueva_regla';
	header('location:'.$url_app.'lista-reglas');		
}else{
	//en caso que esten vacios los datos del formulario reenviamos a la pagina
	$_SESSION['mensaje'] = 'datos_vacios';
	header('location:'.$url_app.'nueva-regla');	
}



?>
