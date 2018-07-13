<?php
session_start();
include 'parts/conex.php';

$pagina = 'Ver Alimento';
$migas = array('Lista Alimentos');
$migas_url = array('lista-alimentos');

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';

$id = $_GET['id'];

//obtener_alimentos
$datos_alimento = obtener_alimento_por_usuario ($id, $_SESSION['id_usuario']);


$disable = 'disabled';

//Sacar de esta pagina si no eres el creador de este alimento o no tienes acceso a el	
if($datos_alimento['id_usuario'] != NULL){
	if($datos_alimento['id_usuario'] != $_SESSION['id_usuario']){			
		//header('location:'.$url_app.'alimentos-desactivados/');
	
	}		
	//header('location:'.$url_app.'alimentos-desactivados/');
}
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
		<div class="row">
            <div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-content">
						<h1>Datos obligatorios</h1>						
						<br />
						<div class="row">
							<div class="col-md-2">
								<input name="id_alimento" type="hidden" value="<?php echo $datos_alimento['id_alimento'];?>" required>
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-1"> Nombre  </div>
									<div class="col-md-5"><input type="text" placeholder="Nombre" class="input-sm form-control" name="nombre" value="<?php echo $datos_alimento['nombre'];?>" required disabled></div>
									<div class="col-md-1"> Hidratos  </div>
									<div class="col-md-5 sumar_datos">									
										<input id="hidratos_porc" name="hidratos_porc" placeholder="Hidratos" class="touchspin1" type="text" value="<?php echo $datos_alimento['hidratos_porc'];?>" required disabled>
									</div>
								</div>
								<br />
								<div class="row">
									<div class="col-md-1"> Kcal/100g  </div>
									<div class="col-md-5"><input type="number" placeholder="Kcal/100g" class="input-sm form-control" name="kcal_100g" value="<?php echo $datos_alimento['kcal_100g'];?>" required disabled></div>
									<div class="col-md-1"> Proteínas  </div>
									<div class="col-md-5 sumar_datos"><input id="proteinas_porc" type="number" placeholder="Proteínas" class="touchspin2" name="proteinas_porc" value="<?php echo $datos_alimento['proteinas_porc'];?>" min="0" max="100"  required disabled></div>
								</div>
								<br />
								<div class="row">
									<div class="col-md-1"> Grupo  </div>
									<div class="col-md-5">
									<select class="input-sm form-control input-s-sm" style="padding-top:0px;" name="grupo" disabled>										
									<?php echo grupo_de_alimentos_options_select($datos_alimento['grupo']); ?>																			
									</select>
									</div>
									<div class="col-md-1"> Grasas:  </div>
									<div class="col-md-5 sumar_datos"><input id="grasas" type="number" placeholder="Grasa" class="touchspin3" name="grasa_porc" value="<?php echo $datos_alimento['grasa_porc'];?>" min="0" max="100" required disabled></div>
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
								<a href="<?php echo $url_app; ?>lista-alimentos" class="btn btn-w-m btn-atras">Atras</a>								
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
								<input type="text" placeholder="Nombre inglés" class="input-sm form-control" name="nombre_ing" value="<?php echo $datos_alimento['nombre_ing'];?>" <?php echo $disable; ?> required>
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
										 Subgrupo  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="subgrupo" value="<?php echo $datos_alimento['subgrupo'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										PC (%)								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="form-control" name="pc_porcentaje" value="<?php echo $datos_alimento['pc_porcentaje'];?>" <?php echo $disable; ?> required>										
									</div>
									<div class="col-md-2">
										cal (kcal)								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="cal_kcal" value="<?php echo $datos_alimento['cal_kcal'];?>" <?php echo $disable; ?> required>																		
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
										<input type="number" placeholder="0" class="input-sm form-control" name="agua_g" value="<?php echo $datos_alimento['agua_g'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										 Hidratos de carbono, Total (g)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="hc_g" value="<?php echo $datos_alimento['hc_g'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										 Fibra (g)	
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="fibra_g" value="<?php echo $datos_alimento['fibra_g'];?>" <?php echo $disable; ?> required>								
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
										<input type="number" placeholder="0" class="input-sm form-control" name="prot_g" value="<?php echo $datos_alimento['prot_g'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										 Grasas, total (g) 								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="grasa_g" value="<?php echo $datos_alimento['grasa_g'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										 Colesterol (mg)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="col_mg" value="<?php echo $datos_alimento['col_mg'];?>" <?php echo $disable; ?> required>								
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
										<input type="number" placeholder="0" class="input-sm form-control" name="satur_g" value="<?php echo $datos_alimento['satur_g'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										 AGM totales (g)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="mono_g" value="<?php echo $datos_alimento['mono_g'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										 AGP totales (g)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="poli_g" value="<?php echo $datos_alimento['poli_g'];?>" <?php echo $disable; ?> required>								
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
										<input type="number" placeholder="0" class="input-sm form-control" name="vit_a" value="<?php echo $datos_alimento['vit_a'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										 Carotenos (mg) 								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="carotenos" value="<?php echo $datos_alimento['carotenos'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										 Tiamina B1 (mg)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="vit_b1" value="<?php echo $datos_alimento['vit_b1'];?>" <?php echo $disable; ?> required>								
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
										<input type="number" placeholder="0" class="input-sm form-control" name="vit_b2" value="<?php echo $datos_alimento['vit_b2'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										 Niacina B3 (mg)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="niacina" value="<?php echo $datos_alimento['niacina'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										 Ac. Pantoténico B5 (mg)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="ac_panto" value="<?php echo $datos_alimento['ac_panto'];?>" <?php echo $disable; ?> required>								
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
										<input type="number" placeholder="0" class="input-sm form-control" name="vit_b6" value="<?php echo $datos_alimento['vit_b6'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										 Biotina (ug)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="biotina" value="<?php echo $datos_alimento['biotina'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										 Ac. Fólico B9 (ug)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="folico" value="<?php echo $datos_alimento['folico'];?>" <?php echo $disable; ?> required>								
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
										<input type="number" placeholder="0" class="input-sm form-control" name="b12" value="<?php echo $datos_alimento['b12'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										 Vit C (mg)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="vit_c" value="<?php echo $datos_alimento['vit_c'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										 Vit D (ug)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="vit_d" value="<?php echo $datos_alimento['vit_d'];?>" <?php echo $disable; ?> required>								
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
										<input type="number" placeholder="0" class="input-sm form-control" name="tocoferol" value="<?php echo $datos_alimento['tocoferol'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										 Vit E (mg)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="vit_e" value="<?php echo $datos_alimento['vit_e'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										 Vit K (ug)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="vit_k" value="<?php echo $datos_alimento['vit_k'];?>" <?php echo $disable; ?> required>								
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
										<input type="number" placeholder="0" class="input-sm form-control" name="oxalico" value="<?php echo $datos_alimento['oxalico'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										 Purinas (mg)  								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="purinas" value="<?php echo $datos_alimento['purinas'];?>" <?php echo $disable; ?> required>								
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
										<input type="number" placeholder="0" class="input-sm form-control" name="sodio_mg" value="<?php echo $datos_alimento['sodio_mg'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										Potasio (mg)								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="potasio_mg" value="<?php echo $datos_alimento['potasio_mg'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										Magnesio (mg)
									</div>
									<div class="col-md-2">	
										<input type="number" placeholder="0" class="input-sm form-control" name="magnesio_mg" value="<?php echo $datos_alimento['magnesio_mg'];?>" <?php echo $disable; ?> required>
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
										<input type="number" placeholder="0" class="input-sm form-control" name="calcio_mg" value="<?php echo $datos_alimento['calcio_mg'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										Fósforo (mg)							
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="fosf_mg" value="<?php echo $datos_alimento['fosf_mg'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										Hierro (mg)
									</div>
									<div class="col-md-2">	
										<input type="number" placeholder="0" class="input-sm form-control" name="hierro_mg" value="<?php echo $datos_alimento['hierro_mg'];?>" <?php echo $disable; ?> required>
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
										<input type="number" placeholder="0" class="input-sm form-control" name="cloro_mg" value="<?php echo $datos_alimento['cloro_mg'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										Zinc (mg)						
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="cinc_mg" value="<?php echo $datos_alimento['cinc_mg'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										Cobre (ug)
									</div>
									<div class="col-md-2">	
										<input type="number" placeholder="0" class="input-sm form-control" name="cobre_mg" value="<?php echo $datos_alimento['cobre_mg'];?>" <?php echo $disable; ?> required>
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
										<input type="number" placeholder="0" class="input-sm form-control" name="manganeso_mg" value="<?php echo $datos_alimento['manganeso_mg'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										Cromo (mg)						
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="cromo_mg" value="<?php echo $datos_alimento['cromo_mg'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										Cobalto (mg)
									</div>
									<div class="col-md-2">	
										<input type="number" placeholder="0" class="input-sm form-control" name="cobalto_mg" value="<?php echo $datos_alimento['cobalto_mg'];?>" <?php echo $disable; ?> required>
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
										<input type="number" placeholder="0" class="input-sm form-control" name="molibde_mg" value="<?php echo $datos_alimento['molibde_mg'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										Yodo (mg)					
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="yodo_mg" value="<?php echo $datos_alimento['yodo_mg'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										Fluor (ug)
									</div>
									<div class="col-md-2">	
										<input type="number" placeholder="0" class="input-sm form-control" name="fluor_mg" value="<?php echo $datos_alimento['fluor_mg'];?>" <?php echo $disable; ?> required>
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
										<input type="number" placeholder="0" class="input-sm form-control" name="butirico_c4_0" value="<?php echo $datos_alimento['butirico_c4_0'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										Caproico C6:0 (mg)						
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="caproico_c6_0" value="<?php echo $datos_alimento['caproico_c6_0'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										 Caprílico C8:0 (mg)								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="caprilico_c8_0" value="<?php echo $datos_alimento['caprilico_c8_0'];?>" <?php echo $disable; ?> required>								
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
										<input type="number" placeholder="0" class="input-sm form-control" name="caprico_c10_0" value="<?php echo $datos_alimento['caprico_c10_0'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										Lárico C12:0 (mg)					
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="laurico_c12_0" value="<?php echo $datos_alimento['laurico_c12_0'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										Mirístico C14:0 (mg)								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="miristico_c14_0" value="<?php echo $datos_alimento['miristico_c14_0'];?>" <?php echo $disable; ?> required>								
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
										<input type="number" placeholder="0" class="input-sm form-control" name="c15_0" value="<?php echo $datos_alimento['c15_0'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										C15:00 (mg)				
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="c15_00" value="<?php echo $datos_alimento['c15_00'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										Palmítico C16:0 (mg)								
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="palmitico_c16_0" value="<?php echo $datos_alimento['palmitico_c16_0'];?>" <?php echo $disable; ?> required>								
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
										<input type="number" placeholder="0" class="input-sm form-control" name="c17_0" value="<?php echo $datos_alimento['c17_0'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										C17:00 (mg)		
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="c17_00" value="<?php echo $datos_alimento['c17_00'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										Esteárico C18:0 (mg)							
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="estearico_c18_0" value="<?php echo $datos_alimento['estearico_c18_0'];?>" <?php echo $disable; ?> required>								
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
										<input type="number" placeholder="0" class="input-sm form-control" name="araquidi_c20_0" value="<?php echo $datos_alimento['araquidi_c20_0'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										Behénico C22:0 (mg)	
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="behenico_c22_0" value="<?php echo $datos_alimento['behenico_c22_0'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										Miristol C14:1 (mg)							
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="miristol_c14_1" value="<?php echo $datos_alimento['miristol_c14_1'];?>" <?php echo $disable; ?> required>								
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
										<input type="number" placeholder="0" class="input-sm form-control" name="palmitole_c16_1" value="<?php echo $datos_alimento['palmitole_c16_1'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										Oleico C18:1 (mg)
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="oleico_c18_1" value="<?php echo $datos_alimento['oleico_c18_1'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										Eicoseno C20:1 (mg)				
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="eicoseno_c20_1" value="<?php echo $datos_alimento['eicoseno_c20_1'];?>" <?php echo $disable; ?> required>								
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
										<input type="number" placeholder="0" class="input-sm form-control" name="c22_1" value="<?php echo $datos_alimento['c22_1'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										Linoleico C18:2 (mg)
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="linoleico_c18_2" value="<?php echo $datos_alimento['linoleico_c18_2'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										Linolénico C18:3 (mg)			
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="linoleni_c18_3" value="<?php echo $datos_alimento['linoleni_c18_3'];?>" <?php echo $disable; ?> required>								
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
										<input type="number" placeholder="0" class="input-sm form-control" name="c18_4" value="<?php echo $datos_alimento['c18_4'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										Araquidónico C20:4 (mg)
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="ara_ico_c20_4" value="<?php echo $datos_alimento['ara_ico_c20_4'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										C20:5 (mg)			
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="c20_5" value="<?php echo $datos_alimento['c20_5'];?>" <?php echo $disable; ?> required>								
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
										<input type="number" placeholder="0" class="input-sm form-control" name="c22_5" value="<?php echo $datos_alimento['c22_5'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										C22:6 (mg)
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="c22_6" value="<?php echo $datos_alimento['c22_6'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										Otros satura (mg)			
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="otrosatur0" value="<?php echo $datos_alimento['otrosatur0'];?>" <?php echo $disable; ?> required>								
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
										<input type="number" placeholder="0" class="input-sm form-control" name="otroinsat0" value="<?php echo $datos_alimento['otroinsat0'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										Omega 3:0 (mg)
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="omega3_0" value="<?php echo $datos_alimento['omega3_0'];?>" <?php echo $disable; ?> required>								
									</div>
									<div class="col-md-2">
										Etanol (mg)			
									</div>
									<div class="col-md-2">
										<input type="number" placeholder="0" class="input-sm form-control" name="etanol0" value="<?php echo $datos_alimento['etanol0'];?>" <?php echo $disable; ?> required>								
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
								<a href="<?php echo $url_app; ?>lista-alimentos" class="btn btn-w-m btn-atras">Atras</a>								
								</div>
							</div>
						</div>
						<!-- botones de guardar -->							
					</div>
					<!-- Datos Opcionales -->
				</div>
			</div>
			
		</div>		
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
		//cargando
		$(function () {
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
		$(".grupos_alimentos").prop('disabled', true);			
    </script>	
	<?php $conn->close(); ?>	
</body>
</html>
