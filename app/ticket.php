<?php
session_start();
require('parts/conex.php');

$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

include_once 'parts/configuracion.php';
include_once 'parts/consultas_mysql.php';
include_once 'parts/ayuda.php';
$pagina = 'Ver ticket';

$ticket    = $_GET['id']; 

?>
	<?php echo header_documento(); ?>
	<link href="<?php echo $url_app; ?>css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="<?php echo $url_app; ?>css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
	<?php include 'parts/header.php'; ?>
	<style>
	.note-editor .btn-group > .btn:not(:first-child):not(:last-child):not(.dropdown-toggle) {		
		display: none;
	}
	.note-editor .btn-group > .btn:last-child:not(:first-child), .note-editor .btn-group > .dropdown-toggle:not(:first-child) {
		display: none;
	}
	.note-editor.note-frame .note-editing-area .note-editable {
		height: 300px;
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
		<!-- Contenido -->		
        <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <?php include_once 'parts/ticket-menu-izquierdo.php'; ?>
                </div>
            </div>
            <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">
				<?php $registros = mostrar_ticket($ticket); ?>
                <h2>
                    <?php echo $pagina; ?> #<?php echo $ticket; ?> - <?php echo $registros[0]['titulo']; ?>
                </h2>
				<?php if($_SESSION['role']  == 'admin' || $_SESSION['role']  == 'Desarrollador') { ?>
				<h2>					
					<?php $buscar_usuario = "WHERE id_usuario = '".$registros[0]['usuario']."'"; ?>
                    <?php $datos_usuario = listado_de_usuarios($buscar_usuario); ?>
					Usuario: <?php echo $datos_usuario[0]['nombre']; ?>
                </h2>				
				<?php } ?>
				<?php for ($i = 0; $i <= count($registros); $i++) { ?>
					<?php if($registros[$i]['fecha'] != '') {?>
						<div class="hr-line-dashed"></div>
						<?php echo '<p><strong>Fecha: </strong>'.$registros[$i]['fecha'].'</p>'; ?>						
						<?php echo '<p><strong>Descripción: </strong>'. html_entity_decode($registros[$i]['descripcion']).'</p>'; ?>						
					<?php } ?>			
				<?php } ?>				
			</div>				
                <div class="mail-box">
				<?php if($registros[0]['status'] != 'Resuelto') { ?>
				<form id="summernoteForm" class="form-horizontal" method="post" action="<?php echo $url_app; ?>insert-ticket-seguimiento" enctype="multipart/form-data">
					<div class="mail-body">					
					<input type="hidden" name="titulo" class="form-control" value="<?php echo $registros[0]['titulo']; ?>" >	
					<input type="hidden" name="ticket" class="form-control" value="<?php echo $ticket; ?>">	
					<div class="form-group"><label class="col-sm-2 control-label">Prioridad:</label>
						<div class="col-sm-10"><select class="form-control m-b" name="prioridad">							
							<option <?php if($registros[0]['prioridad'] == 'Baja') { echo 'selected';}?>>Baja</option>
							<option <?php if($registros[0]['prioridad'] == 'Media') { echo 'selected';}?>>Media</option>
							<option <?php if($registros[0]['prioridad'] == 'Alta') { echo 'selected';}?>>Alta</option>						
						</select>
					</div>
					</div>	
					<div class="form-group"><label class="col-sm-2 control-label">Status:</label>
						<div class="col-sm-10"><select class="form-control m-b" name="status">
							<option <?php if($registros[0]['status'] == 'Pendiente') { echo 'selected';}?>>Pendiente</option>												
							<option <?php if($registros[0]['status'] == 'Resuelto') { echo 'selected';}?>>Resuelto</option>
						</select>
						</div>	
					</div>
					<textarea name="descripcion" rows="4" cols="50" class="summernote" required>
						
					</textarea>                        
						<div class="clearfix"></div>
						<div class="mail-body text-right tooltip-demo">                        
							<a href="<?php echo $url_app; ?>ticket/<?php echo $ticket; ?>" class="btn btn-default"><i class="fa fa-times"></i> Limpiar</a>
							<button class="btn btn-primary" type="submit">Enviar</button>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				</form>
				<?php } ?>
			</div>
        </div>
		</div>
		<!-- fin contenido -->
        <div class="row"><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
            <div class="col-lg-12">                
                <div class="footer">
                    <?php include_once 'parts/footer.php'; ?>
                </div>
            </div>
			<?php include_once 'parts/menu_derecho.php'; ?>
        </div>
        </div>     
    </div>	
	<!-- Mainly scripts -->
    <script src="<?php echo $url_app; ?>js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo $url_app; ?>jjs/bootstrap.min.js"></script>
    <script src="<?php echo $url_app; ?>jjs/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo $url_app; ?>jjs/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo $url_app; ?>jjs/inspinia.js"></script>
    <script src="<?php echo $url_app; ?>jjs/plugins/pace/pace.min.js"></script>

    <!-- iCheck -->
    <script src="<?php echo $url_app; ?>jjs/plugins/iCheck/icheck.min.js"></script>

    <!-- SUMMERNOTE -->
    <script src="<?php echo $url_app; ?>jjs/plugins/summernote/summernote.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.summernote').summernote();	
			$('#mensajes_footer').modal('show');	
        });
    </script>
	<?php $conn->close(); ?>
</body>
</html>
