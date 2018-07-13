<?php
session_start();
include 'parts/conex.php';
ini_set('error_reporting', E_ALL);

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';

$total_registros = 0;
while ($post = each($_POST))
	{
		if($post[0] != 'example_length') {
			$total_registros++;
			//$post[0] . " = " . $post[1];
			//Escondemos el peso no lo eliminamos por el id
			esconder_peso_cliente ($post[0]);
		}
		//Luego de actualizar los campos regresarlo al listado
		$_SESSION['mensaje'] = 'historial_peso_eliminado';	
		header('location:'.$url_app.'lista-clientes');
	}	

//En caso de que no seleccione ningun peso	
if($total_registros == 0){
	$_SESSION['mensaje'] = 'historial_peso_no_seleccionado';	
	header('location:'.$url_app.'lista-clientes');
}


?>