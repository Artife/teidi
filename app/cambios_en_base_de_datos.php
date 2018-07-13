<?php

session_start();
include 'parts/conex.php';

//Solo permitir acceso a estos roles
$acceso_roles = array('admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/consultas_mysql.php';
include_once 'parts/configuracion.php';

/*
//-> Tabla usuarios

Hacer un update a todos los roles usuario a Normal
	UPDATE `usuario` SET `role`='Normal' WHERE `role` = 'usuario'
	
Crear rol desarrollador para Jaume, Veronica y yo
	
//Tabla Alimentos Editados
Crear nueva tabla para alimentos editados
En esta tabla hay campos nuevos, fecha de creacion y tipo de accion

*/

//-> RECETAS
//Cambiar Tabla recetas
//1# cambiar nombre de la tabla "plato" por "recetas"
//2# Agregar nueva columna luego de la descripcion "nombre_tipo_comida" varchar 255
//3# Insertar de la tabla "plato_tipocomida" en la nueva columana "nombre_tipo_comida" 

	//Obtener todas las recetas
	/*
	$query = "SELECT * FROM `recetas`";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($connection));	
	
	$i = 0;
	while($row = $result->fetch_assoc()) {
		$id_receta[$i]	= $row['id_receta'];
		$i++;		
	}
	
	
	//Obtener todos los tipos de comida
	//Tambien le quitamos el saldo de lina \r\n	
	$query = "SELECT * FROM `plato_tipocomida`";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($connection));	
	
	$i = 0;
	while($row = $result->fetch_assoc()) {		
		$nombre_tipoComida[$i]	= str_replace('\r\n', '', $row['nombre_tipoComida']);
		$id_plato[$i]			= $row['id_plato'];
		$i++;		
	}	
	//print_r ($id_receta);
	//print_r ($nombre_tipoComida);
	//Contamos todas las recetas
	$Total_recetas = count($id_plato);
	
	// Hacemos un update de la nueva tabla recetas
	for ($i = 0; $i <= $Total_recetas; $i++) {
		if(!empty($nombre_tipoComida[$i])){
				$sql = "UPDATE recetas SET nombre_tipo_comida='".utf8_encode($nombre_tipoComida[$i])."' WHERE id_receta='".$id_plato[$i]."'";
				if ($conn->query($sql) === TRUE) {} else {}
		}
	}
	*/
//4# cramos 2 culumnas nuevas en recetas "origen" y "fecha_creado"
	
	//Le colocamos a las recetas null la fecha de creado del ano pasado
	// $sql = "UPDATE recetas SET fecha_creado='02-02-2016' WHERE id_usuario IS NULL";
	// if ($conn->query($sql) === TRUE) {} else {}
	
	//Le colocamos esta fecha por ahora a los usuarios que ya tenian recetas personalizadas creadas
	// $sql = "UPDATE recetas SET fecha_creado='04-04-2016' WHERE id_usuario IS NOT NULL";
	// if ($conn->query($sql) === TRUE) {} else {}
	
	//El campos origen solomente sera las recetas, nuevas, publicadas, y de desactivadas  de cualquiera de ellas
	
//#5 cambiamos platos_desactivados por recetas_esactivadas con 2 campos nuevos
	/*
	//obtenemos todos los platos desactivados y los pasamos a la nueva tabla 
	$query = "SELECT * FROM `platos_desactivados`";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($connection));	
	
	$i = 0;
	while($row = $result->fetch_assoc()) {	
		$id_plato[$i]			= $row['id_plato'];
		$id_usuario[$i]			= $row['id_usuario'];
		$sql = "INSERT INTO recetas_desactivadas (id_receta, id_usuario, fecha_desactivado)
				VALUES ('".$id_plato[$i]."', '".$id_usuario[$i]."', '02-02-2016')";
				if ($conn->query($sql) === TRUE) {
					echo "New record created successfully";
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}	
		
		$i++;		
	}	
	*/
#6 Asignarle el origen a los alimentos
	/*
	$sql = "UPDATE recetas SET origen='i-Diet' WHERE id_usuario IS NULL";
	if ($conn->query($sql) === TRUE) {} else {}
	
	$sql = "UPDATE recetas SET origen='Nuevo' WHERE id_usuario IS NOT NULL";
	if ($conn->query($sql) === TRUE) {} else {}
	*/
	
//->  Tabla alimentos

/*
Lista de variables para nuevo alimentos
subgrupo
pc_porcentaje
cal_kcal
agua_g
hc_g
fibra_g
prot_g
grasa_g
col_mg
satur_g
mono_g
poli_g
vit_a
carotenos
vit_b1
vit_b2
niacina
ac_panto
vit_b6
biotina
folico
b12
vit_c
vit_d
tocoferol
vit_e
vit_k
oxalico
purinas
sodio_mg
potasio_mg
magnesio_mg
calcio_mg
fosf_mg
hierro_mg
cloro_mg
cinc_mg
cobre_mg
manganeso_mg
cromo_mg
cobalto_mg
molibde_mg
yodo_mg
fluor_mg
butirico_c4_0
caproico_c6_0
caprilico_c8_0
caprico_c10_0
laurico_c12_0
miristico_c14_0
c15_0
c15_00
palmitico_c16_0
c17_0
c17_00
estearico_c18_0
araquidi_c20_0
behenico_c22_0
miristol_c14_1
palmitole_c16_1
oleico_c18_1
eicoseno_c20_1
c22_1
linoleico_c18_2
linoleni_c18_3
c18_4
ara_ico_c20_4
c20_5
c22_5
c22_6
otrosatur0
otroinsat0
omega3_0
etanol0	
	
	Exportar y ordernar segun la nueva tabla
	
	SELECT * FROM `alimento` 
	LEFT JOIN grupos_alimentos ON grupos_alimentos.id_grupo = alimento.grupo 
	INNER JOIN alimento_completo ON alimento_completo.id_alimento_completo = alimento.id_alimento_completo
	
*/
	// Acomodar los grupos de alimentos
	
	$query = "SELECT * FROM `gx_alimentos` group by grupo";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($connection));	
	
	$i = 0;
	while($row = $result->fetch_assoc()) {		
		echo $alimento[$i]			= $row['grupo'];
		echo "<br/>";		
			
		$i++;		
	}
	
	/*
	$sql = "UPDATE gx_alimentos SET grupo='Aves y caza y otras carnes' WHERE grupo='AVES Y CAZA Y OTRAS CARNES'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Azúcares' WHERE grupo='AZUCARES'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Bebidas sin alcohol' WHERE grupo='BEBIDAS SIN ALCOHO'";
	if ($conn->query($sql) === TRUE) {} else {}	
	$sql = "UPDATE gx_alimentos SET grupo='Carne de cerdo' WHERE grupo='CARNE DE CERDO'";
	if ($conn->query($sql) === TRUE) {} else {}
	if ($conn->query($sql) === TRUE) {} else {}	
	$sql = "UPDATE gx_alimentos SET grupo='Carne de ovino' WHERE grupo='CARNE DE OVINO'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Cereales y derivados' WHERE grupo='CEREALES Y DERIVADOS'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Chocolates' WHERE grupo='CHOCOLATES'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Confituras y mermeladas' WHERE grupo='CONFITURAS Y MERMELADAS'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Crustáceos y otros productos' WHERE grupo='CRUSTACEOS Y OTROS PRODUCTOS'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Embutidos' WHERE grupo='EMBUTIDOS'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Especias' WHERE grupo='ESPECIAS'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Féculas' WHERE grupo='FECULAS'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Frutos Secos' WHERE grupo='FRUTOS SECOS'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Grasas' WHERE grupo='GRASAS'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Helados y otros productos lacteos' WHERE grupo='HELADOS Y OTROS PRODUCTOS LACTEOS'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Hortalizas bulbosas' WHERE grupo='HORTALIZAS BULBOSAS'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Hortalizas de fruto' WHERE grupo='HORTALIZAS DE FRUTO'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Huevos' WHERE grupo='HUEVOS'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Leches' WHERE grupo='LECHES'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Legumbres' WHERE grupo='LEGUMBRES'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Licores' WHERE grupo='LICORES'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Mermeladas' WHERE grupo='MERMELADAS'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Miscelaneos' WHERE grupo='MISCELANEOS'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Moluscos' WHERE grupo='MOLUSCOS'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Pescados con poca grasa' WHERE grupo='PESCADOS CON POCA GRASA'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Pescados grasos' WHERE grupo='PESCADOS GRASOS'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Pescados semigrasos' WHERE grupo='PESCADOS SEMIGRASOS'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Productos carnicos tratados por el calor' WHERE grupo='PRODUCTOS CARNICOS TRATADOS POR EL CALOR'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Quesos' WHERE grupo='QUESOS'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Salsas' WHERE grupo='SALSAS'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Verduras de hoja y setas' WHERE grupo='VERDURAS DE HOJA Y SETAS'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Vinos' WHERE grupo='VINOS'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Visceras' WHERE grupo='VISCERAS'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Yogur' WHERE grupo='YOGUR'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Zumos de frutas' WHERE grupo='ZUMOS DE FRUTAS'";
	if ($conn->query($sql) === TRUE) {} else {} 
	$sql = "UPDATE gx_alimentos SET grupo='Azúcares' WHERE grupo='AZULARES'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Bebidas sin alcohol' WHERE grupo='BEBIDAS SIN ALCOHOL'";
	if ($conn->query($sql) === TRUE) {} else {}
	$sql = "UPDATE gx_alimentos SET grupo='Carne de vacuno' WHERE grupo='CARNE DE VACUNO'";
	if ($conn->query($sql) === TRUE) {} else {} 
	$sql = "UPDATE gx_alimentos SET grupo='Water', id_grupo ='90' WHERE grupo='90'";
	if ($conn->query($sql) === TRUE) {} else {} */
	/*
	//Buscar por los id de los grupos
	$query = "SELECT * FROM `gx_grupos_alimentos`";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($connection));	
	
	$i = 0;
	while($row = $result->fetch_assoc()) {		
		echo $alimento[$i]			= $row['id_grupo'];
		echo $alimento[$i]			= $row['grupo'];
		echo "<br/>";		
			$sql = "UPDATE gx_alimentos SET id_grupo='".$row['id_grupo']."', grupo='".$row['grupo']."' WHERE grupo='".$row['id_grupo']."'";
			if ($conn->query($sql) === TRUE) {} else {}
		$i++;		
	} */
?>
	