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

$id = $_GET['id'];

	//Ejecutar texto plano
	$html = ''; 
	$html .='{ "aaData": [';
	
	$todos_los_ids = '';
	//Consultamos los alimentos originales	
	// $sql = "SELECT * FROM `gx_alimento_receta` 	WHERE id_receta = '924'";
	$sql = "SELECT *, gx_alimento_receta.id_alimento AS id_alimento_definitivo, gx_alimentos.nombre FROM `gx_alimento_receta` 	
	LEFT JOIN `gx_alimentos` ON `gx_alimento_receta`.`id_alimento` = `gx_alimentos`.`id_alimento`
	WHERE `gx_alimento_receta`.id_receta = '".$id."'";
	
	$result = $conn->query($sql);	
	$i = 0;
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {					
			$alimento[$i]['id_alimento']		= $row["id_alimento_definitivo"];				
			$alimento[$i]['id_receta']			= $row["id_receta"];			
			$alimento[$i]['cantidad']			= $row["cantidad"];
			$alimento[$i]['kcal_100g']			= $row["kcal_100g"];
			$alimento[$i]['nombre']				= $row["nombre"];
			$alimento[$i]['alimento']			= $row["alimento"];
			$alimento[$i]['hidratos']			= $row["hidratos"];
			$alimento[$i]['proteinas']			= $row["proteinas"];
			$alimento[$i]['grasa']				= $row["grasa"];
			$alimento[$i]['grupo']				= $row["grupo"];
			$i++; 
		}
	}
			for ($i = 0; $i <= count($alimento); $i++) {
					//Seguir escribiendo el texto plano
					if(!empty($alimento[$i]['id_alimento'])){
						
						//Agregar la clase para evitar desactivar este alimento usado en en la receta						
						$input  = "<div class='checkbox checkbox-success'>";
						$input .= "<input id='".$alimento[$i]['id_alimento']."' type='checkbox' name='".$alimento[$i]['id_alimento']."' class='marcar'>";
						$input .= "<label for='".$alimento[$i]['id_alimento']."'></label>";
						$input .= "</div>";
						
						//Ver
						$nombre = "<a href='".$url_app."ver-alimento/".$alimento[$i]['id_alimento']."'>".salida_nombre($alimento[$i]['nombre'])."</a>";
						
						$html .='[ "'.$input.'", "'.$nombre.'", "'.salida_nombre($alimento[$i]['cantidad']).'", "'.$alimento[$i]['kcal_100g'].'" ],';	
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