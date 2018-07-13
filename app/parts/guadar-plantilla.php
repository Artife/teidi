<?php
session_start();
include 'conex.php';

//->Guardar plantilla
$nombre_plantilla	= $_POST["nombre_plantilla"];
$dieta_plantilla	= htmlentities($_POST["dieta_plantilla"]);
$todo_el_array		= json_encode($_SESSION['dd']);


date_default_timezone_set("Europe/Madrid");
setlocale(LC_ALL,"es_ES");
$fecha = date('d-m-Y');	
	
//Insertamos la dieta	
$query = "INSERT INTO gx_dietas_plantillas (id_usuario, id_cliente, nombre, fecha, plantilla, duracion, num_comidas, platos_comidas, comida_postre, plato_cena, cena_postre, fecha_inicio, kilocalorias_dia, grasas_diarias, proteinas_diarias, hidratos_diarios, limitar_tamano, listado_plantillas, dieta_plantilla, todo_el_array) values
('".$_SESSION["id_usuario"]."', '".$_SESSION['dd']['id_cliente']."', '".$nombre_plantilla."', '".$fecha."', '".$_SESSION['dd']['plantilla']."', '".$_SESSION['dd']['duracion']."', 
'".$_SESSION['dd']['num_comidas']."', '".$_SESSION['dd']['platos_comidas']."', '".$_SESSION['dd']['comida_postre']."', '".$_SESSION['dd']['plato_cena']."', 
'".$_SESSION['dd']['cena_postre']."', '".$_SESSION['dd']['fecha_inicio']."', '".$_SESSION['dd']['kilocalorias_dia_post']."', 
'".$_SESSION['dd']['grasas_diarias']."', '".$_SESSION['dd']['proteinas_diarias']."', '".$_SESSION['dd']['hidratos_diarios']	."', 
'".$_SESSION['dd']['limitar_tamano']."', '".$_SESSION['dd']['listado_plantillas']."', '".$dieta_plantilla."', '".$todo_el_array."')";
$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));	
	
$mensaje = '<p class="ok">La plantilla fue guardada con éxito</p>';

echo $mostrar_mensaje='
<div class="ibox-content">
	<div class="row">
		<div class="col-lg-12">				
			<h1 class="ok text-center"><strong>'.$mensaje.'</strong></h1>
		</div>
	</div>
</div><br><br>';
?>