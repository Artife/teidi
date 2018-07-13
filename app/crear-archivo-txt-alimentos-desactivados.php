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
	
	//Consulta
	$sql = "SELECT *, gx_alimentos.id_alimento AS id_definitivo  FROM `gx_alimentos_desactivados` 
	LEFT JOIN `gx_alimentos` ON `gx_alimentos_desactivados`.`id_alimento` =  `gx_alimentos`.`id_alimento`
	WHERE `gx_alimentos`.`id_alimento` IS NOT NULL AND `gx_alimentos_desactivados`.`id_usuario` = '".$_SESSION["id_usuario"]."' AND `gx_alimentos_desactivados`.`status` = 2
	GROUP BY gx_alimentos.id_alimento";	
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
				$alimento[$i]['proteinas']				= $row["proteinas"];
				if(empty($row["id_usuario"])) {	
					$alimento[$i]['accion']				= 'i-Diet';
				}else{
					if(empty($row["accion"])){
						$alimento[$i]['accion']			= 'Nuevo';
					}else{
						$alimento[$i]['accion']			= $row["accion"];
					}
				}	
				$alimento[$i]['fecha_creado']			= $row["fecha_creado"];			
				
				
				//Seguir escribiendo el texto plano
				if(!empty($alimento[$i]['id_alimento'])){
					$input  = "<div class='checkbox checkbox-success'>";
					$input .= "<input id='".$alimento[$i]['id_alimento']."' type='checkbox' name='".$alimento[$i]['id_alimento']."' class='marcar'>";
					$input .= "<label for='".$alimento[$i]['id_alimento']."'></label>";
					$input .= "</div>";
					
					//Editar Alimento					
					$nombre = "<a href='".$url_app."ver-alimento/".$alimento[$i]['id_alimento']."'>".salida_nombre($alimento[$i]['nombre'])."</a>";
					
					$html .='[ "'.$input.'", "'.$nombre.'", "'.salida_nombre($alimento[$i]['grupo']).'", "'.$alimento[$i]['kcal_100g'].'", "'.$alimento[$i]['hidratos_porc'].'", "'.$alimento[$i]['proteinas_porc'].'", "'.$alimento[$i]['grasa_porc'].'", "'.$alimento[$i]['accion'].'" ],';	
					$input = "";
				}
				$i++; 
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