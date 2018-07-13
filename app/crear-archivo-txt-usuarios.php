<?php  
session_start();
include 'parts/conex.php';

//Solo permitir acceso a estos roles
$acceso_roles = array('admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include 'parts/consultas_mysql.php';
include 'parts/ayuda.php';

	$query = "SELECT * FROM `gx_usuarios`";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($connection));	
	$total_filas = mysqli_num_rows($result);
	
	
	//Ejecutar texto plano
	$total_filas = mysqli_num_rows($result);
	
	$html = ''; 
	$html .='{ "aaData": [';
	$i = 0;
	while($row = $result->fetch_assoc()) {
		
		$input = "<div class='checkbox checkbox-success'>";
		$input .= "<input id='".$row['id_usuario']."' type='checkbox' name='".$row['id_usuario']."' class='marcar'>";
		$input .= "<label for='".$row['id_usuario']."'></label>";
		$input .= "</div>";
		
		//Role
		if ($row['role'] == 'usuario') {	 
			$role	= 'Normal';
		}else{
			$role	= $row['role'];
		}
		
		//activo
		if($row['activo'] == '1'){
			$activo = "Activo";
		}else{
			$activo = "Desactivado";
		}
		
		//Nombre url		
		$nombre = "<a href='".$url_app."actualizar-usuario/".$row['id_usuario']."'>".salida_nombre($row['nombre'])."</a>";
		$i++;
		
		//Fechas
		$fecha_inicio =  date('d/m/Y', strtotime($row['fecha_inicio']));
		$fecha_fin =  date('d/m/Y', strtotime($row['fecha_fin']));
		
		//$observaciones = crear_cadena_amigable($row['observaciones']);
		// $observaciones = '';
		
		$html .='[ "'.$input.'", "'.$nombre.'", "'.$row['login'].'", "'.$row['email'].'", "'.$role.'", "'.$activo.'", "'.$fecha_inicio.'", "'.$fecha_fin.'", "'.gx_mostrar_observaciones($row['observaciones']).'",  "'.$row['dni'].'", "'.$row['poblacion'].'", "'.$row['direccion'].'", "'.$row['provincia'].'", "'.$row['forma_pago'].'", "'.$row['iban'].'", "'.$row['colegio'].'", "'.$row['numero_colegiado'].'", "'.$row['fecha_registro'].'" ],';	
	}
	
	//Quitamos la ultima de la fila
	$html = substr($html, 0, -3); 
	
	$html .=']] }';
	
	if($total_filas == ""){			
			$html ='{ "aaData": [[ "'.$input.'", " Sin registros", "", "", "", "", "", "", "" ]] }';				
	}
	echo $html;	
?>