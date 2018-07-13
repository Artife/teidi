<?php
session_start();
include 'parts/conex.php';

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';

//Primera parte textos y titulos
$tipo_configuracion = $_POST["tipo_configuracion"];

//Se hacen los cambios del texto
if($tipo_configuracion == 'textos'){
	
		// $restablecer 		= $_POST["restablecer"];
		// $guardar 			= $_POST["guardar"];
	
	//Se guardar los datos del sistema
	if(!empty($_POST["guardar"])){
		if($_POST["guardar"] == 'guardar'){
			$size_body 		= $_POST["tamano_fuente_codigo"];
			$size_h1		= $_POST["tamano_titulo_codigo"];
			$size_h2 = $size_h1-2;
			$size_h3 = $size_h1-4;
			$color_body 		= $_POST["color_fuente_codigo"];
			$color_hs 			= $_POST["color_titulo_codigo"];
			guardar_configuracion_app($_SESSION['id_usuario'], $size_body, $size_h1, $size_h2, $size_h3, $color_body, $color_hs);		
			$_SESSION['mensaje'] = 'cambiar_textos';	
			header('location:'.$url_app.'configuracion');	
		}
	}
	if(!empty($_POST["restablecer"])){
		if($_POST["restablecer"] == 'restablecer'){
			restablecer_configuracion_app($_SESSION['id_usuario']);
			$_SESSION['mensaje'] = 'cambiar_textos';	
			header('location:'.$url_app.'configuracion');	
		}
	}
}

//formato de la tabla
if($tipo_configuracion == 'formato_tabla'){
	//Se guardar los datos del sistema
	if(!empty($_POST["guardar"])){
		if($_POST["guardar"] == 'guardar'){
			$tabla_lista 		= $_POST["filtro_origen"];	
			$size_tabla 		= $_POST["size_tabla"];	
			$color_tabla 		= $_POST["color_tabla_codigo"];	
			
			guardar_formato_tabla($_SESSION['id_usuario'], $tabla_lista, $size_tabla, $color_tabla);		
			$_SESSION['mensaje'] = 'cambiar_textos';	
			header('location:'.$url_app.'configuracion');	
		}
	}
	if(!empty($_POST["restablecer"])){	
		if($_POST["restablecer"] == 'restablecer'){
			restablecer_formato_tabla($_SESSION['id_usuario']);
			$_SESSION['mensaje'] = 'cambiar_textos';	
			header('location:'.$url_app.'configuracion');	
		}
	}
}
if($tipo_configuracion == 'datos_clinica'){
	
	// echo "si";
	$clinica_nombre 		= entrada_nombre($_POST["clinica_nombre"]);	
	$clinica_direccion 		= entrada_nombre($_POST["clinica_direccion"]);	
	$clinica_localidad 		= entrada_nombre($_POST["clinica_localidad"]);	
	$clinica_telefono 		= $_POST["clinica_telefono"];	
	$msg ='';
	$uploadedfileload="true";
	$uploadedfile_size=$_FILES['files']['size'];	
	// $_FILES['files']['name'][0] = rand().'.jpg';
	$nombre_temporal_img = $_FILES['files']['name'][0];			
	if ($_FILES['files']['size'][0]>20000000){
		//$msg=$msg."El archivo es mayor que 200KB, debes reduzcirlo antes de subirlo<BR>";
		$uploadedfileload="false";			
		$_SESSION['mensaje'] = 'imagen_subir_imagen'; 	
		// echo $error_imagen ='si';
	}	
	// print_r($_FILES[files][size]);
	// print_r($_FILES[files]);
	$_FILES['files']['type'][0] = strtolower($_FILES['files']['type'][0]);
	
	if (!($_FILES['files']['type'][0] =="image/jpeg" || $_FILES['files']['type'][0] =="image/jpg"))
	{
		
		$msg=$msg." Estás intentando subir un archivo ".$_FILES['files']['type'][0].". Tu archivo debería ser JPG. Otros extensiones no son válidas<br>";
		$uploadedfileload="false";
		$error_imagen ='si';
		$_SESSION['mensaje'] = 'imagen_subir_imagen_tipo_archivo'; 	
	}
	
	
	$file_name=$_FILES['files']['name'][0];	
	$nombre_temporal_img = $_SESSION['id_usuario'].'-'.$file_name;
	$add="img/clinicas/".$_SESSION['id_usuario'].'-'.$file_name;
	$nombre_logo = $_SESSION['id_usuario'].'-'.$file_name;
	$uploadedfileload;
	if($uploadedfileload=="true"){	
		
		//$_FILES['files']['tmp_name'][0] = $nombre_temporal_img;
		if(move_uploaded_file ($_FILES['files']['tmp_name'][0], $add)){
			// echo " Ha sido subido satisfactoriamente";							
		}else{
			// echo "Error al subir el archivo";
			$error_imagen ='si';
			$_SESSION['mensaje'] = 'imagen_subir_imagen'; 	
		}
		
		//Guardar los datos si la imagen es correcta	
		//Primero consultamos que no exista ningun registro anterior	
		$datos_clinica = datos_clinica($_SESSION['id_usuario']);
		if ($uploadedfileload=="false" and $datos_clinica['logo'] == ''){
			$nombre_logo = '';
		}
		if ($uploadedfileload=="false" and $datos_clinica['logo'] != ''){
			$nombre_logo = $datos_clinica['logo'];
		}	
		if($datos_clinica['id_usuario'] == ''){		
			//Si no exite registro hacemos un insert		
			guardar_datos_clinica($_SESSION['id_usuario'], $clinica_nombre, $clinica_direccion, $clinica_localidad, $clinica_telefono, $nombre_temporal_img);				
		}else{
			//Si existe el registro hacemos un update		
			actualizar_datos_clinica($_SESSION['id_usuario'], $clinica_nombre, $clinica_direccion, $clinica_localidad, $clinica_telefono, $nombre_temporal_img);		
		}	
		if($datos_clinica['logo'] == '' AND $uploadedfileload=="false") {
			$_SESSION['mensaje'] = 'datos_clinica_error_imagen'; 
		}else{
			$_SESSION['mensaje'] = 'datos_clinica'; 	
		}
		header('location:'.$url_app.'configuracion');	
		
	}else{				
		// echo $error_imagen ='error al subir imagen';
		$_SESSION['img_error_text'] = 'Error al subir la imagen '.$msg;
		$_SESSION['mensaje'] = 'imagen_subir_imagen'; 	
		header('location:'.$url_app.'configuracion');		
	}
}	


?>