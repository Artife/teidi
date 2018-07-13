<?php
//Configuracion

require 'myurls.php';
ini_set('error_reporting', E_ALL);

date_default_timezone_set("Europe/Madrid");
setlocale(LC_ALL,"es_ES");
$titulo = ' i-Diet: Software nutricional profesional';

//Configuracion de los usuarios 
//Consultamos si tiene cambios en el diseno
	$sql = "SELECT * FROM `gx_configuracion_app` 
	WHERE id_usuario = '".$_SESSION['id_usuario']."'";	
	$result = mysqli_query($_SESSION["conexion"], $sql) or die(mysqli_error($_SESSION["conexion"]));
	$tota_registros_config = $result->num_rows;	
		if ($tota_registros_config >= 1) {		
			while($row = $result->fetch_assoc()) {	
				$size_body				= $row["size_body"];
				$size_h1				= $row["size_h1"];
				$size_h2				= $row["size_h2"];
				$size_h3				= $row["size_h3"];
				$color_body				= $row["color_body"];
				$color_hs				= $row["color_hs"];
				$idiet_status_textos	= $row["status_textos"];
 				$tabla_lista			= $row["tabla_lista"];
				$size_tabla				= $row["size_tabla"];
				$color_tabla			= $row["color_tabla"];
				$idiet_status_tabla		= $row["status_tabla"];
			}
		}			

?>