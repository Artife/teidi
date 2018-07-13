<?php
session_start();
include 'parts/conex.php';

$pagina = 'Asistente de generación de dieta paso 2';
$migas = array('');
$migas_url = array('');

//Solo permitir acceso a estos roles
//$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';

$id_cliente = $_POST['id_cliente'];
if(empty($id_cliente)){
	$id_cliente = $_GET['id'];
}
?>
	<?php echo header_documento(); ?>
	<?php include 'parts/header.php'; ?>
	<link href="<?php echo $url_app; ?>css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
	<link href="<?php echo $url_app; ?>css/plugins/chosen/chosen.css" rel="stylesheet">
	<style>
	.table-responsive {
		overflow-x: hidden;
	}	
	.dropdown-menu>li>a.configurar_dieta, .dropdown-menu>li>a.historial_pesos, .dropdown-menu>li>a.mediciones{
		display:none;
	}
	.configurar_dieta, #vinculo_desactivar_cliente, #vinculo_dietas_cliente, #vinculo_desactivar_cliente_divider {
		display:none; 
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
        <div class="row">
            <div class="col-lg-12">
                    <div class="ibox float-e-margins">						                        
                        <div class="ibox-content">
						<form action="<?php echo $url_app; ?>asistente-paso-3" method="post">
							<p class="text-center"><img src="<?php echo $url_app; ?>img/paso_2.png" style="width:370px;" /></p>
                            <div class="row">		
								<div class="col-md-4"></div>
								<div class="col-md-4 text-left"><h2>Selecciona la medición: </h2> 	
									 <div class="radio radio-success">
									<input type="radio" id="no_crear_medicion" name="medicion" value="no" checked="">
									<label for="no_crear_medicion">
										No crear medición
									</label>
								</div>
								<div class="radio radio-success">
									<input type="radio" id="no_crear_medicion_2" name="medicion" value="si">
									<label for="no_crear_medicion_2">
										Crear nueva medición
									</label>
								</div>		
								</div>
								<div class="col-md-4"></div>								
							</div>	
							<br><br><br>
							<div class="row">
								<div class="col-md-4"></div>	
								<div class="col-md-4">
									<div class="form-group text-center">										
										<button type="submit" class="btn btn-w-m btn-primary" title="">Siguiente</button>
									</div>	
								</div>
								<div class="col-md-4"></div>	
							</div>
						<input type="hidden" id="id_cliente" name="id_cliente" value="<?php echo $id_cliente; ?>">	
						</form>			
						</div>
					</div>
			</div>
		</div>
		</div>
                <div class="footer"> 
                    <?php include_once 'parts/footer.php'; ?>
                </div>
            </div>
			<?php include_once 'parts/menu_derecho.php'; ?>
        </div>
        </div>     
    </div>
	<?php include 'parts/jquery_footer.php'; ?>
	<script src="<?php echo $url_app; ?>js/plugins/dataTables/datatables.min.js"></script>	
	<script>
		//Flecha para subir		
		$("#subir-top").fadeOut();
		$(window).scroll(function(){			
			var windowHeight = $(window).scrollTop();
			var contenido2 = $(".ibox-title").offset();
			contenido2 = contenido2.top;			
				if(windowHeight >= contenido2  ){
				 $("#subir-top").fadeIn("fast");					
				}else{
				 $("#subir-top").fadeOut("fast");				 
			}
		});			
		
    </script>
	<?php $conn->close(); ?>
	
</body>
</html>

