<?php
session_start();
include 'parts/conex.php';

$pagina = 'Modificar Ingestas';
$migas = array('');
$migas_url = array('');

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';

//Si hacen una busqueda avanzada
if(!empty($_POST['alimento'])){
	$alimento = $_POST['alimento'];
}else{
	$alimento = '';

}


?>
	<?php echo header_documento(); ?>
	<?php include 'parts/header.php'; ?>
	<link href="<?php echo $url_app; ?>css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
	<link href="<?php echo $url_app; ?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">
	<link href="<?php echo $url_app; ?>css/plugins/chosen/chosen.css" rel="stylesheet">
	<style> 
	.table-responsive {
		overflow-x: hidden;
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
		<!-- Buscador -->
		<?php /*
		<div class="row">
            <div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-content">
						<div class="row">					
						</div>	
					</div>
				</div>
			</div>
		</div>	
		<!-- Fin buscador -->
		*/ ?>
		<!-- Fin buscador Avanzado -->
        <div class="row">
            <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <div class="ibox-tools">								
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">							
								<table id="example" class="table table-striped dataTables-example select-filter tabla_lista_recetas">
									<thead>
										<tr> 
											<th style="width: 30px;">											
											<div class="checkbox checkbox-success" style="position: absolute;margin-top: -5px; margin-left: -3px;">
												<input id="checkbox1" type="checkbox" class="marcar_todos">
												<label for="checkbox1"></label>
											</div>
											</th>
											<th class="marcar_todos">Nombre</th>											
											<th>Kcal/100g </th>
											<th>%_Hidratos</th>
											<th>% Proteínas</th>
											<th>% Grasas</th>
											<th>Origen</th>
											<th>Ingesta</th>
											<th>Con Error</th>											
										</tr>
									</thead>									
									<tbody>
									</tbody>
								</table>															
                            </div>
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
		//Llamamos los datos de la tabla en segundo plano para que carge mucho mas rapido
        $(document).ready(function(){
			$('#mensajes_footer').modal('show');
		});	
    </script>	
	<?php $conn->close(); ?>
</body>
</html>
