<?php 

session_start();
include 'parts/conex.php';

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/consultas_mysql.php';
include_once 'parts/configuracion.php';

/*
for ($i = 1; $i <= 3000; $i++) {
	$query = "INSERT into gx_recetas (id_usuario, nombre, descripcion, kcal_por_100g, hidratos, proteinas, grasas, peso_maximo, peso_minimo, origen, fecha_creado) values		
	('0', '', '', '', '', '', '', '', '', '', '')";	
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	echo "listo" ;
	echo "<br>";
}*/

$query = "SELECT * FROM gx_receta_tipocomida";
$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	


$i=0;	
while($row = $result->fetch_assoc()) {
	$agregar['id_receta']			= $row["id_receta"];					
	//$agregar['id_tipoComida']		= $row["id_tipoComida"];
	$registros_ingestas = '';
	$ingesta = '';
	//$registros_ingestas = obtener_ingestas_tablax ($agregar['id_receta']);
	
	if(!empty($agregar['id_receta'])){
			$query2 = "SELECT * FROM `gx_receta_tipocomida` 
			WHERE id_receta = '".$agregar['id_receta']."'";
			$result2 = mysqli_query($_SESSION["conexion"], $query2) or die(mysqli_error($_SESSION["conexion"]));	
			
			$ingesta = '';
			while($row2 = $result2->fetch_assoc()) {		
				// $mostrar[$i]	= $row['id_tipoComida'];
				// $mostrar[$i]	= $row['nombre_tipoComida'];
				$ingesta  .= 'ingesta_'.$row2['id_tipoComida'].', ';
				
			}
	}
	
	if(!empty($ingesta)){
		echo $query3 = "UPDATE `gx_recetas` SET `ingestas` = '".$ingesta."' WHERE `gx_recetas`.`id_receta` = '".$agregar['id_receta']."'";
		$result3 = mysqli_query($_SESSION["conexion"], $query3) or die(mysqli_error($_SESSION["conexion"]));	
	}
	// echo "listo" ;
	echo "<br>"; 
	$i++; 
}


?>