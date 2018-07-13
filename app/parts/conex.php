<?php
// ini_set('error_reporting', E_ALL);
$url_dominio = $_SERVER['HTTP_HOST'];
$ubicacion_local = 'oficina';

//Url donde se estan ejecutando las paginas de la aplicacion
if($url_dominio == 'localhost'){
	
	if($ubicacion_local == 'oficina'){
	//conexion local	
	$servername = "localhost";
	$username = "root";
	$password = "sentinela";
	$dbname = "idiet_prueba";
	}else{
	$servername = "localhost";
	$username = "root";
	$password = "sentinela";
	$dbname = "idietprueba";	
	}
}else{
	//conexion server
	$servername = "localhost";
	$username = "idiet800_prueba";
	$password = "qsvtOsH^dhz5";
	$dbname = "idiet800_prueba";
}


 
 
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{ 
	//creamos la conexion mysql en session
	$_SESSION["conexion"] = $conn;
}

header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
session_cache_limiter('public'); // works too



?>