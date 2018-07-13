<?php
session_start();
require('parts/conex.php');

$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

session_destroy();
include_once 'parts/configuracion.php';

header('location:'.$url_app.'index/4');

//Mensajes
/*
4 = sesion cerrada con exito

*/
?>