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

gx_recuperar_recetas();
$_SESSION['todas_las_recetas_desactivadas_por_el_usuario']  = gx_todas_las_recetas_desactivadas_por_el_usuario();
$_SESSION['todas_las_recetas_desactivadas_por_el_usuario_sql']  = gx_todas_las_recetas_desactivadas_por_el_usuario_sql();

$_SESSION['mensaje'] = 'recuperar_recetas';	
header('location:'.$url_app.'configuracion');	
?>