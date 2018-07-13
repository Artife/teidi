<?php
session_start();
include 'parts/conex.php';
$pagina = 'Dieta';
$migas = array('Lista Clientes');
$migas_url = array('lista-clientes');

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';

$id_cliente = $_POST["cliente_id"];

include 'parts/dieta/consultas-iniciales.php';

?>
	<?php echo header_documento(); ?>
	<?php include 'parts/header.php'; ?>		
	<link href="<?php echo $url_app; ?>css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
	<link href="<?php echo $url_app; ?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">
	<link href="<?php echo $url_app; ?>css/plugins/chosen/chosen.css" rel="stylesheet">	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
</head>
<body class="<?php echo crear_textos_amigables($pagina); ?> dieta-calendario">
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <?php include_once 'parts/menu_izquierdo.php'; ?>
        </nav>
        <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
        <?php include_once 'parts/menu_top.php'; ?>
        </div>
			<div class="row wrapper border-bottom white-bg page-heading">
			<?php echo migas_de_pan($pagina.' '.date('d/m/Y'), $migas, $migas_url, ''); ?>                
            </div>
		<div class="wrapper wrapper-content" style="padding-bottom: 0px;">	
		<!-- Buscador -->
		<div id="respuesta"></div>
		<form id="formulario_completo" action="<?php echo vinculo('dieta'); ?>" method="post">						
		<div class="row"> 				
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5><strong>Cliente:</strong> <?php echo $cliente['apellidos'].', '.$cliente['nombre']; ?> </h5>	
						<div class="ibox-tools">
							<a id="vinculo_actualizar_dieta" href="#" title="Generar nueva dieta">
								<i class="fa fa-refresh" aria-hidden="true"></i>
                            </a>
                            <a id="vinculo_guardar_dieta" href="#" title="Guardar dieta">
								<i class="fa fa-floppy-o" aria-hidden="true"></i>
                            </a>
                            <a id="vinculo_guardar_plantilla_dieta" href="#" title="Guardar plantilla">
								<i class="fa fa-address-card-o" aria-hidden="true"></i>
                            </a>
                            <a id="vinculo_imprimir_dieta" href="#" title="Imprimir dieta">
								<i class="fa fa-print" aria-hidden="true"></i>
                            </a>
                            <a  id="vinculo_enviar_correo" href="#" title="Enviar dieta por correo">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                            </a>
                        </div>
					</div>					
																
					<div id="dieta_calendario_ext">
					</div>					
					<!-- fin contenedor del slider -->					
				</div>
			</div>		
		</form>					
		<!-- Fin buscador --> 
		<!-- Modal Opciones Comida -->
		<?php include_once 'parts/dieta/modal/opciones-dieta.php'; ?>
		<!-- Fin Modal Opciones Comida -->	
		<!-- Modal guardar plantilla -->
		<?php include_once 'parts/dieta/modal/guardar-plantilla.php'; ?>
		<!-- Fin Modal Guardar plantilla -->
		<!-- Modal Buscar Receta -->
		<?php include_once 'parts/dieta/modal/buscar-receta.php'; ?>
		<!-- Fin Modal Buscar Receta -->
		<!-- Modal Enviar Correo -->	
		<?php include_once 'parts/dieta/modal/enviar-correo.php'; ?>
		<!-- Fin Modal Enviar Correo -->	
		<!-- Modal PDF -->
		<?php include_once 'parts/dieta/modal/pdf.php'; ?>
		<!-- Fin  Modal PDF -->
		<!-- Modal ver informacion plato -->
		<?php include_once 'parts/dieta/modal/ver-informacion-plato.php'; ?>
		<!-- Fin Modal ver iniformacion plato -->	
                <div class="footer">
					<?php if($error == 'no'){ ?>	
                    <?php include_once 'parts/footer.php'; ?>
					<?php } ?>	
                </div>
		</div>
			<!-- Triangulo -->
			<div id="contenedor_triangulo" class="wrapper wrapper-content">	
				
			</div><br><br><br>
			<!-- Fin Triangulo -->
			<?php include_once 'parts/menu_derecho.php'; ?>
        </div>
        </div> 		
    </div>	
	</div></div>		
	<?php include 'parts/jquery_footer.php'; ?>
	<script src="<?php echo $url_app; ?>js/plugins/dataTables/datatables.min.js"></script>			
	<script src="<?php echo $url_app; ?>js/plugins/chosen/chosen.jquery.js"></script>	
	<?php include 'js/idiet.php'; ?>	
	<?php $conn->close(); ?>
</body>
</html> 