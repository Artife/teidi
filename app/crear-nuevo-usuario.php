<?php
session_start();
include 'parts/conex.php';


//Solo permitir acceso a estos roles
$acceso_roles = array('admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';

//Validamos que los datos del formulario estan llenos
if (!isset($_POST["email"]) || $_POST["email"] != ''){
	
	//Revisamo que no exista ya el login
	$where = "WHERE login = '".$_POST["email"]."'";
	$duplicado = listado_de_usuarios($where) ;	 
	 
	if(empty($duplicado)){
		
		//Valores
		//Generar pass
		$contrasena = generar_contrasena();
		
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
		if($_POST["activo"] == 'on'){
			$activo = 1;
		}else{
			$activo = 0;
		}
		$dni = limpiar_dni($_POST["dni"]);
		$nombre = limpiar_nombres($_POST["nombre"]);
		
		//Insertar usuario
		nuevo_usuario (entrada_nombre($nombre),$dni,$_POST["email"],$contrasena,entrada_nombre($_POST["role"]),$activo, $fecha_inicio,$fecha_fin,
		entrada_nombre($_POST["direccion"]),entrada_nombre($_POST["poblacion"]),entrada_nombre($_POST["forma_pago"]),$iban,entrada_nombre($_POST["colegio"]),$_POST["numero_colegiado"],entrada_nombre($_POST["observaciones"]),entrada_nombre($_POST["provincia"]));
		
		
		/*
		//Enviar correo de bienvenida con el pass
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
		*/
		$_SESSION['mensaje'] = 'usuario_nuevo_creado';			
		header('location:'.vinculo_completo('lista-usuarios'));	
		
	}else{
		//en caso de existir el login lo reenviamos con el error de login duplicado		
		$_SESSION['mensaje'] = 'usuario_duplicado';	
		header('location:'.vinculo_completo('lista-usuarios'));	
	}
	
}else{
	//en caso que esten vacios los datos del formulario reenviamos a la pagina
	$_SESSION['mensaje'] = 'datos_vacios';	
	header('location:'.vinculo_completo('lista-usuarios'));	
}

?>