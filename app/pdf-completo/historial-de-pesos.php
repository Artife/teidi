<?php
session_start();
 $_SESSION["id_cliente_pdf"];
 require('../parts/conex.php');	
include '../parts/consultas_mysql.php';
	
$peso_grafico = obtener_historial_peso_cliente_grafico ($_SESSION["id_cliente_pdf"]);
print_r($peso_grafico);
?>