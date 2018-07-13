<?php
session_start();
include 'parts/conex.php';

$pagina = 'Cambiar contraseña';
$migas = array('');
$migas_url = array('');

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';


?>
	<?php echo header_documento(); ?>
	<?php include 'parts/header.php'; ?>
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
					<div class="ibox-title">
						Introduzca la nueva contraseña                      
					</div>
					<div class="ibox-content">
					<!-- formulario nuevo usuario -->
					<div class="row">							
					<form method="post" class="form-horizontal" action="<?php echo $url_app; ?>update-password">
						<div class="col-lg-12">
							<div class="form-group"><label class="col-sm-5 control-label">Contraseña Actual</label>
								<div class="col-sm-3"><input type="password"  name="pass_actual" placeholder="Contraseña Actual" class="form-control" required></div>
							</div>				
							<div class="form-group"><label class="col-sm-5 control-label">Contraseña Nueva</label>
								<div class="col-sm-3"><input type="password"  name="pass_nuevo" placeholder="Contraseña Nueva" class="form-control" maxlength="10" required></div>
							</div>
							<div class="form-group"><label class="col-sm-5 control-label">Repetir Contraseña</label>
								<div class="col-sm-3"><input type="password"  name="repetir_pass_nuevo" placeholder="Repetir Contraseña" class="form-control" maxlength="10" required></div>
							</div>
							<div class="form-group text-center">
							<br /><br /><br />
							<button type="submit" class="btn btn-w-m btn-primary">Actualizar!</button>
							</div>
						</div>            							
					</form>
					<!-- formulario nuevo usuario -->
					</div>
					</div>
				</div>
			</div>
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
	</script>
</body>
</html>
