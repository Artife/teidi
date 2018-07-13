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
	$sql = "SELECT * FROM `gx_alimentos` 
	WHERE gx_alimentos.id_usuario = 0 AND gx_alimentos.id_alimento NOT IN (".$_SESSION['total_alimentos_desactivados_por_cliente_sql'].") 
	OR gx_alimentos.id_usuario = '".$_SESSION["id_usuario"]."' AND gx_alimentos.id_alimento NOT IN (".$_SESSION['total_alimentos_desactivados_por_cliente_sql'].") ORDER BY `gx_alimentos`.`id_alimento` ASC";	
	$result = $conn->query($sql);	
		$i = 0;
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {					
				$alimento[$i]['id_alimento']			= $row["id_alimento"];				
				$alimento[$i]['id_usuario']				= $row["id_usuario"];			
				$alimento[$i]['nombre']					= $row["nombre"];
				$alimento[$i]['hidratos_porc']			= $row["hidratos_porc"];
				$alimento[$i]['kcal_100g']				= $row["kcal_100g"];
				$alimento[$i]['proteinas_porc']			= $row["proteinas_porc"];
				$alimento[$i]['grasa_porc']				= $row["grasa_porc"];
				$alimento[$i]['grupo']					= $row["grupo"];
				$alimento[$i]['grasa']					= $row["grasa"];				
				$alimento[$i]['hidratos']				= $row["hidratos"];
				$alimento[$i]['proteinas']				= $row["hidratos"];
				
				if(empty($row["accion"])){
					$alimento[$i]['accion']					= 'i-Diet';	
				}else{
					$alimento[$i]['accion']					= $row["accion"];
				}
				
				$alimento[$i]['fecha_creado']			= $row["fecha_creado"];	
				if(!empty($row["id_alimento"])){	
					$todos_los_ids .= $row["id_alimento"].',';
				}
				$i++; 
			}
		}			
		
	
			for ($i = 0; $i <= count($alimento); $i++) {
					//Seguir escribiendo el texto plano
					if(!empty($alimento[$i]['id_alimento'])){						
						$input  = "<div class='checkbox checkbox-success'>";
						$input .= "<input id='".$alimento[$i]['id_alimento']."' type='checkbox' name='".$alimento[$i]['id_alimento']."' class='marcar'>";
						$input .= "<label for='".$alimento[$i]['id_alimento']."'></label>";
						$input .= "</div>";
						
						//Editar Alimento					
						$nombre = "<a href='".$url_app."editar-alimento/".$alimento[$i]['id_alimento']."'>".salida_nombre($alimento[$i]['nombre'])."</a>";
						
						$html .='[ "'.$input.'", "'.$nombre.'", "'.salida_nombre($alimento[$i]['grupo']).'", "'.$alimento[$i]['kcal_100g'].'", "'.$alimento[$i]['hidratos_porc'].'", "'.$alimento[$i]['proteinas_porc'].'", "'.$alimento[$i]['grasa_porc'].'", "'.$alimento[$i]['accion'].'" ],';	
						$input = "";
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