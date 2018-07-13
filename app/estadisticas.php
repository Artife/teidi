<?php
session_start();
include 'parts/conex.php';
//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include_once 'parts/ayuda.php';
include 'parts/consultas_mysql.php';

$pagina = 'Estadisticas';

//De este array se pueden sacar todos los datos generados de la dieta
// $_SESSION['dd']
// print_r($_SESSION['dd']);


?>

<?php echo header_documento(); ?>
<?php include 'parts/header.php'; ?>
<link href="<?php echo $url_app; ?>css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
<link href="<?php echo $url_app; ?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">
</head>
<style>
body {
    background-image: none;
}
</style>
<body>
<div class="container">
   	<div class="row">	
		<br /><br />
		<div class="col-md-12 text-center"><h1><strong>Estadisticas</strong></h1></div>		
	</div>

<hr style="padding-bottom:80px;">


<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-4">
		<a class="derecha_f" href=""><img src="<?php echo $url_app; ?>img/cabeza.png" style="width:50px; margin-top: 10px; margin-right: 15px;"></a>
		<p class="derecha_f" >Inteligencia artificial<br>
		Predicción del peso<br> 
		tras la dieta <i class="porcentaje_bueno">155.2Kg</i><br>
		</p>
	</div>						
	<div class="col-md-4">
		<p>Porcentaje de acierto</p>
		<p>General <i class="porcentaje_malo">96 %</i></p>
		<p>Calorías <i class="porcentaje_standar">5497 (100% acierto)</i></p>
		<p>Proteínas <i class="porcentaje_standar">22.9% (92.1% acierto)</i></p>
		<p>Hidratos <i class="porcentaje_standar">55.5% (99.5% acierto)</i></p>
		<p>Grasas <i class="porcentaje_standar">21.5% (91.5% acierto)</i></p>
	</div>
	<div class="col-md-2"></div>
