<?php  
session_start();
include 'parts/conex.php';


//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/ayuda.php';
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';

	// if(empty($where)) {$where = ' } 
	
	//consulta de clientes
	$query = "SELECT * FROM `gx_clientes` WHERE id_usuario='".$_SESSION['id_usuario']."' AND status = 1";	

	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($connection));
	
	
	//Ejecutar texto plano
	$i = 0;
	$html = ''; 
	$html .='{ "aaData": [';
	while($row = $result->fetch_assoc()) {		
		$mostrar[$i]['id_cliente']		= $row['id_cliente'];
		$mostrar[$i]['dni']				= $row['dni'];
		$mostrar[$i]['nombre'] 			= $row['nombre']; 
		$mostrar[$i]['apellidos']		= $row['apellidos']; 				
		$mostrar[$i]['contacto']		= $row['telefono_movil'].' - '.$row['telefono_fijo'];
		
		//Creamos el texto plano
		if(!empty($mostrar[$i]['id_cliente'])){			
			$input  = "<div class='checkbox checkbox-success'>";
			$input .= "<input id='".$mostrar[$i]['id_cliente']."' type='checkbox' name='".$mostrar[$i]['id_cliente']."' class='marcar'>";
			$input .= "<label for='".$mostrar[$i]['id_cliente']."'></label>";
			$input .= "</div>";
			
			//Editar Alimento
			$dni = "<a href='".$url_app."editar-cliente/".$mostrar[$i]['id_cliente']."'>".utf8_encode($mostrar[$i]['dni'])."</a>";
			
			//Contacto
			$contacto = 
			
			$html .='[ "'.$input.'", "'.$dni.'", "'.salida_nombre($mostrar[$i]['nombre']).'", "'.salida_nombre($mostrar[$i]['apellidos']).'", "'.salida_nombre($mostrar[$i]['contacto']).'" ],';	
			$input = "";
		}	
		$i++;
	}	
	
	//Quitamos la ultima de la fila
	$html = substr($html, 0, -3); 
	
	$html .=']] }';
	if($i == 0){			
			$html ='{ "aaData": [[ "'.$input.'", " Sin registros", "", "", "", "", "" ]] }';				
	}
	echo $html;	
	//print_r($mostrar);
?>