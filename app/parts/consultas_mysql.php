<?php
//Consultas a la base de datos
/**************				CONFIGURACION 			*******************/
function guardar_configuracion_app($id_usuario, $size_body, $size_h1, $size_h2, $size_h3, $color_body, $color_hs){
	$sql = "SELECT * FROM `gx_configuracion_app` 
	WHERE id_usuario = '".$id_usuario."'";	
	$result = $_SESSION["conexion"]->query($sql);
		$i = 0;
		if ($result->num_rows > 0) {
			//Si existe ya un registro hacemos un update
			$query = "UPDATE `gx_configuracion_app` 
			SET `size_body` = '".$size_body."', 
			`size_h1` = '".$size_h1."',
			`size_h2` = '".$size_h2."',
			`size_h3` = '".$size_h3."',
			`color_body` = '".$color_body."',
			`color_hs` = '".$color_hs."',
			`status_textos` = '1'
			WHERE `id_usuario` = '".$id_usuario."'";
			$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));						
		}else{
			//Si no existe se hace un Insert
			$query = "INSERT INTO  `gx_configuracion_app`  (id_usuario, size_body, size_h1, size_h2, size_h3, color_body, color_hs, status_textos)
			values('".$id_usuario."', '".$size_body."', '".$size_h1."', '".$size_h2."', '".$size_h3."', '".$color_body."', '".$color_hs."', '1')";
			$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
		}
	
		
}
function restablecer_configuracion_app ($id_usuario){
	$query = "UPDATE `gx_configuracion_app` 
	SET `status_textos` = '0'
	WHERE `id_usuario` = '".$id_usuario."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));		
}

//->Tabla 
function guardar_formato_tabla ($id_usuario, $tabla_lista, $size_tabla, $color_tabla){
	$sql = "SELECT * FROM `gx_configuracion_app` 
	WHERE id_usuario = '".$id_usuario."'";	
	$result = $_SESSION["conexion"]->query($sql);
		$i = 0;
		if ($result->num_rows > 0) {
			//Update
			$query = "UPDATE `gx_configuracion_app` 
			SET `tabla_lista` = '".$tabla_lista."',
			`size_tabla` = '".$size_tabla."',
			`color_tabla` = '".$color_tabla."',
			`status_tabla` = '1'
			WHERE `id_usuario` = '".$id_usuario."'";
			$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
		}else{
			//Insert
			$query = "INSERT INTO  `gx_configuracion_app`  (id_usuario, tabla_lista, size_tabla, color_tabla, status_tabla)
			values('".$id_usuario."', '".$tabla_lista."', '".$size_tabla."', '".$color_tabla."', '1')";
			$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
		}
}	

function restablecer_formato_tabla ($id_usuario){
	
}	
/**************				Datos Clinica 			*******************/	

function datos_clinica (){
	$query = "SELECT * FROM `gx_configuracion` WHERE id_usuario = '".$_SESSION['id_usuario']."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
	$mostrar = '';
	while($row = $result->fetch_assoc()) {		
		$mostrar['id_usuario']		= $row['id_usuario'];
		$mostrar['nombre']			= $row['nombre'];
		$mostrar['direccion']		= $row['direccion'];
		$mostrar['localidad']		= $row['localidad'];
		$mostrar['telefono']		= $row['telefono'];
		$mostrar['logo']			= $row['logo'];
	}
	
	return $mostrar;
}	
function actualizar_datos_clinica($id_usuario, $clinica_nombre, $clinica_direccion, $clinica_localidad, $clinica_telefono, $nombre_logo){
	$query = "UPDATE `gx_configuracion` 
		SET `nombre` = '".$clinica_nombre."', 
		`direccion` = '".$clinica_direccion."',
		`localidad` = '".$clinica_localidad."',
		`telefono` = '".$clinica_telefono."',
		`logo` = '".$nombre_logo."'
		WHERE `id_usuario` = '".$id_usuario."'";
		$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
}	
function guardar_datos_clinica ($id_usuario, $clinica_nombre, $clinica_direccion, $clinica_localidad, $clinica_telefono, $nombre_logo){
	$query = "INSERT INTO  `gx_configuracion`  (id_usuario, nombre, direccion, localidad, telefono, logo)
	values('".$id_usuario."', '".$clinica_nombre."', '".$clinica_direccion."', '".$clinica_localidad."', '".$clinica_telefono."', '".$nombre_logo."')";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
}

/**************				FIN Datos Clinica 			*******************/	

/**************				FIN CONFIGURACION 			*******************/	
	
/**************				USUARIOS 			*******************/
///listado de usuarios activos
function listado_de_usuarios ($where) {
	
	if(empty($where)) {$where = '';} 
		
	//fast query prueba	
	$query = "SELECT * FROM `gx_usuarios`".$where;
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));
	
	$i = 0;
	while($row = $result->fetch_assoc()) {
		$mostrar[$i]['id_usuario']		= $row['id_usuario'];
		$mostrar[$i]['nombre']			= $row['nombre'];
		$mostrar[$i]['login']			= $row['login'];
		$mostrar[$i]['email'] 			= $row['email']; 
		$mostrar[$i]['dni'] 			= $row['dni']; 		
		if ($row['role'] == 'usuaro') {	 
			$mostrar[$i]['role'] 			= 'Normal';
		}else{
			$mostrar[$i]['role'] 			= $row['role'];
		}
		if ($row['activo'] == 1) {	 
			$mostrar[$i]['activo'] 			= 'Activo';
		}else{
			$mostrar[$i]['activo'] 			= 'Inactivo';
		}
		$mostrar[$i]['poblacion']			= $row['poblacion'];
		$mostrar[$i]['direccion']			= $row['direccion'];
		$mostrar[$i]['provincia']			= $row['provincia'];		
		$mostrar[$i]['colegio']				= $row['colegio'];
		$mostrar[$i]['numero_colegiado']	= $row['numero_colegiado'];
		$mostrar[$i]['activo']				= $row['activo'];
		$mostrar[$i]['forma_pago']			= $row['forma_pago'];
		$mostrar[$i]['iban']				= $row['iban'];
		
		$mostrar[$i]['fecha_inicio'] 	=  date('d/m/Y', strtotime($row['fecha_inicio']));
		$mostrar[$i]['fecha_fin']		=  date('d/m/Y', strtotime($row['fecha_fin']));  
		$mostrar[$i]['observaciones']	= html_entity_decode($row['observaciones']);	
		$i++;
	}
	if ($i == 0 ){
		$mostrar = '';
	}
	return $mostrar;
}


function consulta_de_pass_actual ($id_usuario, $contrasena) {
	
	$contrasena_encriptada = crypt($contrasena);
	
	$query = "SELECT * FROM `gx_usuarios` WHERE `id_usuario` = '".$id_usuario."' AND `contrasena` = '".$contrasena_encriptada."' ";

	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));
	
	$numero_filas = mysql_num_rows($result);
	
	return $numero_filas;
}

function grupo_de_roles (){
	
	$query = "SELECT * FROM `gx_usuarios` GROUP by `role`";

	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));
	
	$i = 0;
	while($row = $result->fetch_assoc()) {
		
		if($row['role'] == 'usuario'){
		}else{
			$mostrar[$i]['role'] 			= salida_nombre($row['role']);
		}
		
		$i++;
	}
	
	return $mostrar;
}

//UPDATES
function activar_usuario ($id_usuario){

	$query = "UPDATE `gx_usuarios` SET `activo` = '1' WHERE `gx_usuarios`.`id_usuario` = '".$id_usuario."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));
	
	return $query;
}

function cambiar_password ($id_usuario, $contrasena){
	
	$contrasena_encriptada = crypt($contrasena, '');

	$query = "UPDATE `gx_usuarios` SET `contrasena` = '".$contrasena_encriptada."' WHERE `gx_usuarios`.`id_usuario` = '".$id_usuario."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));
	
	return $query;
}

function desactivar_usuario ($id_usuario){

	$query = "UPDATE `gx_usuarios` SET `activo` = '0' WHERE `gx_usuarios`.`id_usuario` = '".$id_usuario."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));
	 
	return $query;
}
//Actualizar todos los datos del usuario
function actualizar_usuario ($id_usuario, $nombre, $dni, $role, $activo,
$direccion, $poblacion, $forma_pago, $iban, $colegio, $numero_colegiado, $observaciones, $provincia, $fecha_inicio, $fecha_fin){
	
	$query = "UPDATE `gx_usuarios` SET 
	`nombre` = '".$nombre."', 
	`dni` = '".$dni."', 
	`role` = '".$role."', 
	`activo` = '".$activo."', 
	`direccion` = '".$direccion."', 
	`poblacion` = '".$poblacion."', 
	`forma_pago` = '".$forma_pago."', 
	`iban` = '".$iban."', 
	`colegio` = '".$colegio."', 
	`numero_colegiado` = '".$numero_colegiado."', 
	`observaciones` = '".$observaciones."', 
	`provincia` = '".$provincia."',
	`fecha_inicio` = '".$fecha_inicio."',
	`fecha_fin` = '".$fecha_fin."'
	WHERE `gx_usuarios`.`id_usuario` = '".$id_usuario."'";
	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));
	
	return $query;
}

//INSERT
function nuevo_usuario($nombre, $dni, $login, $contrasena, $role, $activo, $fecha_inicio,
$fecha_fin, $direccion, $poblacion, $forma_pago, $iban, $colegio, $numero_colegiado, $observaciones, $provincia)
{
	
	$contrasena_encriptada = crypt($contrasena, '');

	//Codificar el html	
	$observaciones = htmlentities($observaciones);
	
	$query = "INSERT into gx_usuarios (nombre, dni, login, contrasena, role, email, activo,
        fecha_inicio, fecha_fin, direccion, poblacion, forma_pago, iban, colegio, numero_colegiado, observaciones, provincia) values
	('".$nombre."', '".$dni."', '".$login."', '".$contrasena_encriptada."', '".$role."', '".$login."',
        '".$activo."', '".$fecha_inicio."', '".$fecha_fin."', '".$direccion."', '".$poblacion."',
        '".$forma_pago."', '".$iban."', '".$colegio."', '".$numero_colegiado."', '".$observaciones."', '".$provincia."')";

	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
 
	return $query;
}

/**************			FIN	USUARIOS 			*******************/

/**************			ALIMENTOS	 			*******************/
//-> Total alimentos
function total_alimentos_por_cliente() {
	$query = "SELECT * FROM `gx_alimentos` WHERE `id_usuario` = '".$_SESSION['id_usuario']."'";	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	$i = 0;
	while($row = $result->fetch_assoc()) {
		
		$i++;
	}
	
	return $i;
}
function total_alimentos_por_cliente_en_mes ($mes) {
	$query = "SELECT * FROM `gx_alimentos` WHERE `id_usuario` = '".$_SESSION['id_usuario']."' AND fecha_creado like '%".$mes."%'";	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	$i = 0;
	while($row = $result->fetch_assoc()) {
		
		$i++;
	}
	
	return $i;
}

function listado_de_alimentos_completo () {

	$todos_los_ids = '';
	//Consultamos los alimentos originales	
	$sql = "SELECT * FROM `gx_alimentos` 
	WHERE gx_alimentos.id_usuario = 0 AND gx_alimentos.id_alimento NOT IN (SELECT gx_alimentos_desactivados.id_alimento FROM gx_alimentos_desactivados WHERE gx_alimentos_desactivados.id_usuario = '".$_SESSION["id_usuario"]."' AND gx_alimentos_desactivados.status = 2) 
	OR gx_alimentos.id_usuario = '".$_SESSION["id_usuario"]."' AND gx_alimentos.id_alimento NOT IN (SELECT gx_alimentos_desactivados.id_alimento FROM gx_alimentos_desactivados WHERE gx_alimentos_desactivados.id_usuario = '".$_SESSION["id_usuario"]."' AND gx_alimentos_desactivados.status = 2) ORDER BY `gx_alimentos`.`id_alimento` ASC";	
	$result = mysqli_query($_SESSION["conexion"], $sql) or die(mysqli_error($_SESSION["conexion"]));	
		$i = 0;
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {					
				$alimento[$i]['id_definitivo']			= $row["id_alimento"];				
				$alimento[$i]['id_usuario']				= $row["id_usuario"];			
				$alimento[$i]['nombre']					= $row["nombre"];
				$alimento[$i]['hidratos_porc']			= $row["hidratos_porc"];
				$alimento[$i]['kcal_100g']				= $row["kcal_100g"];
				$alimento[$i]['proteinas_porc']			= $row["proteinas_porc"];
				$alimento[$i]['grasa_porc']				= $row["grasa_porc"];
				$alimento[$i]['id_grupo']				= $row["id_grupo"];
				$alimento[$i]['grupo']					= $row["grupo"];
				$alimento[$i]['grasa']					= $row["grasa"];				
				$alimento[$i]['hidratos']				= $row["hidratos"];
				$alimento[$i]['proteinas']				= $row["proteinas"];
				if(empty($row["proteinas"]) || $row["proteinas"] == ''){
					$alimento[$i]['accion']					= 'i-Diet';	
				}else{	
					$alimento[$i]['accion']					= $row["proteinas"];
				}	
				$alimento[$i]['fecha_creado']			= $row["fecha_creado"];					
				$i++; 
			}
		}		
	return $alimento;
}


function listado_de_alimentos ($where) {

	$query = "SELECT * FROM `gx_alimentos` WHERE `id_usuario` IS NULL";

	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	$i = 0;
	while($row = $result->fetch_assoc()) {
		$mostrar[$i]['id_alimento'] 			= $row['id_alimento'];
		$mostrar[$i]['id_alimento_completo']	= $row['id_alimento_completo'];
		$mostrar[$i]['nombre']					= utf8_encode($row['nombre']);
		$mostrar[$i]['kcal_100g']				= $row['kcal_100g'];
		$mostrar[$i]['hidratos']				= $row['hidratos'];
		$mostrar[$i]['proteinas']				= $row['proteinas'];
		$mostrar[$i]['grasa'] 					= $row['grasa'];
		$mostrar[$i]['grupo'] 					= $row['grupo'];
		$mostrar[$i]['proteinas_porc'] 			= $row['proteinas_porc'];
		$mostrar[$i]['hidratos_porc'] 			= $row['hidratos_porc'];
		$mostrar[$i]['grasa_porc'] 				= $row['grasa_porc'];
		$i++;
	}
	
	return $mostrar;
}


function obtener_alimento ($id_alimento) {

	$query = "SELECT * FROM `gx_alimentos` WHERE id_alimento = '".$id_alimento."'";

	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

		while($row = $result->fetch_assoc()) {
			$alimento_info['id_alimento']			= $row["id_alimento"];
			$alimento_info['id_usuario']			= $row["id_usuario"];
			$alimento_info['id_alimento_completo']		= $row["id_alimento_completo"];
			$alimento_info['nombre']			= $row["nombre"];
			$alimento_info['hidratos_porc']		= $row["hidratos_porc"];
			$alimento_info['kcal_100g']			= $row["kcal_100g"];
			$alimento_info['proteinas_porc']	= $row["proteinas_porc"];
			$alimento_info['grasa_porc']		= $row["grasa_porc"];
			$alimento_info['grupo']				= $row["grupo"];
			$alimento_info['grasa']				= $row["grasa"];
			$alimento_info['kcal']				= $row["kcal"];
			$alimento_info['hidratos']			= $row["hidratos"];
			$alimento_info['proteinas']			= $row["proteinas"];			
			$alimento_info['accion']			= $row["accion"];
			$alimento_info['fecha_creado']		= $row["fecha_creado"];
		}
	return $alimento_info;
}
function obtener_alimento_por_usuario ($id_alimento) {
	$query = "SELECT * FROM `gx_alimentos` WHERE id_alimento = '".$id_alimento."'";

	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

		while($row = $result->fetch_assoc()) {
			$alimento_info['id_alimento']				= $row["id_alimento"];
			$alimento_info['id_usuario']				= $row["id_usuario"];			
			$alimento_info['nombre']					= $row["nombre"];
			$alimento_info['hidratos_porc']				= $row["hidratos_porc"];
			$alimento_info['kcal_100g']					= $row["kcal_100g"];
			$alimento_info['proteinas_porc']			= $row["proteinas_porc"];
			$alimento_info['grasa_porc']				= $row["grasa_porc"];
			$alimento_info['grupo']						= $row["grupo"];
			$alimento_info['grasa']						= $row["grasa"];
			// $alimento_info['kcal']						= $row["kcal"];
			$alimento_info['hidratos']					= $row["hidratos"];
			$alimento_info['proteinas']					= $row["proteinas"];
			$alimento_info['nombre_ing']				= $row["nombre_ing"];
			$alimento_info['subgrupo']					= $row["subgrupo"];
			$alimento_info['pc_porcentaje']				= $row["pc_porcentaje"];
			$alimento_info['cal_kcal']					= $row["cal_kcal"];
			$alimento_info['agua_g']					= $row["agua_g"];
			$alimento_info['hc_g']						= $row["hc_g"];
			$alimento_info['prot_g']					= $row["prot_g"];
			$alimento_info['grasa_g']					= $row["grasa_g"];
			$alimento_info['niacina']					= $row["niacina"];
			$alimento_info['satur_g']					= $row["satur_g"];
			$alimento_info['mono_g']					= $row["mono_g"];
			$alimento_info['poli_g']					= $row["poli_g"];
			$alimento_info['col_mg']					= $row["col_mg"];
			$alimento_info['fibra_g']					= $row["fibra_g"];
			$alimento_info['sodio_mg']					= $row["sodio_mg"];
			$alimento_info['potasio_mg']				= $row["potasio_mg"];
			$alimento_info['magnesio_mg']				= $row["magnesio_mg"];
			$alimento_info['calcio_mg']					= $row["calcio_mg"];
			$alimento_info['fosf_mg']					= $row["fosf_mg"];
			$alimento_info['hierro_mg']					= $row["hierro_mg"];
			$alimento_info['cloro_mg']			= $row["cloro_mg"];
			$alimento_info['cinc_mg']			= $row["cinc_mg"];
			$alimento_info['cobre_mg']			= $row["cobre_mg"];
			$alimento_info['manganeso_mg']		= $row["manganeso_mg"];
			$alimento_info['cromo_mg']			= $row["cromo_mg"];
			$alimento_info['cobalto_mg']		= $row["cobalto_mg"];
			$alimento_info['molibde_mg']		= $row["molibde_mg"];
			$alimento_info['yodo_mg']			= $row["yodo_mg"];
			$alimento_info['fluor_mg']			= $row["fluor_mg"];
			$alimento_info['butirico_c4_0']	= $row["butirico_c4_0"];
			$alimento_info['caproico_c6_0']	= $row["caproico_c6_0"];
			$alimento_info['caprilico_c8_0']	= $row["caprilico_c8_0"];
			$alimento_info['caprico_c10_0']	= $row["caprico_c10_0"];
			$alimento_info['laurico_c12_0']	= $row["laurico_c12_0"];
			$alimento_info['miristico_c14_0']	= $row["miristico_c14_0"];
			$alimento_info['c15_0']			= $row["c15_0"];
			$alimento_info['c15_00']			= $row["c15_00"];
			$alimento_info['palmitico_c16_0']	= $row["palmitico_c16_0"];
			$alimento_info['c17_0']			= $row["c17_0"];
			$alimento_info['c17_00']			= $row["c17_00"];
			$alimento_info['estearico_c18_0']	= $row["estearico_c18_0"];
			$alimento_info['araquidi_c20_0']	= $row["araquidi_c20_0"];
			$alimento_info['behenico_c22_0']	= $row["behenico_c22_0"];
			$alimento_info['miristol_c14_1']	= $row["miristol_c14_1"];
			$alimento_info['palmitole_c16_1']	= $row["palmitole_c16_1"];
			$alimento_info['oleico_c18_1']		= $row["oleico_c18_1"];
			$alimento_info['eicoseno_c20_1']	= $row["eicoseno_c20_1"];
			$alimento_info['c22_1']			= $row["c22_1"];
			$alimento_info['linoleico_c18_2']	= $row["linoleico_c18_2"];
			$alimento_info['linoleni_c18_3']	= $row["linoleni_c18_3"];
			$alimento_info['c18_4']			= $row["c18_4"];
			$alimento_info['ara_ico_c20_4']	= $row["ara_ico_c20_4"];
			$alimento_info['c20_5']			= $row["c20_5"];
			$alimento_info['c22_5']			= $row["c22_5"];
			$alimento_info['c22_6']			= $row["c22_6"];
			$alimento_info['otrosatur0']		= $row["otrosatur0"];
			$alimento_info['otroinsat0']		= $row["otroinsat0"];
			$alimento_info['omega3_0']			= $row["omega3_0"];
			$alimento_info['etanol0']			= $row["etanol0"];
			$alimento_info['vit_a']			= $row["vit_a"];
			$alimento_info['carotenos']		= $row["carotenos"];
			$alimento_info['tocoferol']		= $row["tocoferol"];
			$alimento_info['vit_d']			= $row["vit_d"];
			$alimento_info['vit_b1']			= $row["vit_b1"];
			$alimento_info['vit_b2']			= $row["vit_b2"];
			$alimento_info['vit_b6']			= $row["vit_b6"];
			// $alimento_info['nicotina']			= $row["nicotina"];
			$alimento_info['ac_panto']			= $row["ac_panto"];
			$alimento_info['biotina']			= $row["biotina"];
			$alimento_info['folico']			= $row["folico"];
			$alimento_info['b12']				= $row["b12"];
			$alimento_info['vit_c']			= $row["vit_c"];
			$alimento_info['purinas']			= $row["purinas"];
			$alimento_info['vit_k']			= $row["vit_k"];
			$alimento_info['vit_e']			= $row["vit_e"];
			$alimento_info['oxalico']			= $row["oxalico"];	
			$alimento_info['accion']					= $row["accion"];
			$alimento_info['fecha_creado']				= $row["fecha_creado"];
		}
		
	return $alimento_info;
}

//->Obtener los alimentos que se estan usando actualmente en las recetas
function obtener_los_alimentos_que_estan_en_uso  ($id) {	
	//Buscamos las cantidades
	$query = "SELECT * FROM `gx_alimento_receta` INNER JOIN `gx_recetas` ON `gx_alimento_receta`.`id_receta` = `gx_recetas`.`id_receta` WHERE `gx_alimento_receta`.`id_alimento` = '".$id."' AND `gx_alimento_receta`.`id_receta` NOT IN (".$_SESSION['todas_las_recetas_desactivadas_por_el_usuario_sql'].")";	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	$i=0;
	$lista = '';
	while($row = $result->fetch_assoc()) {		
		$lista[$i]['id_receta']		= $row["id_receta"];				
		$lista[$i]['nombre']		= $row["nombre"];
		$lista[$i]['id_alimento']	= $row["id_alimento"];		
		$lista[$i]['alimento']		= $row["alimento"];		
		$i++;
	} 	
	return $lista;
}

//Regla de 3 para datos de informacion
function obtener_cantidades_recetas  ($ids, $receta) {
	
	//Buscamos las cantidades
	$query = "SELECT *, gx_alimentos.hidratos AS hidratos_total, gx_alimentos.proteinas AS proteinas_total, gx_alimentos.grasa AS grasa_total, gx_alimentos.nombre AS nombre_total
	FROM `gx_alimento_receta` 
	LEFT JOIN gx_alimentos ON `gx_alimento_receta`.`id_alimento` = `gx_alimentos`.`id_alimento`
	WHERE `gx_alimento_receta`.`id_alimento` IN (".$ids.") AND `gx_alimento_receta`.`id_receta` = '".$receta."' ";	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	$i=0;
	while($row = $result->fetch_assoc()) {
		
		$alimento_info['id_alimento']		= $row["id_alimento"];		
		$alimento_info['nombre_total']		= $row["nombre_total"];
		$alimento_info['cantidad']			= $row["cantidad"];
		$alimento_info['hidratos_total']	= ($row["cantidad"]/100)*$row["hidratos_total"];
		$alimento_info['proteinas_total']	= ($row["cantidad"]/100)*$row["proteinas_total"];
		$alimento_info['grasa_total']		= ($row["cantidad"]/100)*$row["grasa_total"];
		$i++;
	} 
	
	return $alimento_info;
}

