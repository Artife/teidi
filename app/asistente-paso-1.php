<?php
session_start();
include 'parts/conex.php';

$pagina = 'Asistente de generación de dieta paso 1';
$migas = array('');
$migas_url = array('');

//Solo permitir acceso a estos roles
//$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';


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
						<form action="<?php echo $url_app; ?>asistente-paso-2" method="post">
							<p class="text-center"><img src="<?php echo $url_app; ?>img/paso_1.png" style="width:370px;" /></p>
                            <div class="row">		
								<div class="col-md-4"></div>
								<div class="col-md-4 text-left"><h2>Nombre del Cliente: </h2> 														
									<select data-placeholder="Buscar cliente..." class="chosen-select" style="width:100%" tabindex="2" name="id_cliente">										
									<?php echo gx_selecct_clientes(); ?>
									</select>
								</div>
								<div class="col-md-4"></div>								
							</div>	
							<br><br><br>
							<div class="row">
								<div class="col-md-4"></div>	
								<div class="col-md-4">
									<div class="form-group text-center">
										<a href="<?php echo $url_app; ?>crear-cliente-asistente" class="btn btn-w-m btn-atras">Crear nuevo cliente</a>
										<button type="submit" class="btn btn-w-m btn-primary" title="La suma de Hidratos, Proteínas y Grasas debe dar 100">Seleccionar cliente existente</button>
									</div>	
								</div>
								<div class="col-md-4"></div>	
							</div>
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
	<script src="<?php echo $url_app; ?>js/plugins/chosen/chosen.jquery.js"></script>
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
		
		 var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:"100%"}
                }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }	
    </script>
	<?php $conn->close(); ?>
	
</body>
</html>

