<?php
session_start();
require('parts/conex.php');

$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

include_once 'parts/configuracion.php';
include_once 'parts/consultas_mysql.php';
include_once 'parts/ayuda.php';
$pagina = 'Soporte';

$mensaje    = substr($_GET['mensaje'], 5);  

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
                <h2>
                    Crear ticket
                </h2>
            </div>
                <div class="mail-box">
				<form id="summernoteForm" class="form-horizontal" method="post" action="<?php echo $url_app; ?>insert-ticket" enctype="multipart/form-data">
					<div class="mail-body">				
					<div class="form-group"><label class="col-sm-2 control-label">Titulo:</label>
						<div class="col-sm-10"><input type="text" name="titulo" class="form-control" value="" placeholder="Titulo" required></div>
					</div>
					<br />
					<div class="form-group"><label class="col-sm-2 control-label">Prioridad:</label>
						<div class="col-sm-10"><select class="form-control m-b" name="prioridad">
							<option>Baja</option>
							<option>Media</option>
							<option>Alta</option>						
						</select>
					</div>
					</div>	
					<div class="form-group"><label class="col-sm-2 control-label">Status:</label>						
						<div class="col-sm-10">
							<input type="text" name="status" class="form-control" value="Pendiente" placeholder="status" readonly required>
						</div>	
					</div>
					<br />
					<textarea name="descripcion" rows="4" cols="50" class="summernote" placeholder="Asunto" required>
						
					</textarea>                        
						<div class="clearfix"></div>
						<div class="mail-body text-right tooltip-demo">                        
							<a href="<?php echo $url_app; ?>crear-ticket<?php echo $ticket; ?>" class="btn btn-default"><i class="fa fa-times"></i> Limpiar</a>
							<button class="btn btn-primary" type="submit">Enviar</button>
						</div>
						<div class="clearfix"></div>
					</div>
					</div>
				</form>
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