function obtener_informacion_nutricional ($id, $cantidad) {
	$query = "SELECT * FROM `gx_alimentos` WHERE id_alimento = '".$id."'";

	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
		$i=0;
		while($row = $result->fetch_assoc()) {
			$alimento_info['id_alimento']				= $row["id_alimento"];
			$alimento_info['id_usuario']				= $row["id_usuario"];			
			$alimento_info['nombre']					= $row["nombre"];
			$alimento_info['cantidad']					= $cantidad;
			$alimento_info['hidratos_porc']				= $row["hidratos_porc"]*$cantidad;
			$alimento_info['kcal_100g']					= $row["kcal_100g"]*$cantidad;
			$alimento_info['proteinas_porc']			= $row["proteinas_porc"]*$cantidad;
			$alimento_info['grasa_porc']				= $row["grasa_porc"]*$cantidad;
			$alimento_info['grupo']						= $row["grupo"];
			$alimento_info['grasa']						= $row["grasa"];			
			//Esta no existe
			// $alimento_info['kcal']					= $row["kcal"];		

			//$factor = round($peso_plato/100, 2);	
			$alimento_info['kcal_100g_org']				= $row["kcal_100g"];
			$alimento_info['kcal_100g_org_en_cantidad']	= ($alimento_info['kcal_100g']*$cantidad);
			
			$alimento_info['hidratos']					= round(($cantidad/100)*$row["hidratos"],2);
			$alimento_info['proteinas']					= round(($cantidad/100)*$row["proteinas"],2);
			$alimento_info['nombre_ing']				= round(($cantidad/100)*$row["nombre_ing"],2);
			$alimento_info['subgrupo']					= round(($cantidad/100)*$row["subgrupo"],2);
			$alimento_info['pc_porcentaje']				= round(($cantidad/100)*$row["pc_porcentaje"],2);
			$alimento_info['cal_kcal']					= round(($cantidad/100)*$row["cal_kcal"],2);
			$alimento_info['agua_g']					= round(($cantidad/100)*$row["agua_g"],2);			
			$alimento_info['hc_g']						= round(($cantidad/100)*$row["hc_g"],2);
			$alimento_info['prot_g']					= round(($cantidad/100)*$row["prot_g"],2);
			$alimento_info['grasa_g']					= round(($cantidad/100)*$row["grasa_g"],2);
			$alimento_info['niacina']					= round(($cantidad/100)*$row["niacina"],2);
			$alimento_info['satur_g']					= round(($cantidad/100)*$row["satur_g"],2);
			$alimento_info['mono_g']					= round(($cantidad/100)*$row["mono_g"],2);
			$alimento_info['poli_g']					= round(($cantidad/100)*$row["poli_g"],2);
			$alimento_info['col_mg']					= round(($cantidad/100)*$row["col_mg"],2);
			$alimento_info['fibra_g']					= round(($cantidad/100)*$row["fibra_g"],2);
			$alimento_info['sodio_mg']					= round(($cantidad/100)*$row["sodio_mg"],2);
			$alimento_info['potasio_mg']				= round(($cantidad/100)*$row["potasio_mg"],2);
			$alimento_info['magnesio_mg']				= round(($cantidad/100)*$row["magnesio_mg"],2);
			$alimento_info['calcio_mg']					= round(($cantidad/100)*$row["calcio_mg"],2);
			$alimento_info['fosf_mg']					= round(($cantidad/100)*$row["fosf_mg"],2);
			$alimento_info['hierro_mg']					= round(($cantidad/100)*$row["hierro_mg"],2);
			$alimento_info['cloro_mg']					= round(($cantidad/100)*$row["cloro_mg"],2);
			$alimento_info['cinc_mg']					= round(($cantidad/100)*$row["cinc_mg"],2);
			$alimento_info['cobre_mg']					= round(($cantidad/100)*$row["cobre_mg"],2);
			$alimento_info['manganeso_mg']				= round(($cantidad/100)*$row["manganeso_mg"],2);
			$alimento_info['cromo_mg']					= round(($cantidad/100)*$row["cromo_mg"],2);
			$alimento_info['cobalto_mg']				= round(($cantidad/100)*$row["cobalto_mg"],2);
			$alimento_info['molibde_mg']				= round(($cantidad/100)*$row["molibde_mg"],2);
			$alimento_info['yodo_mg']					= round(($cantidad/100)*$row["yodo_mg"],2);
			$alimento_info['fluor_mg']					= round(($cantidad/100)*$row["fluor_mg"],2);
			$alimento_info['butirico_c4_0']				= round(($cantidad/100)*$row["butirico_c4_0"],2);
			$alimento_info['caproico_c6_0']				= round(($cantidad/100)*$row["caproico_c6_0"],2);
			$alimento_info['caprilico_c8_0']			= round(($cantidad/100)*$row["caprilico_c8_0"],2);
			$alimento_info['caprico_c10_0']				= round(($cantidad/100)*$row["caprico_c10_0"],2);
			$alimento_info['laurico_c12_0']				= round(($cantidad/100)*$row["laurico_c12_0"],2);
			$alimento_info['miristico_c14_0']			= round(($cantidad/100)*$row["miristico_c14_0"],2);
			$alimento_info['c15_0']						= round(($cantidad/100)*$row["c15_0"],2);
			$alimento_info['c15_00']					= round(($cantidad/100)*$row["c15_00"],2);
			$alimento_info['palmitico_c16_0']			= round(($cantidad/100)*$row["palmitico_c16_0"],2);
			$alimento_info['c17_0']						= round(($cantidad/100)*$row["c17_0"],2);
			$alimento_info['c17_00']					= round(($cantidad/100)*$row["c17_00"],2);
			$alimento_info['estearico_c18_0']			= round(($cantidad/100)*$row["estearico_c18_0"],2);
			$alimento_info['araquidi_c20_0']			= round(($cantidad/100)*$row["araquidi_c20_0"],2);
			$alimento_info['behenico_c22_0']			= round(($cantidad/100)*$row["behenico_c22_0"],2);
			$alimento_info['miristol_c14_1']			= round(($cantidad/100)*$row["miristol_c14_1"],2);
			$alimento_info['palmitole_c16_1']			= round(($cantidad/100)*$row["palmitole_c16_1"],2);
			$alimento_info['oleico_c18_1']				= round(($cantidad/100)*$row["oleico_c18_1"],2);
			$alimento_info['eicoseno_c20_1']			= round(($cantidad/100)*$row["eicoseno_c20_1"],2);
			$alimento_info['c22_1']						= round(($cantidad/100)*$row["c22_1"],2);
			$alimento_info['linoleico_c18_2']			= round(($cantidad/100)*$row["linoleico_c18_2"],2);
			$alimento_info['linoleni_c18_3']			= round(($cantidad/100)*$row["linoleni_c18_3"],2);
			$alimento_info['c18_4']						= round(($cantidad/100)*$row["c18_4"],2);
			$alimento_info['ara_ico_c20_4']				= round(($cantidad/100)*$row["ara_ico_c20_4"],2);
			$alimento_info['c20_5']						= round(($cantidad/100)*$row["c20_5"],2);
			$alimento_info['c22_5']						= round(($cantidad/100)*$row["c22_5"],2);
			$alimento_info['c22_6']						= round(($cantidad/100)*$row["c22_6"],2);
			$alimento_info['otrosatur0']				= round(($cantidad/100)*$row["otrosatur0"],2);
			$alimento_info['otroinsat0']				= round(($cantidad/100)*$row["otroinsat0"],2);
			$alimento_info['omega3_0']					= round(($cantidad/100)*$row["omega3_0"],2);
			$alimento_info['etanol0']					= round(($cantidad/100)*$row["etanol0"],2);
			$alimento_info['vit_a']						= round(($cantidad/100)*$row["vit_a"],2);
			$alimento_info['carotenos']					= round(($cantidad/100)*$row["carotenos"],2);
			$alimento_info['tocoferol']					= round(($cantidad/100)*$row["tocoferol"],2);
			$alimento_info['vit_d']						= round(($cantidad/100)*$row["vit_d"],2);
			$alimento_info['vit_b1']					= round(($cantidad/100)*$row["vit_b1"],2);
			$alimento_info['vit_b2']					= round(($cantidad/100)*$row["vit_b2"],2);
			$alimento_info['vit_b6']					= round(($cantidad/100)*$row["vit_b6"],2);
			//Esta fue eliminada de la tabla
			// $alimento_info['nicotina']				= round(($cantidad/100)*$row["nicotina"],2);
			$alimento_info['ac_panto']					= round(($cantidad/100)*$row["ac_panto"],2);
			$alimento_info['biotina']					= round(($cantidad/100)*$row["biotina"],2);
			$alimento_info['folico']					= round(($cantidad/100)*$row["folico"],2);
			$alimento_info['b12']						= round(($cantidad/100)*$row["b12"],2);
			$alimento_info['vit_c']						= round(($cantidad/100)*$row["vit_c"],2);
			$alimento_info['purinas']					= round(($cantidad/100)*$row["purinas"],2);
			$alimento_info['vit_k']						= round(($cantidad/100)*$row["vit_k"],2);
			$alimento_info['vit_e']						= round(($cantidad/100)*$row["vit_e"],2);
			$alimento_info['oxalico']					= round(($cantidad/100)*$row["oxalico"],2);	
			$alimento_info['accion']					= $row["accion"];
			$alimento_info['fecha_creado']				= $row["fecha_creado"];
			$i++;
		}
		
	return $alimento_info;
}

function lista_alimentos_por_usuario () {

	$query = "SELECT * FROM `gx_alimentos` WHERE id_usuario IS NULL OR id_usuario = '".$_SESSION['id_usuario']."'";

	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
		
		$i = 0;
		while($row = $result->fetch_assoc()) {
			$alimento[$i]['id_alimento']			= $row["id_alimento"];
			$alimento[$i]['id_usuario']				= $row["id_usuario"];
			$alimento[$i]['id_alimento_completo']	= $row["id_alimento_completo"];
			$alimento[$i]['nombre']					= $row["nombre"];
			$alimento[$i]['hidratos_porc']			= $row["hidratos_porc"];
			$alimento[$i]['kcal_100g']				= $row["kcal_100g"];
			$alimento[$i]['proteinas_porc']			= $row["proteinas_porc"];
			$alimento[$i]['grasa_porc']				= $row["grasa_porc"];
			$alimento[$i]['grupo']					= $row["grupo"];
			$alimento[$i]['grasa']					= $row["grasa"];
			$alimento[$i]['kcal']					= $row["kcal"];
			$alimento[$i]['hidratos']				= $row["hidratos"];
			$alimento[$i]['proteinas']				= $row["proteinas"];
			if(empty($row["id_usuario"])) {	
				$alimento[$i]['accion']				= 'i-diet';
			}else{
				if(empty($row["accion"])){
					$alimento[$i]['accion']			= 'Vacia';
				}else{
					$alimento[$i]['accion']			= $row["accion"];
				}
			}	
			$alimento[$i]['fecha_creado']			= $row["fecha_creado"];			
			$i++;
		}
	return $alimento;
}

function obtener_alimento_completo ($id_alimento) {

	$query = "SELECT * FROM gx_alimentos WHERE id_alimento_completo = '".$id_alimento."'";

	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
		while($row = $result->fetch_assoc()) {
			$alimento_info_completo['nombre']			= $row["nombre"];
			$alimento_info_completo['kcal_100g']		= $row["kcal_100g"];
			$alimento_info_completo['hidratos']			= $row["hidratos"];
			$alimento_info_completo['proteinas']		= $row["proteinas"];
			$alimento_info_completo['grasa']			= $row["grasa"];
			$alimento_info_completo['nombre_ing']		= $row["nombre_ing"];
			$alimento_info_completo['subgrupo']			= $row["subgrupo"];
			$alimento_info_completo['pc_porcentaje']	= $row["pc_porcentaje"];
			$alimento_info_completo['cal_kcal']			= $row["cal_kcal"];
			$alimento_info_completo['agua_g']			= $row["agua_g"];
			$alimento_info_completo['hc_g']				= $row["hc_g"];
			$alimento_info_completo['satur_g']			= $row["satur_g"];
			$alimento_info_completo['mono_g']			= $row["mono_g"];
			$alimento_info_completo['poli_g']			= $row["poli_g"];
			$alimento_info_completo['col_mg']			= $row["col_mg"];
			$alimento_info_completo['fibra_g']			= $row["fibra_g"];
			$alimento_info_completo['prot_g']			= $row["prot_g"];
			$alimento_info_completo['grasa_g']			= $row["grasa_g"];
			$alimento_info_completo['sodio_mg']			= $row["sodio_mg"];
			$alimento_info_completo['potasio_mg']		= $row["potasio_mg"];
			$alimento_info_completo['magnesio_mg']		= $row["magnesio_mg"];
			$alimento_info_completo['calcio_mg']		= $row["calcio_mg"];
			$alimento_info_completo['fosf_mg']			= $row["fosf_mg"];
			$alimento_info_completo['hierro_mg']		= $row["hierro_mg"];
			$alimento_info_completo['cloro_mg']			= $row["cloro_mg"];
			$alimento_info_completo['cinc_mg']			= $row["cinc_mg"];
			$alimento_info_completo['cobre_mg']			= $row["cobre_mg"];
			$alimento_info_completo['manganeso_mg']		= $row["manganeso_mg"];
			$alimento_info_completo['cromo_mg']			= $row["cromo_mg"];
			$alimento_info_completo['cobalto_mg']		= $row["cobalto_mg"];
			$alimento_info_completo['molibde_mg']		= $row["molibde_mg"];
			$alimento_info_completo['yodo_mg']			= $row["yodo_mg"];
			$alimento_info_completo['fluor_mg']			= $row["fluor_mg"];
			$alimento_info_completo['butirico_c4_0']	= $row["butirico_c4_0"];
			$alimento_info_completo['caproico_c6_0']	= $row["caproico_c6_0"];
			$alimento_info_completo['caprilico_c8_0']	= $row["caprilico_c8_0"];
			$alimento_info_completo['caprico_c10_0']	= $row["caprico_c10_0"];
			$alimento_info_completo['laurico_c12_0']	= $row["laurico_c12_0"];
			$alimento_info_completo['miristico_c14_0']	= $row["miristico_c14_0"];
			$alimento_info_completo['c15_0']			= $row["c15_0"];
			$alimento_info_completo['c15_00']			= $row["c15_00"];
			$alimento_info_completo['palmitico_c16_0']	= $row["palmitico_c16_0"];
			$alimento_info_completo['c17_0']			= $row["c17_0"];
			$alimento_info_completo['c17_00']			= $row["c17_00"];
			$alimento_info_completo['estearico_c18_0']	= $row["estearico_c18_0"];
			$alimento_info_completo['araquidi_c20_0']	= $row["araquidi_c20_0"];
			$alimento_info_completo['behenico_c22_0']	= $row["behenico_c22_0"];
			$alimento_info_completo['miristol_c14_1']	= $row["miristol_c14_1"];
			$alimento_info_completo['palmitole_c16_1']	= $row["palmitole_c16_1"];
			$alimento_info_completo['oleico_c18_1']		= $row["oleico_c18_1"];
			$alimento_info_completo['eicoseno_c20_1']	= $row["eicoseno_c20_1"];
			$alimento_info_completo['c22_1']			= $row["c22_1"];
			$alimento_info_completo['linoleico_c18_2']	= $row["linoleico_c18_2"];
			$alimento_info_completo['linoleni_c18_3']	= $row["linoleni_c18_3"];
			$alimento_info_completo['c18_4']			= $row["c18_4"];
			$alimento_info_completo['ara_ico_c20_4']	= $row["ara_ico_c20_4"];
			$alimento_info_completo['c20_5']			= $row["c20_5"];
			$alimento_info_completo['c22_5']			= $row["c22_5"];
			$alimento_info_completo['c22_6']			= $row["c22_6"];
			$alimento_info_completo['otrosatur0']		= $row["otrosatur0"];
			$alimento_info_completo['otroinsat0']		= $row["otroinsat0"];
			$alimento_info_completo['omega3_0']			= $row["omega3_0"];
			$alimento_info_completo['etanol0']			= $row["etanol0"];
			$alimento_info_completo['vit_a']			= $row["vit_a"];
			$alimento_info_completo['carotenos']		= $row["carotenos"];
			$alimento_info_completo['tocoferol']		= $row["tocoferol"];
			$alimento_info_completo['vit_d']			= $row["vit_d"];
			$alimento_info_completo['vit_b1']			= $row["vit_b1"];
			$alimento_info_completo['vit_b2']			= $row["vit_b2"];
			$alimento_info_completo['vit_b6']			= $row["vit_b6"];
			// $alimento_info_completo['nicotina']			= $row["nicotina"];
			$alimento_info_completo['ac_panto']			= $row["ac_panto"];
			$alimento_info_completo['biotina']			= $row["biotina"];
			$alimento_info_completo['folico']			= $row["folico"];
			$alimento_info_completo['b12']				= $row["b12"];
			$alimento_info_completo['vit_c']			= $row["vit_c"];
			$alimento_info_completo['purinas']			= $row["purinas"];
			$alimento_info_completo['vit_k']			= $row["vit_k"];
			$alimento_info_completo['vit_e']			= $row["vit_e"];
			$alimento_info_completo['oxalico']			= $row["oxalico"];	
		}
	return $alimento_info_completo;
}

function grupo_de_alimentos_options() {
	
	//Consulta vieja
	//$query = "SELECT * FROM `grupos_alimentos`";
	$query = "SELECT * FROM `gx_alimentos` WHERE id_grupo != '90' GROUP BY grupo ";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	$mostrar = '';
	while($row = $result->fetch_assoc()) {	
		if($row['grupo'] != 'Otros'){
			$mostrar .= '<option value="'.utf8_encode($row['grupo']).'" '.$selected.'>'.utf8_encode($row['grupo']).'</option>';		
		}
	}
	$mostrar .= '<option value="Otros" selected>Otros</option>';		
	
	return $mostrar;
}
function grupo_de_alimentos_options_select($grupo) {
	
	//Consulta vieja
	//$query = "SELECT * FROM `grupos_alimentos`";
	$query = "SELECT * FROM `gx_alimentos` GROUP BY grupo ";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	$mostrar = '';
	while($row = $result->fetch_assoc()) {	
		if($row['grupo'] != 'Otros'){
			$mostrar .= '<option value="'.utf8_encode($row['grupo']).'" '.$selected.'>'.utf8_encode($row['grupo']).'</option>';		
		}
	}
	$mostrar .= '<option value="'.$grupo.'" selected>'.$grupo.'</option>';		
	$mostrar .= '<option value="Otros">Otros</option>';		
	
	return utf8_encode($mostrar);
}




function obtener_utlimo_alimento_completo () {

	$query = "SELECT `id_alimento_completo` FROM `alimento_completo` ORDER BY `id_alimento_completo` DESC LIMIT 1";

	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	
	while($row = $result->fetch_assoc()) {
		$ultimo_id = $row['id_alimento_completo'];		
	}
	
	return $ultimo_id+1;
}

function obtener_nombre_del_grupo ($grupo) {

	$query = "SELECT * FROM `grupos_alimentos` WHERE id_grupo = '".$grupo."'";

	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	
	while($row = $result->fetch_assoc()) {
		$grupo_nombre = $row['grupo'];		
	}
	
	return $grupo_nombre;
}


function accion_desactivar ($id_alimento) {
	//Fecha
	$fecha = date('d-m-Y');
	$id_alimento_existe = '';
	//primero consultamos si se ha desactivado antes
	$query = "SELECT * FROM `gx_alimentos_desactivados` WHERE id_alimento = '".$id_alimento."' AND id_usuario = '".$_SESSION['id_usuario']."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));		
	while($row = $result->fetch_assoc()) {
		$id_alimento_existe = $row['id_alimento'];		
	}
	
	if($id_alimento_existe == ''){
		$query = "INSERT into gx_alimentos_desactivados (id_usuario, id_alimento, fecha) values
		('".$_SESSION['id_usuario']."', '".$id_alimento."', '".$fecha."')";

		$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	}else{
		$query = "UPDATE gx_alimentos_desactivados 
		SET fecha='".$fecha."',
		status='2'
		WHERE id_alimento = '".$id_alimento."' AND id_usuario = '".$_SESSION['id_usuario']."'";
		$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	}
	return $query;
}
function reactivar_alimentos ($id_alimento) {
	//Fecha
	$fecha = date('d-m-Y');	
	$query = "UPDATE gx_alimentos_desactivados 
	SET fecha='".$fecha."',
	status='1'
	WHERE id_alimento = '".$id_alimento."' AND id_usuario = '".$_SESSION['id_usuario']."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
	return $query;
}
function eliminar_alimentos ($id_alimento) {
	//Fecha
	$fecha = date('d-m-Y');	
	$query = "UPDATE gx_alimentos_desactivados 
	SET fecha='".$fecha."',
	status='3'
	WHERE id_alimento = '".$id_alimento."' AND id_usuario = '".$_SESSION['id_usuario']."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
	return $query;
}	
//UPDATE
function actualizar_alimento ($nombre, $nombre_ing, $kcal_100g, $hidratos, $proteinas, $grasa, $grupo, $id_supergrupos, $proteinas_porc, $hidratos_porc, $grasa_porc, $subgrupo, $pc_porcentaje, $cal_kcal, $agua_g, $hc_g, $fibra_g, $prot_g, $grasa_g, $col_mg, $satur_g, $mono_g, $poli_g, $vit_a, $carotenos, $vit_b1, $vit_b2, $niacina, $ac_panto, $vit_b6, $biotina, $folico, $b12, $vit_c, $vit_d, $tocoferol, $vit_e, $vit_k, $oxalico, $purinas, $sodio_mg, $potasio_mg, $magnesio_mg, $calcio_mg, $fosf_mg, $hierro_mg, $cloro_mg, $cinc_mg, $cobre_mg, $manganeso_mg, $cromo_mg, $cobalto_mg, $molibde_mg, $yodo_mg, $fluor_mg, $butirico_c4_0, $caproico_c6_0, $caprilico_c8_0, $caprico_c10_0, $laurico_c12_0, $miristico_c14_0, $c15_0, $c15_00, $palmitico_c16_0, $c17_0, $c17_00, $estearico_c18_0, $araquidi_c20_0, $behenico_c22_0, $miristol_c14_1, $palmitole_c16_1, $oleico_c18_1, $eicoseno_c20_1, $c22_1, $linoleico_c18_2, $linoleni_c18_3, $c18_4, $ara_ico_c20_4, $c20_5, $c22_5, $c22_6, $otrosatur0, $otroinsat0, $omega3_0, $etanol0, $accion, $fecha_creado, $id_alimento) {

	$query = "UPDATE gx_alimentos SET nombre='".$nombre."',
	nombre_ing='".$nombre_ing."',
	kcal_100g='".$kcal_100g."',
	hidratos='".$hidratos."',
	proteinas='".$proteinas."',
	grasa='".$grasa."',
	grupo='".$grupo."',
	id_supergrupos='".$id_supergrupos."',
	proteinas_porc='".$proteinas_porc."',
	hidratos_porc='".$hidratos_porc."',
	grasa_porc='".$grasa_porc."',
	subgrupo='".$subgrupo."',
	pc_porcentaje='".$pc_porcentaje."',
	cal_kcal='".$cal_kcal."',
	agua_g='".$agua_g."',
	hc_g='".$hc_g."',
	fibra_g='".$fibra_g."',
	prot_g='".$prot_g."',
	grasa_g='".$grasa_g."',
	col_mg='".$col_mg."',
	satur_g='".$satur_g."',
	mono_g='".$mono_g."',
	poli_g='".$poli_g."',
	vit_a='".$vit_a."',
	carotenos='".$carotenos."',
	vit_b1='".$vit_b1."',
	vit_b2='".$vit_b2."',
	niacina='".$niacina."',
	ac_panto='".$ac_panto."',
	vit_b6='".$vit_b6."',
	biotina='".$biotina."',
	folico='".$folico."',
	b12='".$b12."',
	vit_c='".$vit_c."',
	vit_d='".$vit_d."',
	tocoferol='".$tocoferol."',
	vit_e='".$vit_e."',
	vit_k='".$vit_k."',
	oxalico='".$oxalico."',
	purinas='".$purinas."',
	sodio_mg='".$sodio_mg."',
	potasio_mg='".$potasio_mg."',
	magnesio_mg='".$magnesio_mg."',
	calcio_mg='".$calcio_mg."',
	fosf_mg='".$fosf_mg."',
	hierro_mg='".$hierro_mg."',
	cloro_mg='".$cloro_mg."',
	cinc_mg='".$cinc_mg."',
	cobre_mg='".$cobre_mg."',
	manganeso_mg='".$manganeso_mg."',
	cromo_mg='".$cromo_mg."',
	cobalto_mg='".$cobalto_mg."',
	molibde_mg='".$molibde_mg."',
	yodo_mg='".$yodo_mg."',
	fluor_mg='".$fluor_mg."',
	butirico_c4_0='".$butirico_c4_0."',
	caproico_c6_0='".$caproico_c6_0."',
	caprilico_c8_0='".$caprilico_c8_0."',
	caprilico_c8_0='".$caprilico_c8_0."',
	caprico_c10_0='".$caprico_c10_0."',
	laurico_c12_0='".$laurico_c12_0."',
	miristico_c14_0='".$miristico_c14_0."',
	c15_0='".$c15_0."',
	c15_00='".$c15_00."',
	palmitico_c16_0='".$palmitico_c16_0."',
	c17_0='".$c17_0."',
	c17_00='".$c17_00."',
	estearico_c18_0='".$estearico_c18_0."',
	araquidi_c20_0='".$araquidi_c20_0."',
	behenico_c22_0='".$behenico_c22_0."',
	miristol_c14_1='".$miristol_c14_1."',
	palmitole_c16_1='".$palmitole_c16_1."',
	oleico_c18_1='".$oleico_c18_1."',
	eicoseno_c20_1='".$eicoseno_c20_1."',
	c22_1='".$c22_1."',
	linoleico_c18_2='".$linoleico_c18_2."',
	linoleni_c18_3='".$linoleni_c18_3."',
	c18_4='".$c18_4."',
	ara_ico_c20_4='".$ara_ico_c20_4."',
	c20_5='".$c20_5."',
	c22_5='".$c22_5."',
	c22_6='".$c22_6."',
	otrosatur0='".$otrosatur0."',
	otroinsat0='".$otroinsat0."',
	omega3_0='".$omega3_0."',
	etanol0='".$etanol0."',
	accion='".$accion."',
	fecha_creado='".$fecha_creado."'
	WHERE id_alimento='".$id_alimento."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
}

//INSERT
function crear_nuevo_alimento ($id_usuario, $nombre, $nombre_ing, $kcal_100g, $hidratos, $proteinas, $grasa, $grupo, $id_supergrupos, $proteinas_porc, $hidratos_porc, $grasa_porc, $subgrupo, $pc_porcentaje, $cal_kcal, $agua_g, $hc_g, $fibra_g, $prot_g, $grasa_g, $col_mg, $satur_g, $mono_g, $poli_g, $vit_a, $carotenos, $vit_b1, $vit_b2, $niacina, $ac_panto, $vit_b6, $biotina, $folico, $b12, $vit_c, $vit_d, $tocoferol, $vit_e, $vit_k, $oxalico, $purinas, $sodio_mg, $potasio_mg, $magnesio_mg, $calcio_mg, $fosf_mg, $hierro_mg, $cloro_mg, $cinc_mg, $cobre_mg, $manganeso_mg, $cromo_mg, $cobalto_mg, $molibde_mg, $yodo_mg, $fluor_mg, $butirico_c4_0, $caproico_c6_0, $caprilico_c8_0, $caprico_c10_0, $laurico_c12_0, $miristico_c14_0, $c15_0, $c15_00, $palmitico_c16_0, $c17_0, $c17_00, $estearico_c18_0, $araquidi_c20_0, $behenico_c22_0, $miristol_c14_1, $palmitole_c16_1, $oleico_c18_1, $eicoseno_c20_1, $c22_1, $linoleico_c18_2, $linoleni_c18_3, $c18_4, $ara_ico_c20_4, $c20_5, $c22_5, $c22_6, $otrosatur0, $otroinsat0, $omega3_0, $etanol0, $accion, $fecha_creado) {

	$query = "INSERT INTO `gx_alimentos` (`id_usuario`, `nombre`, `nombre_ing`, `kcal_100g`, `hidratos`, `proteinas`, `grasa`, `grupo`, `id_supergrupos`, `proteinas_porc`, `hidratos_porc`, `grasa_porc`, `subgrupo`, `pc_porcentaje`, `cal_kcal`, `agua_g`, `hc_g`, `fibra_g`, `prot_g`, `grasa_g`, `col_mg`, `satur_g`, `mono_g`, `poli_g`, `vit_a`, `carotenos`, `vit_b1`, `vit_b2`, `niacina`, `ac_panto`, `vit_b6`, `biotina`, `folico`, `b12`, `vit_c`, `vit_d`, `tocoferol`, `vit_e`, `vit_k`, `oxalico`, `purinas`, `sodio_mg`, `potasio_mg`, `magnesio_mg`, `calcio_mg`, `fosf_mg`, `hierro_mg`, `cloro_mg`, `cinc_mg`, `cobre_mg`, `manganeso_mg`, `cromo_mg`, `cobalto_mg`, `molibde_mg`, `yodo_mg`, `fluor_mg`, `butirico_c4_0`, `caproico_c6_0`, `caprilico_c8_0`, `caprico_c10_0`, `laurico_c12_0`, `miristico_c14_0`, `c15_0`, `c15_00`, `palmitico_c16_0`, `c17_0`, `c17_00`, `estearico_c18_0`, `araquidi_c20_0`, `behenico_c22_0`, `miristol_c14_1`, `palmitole_c16_1`, `oleico_c18_1`, `eicoseno_c20_1`, `c22_1`, `linoleico_c18_2`, `linoleni_c18_3`, `c18_4`, `ara_ico_c20_4`, `c20_5`, `c22_5`, `c22_6`, `otrosatur0`, `otroinsat0`, `omega3_0`, `etanol0`, `accion`, `fecha_creado`) 
	VALUES ('".$id_usuario."', '".$nombre."', '".$nombre_ing."', '".$kcal_100g."', '".$hidratos."', '".$proteinas."', '".$grasa."', '".$grupo."', '".$id_supergrupos."', '".$proteinas_porc."', '".$hidratos_porc."', '".$grasa_porc."', '".$subgrupo."', '".$pc_porcentaje."', '".$cal_kcal."', '".$agua_g."', '".$hc_g."', '".$fibra_g."', '".$prot_g."', '".$grasa_g."', '".$col_mg."', '".$satur_g."', '".$mono_g."', '".$poli_g."', '".$vit_a."', '".$carotenos."', '".$vit_b1."', '".$vit_b2."', '".$niacina."', '".$ac_panto."', '".$vit_b6."', '".$biotina."', '".$folico."', '".$b12."', '".$vit_c."', '".$vit_d."', '".$tocoferol."', '".$vit_e."', '".$vit_k."', '".$oxalico."', '".$purinas."', '".$sodio_mg."', '".$potasio_mg."', '".$magnesio_mg."', '".$calcio_mg."', '".$fosf_mg."', '".$hierro_mg."', '".$cloro_mg."', '".$cinc_mg."', '".$cobre_mg."', '".$manganeso_mg."', '".$cromo_mg."', '".$cobalto_mg."', '".$molibde_mg."', '".$yodo_mg."', '".$fluor_mg."', '".$butirico_c4_0."', '".$caproico_c6_0."', '".$caprilico_c8_0."', '".$caprico_c10_0."', '".$laurico_c12_0."', '".$miristico_c14_0."', '".$c15_0."', '".$c15_00."', '".$palmitico_c16_0."', '".$c17_0."', '".$c17_00."', '".$estearico_c18_0."', '".$araquidi_c20_0."', '".$behenico_c22_0."', '".$miristol_c14_1."', '".$palmitole_c16_1."', '".$oleico_c18_1."', '".$eicoseno_c20_1."', '".$c22_1."', '".$linoleico_c18_2."', '".$linoleni_c18_3."', '".$c18_4."', '".$ara_ico_c20_4."', '".$c20_5."', '".$c22_5."', '".$c22_6."', '".$otrosatur0."', '".$otroinsat0."', '".$omega3_0."', '".$etanol0	."', '".$accion."', '".$fecha_creado."');";	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));		

}

