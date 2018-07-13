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
if (!empty($_POST["dni_cliente"])){	
	
	$dni 				= $_POST["dni_cliente"];
	$nombre 			= $_POST["nombre_cliente"];
	$apellidos 			= $_POST["apellidos_clientes"];
	$sexo 				= $_POST["sexo"];
	$telefono_fijo		= $_POST["telefono_fijo"];
	$telefono_movil		= $_POST["telefono_movil"];
	$direccion 			= $_POST["direccion"];
	$localidad 			= $_POST["localidad"];
	$cp 				= $_POST["cp"];
	$peso 				= $_POST["peso"];
	$altura 			= $_POST["altura"];
	$fecha_nacimiento 	= $_POST["fecha_nacimiento"];
	$email 				= $_POST["email_cliente"];
	$comentarios		= $_POST["comentarios"];
	$recomendaciones	= $_POST["recomendaciones"];
	$nombre_completo	= $_POST["apellidos_clientes"].", ".$_POST["nombre_cliente"];
	$actividad			= $_POST["actividad"];
	$metabolismo		= $_POST["metabolismo"];
	$gasto 				= $_POST["gasto"];
	$imc 				= $_POST["imc"];
	$edad 				= $_POST["edad"];
	$informacion 		= $_POST["informacion"];
	$fecha_de_alta		= date('d/m/Y');
	
	//Datos Mediciones
	$bia_porc_grasa				= $_POST["bia_porc_grasa"];
	$bia_grasa_total			= $_POST["bia_grasa_total"];
	$bia_masa_grasa_total		= $_POST["bia_masa_grasa_total"];
	$bia_agua_total				= $_POST["bia_agua_total"];
	$bia_agua_intracelular		= $_POST["bia_agua_intracelular"];
	$bia_agua_extracelular		= $_POST["bia_agua_extracelular"];
	$bia_porc_masa_magra		= $_POST["bia_porc_masa_magra"];
	$bia_masa_muscular_total	= $_POST["bia_masa_muscular_total"];
	$bia_musc_brazo_dcho		= $_POST["bia_musc_brazo_dcho"];
	$bia_musc_brazo_izdo		= $_POST["bia_musc_brazo_izdo"];
	$bia_tronco					= $_POST["bia_tronco"];
	$bia_pierna_dcha			= $_POST["bia_pierna_dcha"];
	$bia_pierna_izda			= $_POST["bia_pierna_izda"];
	$bia_grasa_visceral			= $_POST["bia_grasa_visceral"];
	$perimetro_cefalico			= $_POST["perimetro_cefalico"];
	$perimetro_cuello			= $_POST["perimetro_cuello"];
	$perimetro_mesoesternal		= $_POST["perimetro_mesoesternal"];
	$perimetro_brazo_contraido	= $_POST["perimetro_brazo_contraido"];
	$perimetro_brazo_relajado	= $_POST["perimetro_brazo_relajado"];
	$perimetro_antebrazo		= $_POST["perimetro_antebrazo"];
	$perimetro_muneca			= $_POST["perimetro_muneca"];
	$perimetro_cadera			= $_POST["perimetro_cadera"];
	$perimetro_cintura			= $_POST["perimetro_cintura"];
	$perimetro_muslo			= $_POST["perimetro_muslo"];
	$perimetro_pantorrilla		= $_POST["perimetro_pantorrilla"];
	$perimetro_tobillo			= $_POST["perimetro_tobillo"];
	$ultrasonidos_grasa			= $_POST["ultrasonidos_grasa"];
	$ultrasonidos_grasa_total	= $_POST["ultrasonidos_grasa_total"];
	$ultrasonidos_masa_magra	= $_POST["ultrasonidos_masa_magra"];
	$infrarrojos_grasa			= $_POST["infrarrojos_grasa"];
	$infrarrojos_grasa_total	= $_POST["infrarrojos_grasa_total"];
	$infrarrojos_masa_magra		= $_POST["infrarrojos_masa_magra"];
	$plico_tricipital			= $_POST["plico_tricipital"];
	$plico_bicipital			= $_POST["plico_bicipital"];
	$plico_subescapular			= $_POST["plico_subescapular"];
	$plico_suprailiaco			= $_POST["plico_suprailiaco"];
	$plico_abdominal			= $_POST["plico_abdominal"];
	$plico_pectoral				= $_POST["plico_pectoral"];
	$plico_medioaxiliar			= $_POST["plico_medioaxiliar"];
	$plico_muslo 				= $_POST["plico_muslo"];
	$plico_pantorrilla			= $_POST["plico_pantorrilla"];
	$plico_suma_pliegues		= $_POST["plico_suma_pliegues"];
	$plico_porc_grasa			= $_POST["plico_porc_grasa"];
	$plico_total_grasa			= $_POST["plico_total_grasa"];
	$plico_masa_grasa			= $_POST["plico_masa_grasa"];
	$plico_densidad				= $_POST["plico_densidad"];
	
	$suma_todas_las_mediciones = 0;
	$suma_todas_las_mediciones = $bia_porc_grasa+$bia_grasa_total+$bia_masa_grasa_total+$bia_agua_total+$bia_agua_intracelular+$bia_agua_extracelular+$bia_porc_masa_magra+$bia_masa_muscular_total+$bia_musc_brazo_dcho+$bia_musc_brazo_izdo+$bia_tronco+$bia_pierna_dcha+$bia_pierna_izda+$bia_grasa_visceral+$perimetro_cefalico+$perimetro_cuello+$perimetro_mesoesternal+$perimetro_brazo_contraido+$perimetro_brazo_relajado+$perimetro_antebrazo+$perimetro_muneca+$perimetro_cadera+$perimetro_cintura+$perimetro_muslo+$perimetro_pantorrilla+$perimetro_tobillo+$ultrasonidos_grasa+$ultrasonidos_grasa_total+$ultrasonidos_masa_magra+$infrarrojos_grasa+$infrarrojos_grasa_total+$infrarrojos_masa_magra+$plico_tricipital+$plico_bicipital+$plico_subescapular+$plico_suprailiaco+$plico_abdominal+$plico_pectoral+$plico_medioaxiliar+$plico_muslo+$plico_pantorrilla+$plico_suma_pliegues+$plico_porc_grasa+$plico_total_grasa+$plico_masa_grasa+$plico_densidad;
	
	
	//Encriptar el comentario HTML
	$html= $comentarios;
	$entities_correction= htmlentities( $html, ENT_COMPAT, 'UTF-8');
	$comentarios = htmlentities( $entities_correction, ENT_COMPAT, 'UTF-8');
	
	$html2= $recomendaciones;
	$entities_correction2= htmlentities($html2, ENT_COMPAT, 'UTF-8');
	$recomendaciones = htmlentities($entities_correction2, ENT_COMPAT, 'UTF-8');
	
	//Insertar nuevo cliente y regresar el id generado
	$id_cliente = crear_nuevo_cliente ($dni, $nombre, $apellidos, $sexo, $telefono_fijo, $telefono_movil, $direccion, $cp, $localidad, $peso, $altura, $fecha_nacimiento, $email, $comentarios, $recomendaciones, $nombre_completo, $actividad, $fecha_de_alta);
	
	//Agregar al historial de pesos	
	nuevo_registro_pesox_cliente ($id_cliente, $fecha_de_alta, $peso, $edad, $informacion, $metabolismo, $gasto, $imc);
	
	//Insertar mediciones si existe una nueva
	if($suma_todas_las_mediciones >= 1){
		ingresar_nueva_medicion_cliente ($id_cliente, $fecha_de_alta, $bia_porc_grasa, $bia_grasa_total, $bia_masa_grasa_total, $bia_agua_total, $bia_agua_intracelular, $bia_agua_extracelular, $bia_porc_masa_magra, $bia_masa_muscular_total, $bia_musc_brazo_dcho, $bia_musc_brazo_izdo, $bia_tronco, $bia_pierna_dcha, $bia_pierna_izda, $bia_grasa_visceral, $perimetro_cefalico, $perimetro_cuello, $perimetro_mesoesternal, $perimetro_brazo_contraido, $perimetro_brazo_relajado, $perimetro_antebrazo, $perimetro_muneca, $perimetro_cadera, $perimetro_cintura, $perimetro_muslo, $perimetro_pantorrilla, $perimetro_tobillo, $ultrasonidos_grasa, $ultrasonidos_grasa_total, $ultrasonidos_masa_magra, $infrarrojos_grasa, $infrarrojos_grasa_total, $infrarrojos_masa_magra, $plico_tricipital, $plico_bicipital, $plico_subescapular, $plico_suprailiaco, $plico_abdominal, $plico_pectoral, $plico_medioaxiliar, $plico_muslo, $plico_pantorrilla, $plico_suma_pliegues, $plico_porc_grasa, $plico_total_grasa, $plico_masa_grasa, $plico_densidad);
	}
	
	//Eliminar grupos de alimentos por clientes	
	if (!empty($_POST["grupos_alimentos"])){	
		$grupos_alimentos=$_POST["grupos_alimentos"]; 
	}else{
		$grupos_alimentos = 0;
	}
	
	for ($i=0;$i<count($grupos_alimentos);$i++)    
	{     
		if ($grupos_alimentos[$i] != ''){	
			eliminar_grupos_alimentos_x_clientes ($grupos_alimentos[$i], $id_cliente); 
		}
	} 
	//Eliminar alimentos por clientes
	if (!empty($_POST["grupos_alimentos"])){	
		$alimentos = $_POST["alimentos"]; 
	}else{
		$alimentos = 0;
	}
	for ($i=0;$i<count($alimentos);$i++)    
	{     	
		if ($alimentos[$i] != ''){	
			eliminar_alimentos_x_clientes ($alimentos[$i], $id_cliente); 
		}
	} 
	$_SESSION['mensaje'] = 'nuevo_cliente_creado';	
	header('location:'.$url_app.'lista-clientes');
	
}else{
	//en caso que esten vacios los datos del formulario reenviamos a la pagina
	$_SESSION['mensaje'] = 'datos_vacios_cliente';	
	header('location:'.$url_app.'crear-cliente');
}

?>