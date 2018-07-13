<?php  
session_start();
include 'parts/conex.php';

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/ayuda.php';
include_once 'parts/configuracion.php';
include 'parts/consultas_mysql.php';




//activo
if($_GET['status'] == 'EnEspera') 	{ $status = "status = 'En Espera'"; $var1 = 2; }

if($_GET['status'] == 'Resuelto') 	{ $status = "status = 'Resuelto'"; $var1 = 3; }

//Creamos la condicion where para la consulta mysql
$where = '';
switch ($var1)  {		
	case "2":
		$where = 'AND '.$status;
		break;
	case "3":
		$where = $status;
		break;	
}  

	if($var1 == 3){
		//Mostar para todos los resolver los ticket
		$query = "SELECT * FROM `gx_tickets` WHERE  ".$where." GROUP BY ticket ORDER BY ticket ASC";
	}else{
		//Mostrar para los usuarios
		$query = "SELECT * FROM `gx_tickets` WHERE usuario = '".$_SESSION['id_usuario']."' ".$where." GROUP BY ticket ORDER BY ticket ASC";	
	}
	
	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($connection));	
	$total_filas = mysqli_num_rows($result);
	
	
	//Ejecutar texto plano
	$total_filas = mysqli_num_rows($result);
	
	$html = ''; 
	$html .='{ "aaData": [';
	
	while($row = $result->fetch_assoc()) {
		
		$input = "<div class='checkbox checkbox-success'>";
		$input .= "<input id='".$row['id']."' type='checkbox' name='".$row['id']."' class='marcar'>";
		$input .= "<label for='".$row['id']."'></label>";
		$input .= "</div>";
		
		
		//Nombre url						
		$ticket_titulo = "<a href='".$url_app."ticket/".$row['ticket']."'>".salida_nombre($row['titulo'])."</a>";
		//Fechas
		// $fecha_inicio =  date('d/m/Y', strtotime($row['fecha_inicio']));
		// $fecha_fin =  date('d/m/Y', strtotime($row['fecha_fin']));
		
		
		$html .='[ "'.$input.'", "'.$ticket_titulo.'", "'.$row['descripcion_corta'].'...", "'.$row['fecha'].'", "'.$row['status'].'", "'.$row['prioridad'].'" ] ,';	
	}
	
	//Quitamos la ultima de la fila
	$html = substr($html, 0, -3); 
	
	$html .=']] }';
	
	if($total_filas == ""){			
			$html ='{ "aaData": [[ "'.$input.'", " Sin registros", "", "", "", "" ]] }';				
	}
	echo $html;	
?>