function accion_duplicar_alimento ($id_usuario, $id_alimento, $fecha){	
	$query = "INSERT INTO `gx_alimentos` (`id_usuario`, `nombre`, `nombre_ing`, `kcal_100g`, `hidratos`, `proteinas`, `grasa`, `grupo`, `proteinas_porc`, `hidratos_porc`, `grasa_porc`, `subgrupo`, `pc_porcentaje`, `cal_kcal`, `agua_g`, `hc_g`, `fibra_g`, `prot_g`, `grasa_g`, `col_mg`, `satur_g`, `mono_g`, `poli_g`, `vit_a`, `carotenos`, `vit_b1`, `vit_b2`, `niacina`, `ac_panto`, `vit_b6`, `biotina`, `folico`, `b12`, `vit_c`, `vit_d`, `tocoferol`, `vit_e`, `vit_k`, `oxalico`, `purinas`, `sodio_mg`, `potasio_mg`, `magnesio_mg`, `calcio_mg`, `fosf_mg`, `hierro_mg`, `cloro_mg`, `cinc_mg`, `cobre_mg`, `manganeso_mg`, `cromo_mg`, `cobalto_mg`, `molibde_mg`, `yodo_mg`, `fluor_mg`, `butirico_c4_0`, `caproico_c6_0`, `caprilico_c8_0`, `caprico_c10_0`, `laurico_c12_0`, `miristico_c14_0`, `c15_0`, `c15_00`, `palmitico_c16_0`, `c17_0`, `c17_00`, `estearico_c18_0`, `araquidi_c20_0`, `behenico_c22_0`, `miristol_c14_1`, `palmitole_c16_1`, `oleico_c18_1`, `eicoseno_c20_1`, `c22_1`, `linoleico_c18_2`, `linoleni_c18_3`, `c18_4`, `ara_ico_c20_4`, `c20_5`, `c22_5`, `c22_6`, `otrosatur0`, `otroinsat0`, `omega3_0`, `etanol0`, `accion`, `fecha_creado`) 
	(SELECT '".$id_usuario."', `nombre`, `nombre_ing`, `kcal_100g`, `hidratos`, `proteinas`, `grasa`, `grupo`, `proteinas_porc`, `hidratos_porc`, `grasa_porc`, `subgrupo`, `pc_porcentaje`, `cal_kcal`, `agua_g`, `hc_g`, `fibra_g`, `prot_g`, `grasa_g`, `col_mg`, `satur_g`, `mono_g`, `poli_g`, `vit_a`, `carotenos`, `vit_b1`, `vit_b2`, `niacina`, `ac_panto`, `vit_b6`, `biotina`, `folico`, `b12`, `vit_c`, `vit_d`, `tocoferol`, `vit_e`, `vit_k`, `oxalico`, `purinas`, `sodio_mg`, `potasio_mg`, `magnesio_mg`, `calcio_mg`, `fosf_mg`, `hierro_mg`, `cloro_mg`, `cinc_mg`, `cobre_mg`, `manganeso_mg`, `cromo_mg`, `cobalto_mg`, `molibde_mg`, `yodo_mg`, `fluor_mg`, `butirico_c4_0`, `caproico_c6_0`, `caprilico_c8_0`, `caprico_c10_0`, `laurico_c12_0`, `miristico_c14_0`, `c15_0`, `c15_00`, `palmitico_c16_0`, `c17_0`, `c17_00`, `estearico_c18_0`, `araquidi_c20_0`, `behenico_c22_0`, `miristol_c14_1`, `palmitole_c16_1`, `oleico_c18_1`, `eicoseno_c20_1`, `c22_1`, `linoleico_c18_2`, `linoleni_c18_3`, `c18_4`, `ara_ico_c20_4`, `c20_5`, `c22_5`, `c22_6`, `otrosatur0`, `otroinsat0`, `omega3_0`, `etanol0`, 'Duplicado', '".$fecha."' FROM gx_alimentos WHERE `id_alimento`='".$id_alimento."');";	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));
	
}

function accion_duplicar_alimento_original ($id_usuario, $id_alimento, $fecha){	
	$query = "INSERT INTO `gx_alimentos` (`id_usuario`, `nombre`, `nombre_ing`, `kcal_100g`, `hidratos`, `proteinas`, `grasa`, `grupo`, `proteinas_porc`, `hidratos_porc`, `grasa_porc`, `subgrupo`, `pc_porcentaje`, `cal_kcal`, `agua_g`, `hc_g`, `fibra_g`, `prot_g`, `grasa_g`, `col_mg`, `satur_g`, `mono_g`, `poli_g`, `vit_a`, `carotenos`, `vit_b1`, `vit_b2`, `niacina`, `ac_panto`, `vit_b6`, `biotina`, `folico`, `b12`, `vit_c`, `vit_d`, `tocoferol`, `vit_e`, `vit_k`, `oxalico`, `purinas`, `sodio_mg`, `potasio_mg`, `magnesio_mg`, `calcio_mg`, `fosf_mg`, `hierro_mg`, `cloro_mg`, `cinc_mg`, `cobre_mg`, `manganeso_mg`, `cromo_mg`, `cobalto_mg`, `molibde_mg`, `yodo_mg`, `fluor_mg`, `butirico_c4_0`, `caproico_c6_0`, `caprilico_c8_0`, `caprico_c10_0`, `laurico_c12_0`, `miristico_c14_0`, `c15_0`, `c15_00`, `palmitico_c16_0`, `c17_0`, `c17_00`, `estearico_c18_0`, `araquidi_c20_0`, `behenico_c22_0`, `miristol_c14_1`, `palmitole_c16_1`, `oleico_c18_1`, `eicoseno_c20_1`, `c22_1`, `linoleico_c18_2`, `linoleni_c18_3`, `c18_4`, `ara_ico_c20_4`, `c20_5`, `c22_5`, `c22_6`, `otrosatur0`, `otroinsat0`, `omega3_0`, `etanol0`, `accion`, `fecha_creado`) 
	(SELECT '".$id_usuario."', `nombre`, `nombre_ing`, `kcal_100g`, `hidratos`, `proteinas`, `grasa`, `grupo`, `proteinas_porc`, `hidratos_porc`, `grasa_porc`, `subgrupo`, `pc_porcentaje`, `cal_kcal`, `agua_g`, `hc_g`, `fibra_g`, `prot_g`, `grasa_g`, `col_mg`, `satur_g`, `mono_g`, `poli_g`, `vit_a`, `carotenos`, `vit_b1`, `vit_b2`, `niacina`, `ac_panto`, `vit_b6`, `biotina`, `folico`, `b12`, `vit_c`, `vit_d`, `tocoferol`, `vit_e`, `vit_k`, `oxalico`, `purinas`, `sodio_mg`, `potasio_mg`, `magnesio_mg`, `calcio_mg`, `fosf_mg`, `hierro_mg`, `cloro_mg`, `cinc_mg`, `cobre_mg`, `manganeso_mg`, `cromo_mg`, `cobalto_mg`, `molibde_mg`, `yodo_mg`, `fluor_mg`, `butirico_c4_0`, `caproico_c6_0`, `caprilico_c8_0`, `caprico_c10_0`, `laurico_c12_0`, `miristico_c14_0`, `c15_0`, `c15_00`, `palmitico_c16_0`, `c17_0`, `c17_00`, `estearico_c18_0`, `araquidi_c20_0`, `behenico_c22_0`, `miristol_c14_1`, `palmitole_c16_1`, `oleico_c18_1`, `eicoseno_c20_1`, `c22_1`, `linoleico_c18_2`, `linoleni_c18_3`, `c18_4`, `ara_ico_c20_4`, `c20_5`, `c22_5`, `c22_6`, `otrosatur0`, `otroinsat0`, `omega3_0`, `etanol0`, 'Editado', '".$fecha."' FROM gx_alimentos WHERE `id_alimento`='".$id_alimento."');";	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));
	
}

/**************			FIN	ALIMENTOS 			*******************/
/**************			RECETAS 			*******************/

//-> total recetas para un cliente 
function total_recetas_por_cliente () {
	$query = "SELECT * FROM `gx_recetas` WHERE `id_usuario` = '".$_SESSION['id_usuario']."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	$i = 0;
	while($row = $result->fetch_assoc()) {
		
		$i++;
	}
	
	return $i;
}


function total_recetas_por_cliente_mes ($mes) {
	$query = "SELECT * FROM `gx_recetas` WHERE `id_usuario` = '".$_SESSION['id_usuario']."' AND fecha_creado = '".$mes."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	$i = 0;
	while($row = $result->fetch_assoc()) {
		
		$i++;
	}
	
	return $i;
}

