<?php
session_start();
require('parts/conex.php');

$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';

//->id cliente
$id_cliente = $_POST['id_cliente'];

//->Datos de la clinicas
$datos_clinica = datos_clinica();

//->Datos del cliente
$cliente = obtener_datos_cliente_x_usuario ($id_cliente);	

//->Obtener grupos excluidos
$grupos_excludios = obtener_grupos_excluidos_x_cliente($id_cliente);
	
//->Obtener grupos
$grupos_alimentos = mostrar_grupos_alimentos(); 

//->Total grupos excluidos
$total_grupos	= count($grupos_alimentos);

//->Obtener alimentos excluidos
$alimentos_excluidos = obtener_alimentos_excluidos_x_cliente($id_cliente);

//->Obtener alimentos
$alimentos_activos = listado_de_alimentos_completo(); 

//->Total alimentos excluidos
$total_alimentos  = count($alimentos_activos);


//->Historial de pesos
$historial_pesos_grafico = obtener_historial_peso_cliente ($id_cliente);

//->Obtener mediciones del cliente
$historial_pesos = obtener_ultima_medicion_del_cliente ($id_cliente);

//->Consultar la ultima dieta guardada	
$consulta_de_dieta = gx_consultar_ultima_dieta_guardada(); 

//-> Nombre del archivo
$nombre_archivo = 'Dieta | '.$cliente['nombre'].' '.$cliente['apellidos'].' Fecha: '.date('d-m-Y');
	
require('WriteHTML.php');

$pdf=new PDF_HTML();
$pdf->AddPage();
$pdf->SetFont('Arial');
$pdf->WriteHTML('You can<br><p align="center">center a line</p>and add a horizontal rule:<br><hr>');
$pdf->Output();
?>
