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
if ($_POST["titulo"] != ''){	
	if(strlen(trim($_POST["descripcion"])) > 5){
		
		// Insertar el nuevo ticket
		crear_nuevo_ticket($_POST["status"], $_POST["titulo"], $_POST["prioridad"], $_POST["descripcion"]);
		
		if($_POST["status"] == 'Pendiente'){
			header('location:'.$url_app.'soporte/m1');
		}
		if($_POST["status"] == 'En espera'){
			header('location:'.$url_app.'soporte/m1');
		}
		if($_POST["status"] == 'Resuelto'){
			header('location:'.$url_app.'soporte/m1');
		}
	}else{
		header('location:'.$url_app.'crear-ticket/t1');
	}
}else{
	//en caso que esten vacios los datos del formulario reenviamos a la pagina
	header('location:'.$url_app.'soporte/1');	
}



?>
