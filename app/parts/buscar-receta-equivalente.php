<?php
session_start();
include 'conex.php';
$pagina = 'Editar Receta';
$migas = array('Lista Recetas');
$migas_url = array('lista-recetas');

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'configuracion.php';
include_once 'ayuda.php';
include 'consultas_mysql.php';

$id    			=  $_POST['id_receta']; 
$tipo_comida	=  $_POST['tipo_comida']; 	
	
	switch ($tipo_comida) {
		case 'desayuno':
			$tipo_comida_ingesta = 'ingesta_7';			
			break;
		case 'media_manana':
			$tipo_comida_ingesta = 'ingesta_8';				
			break;
		case 'primer_plato_comida':
			$tipo_comida_ingesta = 'ingesta_9';				
			break;
		case 'plato_principal_comida':
			$tipo_comida_ingesta = 'ingesta_19';					
			break;
		case 'postre_comida':
			$tipo_comida_ingesta = 'ingesta_21';					
			break;
		case 'merienda':
			$tipo_comida_ingesta = 'ingesta_10';							
			break;
		case 'primer_plato_cena':
			$tipo_comida_ingesta = 'ingesta_11';						
			break;
		case 'plato_principal_cena':
			$tipo_comida_ingesta = 'ingesta_19';					
			break;
		case 'postre_cena':
			$tipo_comida_ingesta = 'ingesta_21';					
			break;
		case 'recena':
			$tipo_comida_ingesta = 'ingesta_12';						
			break;			
	}
	$opciones = '';
	//buscamos las ingestas en la receta
	$query_opciones = "SELECT * FROM `gx_recetas` 	
		WHERE `id_usuario` = 0 AND `gx_recetas`.`id_receta` NOT IN (".$_SESSION['todas_las_recetas_desactivadas_por_el_usuario_sql'].")
		OR `id_usuario` = '".$_SESSION['id_usuario']."' AND `gx_recetas`.`id_receta` NOT IN (".$_SESSION['todas_las_recetas_desactivadas_por_el_usuario_sql'].")
		ORDER BY id_receta DESC";	
	$result_opciones = mysqli_query($_SESSION["conexion"], $query_opciones) or die(mysqli_error($_SESSION["conexion"]));	
	while($row_opciones = $result_opciones->fetch_assoc()) {
		$resultado_numeric = strpos($row_opciones['ingestas'], $tipo_comida_ingesta);
		if (is_numeric($resultado_numeric)) {
			$opciones = $opciones.'<option value="'.$row_opciones['id_receta'].'">'.salida_nombre($row_opciones['nombre']).'</option>';	
		}
	}
	
	//si las ingestas estan vacias no trae nada
	if(empty($opciones)) $opciones = '<option value="Sin Recomendaciones">Sin Recomendaciones</option>';	
		
?>
<select id="nueva_receta_a_cambiar" class="chosen-select text-left" style="width:300px;" tabindex="2" name="receta">	
	<?php echo $opciones; ?>
</select>
