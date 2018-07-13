<?php  
session_start();
include 'parts/conex.php';
ini_set('error_reporting', E_ALL);
//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/ayuda.php';
include_once 'parts/consultas_mysql.php';
include_once 'parts/configuracion.php';

	//Ejecutar texto plano
	$html = ''; 
	$html .='{ "aaData": [';
	
	$todos_los_ids = '';
	//Consultamos los alimentos originales		
	$sql = "SELECT * FROM `gx_dietas_plantillas` WHERE id_usuario = '".$_SESSION["id_usuario"]."' AND status = 1";		
	$result = $conn->query($sql);	
		$i = 0;
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {			
				$plantillas[$i]['id']			= $row["id"];
				$plantillas[$i]['nombre']		= $row["nombre"];
				$plantillas[$i]['duracion']		= $row["duracion"];
				$plantillas[$i]['num_comidas']	= $row["num_comidas"];	
				$plantillas[$i]['kilocalorias_dia']	= $row["kilocalorias_dia"];	
				$i++;	
			}
		}			
		
		if($i != 0){
		for ($i = 0; $i <= count($plantillas); $i++) {
				//Seguir escribiendo el texto plano
				if(!empty($plantillas[$i]['id'])){						
					$input  = "<div class='checkbox checkbox-success'>";
					$input .= "<input id='".$plantillas[$i]['id']."' type='checkbox' name='".$plantillas[$i]['id']."' class='marcar'>";
					$input .= "<label for='".$plantillas[$i]['id']."'></label>";
					$input .= "</div>";
					
					//Editar Alimento					
					$nombre = "<a href='".$url_app."editar-plantilla/".$plantillas[$i]['id']."'>".salida_nombre($plantillas[$i]['nombre'])."</a>";
					
					$html .='[ "'.$input.'", "'.$nombre.'", "'.$plantillas[$i]['duracion'].'", "'.$plantillas[$i]['num_comidas'].'", "'.$plantillas[$i]['kilocalorias_dia'].'"  ],';
					$input = "";
				}
			}	
		}
	 
	//Quitamos la ultima de la fila
	$html = substr($html, 0, -3); 
	
	$html .=']] }';
	if($i == 0){			
		$html = '{ "aaData": [[ "", " Sin registros", "", "", "", "", "", "" ]] }';				
	}
	echo $html;	
?>