</div>
		<br><br><br>
		<div class="row">
			<div class="col-md-6">							
				<h1>Pirámide Nutricional</h1>
				<img src="<?php echo $url_app; ?>img/triangulo.png" style="width:50px; margin-top: 10px; margin-right: 15px;">
				<br>
				<p>Ajuste a Pirámide Nutricional <i class="porcentaje_malo">63 %</i></p>
				<div class="row">
					<div class="col-md-12">ARROZ (1, 2) unidades/semana<br>
					Ajustes por semana:</div>
				</div>														
				<div class="row">
					<div class="col-md-12">
						<?php for ($i = 1; $i <= $total_semanas_sliders; $i++) { ?>
						<?php echo $i.':'; ?>
						<i class="porcentaje_malo">200%</i>	
						&nbsp;
						<?php } ?>
					</div>
				</div>			
				<div class="row">		
					<div class="col-md-12">Porcentaje: <i class="porcentaje_malo">66.67 %</i></div>							
				</div>
				<br><br>
				<!-- 2-->
				<div class="row">
					<div class="col-md-12">PATATAS (1, 2) unidades/semana<br>
					Ajustes por semana:</div>
				</div>	
				<div class="row">
					<div class="col-md-12">
						<?php for ($i = 1; $i <= $total_semanas_sliders; $i++) { ?>
						<?php echo $i.':'; ?>
						<i class="porcentaje_bueno">200%</i>	
						&nbsp;
						<?php } ?>									
					</div>
				</div>
				<div class="row">		
					<div class="col-md-12">Porcentaje: <i class="porcentaje_bueno">66.67 %</i></div>
				</div>
				<br><br>
				<!-- 3-->							
				<div class="row">
					<div class="col-md-12">PESCADO (4, 5) unidades/semana<br>
					Ajustes por semana:</div>
				</div>	
				<div class="row">
					<div class="col-md-12">
						<?php for ($i = 1; $i <= $total_semanas_sliders; $i++) { ?>
						<?php echo $i.':'; ?>
						<i class="porcentaje_bueno">200%</i>	
						&nbsp;
						<?php } ?>
					</div>
				</div>
				<div class="row">		
					<div class="col-md-12">Porcentaje: <i class="porcentaje_bueno">66.67 %</i></div>
				</div>
				<br><br>
				<div class="row">
					<div class="col-md-12">CARNE (3, 4) unidades/semana<br>
					Ajustes por semana:</div>
				</div>	
				<div class="row">
					<div class="col-md-12">
						<?php for ($i = 1; $i <= $total_semanas_sliders; $i++) { ?>
						<?php echo $i.':'; ?>
						<i class="porcentaje_standar">200%</i>	
						&nbsp;
						<?php } ?>									
					</div>
				</div>
				<div class="row">		
					<div class="col-md-12">Porcentaje: <i class="porcentaje_standar">66.67 %</i></div>
				</div>
				<br><br>	
				<div class="row">
					<div class="col-md-12">LACTEOS 3 unidades/día<br>
					Ajustes por día:</div>
				</div>	
				<div class="row">
					<div class="col-md-12">
						<?php for ($i = 1; $i <= $total_dias_dieta; $i++) { ?>
						<?php echo $i.':'; ?>
						<i class="porcentaje_malo"><?php echo rand(10, 200); ?>%</i>	
						&nbsp;
						<?php } ?>									
					</div>
				</div>
				<div class="row">		
					<div class="col-md-12">Porcentaje: <i class="porcentaje_malo">66.67 %</i></div>
				</div>
				<!-- VERDURAS Y HORTALIZAS 2 o más unidades/día -->		
				<br><br>							
				<div class="row">
					<div class="col-md-12">VERDURAS Y HORTALIZAS 2 o más unidades/día<br>
					Ajustes por día:</div>
				</div>	
				<div class="row">
					<div class="col-md-12">
						<?php for ($i = 1; $i <= $total_dias_dieta; $i++) { ?>
						<?php echo $i.':'; ?>
						<i class="porcentaje_malo"><?php echo rand(10, 200); ?>%</i>	
						&nbsp;
						<?php } ?>									
					</div>
				</div>
				<div class="row">		
					<div class="col-md-12">Porcentaje: <i class="porcentaje_malo">66.67 %</i></div>
				</div>
				<!-- FRUTA 3 o más unidades/día -->		
				<br><br>							
				<div class="row">
					<div class="col-md-12">FRUTA 3 o más unidades/día<br>
					Ajustes por día:</div>
				</div>	
				<div class="row">
					<div class="col-md-12">
						<?php for ($i = 1; $i <= $total_dias_dieta; $i++) { ?>
						<?php echo $i.':'; ?>
						<i class="porcentaje_bueno"><?php echo rand(10, 200); ?>%</i>	
						&nbsp;
						<?php } ?>									
					</div>
				</div>
				<div class="row">		
					<div class="col-md-12">Porcentaje: <i class="porcentaje_bueno">66.67 %</i></div>
				</div>
				<!-- LEGUMBRES (2, 3) unidades/semana -->		
				<br><br>							
				<div class="row">
					<div class="col-md-12">LEGUMBRES (2, 3) unidades/semana<br>
					Ajustes por semana:</div>
				</div>	
				<div class="row">
					<div class="col-md-12">
						<?php for ($i = 1; $i <= $total_semanas_sliders; $i++) { ?>
						<?php echo $i.':'; ?>
						<i class="porcentaje_bueno"><?php echo rand(10, 200); ?>%</i>	
						&nbsp;
						<?php } ?>									
					</div>
				</div>
				<div class="row">		
					<div class="col-md-12">Porcentaje: <i class="porcentaje_bueno">66.67 %</i></div>
				</div>
				<!-- HUEVOS (3, 4) unidades/semana -->		
				<br><br>							
				<div class="row">
					<div class="col-md-12">HUEVOS (3, 4) unidades/semana<br>
					Ajustes por semana:</div>
				</div>	
				<div class="row">
					<div class="col-md-12">
						<?php for ($i = 1; $i <= $total_semanas_sliders; $i++) { ?>
						<?php echo $i.':'; ?>
						<i class="porcentaje_bueno"><?php echo rand(10, 200); ?>%</i>	
						&nbsp;
						<?php } ?>									
					</div>
				</div>
				<div class="row">		
					<div class="col-md-12">Porcentaje: <i class="porcentaje_bueno">66.67 %</i></div>
				</div>
				<!-- CARNE (3, 4) unidades/día -->		
				<br><br>							
				<div class="row">
					<div class="col-md-12">CARNE (3, 4) unidades/día<br>
					Ajustes por día:</div>
				</div>	
				<div class="row">
					<div class="col-md-12">
						<?php for ($i = 1; $i <= $total_dias_dieta; $i++) { ?>
						<?php echo $i.':'; ?>
						<i class="porcentaje_standar"><?php echo rand(10, 200); ?>%</i>	
						&nbsp;
						<?php } ?>									
					</div>
				</div>
				<div class="row">		
					<div class="col-md-12">Porcentaje: <i class="porcentaje_bueno">66.67 %</i></div>
				</div>
				<!-- CEREALES (4, 6) unidades/día -->		
				<br><br>							
				<div class="row">
					<div class="col-md-12">CARNE (3, 4) unidades/día<br>
					Ajustes por día:</div>
				</div>	
				<div class="row">
					<div class="col-md-12">
						<?php for ($i = 1; $i <= $total_dias_dieta; $i++) { ?>
						<?php echo $i.':'; ?>
						<i class="porcentaje_bueno"><?php echo rand(10, 200); ?>%</i>	
						&nbsp;
						<?php } ?>									
					</div>
				</div>
				<div class="row">		
					<div class="col-md-12">Porcentaje: <i class="porcentaje_bueno">66.67 %</i></div>
				</div>
			</div>
			<div class="col-md-6">
				<h1>Información nutricional</h1>							
				<!-- Slider -->
				<div id="contenedor_slider_2" class="carousel slide" data-ride="carousel"  data-interval="false">		
				<!-- Wrapper for slides -->
				<div class="carousel-inner">
					<?php  for ($s = 0; $s <= $total_dias_dieta; $s++) { ?>									
					<div class="item <?php if($s == 0){  echo 'active';  }else { }?>"> 
						<h3><?php echo flecha_prev_2 ($s, $total_dias_dieta); ?> de <?php echo flecha_next_2 ($s, $total_dias_dieta); ?></h3>
						
						<?php  
						$total_agua_g = 0;
						$total_hc_g = 0;
						$total_fibra_g = 0;
						$total_prot_g = 0;
						$total_grasa_g = 0;
						$total_col_mg = 0;
						$total_satur_g = 0;
						$total_mono_g = 0;
						$total_poli_g = 0;
						$total_vit_a = 0;
						$total_carotenos = 0;
						$total_vit_b1 = 0;
						$total_vit_b2 = 0;
						$total_niacina = 0;
						$total_ac_panto = 0;
						$total_vit_b6 = 0;
						$total_biotina = 0;
						$total_folico = 0;
						$total_b12 = 0;
						$total_vit_c = 0;
						$total_vit_d = 0;
						$total_tocoferol = 0;
						$total_vit_e = 0;
						$total_vit_k = 0;
						$total_oxalico = 0;
						$total_purinas = 0;
						$total_sodio_mg = 0;
						$total_potasio_mg = 0;
						$total_magnesio_mg = 0;
						$total_calcio_mg = 0;
						$total_fosf_mg = 0;
						$total_hierro_mg = 0;
						$total_cloro_mg = 0;
						$total_cinc_mg = 0;
						$total_cobre_mg = 0;
						$total_manganeso_mg = 0;
						$total_cromo_mg = 0;
						$total_cobalto_mg = 0;
						$total_molibde_mg = 0;
						$total_yodo_mg = 0;
						$total_fluor_mg = 0;
						$total_butirico_c4_0 = 0;
						$total_caproico_c6_0 = 0;
						$total_caprilico_c8_0 = 0;
						$total_caprico_c10_0 = 0;
						$total_laurico_c12_0 = 0;
						$total_miristico_c14_0 = 0;
						$total_c15_0 = 0;
						$total_c15_00 = 0;
						$total_palmitico_c16_0 = 0;
						$total_c17_0 = 0;
						$total_c17_00 = 0;
						$total_estearico_c18_0 = 0;
						$total_araquidi_c20_0 = 0;
						$total_behenico_c22_0 = 0;
						$total_miristol_c14_1 = 0;
						$total_palmitole_c16_1 = 0;
						$total_oleico_c18_1 = 0;
						$total_eicoseno_c20_1 = 0;
						$total_c22_1 = 0;
						$total_linoleico_c18_2 = 0;
						$total_linoleni_c18_3 = 0;
						$total_c18_4 = 0;
						$total_ara_ico_c20_4 = 0;
						$total_c20_5 = 0;
						$total_c22_5 = 0;
						$total_c22_6 = 0;
						$total_otrosatur0 = 0;
						$total_otroinsat0 = 0;
						$total_omega3_0 = 0;

						
						if ($s == 0)
						{$j=$total_dias_dieta;}
						else
						{$j=$s;}
					
					
						for ($i = $s; $i <= $j; $i++) {
							
							foreach ($listado_recetas_completas[$i] as $receta) { 
							$total_agua_g = $total_agua_g + round($receta["agua_g"], 2);
							$total_hc_g = $total_hc_g + round($receta["hc_g"], 2);
							$total_fibra_g = $total_fibra_g + round($receta["fibra_g"], 2);
							$total_prot_g = $total_prot_g + round($receta["prot_g"], 2);
							$total_grasa_g = $total_grasa_g + round($receta["grasa_g"], 2);
							$total_col_mg = $total_col_mg + round($receta["col_mg"], 2);
							$total_satur_g = $total_satur_g + round($receta["satur_g"], 2);
							$total_mono_g = $total_mono_g + round($receta["mono_g"], 2);
							$total_poli_g = $total_poli_g + round($receta["poli_g"], 2);
							$total_vit_a = $total_vit_a + round($receta["vit_a"], 2);
							$total_carotenos = $total_carotenos + round($receta["carotenos"], 2);
							$total_vit_b1 = $total_vit_b1 + round($receta["vit_b1"], 2);
							$total_vit_b2 = $total_vit_b2 + round($receta["vit_b2"], 2);
							$total_niacina = $total_niacina + round($receta["niacina"], 2);
							$total_ac_panto = $total_ac_panto + round($receta["ac_panto"], 2);
							$total_vit_b6 = $total_vit_b6 + round($receta["vit_b6"], 2);
							$total_biotina = $total_biotina + round($receta["biotina"], 2);
							$total_folico = $total_folico + round($receta["folico"], 2);
							$total_b12 = $total_b12 + round($receta["b12"], 2);
							$total_vit_c = $total_vit_c + round($receta["vit_c"], 2);
							$total_vit_d = $total_vit_d + round($receta["vit_d"], 2);
							$total_tocoferol = $total_tocoferol + round($receta["tocoferol"], 2);
							$total_vit_e = $total_vit_e + round($receta["vit_e"], 2);
							$total_vit_k = $total_vit_k + round($receta["vit_k"], 2);
							$total_oxalico = $total_oxalico + round($receta["oxalico"], 2);
							$total_purinas = $total_purinas + round($receta["purinas"], 2);
							$total_sodio_mg = $total_sodio_mg + round($receta["sodio_mg"], 2);
							$total_potasio_mg = $total_potasio_mg + round($receta["potasio_mg"], 2);
							$total_magnesio_mg = $total_magnesio_mg + round($receta["magnesio_mg"], 2);
							$total_calcio_mg = $total_calcio_mg + round($receta["calcio_mg"], 2);
							$total_fosf_mg = $total_fosf_mg + round($receta["fosf_mg"], 2);
							$total_hierro_mg = $total_hierro_mg + round($receta["hierro_mg"], 2);
							$total_cloro_mg = $total_cloro_mg + round($receta["cloro_mg"], 2);
							$total_cinc_mg = $total_cinc_mg + round($receta["cinc_mg"], 2);
							$total_cobre_mg = $total_cobre_mg + round($receta["cobre_mg"], 2);
							$total_manganeso_mg = $total_manganeso_mg + round($receta["manganeso_mg"], 2);
							$total_cromo_mg = $total_cromo_mg + round($receta["cromo_mg"], 2);
							$total_cobalto_mg = $total_cobalto_mg + round($receta["cobalto_mg"], 2);
							$total_molibde_mg = $total_molibde_mg + round($receta["molibde_mg"], 2);
							$total_yodo_mg = $total_yodo_mg + round($receta["yodo_mg"], 2);
							$total_fluor_mg = $total_fluor_mg + round($receta["fluor_mg"], 2);
							$total_butirico_c4_0 = $total_butirico_c4_0 + round($receta["butirico_c4_0"], 2);
							$total_caproico_c6_0 = $total_caproico_c6_0 + round($receta["caproico_c6_0"], 2);
							$total_caprilico_c8_0 = $total_caprilico_c8_0 + round($receta["caprilico_c8_0"], 2);
							$total_caprico_c10_0 = $total_caprico_c10_0 + round($receta["caprico_c10_0"], 2);
							$total_laurico_c12_0 = $total_laurico_c12_0 + round($receta["laurico_c12_0"], 2);
							$total_miristico_c14_0 = $total_miristico_c14_0 + round($receta["miristico_c14_0"], 2);
							$total_c15_0 = $total_c15_0 + round($receta["c15_0"], 2);
							$total_c15_00 = $total_c15_00 + round($receta["c15_00"], 2);
							$total_palmitico_c16_0 = $total_palmitico_c16_0 + round($receta["palmitico_c16_0"], 2);
							$total_c17_0 = $total_c17_0 + round($receta["c17_0"], 2);
							$total_c17_00 = $total_c17_00 + round($receta["c17_00"], 2);
							$total_estearico_c18_0 = $total_estearico_c18_0 + round($receta["estearico_c18_0"], 2);
							$total_araquidi_c20_0 = $total_araquidi_c20_0 + round($receta["araquidi_c20_0"], 2);
							$total_behenico_c22_0 = $total_behenico_c22_0 + round($receta["behenico_c22_0"], 2);
							$total_miristol_c14_1 = $total_miristol_c14_1 + round($receta["miristol_c14_1"], 2);
							$total_palmitole_c16_1 = $total_palmitole_c16_1 + round($receta["palmitole_c16_1"], 2);
							$total_oleico_c18_1 = $total_oleico_c18_1 + round($receta["oleico_c18_1"], 2);
							$total_eicoseno_c20_1 = $total_eicoseno_c20_1 + round($receta["eicoseno_c20_1"], 2);
							$total_c22_1 = $total_c22_1 + round($receta["c22_1"], 2);
							$total_linoleico_c18_2 = $total_linoleico_c18_2 + round($receta["linoleico_c18_2"], 2);
							$total_linoleni_c18_3 = $total_linoleni_c18_3 + round($receta["linoleni_c18_3"], 2);
							$total_c18_4 = $total_c18_4 + round($receta["c18_4"], 2);
							$total_ara_ico_c20_4 = $total_ara_ico_c20_4 + round($receta["ara_ico_c20_4"], 2);
							$total_c20_5 = $total_c20_5 + round($receta["c20_5"], 2);
							$total_c22_5 = $total_c22_5 + round($receta["c22_5"], 2);
							$total_c22_6 = $total_c22_6 + round($receta["c22_6"], 2);
							$total_otrosatur0 = $total_otrosatur0 + round($receta["otrosatur0"], 2);
							$total_otroinsat0 = $total_otroinsat0 + round($receta["otroinsat0"], 2);
							$total_omega3_0 = $total_omega3_0 + round($receta["omega3_0"], 2);
							}
						if ($s == 0){
							$total_agua_g = $total_agua_g / $total_dias_dieta;
							$total_hc_g = $total_hc_g / $total_dias_dieta;
							$total_fibra_g = $total_fibra_g / $total_dias_dieta;
							$total_prot_g = $total_prot_g / $total_dias_dieta;
							$total_grasa_g = $total_grasa_g / $total_dias_dieta;
							$total_col_mg = $total_col_mg / $total_dias_dieta;
							$total_satur_g = $total_satur_g / $total_dias_dieta;
							$total_mono_g = $total_mono_g / $total_dias_dieta;
							$total_poli_g = $total_poli_g / $total_dias_dieta;
							$total_vit_a = $total_vit_a / $total_dias_dieta;
							$total_carotenos = $total_carotenos / $total_dias_dieta;
							$total_vit_b1 = $total_vit_b1 / $total_dias_dieta;
							$total_vit_b2 = $total_vit_b2 / $total_dias_dieta;
							$total_niacina = $total_niacina / $total_dias_dieta;
							$total_ac_panto = $total_ac_panto / $total_dias_dieta;
							$total_vit_b6 = $total_vit_b6 / $total_dias_dieta;
							$total_biotina = $total_biotina / $total_dias_dieta;
							$total_folico = $total_folico / $total_dias_dieta;
							$total_b12 = $total_b12 / $total_dias_dieta;
							$total_vit_c = $total_vit_c / $total_dias_dieta;
							$total_vit_d = $total_vit_d / $total_dias_dieta;
							$total_tocoferol = $total_tocoferol / $total_dias_dieta;
							$total_vit_e = $total_vit_e / $total_dias_dieta;
							$total_vit_k = $total_vit_k / $total_dias_dieta;
							$total_oxalico = $total_oxalico / $total_dias_dieta;
							$total_purinas = $total_purinas / $total_dias_dieta;
							$total_sodio_mg = $total_sodio_mg / $total_dias_dieta;
							$total_potasio_mg = $total_potasio_mg / $total_dias_dieta;
							$total_magnesio_mg = $total_magnesio_mg / $total_dias_dieta;
							$total_calcio_mg = $total_calcio_mg / $total_dias_dieta;
							$total_fosf_mg = $total_fosf_mg / $total_dias_dieta;
							$total_hierro_mg = $total_hierro_mg / $total_dias_dieta;
							$total_cloro_mg = $total_cloro_mg / $total_dias_dieta;
							$total_cinc_mg = $total_cinc_mg / $total_dias_dieta;
							$total_cobre_mg = $total_cobre_mg / $total_dias_dieta;
							$total_manganeso_mg = $total_manganeso_mg / $total_dias_dieta;
							$total_cromo_mg = $total_cromo_mg / $total_dias_dieta;
							$total_cobalto_mg = $total_cobalto_mg / $total_dias_dieta;
							$total_molibde_mg = $total_molibde_mg / $total_dias_dieta;
							$total_yodo_mg = $total_yodo_mg / $total_dias_dieta;
							$total_fluor_mg = $total_fluor_mg / $total_dias_dieta;
							$total_butirico_c4_0 = $total_butirico_c4_0 / $total_dias_dieta;
							$total_caproico_c6_0 = $total_caproico_c6_0 / $total_dias_dieta;
							$total_caprilico_c8_0 = $total_caprilico_c8_0 / $total_dias_dieta;
							$total_caprico_c10_0 = $total_caprico_c10_0 / $total_dias_dieta;
							$total_laurico_c12_0 = $total_laurico_c12_0 / $total_dias_dieta;
							$total_miristico_c14_0 = $total_miristico_c14_0 / $total_dias_dieta;
							$total_c15_0 = $total_c15_0 / $total_dias_dieta;
							$total_c15_00 = $total_c15_00 / $total_dias_dieta;
							$total_palmitico_c16_0 = $total_palmitico_c16_0 / $total_dias_dieta;
							$total_c17_0 = $total_c17_0 / $total_dias_dieta;
							$total_c17_00 = $total_c17_00 / $total_dias_dieta;
							$total_estearico_c18_0 = $total_estearico_c18_0 / $total_dias_dieta;
							$total_araquidi_c20_0 = $total_araquidi_c20_0 / $total_dias_dieta;
							$total_behenico_c22_0 = $total_behenico_c22_0 / $total_dias_dieta;
							$total_miristol_c14_1 = $total_miristol_c14_1 / $total_dias_dieta;
							$total_palmitole_c16_1 = $total_palmitole_c16_1 / $total_dias_dieta;
							$total_oleico_c18_1 = $total_oleico_c18_1 / $total_dias_dieta;
							$total_eicoseno_c20_1 = $total_eicoseno_c20_1 / $total_dias_dieta;
							$total_c22_1 = $total_c22_1 / $total_dias_dieta;
							$total_linoleico_c18_2 = $total_linoleico_c18_2 / $total_dias_dieta;
							$total_linoleni_c18_3 = $total_linoleni_c18_3 / $total_dias_dieta;
							$total_c18_4 = $total_c18_4 / $total_dias_dieta;
							$total_ara_ico_c20_4 = $total_ara_ico_c20_4 / $total_dias_dieta;
							$total_c20_5 = $total_c20_5 / $total_dias_dieta;
							$total_c22_5 = $total_c22_5 / $total_dias_dieta;
							$total_c22_6 = $total_c22_6 / $total_dias_dieta;
							$total_otrosatur0 = $total_otrosatur0 / $total_dias_dieta;
							$total_otroinsat0 = $total_otroinsat0 / $total_dias_dieta;
							$total_omega3_0 = $total_omega3_0 / $total_dias_dieta;
						}
							
						}
						?>
						<?php include 'parts/dieta_informacion_nutricional.php'; ?>
					</div>								
					<?php }  ?>
				</div>
				</div>
				<!-- Fin Slider -->
			</div>
	</div>
</div>		
</body>	
		