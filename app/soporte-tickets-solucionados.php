<?php
session_start();
require('parts/conex.php');

$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

include_once 'parts/configuracion.php';
include_once 'parts/consultas_mysql.php';
$pagina = 'Soporte';

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
		<!-- Contenido -->		
        <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-content mailbox-content">
                        <?php include_once 'parts/ticket-menu-izquierdo.php'; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">
                <h2>
                    En espera (<?php echo total_tickets_solucionados(); ?>)
                </h2>
                <div class="mail-tools tooltip-demo m-t-md">                    
                    <button class="btn btn-white btn-sm"><i class="fa fa-trash-o"></i> </button>
                </div>
            </div>
                <div class="mail-box" style="padding-left: 20px; padding-right: 20px;">
					<!-- Table -->
					<table  id="example" class="table table-striped dataTables-example ">
						<thead>
						<tr>
							<th style="width: 30px;">
								<div class="checkbox checkbox-success" style="position: absolute;margin-top: -5px; margin-left: -3px;">
									<input id="checkbox1" type="checkbox" class="marcar_todos">
									<label for="checkbox1"></label>
								</div>
							</th>
							<th class="marcar_todos">Titulo </th>
							<th>Descripción </th>
							<th>Fecha</th>
							<th>Status</th>
							<th>Prioridad</th>
						</tr>
						</thead>
						<tbody>											   
						</tbody>
					</table>
					<?php /*<th><i class="fa fa-paperclip"></i></th> */ ?>
					<!-- Table Fin -->
                </div>
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
		
		//Llamamos los datos de la tabla en segundo plano para que carge mucho mas rapido
        $(document).ready(function(){
			$('#example').DataTable({  
				responsive: true,
				processing: true,
				erverSide: true,								
				ajax: "<?php echo $url_app; ?>crear-archivo-txt-tickets.php?status=Resuelto",
				deferRender:    true,
				scrollCollapse: true,
				scroller:       false,
				serialize:		true,
				iDisplayLength:	3000,
				paging: 		true,				
				'fnCreatedRow': function (nRow, aData, iDataIndex) {
					$(nRow).attr('id', 'my' + iDataIndex); // or whatever you choose to set as the id
				}
			}); 
        });		
		
		//Indice de edicion
		$('#example').on( 'click', 'tr', function () {		  
		    var indice_id = ($(this).attr('id'));	
			$.cookie('indice', indice_id);	
		});
		
		//Marcar checks
		$(".marcar_todos").on("click", function () {
			var marcado = $(this).is(':checked');
			
			if(marcado == true){				
				$('.marcar').prop('checked',true);
				$(".marcar").attr('value', '1');					
			}else{				
				$('.marcar').prop('checked',false);
				$(".marcar").attr('value', '0');				
			}
		});
		
	</script>
	<?php $conn->close(); ?>
</body>
</html>
