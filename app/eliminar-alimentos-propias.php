<?php
session_start();
include 'parts/conex.php';
//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';

//Primera parte textos y titulos

gx_eliminar_alimentos_propias();
$_SESSION['total_alimentos_desactivados_por_cliente_array'] = gx_todas_los_alimentos_desactivadas_por_el_usuario();
$_SESSION['total_alimentos_desactivados_por_cliente_sql'] = gx_todas_los_alimentos_desactivadas_por_el_usuario_sql();

$_SESSION['mensaje'] = 'eliminar_alimentos_propias';	
header('location:'.$url_app.'configuracion');	
?>