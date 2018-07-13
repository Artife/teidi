<?php
session_start();
include 'parts/conex.php';
$pagina = 'Desactivar Alimentos';
$migas = array('');
$migas_url = array('');

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';

//Revisar si no se encuentra en ninguna receta para no mostrar esta pagina
foreach($_POST as $campo => $valor) {				
	if($campo != 'accion' AND $campo !='example_length')	{		
		if(is_numeric($campo)) { 
			$alimentos = obtener_los_alimentos_que_estan_en_uso ($campo);		
		}
	}
} 
$total_recetas_encontradas = count($alimentos);
if($total_recetas_encontradas == 1 AND empty($alimentos)){
	foreach($_POST as $campo => $valor) {				
		if($campo != 'accion' and $campo !='example_length')	{	
			accion_desactivar ($campo);
		}
	}	
	$_SESSION['total_alimentos_desactivados_por_cliente_array'] = gx_todas_los_alimentos_desactivadas_por_el_usuario();
	$_SESSION['total_alimentos_desactivados_por_cliente_sql'] = gx_todas_los_alimentos_desactivadas_por_el_usuario_sql();
	$_SESSION['mensaje'] = 'desactivar_alimentos';
	header('location:'.$url_app.'lista-alimentos');
}


?>
	<?php echo header_documento(); ?>
	<?php include 'parts/header.php'; ?>
	<link href="<?php echo $url_app; ?>css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
	<link href="<?php echo $url_app; ?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">
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
		<div class="wrapper wrapper-content">			
        <div class="row">
		<form id="mover" action="<?php echo $url_app; ?>desactivar-alimentos-update" method="post">				
            <div class="col-lg-12">
                    <div class="ibox float-e-margins">                        
                        <div class="ibox-content">
                            <div class="table-responsive text-center">	
								<h4>¿Esta seguro que desea desactivar estos alimentos?</h4>								
								<br><br><br>
						<div class="col-md-12">								
							<div class="form-group text-center">
							<a href="<?php echo $url_app; ?>lista-alimentos" class="btn btn-w-m btn-atras">Atras</a>
							<button type="submit" class="btn btn-w-m btn-primary" title="Desactivar Recetas">Desactivar</button>
							</div>
						</div>	
								<?php $contador = 0; ?>
								<?php //Obtener el historial de pesos por clientes ?>
								<?php foreach($_POST as $campo => $valor) { ?>						
								<?php if($campo != 'accion' and $campo !='example_length')	{  ?>
								<input id="<?php echo $campo; ?>" name="<?php echo $campo; ?>" type="hidden" value="<?php echo $campo; ?>">
								<?php $alimentos = obtener_los_alimentos_que_estan_en_uso ($campo); ?> 
								<?php for ($i = 0; $i <= count($alimentos); $i++) { ?>
									<?php if(!empty($alimentos[$i]['id_alimento']) AND $i == 0){ ?>										
											<p>El alimento: <strong><?php echo utf8_encode($alimentos[$i]['alimento']); ?></strong> Se encuentra en: <strong><?php echo count($alimentos); ?></strong> recetas </p>											
											<?php $contador++; ?>
											<?php } ?>
										<?php } ?>
									<?php }  ?>
								<?php } ?>
                            </div>							
						</div>
					</div>
			</div>
		</form>	
		</div>
		</div>
                <div class="footer">
					<?php if($total_recetas_encontradas == 1 AND empty($alimentos)){ }else{ ?>
                    <?php include_once 'parts/footer.php'; ?>
					<?php } ?>
                </div>
            </div>
			<?php include_once 'parts/menu_derecho.php'; ?>
        </div>
        </div>      
    </div>	
	<?php include 'parts/jquery_footer.php'; ?>	
	<script src="<?php echo $url_app; ?>js/plugins/dataTables/datatables.min.js"></script>
	<script>
        $(document).ready(function(){			
			var total_registros = <?php echo $contador; ?>;
			if(total_registros == 0){
				//$('#mover').submit();
			}
        });	
    </script>	
	<?php $conn->close(); ?>
</body>
</html>
