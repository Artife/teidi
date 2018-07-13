<?php
session_start();
session_destroy();
require('parts/conex.php');

//Url del dominio
$url_dominio = $_SERVER['HTTP_HOST'];

//Url de la pagina que se esta ejecutando
$url_especifica = $_SERVER['REQUEST_URI'];

//Url donde se estan ejecutando las paginas de la aplicacion
if($url_dominio == 'localhost'){
	$url_app = 'http://'.$url_dominio.'/idiet/app/';
}else{
	$url_app = 'https://'.$_SERVER['HTTP_HOST'].'/prueba/app/';	
}

//Titulo estandar de la web
$titulo = 'i-Diet: software nutricional profesional | ';

//Url Menu

$url_menu_larga = substr($_SERVER['REQUEST_URI'], 5);

$menu_posicion = strpos($url_menu_larga, '/');

if($menu_posicion != ""){ 	
	$url_menu = substr($url_menu_larga, 0, $menu_posicion); 
}else{
	$url_menu = $url_menu_larga;		
}


$Pagina = 'Acceso Denegado';



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
?>

	<!DOCTYPE html>
	<html>

	<head>
	<meta name="robots" content="noindex, nofollow">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>i-Diet: software nutricional profesional | <?php echo $Pagina; ?></title>
	<link rel="icon" type="image/png" href="<?php echo $url_app; ?>img/favicon.png" />
	<meta name="description" content="Primer programa del mercado en incorporar Inteligencia Artificial en sus cálculos. Dietas profesionales en solo 3 PASOS.">
	<meta name="keywords" content="diet, dietas, programa dietas, i-diet, dietas profesionales, software dietas, hacer dietas, elaborar dietas, dietas sencillas, dietas fácil, salud, nutrición, dietista, nutricionista, endocrino, adelgazar, dietistas-nutricionistas, comer con cabeza, comer sano, comer bien, Ramon de Cangas, programa Ramon de Cangas, dietas Ramon de Cangas, inteligencia y nutricion, dietas baratas">
	<meta name="author" content="Gestión de Salud y Nutrición S.L.">

    <link href="<?php echo $url_app; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $url_app; ?>font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo $url_app; ?>css/animate.css" rel="stylesheet">
    <link href="<?php echo $url_app; ?>css/style.css" rel="stylesheet">
	<style>
		.gray-bg, .bg-muted {
			background-image: url("<?php echo $url_app;?>img/fondo-imagen-idiet-banner.jpg");
			background-size: cover;
			background-position: center;
			background-repeat: no-repeat;	
		}
		.img_logo {
				width: 20%;		
		}	
		p, h3, a {
			color: #ffffff;
		}
		a:hover {
			color: #86B404;
		}	
		@media (max-width: 768px) {
			.img_logo {
				width: 70%;		
			}	
		}
	</style>
</head>

<body class="gray-bg">
	<div class="text-center animated fadeInDown">
		<img class="img_logo" src="<?php echo $url_app; ?>img/logo-idiet-login.png" />
	</div>
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <h2 style="color:#fff"><strong>Acceso Denegado</strong></h2><br><br>			
			<p><a href="<?php echo vinculo('index'); ?>"> Volver al login</a></p><br><br>
            <p>El software nutricional que simplifica tu trabajo</p>
            <p class="m-t"> <small>i-Diet. <br />Todos los derechos reservados. <br />Act. septiembre 2016</small> </p>
        </div>
		
    </div>	
    <!-- Mainly scripts -->
    <script src="<?php echo $url_app; ?>js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo $url_app; ?>js/bootstrap.min.js"></script>

</body>

</html>