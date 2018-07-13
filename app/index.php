<?php 
session_start();
session_destroy();


require 'parts/myurls.php';

$error = substr($_GET['id'], 0, 1);  

?>
<!DOCTYPE html>
<html>

<head>
	<meta name="robots" content="noindex, nofollow">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>i-Diet: software nutricional profesional | Login</title>
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
            <h3>Bienvenido</h3>
            <p>El software nutricional que simplifica tu trabajo
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
            </p>
            <p>Login</p>
            <form class="m-t" role="form" action="<?php echo $url_app; ?>validar" method="post">
                <div class="form-group">
                    <input type="email" name="login" class="form-control" placeholder="E-mail" required="" autocomplete="on">					
                </div>
                <div class="form-group">
                    <input type="password" name="contrasena" class="form-control" placeholder="Contraseña" required=""  autocomplete="on">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Aceptar</button>

                <a href="#"><small>Recuperar contraseña</small></a>                
            </form>
            <p class="m-t"> <small>i-Diet. <br />Todos los derechos reservados. <br />Act. septiembre 2016</small> </p>
        </div>
		
    </div>
	<?php if (isset($error) && $error == 1) {?>
	<div class="widget red-bg  text-center">
			<div class="m-b-md">
				<h3 class="font-bold no-margins">
					Error
				</h3>
				<small>El E-mail o Contraseña son incorrectos</small>
			</div>
	</div>
	<?php } ?>
	<?php if (isset($error) && $error == 2) {?>
	<div class="widget red-bg  text-center">
			<div class="m-b-md">
				<h3 class="font-bold no-margins">
					Error
				</h3>
				<small>Los datos campos E-mail y Contraseña estaban vacios</small>
			</div>
	</div>
	<?php } ?>
	<?php if (isset($error) && $error == 3) {?>
	<div class="widget red-bg  text-center">
			<div class="m-b-md">
				<h3 class="font-bold no-margins">
					Error
				</h3>
				<small>Sesión Cerrada</small>
			</div>
	</div>
	<?php } ?>
	<?php if (isset($error) && $error == 4) {?>
	<div class="widget red-bg  text-center">
			<div class="m-b-md">
				<h3 class="font-bold no-margins">
					Mensaje
				</h3>
				<small>La sesión fue cerrada con éxito</small>
			</div>
	</div>
	<?php } ?>
    <!-- Mainly scripts -->
    <script src="<?php echo $url_app; ?>js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo $url_app; ?>js/bootstrap.min.js"></script>

</body>

</html>
