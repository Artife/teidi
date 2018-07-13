<?php
//Url del dominio
$url_dominio = $_SERVER['HTTP_HOST'];
$ubicacion_local = 'oficina';
//Url de la pagina que se esta ejecutando
$url_especifica = $_SERVER['REQUEST_URI'];

//Url donde se estan ejecutando las paginas de la aplicacion
if($url_dominio == 'localhost'){
	if($ubicacion_local == 'oficina'){
		$url_app = 'http://'.$url_dominio.'/idiet/app/';
	}else{
		$url_app = 'http://'.$url_dominio.'/idietprueba/app/';
	}
}else{
	$url_app = 'https://'.$_SERVER['HTTP_HOST'].'/prueba/app/';	
	$upe = '/';
}

if($_SERVER['REQUEST_URI'] == '/idiet/app/index' || $_SERVER['REQUEST_URI'] == '/prueba/app/index' || $_SERVER['REQUEST_URI']  == '/idietprueba/app/') {}else{

//Explusar si no realizo login
if (!isset($_SESSION['login'])) { header('location: '.$url_app.'index/4' ); }

if (in_array($_SESSION['role'], $acceso_roles)) { }else{  header('Location: '.$url_app.'acceso-denegado' ); }

}



function vinculo ($url){	
	switch ($_SERVER['HTTP_HOST']) {
		case 'localhost':
			$url = $url;
			break;
		default:
			$url = $url.'/';
	}
	return $url;
}

function vinculo_completo($url){	
	switch ($_SERVER['HTTP_HOST']) {
		case 'localhost':
			$url = $url;			
			$url_app = 'http://'.$_SERVER['HTTP_HOST'].'/idiet/app/'.$url;	
			break;
		case 'otro_server':
			$url = $url.'/';			
			$url_app = 'http://'.$_SERVER['HTTP_HOST'].'/idiet/app/';
			break;	
		default:
			$url = $url;
			$url_app = 'https://'.$_SERVER['HTTP_HOST'].'/prueba/app/'.$url;	
	}
	return $url_app;
}

?>