<?php
header('Cache-Control: no cache'); 
session_cache_limiter('private_no_expire');
session_start();
include 'parts/conex.php';
$pagina = 'Insertar Receta';

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include 'parts/consultas_mysql.php';
	
$nombre 			= $_POST['nombre'];
$descripcion 		= utf8_decode($_POST['descripcion']);

$kcal_por_100g 		= $_POST['kcal_por_100g'];
$hidratos_porc 		= $_POST['hidratos_porc'];
$proteinas_porc		= $_POST['proteinas_porc'];
$grasas_porc 		= $_POST['grasas_porc'];

$peso_minimo 		= $_POST['peso_minimo'];
$peso_maximo		= $_POST['peso_maximo'];

$lista_ingestas = '';
$lista_ingesta_1 = '';
$lista_ingesta_2 = '';
$lista_ingesta_3 = '';
$lista_ingesta_4 = '';
$lista_ingesta_5 = '';
$lista_ingesta_6 = '';
$lista_ingesta_7 = '';
$lista_ingesta_8 = '';
$lista_ingesta_9 = '';
$lista_ingesta_10 = '';


if(!empty($_POST['incluir_desayuno'])) { $incluir_desayuno 					= $_POST['incluir_desayuno']; $lista_ingesta_1 = ' ingesta_7,';}
if(!empty($_POST['incluir_media_manana'])) { $incluir_media_manana			= $_POST['incluir_media_manana']; $lista_ingesta_2 = ' ingesta_8,'; }
if(!empty($_POST['incluir_plato_comida'])) { $incluir_plato_comida 			= $_POST['incluir_plato_comida']; $lista_ingesta_3 = ' ingesta_9,'; }
if(!empty($_POST['incluir_plato_comida_principal'])) { $incluir_plato_comida_principal	= $_POST['incluir_plato_comida_principal'];  $lista_ingesta_8 = ' ingesta_19,'; }
if(!empty($_POST['incluir_postre'])) { $incluir_postre 						= $_POST['incluir_postre']; $lista_ingesta_10 = ' ingesta_21,';}
if(!empty($_POST['incluir_merienda'])) { $incluir_merienda 					= $_POST['incluir_merienda'];  $lista_ingesta_4 = ' ingesta_10,'; }
if(!empty($_POST['incluir_plato_cena'])) { $incluir_plato_cena 				= $_POST['incluir_plato_cena']; $lista_ingesta_5 = ' ingesta_11,';  }
if(!empty($_POST['incluir_plato_cena_principal'])) { $incluir_plato_cena_principal	= $_POST['incluir_plato_cena_principal']; $lista_ingesta_9 = ' ingesta_20,';}
if(!empty($_POST['incluir_recena'])) { $incluir_recena 						= $_POST['incluir_recena']; $lista_ingesta_6 = ' ingesta_12,'; }
if(!empty($_POST['incluir_otros'])) { $incluir_otros 						= $_POST['incluir_otros']; $lista_ingesta_7 = ' ingesta_18,'; }

$lista_ingestas  = $lista_ingesta_1.$lista_ingesta_2.$lista_ingesta_3.$lista_ingesta_4.$lista_ingesta_5.$lista_ingesta_6.$lista_ingesta_7.$lista_ingesta_8.$lista_ingesta_9.$lista_ingesta_10;

if(!empty($_POST["nombre"])){
	$receta_generada = gx_duplicar_receta_original (utf8_decode($nombre), $descripcion, $kcal_por_100g, $hidratos_porc, $proteinas_porc, $grasas_porc, $peso_maximo, $peso_minimo, $lista_ingestas);
	
	//Buscar Ingestas
	foreach($_POST as $campo => $valor) {				
		if(substr($campo, 0 , 8) == 'incluir_')	{	
			// echo $campo." - ".$valor;
			// echo "<br>";
			crear_ingestas_nueva_receta($receta_generada, $valor);
		}
	} 
	//Buscar Ingredientes
	foreach($_POST as $campo => $valor) {				
		if(substr($campo, 0 , 16) == 'insert_alimento_')	{	
			// echo substr($campo, 16)." - ".$valor;
			// echo "<br>";
			// echo substr($campo, 16));
			if($valor != 0){
			// $datos_alimento = obtener_alimento_completo(substr($campo, 16));
			crear_ingredientes_nueva_receta (substr($campo, 16), $receta_generada, $valor, $datos_alimento['kcal_100g'], $datos_alimento['nombre'], $datos_alimento['hidratos'], $datos_alimento['proteinas'], $datos_alimento['grasa']);
			}
		}
	} 
	$_SESSION['mensaje'] = 'receta_duplicada';	
	header('location:'.$url_app.'lista-recetas');
}else{
	//Sin datos
	$_SESSION['mensaje'] = 'datos_vacios';	
	header('location:'.$url_app.'nueva-receta');
	
}

?>