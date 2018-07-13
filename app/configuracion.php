<?php
session_start();
include 'parts/conex.php';

$pagina = 'Configuración';
$migas = array('');
$migas_url = array('');

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';


if(!empty($idiet_status_textos) || $idiet_status_textos != "0") { 
	$mostrar_size_body 	= intval(preg_replace('/[^0-9]+/', '',$size_body), 10); 
	$mostrar_size_h1	= intval(preg_replace('/[^0-9]+/', '',$size_h1), 10);	
	
	switch ($color_body) {
    case "#001":
        $mostrar_color_body = 1;
        break;
    case "#1d1d1d":        
		$mostrar_color_body = 2;
        break;
    case "#3f3f3f":        
		$mostrar_color_body = 3;
        break;
	case "#5f5f5f":        
		$mostrar_color_body = 4;
        break;
	case "#676a6c":        
		$mostrar_color_body = 5;
        break;
	case "#7f7f7f":        
		$mostrar_color_body = 6;
        break;		
	default:
		$mostrar_color_body = 5;
	}	
	
	switch ($color_hs) {
    case "#001":
        $mostrar_color_hs = 1;
        break;
    case "#1d1d1d":        
		$mostrar_color_hs = 2;
        break;
    case "#3f3f3f":        
		$mostrar_color_hs = 3;
        break;
	case "#5f5f5f":        
		$mostrar_color_hs = 4;
        break;
	case "#676a6c":        
		$mostrar_color_hs = 5;
        break;
	case "#7f7f7f":        
		$mostrar_color_hs = 6;
        break;		
	default:
		$mostrar_color_hs = 5;
	}	
	
	
	
}

	$seleccionado_25 = '';	
	$seleccionado_50 = '';
	$seleccionado_100 = '';
	$seleccionado_all = '';
if(!empty($idiet_status_tabla) || $idiet_status_tabla != "0") { 
	$mostrar_color_tabla	= $color_tabla;		
	$mostrar_color_tabla	= $color_tabla;	
	
	switch ($tabla_lista) {
    case "25":
        $seleccionado_25 = 'selected';
        break;
	case "50":
        $seleccionado_50 = 'selected';
        break;
    case "100":
        $seleccionado_100 = 'selected';
        break;
	case "6000":
        $seleccionado_all = 'selected';
        break;		
	default:
		$seleccionado_all = 'selected';
	}		
}


?>
	<?php echo header_documento(); ?>
	<?php include 'parts/header.php'; ?>
	<style>
	.thumb{		 
		border: 1px solid #000;
		margin: 10px 5px 0 0;
	}
	</style>
</head>
 