function grupo_de_ingestas () {

	$query = "SELECT nombre_tipo_comida FROM `recetas` WHERE id_usuario = '".$_SESSION['id_usuario']."' OR id_usuario IS NULL  GROUP BY `nombre_tipo_comida`";

	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	$i = 0;
	while($row = $result->fetch_assoc()) {
		$mostrar[$i]['nombre_tipo_comida']		= $row['nombre_tipo_comida'];
		$i++;
	}
	
	return $mostrar;
}
function origen_de_ingestas () {

	$query = "SELECT origen FROM `recetas` WHERE id_usuario = '".$_SESSION['id_usuario']."' GROUP BY `origen`";

	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	$i = 0;
	while($row = $result->fetch_assoc()) {
		$mostrar[$i]['origen']		= $row['origen'];
		$i++;
	}
	
	return $mostrar;
}
function alimentos_desactivados_en_recetas ($id_receta){
		
	$Todos_los_alimentos = '';
	$query = "SELECT * FROM `gx_alimento_receta` WHERE id_receta = '".$id_receta."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	$i = 0;
	while($row = $result->fetch_assoc()) {
		$Todos_los_alimentos	= $Todos_los_alimentos.$row['id_alimento'].' ,';		
		$i++;
	}
	
	if($i != 0){
		$Todos_los_alimentos = substr($Todos_los_alimentos, 0, -1);		
		$query = "SELECT * FROM `gx_alimentos_desactivados` 
		INNER JOIN gx_alimentos ON gx_alimentos_desactivados.id_alimento = gx_alimentos.id_alimento 
		WHERE gx_alimentos_desactivados.`id_alimento` IN (".$Todos_los_alimentos.") AND gx_alimentos_desactivados.id_usuario = '".$_SESSION['id_usuario']."' AND gx_alimentos_desactivados.status = 2
		OR  gx_alimentos_desactivados.`id_alimento` IN (".$Todos_los_alimentos.") AND gx_alimentos_desactivados.id_usuario = '".$_SESSION['id_usuario']."' AND gx_alimentos_desactivados.status = 3
		GROUP BY gx_alimentos_desactivados.`id_alimento";
		$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
		$a = 0;
		$nombres_alimentos = '';
		while($row = $result->fetch_assoc()) {
			$nombres_alimentos	= $nombres_alimentos.' '.$row['nombre'].' ,';		
		}
	}
	
	if($i != 0){
		$nombres_alimentos = substr($nombres_alimentos, 0, -1);		
	}else{
		$nombres_alimentos = '';
	}	
	return $nombres_alimentos;
}


function obtener_receta ($id) {
	$query = "SELECT * FROM `gx_recetas` WHERE id_receta = '".$id."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	while($row = $result->fetch_assoc()) {
		$mostrar['fecha_creado']		= $row['fecha_creado'];
		$mostrar['id_usuario']			= $row['id_usuario'];
		$mostrar['nombre']				= $row['nombre'];
		$mostrar['descripcion']			= $row['descripcion'];
		$mostrar['nombre_tipo_comida']	= $row['nombre_tipo_comida'];
		$mostrar['kcal_por_100g']		= $row['kcal_por_100g'];
		$mostrar['hidratos']			= $row['hidratos'];
		$mostrar['proteinas']			= $row['proteinas'];
		$mostrar['grasas']				= $row['grasas'];
		$mostrar['peso_maximo']			= $row['peso_maximo'];
		$mostrar['peso_minimo']			= $row['peso_minimo'];
		$mostrar['origen']				= $row['origen'];
		$mostrar['ingestas']			= $row['ingestas'];
		$mostrar['fecha_creado']		= $row['fecha_creado'];
		
	}
	
	return $mostrar;
}
  

function tabla_temporal_obtener_receta ($id) {
	$query = "SELECT * FROM `gx_recetas_editadas` WHERE id_receta = '".$id."' AND id_usuario  = '".$_SESSION['id_usuario']."' ";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	$mostrar = '';
	while($row = $result->fetch_assoc()) {
		$mostrar['fecha_creado']		= $row['fecha_creado'];
		$mostrar['id_usuario']			= $row['id_usuario'];
		$mostrar['nombre']				= $row['nombre'];
		$mostrar['descripcion']			= $row['descripcion'];
		$mostrar['nombre_tipo_comida']	= $row['nombre_tipo_comida'];
		$mostrar['kcal_por_100g']		= $row['kcal_por_100g'];
		$mostrar['hidratos']			= $row['hidratos'];
		$mostrar['proteinas']			= $row['proteinas'];
		$mostrar['grasas']				= $row['grasas'];
		$mostrar['peso_maximo']			= $row['peso_maximo'];
		$mostrar['peso_minimo']			= $row['peso_minimo'];
		$mostrar['origen']				= $row['origen'];
		$mostrar['ingestas']			= $row['ingestas'];
		$mostrar['fecha_creado']		= $row['fecha_creado'];
		
	}
	
	return $mostrar;
}


function obtener_recetas_para_generar_dieta () {
	
	//Consulta de las recetas originales
	$query = "SELECT * FROM `gx_recetas` 	
	WHERE `id_usuario` = 0 AND `gx_recetas`.`id_receta` NOT IN (".$_SESSION['todas_las_recetas_desactivadas_por_el_usuario_sql'].")
	OR `id_usuario` = '".$_SESSION['id_usuario']."' AND `gx_recetas`.`id_receta` NOT IN (".$_SESSION['todas_las_recetas_desactivadas_por_el_usuario_sql'].")
	ORDER BY id_receta DESC";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));			
		$i = 0;
		while($row = $result->fetch_assoc()) {
			$receta[$i]['id_receta']				= $row["id_receta"];
			$receta[$i]['id_usuario']				= $row["id_usuario"];
			$receta[$i]['nombre']					= $row["nombre"];
			$receta[$i]['descripcion']				= $row["descripcion"];
			$receta[$i]['peso_minimo']				= $row["peso_minimo"];
			$receta[$i]['peso_maximo']				= $row["peso_maximo"];
			$receta[$i]['kcal_por_100g']			= $row["kcal_por_100g"];
			$receta[$i]['hidratos']					= $row["hidratos"];
			$receta[$i]['proteinas']				= $row["proteinas"];
			$receta[$i]['grasas']					= $row["grasas"];			
			$receta[$i]['nombre_tipo_comida']		= $row["nombre_tipo_comida"];
			$receta[$i]['ingestas']					= $row["ingestas"];
			$receta[$i]['origen']					= 'i-Diet';
			$receta[$i]['fecha_creado']				= $row["fecha_creado"];
			$i++;	
		}
		
	
	return $receta;
}

function obtener_ingestas ($id) {
	$query = "SELECT * FROM `gx_receta_tipocomida` 
	WHERE id_receta = '".$id."'
	GROUP BY id_tipoComida";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
	$i=0;
	$mostrar = '';
	while($row = $result->fetch_assoc()) {		
		$mostrar[$i]	= $row['id_tipoComida'];
		$i++;
	}
	
	return $mostrar;
}

function obtener_ingestas_temporal ($id) {
	$query = "SELECT * FROM `gx_receta_tipocomida_editadas` 
	WHERE id_receta = '".$id."'
	GROUP BY id_tipoComida";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
	$i=0;
	$mostrar = '';
	while($row = $result->fetch_assoc()) {		
		$mostrar[$i]	= $row['id_tipoComida'];
		$i++;
	}
	
	return $mostrar;
}

function obtener_ingestas_tabla ($id) {
	$query = "SELECT * FROM `gx_receta_tipocomida` 
	WHERE id_receta = '".$id."'
	GROUP BY id_tipoComida";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
	$ingesta = '';
	while($row = $result->fetch_assoc()) {		
		// $mostrar[$i]	= $row['id_tipoComida'];
		// $mostrar[$i]	= $row['nombre_tipoComida'];
		$ingesta  .= "<span class='label label-default pull-left ".crear_cadena_amigable($row['nombre_tipoComida'])."'>".utf8_encode(str_replace('\r\n','',$row['nombre_tipoComida']))."</span><br />";	
		
	}
	
	return $ingesta;
}

function obtener_ingredientes ($id) {
	$query = "SELECT * FROM `gx_alimento_receta` WHERE id_receta = '".$id."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
	$i=0;	
	while($row = $result->fetch_assoc()) {		
		$ingredientes[$i]['id_alimento']		= $row["id_alimento"];				
		$ingredientes[$i]['id_receta']			= $row["id_receta"];			
		$ingredientes[$i]['cantidad']			= $row["cantidad"];
		$ingredientes[$i]['kcal_100g']			= $row["kcal_100g"];
		$ingredientes[$i]['alimento']			= $row["alimento"];
		$ingredientes[$i]['hidratos']			= $row["hidratos"];
		$ingredientes[$i]['proteinas']			= $row["proteinas"];
		$ingredientes[$i]['grasa']				= $row["grasa"];
		$ingredientes[$i]['grupo']				= $row["grupo"];		
		$i++; 
	}
	
	return $ingredientes;
}

function obtener_ingredientes_tabla_temporal ($id) {
	$query = "SELECT * FROM `gx_alimento_receta_editadas` WHERE id_receta = '".$id."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	$ingredientes = '';
	$i=0;	
	while($row = $result->fetch_assoc()) {		
		$ingredientes[$i]['id_alimento']		= $row["id_alimento"];				
		$ingredientes[$i]['id_receta']			= $row["id_receta"];			
		$ingredientes[$i]['cantidad']			= $row["cantidad"];
		$ingredientes[$i]['kcal_100g']			= $row["kcal_100g"];
		$ingredientes[$i]['alimento']			= $row["alimento"];
		$ingredientes[$i]['hidratos']			= $row["hidratos"];
		$ingredientes[$i]['proteinas']			= $row["proteinas"];
		$ingredientes[$i]['grasa']				= $row["grasa"];
		$ingredientes[$i]['grupo']				= $row["grupo"];		
		$i++; 
	}
	
	return $ingredientes;
}
//->Crear nueva receta
function crear_nueva_receta ($nombre, $descripcion, $kcal_por_100g, $hidratos, $proteinas, $grasas, $peso_maximo, $peso_minimo, $lista_ingestas) {
		
	$origen = 'Nuevo';
	$fecha_creado = date('d-m-Y');	
	$query = "INSERT into gx_recetas (id_usuario, nombre, descripcion, kcal_por_100g, hidratos, proteinas, grasas, peso_maximo, peso_minimo, origen, fecha_creado, ingestas) values		
	('".$_SESSION['id_usuario']."', '".$nombre."', '".$descripcion."', '".$kcal_por_100g."', '".$hidratos."', '".$proteinas."', '".$grasas."', '".$peso_maximo."', '".$peso_minimo."', '".$origen."', '".$fecha_creado."', '".$lista_ingestas."')";	
	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
	return mysqli_insert_id($_SESSION["conexion"]);
}

function tabla_temporal_insert_receta ($id_receta) {		
	$fecha_creado = date('d-m-Y');		
	$query = "INSERT into gx_recetas_editadas  (`id_receta`, `id_usuario`, `nombre`, `descripcion`, `kcal_por_100g`, `hidratos`, `proteinas`, `grasas`, `peso_maximo`, `peso_minimo`, `origen`, `fecha_creado`, `ingestas`)		
	(SELECT `id_receta`, '".$_SESSION['id_usuario']."', `nombre`, `descripcion`, `kcal_por_100g`, `hidratos`, `proteinas`, `grasas`, `peso_maximo`, `peso_minimo`,  `origen`, '".$fecha_creado."', `ingestas` FROM gx_recetas WHERE `id_receta` ='".$id_receta."')";	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
	$id_receta_nuevo =  mysqli_insert_id($_SESSION["conexion"]); 		
	 
	return $query;
	 
}


function gx_duplicar_receta_original ($nombre, $descripcion, $kcal_por_100g, $hidratos, $proteinas, $grasas, $peso_maximo, $peso_minimo, $lista_ingestas) {
		
	$origen = 'Duplicado';
	$fecha_creado = date('d-m-Y');	
	$query = "INSERT into gx_recetas (id_usuario, nombre, descripcion, kcal_por_100g, hidratos, proteinas, grasas, peso_maximo, peso_minimo, origen, fecha_creado, ingestas) values		
	('".$_SESSION['id_usuario']."', '".$nombre."', '".$descripcion."', '".$kcal_por_100g."', '".$hidratos."', '".$proteinas."', '".$grasas."', '".$peso_maximo."', '".$peso_minimo."', '".$origen."', '".$fecha_creado."', '".$lista_ingestas."')";	
	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
	return mysqli_insert_id($_SESSION["conexion"]);
	
}
//->Crear ingestas para la nueva receta
function crear_ingestas_nueva_receta ($id_receta, $id_tipoComida) {	
	if($id_tipoComida == 7){ $nombre_tipoComida = 'Desayuno'; }
	if($id_tipoComida == 8){ $nombre_tipoComida = 'Media mañana'; }
	if($id_tipoComida == 9){ $nombre_tipoComida = '1ª plato Comida'; }
	if($id_tipoComida == 10){ $nombre_tipoComida = 'Merienda'; }
	if($id_tipoComida == 11){ $nombre_tipoComida = '1ª plato Cena'; }
	if($id_tipoComida == 12){ $nombre_tipoComida = 'Recena'; }
	if($id_tipoComida == 18){ $nombre_tipoComida = 'Otros'; }
	if($id_tipoComida == 19){ $nombre_tipoComida = 'Plato principal comida'; }
	if($id_tipoComida == 20){ $nombre_tipoComida = 'Plato principal cena'; }
	if($id_tipoComida == 21){ $nombre_tipoComida = 'Plato principal cena'; }
	
	$query = "INSERT into gx_receta_tipocomida (id_receta, id_tipoComida, nombre_tipoComida) values
	('".$id_receta."', '".$id_tipoComida."', '".$nombre_tipoComida."')";	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	// return $query;
}

function tabla_temporal_insert_ingestas ($id_receta_nueva, $id_tipoComida) {	
	if($id_tipoComida == 7){ $nombre_tipoComida = 'Desayuno'; }
	if($id_tipoComida == 8){ $nombre_tipoComida = 'Media mañana'; }
	if($id_tipoComida == 9){ $nombre_tipoComida = '1ª plato Comida'; }
	if($id_tipoComida == 10){ $nombre_tipoComida = 'Merienda'; }
	if($id_tipoComida == 11){ $nombre_tipoComida = '1ª plato Cena'; }
	if($id_tipoComida == 12){ $nombre_tipoComida = 'Recena'; }
	if($id_tipoComida == 18){ $nombre_tipoComida = 'Otros'; }
	if($id_tipoComida == 19){ $nombre_tipoComida = 'Plato principal comida'; }
	if($id_tipoComida == 20){ $nombre_tipoComida = 'Plato principal cena'; }
	if($id_tipoComida == 21){ $nombre_tipoComida = 'Plato principal cena'; }
	
	$query = "INSERT into gx_receta_tipocomida (id_receta, id_tipoComida, nombre_tipoComida) values
	('".$id_receta."', '".$id_tipoComida."', '".$nombre_tipoComida."')";	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	// return $query;
}

//->Crear ingredientes para la nueva receta
function crear_ingredientes_nueva_receta ($id_alimento, $id_receta, $cantidad, $kcal_100g, $alimento, $hidratos, $proteinas, $grasa) {	
	$query = "INSERT into gx_alimento_receta (id_alimento, id_receta, cantidad, kcal_100g, alimento, hidratos, proteinas, grasa) values
	('".$id_alimento."', '".$id_receta."', '".$cantidad."', '".$kcal_100g."', '".$alimento."', '".$hidratos."', '".$proteinas."', '".$grasa."')";	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));		
}

function tabla_temporal_insert_ingredientes ($id_alimento, $id_receta, $cantidad, $kcal_100g, $alimento, $hidratos, $proteinas, $grasa, $grupo) {	
	$query = "INSERT into gx_alimento_receta (id_alimento, id_receta, cantidad, kcal_100g, alimento, hidratos, proteinas, grasa, grupo) values
	('".$id_alimento."', '".$id_receta."', '".$cantidad."', '".$kcal_100g."', '".$alimento."', '".$hidratos."', '".$proteinas."', '".$grasa."', '".$grupo."')";	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));		
} 


/**************			FIN	RECETAS 			*******************/

/**************			Tickets 			*******************/

//SELECT

function mostrar_ticket ($ticket) {

	$query = "SELECT * FROM `gx_tickets` WHERE ticket = '".$ticket."' ORDER BY id DESC";

	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	$i = 0;
	while($row = $result->fetch_assoc()) {
		$mostrar[$i]['fecha']		= $row['fecha'];
		$mostrar[$i]['titulo']		= $row['titulo'];
		$mostrar[$i]['usuario']		= $row['usuario'];
		$mostrar[$i]['descripcion']	= $row['descripcion'];
		$mostrar[$i]['status']		= $row['status'];
		$mostrar[$i]['prioridad']	= $row['prioridad'];
		$i++;
		
	}
		
	return $mostrar;
	
}

function total_tickets_pendientes () {

	$query = "SELECT * FROM `gx_tickets` WHERE `usuario`='".$_SESSION['id_usuario']."' AND status = 'Pendiente' GROUP BY ticket";	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));
	$numero_filas=mysqli_num_rows($result);
	
	return $numero_filas;
}
function total_tickets_solucionados () {

	$query = "SELECT * FROM `gx_tickets` WHERE `usuario`='".$_SESSION['id_usuario']."' AND status = 'Resuelto' GROUP BY ticket";	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	$numero_filas=mysqli_num_rows($result);
		
	return $numero_filas;
}
function total_tickets_por_resolver () {

	$query = "SELECT * FROM `gx_tickets` WHERE status = 'Pendiente' GROUP BY ticket";	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));
	$numero_filas=mysqli_num_rows($result);
	
	return $numero_filas;
}

//INSERT
function crear_nuevo_ticket($status, $titulo, $prioridad, $descripcion)
{
	
	//Consultamos el ultimo tickets
	$query = "SELECT * FROM `gx_tickets` WHERE `usuario`='".$_SESSION['id_usuario']."' GROUP BY ticket";	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));
	$numero_filas=mysqli_num_rows($result);
	
	if($numero_filas == 0 || empty($numero_filas)){
		$numero_filas = 1;
	}else{
		$numero_filas = $numero_filas+1;
	}
	
	//Codificar el html	
	$descripcion_html = htmlentities($descripcion);
	$descripcion_corta = trim(strip_tags($descripcion));
	
	$query = "INSERT into gx_tickets (ticket, status, titulo, prioridad, descripcion, descripcion_corta,usuario) values
	('".$numero_filas."', '".$status."', '".$titulo."', '".$prioridad."', '".$descripcion_html."', '".$descripcion_corta."', '".$_SESSION['id_usuario']."')";

	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
 
	
}
function ticket_seguimiento($ticket, $status, $titulo, $prioridad, $descripcion)
{
		
	//Codificar el html	
	$descripcion_html = htmlentities($descripcion);
	$descripcion_corta = trim(strip_tags($descripcion));
	
	$query = "INSERT into gx_tickets (ticket, status, titulo, prioridad, descripcion, descripcion_corta,usuario) values
	('".$ticket."', '".$status."', '".$titulo."', '".$prioridad."', '".$descripcion_html."', '".$descripcion_corta."', '".$_SESSION['id_usuario']."')";

	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
 
	//return $query;
}

//UPDATE
function cambiar_todos_los_status($ticket, $status)
{
	$query = "UPDATE `gx_tickets` SET `status` = '".$status."' WHERE ticket = '".$ticket."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
}	

/* Fin Tickets*/


/**************				Clientes 			*******************/
function listado_clientes_x_usuario () {
	$query = "SELECT * FROM `gx_clientes` WHERE id_usuario = '".$_SESSION['id_usuario']."' AND status = '1'";
	$cliente ='';
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
		$i = 0;
		while($row = $result->fetch_assoc()) {
			$cliente[$i]['id_cliente']					= $row["id_cliente"];
			$cliente[$i]['dni']					= $row["dni"];
			$cliente[$i]['nombre']				= $row["nombre"];			
			$cliente[$i]['apellidos']			= $row["apellidos"];			
			$cliente[$i]['sexo']				= $row["sexo"];
			$cliente[$i]['telefono_fijo']		= $row["telefono_fijo"];
			$cliente[$i]['telefono_movil']		= $row["telefono_movil"];
			$cliente[$i]['direccion']			= $row["direccion"];
			$cliente[$i]['cp']					= $row["cp"];
			$cliente[$i]['localidad']			= $row["localidad"];
			$cliente[$i]['peso']				= $row["peso"];
			$cliente[$i]['altura']				= $row["altura"];
			$cliente[$i]['fecha_nacimiento']	= $row["fecha_nacimiento"];
			$cliente[$i]['email']				= $row["email"];
			$cliente[$i]['comentarios']			= $row["comentarios"];
			$cliente[$i]['nombre_completo']		= $row["nombre_completo"];
			$cliente[$i]['actividad']			= $row["actividad"];
			$cliente[$i]['fecha_de_alta']		= $row["fecha_de_alta"];
			$cliente[$i]['fecha_de_baja']		= $row["fecha_de_baja"];
			$i++;			
		}
		
	return $cliente;
}
function listado_clientes_x_usuario_en_mes ($mes) {
	$query = "SELECT * FROM `gx_clientes` WHERE id_usuario = '".$_SESSION['id_usuario']."' AND fecha_de_alta like '%".$mes."%'";
	$cliente ='';
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
		$i = 0;
		while($row = $result->fetch_assoc()) {
			$cliente[$i]['id_cliente']					= $row["id_cliente"];
			$cliente[$i]['dni']					= $row["dni"];
			$cliente[$i]['nombre']				= $row["nombre"];			
			$cliente[$i]['apellidos']			= $row["apellidos"];			
			$cliente[$i]['sexo']				= $row["sexo"];
			$cliente[$i]['telefono_fijo']		= $row["telefono_fijo"];
			$cliente[$i]['telefono_movil']		= $row["telefono_movil"];
			$cliente[$i]['direccion']			= $row["direccion"];
			$cliente[$i]['cp']					= $row["cp"];
			$cliente[$i]['localidad']			= $row["localidad"];
			$cliente[$i]['peso']				= $row["peso"];
			$cliente[$i]['altura']				= $row["altura"];
			$cliente[$i]['fecha_nacimiento']	= $row["fecha_nacimiento"];
			$cliente[$i]['email']				= $row["email"];
			$cliente[$i]['comentarios']			= $row["comentarios"];
			$cliente[$i]['nombre_completo']		= $row["nombre_completo"];
			$cliente[$i]['actividad']			= $row["actividad"];
			$cliente[$i]['fecha_de_alta']		= $row["fecha_de_alta"];
			$cliente[$i]['fecha_de_baja']		= $row["fecha_de_baja"];
			$i++;			
		}
		
	return $query;
}

//Consultar los datos del cliente
function obtener_listado_clientes () {
	$query = "SELECT * FROM `gx_clientes` WHERE id_usuario = '".$_SESSION['id_usuario']."'";	
	$cliente ='';
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
		$i = 0;
		while($row = $result->fetch_assoc()) {
			$cliente[$i]['dni']					= $row["dni"];
			$cliente[$i]['nombre']				= $row["nombre"];			
			$cliente[$i]['apellidos']			= $row["apellidos"];			
			$cliente[$i]['sexo']				= $row["sexo"];
			$cliente[$i]['telefono_fijo']		= $row["telefono_fijo"];
			$cliente[$i]['telefono_movil']		= $row["telefono_movil"];
			$cliente[$i]['direccion']			= $row["direccion"];
			$cliente[$i]['cp']					= $row["cp"];
			$cliente[$i]['localidad']			= $row["localidad"];
			$cliente[$i]['peso']				= $row["peso"];
			$cliente[$i]['altura']				= $row["altura"];
			$cliente[$i]['fecha_nacimiento']	= $row["fecha_nacimiento"];
			$cliente[$i]['email']				= $row["email"];
			$cliente[$i]['comentarios']			= $row["comentarios"];
			$cliente[$i]['nombre_completo']		= $row["nombre_completo"];
			$cliente[$i]['actividad']			= $row["actividad"];
			$cliente[$i]['fecha_de_alta']		= $row["fecha_de_alta"];
			$cliente[$i]['fecha_de_baja']		= $row["fecha_de_baja"];
			$i++;			
		}
		
	return $cliente;
}


function obtener_datos_cliente_x_usuario ($id_cliente) {
	$query = "SELECT * FROM `gx_clientes` WHERE id_cliente = '".$id_cliente."' AND id_usuario = '".$_SESSION['id_usuario']."'";
	$cliente ='';
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));			
		while($row = $result->fetch_assoc()) {
			$cliente['dni']					= $row["dni"];
			$cliente['nombre']				= $row["nombre"];			
			$cliente['apellidos']			= $row["apellidos"];			
			$cliente['sexo']				= $row["sexo"];
			$cliente['telefono_fijo']		= $row["telefono_fijo"];
			$cliente['telefono_movil']		= $row["telefono_movil"];
			$cliente['direccion']			= $row["direccion"];
			$cliente['cp']					= $row["cp"];
			$cliente['localidad']			= $row["localidad"];
			$cliente['peso']				= $row["peso"];
			$cliente['edad']				= $row["edad"];
			$cliente['altura']				= $row["altura"];
			$cliente['fecha_nacimiento']	= $row["fecha_nacimiento"];
			$cliente['email']				= $row["email"];
			$cliente['comentarios']			= $row["comentarios"];
			$cliente['recomendaciones']		= $row["recomendaciones"];
			$cliente['nombre_completo']		= $row["nombre_completo"];
			$cliente['actividad']			= $row["actividad"];
			$cliente['fecha_de_alta']		= $row["fecha_de_alta"];
			$cliente['fecha_de_baja']		= $row["fecha_de_baja"];	
			
			if($row["sexo"] != '' AND $row["peso"] != '' AND $row["altura"] != '' AND $row["edad"] != '' AND $row["actividad"] != ''){
				$cliente['imcf'] = round(($row["peso"] * 10000) / ($row["altura"] * $row["altura"]), 5);
			}else{
				$cliente['imcf'] = '';
			}
			
			$metabolismo = '';
			$factor_actividad_hombre = '';
			$factor_actividad_mujer = '';
			$cliente['metabolismo'] = '';
			$cliente['gasto_energetico'] = '';
			
			//-> si estan todas las variables
			if($row["sexo"] != '' AND $row["peso"] != '' AND $row["altura"] != '' AND $row["edad"] != '' AND $row["actividad"] != ''){
				if ($row["sexo"]  == "Hombre"){
					$cliente['metabolismo'] = (66.5 + 13.74 * $row["peso"] + 5.03 * $row["altura"]  - 6.75 * $row["edad"]);
				} else if ($row["sexo"] == "Mujer") { 		
					$cliente['metabolismo'] = (655.1 + 9.65 * $row["peso"] + 1.85 * $row["altura"]  - 4.68 * $row["edad"]);
				}
				
				//->Actividad
				if ($row["actividad"] == "Reposo en cama"){	
					$factor_actividad_hombre = 1;
					$factor_actividad_mujer = 1;
				}else if ($row["actividad"] == "Ligera"){
					$factor_actividad_hombre = 1.55;
					$factor_actividad_mujer = 1.56;
				}else if ($row["actividad"] == "Moderada"){
					$factor_actividad_hombre = 1.78;
					$factor_actividad_mujer = 1.64;
				}else{
					$factor_actividad_hombre = 2.10;
					$factor_actividad_mujer = 1.82;
				}
				
				//->Gasto Energetico
				if ($row["sexo"] == "Hombre"){
					$cliente['gasto_energetico'] = $cliente['metabolismo'] * $factor_actividad_hombre;					
				}else{
					$cliente['gasto_energetico'] = $cliente['metabolismo'] * $factor_actividad_mujer;
				}
			}
		
	}
	return $cliente;
}

//Obtener grupos excluidos por clienta
function obtener_grupos_excluidos_x_cliente ($id_cliente) {
	$query = "SELECT * FROM `gx_grupos_excluidos` WHERE id_cliente = '".$id_cliente."'";	
	$i = 0;
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));			
		while($row = $result->fetch_assoc()) {
			$grupos[$i]				= $row["id_grupo"];
			$i++;
		}
	if(empty($grupos)){ $grupos = ''; }		
	return $grupos;
}

//Obtener alimentos excluidos por clienta
function obtener_alimentos_excluidos_x_cliente ($id_cliente) {
	$query = "SELECT * FROM `gx_alimentos_excluidos` WHERE id_cliente = '".$id_cliente."'";	
	$i = 0;
	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));			
		while($row = $result->fetch_assoc()) {
			$alimentos[$i]				= $row["id_alimento"];
			$i++;
		}
	if(empty($alimentos) or $alimentos = ' '){ $alimentos = ''; } 		
	return $alimentos;
}

//->Obtener historial de peso de clientes
function obtener_historial_peso_cliente ($id_cliente) {
	$query = "SELECT * FROM `gx_historial_pesos` WHERE id_cliente = '".$id_cliente."' AND status = 1 ORDER BY id ASC";	
	
	$i = 0;
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));			
		while($row = $result->fetch_assoc()) {
			$historial_pesos[$i]["id"]						= $row["id"];
			$historial_pesos[$i]["fecha"]					= $row["fecha"];
			$historial_pesos[$i]["peso"]					= $row["peso"];
			$historial_pesos[$i]["edad"]					= $row["edad"];
			$historial_pesos[$i]["informacion"]				= $row["informacion"];
			$historial_pesos[$i]["metabolisto_basal"]		= $row["metabolisto_basal"];
			$historial_pesos[$i]["gasto_energetico_total"]	= $row["gasto_energetico_total"];
			$historial_pesos[$i]["inice_masa_corporal"]		= $row["inice_masa_corporal"];
			
			$i++;
		}
	if(empty($historial_pesos)){ $historial_pesos = ''; } 		
	return $historial_pesos;
}
function obtener_historial_peso_cliente_grafico ($id_cliente) {
	$query = "SELECT * FROM `gx_historial_pesos` WHERE id_cliente = '".$id_cliente."' AND status = 1 ORDER BY id ASC";	
	
	$i = 0;
	$peso_grafico = '';	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));			
	while($row = $result->fetch_assoc()) {
		$peso_grafico[$i] = number_format($row["peso"]);
		$i++;
	}
	return $peso_grafico;	
}
//->Obtener historial de peso de clientes
function obtener_mediciones_del_cliente ($id_cliente) {
	$query = "SELECT * FROM `gx_mediciones` WHERE id_cliente = '".$id_cliente."' AND status = 1 ORDER BY fecha ASC";	
	$i = 0;
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));			
		while($row = $result->fetch_assoc()) {
			$historial_pesos[$i]["id_medicion"]					= $row["id_medicion"];
			$historial_pesos[$i]["id_cliente"]					= $row["id_cliente"];
			$historial_pesos[$i]["fecha"]						= $row["fecha"];
			$historial_pesos[$i]["bia_porc_grasa"]				= $row["bia_porc_grasa"];
			$historial_pesos[$i]["bia_grasa_total"]				= $row["bia_grasa_total"];
			$historial_pesos[$i]["bia_masa_grasa_total"]		= $row["bia_masa_grasa_total"];
			$historial_pesos[$i]["bia_agua_total"]				= $row["bia_agua_total"];
			$historial_pesos[$i]["bia_agua_intracelular"]		= $row["bia_agua_intracelular"];
			$historial_pesos[$i]["bia_agua_extracelular"]		= $row["bia_agua_extracelular"];
			$historial_pesos[$i]["bia_porc_masa_magra"]			= $row["bia_porc_masa_magra"];
			$historial_pesos[$i]["bia_masa_muscular_total"]		= $row["bia_masa_muscular_total"];
			$historial_pesos[$i]["bia_musc_brazo_dcho"]			= $row["bia_musc_brazo_dcho"];
			$historial_pesos[$i]["bia_musc_brazo_izdo"]			= $row["bia_musc_brazo_izdo"];
			$historial_pesos[$i]["bia_tronco"]					= $row["bia_tronco"];
			$historial_pesos[$i]["bia_pierna_dcha"]				= $row["bia_pierna_dcha"];
			$historial_pesos[$i]["bia_pierna_izda"]				= $row["bia_pierna_izda"];
			$historial_pesos[$i]["bia_grasa_visceral"]			= $row["bia_grasa_visceral"];
			$historial_pesos[$i]["perimetro_cefalico"]			= $row["perimetro_cefalico"];
			$historial_pesos[$i]["perimetro_cuello"]			= $row["perimetro_cuello"];
			$historial_pesos[$i]["perimetro_mesoesternal"]		= $row["perimetro_mesoesternal"];
			$historial_pesos[$i]["perimetro_brazo_contraido"]	= $row["perimetro_brazo_contraido"];
			$historial_pesos[$i]["perimetro_brazo_relajado"]	= $row["perimetro_brazo_relajado"];
			$historial_pesos[$i]["perimetro_antebrazo"]			= $row["perimetro_antebrazo"];
			$historial_pesos[$i]["perimetro_muneca"]			= $row["perimetro_muneca"];
			$historial_pesos[$i]["perimetro_cadera"]			= $row["perimetro_cadera"];
			$historial_pesos[$i]["perimetro_cintura"]			= $row["perimetro_cintura"];
			$historial_pesos[$i]["perimetro_muslo"]				= $row["perimetro_muslo"];
			$historial_pesos[$i]["perimetro_pantorrilla"]		= $row["perimetro_pantorrilla"];
			$historial_pesos[$i]["perimetro_tobillo"]			= $row["perimetro_tobillo"];
			$historial_pesos[$i]["ultrasonidos_grasa"]			= $row["ultrasonidos_grasa"];
			$historial_pesos[$i]["ultrasonidos_grasa_total"]	= $row["ultrasonidos_grasa_total"];
			$historial_pesos[$i]["ultrasonidos_masa_magra"]		= $row["ultrasonidos_masa_magra"];
			$historial_pesos[$i]["infrarrojos_grasa"]			= $row["infrarrojos_grasa"];
			$historial_pesos[$i]["infrarrojos_grasa_total"]		= $row["infrarrojos_grasa_total"];
			$historial_pesos[$i]["infrarrojos_masa_magra"]		= $row["infrarrojos_masa_magra"];
			$historial_pesos[$i]["plico_tricipital"]			= $row["plico_tricipital"];
			$historial_pesos[$i]["plico_bicipital"]				= $row["plico_bicipital"];
			$historial_pesos[$i]["plico_subescapular"]			= $row["plico_subescapular"];
			$historial_pesos[$i]["plico_suprailiaco"]			= $row["plico_suprailiaco"];
			$historial_pesos[$i]["plico_abdominal"]				= $row["plico_abdominal"];
			$historial_pesos[$i]["plico_pectoral"]				= $row["plico_pectoral"];
			$historial_pesos[$i]["plico_medioaxiliar"]			= $row["plico_medioaxiliar"];
			$historial_pesos[$i]["plico_muslo"]					= $row["plico_muslo"];
			$historial_pesos[$i]["plico_pantorrilla"]			= $row["plico_pantorrilla"];
			$historial_pesos[$i]["plico_suma_pliegues"]			= $row["plico_suma_pliegues"];
			$historial_pesos[$i]["plico_porc_grasa"]			= $row["plico_porc_grasa"];
			$historial_pesos[$i]["plico_total_grasa"]			= $row["plico_total_grasa"];
			$historial_pesos[$i]["plico_masa_grasa"]			= $row["plico_masa_grasa"];
			$historial_pesos[$i]["plico_densidad"]				= $row["plico_densidad"];
			
			$i++;
		}
	if(empty($historial_pesos)){ $historial_pesos = ''; } 		
	return $historial_pesos;
}

function obtener_ultima_medicion_del_cliente ($id_cliente) {
	$query = "SELECT * FROM `gx_mediciones` WHERE id_cliente = '".$id_cliente."' AND status = 1 ORDER BY fecha DESC";	
	$i = 0;
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));			
		while($row = $result->fetch_assoc()) {
			$historial_pesos["id_medicion"]					= $row["id_medicion"];
			$historial_pesos["id_cliente"]					= $row["id_cliente"];
			$historial_pesos["fecha"]						= $row["fecha"];
			$historial_pesos["bia_porc_grasa"]				= $row["bia_porc_grasa"];
			$historial_pesos["bia_grasa_total"]				= $row["bia_grasa_total"];
			$historial_pesos["bia_masa_grasa_total"]		= $row["bia_masa_grasa_total"];
			$historial_pesos["bia_agua_total"]				= $row["bia_agua_total"];
			$historial_pesos["bia_agua_intracelular"]		= $row["bia_agua_intracelular"];
			$historial_pesos["bia_agua_extracelular"]		= $row["bia_agua_extracelular"];
			$historial_pesos["bia_porc_masa_magra"]			= $row["bia_porc_masa_magra"];
			$historial_pesos["bia_masa_muscular_total"]		= $row["bia_masa_muscular_total"];
			$historial_pesos["bia_musc_brazo_dcho"]			= $row["bia_musc_brazo_dcho"];
			$historial_pesos["bia_musc_brazo_izdo"]			= $row["bia_musc_brazo_izdo"];
			$historial_pesos["bia_tronco"]					= $row["bia_tronco"];
			$historial_pesos["bia_pierna_dcha"]				= $row["bia_pierna_dcha"];
			$historial_pesos["bia_pierna_izda"]				= $row["bia_pierna_izda"];
			$historial_pesos["bia_grasa_visceral"]			= $row["bia_grasa_visceral"];
			$historial_pesos["perimetro_cefalico"]			= $row["perimetro_cefalico"];
			$historial_pesos["perimetro_cuello"]			= $row["perimetro_cuello"];
			$historial_pesos["perimetro_mesoesternal"]		= $row["perimetro_mesoesternal"];
			$historial_pesos["perimetro_brazo_contraido"]	= $row["perimetro_brazo_contraido"];
			$historial_pesos["perimetro_brazo_relajado"]	= $row["perimetro_brazo_relajado"];
			$historial_pesos["perimetro_antebrazo"]			= $row["perimetro_antebrazo"];
			$historial_pesos["perimetro_muneca"]			= $row["perimetro_muneca"];
			$historial_pesos["perimetro_cadera"]			= $row["perimetro_cadera"];
			$historial_pesos["perimetro_cintura"]			= $row["perimetro_cintura"];
			$historial_pesos["perimetro_muslo"]				= $row["perimetro_muslo"];
			$historial_pesos["perimetro_pantorrilla"]		= $row["perimetro_pantorrilla"];
			$historial_pesos["perimetro_tobillo"]			= $row["perimetro_tobillo"];
			$historial_pesos["ultrasonidos_grasa"]			= $row["ultrasonidos_grasa"];
			$historial_pesos["ultrasonidos_grasa_total"]	= $row["ultrasonidos_grasa_total"];
			$historial_pesos["ultrasonidos_masa_magra"]		= $row["ultrasonidos_masa_magra"];
			$historial_pesos["infrarrojos_grasa"]			= $row["infrarrojos_grasa"];
			$historial_pesos["infrarrojos_grasa_total"]		= $row["infrarrojos_grasa_total"];
			$historial_pesos["infrarrojos_masa_magra"]		= $row["infrarrojos_masa_magra"];
			$historial_pesos["plico_tricipital"]			= $row["plico_tricipital"];
			$historial_pesos["plico_bicipital"]				= $row["plico_bicipital"];
			$historial_pesos["plico_subescapular"]			= $row["plico_subescapular"];
			$historial_pesos["plico_suprailiaco"]			= $row["plico_suprailiaco"];
			$historial_pesos["plico_abdominal"]				= $row["plico_abdominal"];
			$historial_pesos["plico_pectoral"]				= $row["plico_pectoral"];
			$historial_pesos["plico_medioaxiliar"]			= $row["plico_medioaxiliar"];
			$historial_pesos["plico_muslo"]					= $row["plico_muslo"];
			$historial_pesos["plico_pantorrilla"]			= $row["plico_pantorrilla"];
			$historial_pesos["plico_suma_pliegues"]			= $row["plico_suma_pliegues"];
			$historial_pesos["plico_porc_grasa"]			= $row["plico_porc_grasa"];
			$historial_pesos["plico_total_grasa"]			= $row["plico_total_grasa"];
			$historial_pesos["plico_masa_grasa"]			= $row["plico_masa_grasa"];
			$historial_pesos["plico_densidad"]				= $row["plico_densidad"];
			
			$i++;
		}
	if(empty($historial_pesos)){ $historial_pesos = ''; } 		
	return $historial_pesos;
}

function obtener_mediciones_del_cliente_x_usuario () {
	$query = "SELECT gx_mediciones.*, gx_clientes.id_usuario, gx_clientes.dni, gx_clientes.nombre, gx_clientes.apellidos FROM `gx_mediciones` 
	LEFT JOIN gx_clientes ON gx_mediciones.id_cliente = gx_clientes.id_cliente
	WHERE gx_clientes.id_usuario = '".$_SESSION['id_usuario']."' AND gx_mediciones.status = 1 ORDER BY fecha ASC";	
	
	$i = 0;
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));			
		while($row = $result->fetch_assoc()) {
			$historial_pesos[$i]["id_medicion"]					= $row["id_medicion"];
			$historial_pesos[$i]["id_cliente"]					= $row["id_cliente"];
			$historial_pesos[$i]["dni"]							= $row["dni"];
			$historial_pesos[$i]["nombre"]						= $row["nombre"];
			$historial_pesos[$i]["apellidos"]					= $row["apellidos"];
			$historial_pesos[$i]["fecha"]						= $row["fecha"];
			$historial_pesos[$i]["bia_porc_grasa"]				= $row["bia_porc_grasa"];
			$historial_pesos[$i]["bia_grasa_total"]				= $row["bia_grasa_total"];
			$historial_pesos[$i]["bia_masa_grasa_total"]		= $row["bia_masa_grasa_total"];
			$historial_pesos[$i]["bia_agua_total"]				= $row["bia_agua_total"];
			$historial_pesos[$i]["bia_agua_intracelular"]		= $row["bia_agua_intracelular"];
			$historial_pesos[$i]["bia_agua_extracelular"]		= $row["bia_agua_extracelular"];
			$historial_pesos[$i]["bia_porc_masa_magra"]			= $row["bia_porc_masa_magra"];
			$historial_pesos[$i]["bia_masa_muscular_total"]		= $row["bia_masa_muscular_total"];
			$historial_pesos[$i]["bia_musc_brazo_dcho"]			= $row["bia_musc_brazo_dcho"];
			$historial_pesos[$i]["bia_musc_brazo_izdo"]			= $row["bia_musc_brazo_izdo"];
			$historial_pesos[$i]["bia_tronco"]					= $row["bia_tronco"];
			$historial_pesos[$i]["bia_pierna_dcha"]				= $row["bia_pierna_dcha"];
			$historial_pesos[$i]["bia_pierna_izda"]				= $row["bia_pierna_izda"];
			$historial_pesos[$i]["bia_grasa_visceral"]			= $row["bia_grasa_visceral"];
			$historial_pesos[$i]["perimetro_cefalico"]			= $row["perimetro_cefalico"];
			$historial_pesos[$i]["perimetro_cuello"]			= $row["perimetro_cuello"];
			$historial_pesos[$i]["perimetro_mesoesternal"]		= $row["perimetro_mesoesternal"];
			$historial_pesos[$i]["perimetro_brazo_contraido"]	= $row["perimetro_brazo_contraido"];
			$historial_pesos[$i]["perimetro_brazo_relajado"]	= $row["perimetro_brazo_relajado"];
			$historial_pesos[$i]["perimetro_antebrazo"]			= $row["perimetro_antebrazo"];
			$historial_pesos[$i]["perimetro_muneca"]			= $row["perimetro_muneca"];
			$historial_pesos[$i]["perimetro_cadera"]			= $row["perimetro_cadera"];
			$historial_pesos[$i]["perimetro_cintura"]			= $row["perimetro_cintura"];
			$historial_pesos[$i]["perimetro_muslo"]				= $row["perimetro_muslo"];
			$historial_pesos[$i]["perimetro_pantorrilla"]		= $row["perimetro_pantorrilla"];
			$historial_pesos[$i]["perimetro_tobillo"]			= $row["perimetro_tobillo"];
			$historial_pesos[$i]["ultrasonidos_grasa"]			= $row["ultrasonidos_grasa"];
			$historial_pesos[$i]["ultrasonidos_grasa_total"]	= $row["ultrasonidos_grasa_total"];
			$historial_pesos[$i]["ultrasonidos_masa_magra"]		= $row["ultrasonidos_masa_magra"];
			$historial_pesos[$i]["infrarrojos_grasa"]			= $row["infrarrojos_grasa"];
			$historial_pesos[$i]["infrarrojos_grasa_total"]		= $row["infrarrojos_grasa_total"];
			$historial_pesos[$i]["infrarrojos_masa_magra"]		= $row["infrarrojos_masa_magra"];
			$historial_pesos[$i]["plico_tricipital"]			= $row["plico_tricipital"];
			$historial_pesos[$i]["plico_bicipital"]				= $row["plico_bicipital"];
			$historial_pesos[$i]["plico_subescapular"]			= $row["plico_subescapular"];
			$historial_pesos[$i]["plico_suprailiaco"]			= $row["plico_suprailiaco"];
			$historial_pesos[$i]["plico_abdominal"]				= $row["plico_abdominal"];
			$historial_pesos[$i]["plico_pectoral"]				= $row["plico_pectoral"];
			$historial_pesos[$i]["plico_medioaxiliar"]			= $row["plico_medioaxiliar"];
			$historial_pesos[$i]["plico_muslo"]					= $row["plico_muslo"];
			$historial_pesos[$i]["plico_pantorrilla"]			= $row["plico_pantorrilla"];
			$historial_pesos[$i]["plico_suma_pliegues"]			= $row["plico_suma_pliegues"];
			$historial_pesos[$i]["plico_porc_grasa"]			= $row["plico_porc_grasa"];
			$historial_pesos[$i]["plico_total_grasa"]			= $row["plico_total_grasa"];
			$historial_pesos[$i]["plico_masa_grasa"]			= $row["plico_masa_grasa"];
			$historial_pesos[$i]["plico_densidad"]				= $row["plico_densidad"];
			
			$i++;
		}
	if(empty($historial_pesos)){ $historial_pesos = ''; } 		
	return $historial_pesos;
}
//->UPDATES
//Actualizar cliente		
function actualizar_cliente ($id_cliente, $dni, $nombre, $apellidos, $sexo, $telefono_fijo, $telefono_movil, $direccion, $cp, $localidad, $peso, $edad, $altura, $fecha_nacimiento, $email, $comentarios, $recomendaciones, $nombre_completo, $actividad, $fecha_de_alta)
{
	$query = "UPDATE `gx_clientes` 
	SET `dni` = '".$dni."', 
	`nombre` = '".$nombre."',
	`apellidos` = '".$apellidos."',
	`sexo` = '".$sexo."',
	`telefono_fijo` = '".$telefono_fijo."',
	`telefono_movil` = '".$telefono_movil."',
	`direccion` = '".$direccion."',
	`cp` = '".$cp."',
	`localidad` = '".$localidad."',
	`peso` = '".$peso."',
	`edad` = '".$edad."',
	`altura` = '".$altura."',
	`fecha_nacimiento` = '".$fecha_nacimiento."',
	`email` = '".$email."',
	`comentarios` = '".$comentarios."',
	`recomendaciones` = '".$recomendaciones."',
	`nombre_completo` = '".$nombre_completo."',
	`actividad` = '".$actividad."',
	`fecha_de_alta` = '".$fecha_de_alta."'
	WHERE id_cliente = '".$id_cliente."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
}
//Esconder peso
function esconder_peso_cliente ($id)
{
	$query = "UPDATE `gx_historial_pesos` 
	SET `status` = '0'
	WHERE id = '".$id."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
}
//Esconder mediciones
function esconder_mediciones_del_cliente ($id)
{
	$query = "UPDATE `gx_mediciones` 
	SET `status` = '0'
	WHERE id_medicion = '".$id."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
}
	
//Insertar nuevo cliente
function crear_nuevo_cliente ($dni, $nombre, $apellidos, $sexo, $telefono_fijo, $telefono_movil, $direccion, $cp, $localidad, $peso, $altura, $fecha_nacimiento, $email, $comentarios, $recomendaciones, $nombre_completo, $actividad, $fecha_de_alta) {

	$query = "INSERT into gx_clientes (id_usuario, dni, nombre, apellidos, sexo, telefono_fijo, telefono_movil, direccion, cp, localidad, peso, altura, fecha_nacimiento, email, comentarios, recomendaciones, nombre_completo, actividad, fecha_de_alta) values
	('".$_SESSION['id_usuario']."', '".$dni."', '".$nombre."', '".$apellidos."', '".$sexo."', '".$telefono_fijo."', '".$telefono_movil."', '".$direccion."', '".$cp."', '".$localidad."', '".$peso."', '".$altura."', '".$fecha_nacimiento."', '".$email."', '".$comentarios."',  '".$recomendaciones."', '".$nombre_completo."', '".$actividad."', '".$fecha_de_alta."')";

	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
		
	return mysqli_insert_id($_SESSION["conexion"]);
	
	
}

//Insertar nuevo cliente
function nuevo_registro_pesox_cliente ($id_cliente, $fecha, $peso, $edad, $informacion, $metabolisto_basal, $gasto_energetico_total, $inice_masa_corporal) {

	$query = "INSERT into gx_historial_pesos (id_cliente, fecha, peso, edad, informacion, metabolisto_basal, gasto_energetico_total, inice_masa_corporal) values
	('".$id_cliente."', '".$fecha."', '".$peso."', '".$edad."', '".$informacion."', '".$metabolisto_basal."', '".$gasto_energetico_total."', '".$inice_masa_corporal."')";

	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
	return $query;
		
}
//Insertar Nueva medicion
function ingresar_nueva_medicion_cliente ($id_cliente, $fecha_de_alta, $bia_porc_grasa, $bia_grasa_total, $bia_masa_grasa_total, $bia_agua_total, $bia_agua_intracelular, $bia_agua_extracelular, $bia_porc_masa_magra, $bia_masa_muscular_total, $bia_musc_brazo_dcho, $bia_musc_brazo_izdo, $bia_tronco, $bia_pierna_dcha, $bia_pierna_izda, $bia_grasa_visceral, $perimetro_cefalico, $perimetro_cuello, $perimetro_mesoesternal, $perimetro_brazo_contraido, $perimetro_brazo_relajado, $perimetro_antebrazo, $perimetro_muneca, $perimetro_cadera, $perimetro_cintura, $perimetro_muslo, $perimetro_pantorrilla, $perimetro_tobillo, $ultrasonidos_grasa, $ultrasonidos_grasa_total, $ultrasonidos_masa_magra, $infrarrojos_grasa, $infrarrojos_grasa_total, $infrarrojos_masa_magra, $plico_tricipital, $plico_bicipital, $plico_subescapular, $plico_suprailiaco, $plico_abdominal, $plico_pectoral, $plico_medioaxiliar, $plico_muslo, $plico_pantorrilla, $plico_suma_pliegues, $plico_porc_grasa, $plico_total_grasa, $plico_masa_grasa, $plico_densidad) {
	$query = "INSERT into gx_mediciones (id_cliente, fecha, bia_porc_grasa, bia_grasa_total, bia_masa_grasa_total, bia_agua_total, bia_agua_intracelular, bia_agua_extracelular, bia_porc_masa_magra, bia_masa_muscular_total, bia_musc_brazo_dcho, bia_musc_brazo_izdo, bia_tronco, bia_pierna_dcha, bia_pierna_izda, bia_grasa_visceral, perimetro_cefalico, perimetro_cuello, perimetro_mesoesternal, perimetro_brazo_contraido, perimetro_brazo_relajado, perimetro_antebrazo, perimetro_muneca, perimetro_cadera, perimetro_cintura, perimetro_muslo, perimetro_pantorrilla, perimetro_tobillo, ultrasonidos_grasa, ultrasonidos_grasa_total, ultrasonidos_masa_magra, infrarrojos_grasa, infrarrojos_grasa_total, infrarrojos_masa_magra, plico_tricipital, plico_bicipital, plico_subescapular, plico_suprailiaco, plico_abdominal, plico_pectoral, plico_medioaxiliar, plico_muslo, plico_pantorrilla, plico_suma_pliegues, plico_porc_grasa, plico_total_grasa, plico_masa_grasa, plico_densidad) values
	('".$id_cliente."', '".$fecha_de_alta."',  '".$bia_porc_grasa."', '".$bia_grasa_total."', '".$bia_masa_grasa_total."', '".$bia_agua_total."', '".$bia_agua_intracelular."', '".$bia_agua_extracelular."', '".$bia_porc_masa_magra."', '".$bia_masa_muscular_total."', '".$bia_musc_brazo_dcho."', '".$bia_musc_brazo_izdo."', '".$bia_tronco."', '".$bia_pierna_dcha."', '".$bia_pierna_izda."', '".$bia_grasa_visceral."', '".$perimetro_cefalico."', '".$perimetro_cuello."', '".$perimetro_mesoesternal."', '".$perimetro_brazo_contraido."', '".$perimetro_brazo_relajado."', '".$perimetro_antebrazo."', '".$perimetro_muneca."', '".$perimetro_cadera."', '".$perimetro_cintura."', '".$perimetro_muslo."', '".$perimetro_pantorrilla."', '".$perimetro_tobillo."', '".$ultrasonidos_grasa."', '".$ultrasonidos_grasa_total."', '".$ultrasonidos_masa_magra."', '".$infrarrojos_grasa."', '".$infrarrojos_grasa_total."', '".$infrarrojos_masa_magra."', '".$plico_tricipital."', '".$plico_bicipital."', '".$plico_subescapular."', '".$plico_suprailiaco."', '".$plico_abdominal."', '".$plico_pectoral."', '".$plico_medioaxiliar."', '".$plico_muslo."', '".$plico_pantorrilla."', '".$plico_suma_pliegues."', '".$plico_porc_grasa."', '".$plico_total_grasa."', '".$plico_masa_grasa."', '".$plico_densidad."')";

	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
}

//Eliminar los grupos de alimientos para el cliente nuevo
function eliminar_grupos_alimentos_x_clientes ($id_grupo, $id_cliente) {
	
	$query = "INSERT into gx_grupos_excluidos (id_grupo, id_cliente) values
	('".$id_grupo."', '".$id_cliente."')";

	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
	return $query;
	
}
//Eliminar los alimentos para el nuevo cliente
function eliminar_alimentos_x_clientes ($id_alimento, $id_cliente) {

	$query = "INSERT into gx_alimentos_excluidos (id_alimento, id_cliente) values
	('".$id_alimento."', '".$id_cliente."')";

	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
	return $query;
	
}
//->DELETE
function eliminar_registro_grupos_alimentos_x_clientes ($id_cliente) {
	
	$sql = "DELETE FROM gx_grupos_excluidos WHERE id_cliente='".$id_cliente."'";
	if ($_SESSION["conexion"]->query($sql) === TRUE) {} else { $_SESSION["conexion"]->error; }
	
}
function eliminar_registros_alimentos_x_clientes ($id_cliente) {
	
	$sql = "DELETE FROM gx_alimentos_excluidos WHERE id_cliente='".$id_cliente."'";
	if ($_SESSION["conexion"]->query($sql) === TRUE) {} else { $_SESSION["conexion"]->error; }
	
}

function mostrar_grupos_alimentos () {

	$query = "SELECT * FROM `gx_grupos_alimentos`";

	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	$i = 0;
	while($row = $result->fetch_assoc()) {
		$mostrar[$i]['id_grupo']		= $row['id_grupo'];
		$mostrar[$i]['grupo']			= $row['grupo'];
		$i++;
		
	}
		
	return $mostrar;
	
}


/**************				Fin Clientes 		*******************/

/**************				Citas 		*******************/
//-> Total citas
function total_citas_por_cliente () {
	$query = "SELECT * FROM `gx_citas` WHERE `id_usuario` = '".$_SESSION['id_usuario']."'";	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	$i = 0;
	while($row = $result->fetch_assoc()) {
		
		$i++;
	}
	
	return $i;
}
function total_citas_por_cliente_en_mes ($mes) {
	$query = "SELECT * FROM `gx_citas` WHERE `id_usuario` = '".$_SESSION['id_usuario']."' AND inicio like '%".$mes."%'";	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	$i = 0;
	while($row = $result->fetch_assoc()) {
		
		$i++;
	}
	
	return $i;
}
//-> SELETS
function buscar_cita ($id_cita) {

	$query = "SELECT gx_citas.*, gx_clientes.dni, gx_clientes.id_usuario, gx_clientes.nombre, gx_clientes.apellidos, gx_clientes.telefono_movil FROM `gx_citas`
	LEFT JOIN gx_clientes ON gx_citas.id_cliente = gx_clientes.id_cliente
	WHERE gx_clientes.id_usuario = '".$_SESSION["id_usuario"]."' AND gx_citas.status = 1 AND gx_citas.id = '".$id_cita."'";

	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
	$cita = '';	
	while($row = $result->fetch_assoc()) {
		$cita['id']					= $row['id'];
		$cita['id_cliente']			= $row['id_cliente'];
		$cita['dni']				= $row['dni'];
		$cita['nombre']				= $row['nombre'];
		$cita['apellidos']			= $row['apellidos'];
		$cita['telefono_movil']		= $row['telefono_movil'];
		$cita['inicio']				= $row['inicio'];
		$cita['inicio_dia']			= $row['inicio_dia'];
		$cita['inicio_mes']			= $row['inicio_mes']-1;
		$cita['inicio_ano']			= $row['inicio_ano'];
		$cita['inicio_hora']		= $row['inicio_hora'];
		$cita['inicio_min']			= $row['inicio_min'];
		$cita['fin']				= $row['fin'];
		$cita['fin_dia']			= $row['fin_dia'];
		$cita['fin_mes']			= $row['fin_mes']-1;
		$cita['fin_ano']			= $row['fin_ano'];
		$cita['fin_hora']			= $row['fin_hora'];
		$cita['fin_min']			= $row['fin_min'];
		$cita['titulo']				= $row['titulo'];
		$cita['tipo_cita']			= $row['tipo_cita'];
	}
		
	return $cita;
	
}
function todas_las_citas_activas () {
	$query = "SELECT gx_citas.*, gx_clientes.dni, gx_clientes.id_usuario, gx_clientes.nombre, gx_clientes.apellidos, gx_clientes.telefono_movil FROM `gx_citas`
	LEFT JOIN gx_clientes ON gx_citas.id_cliente = gx_clientes.id_cliente
	WHERE gx_clientes.id_usuario = '".$_SESSION["id_usuario"]."' AND gx_citas.status = 1";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
	$cita = '';
	$i = 0;
	while($row = $result->fetch_assoc()) {
		
				
		$cita[$i]['id']					= $row['id'];
		$cita[$i]['id_cliente']			= $row['id_cliente'];
		$cita[$i]['dni']				= $row['dni'];
		$cita[$i]['nombre']				= $row['nombre'];
		$cita[$i]['apellidos']			= $row['apellidos'];
		$cita[$i]['telefono_movil']		= $row['telefono_movil'];
		$cita[$i]['inicio']				= $row['inicio'];
		$cita[$i]['inicio_dia']			= $row['inicio_dia'];
		$cita[$i]['inicio_mes']			= $row['inicio_mes']-1;
		$cita[$i]['inicio_ano']			= $row['inicio_ano'];
		$cita[$i]['inicio_hora']		= $row['inicio_hora'];
		$cita[$i]['inicio_min']			= $row['inicio_min'];
		$cita[$i]['fin']				= $row['fin'];
		$cita[$i]['fin_dia']			= $row['fin_dia'];
		$cita[$i]['fin_mes']			= $row['fin_mes']-1;
		$cita[$i]['fin_ano']			= $row['fin_ano'];
		$cita[$i]['fin_hora']			= $row['fin_hora'];
		$cita[$i]['fin_min']			= $row['fin_min'];
		$cita[$i]['titulo']				= $row['titulo'];
		$cita[$i]['tipo_cita']			= $row['tipo_cita'];
		//Ordenar 		
		$cita[$i]['ordenar_inicio']		= substr($row['inicio'], 6, 4).substr($row['inicio'], 3, 2).substr($row['inicio'], 0, 2);
		$cita[$i]['ordenar_fin']		= substr($row['fin'], 6, 4).substr($row['fin'], 3, 2).substr($row['fin'], 0, 2);
		$i++;
		
	}
		
	return $cita;
	
}
function todas_las_citas_desactivadas () {

	$query = "SELECT gx_citas.*, gx_clientes.dni, gx_clientes.id_usuario, gx_clientes.nombre, gx_clientes.apellidos, gx_clientes.telefono_movil FROM `gx_citas`
	LEFT JOIN gx_clientes ON gx_citas.id_cliente = gx_clientes.id_cliente
	WHERE gx_clientes.id_usuario = '".$_SESSION["id_usuario"]."' AND gx_citas.status = 0";

	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
	$cita = '';
	$i = 0;
	while($row = $result->fetch_assoc()) {
		$cita[$i]['id']					= $row['id'];
		$cita[$i]['id_cliente']			= $row['id_cliente'];
		$cita[$i]['dni']				= $row['dni'];
		$cita[$i]['nombre']				= $row['nombre'];
		$cita[$i]['apellidos']			= $row['apellidos'];
		$cita[$i]['telefono_movil']		= $row['telefono_movil'];
		$cita[$i]['inicio']				= $row['inicio'];
		$cita[$i]['inicio_dia']			= $row['inicio_dia'];
		$cita[$i]['inicio_mes']			= $row['inicio_mes']-1;
		$cita[$i]['inicio_ano']			= $row['inicio_ano'];
		$cita[$i]['inicio_hora']		= $row['inicio_hora'];
		$cita[$i]['inicio_min']			= $row['inicio_min'];
		$cita[$i]['fin']				= $row['fin'];
		$cita[$i]['fin_dia']			= $row['fin_dia'];
		$cita[$i]['fin_mes']			= $row['fin_mes']-1;
		$cita[$i]['fin_ano']			= $row['fin_ano'];
		$cita[$i]['fin_hora']			= $row['fin_hora'];
		$cita[$i]['fin_min']			= $row['fin_min'];
		$cita[$i]['titulo']				= $row['titulo'];
		$cita[$i]['tipo_cita']			= $row['tipo_cita'];
		$i++;
		
	}
		
	return $cita;
	
}
//->UPDATES
function modificar_citas ($id, $inicio, $inicio_dia, $inicio_mes, $inicio_ano, $inicio_hora, $inicio_min, $fin, $fin_dia, $fin_mes, $fin_ano, $fin_hora, $fin_min, $titulo, $tipo_cita)
{
	$query = "UPDATE `gx_citas` 
	SET `inicio` = '".$inicio."',
	`inicio_dia` = '".$inicio_dia."',
	`inicio_mes` = '".$inicio_mes."',
	`inicio_ano` = '".$inicio_ano."',
	`inicio_hora` = '".$inicio_hora."',
	`inicio_min` = '".$inicio_min."',
	`fin` = '".$fin."',
	`fin_dia` = '".$fin_dia."',
	`fin_mes` = '".$fin_mes."',
	`fin_ano` = '".$fin_ano."',
	`fin_hora` = '".$fin_hora."',
	`fin_min` = '".$fin_min."',
	`titulo` = '".$titulo."',
	`tipo_cita` = '".$tipo_cita."'
	WHERE id = '".$id."' AND id_usuario = '".$_SESSION["id_usuario"]."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
}
function desactivar_citas($id)
{
	$query = "UPDATE `gx_citas` 
	SET `status` = '0'
	WHERE id = '".$id."' AND id_usuario = '".$_SESSION["id_usuario"]."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
}
function reactivar_citas($id)
{
	$query = "UPDATE `gx_citas` 
	SET `status` = '1'
	WHERE id = '".$id."' AND id_usuario = '".$_SESSION["id_usuario"]."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
}
function eliminar_citas($id_cliente)
{
	$query = "UPDATE `gx_citas` 
	SET `status` = '3'
	WHERE id = '".$id_cliente."' AND id_usuario = '".$_SESSION["id_usuario"]."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
	return $query;
}	
//->INSERTS
function insertar_nuevas_citas($id_cliente, $inicio, $inicio_dia, $inicio_mes, $inicio_ano, $inicio_hora, $inicio_min, $fin, $fin_dia, $fin_mes, $fin_ano, $fin_hora, $fin_min, $titulo, $tipo_cita)
{
	$query = "INSERT into gx_citas (id_usuario, id_cliente, inicio, inicio_dia, inicio_mes, inicio_ano, inicio_hora, inicio_min, fin, fin_dia, fin_mes, fin_ano, fin_hora, fin_min, titulo, tipo_cita) values
	('".$_SESSION["id_usuario"]."', '".$id_cliente."', '".$inicio."', '".$inicio_dia."', '".$inicio_mes."', '".$inicio_ano."', '".$inicio_hora."', '".$inicio_min."', '".$fin."', '".$fin_dia."', '".$fin_mes."', '".$fin_ano."', '".$fin_hora."', '".$fin_min."', '".$titulo."', '".$tipo_cita."')";

	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
	return $query;	
}

/**************				Fin Citas 		*******************/


//crear url amigable
function crear_cadena_amigable($cadena) {
	$cadena=utf8_encode($cadena);
	$cadena=str_replace(' ','_',$cadena);
	$cadena=str_replace('"','',$cadena);
	$cadena=str_replace('\r\n','',$cadena);
	$eliminar=array("!","¡","?","¿","‘","\"","$","(",")",".",":",";","-","/","\\","\$","%","@","#",",", "«", "»", "ª", "1", "2");
	$buscados=array(" ","á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","Ñ","ü","à","è","ì","ò","ù","À","È","Ì","Ò","Ù");
	$sustitut=array("_","a","e","i","o","u","a","e","i","o","u","n","n","u","a","e","i","o","u","A","E","I","O","U");
	$final=strtolower(str_replace($buscados,$sustitut,str_replace($eliminar,"",$cadena)));
	$final=str_replace("_","_",$final);
	$final=str_replace("_","_",$final);	
	return (strlen($final)>50) ? substr($final,0,strrpos(substr($final,0,50),"_")):$final;
}


/* Nuevo */
function gx_duplicar_alimento_original ($id_alimento){	
	$fecha = date('d-m-Y');
	$query = "INSERT INTO `gx_alimentos` (`id_usuario`, `nombre`, `nombre_ing`, `kcal_100g`, `hidratos`, `proteinas`, `grasa`, `grupo`, `id_supergrupos`, `proteinas_porc`, `hidratos_porc`, `grasa_porc`, `subgrupo`, `pc_porcentaje`, `cal_kcal`, `agua_g`, `hc_g`, `fibra_g`, `prot_g`, `grasa_g`, `col_mg`, `satur_g`, `mono_g`, `poli_g`, `vit_a`, `carotenos`, `vit_b1`, `vit_b2`, `niacina`, `ac_panto`, `vit_b6`, `biotina`, `folico`, `b12`, `vit_c`, `vit_d`, `tocoferol`, `vit_e`, `vit_k`, `oxalico`, `purinas`, `sodio_mg`, `potasio_mg`, `magnesio_mg`, `calcio_mg`, `fosf_mg`, `hierro_mg`, `cloro_mg`, `cinc_mg`, `cobre_mg`, `manganeso_mg`, `cromo_mg`, `cobalto_mg`, `molibde_mg`, `yodo_mg`, `fluor_mg`, `butirico_c4_0`, `caproico_c6_0`, `caprilico_c8_0`, `caprico_c10_0`, `laurico_c12_0`, `miristico_c14_0`, `c15_0`, `c15_00`, `palmitico_c16_0`, `c17_0`, `c17_00`, `estearico_c18_0`, `araquidi_c20_0`, `behenico_c22_0`, `miristol_c14_1`, `palmitole_c16_1`, `oleico_c18_1`, `eicoseno_c20_1`, `c22_1`, `linoleico_c18_2`, `linoleni_c18_3`, `c18_4`, `ara_ico_c20_4`, `c20_5`, `c22_5`, `c22_6`, `otrosatur0`, `otroinsat0`, `omega3_0`, `etanol0`, `accion`, `fecha_creado`) 
	(SELECT '".$_SESSION['id_usuario']."', `nombre`, `nombre_ing`, `kcal_100g`, `hidratos`, `proteinas`, `grasa`, `grupo`, `id_supergrupos`, `proteinas_porc`, `hidratos_porc`, `grasa_porc`, `subgrupo`, `pc_porcentaje`, `cal_kcal`, `agua_g`, `hc_g`, `fibra_g`, `prot_g`, `grasa_g`, `col_mg`, `satur_g`, `mono_g`, `poli_g`, `vit_a`, `carotenos`, `vit_b1`, `vit_b2`, `niacina`, `ac_panto`, `vit_b6`, `biotina`, `folico`, `b12`, `vit_c`, `vit_d`, `tocoferol`, `vit_e`, `vit_k`, `oxalico`, `purinas`, `sodio_mg`, `potasio_mg`, `magnesio_mg`, `calcio_mg`, `fosf_mg`, `hierro_mg`, `cloro_mg`, `cinc_mg`, `cobre_mg`, `manganeso_mg`, `cromo_mg`, `cobalto_mg`, `molibde_mg`, `yodo_mg`, `fluor_mg`, `butirico_c4_0`, `caproico_c6_0`, `caprilico_c8_0`, `caprico_c10_0`, `laurico_c12_0`, `miristico_c14_0`, `c15_0`, `c15_00`, `palmitico_c16_0`, `c17_0`, `c17_00`, `estearico_c18_0`, `araquidi_c20_0`, `behenico_c22_0`, `miristol_c14_1`, `palmitole_c16_1`, `oleico_c18_1`, `eicoseno_c20_1`, `c22_1`, `linoleico_c18_2`, `linoleni_c18_3`, `c18_4`, `ara_ico_c20_4`, `c20_5`, `c22_5`, `c22_6`, `otrosatur0`, `otroinsat0`, `omega3_0`, `etanol0`, 'Duplicado', '".$fecha."' FROM gx_alimentos WHERE `id_alimento`='".$id_alimento."');";	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
}

function gx_obtener_los_alimentos_que_estan_en_uso  ($id) {	
	//Buscamos las cantidades
	$query = "SELECT count(id_receta) FROM `gx_alimento_receta` INNER JOIN `gx_recetas` ON `gx_alimento_receta`.`id_receta` = `gx_recetas`.`id_receta` WHERE `gx_alimento_receta`.`id_alimento` = '".$id."' AND `gx_alimento_receta`.`id_receta` NOT IN (SELECT id_receta FROM gx_recetas_desactivadas)";	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	$i=0;
	$lista = '';
	while($row = $result->fetch_assoc()) {		
		$lista[$i]['id_receta']		= $row["id_receta"];						
		$i++;
	} 	
	return $lista;
}

function gx_todas_los_alimentos_desactivadas_por_el_usuario () {
	$query = "SELECT * FROM `gx_alimentos_desactivados` 
	WHERE `id_usuario` = '".$_SESSION['id_usuario']."' AND status = 2
	OR `id_usuario` = '".$_SESSION['id_usuario']."' AND status = 3";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	$i = 0;
	$total_id_alimentos_desactivados = '';
	while($row = $result->fetch_assoc()) {
		$total_id_alimentos_desactivados[$i]		= $row['id_alimento'];
		$i++;
	}
	if($i ==0){
		$total_id_alimentos_desactivados[0] = "'-1'";
	}
	
	return $total_id_alimentos_desactivados;
}
function gx_todas_los_alimentos_desactivadas_por_el_usuario_sql () {
	$query = "SELECT * FROM `gx_alimentos_desactivados` 
	WHERE `id_usuario` = '".$_SESSION['id_usuario']."' AND status = 2
	OR `id_usuario` = '".$_SESSION['id_usuario']."' AND status = 3";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	$i = 0;
	$total_id_alimentos_desactivados = '';
	while($row = $result->fetch_assoc()) {		
		$total_id_alimentos_desactivados		= $total_id_alimentos_desactivados.$row['id_alimento'].', ';
		$i++;
	}
	
	if($i >= 1) {
		$total_id_alimentos_desactivados = substr($total_id_alimentos_desactivados, 0, -2);
	}
	
	if($i ==0){
		$total_id_alimentos_desactivados = "'-1'";
	}
	
	return $total_id_alimentos_desactivados;
	
	
}

function gx_todas_las_recetas_desactivadas_por_el_usuario () {
	$query = "SELECT * FROM gx_recetas_desactivadas 
	WHERE `id_usuario` = '".$_SESSION['id_usuario']."' AND status = 2
	OR `id_usuario` = '".$_SESSION['id_usuario']."' AND status = 3";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	$i = 0;
	$total_recetas_desactivadas = '';
	while($row = $result->fetch_assoc()) {
		$total_recetas_desactivadas[$i]		= $row['id_receta'];		
		$i++;
	}
	
	return $total_recetas_desactivadas;
}
function gx_todas_las_recetas_desactivadas_por_el_usuario_sql () {
	$query = "SELECT * FROM gx_recetas_desactivadas 
	WHERE `id_usuario` = '".$_SESSION['id_usuario']."' AND status = 2
	OR `id_usuario` = '".$_SESSION['id_usuario']."' AND status = 3";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	$i = 0;
	$total_recetas_desactivadas = '';
	while($row = $result->fetch_assoc()) {
		$total_recetas_desactivadas		= $total_recetas_desactivadas."'".$row['id_receta']."', ";		
		$i++;
	}
	if($i >= 1) {
		$total_recetas_desactivadas = substr($total_recetas_desactivadas, 0, -2);
	}
	return $total_recetas_desactivadas;
}

function gx_todas_las_reglas_desactivadas_por_el_usuario_sql () {
	$query = "SELECT * FROM gx_reglas_desactivadas 
	WHERE `id_usuario` = '".$_SESSION['id_usuario']."' AND status = 2
	OR `id_usuario` = '".$_SESSION['id_usuario']."' AND status = 3";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	$i = 0;
	$total_reglas_desactivadas = '';
	while($row = $result->fetch_assoc()) {
		$total_reglas_desactivadas		= $total_reglas_desactivadas."'".$row['id_regla']."', ";		
		$i++;
	}
	if($i >= 1) {
		$total_reglas_desactivadas = substr($total_reglas_desactivadas, 0, -2);
	}
	if($i == 0) { 
		$total_reglas_desactivadas = "'-1'";
	}	
	return $total_reglas_desactivadas;
}

 
function gx_desactivar_recetas ($id_receta) {
	//Fecha
	$fecha = date('d-m-Y');
	$id_receta_existe = '';
	//primero consultamos si se ha desactivado antes
	$query = "SELECT * FROM `gx_recetas_desactivadas` WHERE id_receta = '".$id_receta."' AND id_usuario = '".$_SESSION['id_usuario']."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));		
	while($row = $result->fetch_assoc()) {
		$id_receta_existe = $row['id_receta'];		
	}
	
	if($id_receta_existe == ''){
		$query = "INSERT into gx_recetas_desactivadas (id_receta, id_usuario, fecha_desactivado) values
		('".$id_receta."', '".$_SESSION['id_usuario']."', '".$fecha."')";
		$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
		
	}else{
		$query = "UPDATE gx_recetas_desactivadas 
		SET fecha_desactivado='".$fecha."',
		status='2'
		WHERE id_receta = '".$id_receta."' AND id_usuario = '".$_SESSION['id_usuario']."'";
		$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	}
	return $query;
}

function gx_duplicar_recetas ($id_receta){	
	$fecha = date('d-m-Y');	
	
	$query = "INSERT into gx_recetas (`id_usuario`, `nombre`, `descripcion`, `kcal_por_100g`, `hidratos`, `proteinas`, `grasas`, `peso_maximo`, `peso_minimo`, `origen`, `fecha_creado`, `ingestas`)		
	(SELECT '".$_SESSION['id_usuario']."', `nombre`, `descripcion`, `kcal_por_100g`, `hidratos`, `proteinas`, `grasas`, `peso_maximo`, `peso_minimo`, 'Duplicado', '".$fecha."', `ingestas` FROM gx_recetas WHERE `id_receta` ='".$id_receta."')";	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
	$id_receta_nuevo =  mysqli_insert_id($_SESSION["conexion"]); 	
	
	//consultamos las ingestas de la receta
	$query = "SELECT * FROM `gx_recetas` WHERE id_receta = '".$id_receta."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));		
	while($row = $result->fetch_assoc()) {
		$ingestas = $row['ingestas'];		
	}
	
		
	//luego lo insertamos en los tipos de ingestas
	$id_tipoComida_1 = '';
	$id_tipoComida_2 = '';
	$id_tipoComida_3 = '';
	$id_tipoComida_4 = '';
	$id_tipoComida_5 = '';
	$id_tipoComida_6 = '';
	$id_tipoComida_7 = '';
	$id_tipoComida_8 = '';
	$id_tipoComida_9 = '';
	$id_tipoComida_10 = '';
	
	
	$id_tipoComida_1 = strpos($ingestas, 'ingesta_7');
	if (is_numeric($id_tipoComida_1)) { 	
		$nombre_tipoComida = 'Desayuno'; 
		$query = "INSERT into gx_receta_tipocomida (id_receta, id_tipoComida, nombre_tipoComida) values
		('".$id_receta_nuevo."', '7', '".$nombre_tipoComida."')";
		$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
		$nombre_tipoComida = '';		
	}
	
	$id_tipoComida_2 = strpos($ingestas, 'ingesta_8');
	if (is_numeric($id_tipoComida_2)) { 
		$nombre_tipoComida = 'Media mañana'; 
		$query = "INSERT into gx_receta_tipocomida (id_receta, id_tipoComida, nombre_tipoComida) values
		('".$id_receta_nuevo."', '8', '".$nombre_tipoComida."')";
		$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
		$nombre_tipoComida = '';
	}
	
	$id_tipoComida_3 = strpos($ingestas, 'ingesta_9');
	if (is_numeric($id_tipoComida_3)) {
		$nombre_tipoComida = '1ª plato Comida'; 
		$query = "INSERT into gx_receta_tipocomida (id_receta, id_tipoComida, nombre_tipoComida) values
		('".$id_receta_nuevo."', '9', '".$nombre_tipoComida."')";
		$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
		$nombre_tipoComida = '';
	}
	
	$id_tipoComida_4 = strpos($ingestas, 'ingesta_10');
	if (is_numeric($id_tipoComida_4)) { 	
		$nombre_tipoComida = 'Merienda'; 
		$query = "INSERT into gx_receta_tipocomida (id_receta, id_tipoComida, nombre_tipoComida) values
		('".$id_receta_nuevo."', '10', '".$nombre_tipoComida."')";
		$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
		$nombre_tipoComida = '';
	}
	
	$id_tipoComida_5 = strpos($ingestas, 'ingesta_11');
	if (is_numeric($id_tipoComida_5)) {	
		$nombre_tipoComida = '1ª plato Cena'; 
		$query = "INSERT into gx_receta_tipocomida (id_receta, id_tipoComida, nombre_tipoComida) values
		('".$id_receta_nuevo."', '11', '".$nombre_tipoComida."')";
		$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
		$nombre_tipoComida = '';
	}
	
	$id_tipoComida_6 = strpos($ingestas, 'ingesta_12');
	if (is_numeric($id_tipoComida_6)) {
		$nombre_tipoComida = 'Recena'; 
		$query = "INSERT into gx_receta_tipocomida (id_receta, id_tipoComida, nombre_tipoComida) values
		('".$id_receta_nuevo."', '12', '".$nombre_tipoComida."')";
		$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
		$nombre_tipoComida = '';
	}
	
	$id_tipoComida_7 = strpos($ingestas, 'ingesta_18');
	if (is_numeric($id_tipoComida_7)) {
		$nombre_tipoComida = 'Otros'; 
		$query = "INSERT into gx_receta_tipocomida (id_receta, id_tipoComida, nombre_tipoComida) values
		('".$id_receta_nuevo."', '18', '".$nombre_tipoComida."')";
		$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
		$nombre_tipoComida = '';
	}
	
	$id_tipoComida_8 = strpos($ingestas, 'ingesta_19');
	if (is_numeric($id_tipoComida_8)) {
		$nombre_tipoComida = 'Plato principal comida'; 
		$query = "INSERT into gx_receta_tipocomida (id_receta, id_tipoComida, nombre_tipoComida) values
		('".$id_receta_nuevo."', '19', '".$nombre_tipoComida."')";
		$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
		$nombre_tipoComida = '';
	}

	$id_tipoComida_9 = strpos($ingestas,  'ingesta_20');
	if (is_numeric($id_tipoComida_9)) {
		$nombre_tipoComida = 'Plato principal cena'; 
		$query = "INSERT into gx_receta_tipocomida (id_receta, id_tipoComida, nombre_tipoComida) values
		('".$id_receta_nuevo."', '20', '".$nombre_tipoComida."')";
		$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
		$nombre_tipoComida = '';
	}
	
	$id_tipoComida_10 = strpos($ingestas, 'ingesta_21');
	if (is_numeric($id_tipoComida_10)) {
		$nombre_tipoComida = 'Postre'; 
		$query = "INSERT into gx_receta_tipocomida (id_receta, id_tipoComida, nombre_tipoComida) values
		('".$id_receta_nuevo."', '21', '".$nombre_tipoComida."')";
		$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
		$nombre_tipoComida = '';
	}
	
	//Consultamos los alimentos que tiene esa receta y los insertamos en la nueva
	//consultamos las ingestas de la receta
	$query = "SELECT * FROM `gx_alimento_receta` WHERE id_receta = '".$id_receta."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));		
	$i =0;
	while($row = $result->fetch_assoc()) {
		$alimentos[$i]['id_alimento']	 = $row['id_alimento'];		
		$alimentos[$i]['cantidad'] 		 = $row['cantidad'];
		$alimentos[$i]['kcal_100g'] 	 = $row['kcal_100g'];		
		$alimentos[$i]['alimento']		 = $row['alimento'];
		$alimentos[$i]['hidratos'] 		 = $row['hidratos'];		
		$alimentos[$i]['proteinas']		 = $row['proteinas'];
		$alimentos[$i]['grasa']  		 = $row['grasa'];
		$alimentos[$i]['grupo'] 		 = $row['grupo'];
		$i++;
	}
	
	//Insertamos cada uno de los ingredientes
	if($i >= 1){
		for ($f = 0; $f <= $i; $f++) {
			if(!empty($alimentos[$f]['id_alimento'])){
			$query = "INSERT into gx_alimento_receta (id_alimento, id_receta, cantidad, kcal_100g, alimento, hidratos, proteinas, grasa, grupo) values
			('".$alimentos[$f]['id_alimento']."', '".$id_receta_nuevo."', '".$alimentos[$f]['cantidad']."', '".$alimentos[$f]['kcal_100g']."', '".$alimentos[$f]['alimento']."', '".$alimentos[$f]['hidratos']."', '".$alimentos[$f]['proteinas']."', '".$alimentos[$f]['grasa']."', '".$alimentos[$f]['grupo']."')";
			$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
			
			}
		}
	}
	
}
function gx_desactivar_clientes($id_cliente)
{
	$query = "UPDATE `gx_clientes` 
	SET `status` = '2'
	WHERE id_cliente = '".$id_cliente."' AND id_usuario = '".$_SESSION["id_usuario"]."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
}
function gx_reactivar_clientes($id_cliente)
{
	$query = "UPDATE `gx_clientes` 
	SET `status` = '1'
	WHERE id_cliente = '".$id_cliente."' AND id_usuario = '".$_SESSION["id_usuario"]."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
}
function gx_eliminar_clientes($id_cliente)
{
	$query = "UPDATE `gx_clientes` 
	SET `status` = '3'
	WHERE id_cliente = '".$id_cliente."' AND id_usuario = '".$_SESSION["id_usuario"]."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
}

function gx_consultar_supergrupos() {
	
	$query = "SELECT * FROM `gx_reglas` GROUP BY supergrupo ";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	$mostrar = '';
	while($row = $result->fetch_assoc()) {			
		$mostrar .= '<option value="'.utf8_encode($row['supergrupo']).'">'.utf8_encode($row['supergrupo']).'</option>';		
	}	
	
	return $mostrar;
}

function gx_consultar_supergrupos_crear() {
	
	$reglas_activas = gx_obtener_regla_activas_por_id();
	
	$query = "SELECT * FROM `gx_reglas` GROUP BY supergrupo ";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	$mostrar = '';
	while($row = $result->fetch_assoc()) {		
		$keys = array_keys(array_column($reglas_activas, 'supergrupo'), $row['supergrupo']);
		if(empty($keys)){			
			$mostrar .= '<option value="'.$row['supergrupo'].'">'.$row['supergrupo'].'</option>';	
		}			
	}	
	
	
	
	return $mostrar;
}

function gx_consultar_supergrupos_array() {
	
	$query = "SELECT * FROM gx_supergrupos";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	$mostrar = '';
	while($row = $result->fetch_assoc()) {			
		$array[$row["supergrupo"]] = $row["id_supergrupo"];	
	}	
	
	return $mostrar;
}
function gx_obtener_supergrupos() {
	
	$query = "SELECT * FROM `gx_supergrupos`";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	$mostrar = '';
	while($row = $result->fetch_assoc()) {			
		$mostrar['id_supergrupo']	= $row['id_supergrupo'];
		$mostrar['supergrupo']		= $row['supergrupo'];
	}	
	
	return $mostrar;
}

function gx_crear_nueva_regla($min_unidades, $max_unidades, $supergrupo, $frecuencia){
	$fecha = date('d-m-Y');	
	$query = "INSERT into gx_reglas (id_usuario, min_unidades, max_unidades, supergrupo, frecuencia) values
	('".$_SESSION["id_usuario"]."', '".$min_unidades."', '".$max_unidades."', '".$supergrupo."', '".$frecuencia."')";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
}

function gx_desactivar_regla ($id_regla){
	$query = "UPDATE `gx_reglas_desactivadas` SET `status` = '2', `fecha` = '".$fecha."' WHERE `gx_reglas_desactivadas`.`id_regla` = '".$id_regla."' AND `gx_reglas_desactivadas`.`id_usuario` = '".$_SESSION["id_usuario"]."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));
	return $query;
}

function gx_obtener_regla_por_id($id_regla){
	$query = "SELECT * FROM `gx_reglas` WHERE id_regla = '".$id_regla."' AND id_usuario = '".$_SESSION["id_usuario"]."' OR id_regla = '".$id_regla."' AND id_usuario = '0'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
	$regla = '';
	while($row = $result->fetch_assoc()) {					
		$regla['id_usuario']		=  $row['id_usuario'];
		$regla['min_unidades']		=  $row['min_unidades'];
		$regla['max_unidades'] 		=  $row['max_unidades'];
		$regla['supergrupo'] 		=  $row['supergrupo'];
		$regla['frecuencia'] 		=  $row['frecuencia'];		
	}	
	
	return $regla;
		
}

function gx_obtener_regla_activas_por_id(){
	$query = "SELECT * FROM `gx_reglas` WHERE 
	id_usuario = 0 AND id_regla NOT IN (".$_SESSION['todas_las_reglas_desactivadas_por_el_usuario_sql'].")
	OR id_usuario = '".$_SESSION["id_usuario"]."' AND id_regla NOT IN (".$_SESSION['todas_las_reglas_desactivadas_por_el_usuario_sql'].")";	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
	$regla = '';
	while($row = $result->fetch_assoc()) {			
		if($i == 3){
		$regla[$i]['id_regla']			=  $row['id_regla'];
		}else{
		$regla[$i]['id_regla']			=  8;	
		}
		$regla[$i]['id_usuario']		=  $row['id_usuario'];
		$regla[$i]['min_unidades']		=  $row['min_unidades'];
		$regla[$i]['max_unidades'] 		=  $row['max_unidades'];
		$regla[$i]['supergrupo'] 		=  $row['supergrupo'];
		$regla[$i]['frecuencia'] 		=  $row['frecuencia'];		
		$i++;
	}	
	
	return $regla;
		
}

function gx_desactivar_reglas ($id_regla){
	$fecha = date('d-m-Y');	
	
	//Primero consultamos si la regla se ha desactivado antes
	$query = "SELECT * FROM `gx_reglas_desactivadas` WHERE id_regla = '".$id_regla."' AND id_usuario = '".$_SESSION["id_usuario"]."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
	$status = '';
	while($row = $result->fetch_assoc()) {			
		$status		=  $row['status'];
	}
	if(!empty($status)){
		$query = "UPDATE `gx_reglas_desactivadas` SET `status` = '2', `fecha` = '".$fecha."' WHERE `gx_reglas_desactivadas`.`id_regla` = '".$id_regla."' AND `gx_reglas_desactivadas`.`id_usuario` = '".$_SESSION["id_usuario"]."'";
		$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));
		return $query;
	}else{
		$query = "INSERT into gx_reglas_desactivadas (id_regla, id_usuario, status, fecha) values
		('".$id_regla."', '".$_SESSION["id_usuario"]."', '2', '".$fecha."')";
		$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	}
}
function gx_reactivar_reglas ($id_regla){
	$fecha = date('d-m-Y');		
	
	$query = "UPDATE `gx_reglas_desactivadas` SET `status` = '1', `fecha` = '".$fecha."' WHERE `gx_reglas_desactivadas`.`id_regla` = '".$id_regla."' AND `gx_reglas_desactivadas`.`id_usuario` = '".$_SESSION["id_usuario"]."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));
	return $query;
	
}
function gx_eliminar_reglas ($id_regla){
	$fecha = date('d-m-Y');		
	
	$query = "UPDATE `gx_reglas_desactivadas` SET `status` = '3', `fecha` = '".$fecha."' WHERE `gx_reglas_desactivadas`.`id_regla` = '".$id_regla."' AND `gx_reglas_desactivadas`.`id_usuario` = '".$_SESSION["id_usuario"]."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));
	return $query;
	
}
function gx_selecct_alimientos() {
	$query = "SELECT * FROM `gx_alimentos` WHERE `id_usuario` = '".$_SESSION['id_usuario']."' OR `id_usuario` =  '0' GROUP BY nombre";	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	$i = 0;
	$opciones = "";
	while($row = $result->fetch_assoc()) {		
		$opciones = $opciones.'<option value="'.utf8_encode($row['nombre']).'">'.utf8_encode($row['nombre']).'</option>';		
		$i++;
	}
	
	return $opciones;
}
function gx_select_recetas_equivalentes($id_receta) {
	$i = 0;
	$w = 0;
	$opciones = "";
	
	//primero buscamos las ingestas de la receta
	$query = "SELECT * FROM `gx_recetas` WHERE `id_receta` = '".$id_receta."'";	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	while($row = $result->fetch_assoc()) {		
		$ingestas = $row['ingestas'];		
	}
	$pos_ingesta_7 = '';
	$pos_ingesta_7 = strpos($ingestas, 'ingesta_7'); 
	if($pos_ingesta_7 != ''){ $where_ingesta_7 = "ingestas LIKE '%ingesta_7%' OR"; $w = 1; } 
	
	$pos_ingesta_8 = '';
	$pos_ingesta_8 = strpos($ingestas, 'ingesta_8');
	if($pos_ingesta_8 != ''){ $where_ingesta_8 = "ingestas LIKE '%ingesta_8%'  OR"; $w = 1; } 
	
	$pos_ingesta_9 = '';
	$pos_ingesta_9 = strpos($ingestas, 'ingesta_9');
	if($pos_ingesta_9 != ''){ $where_ingesta_9 = "ingestas LIKE '%ingesta_9%'  OR"; $w = 1; }  
	
	$pos_ingesta_19 = '';
	$pos_ingesta_19 = strpos($ingestas, 'ingesta_19');
	if($pos_ingesta_19 != ''){ $where_ingesta_19 = "ingestas LIKE '%ingesta_19%' OR"; $w = 1; } 
	
	$pos_ingesta_21 = '';
	$pos_ingesta_21 = strpos($ingestas, 'ingesta_21');
	if($pos_ingesta_21 != ''){ $where_ingesta_21 = "ingestas LIKE '%ingesta_21%'  OR"; $w = 1; } 
	
	$pos_ingesta_10 = '';
	$pos_ingesta_10 = strpos($ingestas, 'ingesta_10');
	if($pos_ingesta_10 != ''){ $where_ingesta_10 = "ingestas LIKE '%ingesta_10%' OR"; $w = 1; } 
	
	$pos_ingesta_11 = '';
	$pos_ingesta_11 = strpos($ingestas, 'ingesta_11');
	if($pos_ingesta_11 != ''){ $where_ingesta_11 = "ingestas LIKE '%ingesta_11%'  OR"; $w = 1; } 
	
	$pos_ingesta_20 = '';
	$pos_ingesta_20 = strpos($ingestas, 'ingesta_20');
	if($pos_ingesta_20 != ''){ $where_ingesta_20 = "ingestas LIKE '%ingesta_20%'  OR"; $w = 1; }  
	
	$pos_ingesta_12 = '';
	$pos_ingesta_12 = strpos($ingestas, 'ingesta_12');
	if($pos_ingesta_12 != ''){ $where_ingesta_12 = "ingestas LIKE '%ingesta_12%'  OR"; $w = 1; }  
	
	$pos_ingesta_18 = '';
	$pos_ingesta_18 = strpos($ingestas, 'ingesta_18');
	if($pos_ingesta_18 != ''){ $where_ingesta_7 = "ingestas LIKE '%ingesta_18%' OR"; $w = 1; } 
	$WHERE = '';

	if($w != 0) { $WHERE = "WHERE ".$where_ingesta_7." ".$where_ingesta_8." ".$where_ingesta_9." ".$where_ingesta_10." ".$where_ingesta_11." ".$where_ingesta_20." ".$where_ingesta_12." ".$where_ingesta_18; }
	
	//buscamos las ingestas en la receta
	$query_opciones = "SELECT * FROM `gx_recetas` ".$WHERE;	
	$result_opciones = mysqli_query($_SESSION["conexion"], $query_opciones) or die(mysqli_error($_SESSION["conexion"]));	
	while($row_opciones = $result_opciones->fetch_assoc()) {				
		$opciones = $opciones.'<option value="'.$row_opciones['id_receta'].'">'.utf8_encode($row_opciones['nombre']).'</option>';	
	}
	
	//si las ingestas estan vacias no trae nada
	if(empty($ingestas)) $opciones = '<option value="Sin Recomendaciones">Sin Recomendaciones</option>';		
	
	return $opciones;
}

function gx_selecct_clientes() {
	$selected = '';
	
	$query = "SELECT * FROM `gx_clientes` WHERE `id_usuario` = '".$_SESSION['id_usuario']."' AND status =  1 GROUP BY nombre";	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	$i = 0;
	$opciones = "";
	while($row = $result->fetch_assoc()) {	
		if($i == 0) { $selected = 'selected'; }else{ $selected = ''; }
		$opciones = $opciones.'<option value="'.$row['id_cliente'].'" '.$selected.'>'.$row['nombre'].', '.$row['apellidos'].'</option>';		
		$i++;
	}
	
	//sin clientes
	if(empty($opciones)) { $opciones = '<option value=""></option>'; }
	
	return $opciones;
}

function gx_reactivar_recetas($id_receta)
{
	$query = "UPDATE `gx_recetas_desactivadas` 
	SET `status` = '1'
	WHERE id_receta = '".$id_receta."' AND id_usuario = '".$_SESSION["id_usuario"]."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
}
function gx_eliminar_recetas($id_receta)
{
	$query = "UPDATE `gx_recetas_desactivadas` 
	SET `status` = '3'
	WHERE id_receta = '".$id_receta."' AND id_usuario = '".$_SESSION["id_usuario"]."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
}
function gx_actualizar_recetas($id_receta, $nombre, $descripcion, $kcal_por_100g, $hidratos_porc, $proteinas_porc, $grasas_porc, $peso_maximo, $peso_minimo, $lista_ingestas)
{
	$query = "UPDATE `gx_recetas` 
	SET `nombre` = '".$nombre."',
	`descripcion` = '".$descripcion."',
	`kcal_por_100g` = '".$kcal_por_100g."',
	`hidratos` = '".$hidratos_porc."',
	`proteinas` = '".$proteinas_porc."',
	`grasas` = '".$grasas_porc."',
	`peso_maximo` = '".$peso_maximo."',
	`peso_minimo` = '".$peso_minimo."',
	`ingestas` = '".$lista_ingestas."'
	WHERE id_receta = '".$id_receta."' AND id_usuario = '".$_SESSION["id_usuario"]."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
}

function gx_eliminar_ingestas_por_receta ($id_receta) {
	$sql = "DELETE FROM gx_receta_tipocomida WHERE id_receta='".$id_receta."'";
	if ($_SESSION["conexion"]->query($sql) === TRUE) {} else { $_SESSION["conexion"]->error; }	
		
}
function gx_eliminar_alimentos_por_receta ($id_receta) {
	$sql = "DELETE FROM gx_receta_tipocomida WHERE id_receta='".$id_receta."'";
	if ($_SESSION["conexion"]->query($sql) === TRUE) {} else { $_SESSION["conexion"]->error; }	
		
}

function gx_guardar_dieta ($id_cliente, $dieta_plantilla){
	$fecha = date('d-m-Y');	
	
	//Primero consultamos si la regla se ha desactivado antes
	$query = "SELECT * FROM `gx_dietas` WHERE id_cliente = '".$id_cliente."' AND id_usuario = '".$_SESSION["id_usuario"]."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
	$fecha_insert = '';
	while($row = $result->fetch_assoc()) {			
		$fecha_insert		=  $row['fecha'];
	}
	if(!empty($fecha_insert)){
		// $query = "UPDATE `gx_reglas_desactivadas` SET `status` = '2', `fecha` = '".$fecha."' WHERE `gx_reglas_desactivadas`.`id_regla` = '".$id_regla."' AND `gx_reglas_desactivadas`.`id_usuario` = '".$_SESSION["id_usuario"]."'";
		// $result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));
		// return $query;
	}else{
		$query = "INSERT into gx_dietas (id_usuario, id_cliente, dieta_plantilla, fecha) values
		('".$_SESSION["id_usuario"]."', '".$id_cliente."', '".$dieta_plantilla."', '".$fecha."')";
		$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	}
}
function gx_calculo_kcal_dieta($tipo, $kcalorias, $num_comidas, $platos_comida, $plato_cena, $comida_postre, $cena_postre, $valor)	
{
	
	$html = array();
	$kcalorias_desayuno = 0;
	$kcalorias_mediamanana = 0;
	$kcalorias_primer_plato_comida = 0;
	$kcalorias_plato_principal_comida = 0;
	$kcalorias_comida_postre = 0;
	$kcalorias_merienda = 0;
	$kcalorias_primer_plato_cena = 0;
	$kcalorias_plato_principal_cena = 0;
	$kcalorias_cena_postre = 0;
	$kcalorias_recena = 0;
	
	if ($num_comidas == 3)
	{
		$kcalorias_desayuno = 0.25 * $kcalorias;
		$kcalorias_plato_principal_comida = 0.4 * $kcalorias;
		$kcalorias_plato_principal_cena = 0.35 * $kcalorias;
		// $kcalorias_desayuno = 1;
	}
	else if ($num_comidas == 4)
	{
		$kcalorias_desayuno = 0.25 * $kcalorias;
		$kcalorias_plato_principal_comida = 0.35 * $kcalorias;
		$kcalorias_merienda = 0.1 * $kcalorias;
		$kcalorias_plato_principal_cena = 0.3 * $kcalorias;
		// $kcalorias_desayuno = 2;
	}
	else if ($num_comidas == 5)
	{
		$kcalorias_desayuno = 0.2 * $kcalorias;
		$kcalorias_mediamanana = 0.1 * $kcalorias;
		$kcalorias_plato_principal_comida = 0.3 * $kcalorias;
		$kcalorias_merienda = 0.1 * $kcalorias;
		$kcalorias_plato_principal_cena = 0.3 * $kcalorias;
		// $kcalorias_desayuno = 3;
	}
	else if ($num_comidas == 6)
	{
		$kcalorias_desayuno = 0.2 * $kcalorias;
		$kcalorias_mediamanana = 0.1 * $kcalorias;
		$kcalorias_plato_principal_comida = 0.3 * $kcalorias;
		$kcalorias_merienda = 0.1 * $kcalorias;
		$kcalorias_plato_principal_cena = 0.25 * $kcalorias;
		$kcalorias_recena = 0.05 * $kcalorias;
		// $kcalorias_desayuno = 4;
	}
	
	//Recalculamos en caso de postres
	if ($comida_postre == 'si')
	{
		$kcalorias_comida_postre = 0.2 * $kcalorias_plato_principal_comida;
		$kcalorias_plato_principal_comida = 0.8 * $kcalorias_plato_principal_comida;
	}
	if ($cena_postre == 'si')
	{
		$kcalorias_cena_postre = 0.2 * $kcalorias_plato_principal_cena;
		$kcalorias_plato_principal_cena = 0.8 * $kcalorias_plato_principal_cena;
	}
	
	//Recalculamos para comidas con dos platos
	if ($platos_comida == 2)
	{
		$kcalorias_primer_plato_comida = 0.3 * $kcalorias_plato_principal_comida;
		$kcalorias_plato_principal_comida = 0.7 * $kcalorias_plato_principal_comida;
	}
	if ($plato_cena == 2)
	{
		$kcalorias_primer_plato_cena = 0.3 * $kcalorias_plato_principal_cena;
		$kcalorias_plato_principal_cena = 0.7 * $kcalorias_plato_principal_cena;
	}
	
		
	switch ($tipo) {
		case 'desayuno':
			$html['kcal'] = $kcalorias_desayuno;
			$html['gramos'] = round(($kcalorias_desayuno/$valor)*100);
			$html['g'] = ' g';			
			break;	
		case 'media_manana':
			$html['kcal'] = $kcalorias_mediamanana;
			$html['gramos'] =  round(($kcalorias_mediamanana/$valor)*100);	
			$html['g'] = ' g';
			break;	
		case 'primer_plato_comida':
			$html['kcal'] = $kcalorias_primer_plato_comida;
			$html['gramos'] =  round(($kcalorias_primer_plato_comida/$valor)*100);		
			$html['g'] = ' g';
			break;	
		case 'plato_principal_comida':
			$html['kcal'] = $kcalorias_plato_principal_comida;
			$html['gramos'] = round(($kcalorias_plato_principal_comida/$valor)*100);		
			$html['g'] = ' g';
			break;	
		case 'postre_comida':
			$html['kcal'] = $kcalorias_comida_postre;
			$html['gramos'] = round(($kcalorias_comida_postre/$valor)*100);
			$html['g'] = ' g';
			break;	
		case 'merienda':
			$html['kcal'] = $kcalorias_merienda;
			$html['gramos'] = round(($kcalorias_merienda/$valor)*100);
			$html['g'] = ' g';
			break;	
		case 'primer_plato_cena':
			$html['kcal'] = $kcalorias_primer_plato_cena;
			$html['gramos'] = round(($kcalorias_primer_plato_cena/$valor)*100);
			$html['g'] = ' g';
			break;	
		case 'plato_principal_cena':
			$html['kcal'] = $kcalorias_plato_principal_cena;
			$html['gramos'] = round(($kcalorias_plato_principal_cena/$valor)*100);
			$html['g'] = ' g';
			break;
		case 'postre_cena':
			$html['kcal'] = $kcalorias_cena_postre;
			$html['gramos'] = round(($kcalorias_cena_postre/$valor)*100);
			$html['g'] = ' g';
			break;	
		case 'recena':
			$html['kcal'] = $kcalorias_recena;
			$html['gramos'] = round(($kcalorias_recena/$valor)*100);
			$html['g'] = ' g';
			break;		
	}

	return $html;
	
}

function gx_desactivar_plantillas($id)
{
	$query = "UPDATE `gx_dietas_plantillas` 
	SET `status` = '2'
	WHERE id = '".$id."' AND id_usuario = '".$_SESSION["id_usuario"]."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
}
function gx_reactivar_plantillas($id)
{
	$query = "UPDATE `gx_dietas_plantillas` 
	SET `status` = '1'
	WHERE id = '".$id."' AND id_usuario = '".$_SESSION["id_usuario"]."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
}
function gx_eliminar_plantillas($id)
{
	$query = "UPDATE `gx_dietas_plantillas` 
	SET `status` = '3'
	WHERE id = '".$id."' AND id_usuario = '".$_SESSION["id_usuario"]."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
}

function gx_obtener_plantilla ($id){
	
	
	//Primero consultamos si la regla se ha desactivado antes
	$query = "SELECT * FROM `gx_dietas_plantillas` WHERE id = '".$id."' AND id_usuario = '".$_SESSION["id_usuario"]."' AND status = 1";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
	$plantilla = '';
	while($row = $result->fetch_assoc()) {			
		$plantilla['fecha']				=  $row['fecha'];
		$plantilla['dieta_plantilla']	=  $row['dieta_plantilla'];
		$plantilla['nombre']			=  $row['nombre'];
	}
	
	return $plantilla;
}

function gx_obtener_dieta($id){	
	
	//Primero consultamos si la regla se ha desactivado antes
	$query = "SELECT * FROM `gx_dietas` WHERE id = '".$id."' AND id_usuario = '".$_SESSION["id_usuario"]."' AND status = 1";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
	$plantilla = '';
	while($row = $result->fetch_assoc()) {			
		$plantilla['fecha']				=  $row['fecha'];
		$plantilla['dieta_plantilla']	=  $row['dieta_plantilla'];
	}
	
	return $plantilla;
}
function gx_listado_de_plantillas() {	
	//Consulta vieja
	//$query = "SELECT * FROM `grupos_alimentos`";
	$query = "SELECT * FROM `gx_dietas_plantillas` WHERE id_usuario = '".$_SESSION["id_usuario"]."' AND status = 1 ORDER BY nombre";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	$mostrar = '';
	while($row = $result->fetch_assoc()) {			
		$mostrar .= '<option value="'.$row['id'].'" >'.$row['nombre'].'</option>';				
	}
	if(empty($mostrar)) {
		$mostrar .= '<option>sin plantilla</option>';				
	}
	return $mostrar;
}

function gx_recuperar_recetas() {	
	
	$query = "SELECT gx_recetas.id_receta as id_receta_final 
	FROM `gx_recetas` 
	INNER JOIN gx_recetas_desactivadas ON gx_recetas.id_receta = gx_recetas_desactivadas.id_receta
	WHERE gx_recetas.id_usuario = '0' AND gx_recetas_desactivadas.id_usuario = '".$_SESSION["id_usuario"]."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	$mostrar = '';
	while($row = $result->fetch_assoc()) {	
		if(!empty($row['id_receta_final'])){		
		
		$query2 = "UPDATE `gx_recetas_desactivadas` 
		SET `status` = '1'
		WHERE id_receta ='".$row['id_receta_final']."' AND id_usuario = '".$_SESSION["id_usuario"]."'";
		$result2 = mysqli_query($_SESSION["conexion"], $query2) or die(mysqli_error($_SESSION["conexion"]));	
		
		}
	}
	
}
function gx_recuperar_alimentos() {		
	$query = "SELECT gx_alimentos.id_alimento as id_alimento_final 
	FROM `gx_alimentos` 
	INNER JOIN gx_alimentos_desactivados ON gx_alimentos.id_alimento = gx_alimentos_desactivados.id_alimento
	WHERE gx_alimentos.id_usuario = '0' AND gx_alimentos_desactivados.id_usuario = '".$_SESSION["id_usuario"]."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	

	$mostrar = '';
	while($row = $result->fetch_assoc()) {	
		if(!empty($row['id_alimento_final'])){				
		$query2 = "UPDATE `gx_alimentos_desactivados` 
		SET `status` = '1'
		WHERE id_alimento ='".$row['id_alimento_final']."' AND id_usuario = '".$_SESSION["id_usuario"]."'";
		$result2 = mysqli_query($_SESSION["conexion"], $query2) or die(mysqli_error($_SESSION["conexion"]));	
		
		}
	}	
}

function gx_eliminar_recetas_propias() {	
			
	//Fecha
	$fecha = date('d-m-Y');
	$id_receta_existe = '';
	//primero consultamos si se ha desactivado antes
	$query = "SELECT * FROM `gx_recetas` 	
	WHERE gx_recetas.id_usuario = '".$_SESSION['id_usuario']."'";
	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));		
	while($row = $result->fetch_assoc()) {			
			$query4 = "SELECT * FROM `gx_recetas_desactivadas` 	
			WHERE gx_recetas_desactivadas.id_receta = '".$row['id_receta']."'";
			
			$result4 = mysqli_query($_SESSION["conexion"], $query4) or die(mysqli_error($_SESSION["conexion"]));	
			$result4->num_rows;
			if($result4->num_rows == 1){			
				$query2 = "UPDATE gx_recetas_desactivadas 
				SET fecha_desactivado='".$fecha."',
				status='3'
				WHERE id_receta = '".$row['id_receta']."' AND id_usuario = '".$_SESSION['id_usuario']."'";
				$result2 = mysqli_query($_SESSION["conexion"], $query2) or die(mysqli_error($_SESSION["conexion"]));
			}else{				
				$query3 = "INSERT into gx_recetas_desactivadas (id_receta, id_usuario, fecha_desactivado, status) values
				('".$row['id_receta']."', '".$_SESSION['id_usuario']."', '".$fecha."', '3')";
				$result3 = mysqli_query($_SESSION["conexion"], $query3) or die(mysqli_error($_SESSION["conexion"]));
			}
		
	}
	
	
	
}

function gx_eliminar_alimentos_propias() {	
			
	//Fecha
	$fecha = date('d-m-Y');
	$id_receta_existe = '';
	//primero consultamos si se ha desactivado antes
	$query = "SELECT * FROM `gx_alimentos` 	
	WHERE gx_alimentos.id_usuario = '".$_SESSION['id_usuario']."'";
	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));		
	while($row = $result->fetch_assoc()) {			
			$query4 = "SELECT * FROM `gx_alimentos_desactivados` 	
			WHERE gx_alimentos_desactivados.id_alimento = '".$row['id_alimento']."'";
			
			$result4 = mysqli_query($_SESSION["conexion"], $query4) or die(mysqli_error($_SESSION["conexion"]));	
			$result4->num_rows;
			if($result4->num_rows == 1){			
				$query2 = "UPDATE gx_alimentos_desactivados 
				SET fecha='".$fecha."',
				status='3'
				WHERE id_alimento = '".$row['id_alimento']."' AND id_usuario = '".$_SESSION['id_usuario']."'";
				$result2 = mysqli_query($_SESSION["conexion"], $query2) or die(mysqli_error($_SESSION["conexion"]));
			}else{				
				$query3 = "INSERT into gx_alimentos_desactivados (id_alimento, id_usuario, fecha, status) values
				('".$row['id_alimento']."', '".$_SESSION['id_usuario']."', '".$fecha."', '3')";
				$result3 = mysqli_query($_SESSION["conexion"], $query3) or die(mysqli_error($_SESSION["conexion"]));
			}
		
	}
	
	
	
}


function gx_input_supergrupos($id_alimento) {	
			
	$query = "SELECT * FROM `gx_supergrupos` WHERE status = 1";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	$tota_registros = $result->num_rows;	
	$html = '';
	$encontrar =  '';
	$checkbox = '';	
	$disable = '';
	$show_disable = '';
	
	if(!empty($id_alimento)){
		$query_alimento = "SELECT * FROM `gx_alimentos` WHERE id_alimento = '".$id_alimento."'";
		$result_alimento = mysqli_query($_SESSION["conexion"], $query_alimento) or die(mysqli_error($_SESSION["conexion"]));	
		while($row_alimento  = $result_alimento->fetch_assoc()) {
			$id_supergrupos		= $row_alimento['id_supergrupos'];
			$disable		 	= $row_alimento['id_usuario'];
		}
	}
	if($disable == '') { $disable = $_SESSION['id_usuario']; } 
	
	//Si es	existen registros
	if($tota_registros >=1){
		$columna = ceil($tota_registros /2)+1;
		$i=1;
		$html .= '<div class="col-md-6">';
		while($row = $result->fetch_assoc()) {
			$encontrar = ','.$row['id_supergrupo'].',';
			$existe = strpos($id_supergrupos, $encontrar);	
			if ($existe !== false) { $checkbox = 'checked';	}else{ $checkbox = '';	 }		
			if ($disable == 0) { $show_disable = 'disabled'; }else{ $show_disable = '';	 }	
			// $html .= '<p>'.$id_supergrupos.'</p>';	
			$html .= '<div class="checkbox checkbox-success">';
				$html .= '<input id="grupo_'.$row['slug_name'].'" name="grupo_'.$row['slug_name'].'" class="grupos_alimentos" type="checkbox" value="'.$row['id_supergrupo'].'" '.$checkbox.' '.$show_disable.'>';
				$html .= '<label for="grupo_'.$row['slug_name'].'">'.$row['supergrupo'].'</label>';
			$html .= '</div>';								
			$i++;
			if($columna == $i){
				$html .= '</div>';	
				$html .= '<div class="col-md-6">';
					
			}
		}   
		$html .= '</div>';		
	}
	
	return $html;
	
	
}


function gx_table_supergrupos() {	
			
	$query = "SELECT * FROM `gx_supergrupos` WHERE status != 3";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	$tota_registros = $result->num_rows;	
	$html = '';
	

	if($tota_registros >=1){
		while($row = $result->fetch_assoc()) {
			$html .= '<tr>';
			$html .= '<td><div class="checkbox checkbox-success">';
				$html .= '<input id="'.$row['id_supergrupo'].'" type="checkbox" name="'.$row['id_supergrupo'].'" class="marcar">';
					$html .= '<label for="'.$row['id_supergrupo'].'"></label></div>';
			$html .= '</td>';
			$html .= '<td>'.salida_nombre($row['supergrupo']).'</td>';
			$html .= '<td>'.$row['slug_name'].'</td>';
			if($row['status'] == 1) { $status = 'Activo';} else if ($row['status'] == 2) { $status = 'Desactivado'; }
			$html .= '<td>'.$status.'</td>';
			$html .= '</tr>';
		}   		
	}
	
	return $html;
	
	
}

function gx_desactivar_supergrupos ($id_supergrupo){
	$query = "UPDATE `gx_supergrupos` SET `status` = '2' WHERE `id_supergrupo` = '".$id_supergrupo."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));
	
}

function gx_activar_supergrupos ($id_supergrupo){
	$query = "UPDATE `gx_supergrupos` SET `status` = '1' WHERE `id_supergrupo` = '".$id_supergrupo."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));
	
}

function gx_consultar_ultima_dieta_guardada($id_cliente) {	
	$query = "SELECT * FROM `gx_dietas` WHERE id_cliente != '".$id_cliente."' AND id_usuario = '".$_SESSION["id_usuario"]."' ORDER BY id ASC";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	$tota_registros = $result->num_rows;	
	$dieta = '';
	
	if($tota_registros >=1){
		while($row = $result->fetch_assoc()) {
			$dieta['duracion']		 	= $row['duracion'];
			$dieta['ids_recetas']   	= $row['ids_recetas'];
			$dieta['dieta_plantilla']   = $row['dieta_plantilla'];
			$dieta['dieta_vertical']   	= $row['dieta_vertical'];
			$dieta['tabla_semana_1']   	= $row['tabla_semana_1'];
			$dieta['lista_definitiva_alimentos']   	= $row['lista_definitiva_alimentos'];
		}   		
	}	
	return $dieta;

}

function gx_buscar_ingrediente_en_receta ($id_receta, $id_alimento) {	
	$query = "SELECT * FROM `gx_alimento_receta` WHERE id_receta = '".$id_receta."' AND id_alimento = '".$id_alimento."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	$tota_registros = $result->num_rows;		
	return $tota_registros;	
}

function gx_update_ingredientes_en_receta  ($id_alimento, $id_receta, $cantidad, $kcal_100g, $alimento, $hidratos, $proteinas, $grasa) {	
	$query = "UPDATE `gx_alimento_receta` SET 
	`cantidad` = '".$cantidad."', 
	`kcal_100g` = '".$kcal_100g."', 
	`alimento` = '".$alimento."', 
	`hidratos` = '".$hidratos."', 
	`proteinas` = '".$proteinas."', 
	`grasa` = '".$grasa."'
	WHERE `id_receta` = '".$id_receta."' AND  `id_alimento` = '".$id_alimento."' ";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));
}


function gx_table_dietas_generadas($id_cliente) {	
			
	$query = "SELECT * FROM `gx_dietas` WHERE id_cliente = '".$id_cliente."' AND id_usuario = '".$_SESSION["id_usuario"]."' AND status = 1";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	$tota_registros = $result->num_rows;	
	$html = '';
	

	if($tota_registros >=1){
		while($row = $result->fetch_assoc()) {
			$html .= '<tr>';
				$html .= '<td><div class="checkbox checkbox-success">';
				$html .= '<input id="'.$row['id'].'" type="checkbox" name="'.$row['id'].'" class="marcar">';				
						$html .= '<label for="'.$row['id'].'"></label></div>';
				$html .= '</td>';
				$html .= '<td>'.$row['fecha'];
				$html .= '<input id="'.$row['id'].'" type="hidden" name="id_dieta" value="'.$row['id'].'"></td>';
				$html .= '<input id="'.$row['id_cliente'].'" type="hidden" name="id_cliente" value="'.$row['id_cliente'].'"></td>';
				$html .= '<td>'.$row['kilocalorias_dia'].'</td>';
				$html .= '<td>'.$row['duracion'].'</td>';
				$html .= '<td>'.$row['num_comidas'].'</td>';
			$html .= '</tr>';
		}   		
	}
	
	return $html;
	
	
}

function gx_eliminar_dieta_cliente ($id_cliente, $id){
	$query = "UPDATE `gx_dietas` SET `status` = '3' WHERE id_cliente = '".$id_cliente."' AND id = '".$id."'  AND id_usuario = '".$_SESSION["id_usuario"]."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));
	
	return $query;
	
}



function gx_receta_completa_vista($id_receta) {	
			
	$query = "SELECT * FROM `receta_completa` WHERE ar_id_receta = '".$id_receta."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	$tota_registros = $result->num_rows;	
	$receta_completa = '';
	
	$cantidad ='';
	if($tota_registros >=1){
		while($row = $result->fetch_assoc()) {
			$cantidad += $row['ar_cantidad'];
		}
		while($row = $result->fetch_assoc()) {
			$receta_completa['ar_id_receta']		 	= $row['ar_id_receta'];
			$receta_completa['ar_id_alimento']		 	= $row['ar_id_alimento'];
			$receta_completa['ar_cantidad']		 	    = $row['ar_cantidad'];
			$receta_completa['ar_kcal_100g']		 	= $row['ar_kcal_100g'];
			$receta_completa['ar_alimento']				= $row['ar_alimento'];
			$receta_completa['ar_hidratos']				= $row['ar_hidratos'];
			$receta_completa['ar_proteinas']		 	= $row['ar_proteinas'];
			$receta_completa['ar_grasa']		 		= $row['ar_grasa'];
			$receta_completa['ar_grupo']		 		= $row['ar_grupo'];
			$receta_completa['rece_id_receta']		 	= $row['rece_id_receta'];
			$receta_completa['rece_id_usuario']		 	= $row['rece_id_usuario'];
			$receta_completa['rece_nombre']		 		= $row['rece_nombre'];
			$receta_completa['rece_descripcion']		= $row['rece_descripcion'];
			$receta_completa['rece_nombre_tipo_comida']	= $row['rece_nombre_tipo_comida'];
			$receta_completa['rece_kcal_por_100g']		= $row['rece_kcal_por_100g'];
			$receta_completa['rece_hidratos']		= $row['rece_hidratos'];
			$receta_completa['rece_proteinas']		= $row['rece_proteinas'];
			$receta_completa['rece_grasas']		 	= $row['rece_grasas'];
			$receta_completa['rece_ingestas']		= $row['rece_ingestas'];
			$receta_completa['rece_peso_maximo']	= $row['rece_peso_maximo'];
			$receta_completa['rece_peso_minimo']	= $row['rece_peso_minimo'];
			$receta_completa['rece_origen']		 	= $row['rece_origen'];
			$receta_completa['rece_fecha_creado']	= $row['rece_fecha_creado'];
			$receta_completa['id_alimento']		 	= $row['id_alimento'];
			$receta_completa['id_alimento_completo']= $row['id_alimento_completo'];
			$receta_completa['duracion']		 	= $row['duracion'];
			$receta_completa['id_usuario']		 	= $row['id_usuario'];
			$receta_completa['nombre']		 		= $row['nombre'];
			$receta_completa['nombre_alias']		= $row['nombre_alias'];
			$receta_completa['nombre_ing']		 	= $row['nombre_ing'];
			$receta_completa['kcal_100g']		 	= $row['kcal_100g'];
			$receta_completa['hidratos']		 	= $row['hidratos'];
			$receta_completa['proteinas']		 	= $row['proteinas'];
			$receta_completa['grasa']		 		= $row['grasa'];
			$receta_completa['id_grupo']			= $row['id_grupo'];
			$receta_completa['grupo']		 		= $row['grupo'];
			$receta_completa['id_supergrupos']		= $row['id_supergrupos'];
			$receta_completa['proteinas_porc']		= $row['proteinas_porc'];
			$receta_completa['hidratos_porc']		= $row['hidratos_porc'];
			$receta_completa['grasa_porc']		 	= $row['grasa_porc'];
			$receta_completa['subgrupo']		 	= $row['subgrupo'];
			$receta_completa['pc_porcentaje	']		= $row['pc_porcentaje'];
			$receta_completa['cal_kcal']		 	= $row['cal_kcal'];
			$receta_completa['agua_g']		 		+= $row['ar_cantidad']/$cantidad*$row['agua_g'];
			$receta_completa['hc_g']		 		+= $row['ar_cantidad']/$cantidad*$row['hc_g'];
			$receta_completa['fibra_g']		 		+= $row['ar_cantidad']/$cantidad*$row['fibra_g'];
			$receta_completa['prot_g']		 		+= $row['ar_cantidad']/$cantidad*$row['prot_g'];
			$receta_completa['grasa_g']		 		+= $row['ar_cantidad']/$cantidad*$row['grasa_g'];
			$receta_completa['col_mg']		 		+= $row['ar_cantidad']/$cantidad*$row['col_mg'];
			$receta_completa['satur_g']		 		+= $row['ar_cantidad']/$cantidad*$row['satur_g'];
			$receta_completa['mono_g']		 		+= $row['ar_cantidad']/$cantidad*$row['mono_g'];
			$receta_completa['poli_g']		 		+= $row['ar_cantidad']/$cantidad*$row['poli_g'];
			$receta_completa['vit_a']				+= $row['ar_cantidad']/$cantidad*$row['vit_a'];
			$receta_completa['carotenos']		 	+= $row['ar_cantidad']/$cantidad*$row['carotenos'];
			$receta_completa['vit_b1']		 		+= $row['ar_cantidad']/$cantidad*$row['vit_b1'];
			$receta_completa['vit_b2']		 		+= $row['ar_cantidad']/$cantidad*$row['vit_b2'];
			$receta_completa['niacina']		 		+= $row['ar_cantidad']/$cantidad*$row['niacina'];
			$receta_completa['ac_panto']		 	+= $row['ar_cantidad']/$cantidad*$row['ac_panto'];
			$receta_completa['vit_b6']		 		+= $row['ar_cantidad']/$cantidad*$row['vit_b6'];
			$receta_completa['biotina']		 		+= $row['ar_cantidad']/$cantidad*$row['biotina'];
			$receta_completa['folico']			 	+= $row['ar_cantidad']/$cantidad*$row['folico'];
			$receta_completa['b12']		 			+= $row['ar_cantidad']/$cantidad*$row['b12'];
			$receta_completa['vit_c']		 		+= $row['ar_cantidad']/$cantidad*$row['vit_c'];
			$receta_completa['vit_d']		 		+= $row['ar_cantidad']/$cantidad*$row['vit_d'];
			$receta_completa['tocoferol']		 	+= $row['ar_cantidad']/$cantidad*$row['tocoferol'];
			$receta_completa['vit_e']		 		+= $row['ar_cantidad']/$cantidad*$row['vit_e'];
			$receta_completa['vit_k']		 		+= $row['ar_cantidad']/$cantidad*$row['vit_k'];
			$receta_completa['oxalico']		 		+= $row['ar_cantidad']/$cantidad*$row['oxalico'];
			$receta_completa['purinas']		 		+= $row['ar_cantidad']/$cantidad*$row['purinas'];
			$receta_completa['sodio_mg']		 	+= $row['ar_cantidad']/$cantidad*$row['sodio_mg'];
			$receta_completa['potasio_mg']		 	+= $row['ar_cantidad']/$cantidad*$row['potasio_mg'];
			$receta_completa['magnesio_mg']		 	+= $row['ar_cantidad']/$cantidad*$row['magnesio_mg'];
			$receta_completa['calcio_mg']		 	+= $row['ar_cantidad']/$cantidad*$row['calcio_mg'];
			$receta_completa['fosf_mg']		 		+= $row['ar_cantidad']/$cantidad*$row['fosf_mg'];
			$receta_completa['hierro_mg']		 	+= $row['ar_cantidad']/$cantidad*$row['hierro_mg'];
			$receta_completa['cloro_mg']		 	+= $row['ar_cantidad']/$cantidad*$row['cloro_mg'];
			$receta_completa['cinc_mg']			 	+= $row['ar_cantidad']/$cantidad*$row['cinc_mg'];
			$receta_completa['cobre_mg']		 	+= $row['ar_cantidad']/$cantidad*$row['cobre_mg'];
			$receta_completa['manganeso_mg']		+= $row['ar_cantidad']/$cantidad*$row['manganeso_mg'];
			$receta_completa['cromo_mg']		 	+= $row['ar_cantidad']/$cantidad*$row['cromo_mg'];
			$receta_completa['cobalto_mg']		 	+= $row['ar_cantidad']/$cantidad*$row['cobalto_mg'];
			$receta_completa['molibde_mg']		 	+= $row['ar_cantidad']/$cantidad*$row['molibde_mg'];
			$receta_completa['yodo_mg']		 		+= $row['ar_cantidad']/$cantidad*$row['yodo_mg'];
			$receta_completa['fluor_mg']		 	+= $row['ar_cantidad']/$cantidad*$row['fluor_mg'];
			$receta_completa['butirico_c4_0']		+= $row['ar_cantidad']/$cantidad*$row['butirico_c4_0'];
			$receta_completa['caproico_c6_0']		+= $row['ar_cantidad']/$cantidad*$row['caproico_c6_0'];
			$receta_completa['caprilico_c8_0']		+= $row['ar_cantidad']/$cantidad*$row['caprilico_c8_0'];
			$receta_completa['caprico_c10_0']		+= $row['ar_cantidad']/$cantidad*$row['caprico_c10_0'];
			$receta_completa['laurico_c12_0']		+= $row['ar_cantidad']/$cantidad*$row['laurico_c12_0'];
			$receta_completa['miristico_c14_0']		+= $row['ar_cantidad']/$cantidad*$row['miristico_c14_0'];
			$receta_completa['c15_0']			 	+= $row['ar_cantidad']/$cantidad*$row['c15_0'];
			$receta_completa['c15_00']			 	+= $row['ar_cantidad']/$cantidad*$row['c15_00'];
			$receta_completa['palmitico_c16_0']		+= $row['ar_cantidad']/$cantidad*$row['palmitico_c16_0'];
			$receta_completa['c17_0']		 		+= $row['ar_cantidad']/$cantidad*$row['c17_0'];
			$receta_completa['c17_00']		 		+= $row['ar_cantidad']/$cantidad*$row['c17_00'];
			$receta_completa['estearico_c18_0']		+= $row['ar_cantidad']/$cantidad*$row['estearico_c18_0'];
			$receta_completa['araquidi_c20_0']		+= $row['ar_cantidad']/$cantidad*$row['araquidi_c20_0'];
			$receta_completa['behenico_c22_0']		+= $row['ar_cantidad']/$cantidad*$row['behenico_c22_0'];
			$receta_completa['miristol_c14_1']		+= $row['ar_cantidad']/$cantidad*$row['miristol_c14_1'];
			$receta_completa['palmitole_c16_1']		+= $row['ar_cantidad']/$cantidad*$row['palmitole_c16_1'];
			$receta_completa['oleico_c18_1']		+= $row['ar_cantidad']/$cantidad*$row['oleico_c18_1'];
			$receta_completa['eicoseno_c20_1']		+= $row['ar_cantidad']/$cantidad*$row['eicoseno_c20_1'];
			$receta_completa['c22_1']		 		+= $row['ar_cantidad']/$cantidad*$row['c22_1'];
			$receta_completa['linoleico_c18_2']		+= $row['ar_cantidad']/$cantidad*$row['linoleico_c18_2'];
			$receta_completa['linoleni_c18_3']		+= $row['ar_cantidad']/$cantidad*$row['linoleni_c18_3'];
			$receta_completa['c18_4']		 		+= $row['ar_cantidad']/$cantidad*$row['c18_4'];
			$receta_completa['ara_ico_c20_4']		+= $row['ar_cantidad']/$cantidad*$row['ara_ico_c20_4'];
			$receta_completa['c20_5']		 		+= $row['ar_cantidad']/$cantidad*$row['c20_5'];
			$receta_completa['c22_5']		 		+= $row['ar_cantidad']/$cantidad*$row['c22_5'];
			$receta_completa['c22_6']		 		+= $row['ar_cantidad']/$cantidad*$row['c22_6'];
			$receta_completa['otrosatur0']			+= $row['ar_cantidad']/$cantidad*$row['otrosatur0'];
			$receta_completa['otroinsat0']			+= $row['ar_cantidad']/$cantidad*$row['otroinsat0'];
			$receta_completa['omega3_0']			+= $row['ar_cantidad']/$cantidad*$row['omega3_0'];
			$receta_completa['etanol0']		 		+= $row['ar_cantidad']/$cantidad*$row['etanol0'];
			$receta_completa['accion']		 		= $row['accion'];
			$receta_completa['fecha_creado']		= $row['fecha_creado'];			
		}   		
	}
	
	return $receta_completa;
	
	
}


function gx_obtener_alimentos_excludi($id_cliente) {	
	/*
	$query = "SELECT * FROM `gx_grupos_excluidos` INNER JOIN `gx_alimentos` ON `gx_grupos_excluidos`.`id_grupo` =`gx_alimentos`.`id_grupo` WHERE gx_grupos_excluidos.id_cliente = 1340";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	$tota_registros = $result->num_rows;	
	$html = '';
	

	if($tota_registros >=1){
		while($row = $result->fetch_assoc()) {
			$html .= '<tr>';
				$html .= '<td><div class="checkbox checkbox-success">';
				$html .= '<input id="'.$row['id'].'" type="checkbox" name="'.$row['id'].'" class="marcar">';				
						$html .= '<label for="'.$row['id'].'"></label></div>';
				$html .= '</td>';
				$html .= '<td>'.$row['fecha'];
				$html .= '<input id="'.$row['id'].'" type="hidden" name="id_dieta" value="'.$row['id'].'"></td>';
				$html .= '<input id="'.$row['id_cliente'].'" type="hidden" name="id_cliente" value="'.$row['id_cliente'].'"></td>';
				$html .= '<td>'.$row['kilocalorias_dia'].'</td>';
				$html .= '<td>'.$row['duracion'].'</td>';
				$html .= '<td>'.$row['num_comidas'].'</td>';
			$html .= '</tr>';
		}   		
	}
	
	return $html;
	*/
	
}

//->Obtener historial de peso de clientes
function gx_ultimo_peso_cliente ($id_cliente) {
	$query = "SELECT * FROM `gx_historial_pesos` WHERE id_cliente = '".$id_cliente."' AND status = 1 ORDER BY id DESC LIMIT 1";	
	
	$i = 0;
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));			
	$tota_registros = $result->num_rows;
	if($tota_registros >=1){
		while($row = $result->fetch_assoc()) {
			$historial_pesos["id"]						= $row["id"];
			$historial_pesos["fecha"]					= $row["fecha"];
			$historial_pesos["peso"]					= $row["peso"];
			$historial_pesos["edad"]					= $row["edad"];
			$historial_pesos["informacion"]				= salida_nombre($row["informacion"]);
			$historial_pesos["metabolisto_basal"]		= $row["metabolisto_basal"];
			$historial_pesos["gasto_energetico_total"]	= $row["gasto_energetico_total"];
			$historial_pesos["inice_masa_corporal"]		= $row["inice_masa_corporal"];
			
			$i++;
		}
	}	
	if(empty($historial_pesos)){ $historial_pesos = ''; } 		
	return $historial_pesos;
}

//->Obtener historial de peso de clientes
function gx_obtener_recetas_para_generar_dieta () {
	$query = "SELECT * FROM `gx_recetas` 	
	WHERE `id_usuario` = 0 AND `gx_recetas`.`id_receta` NOT IN (".$_SESSION['todas_las_recetas_desactivadas_por_el_usuario_sql'].")
	OR `id_usuario` = '".$_SESSION['id_usuario']."' AND `gx_recetas`.`id_receta` NOT IN (".$_SESSION['todas_las_recetas_desactivadas_por_el_usuario_sql'].")
	ORDER BY id_receta DESC";
	
	$i = 0;
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));			
	$tota_registros = $result->num_rows;
	if($tota_registros >=1){
		while($row = $result->fetch_assoc()) {
			$receta[$i]['id_receta']				= $row["id_receta"];
			$receta[$i]['id_usuario']				= $row["id_usuario"];
			$receta[$i]['nombre']					= $row["nombre"];
			$receta[$i]['descripcion']				= $row["descripcion"];
			$receta[$i]['peso_minimo']				= $row["peso_minimo"];
			$receta[$i]['peso_maximo']				= $row["peso_maximo"];
			$receta[$i]['kcal_por_100g']			= $row["kcal_por_100g"];
			$receta[$i]['hidratos']					= $row["hidratos"];
			$receta[$i]['proteinas']				= $row["proteinas"];
			$receta[$i]['grasas']					= $row["grasas"];			
			$receta[$i]['nombre_tipo_comida']		= $row["nombre_tipo_comida"];
			$receta[$i]['ingestas']					= $row["ingestas"];
			$receta[$i]['origen']					= 'i-Diet';
			$receta[$i]['fecha_creado']				= $row["fecha_creado"];
			
			//Todas las ingestas de una receta
			$cadena_1 = strpos($receta[$i]['ingestas'], 'ingesta_7');
			if (is_numeric($cadena_1)) { $cadena_1 = "Desayuno"; }else{ $cadena_1 = '';}
			
			$cadena_2 = strpos($receta[$i]['ingestas'], 'ingesta_8');
			if (is_numeric($cadena_2)) {  $cadena_2 = "Media mañana";  }else{ $cadena_2 = '';}
			
			$cadena_3 = strpos($receta[$i]['ingestas'], 'ingesta_9');
			if (is_numeric($cadena_3)) { $cadena_3 = "1ª plato Comida";  }else{ $cadena_3 = '';}
			
			$cadena_4 = strpos($receta[$i]['ingestas'], 'ingesta_10');
			if (is_numeric($cadena_4)) { $cadena_4 = "Merienda";  }else{ $cadena_4 = '';}
			
			$cadena_5 = strpos($receta[$i]['ingestas'], 'ingesta_11');
			if (is_numeric($cadena_5)) { $cadena_5 = "1ª plato Cena";  }else{ $cadena_5 = '';}
			
			$cadena_6 = strpos($receta[$i]['ingestas'], 'ingesta_12');
			if (is_numeric($cadena_6)) {  $cadena_6 = "Recena";  }else{ $cadena_6 = '';}
			
			$cadena_7 = strpos($receta[$i]['ingestas'], 'ingesta_18');
			if (is_numeric($cadena_7)) { $cadena_7 = "Otros";  }else{ $cadena_7 = '';}
			
			$cadena_8 = strpos($receta[$i]['ingestas'], 'ingesta_19');
			if (is_numeric($cadena_8)) { $cadena_8 = "Plato principal comida";  }else{ $cadena_8 = '';}
			
			$cadena_9 = strpos($receta[$i]['ingestas'], 'ingesta_20');
			if (is_numeric($cadena_9)) { $cadena_9 = "Plato principal cena";  }else{ $cadena_9 = '';}
			
			$cadena_10 = strpos($receta[$i]['ingestas'], 'ingesta_21');
			if (is_numeric($cadena_10)) {  $cadena_10 = "Postre";  }else{ $cadena_10 = '';}			
			
			$ingestas = $cadena_1.$cadena_2.$cadena_3.$cadena_4.$cadena_5.$cadena_6.$cadena_7.$cadena_8.$cadena_9.$cadena_10;
			
			$receta[$i]['all_ingestas']	= $ingestas;
			$i++;	
		}
	}		
	return $receta;
}


function gx_obtener_recetas_para_generar_dieta_filtro_alimento ($alimento) {
	$query = "SELECT *
		FROM `gx_recetas` 
		INNER JOIN `gx_alimento_receta` ON `gx_recetas`.`id_receta` = `gx_alimento_receta`.`id_receta` 
		WHERE `id_usuario` = 0 AND `gx_recetas`.`id_receta` NOT IN (".$_SESSION['todas_las_recetas_desactivadas_por_el_usuario_sql'].") AND `gx_alimento_receta`.`alimento` LIKE '%".$alimento."%'
		OR `id_usuario` = '".$_SESSION['id_usuario']."' AND `gx_recetas`.`id_receta` NOT IN (".$_SESSION['todas_las_recetas_desactivadas_por_el_usuario_sql'].") AND `gx_alimento_receta`.`alimento` LIKE '%".$alimento."%'";		
	
	$i = 0;
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));			
	$tota_registros = $result->num_rows;
	if($tota_registros >=1){
		while($row = $result->fetch_assoc()) {
			$receta[$i]['id_receta']				= $row["id_receta"];
			$receta[$i]['id_usuario']				= $row["id_usuario"];
			$receta[$i]['nombre']					= $row["nombre"];
			$receta[$i]['descripcion']				= $row["descripcion"];
			$receta[$i]['peso_minimo']				= $row["peso_minimo"];
			$receta[$i]['peso_maximo']				= $row["peso_maximo"];
			$receta[$i]['kcal_por_100g']			= $row["kcal_por_100g"];
			$receta[$i]['hidratos']					= $row["hidratos"];
			$receta[$i]['proteinas']				= $row["proteinas"];
			$receta[$i]['grasas']					= $row["grasas"];			
			$receta[$i]['nombre_tipo_comida']		= $row["nombre_tipo_comida"];
			$receta[$i]['ingestas']					= $row["ingestas"];
			$receta[$i]['origen']					= 'i-Diet';
			$receta[$i]['fecha_creado']				= $row["fecha_creado"];
			$i++;	
		}
	}		
	return $receta;
}


function gx_actualizar_ingestas($id_receta, $lista_ingestas){
	$query = "UPDATE `gx_recetas` 
	SET `ingestas` = '".$lista_ingestas."'
	WHERE id_receta = '".$id_receta."' AND id_usuario = '".$_SESSION["id_usuario"]."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
	return $query;
}

function gx_desactivar_recetas_ingestas ($id_receta) {
	//Fecha
	$fecha = date('d-m-Y');
	$id_receta_existe = '';
	//primero consultamos si se ha desactivado antes
	$query = "SELECT * FROM `gx_recetas_desactivadas` WHERE id_receta = '".$id_receta."' AND id_usuario = '".$_SESSION['id_usuario']."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));		
	while($row = $result->fetch_assoc()) {
		$id_receta_existe = $row['id_receta'];		
	}
	
	if($id_receta_existe == ''){
		$query = "INSERT into gx_recetas_desactivadas (id_receta, id_usuario, fecha_desactivado) values
		('".$id_receta."', '".$_SESSION['id_usuario']."', '".$fecha."')";
		$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
		
	}else{
		$query = "UPDATE gx_recetas_desactivadas 
		SET fecha_desactivado='".$fecha."',
		status='2'
		WHERE id_receta = '".$id_receta."' AND id_usuario = '".$_SESSION['id_usuario']."'";
		$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	}
	return $query;
}

function gx_duplicar_recetas_ingestas ($id_receta){	
	$fecha = date('d-m-Y');	
	
	$query = "INSERT into gx_recetas (`id_usuario`, `nombre`, `descripcion`, `kcal_por_100g`, `hidratos`, `proteinas`, `grasas`, `peso_maximo`, `peso_minimo`, `origen`, `fecha_creado`, `ingestas`)		
	(SELECT '".$_SESSION['id_usuario']."', `nombre`, `descripcion`, `kcal_por_100g`, `hidratos`, `proteinas`, `grasas`, `peso_maximo`, `peso_minimo`, 'Duplicado', '".$fecha."', `ingestas` FROM gx_recetas WHERE `id_receta` ='".$id_receta."')";	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
	$id_receta_nuevo =  mysqli_insert_id($_SESSION["conexion"]); 	
	
	return $id_receta_nuevo;
}

function crear_ingredientes_nueva_receta_ingestas ($id_receta, $nuevo_id_receta) {	

	$query_insert_total = '';
	
	//primero consultamos todos los ingredientes de la receta desactivada
	$query = "SELECT * FROM `gx_alimento_receta` WHERE id_receta = '".$id_receta."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));		
	while($row = $result->fetch_assoc()) {
		$id_receta_existe = $row['id_receta'];		
		
		//Insertamos cada ingrediente
		$query_insert = "INSERT into gx_alimento_receta (id_alimento, id_receta, cantidad, kcal_100g, alimento, hidratos, proteinas, grasa, id_grupo, grupo) values
		('".$row['id_alimento']."', '".$nuevo_id_receta."', '".$row['cantidad']."', '".$row['kcal_100g']."', '".$row['alimento']."', '".$row['hidratos']."', '".$row['proteinas']."', '".$row['grasa']."', '".$row['id_grupo']."', '".$row['grupo']."')";	
		$result_insert = mysqli_query($_SESSION["conexion"], $query_insert) or die(mysqli_error($_SESSION["conexion"]));	
		
		$query_insert_total = $query_insert_total.'<br />'.$query_insert;
	}
	
	
	return $query_insert_total;	
	
}

function crear_ingredientes_nueva_receta_temporal_ingestas ($id_receta) {	

	$query_insert_total = '';
	
	//primero consultamos todos los ingredientes de la receta desactivada
	$query = "SELECT * FROM `gx_alimento_receta` WHERE id_receta = '".$id_receta."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));		
	while($row = $result->fetch_assoc()) {
		$id_receta_existe = $row['id_receta'];		
		
		//Insertamos cada ingrediente
		$query_insert = "INSERT into gx_alimento_receta_editadas (id_usuario, id_alimento, id_receta, cantidad, kcal_100g, alimento, hidratos, proteinas, grasa, id_grupo, grupo) values
		('".$_SESSION['id_usuario']."', '".$row['id_alimento']."', '".$id_receta."', '".$row['cantidad']."', '".$row['kcal_100g']."', '".$row['alimento']."', '".$row['hidratos']."', '".$row['proteinas']."', '".$row['grasa']."', '".$row['id_grupo']."', '".$row['grupo']."')";	
		$result_insert = mysqli_query($_SESSION["conexion"], $query_insert) or die(mysqli_error($_SESSION["conexion"]));	
		
		$query_insert_total = $query_insert_total.'<br />'.$query_insert;
	}
	
	
	return $query_insert_total;	
	
}


function obtener_ingredientes_tabla_temporal_x_alimento ($id_receta, $id_alimento) {
	$query = "SELECT * FROM `gx_alimento_receta_editadas` WHERE id_receta = '".$id_receta."' AND id_alimento = '".$id_alimento."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	$ingredientes = '';
	$i=0;	
	while($row = $result->fetch_assoc()) {		
		$ingredientes[$i]['id_alimento']		= $row["id_alimento"];				
		$ingredientes[$i]['id_receta']			= $row["id_receta"];			
		$ingredientes[$i]['cantidad']			= $row["cantidad"];
		$ingredientes[$i]['kcal_100g']			= $row["kcal_100g"];
		$ingredientes[$i]['alimento']			= $row["alimento"];
		$ingredientes[$i]['hidratos']			= $row["hidratos"];
		$ingredientes[$i]['proteinas']			= $row["proteinas"];
		$ingredientes[$i]['grasa']				= $row["grasa"];
		$ingredientes[$i]['grupo']				= $row["grupo"];		
		$i++; 
	}
	
	return $ingredientes;
}

function crear_ingredientes_tabla_temporal ($id_receta, $id_alimento, $cantidad) {	
	
	$query = "INSERT into gx_alimento_receta_editadas (id_usuario, id_alimento, id_receta, cantidad, kcal_100g, alimento, hidratos, proteinas, grasa, id_grupo, grupo)  
	SELECT '".$_SESSION['id_usuario']."', '".$id_alimento."', '".$id_receta."', '".$cantidad."', `kcal_100g`, `nombre`, `hidratos`, `proteinas`, `grasa`, `id_grupo`, `grupo` FROM gx_alimentos WHERE `id_alimento` ='".$id_alimento."'";	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));		
	 
	return $query;
}


function borrar_ingredientes_tabla_temporal ($id_receta) {	
	
	$borrar = "DELETE FROM `gx_alimento_receta_editadas` WHERE id_receta = '".$id_receta."' AND id_usuario = '".$_SESSION['id_usuario']."'";	
	$result = mysqli_query($_SESSION["conexion"], $borrar) or die(mysqli_error($_SESSION["conexion"]));			
	
}

function borrar_gx_recetas_editadas ($id_receta) {	
	
	$borrar = "DELETE FROM `gx_recetas_editadas` WHERE id_receta = '".$id_receta."' AND id_usuario = '".$_SESSION['id_usuario']."'";	
	$result = mysqli_query($_SESSION["conexion"], $borrar) or die(mysqli_error($_SESSION["conexion"]));			
	
}

function borrar_todas_las_tablas_temporal () {	
	
	$borrar = "DELETE FROM `gx_alimento_receta_editadas` WHERE id_usuario = '".$_SESSION['id_usuario']."'";	
	$result = mysqli_query($_SESSION["conexion"], $borrar) or die(mysqli_error($_SESSION["conexion"]));	
	
	$borrar = "DELETE FROM `gx_recetas_editadas` WHERE id_usuario = '".$_SESSION['id_usuario']."'";	
	$result = mysqli_query($_SESSION["conexion"], $borrar) or die(mysqli_error($_SESSION["conexion"]));			
	
}



function update_ingredientes_tabla_temporal ($id_receta, $id_alimento, $cantidad) {	
	$query = "UPDATE gx_alimento_receta_editadas 
	SET cantidad='".$cantidad."'
	WHERE id_receta = '".$id_receta."' AND id_alimento = '".$id_alimento."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
}

function actualizar_en_tabla_temporal($id_receta, $temp_nombre, $temp_descripcion, $lista_ingestas_post, $temp_peso_minimo, $temp_peso_maximo){
	
	$fecha = date('d-m-Y');		
	
	$query = "UPDATE gx_recetas_editadas 
	SET nombre='".$temp_nombre."',
	descripcion='".$temp_descripcion."',
	origen='Nuevo',
	fecha_creado='".$fecha."',
	ingestas='".$lista_ingestas_post."',
	peso_maximo='".$temp_peso_maximo."',
	peso_minimo='".$temp_peso_minimo."'
	WHERE id_receta = '".$id_receta."' AND id_usuario = '".$_SESSION['id_usuario']."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));			
	
	return $query;

}

function receta_temporal_a_receta ($id_receta) {	
	$fecha = date('d-m-Y');	
	$query = "INSERT into gx_recetas (id_usuario, nombre, descripcion, nombre_tipo_comida, kcal_por_100g, hidratos, proteinas, grasas, ingestas, peso_maximo, peso_minimo, origen, fecha_creado)  
	SELECT '".$_SESSION['id_usuario']."', `nombre`, `descripcion`, `nombre_tipo_comida`, `kcal_por_100g`, `hidratos`, `proteinas`, `grasas`, `ingestas`, `peso_maximo`, `peso_minimo`, 'Nuevo',  '".$fecha."'  FROM gx_recetas_editadas WHERE `id_receta` ='".$id_receta."' AND id_usuario = '".$_SESSION['id_usuario']."'";	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));		
	
	$id_receta_nuevo =  mysqli_insert_id($_SESSION["conexion"]); 	
	
	return $id_receta_nuevo;
}

function receta_temporal_a_receta_edit ($id_receta) {	
	$fecha = date('d-m-Y');	
	$query = "INSERT into gx_recetas (id_usuario, nombre, descripcion, nombre_tipo_comida, kcal_por_100g, hidratos, proteinas, grasas, ingestas, peso_maximo, peso_minimo, origen, fecha_creado)  
	SELECT '".$_SESSION['id_usuario']."', `nombre`, `descripcion`, `nombre_tipo_comida`, `kcal_por_100g`, `hidratos`, `proteinas`, `grasas`, `ingestas`, `peso_maximo`, `peso_minimo`, 'Editado',  '".$fecha."'  FROM gx_recetas_editadas WHERE `id_receta` ='".$id_receta."' AND id_usuario = '".$_SESSION['id_usuario']."'";	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));		
	
	$id_receta_nuevo =  mysqli_insert_id($_SESSION["conexion"]); 	
	
	return $id_receta_nuevo;
}



function gx_alimento_receta_editadas_a_gx_alimento_receta ($id_receta, $nuevo_id) {	

	$query_insert_total = '';
	
	//primero consultamos todos los ingredientes de la receta desactivada
	$query = "SELECT * FROM `gx_alimento_receta_editadas` WHERE id_receta = '".$id_receta."' AND id_usuario = '".$_SESSION['id_usuario']."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));		
	while($row = $result->fetch_assoc()) {
		$id_receta_existe = $row['id_receta'];		
		
		//Insertamos cada ingrediente
		$query_insert = "INSERT into gx_alimento_receta (id_alimento, id_receta, cantidad, kcal_100g, alimento, hidratos, proteinas, grasa, id_grupo, grupo) values
		('".$row['id_alimento']."', '".$nuevo_id."', '".$row['cantidad']."', '".$row['kcal_100g']."', '".$row['alimento']."', '".$row['hidratos']."', '".$row['proteinas']."', '".$row['grasa']."', '".$row['id_grupo']."', '".$row['grupo']."')";	
		$result_insert = mysqli_query($_SESSION["conexion"], $query_insert) or die(mysqli_error($_SESSION["conexion"]));	
		
		$query_insert_total = $query_insert_total.'<br />'.$query_insert; 
	}
	
	
	return $query;	
	
}


function gx_alimento_receta_editadas_a_gx_alimento_receta_edit ($id_receta, $nuevo_id) {	

	$query_insert_total = '';
	
	//primero consultamos todos los ingredientes de la receta desactivada
	$query = "SELECT * FROM `gx_alimento_receta_editadas` WHERE id_receta = '".$id_receta."' AND id_usuario = '".$_SESSION['id_usuario']."'";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));		
	while($row = $result->fetch_assoc()) {
		$id_receta_existe = $row['id_receta'];		
		
		//Insertamos cada ingrediente
		$query_insert = "INSERT into gx_alimento_receta (id_alimento, id_receta, cantidad, kcal_100g, alimento, hidratos, proteinas, grasa, id_grupo, grupo) values
		('".$row['id_alimento']."', '".$nuevo_id."', '".$row['cantidad']."', '".$row['kcal_100g']."', '".$row['alimento']."', '".$row['hidratos']."', '".$row['proteinas']."', '".$row['grasa']."', '".$row['id_grupo']."', '".$row['grupo']."')";	
		$result_insert = mysqli_query($_SESSION["conexion"], $query_insert) or die(mysqli_error($_SESSION["conexion"]));	
		
		$query_insert_total = $query_insert_total.'<br />'.$query_insert; 
	}
	
	
	return $query;	
	
}

function borrar_gx_dieta_calendario_temporal ($id_cliente) {	
	
	$borrar = "DELETE FROM `gx_dieta_calendario_temporal` WHERE id_cliente = '".$id_cliente."' AND id_usuario = '".$_SESSION['id_usuario']."'";	
	$result = mysqli_query($_SESSION["conexion"], $borrar) or die(mysqli_error($_SESSION["conexion"]));			
	
}

function gx_insertar_dieta_calendario_temporal ($id_cliente, $nombre, $apellidos, $sexo, $peso, $altura, $fecha_nacimiento, $email,
	$recomendaciones, $nombre_completo, $actividad, $imc, $metabolismo, $gasto_energetico,
	$duracion, $num_comidas, $platos_comidas, $comida_postre, $plato_cena, $cena_postre, $fecha_inicio, $kilocalorias_dia,
	$grasas_diarias, $proteinas_diarias, $hidratos_diarios, $limitar_tamano, $listado_plantillas, $total_semanas){	
	
	$fecha_creado = date('d-m-Y');	
	$query = "INSERT INTO gx_dieta_calendario_temporal (id_usuario, id_cliente, nombre, apellidos, sexo, peso, altura, fecha_nacimiento, email,
	recomendaciones, nombre_completo, actividad, imc, metabolismo, gasto_energetico,
	duracion, num_comidas, platos_comidas, comida_postre, plato_cena, cena_postre, fecha_inicio, kilocalorias_dia,
	grasas_diarias, proteinas_diarias, hidratos_diarios, limitar_tamano, listado_plantillas, total_semanas) values		
	('".$_SESSION['id_usuario']."', '".$id_cliente."', '".$nombre."', '".$apellidos."', '".$sexo."', '".$peso."', '".$altura."', '".$fecha_nacimiento."',
	'".$email."', '".$recomendaciones."', '".$nombre_completo."', '".$actividad."', '".$imc."', '".$metabolismo."', '".$gasto_energetico."',
	'".$duracion."', '".$num_comidas."', '".$platos_comidas."', '".$comida_postre."', '".$plato_cena."', '".$cena_postre."', '".$fecha_inicio."', '".$kilocalorias_dia."', 
	'".$grasas_diarias."', '".$proteinas_diarias."', '".$hidratos_diarios."', '".$limitar_tamano."', '".$listado_plantillas."', '".$total_semanas."')";	
	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
	return mysqli_insert_id($_SESSION["conexion"]);
}

function borrar_gx_dieta_dias_calendario_temporal ($id_cliente) {	
	
	$borrar = "DELETE FROM `gx_dieta_dias_calendario_temporal` WHERE id_cliente = '".$id_cliente."' AND id_usuario = '".$_SESSION['id_usuario']."'";	
	$result = mysqli_query($_SESSION["conexion"], $borrar) or die(mysqli_error($_SESSION["conexion"]));			
	
}

function gx_insertar_dieta_dias_calendario_temporal ($id_cliente, $semana, $dia, $tipo_comida, $id_receta){	
	
	$fecha_creado = date('d-m-Y');	
	$query = "INSERT INTO gx_dieta_dias_calendario_temporal (id_usuario, id_cliente, semana, dia, tipo_comida, id_receta) values		
	('".$_SESSION['id_usuario']."', '".$id_cliente."', '".$semana."', '".$dia."', '".$tipo_comida."', '".$id_receta."')";	
	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
	$query = "INSERT INTO gx_dieta_dias_calendario_temporal (id_usuario, id_cliente, semana, dia, tipo_comida, id_receta) values		
	('".$_SESSION['id_usuario']."', '".$id_cliente."', '".$semana."', '".$dia."', '".$tipo_comida."', '".$id_receta."')";	
	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
	$query = "INSERT INTO gx_dieta_dias_calendario_temporal (id_usuario, id_cliente, semana, dia, tipo_comida, id_receta) values		
	('".$_SESSION['id_usuario']."', '".$id_cliente."', '".$semana."', '".$dia."', '".$tipo_comida."', '".$id_receta."')";	
	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
	return mysqli_insert_id($_SESSION["conexion"]);
}



?>