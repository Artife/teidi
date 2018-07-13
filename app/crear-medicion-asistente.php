<?php
session_start();
include 'parts/conex.php';

$pagina = 'Crear medición paso 3';
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
	.boton_mediciones{
		color: #81d742;
		font-size: 40px;
		position: absolute;
		right: 38px;
		top: 20px;
		cursor:pointer;
	}
	.boton_mediciones:hover, .boton_grafico:hover{
		color: #5ea728;
	} 
	.med_inputs{
		min-width: 180px;
		text-align: left;
	}	
	.nav > li.active > a {
		color: #772E71;
		border-left: 0px solid #ffffff;
		background: #81d742;
		color: white;
	}	
	.nav > li.active {
		border-left: 0px solid #ffffff;
		background: #efefef;
	}
	.nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover {
		color: #fff;
		background-color: #81d742;
	}
	input{
		text-align: right;
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
            <div class="col-lg-12">
			<div class="ibox float-e-margins" style="min-height: 800px;">						                        
                        <div class="ibox-content">
		<form action="<?php echo $url_app; ?>guardar-nueva-medicion-asistente" method="post">
						<h2 class="modal-title text-center">Mediciones de cliente</h2>
				<br /><br />
				<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">	
				<ul  class="nav nav-pills">
					<li class="active">
						<a  href="#1a" data-toggle="tab">Bia</a>
					</li>
					<li>
						<a href="#2a" data-toggle="tab">Ultrasonidos</a>
					</li>
					<li>
						<a href="#3a" data-toggle="tab">Infrarrojos</a>
					</li>
					<li>
						<a href="#4a" data-toggle="tab">Plicometría</a>
					</li>
					<li>
						<a href="#5a" data-toggle="tab">Perímetros</a>
					</li>
				</ul>
				</div>
				<div class="col-md-3"></div>
				</div>		
					<div class="tab-content clearfix">
						<div class="tab-pane active" id="1a">
							<div class="row">
								<div class="col-md-4"></div>
								<div class="col-md-3">							
									<br /><br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Grasa</span><input type="number" placeholder="Grasa" class="form-control" name="bia_porc_grasa" step="0.25" value="0"  required><span class="input-group-addon">%</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Grasa Total</span><input  type="number" placeholder="Grasa Total" class="form-control" name="bia_grasa_total" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Masa Grasa Total</span><input type="number" placeholder="Masa Grasa Total" class="form-control" name="bia_masa_grasa_total" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Agua Total</span><input type="number" placeholder="Agua Total" class="form-control" name="bia_agua_total" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Agua Intracelular</span><input type="number" placeholder="Agua Intracelular" class="form-control" name="bia_agua_intracelular" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Agua Extracelular</span><input type="number" placeholder="Agua Extracelular" class="form-control" name="bia_agua_extracelular" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Masa Magra</span><input type="number" placeholder="Masa Magra" class="form-control" name="bia_porc_masa_magra" step="0.25" value="0"  required><span class="input-group-addon">%</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Masa Muscular Total</span><input type="number" placeholder="Masa Muscular Total" class="form-control" name="bia_masa_muscular_total" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Músculo Brazo Dcho</span><input type="number" placeholder="Músculo Brazo Dcho" class="form-control" name="bia_musc_brazo_dcho" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Músculo Brazo Izdo</span><input type="number" placeholder="Músculo Brazo Izdo" class="form-control" name="bia_musc_brazo_izdo" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Tronco</span><input type="number" placeholder="Tronco" class="form-control" name="bia_tronco" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Pierna Derecha</span><input type="number" placeholder="Pierna Derecha" class="form-control" name="bia_pierna_dcha" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Pierna Izquierda</span><input type="number" placeholder="Pierna Izquierda" class="form-control" name="bia_pierna_izda" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Grasa Visceral</span><input type="number" placeholder="Grasa Visceral" class="form-control" name="bia_grasa_visceral" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
								</div>
								<div class="col-md-5"></div>
							</div>	
						</div>
						<div class="tab-pane" id="2a">
							<div class="row">
								<div class="col-md-4"></div>
								<div class="col-md-3">							
									<br /><br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Grasa</span><input type="number" placeholder="Grasa" class="form-control" name="ultrasonidos_grasa" step="0.25" value="0"  required><span class="input-group-addon">%</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Grasa Total</span><input  type="number" placeholder="Grasa Total" class="form-control" name="ultrasonidos_grasa_total" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Masa Magra Total</span><input type="number" placeholder="Masa Grasa Total" class="form-control" name="ultrasonidos_masa_magra" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>									
								</div>
								<div class="col-md-5"></div>
							</div>	
						</div>
						<div class="tab-pane" id="3a">
							<div class="row">
								<div class="col-md-4"></div>
								<div class="col-md-3">							
									<br /><br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Grasa</span><input type="number" placeholder="Grasa" class="form-control" name="infrarrojos_grasa" step="0.25" value="0"  required><span class="input-group-addon">%</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Grasa Total</span><input  type="number" placeholder="Grasa Total" class="form-control" name="infrarrojos_grasa_total" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Masa Magra Total</span><input type="number" placeholder="Masa Grasa Total" class="form-control" name="infrarrojos_masa_magra" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>									
								</div>
								<div class="col-md-5"></div>
							</div>	
						</div>
						<div class="tab-pane" id="4a">
							<div class="row">
								<div class="col-md-4"></div>
								<div class="col-md-3">							
									<br /><br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Tricipital</span><input type="number" placeholder="Tricipital" class="form-control" name="plico_tricipital" step="0.25" value="0"  required><span class="input-group-addon">mm</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Bicipital</span><input  type="number" placeholder="Bicipital" class="form-control" name="plico_bicipital" step="0.25" value="0"  required><span class="input-group-addon">mm</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Subescapular</span><input type="number" placeholder="Subescapular" class="form-control" name="plico_subescapular" step="0.25" value="0"  required><span class="input-group-addon">mm</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Suprailíaco</span><input type="number" placeholder="Suprailíaco" class="form-control" name="plico_suprailiaco" step="0.25" value="0"  required><span class="input-group-addon">mm</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Abdominal</span><input type="number" placeholder="Abdominal" class="form-control" name="plico_abdominal" step="0.25" value="0"  required><span class="input-group-addon">mm</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Pectoral</span><input type="number" placeholder="Pectoral" class="form-control" name="plico_pectoral" step="0.25" value="0"  required><span class="input-group-addon">mm</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Medioaxilar</span><input type="number" placeholder="Medioaxilar" class="form-control" name="plico_medioaxiliar" step="0.25" value="0"  required><span class="input-group-addon">mm</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Muslo</span><input type="number" placeholder="Muslo" class="form-control" name="plico_muslo" step="0.25" value="0"  required><span class="input-group-addon">mm</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Pantorrilla</span><input type="number" placeholder="Pantorrilla" class="form-control" name="plico_pantorrilla" step="0.25" value="0"  required><span class="input-group-addon">mm</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Suma Pliegues</span><input type="number" placeholder="Suma Pliegues" class="form-control" name="plico_suma_pliegues" step="0.25" value="0"  required><span class="input-group-addon"></span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Grasa</span><input type="number" placeholder="Grasa" class="form-control" name="plico_porc_grasa" step="0.25" value="0"  required><span class="input-group-addon">%</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Total Grasa</span><input type="number" placeholder="Total Grasa" class="form-control" name="plico_total_grasa" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Total Masa Magra</span><input type="number" placeholder="Total Masa Magra" class="form-control" name="plico_masa_grasa" step="0.25" value="0"  required><span class="input-group-addon">kg</span></div>
									<br />
									<div class="input-group m-b"><span class="input-group-addon med_inputs">Densidad</span><input type="number" placeholder="Densidad" class="form-control" name="plico_densidad" step="0.25" value="0"  required><span class="input-group-addon"></span></div>
								</div>
								<div class="col-md-5"></div>
							</div>	
						</div>
				<div class="tab-pane" id="5a">
					<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-3">							
							<br /><br />
							<div class="input-group m-b"><span class="input-group-addon med_inputs">Cefálico</span><input type="number" placeholder="Cefálico" class="form-control" name="perimetro_cefalico" step="0.25" value="0"  required><span class="input-group-addon">cm</span></div>
							<br />
							<div class="input-group m-b"><span class="input-group-addon med_inputs">Cuello</span><input  type="number" placeholder="Cuello" class="form-control" name="perimetro_cuello" step="0.25" value="0"  required><span class="input-group-addon">cm</span></div>
							<br />
							<div class="input-group m-b"><span class="input-group-addon med_inputs">Mesoesternal</span><input type="number" placeholder="Mesoesternal" class="form-control" name="perimetro_mesoesternal" step="0.25" value="0"  required><span class="input-group-addon">cm</span></div>
							<br />
							<div class="input-group m-b"><span class="input-group-addon med_inputs">Brazo contraído</span><input type="number" placeholder="Brazo contraído" class="form-control" name="perimetro_brazo_contraido" step="0.25" value="0"  required><span class="input-group-addon">cm</span></div>
							<br />
							<div class="input-group m-b"><span class="input-group-addon med_inputs">Brazo relajado</span><input type="number" placeholder="Brazo relajado" class="form-control" name="perimetro_brazo_relajado" step="0.25" value="0"  required><span class="input-group-addon">cm</span></div>
							<br />
							<div class="input-group m-b"><span class="input-group-addon med_inputs">Antebrazo</span><input type="number" placeholder="Antebrazo" class="form-control" name="perimetro_antebrazo" step="0.25" value="0"  required><span class="input-group-addon">cm</span></div>
							<br />
							<div class="input-group m-b"><span class="input-group-addon med_inputs">Muñeca</span><input type="number" placeholder="Muñeca" class="form-control" name="perimetro_muneca" step="0.25" value="0"  required><span class="input-group-addon">cm</span></div>
							<br />
							<div class="input-group m-b"><span class="input-group-addon med_inputs">Cintura</span><input type="number" placeholder="Cintura" class="form-control" name="perimetro_cintura" step="0.25" value="0"  required><span class="input-group-addon">cm</span></div>
							<br />
							<div class="input-group m-b"><span class="input-group-addon med_inputs">Cadera</span><input type="number" placeholder="Cadera" class="form-control" name="perimetro_cadera" step="0.25" value="0"  required><span class="input-group-addon">cm</span></div>
							<br />
							<div class="input-group m-b"><span class="input-group-addon med_inputs">Muslo</span><input type="number" placeholder="Muslo" class="form-control" name="perimetro_muslo" step="0.25" value="0"  required><span class="input-group-addon">cm</span></div>
							<br />
							<div class="input-group m-b"><span class="input-group-addon med_inputs">Pantorrilla</span><input type="number" placeholder="Pantorrilla" class="form-control" name="perimetro_pantorrilla" step="0.25" value="0"  required><span class="input-group-addon">cm</span></div>
							<br />
							<div class="input-group m-b"><span class="input-group-addon med_inputs">Tobillo</span><input type="number" placeholder="Tobillo" class="form-control" name="perimetro_tobillo" step="0.25" value="0"  required><span class="input-group-addon">cm</span></div>									
						</div>
						<div class="col-md-5"></div>
					</div>	
				</div>
		</div>
		<div class="row">
			<br /><br /><br />
			<div class="col-md-12 text-center"><button type="submit" class="btn btn-w-m btn-primary" title="">Siguiente</button></div>
		</div>
		</div></div>
		<input type="hidden" id="id_cliente" name="id_cliente" value="<?php echo $id_cliente; ?>">			
		</form>			
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

