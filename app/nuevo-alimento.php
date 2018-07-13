<?php
session_start();
include 'parts/conex.php';
$pagina = 'Nuevo Alimento';
$migas = array('Lista Alimentos');
$migas_url = array('lista-alimentos');

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';

?>
	<?php echo header_documento(); ?>
	<!-- TouchSpin -->
	<link href="<?php echo $url_app; ?>css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">
	<link href="<?php echo $url_app; ?>css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
	<?php include 'parts/header.php'; ?>	
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
		<form action="<?php echo $url_app; ?>crear-alimento-nuevo" method="post">						
		<div class="row">
            <div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-content">
						<h1>Datos obligatorios</h1>						
						<br />
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-1"> Nombre  </div>
									<div class="col-md-5"><input type="text" placeholder="Nombre" class="input-sm form-control" name="nombre" value="" required></div>
									<div class="col-md-1"> Hidratos  </div>
									<div class="col-md-5 sumar_datos">									
										<input id="hidratos_porc" name="hidratos_porc" placeholder="Hidratos" class="touchspin1" type="text" value="0" required>
									</div>
								</div>
								<br />
								<div class="row">
									<div class="col-md-1"> Kcal/100g  </div>
									<div class="col-md-5"><input type="number" placeholder="Kcal/100g" class="input-sm form-control" name="kcal_100g" value="0" required></div>
									<div class="col-md-1"> Proteínas  </div>
									<div class="col-md-5 sumar_datos"><input id="proteinas_porc" type="number" placeholder="Proteínas" class="touchspin2" name="proteinas_porc" value="0" min="0" max="100"  required></div>
								</div>
								<br />
								<div class="row">
									<div class="col-md-1"> Grupo  </div>
									<div class="col-md-5">
									<select class="input-sm form-control input-s-sm" style="padding-top:0px;" name="grupo">										
									<?php echo grupo_de_alimentos_options(''); ?>																			
									</select>
									</div>
									<div class="col-md-1"> Grasas:  </div>
									<div class="col-md-5 sumar_datos"><input id="grasas" type="number" placeholder="Grasa" class="touchspin3" name="grasa_porc" value="0" min="0" max="100" required></div>
								</div>
							</div>
							<div class="col-md-2">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 text-center"><br /><br />
								<div class="form-group text-center">
									 * La suma de Hidratos, Proteínas y Grasas debe dar 100 
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">								
								<div class="form-group text-center">
								<a href="<?php echo $url_app; ?>lista-alimentos" class="btn btn-w-m btn-primary">Atras</a>
								<button id="guardar_alimento" type="submit" class="btn btn-w-m btn-primary" title="La suma de Hidratos, Proteínas y Grasas debe dar 100" disabled>Guardar</button>
								</div>
							</div>
						</div>
						<!-- Super Grupo -->		
						<div class="ibox-content">	
						<div class="row">
							<div class="col-md-2"></div>
							<div class="col-md-8">															
								<h1>Super Grupo</h1>
								<div class="row margin_top_receta">
									<?php echo gx_input_supergrupos($id); ?>			
								</div>
							</div>
							</div>
							<div class="col-md-2"></div>
						</div>
						<!-- Super Grupo -->	
					</div>
					<!-- Datos Opcionales -->
					<div class="ibox-content">
						<h1>Datos opcionales</h1>							
						<form action="<?php echo $url_app; ?>lista-alimentos" method="post">
						<br />
						<div class="row">
							<div class="col-md-2">								
							</div>
							<div class="col-md-4" style="width: auto;">
								<strong style="color: #732f76;">General  </strong>
							</div>	
							<div class="col-md-4">								
							</div>
							<div class="col-md-2">
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-4" style="width: auto;">
								 Nombre inglés  
							</div>	
							<div class="col-md-4">
								<input type="text" placeholder="Nombre inglés" class="input-sm form-control" name="nombre_ing" value="Sin nombre" required>
							</div>
							<div class="col-md-2">
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-2" style="display:none;">
										 Subgrupo  								
									</div>
									<div class="col-md-2" style="display:none;">
										<input type="number" placeholder="0" class="input-sm form-control" name="subgrupo" value="0" required>								
									</div>
									<div class="col-md-2">
										PC (%)								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="form-control" name="pc_porcentaje" value="0" required>										
									</div>
									<div class="col-md-2">
										cal (kcal)								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="cal_kcal" value="0" required>																		
									</div>
								</div>
							</div>	
							<div class="col-md-2">
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-2">
										 Agua (g)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="agua_g" value="0" required>								
									</div>
									<div class="col-md-2">
										 Hidratos de carbono, Total (g)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="hc_g" value="0" required>								
									</div>
									<div class="col-md-2">
										 Fibra (g)	
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="fibra_g" value="0" required>								
									</div>
								</div>
							</div>	
							<div class="col-md-2">
							</div>
						</div>	
						<br />
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-2">
										 Proteínas, total (g)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="prot_g" value="0" required>								
									</div>
									<div class="col-md-2">
										 Grasas, total (g) 								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="grasa_g" value="0" required>								
									</div>
									<div class="col-md-2">
										 Colesterol (mg)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="col_mg" value="0" required>								
									</div>
								</div>
							</div>	
							<div class="col-md-2">
							</div>
						</div>	
						<br />
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-2">
										 AGS totales (g)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="satur_g" value="0" required>								
									</div>
									<div class="col-md-2">
										 AGM totales (g)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="mono_g" value="0" required>								
									</div>
									<div class="col-md-2">
										 AGP totales (g)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="poli_g" value="0" required>								
									</div>
								</div>
							</div>	
							<div class="col-md-2">
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-md-2">								
							</div>
							<div class="col-md-4" style="width: auto;">
								 <strong style="color: #732f76;">Vitaminas y otros </strong>  
							</div>	
							<div class="col-md-4">								
							</div>
							<div class="col-md-2">
							</div>
						</div>	
						<br />
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-2">
										 Vit A (ug) 								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="vit_a" value="0" required>								
									</div>
									<div class="col-md-2">
										 Carotenos (mg) 								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="carotenos" value="0" required>								
									</div>
									<div class="col-md-2">
										 Tiamina B1 (mg)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="vit_b1" value="0" required>								
									</div>
								</div>
							</div>	
							<div class="col-md-2">
							</div>
						</div>	
						<br />
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-2">
										 Riboflavina B2 (mg)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="vit_b2" value="0" required>								
									</div>
									<div class="col-md-2">
										 Niacina B3 (mg)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="niacina" value="0" required>								
									</div>
									<div class="col-md-2">
										 Ac. Pantoténico B5 (mg)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="ac_panto" value="0" required>								
									</div>
								</div>
							</div>	
							<div class="col-md-2">
							</div>
						</div>	
						<br />
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-2">
										 Piridoxina B6 (mg)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="vit_b6" value="0" required>								
									</div>
									<div class="col-md-2">
										 Biotina (ug)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="biotina" value="0" required>								
									</div>
									<div class="col-md-2">
										 Ac. Fólico B9 (ug)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="folico" value="0" required>								
									</div>
								</div>
							</div>	
							<div class="col-md-2">
							</div>
						</div>	
						<br />
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-2">
										 Cobalamina B12 (ug) 								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="b12" value="0" required>								
									</div>
									<div class="col-md-2">
										 Vit C (mg)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="vit_c" value="0" required>								
									</div>
									<div class="col-md-2">
										 Vit D (ug)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="vit_d" value="0" required>								
									</div>
								</div>
							</div>	
							<div class="col-md-2">
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-2">
										 Tocoferol (mg)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="tocoferol" value="0" required>								
									</div>
									<div class="col-md-2">
										 Vit E (mg)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="vit_e" value="0" required>								
									</div>
									<div class="col-md-2">
										 Vit K (ug)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="vit_k" value="0" required>								
									</div>
								</div>
							</div>	
							<div class="col-md-2">
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-2">
										 Oxálico (ug) 								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="oxalico" value="0" required>								
									</div>
									<div class="col-md-2">
										 Purinas (mg)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="purinas" value="0" required>								
									</div>
									<div class="col-md-2">										
									</div>
									<div class="col-md-2">										
									</div>
								</div>
							</div>	
							<div class="col-md-2">
							</div>
						</div>
						<!-- Minerales -->
						<br />
						<div class="row">
							<div class="col-md-2">								
							</div>
							<div class="col-md-4" style="width: auto;">
								 <strong style="color: #732f76;">Minerales </strong>  
							</div>	
							<div class="col-md-4">								
							</div>
							<div class="col-md-2">
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-2">
										Sodio (mg) 								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="sodio_mg" value="0" required>								
									</div>
									<div class="col-md-2">
										Potasio (mg)								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="potasio_mg" value="0" required>								
									</div>
									<div class="col-md-2">
										Magnesio (mg)
									</div>
									<div class="col-md-2">	
										<input type="number" placeholder="0" class="input-sm form-control" name="magnesio_mg" value="0" required>
									</div>
								</div>
							</div>	
							<div class="col-md-2">
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-2">
										Calcio (mg)						
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="calcio_mg" value="0" required>								
									</div>
									<div class="col-md-2">
										Fósforo (mg)							
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="fosf_mg" value="0" required>								
									</div>
									<div class="col-md-2">
										Hierro (mg)
									</div>
									<div class="col-md-2">	
										<input type="number" placeholder="0" class="input-sm form-control" name="hierro_mg" value="0" required>
									</div>
								</div>
							</div>	
							<div class="col-md-2">
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-2">
										Cloro (mg)					
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="cloro_mg" value="0" required>								
									</div>
									<div class="col-md-2">
										Zinc (mg)						
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="cinc_mg" value="0" required>								
									</div>
									<div class="col-md-2">
										Cobre (ug)
									</div>
									<div class="col-md-2">	
										<input type="number" placeholder="0" class="input-sm form-control" name="cobre_mg" value="0" required>
									</div>
								</div>
							</div>	
							<div class="col-md-2">
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-2">
										Manganeso (ug)					
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="manganeso_mg" value="0" required>								
									</div>
									<div class="col-md-2">
										Cromo (mg)						
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="cromo_mg" value="0" required>								
									</div>
									<div class="col-md-2">
										Cobalto (mg)
									</div>
									<div class="col-md-2">	
										<input type="number" placeholder="0" class="input-sm form-control" name="cobalto_mg" value="0" required>
									</div>
								</div>
							</div>	
							<div class="col-md-2">
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-2">
										Molibde (mg)					
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="molibde_mg" value="0" required>								
									</div>
									<div class="col-md-2">
										Yodo (mg)					
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="yodo_mg" value="0" required>								
									</div>
									<div class="col-md-2">
										Fluor (ug)
									</div>
									<div class="col-md-2">	
										<input type="number" placeholder="0" class="input-sm form-control" name="fluor_mg" value="0" required>
									</div>
								</div>
							</div>	
							<div class="col-md-2">
							</div>
						</div>
						<!-- Ácidos grasos -->
						<br />
						<div class="row">
							<div class="col-md-2">								
							</div>
							<div class="col-md-4" style="width: auto;">
								 <strong style="color: #732f76;">Ácidos grasos </strong>  
							</div>	
							<div class="col-md-4">								
							</div>
							<div class="col-md-2">
							</div>
						</div>	
						<br />
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-2">
										 Butírico C4:0 (mg)								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="butirico_c4_0" value="0" required>								
									</div>
									<div class="col-md-2">
										Caproico C6:0 (mg)						
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="caproico_c6_0" value="0" required>								
									</div>
									<div class="col-md-2">
										 Caprílico C8:0 (mg)								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="caprilico_c8_0" value="0" required>								
									</div>
								</div>
							</div>	
							<div class="col-md-2">
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-2">
										Cáprico C10:0 (mg)							
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="caprico_c10_0" value="0" required>								
									</div>
									<div class="col-md-2">
										Lárico C12:0 (mg)					
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="laurico_c12_0" value="0" required>								
									</div>
									<div class="col-md-2">
										Mirístico C14:0 (mg)								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="miristico_c14_0" value="0" required>								
									</div>
								</div>
							</div>	
							<div class="col-md-2">
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-2">
										C15:0 (mg)							
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="c15_0" value="0" required>								
									</div>
									<div class="col-md-2">
										C15:00 (mg)				
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="c15_00" value="0" required>								
									</div>
									<div class="col-md-2">
										Palmítico C16:0 (mg)								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="palmitico_c16_0" value="0" required>								
									</div>
								</div>
							</div>	
							<div class="col-md-2">
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-2">
										C17:0 (mg)							
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="c17_0" value="0" required>								
									</div>
									<div class="col-md-2">
										C17:00 (mg)		
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="c17_00" value="0" required>								
									</div>
									<div class="col-md-2">
										Esteárico C18:0 (mg)							
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="estearico_c18_0" value="0" required>								
									</div>
								</div>
							</div>	
							<div class="col-md-2">
							</div>
						</div>
						<br />	
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-2">
										Araquídico C20:0 (mg)							
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="araquidi_c20_0" value="0" required>								
									</div>
									<div class="col-md-2">
										Behénico C22:0 (mg)	
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="behenico_c22_0" value="0" required>								
									</div>
									<div class="col-md-2">
										Miristol C14:1 (mg)							
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="miristol_c14_1" value="0" required>								
									</div>
								</div>
							</div>	
							<div class="col-md-2">
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-2">
										Palmitole C16:1 (mg)							
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="palmitole_c16_1" value="0" required>								
									</div>
									<div class="col-md-2">
										Oleico C18:1 (mg)
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="oleico_c18_1" value="0" required>								
									</div>
									<div class="col-md-2">
										Eicoseno C20:1 (mg)				
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="eicoseno_c20_1" value="0" required>								
									</div>
								</div>
							</div>	
							<div class="col-md-2">
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-2">
										C22:1 (mg)						
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="c22_1" value="0" required>								
									</div>
									<div class="col-md-2">
										Linoleico C18:2 (mg)
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="linoleico_c18_2" value="0" required>								
									</div>
									<div class="col-md-2">
										Linolénico C18:3 (mg)			
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="linoleni_c18_3" value="0" required>								
									</div>
								</div>
							</div>	
							<div class="col-md-2">
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-2">
										C18:4 (mg)					
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="c18_4" value="0" required>								
									</div>
									<div class="col-md-2">
										Araquidónico C20:4 (mg)
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="ara_ico_c20_4" value="0" required>								
									</div>
									<div class="col-md-2">
										C20:5 (mg)			
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="c20_5" value="0" required>								
									</div>
								</div>
							</div>	
							<div class="col-md-2">
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-2">
										C22:5 (mg)					
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="c22_5" value="0" required>								
									</div>
									<div class="col-md-2">
										C22:6 (mg)
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="c22_6" value="0" required>								
									</div>
									<div class="col-md-2">
										Otros satura (mg)			
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="otrosatur0" value="0" required>								
									</div>
								</div>
							</div>	
							<div class="col-md-2">
							</div>
						</div>
						<br />	
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-2">
										Otros insatura (mg)					
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="otroinsat0" value="0" required>								
									</div>
									<div class="col-md-2">
										Omega 3:0 (mg)
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="omega3_0" value="0" required>								
									</div>
									<div class="col-md-2">
										Etanol (mg)			
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="etanol0" value="0" required>								
									</div>
								</div>
							</div>	
							<div class="col-md-2">
							</div>
						</div>
						<br />
						<!-- botones de guardar -->
						<div class="row">
							<div class="col-md-12">								
								<div class="form-group text-center">
								<a href="<?php echo $url_app; ?>lista-alimentos" class="btn btn-w-m btn-primary">Atras</a>
								<button id="guardar_alimento2" type="submit" class="btn btn-w-m btn-primary" title="La suma de Hidratos, Proteínas y Grasas debe dar 100" disabled>Guardar</button>
								</div>
							</div>
						</div>
						<!-- botones de guardar -->	
						</form> 
					</div>
					<!-- Datos Opcionales -->
				</div>
			</div>
			
		</div>
		</form>	
		<!-- Fin buscador -->        
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
	<!-- TouchSpin -->
    <script src="<?php echo $url_app; ?>js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>
	<script>
		//Llamamos los datos de la tabla en segundo plano para que carge mucho mas rapido
        $(document).ready(function(){
			$('#mensajes_footer').modal('show');
			$(".touchspin1, .touchspin2, .touchspin3").TouchSpin({
				min: 0,
				max: 100,
				step: 1,
				decimals: 0,
				boostat: 5,
				maxboostedstep: 10,
				postfix: '%',
				buttondown_class: 'btn btn-white',
				buttonup_class: 'btn btn-white'
			});
			$(".touchspin4").TouchSpin({
				min: 0,
				max: 100,
				step: 1,
				decimals: 0,
				boostat: 5,
				maxboostedstep: 10,
				postfix: '%'
			});	
        });	
		var sum = 0;
		$('.sumar_datos').on("focus blur change", function() 
		{
			var a =parseInt($("#hidratos_porc").val());
			var b =parseInt($("#proteinas_porc").val());	
			var c =parseInt($("#grasas").val());
			var sum = a + b + c;
			if(sum == 100){
				$("#guardar_alimento").prop('disabled', false);				
				$("#guardar_alimento2").prop('disabled', false);				
			}else{
				$("#guardar_alimento").prop('disabled', true);			
				$("#guardar_alimento2").prop('disabled', true);			
			}
		});		
    </script>	
	<?php $conn->close(); ?>
</body>
</html>
