<!-- Modal guardar plantilla -->
<div id="modal_guardar_plantilla" class="modal fade charts-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			<h4 class="modal-title" id="myModalLabel">Guardar Plantilla Dieta</h4>
		</div>
		<div class="text-center">
			<div class="row" id="div_copiar"> 				
				<div class="col-lg-12">	
					<br /><br />
					<form id="formulario_guardar_plantilla_dieta" action="#" method="post">	
					<div class="row">	
						<div class="col-lg-4"></div>	
						<div class="col-lg-4"><input type="text" class="input-sm form-control" id="p_nombre" name="p_nombre" value="" placeholder="Nombre de la plantilla" required>	
						<div id="mensaje_guardar_plantilla"></div>
						<br><br><br></div>
						<div class="col-lg-4"></div>	
					</div>	
					<a id="guardar_plantilla_dieta_temporal" class="btn btn-outline btn-info">Guardar</a>					
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
<!-- Fin Modal Guardar plantilla -->