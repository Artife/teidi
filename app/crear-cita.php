<?php
session_start();
include 'parts/conex.php';
$pagina = 'Crear cita';

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include 'parts/consultas_mysql.php';

$total_registros = 0;
if(!empty($_POST["inicio"])){
//Modificamos todas las variables para ver los id seleccionados	
	$inicio 			= $_POST["inicio"];	
	$inicio_dia 		= substr($inicio, 0,2); 		
	$inicio_mes			= substr($inicio, 3, 2); 		
	$inicio_ano 		= substr($inicio, 6, 4); 		
	$hora_inicio 			= $_POST["hora"];	
	$inicio_hora 		= substr($hora_inicio, 0, 2);		
	$inicio_min 		= substr($hora_inicio, 3, 2);
	
	
	
	$segundos_horaInicial=strtotime(substr($_POST["inicio"], 11));
	$segundos_minutoAnadir=$_POST["fin"]*60;
	$nuevaHora = date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
	
	$fin 	  			= substr($_POST["inicio"], 0, 10).' '.$nuevaHora;
	$fin_dia 			= substr($fin, 0,2); 
	$fin_mes 			= substr($fin, 3, 2); 
	$fin_ano            = substr($fin, 6, 4); 
	$fin_hora 			= substr($fin, 11, 2);	
	$fin_min 			= substr($fin, 14, 2);
	$titulo 			= $_POST["titulo"];	
	$tipo_cita 			= $_POST["tipo_cita"];	
		
	foreach($_POST as $variable => $id_usuario)  {	
		//Validamos que no esten vacias las variables
		if(!empty($id_usuario)){			
			//Si todos los datos estan correctos agregamos la cita
			if($id_usuario == 'on'){
				insertar_nuevas_citas($variable, $inicio, $inicio_dia, $inicio_mes, $inicio_ano, $inicio_hora, $inicio_min, $fin, $fin_dia, $fin_mes, $fin_ano, $fin_hora, $fin_min, $titulo, $tipo_cita);
				$total_registros++;
			}
		}
	}
	if($total_registros == 0){
		//Sin datos
		$_SESSION['mensaje'] = 'seleccionar_cliente';			
		header('location:'.$url_app.'agenda');
		
	}else{
		$_SESSION['mensaje'] = 'nueva_citas';			
		header('location:'.$url_app.'agenda');	
		
	} 
}else{
	//Sin datos
	$_SESSION['mensaje'] = 'datos_vacios';	
	header('location:'.$url_app.'agenda');
	
}

?>