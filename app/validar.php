<?php  //Iniciar la sesion
session_start();
require('parts/conex.php');

//Url de la aplicacion
require 'parts/myurls.php';

//Validar que las variables estan llenas
if (isset($_POST['login']) && isset($_POST['contrasena'])){
	
	//Si estan las variables ejecutar la consulta del usuario
	$login = strip_tags($_POST['login']);
	$contrasena = strip_tags($_POST['contrasena']);
	
	//Revisamos si existe el usuario	
	$query = "SELECT * FROM `gx_usuarios` WHERE `login`='".$login."'";	
	$result = mysqli_query($conn, $query) or die(mysqli_error($connection));
	$count 	= mysqli_num_rows($result);	
	if ($count == 1){	
	
		//Agregamos el pass actual a una variable
		while($row = $result->fetch_assoc()) {
			$pass_actual					= $row["contrasena"];
		}
		
		//validamos si el pass es correcto con el guardado en la base de datos
		if ($pass_actual == crypt($contrasena, $pass_actual)){
				
				$query = "SELECT * FROM `gx_usuarios` WHERE `login`='".$login."' AND contrasena = '".$pass_actual."'";	
				$result = mysqli_query($conn, $query) or die(mysqli_error($connection));
				$count 	= mysqli_num_rows($result);	
					while($row = $result->fetch_assoc()) {
						
					$_SESSION['id_usuario']		= $row["id_usuario"];
					$_SESSION['login']			= $row["login"];
					$_SESSION['nombre']		 	= $row["nombre"];
					$_SESSION['role'] 			= $row["role"];
					$_SESSION['email'] 			= $row["email"];
					$_SESSION['contrasena']		= $row["contrasena"];	
					$_SESSION['tipo_conexion']		= $url_dominio;
					$_SESSION['ubicacion_local']	= $ubicacion_local;
					}	
				
			//Si todo esta correcto lo mandamos al home
			header('Location: '.$url_app.'home');
		}else{			
			//Error usuario o pass invalido
			header('Location: '.$url_app.'index/1');
		}		
	}else{		
		//Error usuario o pass invalido
		header('Location: '.$url_app.'index/1');
	}
}else{
	//Datos vacios	
	header('Location: '.$url_app.'index/2');
}

$conn->close();

?>