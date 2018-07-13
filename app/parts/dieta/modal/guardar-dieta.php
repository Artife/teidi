<!-- Modal guardar Temporal -->
<div id="modal_guardar_temporal" class="modal fade charts-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			<h4 class="modal-title" id="myModalLabel">Guardar Dieta</h4>
		</div>
		<div class="text-center">
			<div class="row" id="div_copiar"> 				
				<div class="col-lg-12">	
					<br /><br />
					<form id="formulario_guardar_dieta" action="#" method="post">						
					<a id="guardar_dieta_temporal" class="btn btn-outline btn-info">Guardar</a>
					<?php if(empty($_POST["usar_plantilla"])){ ?>
					<input type="hidden" id="temporal_plantilla" name="temporal_plantilla" value="no">
					<input type="hidden" id="temporal_id_cliente" name="temporal_id_cliente" value="<?php echo $id_cliente; ?>">
					<input type="hidden" id="temporal_duracion" name="temporal_duracion" value="<?php echo $duracion; ?>">
					<input type="hidden" id="temporal_num_comidas" name="temporal_num_comidas" value="<?php echo $num_comidas; ?>">
					<input type="hidden" id="temporal_platos_comidas" name="temporal_platos_comidas" value="<?php echo $platos_comidas; ?>">
					<input type="hidden" id="temporal_comida_postre" name="temporal_comida_postre" value="<?php echo $comida_postre; ?>">
					<input type="hidden" id="temporal_plato_cena" name="temporal_plato_cena" value="<?php echo $plato_cena; ?>">
					<input type="hidden" id="temporal_cena_postre" name="temporal_cena_postre" value="<?php echo $cena_postre; ?>">
					<input type="hidden" id="temporal_fecha_inicio" name="temporal_fecha_inicio" value="<?php echo $fecha_inicio; ?>">
					<input type="hidden" id="temporal_kilocalorias_dia" name="temporal_kilocalorias_dia" value="<?php echo $kilocalorias_dia; ?>">
					<input type="hidden" id="temporal_grasas_diarias" name="temporal_grasas_diarias" value="<?php echo $grasas_diarias; ?>">
					<input type="hidden" id="temporal_proteinas_diarias" name="temporal_proteinas_diarias" value="<?php echo $proteinas_diarias; ?>">
					<input type="hidden" id="temporal_hidratos_diarios" name="temporal_hidratos_diarios" value="<?php echo $hidratos_diarios; ?>">
					<input type="hidden" id="temporal_limitar_tamano" name="temporal_limitar_tamano" value="<?php echo $limitar_tamano; ?>">
					<input type="hidden" id="temporal_listado_plantillas" name="temporal_listado_plantillas" value="<?php echo $listado_plantillas; ?>">
					<input type="hidden" id="temporal_dieta_plantilla" name="temporal_dieta_plantilla" value="">
					<input type="hidden" id="pdf_input_listado_vertical" name="pdf_input_listado_vertical" value="">	
					<input type="hidden" id="temporal_lista_de_compra" name="temporal_lista_de_compra" value="">	
					<input type="hidden" id="tabla_semana_1" name="tabla_semana_1" value="">						
					<?php } ?>
					</form> 
					<br /><br />
				</div>
			</div>						
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
		</div>    
	</div>
  </div>
</div>
<!-- Fin Modal Guardar Temporal -->	