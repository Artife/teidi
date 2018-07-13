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

	if($_POST["descripcion"] != ''){
	//Insertar el nuevo ticket
	ticket_seguimiento($_POST["ticket"], $_POST["status"], $_POST["titulo"], $_POST["prioridad"], $_POST["descripcion"]);
	
	//Cambiamos todos los status de los tickets de seguimiento	
	cambiar_todos_los_status($_POST["ticket"], $_POST["status"]);	
	
		header('location:'.$url_app.'ticket/t1');
	}else{		
		header('location:'.$url_app.'ticket/t2');
	}
}else{
	//en caso que esten vacios los datos del formulario reenviamos a la pagina
	header('location:'.$url_app.'ticket/t3');	
}



?>
