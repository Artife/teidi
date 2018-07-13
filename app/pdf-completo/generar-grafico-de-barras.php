<?php 
session_start();
require('../parts/conex.php');	
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

include '../parts/configuracion.php';
include '../parts/consultas_mysql.php';

// Se define el array de datos	
$peso_grafico = obtener_historial_peso_cliente_grafico($_GET['id']);

// require_once ('historial-de-pesos.php');
require_once ('../jpgraph/src/jpgraph.php');
require_once ('../jpgraph/src/jpgraph_bar.php');

// Se define el array de datos
// $datosy=array(150,160,60,65,66,16,34,74,74);
// $datosy=array($peso_grafico);
 
// Creamos el grafico
$grafico = new Graph(500,250);
$grafico->SetScale('textlin');
 
// Ajustamos los margenes del grafico-----    (left,right,top,bottom)
$grafico->SetMargin(40,30,30,40);
 
// Creamos barras de datos a partir del array de datos
$bplot = new BarPlot($peso_grafico);

// Configuramos color de las barras 
$bplot->SetFillColor('#479CC9');

// Queremos mostrar el valor numerico de la barra
$bplot->value->Show();

//Añadimos barra de datos al grafico
$grafico->Add($bplot);
 
// Configuracion de los titulos
$grafico->title->Set('Historial de pesos registrados');
$grafico->xaxis->title->Set('Registro de pesos');
$grafico->yaxis->title->Set('Cantidad de registros');
 
$grafico->title->SetFont(FF_FONT1,FS_BOLD);
$grafico->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$grafico->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
 
// Se muestra el grafico
$grafico->Stroke(); 
?>
