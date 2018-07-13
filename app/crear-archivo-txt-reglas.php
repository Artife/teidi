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
	$sql = "SELECT * FROM `gx_reglas` WHERE 
	id_usuario = 0 AND id_regla NOT IN (".$_SESSION['todas_las_reglas_desactivadas_por_el_usuario_sql'].")
	OR id_usuario = '".$_SESSION["id_usuario"]."' AND id_regla NOT IN (".$_SESSION['todas_las_reglas_desactivadas_por_el_usuario_sql'].")";		
	$result = $conn->query($sql);	
		$i = 0;
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {					
				$reglas[$i]['id_regla']					= $row["id_regla"];								
				
				if($row["min_unidades"] == 99999) {  $reglas[$i]['min_unidades'] = '∞'; }else{
				$reglas[$i]['min_unidades'] 		= $row["min_unidades"]; }
				if($row["max_unidades"] == 99999) {  $reglas[$i]['max_unidades'] = '∞'; }else{
				$reglas[$i]['max_unidades'] 		= $row["max_unidades"]; }
				
				$reglas[$i]['supergrupo']				= $row["supergrupo"];
				$reglas[$i]['frecuencia']				= $row["frecuencia"];				
				$i++; 
			}
		}			
		
		if($i != 0){
		for ($i = 0; $i <= count($reglas); $i++) {
				//Seguir escribiendo el texto plano
				if(!empty($reglas[$i]['id_regla'])){						
					$input  = "<div class='checkbox checkbox-success'>";
					$input .= "<input id='".$reglas[$i]['id_regla']."' type='checkbox' name='".$reglas[$i]['id_regla']."' class='marcar'>";
					$input .= "<label for='".$reglas[$i]['id_regla']."'></label>";
					$input .= "</div>";
					
					//Editar Alimento					
					$grupo = "<a href='".$url_app."editar-regla/".$reglas[$i]['id_regla']."'>".salida_nombre($reglas[$i]['supergrupo'])."</a>";
					
					$html .='[ "'.$input.'", "'.$grupo.'", "'.$reglas[$i]['frecuencia'].'", "'.$reglas[$i]['min_unidades'].'", "'.$reglas[$i]['max_unidades'].'" ],';	
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