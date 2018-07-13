<h1 class="tc_azul">ESTADO Y NECESIDADES DEL PACIENTE</h1>
	<p><strong>Nombre del paciente:</strong> <?php echo $cliente['nombre'].' '.$cliente['apellidos']; ?><br />
	<strong>Fecha de nacimiento:</strong> <?php echo $cliente['fecha_nacimiento']; ?><br />
	<strong>Peso:</strong> <?php echo $cliente['peso']; ?>Kg<br />
	<strong>Altura:</strong> <?php echo $cliente['altura']; ?>cm<br />
	<strong>Actividad física:</strong> <?php echo $cliente['actividad']; ?><br />
	<p><strong>Índice de masa corporal:</strong> <?php echo $cliente['imcf']; ?></p>
	<p></p>				
	<?php if(count($historial_pesos_grafico) >= 2){  ?>
		<h2>Historial de pesos</h2>
		<img src="<?php echo $url_app; ?>pdf-completo/generar-grafico-de-barras.php?id=<?php echo $id_cliente; ?>" />	
		<br /><br />	
	<?php } ?>			
	<h2>Necesidades energéticas</h2>
	<strong>Metabolismo basal: </strong> <?php echo $cliente['metabolismo']; ?><br />
	<strong>Consumo por actividad física: </strong> <?php echo ($cliente['gasto_energetico'] - $cliente['metabolismo']); ?>  calorías diarias<br />
	<strong>Necesita en total  <?php echo $cliente['gasto_energetico']; ?> calorías para mantener su peso actual</strong></p>	
	
	<h2>Exclusiones realizadas</h2>
	<div class="contenido_texto">	
	<p><strong>Grupos de alimentos: </strong>
	<?php

		if(count($grupos_excludios) >= 1){
			for ($i = 0; $i <= $total_grupos; $i++) {
				if(!empty($grupos_alimentos[$i]['id_grupo'])){
					if (in_array($grupos_alimentos[$i]['id_grupo'], $grupos_excludios)) {
						echo $estados_y_necedidades = utf8_encode($grupos_alimentos[$i]['grupo']).', ';
					}
				}
			}
		}  
		?>
	</p></div>						
	<div class="contenido_texto">
	<p><strong>Alimentos: </strong>
		<?php 
		for ($i = 0; $i <= $total_alimentos; $i++) {							
				if(!empty($alimentos_activos[$i]['id_definitivo'])){											
					if (in_array($alimentos_activos[$i]['id_definitivo'],  $alimentos_excluidos)) {								
						echo $estados_y_necedidades = utf8_encode($alimentos_activos[$i]['nombre']).', ';							
					}
				}
			}  ?>	
	</p>			
	</div> 
	<div class="contenido_texto">
	<p><strong>Última medición: </strong></p>			
		<?php if(!empty($historial_pesos)){
			if(!empty($historial_pesos["bia_porc_grasa"])) { echo 'Bia Grasa: '.$historial_pesos["bia_porc_grasa"].'%<<br />'; }
			if(!empty($historial_pesos["bia_grasa_total"])) { echo 'Bia Grasa Total: '.$historial_pesos["bia_grasa_total"].'kg<br />'; }
			if(!empty($historial_pesos["bia_masa_grasa_total"])) { echo 'Bia Masa Grasa Total: '.$historial_pesos["bia_masa_grasa_total"].'kg<br />'; }
			if(!empty($historial_pesos["bia_agua_total"])) { echo 'Bia Agua Total: '.$historial_pesos["bia_agua_total"].'kg</p>'; }
			if(!empty($historial_pesos["bia_agua_intracelular"])) { echo 'Bia Agua Intracelular: '.$historial_pesos["bia_agua_intracelular"].'kg<br />'; }
			if(!empty($historial_pesos["bia_agua_extracelular"])) { echo 'Bia Agua Extracelular: '.$historial_pesos["bia_agua_extracelular"].'kg<br />'; }					
			if(!empty($historial_pesos["bia_porc_masa_magra"])) { echo 'Bia Masa Magra: '.$historial_pesos["bia_porc_masa_magra"].'kg</p>'; }
			if(!empty($historial_pesos["bia_masa_muscular_total"])) { echo 'Bia Masa Muscular Total: '.$historial_pesos["bia_masa_muscular_total"].'kg<br />'; }
			if(!empty($historial_pesos["bia_musc_brazo_dcho"])) { echo 'Bia Músculo Brazo Dcho: '.$historial_pesos["bia_musc_brazo_dcho"].'kg<br />'; }
			if(!empty($historial_pesos["bia_musc_brazo_izdo"])) { echo 'Bia Músculo Brazo Izdo: '.$historial_pesos["bia_musc_brazo_izdo"].'kg<br />'; }
			if(!empty($historial_pesos["bia_tronco"])) { echo 'Bia Tronco: '.$historial_pesos["bia_tronco"].'</p>'; }
			if(!empty($historial_pesos["bia_pierna_dcha"])) { echo 'Bia Pierna Derecha: '.$historial_pesos["bia_pierna_dcha"].'kg<br />'; }
			if(!empty($historial_pesos["bia_pierna_izda"])) { echo 'Bia Pierna Izquierda: '.$historial_pesos["bia_pierna_izda"].'kg<br />'; }
			if(!empty($historial_pesos["bia_grasa_visceral"])) { echo 'Bia Grasa Visceral: '.$historial_pesos["bia_grasa_visceral"].'kg<br /><br />'; }
			
			if(!empty($historial_pesos["perimetro_cefalico"])) { echo 'Perímetro Cefálico: '.$historial_pesos["perimetro_cefalico"].'%<br />'; }
			if(!empty($historial_pesos["perimetro_cuello"])) { echo 'Perímetro Cuello: '.$historial_pesos["perimetro_cuello"].'kg<br />'; }
			if(!empty($historial_pesos["perimetro_mesoesternal"])) { echo 'Perímetro Mesoesternal: '.$historial_pesos["perimetro_mesoesternal"].'kg<br />'; }
			if(!empty($historial_pesos["perimetro_brazo_contraido"])) { echo 'Perímetro Brazo contraído: '.$historial_pesos["perimetro_brazo_contraido"].'kg<br />'; }
			if(!empty($historial_pesos["perimetro_brazo_relajado"])) { echo 'Perímetro Brazo relajado: '.$historial_pesos["perimetro_brazo_relajado"].'kg<br />'; }
			if(!empty($historial_pesos["perimetro_antebrazo"])) { echo 'Perímetro Antebrazo: '.$historial_pesos["perimetro_antebrazo"].'kg<br />'; }
			if(!empty($historial_pesos["perimetro_muneca"])) { echo 'Perímetro Muñeca: '.$historial_pesos["perimetro_muneca"].'kg<br />'; }
			if(!empty($historial_pesos["perimetro_cadera"])) { echo 'Perímetro Cadera: '.$historial_pesos["perimetro_cadera"].'kg<br />'; }
			if(!empty($historial_pesos["perimetro_cintura"])) { echo 'Perímetro Cintura: '.$historial_pesos["perimetro_cintura"].'kg<br />'; }
			if(!empty($historial_pesos["perimetro_muslo"])) { echo 'Perímetro Muslo: '.$historial_pesos["perimetro_muslo"].'<br />'; }
			if(!empty($historial_pesos["perimetro_pantorrilla"])) { echo 'Perímetro Pantorrilla: '.$historial_pesos["perimetro_pantorrilla"].'kg<br />'; }
			if(!empty($historial_pesos["perimetro_tobillo"])) { echo 'Perímetro Tobillo: '.$historial_pesos["perimetro_tobillo"].'kg<br /><br />'; }
			
			if(!empty($historial_pesos["ultrasonidos_grasa"])) { echo 'Ultrasonidos Grasa: '.$historial_pesos["ultrasonidos_grasa"].'%<br />'; }
			if(!empty($historial_pesos["ultrasonidos_grasa_total"])) { echo 'Ultrasonidos Grasa Total: '.$historial_pesos["ultrasonidos_grasa_total"].'kg<br />'; }
			if(!empty($historial_pesos["ultrasonidos_masa_magra"])) { echo 'Ultrasonidos Masa Magra Total: '.$historial_pesos["ultrasonidos_masa_magra"].'kg<br />'; }
			if(!empty($historial_pesos["infrarrojos_grasa"])) { echo 'Infrarrojos Grasa: '.$historial_pesos["infrarrojos_grasa"].'<br />'; }
			if(!empty($historial_pesos["infrarrojos_grasa_total"])) { echo 'Infrarrojos Grasa Total: '.$historial_pesos["infrarrojos_grasa_total"].'<br />'; }
			if(!empty($historial_pesos["infrarrojos_masa_magra"])) { echo 'Infrarrojos Masa Magra Total: '.$historial_pesos["infrarrojos_masa_magra"].'<br />'; }
			if(!empty($historial_pesos["plico_tricipital"])) { echo '<p>Plicometría Tricipital: '.$historial_pesos["plico_tricipital"].'</p>'; }
			if(!empty($historial_pesos["plico_bicipital"])) { echo '<p>Plicometría Bicipital: '.$historial_pesos["plico_bicipital"].'</p>'; }
			if(!empty($historial_pesos["plico_subescapular"])) { echo '<p>Plicometría Subescapular: '.$historial_pesos["plico_subescapular"].'</p>'; }
			if(!empty($historial_pesos["plico_suprailiaco"])) { echo '<p>Plicometría Suprailíaco: '.$historial_pesos["plico_suprailiaco"].'</p>'; }
			if(!empty($historial_pesos["plico_abdominal"])) { echo '<p>Plicometría Abdominal: '.$historial_pesos["plico_abdominal"].'</p>'; }
			if(!empty($historial_pesos["plico_pectoral"])) { echo '<p>Plicometría Pectoral: '.$historial_pesos["plico_pectoral"].'</p>'; }
			if(!empty($historial_pesos["plico_medioaxiliar"])) { echo '<p>Plicometría Medioaxilar: '.$historial_pesos["plico_medioaxiliar"].'</p>'; }
			if(!empty($historial_pesos["plico_muslo"])) { echo '<p>Plicometría Muslo: '.$historial_pesos["plico_muslo"].'</p>'; }
			if(!empty($historial_pesos["plico_pantorrilla"])) { echo '<p>Plicometría Pantorrilla: '.$historial_pesos["plico_pantorrilla"].'</p>'; }
			if(!empty($historial_pesos["plico_suma_pliegues"])) { echo '<p>Plicometría Suma Pliegues: '.$historial_pesos["plico_suma_pliegues"].'</p>'; }
			if(!empty($historial_pesos["plico_porc_grasa"])) { echo '<p>Plicometría Grasa: '.$historial_pesos["plico_porc_grasa"].'</p>'; }
			if(!empty($historial_pesos["plico_total_grasa"])) { echo '<p>Plicometría Total Grasa: '.$historial_pesos["plico_total_grasa"].'</p>'; }
			if(!empty($historial_pesos["plico_masa_grasa"])) { echo '<p>Plicometría Total Masa Magra: '.$historial_pesos["plico_masa_grasa"].'</p>'; }
			if(!empty($historial_pesos["plico_densidad"])) { echo '<p>Plicometría Densidad: '.$historial_pesos["plico_densidad"].'</p>'; }					
		}
	?>							
	</div> 