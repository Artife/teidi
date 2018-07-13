<!-- Modal Buscar Receta -->
<div id="modal_buscar_receta" class="modal fade" role="dialog" style="overflow:hidden;">
  <div class="modal-dialog modal-lg"> 
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			<h4 class="modal-title" id="myModalLabel">Ver recetas equivalentes</h4>
		</div>
		<br><h1 class="modal-title text-center">Recetas equivalentes</h1><br><br>
		<div class="text-center" style="max-height: 600px; min-height: 400px;">					
			<div class="row">
				<div class="col-md-4"></div>	
				<div class="col-md-4 text-left"><div id="mostrar_receta_equivalente" style="margin: 0px;"></div></div>
				<div class="col-md-4"></div>
			</div><br><br><br>
			<div class="row">
				<div class="col-md-4"></div>	
				<div class="col-md-4 text-center"><a  id="cambiar_nuueva_receta_id" href="#" class="btn btn-w-m btn-guardar">Cambiar Receta</a></div>
				<div class="col-md-4"></div>
			</div>							
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
		</div>    
	</div>
  </div>		
</div>
<style>
.chosen-single{
	width: 300px !important;
}
.chosen-container.chosen-with-drop .chosen-drop{
	width: 300px !important;
}
</style>
<!-- Fin Modal Buscar Receta -->