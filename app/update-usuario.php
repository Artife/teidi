<?php
session_start();
include 'parts/conex.php';

//Solo permitir acceso a estos roles
$acceso_roles = array('admin');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';



//Validamos que los datos del formulario estan llenos
if ($_POST["id_usuario"] != ''){
	
	
	//Valores		
	//Cambiar formato de las fechas
	//Fecha inicio
	$fecha_aux = explode("/", $_POST["fecha_inicio"]);
	$fecha_inicio = $fecha_aux[2]."-".$fecha_aux[1]."-".$fecha_aux[0];
	
	//Fecha fin
	$fecha_aux = explode("/", $_POST["fecha_fin"]);
	$fecha_fin = $fecha_aux[2]."-".$fecha_aux[1]."-".$fecha_aux[0];
	
	//Si el pago es por paypal obviar el iban
	if($_POST["forma_pago"] == 'PayPal') {
		$iban = '';
	}else{
		$iban =  $_POST["iban"];
	}
	//Activo
	$activo = 0;
	if(isset($_POST["activo"])){
		if($_POST["activo"] == 'on'){
			$activo = 1;
		}else{
			$activo = 0;
		}
	}
	$observaciones = htmlentities($_POST["observaciones"]);
	//Insertar usuario
	actualizar_usuario ($_POST["id_usuario"], entrada_nombre($_POST["nombre"]),$_POST["dni"],entrada_nombre($_POST["role"]),$activo,
	entrada_nombre($_POST["direccion"]),entrada_nombre($_POST["poblacion"]),entrada_nombre($_POST["forma_pago"]),$iban,entrada_nombre($_POST["colegio"]),entrada_nombre($_POST["numero_colegiado"]),entrada_nombre($observaciones),entrada_nombre($_POST["provincia"]),$fecha_inicio,$fecha_fin);
	
	// echo actualizar_usuario;	
	/*
	//Enviar correo con el pass luego de ser confirmado
	if($_POST["confirmar"] == 'on'){
		$para = "artife@gmail.com";
		$asunto = "Bienvenido a i-Diet";
		$msg ='
		<html>
		<head>
		<title>Bienvenido a i-Diet</title>
		</head>
		<body>

		<h1 style="font-family: idiet; background-color: #57244C; color:white; padding: 10px; padding-left:25px;"><font color="#AEC91B">i-</font>Diet</h1>

		<div style="color: #57244C; padding:25px; padding-bottom: 0; padding-top: 10px;">
			<b>Hola '.$_POST["nombre"].'</b>
			<br><br>Bienvenido a i-Diet estamos creando tu cuenta de usuario al momento que confirmemos el pago te haremos llegar por correo tu usuario y contraseña para entrar en la aplicación 
			<a style="color:#57244C;" href="mailto:atencionclientes@i-diet.mx?Subject=Duda%20i-Diet" target="_top">atencionclientes@i-diet.mx</a>
			 o ll&aacute;manos al <b>984 24 07 05</b>

			<h2 style="font-family: idiet; margin-bottom: 0;">
				Gracias por confiar en <font color="#AEC91B">i-</font>Diet
			</h2>
			<p style="text-align: right; font-size: x-small;">
				Condiciones legales disponibles en la web
			</p>
		</div>

		<h3 style="font-family: idiet; background-color: #57244C; color:white; padding: 5px; text-align:right; margin:0; padding-right: 40px;">
			<font color="#AEC91B">i-</font>Diet &copy;
		</h3>

		</body>
		</html>
		';

		// Para enviar un correo HTML, debe establecerse la cabecera Content-type
		$cabeceras = "From: atencionclientes@i-diet.es\r\n";
		$cabeceras .= 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		mail ($para, $asunto, $msg, $cabeceras);
	}
	*/	
	$_SESSION['mensaje'] = 'usuario_actualizado';	
	header('location:'.vinculo_completo('lista-usuarios'));	
}else{
	$_SESSION['mensaje'] = 'usuario_error';		
	header('location:'.vinculo_completo('actualizar-usuario'));	
}


?>