<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <?php include_once 'parts/menu_izquierdo.php'; ?>
        </nav>

        <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
        <?php include_once 'parts/menu_top.php'; ?>
        </div>
			<div class="row wrapper border-bottom white-bg page-heading">
			<?php echo migas_de_pan($pagina, $migas, $migas_url, ''); ?>                
            </div>
		<div class="wrapper wrapper-content animated fadeInRight">
			<!-- Primera parte-->
			<div class="row">
				<div class="col-lg-6">
					<div class="ibox float-e-margins">
						<div class="ibox-title">
							<p>Cambios en los textos</p>
						</div>
						<div class="ibox-content">
						<!-- formulario nuevo usuario -->
							<form method="post" class="form-horizontal" action="<?php echo $url_app; ?>cambiar-configuracion">	
							<div class="row">															
								<div class="col-md-3" style="padding-top: 15px;">
									<p>Tamaño de la Fuente</p>									
								</div>
								<div class="col-md-3">									
									<input id="tamano_fuente" name="tamano_fuente" type="range" min="12" max="24" value="<?php echo $mostrar_size_body; ?>">
									<input id="tamano_fuente_codigo" name="tamano_fuente_codigo" type="hidden" value="<?php echo $size_body; ?>">
								</div>
								<div class="col-md-3" style="padding-top: 15px;">
									<p>Tamaño de los Titulos</p>									
								</div>
								<div class="col-md-3">									
									<input id="tamano_titulo" name="tamano_titulo" type="range" min="20" max="30" value="<?php echo $mostrar_size_h1; ?>">
									<input id="tamano_titulo_codigo" name="tamano_titulo_codigo" type="hidden" value="<?php echo $size_h1; ?>">
								</div>		
							</div>
							<br /><br />	
							<div class="row">															
								<div class="col-md-3" style="padding-top: 15px;">
									<p>Color de la Fuente</p>									
								</div>
								<div class="col-md-3">									
									<input id="color_fuente" name="color_fuente" type="range" min="1" max="6" value="<?php echo $mostrar_color_hs; ?>">
									<input id="color_fuente_codigo" name="color_fuente_codigo" type="hidden" value="<?php echo $color_hs; ?>">
								</div>
								<div class="col-md-3" style="padding-top: 15px;">
									<p>Color de los Titulos</p>									
								</div>
								<div class="col-md-3">									
									<input id="color_titulo" name="color_titulo" type="range" min="1" max="6"  value="<?php echo $mostrar_color_body; ?>">
									<input id="color_titulo_codigo" name="color_titulo_codigo" type="hidden" value="<?php echo $color_body; ?>">
								</div>	
							</div>
							<br /><br />	
							<div class="row text-center">															
								<div class="col-md-6">
									<button type="submit" class="btn btn-block btn-warning" name="restablecer" value="restablecer"> Reestablecer</button>
								</div>
								<div class="col-md-6">									
									<button type="submit" class="btn btn-block btn-primary" name="guardar" value="guardar"> Guardar!</button>
								</div>									
							</div>
							<input id="tipo_configuracion" name="tipo_configuracion" type="hidden" value="textos">	
							</form>
						<!-- formulario nuevo usuario -->
						</div>
					</div>					
					<!-- Formato de la tabla -->
					<form method="post" class="form-horizontal" action="<?php echo $url_app; ?>cambiar-configuracion">	
					<div class="ibox float-e-margins">
						<div class="ibox-title">
							<p>Configuración de Tablas</p>                      
						</div>
						<div class="ibox-content">						
							<div class="row">															
								<div class="col-md-4">
									<p>Total de campos mostrados en tabla</p>									
								</div>
								<div class="col-md-2">									
									<select id="filtro_origen" name="filtro_origen" class="input-sm form-control input-s-sm inline" style="padding-top:0px;" name="grupo">										
										<option value="6000" <?php echo $seleccionado_all; ?>>Todos</option>
										<option value="100" <?php echo $seleccionado_100; ?>>100</option>
										<option value="50" <?php echo $seleccionado_50; ?>>50</option>
										<option value="25" <?php echo $seleccionado_25; ?>>25</option>
									</select>
								</div>
								<div class="col-md-3">		
								</div>
							</div>
							<br /><br />	
							<div class="row">															
								<div class="col-md-3" style="padding-top: 15px;">
									<p>Tamaño de la Fuente</p>									
								</div>
								<div class="col-md-3">									
									<input id="size_tabla" name="size_tabla" type="range" min="1" max="6">									
								</div>
								<div class="col-md-3" style="padding-top: 15px;">
									<p>Color de la Fuente</p>									
								</div>
								<div class="col-md-3">									
									<input id="color_tabla" name="color_tabla" type="range" min="1" max="6">
									<input id="color_tabla_codigo" name="color_tabla_codigo" type="hidden">
								</div>	
							</div>
							<br /><br />	
							<div class="row text-center">															
								<div class="col-md-6">
									<button type="submit" class="btn btn-block btn-warning" name="restablecer" value="restablecer"> Reestablecer</button>
								</div>
								<div class="col-md-6">									
									<button type="submit" class="btn btn-block btn-primary" name="guardar" value="guardar"> Guardar!</button>
								</div>									
							</div>
							<input id="tipo_configuracion" name="tipo_configuracion" type="hidden" value="formato_tabla">							
						</div>
					</div>
					</form>
					<!-- Fin Formato de la tabla -->
					<!-- Restablecer configuracion total-->										
					<div class="ibox float-e-margins">
						<div class="ibox-title">
							<p>Restablecer la configuración del sistema</p>                      
						</div>
						<div class="ibox-content">						
							<div class="row">															
								<div class="col-md-8">
									<p>Recuperar todas las recetas del sistema:</p>									
								</div>
								<div class="col-md-4">									
									<a class="btn btn-block btn-danger" href="<?php echo $url_app; ?>recuperar-recetas"> Recuperar Recetas</a>
								</div>
							</div>
							<br /><br />
							<div class="row">															
								<div class="col-md-8">
									<p>Recuperar todas los alimentos del sistema:</p>									
								</div>
								<div class="col-md-4">									
									<a class="btn btn-block btn-danger"  href="<?php echo $url_app; ?>recuperar-alimentos"> Recuperar Alimentos</a>
								</div>
							</div>
							<br /><br />	
							<div class="row">															
								<div class="col-md-8">
									<p>Eliminar todas las recetas (Editadas, Duplicadas y Nuevas):</p>									
								</div>
								<div class="col-md-4">									
									<a class="btn btn-block btn-danger" href="<?php echo $url_app; ?>eliminar-recetas-propias"> Eliminar Recetas</a>
								</div>
							</div>
							<br /><br />	
							<div class="row">															
								<div class="col-md-8">
									<p>Eliminar todas los alimentos (Editados, Duplicados y Nuevos):</p>									
								</div>
								<div class="col-md-4">									
									<a class="btn btn-block btn-danger"  href="<?php echo $url_app; ?>eliminar-alimentos-propias"> Eliminar Alimentos</a>
								</div>
							</div>
							<br /><br />	
						</div>
					</div>					
					<!-- Fin Restablecer configuracion total -->
				</div>
				<!-- Datos clinica -->
				<form action="<?php echo $url_app; ?>cambiar-configuracion" method="post" enctype="multipart/form-data"> 
				<?php $datos_clinica = datos_clinica(); ?>
				<div class="col-lg-6">
					<div class="ibox float-e-margins">
						<div class="ibox-title">
							<p>Datos de la clínica</p>                      
						</div>
						<div class="ibox-content">						
							<div class="row">															
								<div class="col-md-2">
									Nombre
								</div>								
								<div class="col-md-10">	
									<input type="text" class="form-control" name="clinica_nombre" placeholder="Nombre" required="" value="<?php  if(!empty($datos_clinica['nombre'])){ echo salida_nombre($datos_clinica['nombre']); }?>">
								</div>								
							</div><br/>
							<div class="row">																							
								<div class="col-md-2">
									Dirección
								</div>								
								<div class="col-md-10">	
									<input type="text" class="form-control" name="clinica_direccion" placeholder="Dirección" required="" value="<?php if(!empty($datos_clinica['direccion'])){ echo  salida_nombre($datos_clinica['direccion']); } ?>">
								</div>
							</div><br/>
							<div class="row">															
								<div class="col-md-2">
									Localidad
								</div>								
								<div class="col-md-4">	
									<input type="text" class="form-control" name="clinica_localidad" placeholder="Localidad" required="" value="<?php if(!empty($datos_clinica['localidad'])){ echo salida_nombre($datos_clinica['localidad']); } ?>">
								</div>
								<div class="col-md-2">
									Teléfono
								</div>								
								<div class="col-md-4">	
									<input type="text" class="form-control" name="clinica_telefono" placeholder="Teléfono" required="" value="<?php if(!empty($datos_clinica['telefono'])){  echo $datos_clinica['telefono']; } ?>">
								</div>
							</div><br/><br/><br/><br/><br/><br/>
							<div class="row text-center">									
								<div class="col-md-12">	
									<div class="fileUpload btn btn-success">
										<span>Upload</span>
										
										<input type="file" id="files" name="files[]" class="upload btn btn-sm btn-success" />
										</div><br /><br />
										<?php if($datos_clinica['logo'] == ''){ ?>
											<img id="sin_imagen" alt="image" src="<?php echo $url_app; ?>/img/sin-imagen.jpg" style="width: 50%; height=100%;" >
										<?php }else{ ?>
											<img id="sin_imagen" alt="image" src="<?php echo $url_app; ?>/img/clinicas/<?php  if(!empty($datos_clinica['logo'])){  echo $datos_clinica['logo'];  }else{ echo "sin-imagen.jpg"; } ?> " style="width: 50%; height=100%;" >
										<?php } ?>	
										<output id="list"></output>
										<p>Solo se permiten imágenes en formato JPG</p>	
										<p>Tamaño recomendado: 400px X 400px</p>	
										<input type="hidden" class="form-control" name="imagen_clinica">									
										<script>
										  function archivo(evt) {
											  var files = evt.target.files; // FileList object
										 
											  // Obtenemos la imagen del campo "file".
											  for (var i = 0, f; f = files[i]; i++) {
												//Solo admitimos imágenes.
												if (!f.type.match('image.*')) {
													continue;
												}
										 
												var reader = new FileReader();
										 
												reader.onload = (function(theFile) {
													return function(e) {
													  // Insertamos la imagen
													 document.getElementById("list").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"  style="width: 50%; height=100%;" />'].join('');
													 document.getElementById("sin_imagen").style.display = "none";													 
													};
												})(f);
										 
												reader.readAsDataURL(f);
											  }
										  }
										 
										  document.getElementById('files').addEventListener('change', archivo, false);
										</script>
								</div>
							</div>
							<br /><br /><br /><br />	
							<div class="row text-center">															
								<div class="col-md-3">									
								</div>
								<div class="col-md-6">									
									<button type="submit" class="btn btn-block btn-primary" name="guardar" value="guardar"> Guardar!</button>
								</div>
								<div class="col-md-3">									
								</div>	
							</div>
							<input id="tipo_configuracion" name="tipo_configuracion" type="hidden" value="datos_clinica">	
						</div>
					</div>
				</div>
				</form>
				<!-- Fin de los datos clinica -->
			</div>
			<!-- fin primera parte -->
			<div class="row">				
			</div>
        </div>
			<div class="footer">
                    <?php include_once 'parts/footer.php'; ?>
			</div>
			<?php include_once 'parts/menu_derecho.php'; ?>
        </div>        
    </div>		
	<?php include 'parts/jquery_footer.php'; ?>			
	<?php $conn->close(); ?>
	<script>
	$(document).ready(function () {
		$('#mensajes_footer').modal('show');
	});
	var tamano_fuente;
	var tamano_titulos;
	var color_body;
	var color_titulos;
	
	$("#tamano_fuente").change(function() {
		$('body').css("font-size", $(this).val() + "px");
		tamano_fuente = $(this).val();		
		$("#tamano_fuente_codigo").val(tamano_fuente);		
	});
	$("#tamano_titulo").change(function() {
		$('h2').css("font-size", $(this).val() + "px");	
		tamano_titulos	= $(this).val();		
		$("#tamano_titulo_codigo").val(tamano_titulos);		
	});
	$("#color_fuente").change(function() {
		$(this).val();
		if($(this).val() == 1 ){
			$('p').css("color", "#001");
			$("#color_fuente_codigo").val("#001");
		}
		if($(this).val() == 2 ){
			$('p').css("color", "#1d1d1d");
			$("#color_fuente_codigo").val("#1d1d1d");
		}
		if($(this).val() == 3 ){
			$('p').css("color", "#3f3f3f");
			$("#color_fuente_codigo").val("#3f3f3f");
		}
		if($(this).val() == 4 ){
			$('p').css("color", "#5f5f5f");
			$("#color_fuente_codigo").val("#5f5f5f");
		}
		if($(this).val() == 5 ){
			$('p').css("color", "#676a6c");
			$("#color_fuente_codigo").val("#676a6c");
		}
		if($(this).val() == 6 ){
			$('p').css("color", "#7f7f7f");
			$("#color_fuente_codigo").val("#7f7f7f");
		}		
	});
	$("#color_titulo").change(function() {
		$(this).val();
		if($(this).val() == 1 ){
			$('h2').css("color", "#001");
			$("#color_titulo_codigo").val("#001");
		}
		if($(this).val() == 2 ){
			$('h2').css("color", "#1d1d1d");
			$("#color_titulo_codigo").val("#1d1d1d");
		}
		if($(this).val() == 3 ){
			$('h2').css("color", "#3f3f3f");
			$("#color_titulo_codigo").val("#3f3f3f");
		}
		if($(this).val() == 4 ){
			$('h2').css("color", "#5f5f5f");
			$("#color_titulo_codigo").val("#5f5f5f");
		}
		if($(this).val() == 5 ){
			$('h2').css("color", "#676a6c");
			$("#color_titulo_codigo").val("#676a6c");
		}
		if($(this).val() == 6 ){
			$('h2').css("color", "#7f7f7f");
			$("#color_titulo_codigo").val("#7f7f7f");
		}		
	});
	
	//Tabla
	$("#size_tabla").change(function() {
		$('tabla').css("font-size", $(this).val() + "px");	
	});	
	$("#color_tabla").change(function() {
		$(this).val();
		if($(this).val() == 1 ){
			$('p').css("color", "#001");
			$("#color_tabla_codigo").val("#001");
		}
		if($(this).val() == 2 ){
			$('p').css("color", "#1d1d1d");
			$("#color_tabla_codigo").val("#1d1d1d");
		}
		if($(this).val() == 3 ){
			$('p').css("color", "#3f3f3f");
			$("#color_tabla_codigo").val("#3f3f3f");
		}
		if($(this).val() == 4 ){
			$('p').css("color", "#5f5f5f");
			$("#color_tabla_codigo").val("#5f5f5f");
		}
		if($(this).val() == 5 ){
			$('p').css("color", "#676a6c");
			$("#color_tabla_codigo").val("#676a6c");
		}
		if($(this).val() == 6 ){
			$('p').css("color", "#7f7f7f");
			$("#color_tabla_codigo").val("#7f7f7f");
		}		
	});
	
	</script>
</body>
</html>
