<?php
	session_start();
	require('../parts/conex.php');
	require_once('tcpdf/config/lang/eng.php');
	require_once('tcpdf/tcpdf.php');
	
	$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');
	include_once '../parts/configuracion.php';
	include_once '../parts/ayuda.php';
	include '../parts/consultas_mysql.php';
	
	
	//->Datos de la clinicas/
	$datos_clinica = datos_clinica();
	$id_cliente = '1340';
	
	//->Datos del cliente
	$cliente = obtener_datos_cliente_x_usuario ($id_cliente);	
	
	//->Obtener grupos excluidos
	$grupos_excludios = obtener_grupos_excluidos_x_cliente($id_cliente);
	
	//->Total grupos excluidos
	$total_grupos_exculidos = count($grupos_excludios);
	
	//->Obtener grupos
	$grupos_alimentos = mostrar_grupos_alimentos(); 
	
	//->Obtener alimentos excluidos
	$alimentos_excluidos = obtener_alimentos_excluidos_x_cliente($id_cliente);
	
	//->Obtener alimentos
	$alimentos_activos = listado_de_alimentos_completo(); 
	
	//-> Nombre del archivo
	$nombre_archivo = 'Dieta | '.$cliente['nombre'].' '.$cliente['apellidos'].' Fecha: '.date('d-m-Y');
	
	//-<Consultar la ultima dieta guardada	
	$consulta_de_dieta = gx_consultar_ultima_dieta_guardada(); 
	
	print_r($consulta_de_dieta);
	
	// echo "<br><br><br><br><br><br><br>";
	/*
	for ($i = 0; $i <= 800; $i++) {							
	if(!empty($alimentos_activos[$i]['id_definitivo'])){			
		// echo $alimentos_activos[$i]['id_definitivo'];
		// echo "<br>";
		if (in_array($alimentos_activos[$i]['id_definitivo'],  $alimentos_excluidos)) {
			echo '<br>'.$i;	
			// echo utf8_encode($alimentos_activos[$i]['id_definitivo']).', ';							
		}
	} */
	
	
// }
?>