<!-- Modal Opciones Comida -->
<div id="listado_opciones" class="modal fade charts-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			<h4 class="modal-title" id="myModalLabel">Opciones:</h4>
		</div>
		<div class="text-center">
			<div class="row" id="div_copiar"> 				
				<div class="col-lg-12">
					<button type="button" id="btn_copiar" class="btn btn-outline btn-info">Copiar</button>
				</div>
			</div>
			<div class="row" id="div_pegar"> 				
				<div class="col-lg-12 text-center">
					<button type="button" id="btn_pegar" class="btn btn-outline btn-info">Pegar</button>
				</div>
			</div>
			<div class="row" id="div_aplicar_toda_dieta"> 				
				<div class="col-lg-12">
					<button type="button" id="btn_aplicar_toda_dieta" class="btn btn-outline btn-info">Aplicar a toda la dieta</button>
				</div>
			</div>
			<div class="row" id="div_bloquear_desbloquear"> 				
				<div class="col-lg-12">
					<button type="button" id="btn_bloquear_desbloquear" class="btn btn-outline btn-info">Bloquear/Desbloquear</button>
				</div>
			</div>
			<div class="row" id="div_ver_informacion"> 				
				<div class="col-lg-12">
					<button type="button" id="btn_ver_informacion" class="btn btn-outline btn-info">Ver información de la receta</button>
				</div>
			</div>
			<div class="row" id="div_buscar_plato_equi"> 				
				<div class="col-lg-12">
					<button type="button" id="btn_buscar_plato_equi" class="btn btn-outline btn-info">Buscar receta equivalente</button>
				</div>
			</div>
			<div class="row" id="div_marcar_libre"> 				
				<div class="col-lg-12">
					<button type="button" id="btn_marcar_libre" class="btn btn-outline btn-info">Marcar como libre</button>
				</div>
			</div>
			<div class="row" id="div_modificar_peso"> 				
				<div class="col-lg-12">
					<button type="button" id="btn_modificar_peso" class="btn btn-outline btn-info">Modificar peso de comida</button>
				</div>
			</div>	
			<div class="row" id="div_modificar_peso_input"> 				
				<div class="col-lg-2"></div>
				<div class="col-lg-8 text-center">
					<br/>
					<p>Modificar el peso de esta comida desajustará la ingesta calórica para ese día ¿Desea continuar?</p>							
					<input id="nuevo_peso_input" name="nuevo_peso_input" type="number" class="input_peso input-sm form-control" placeholder="Nuevo peso gr" max="50000" required><br />
					<a  href="#" class="btn btn-w-m btn-atras" style="width: 150px; " data-dismiss="modal" >Cancelar</a> <a id="link_modificar_peso" href="#" class="btn btn-outline btn-info" style="width: 150px; margin-left: 30px; min-width: auto; margin-top: 0px; ">Agregar</a>	
					<br/><br/><br/>
				</div>
				<div class="col-lg-2"></div>
			</div>
			<br><br><br>
		</div>
		<div id="area-example"></div>
		<div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
		</div>    
	</div>
  </div>
</div>
<!-- Fin Modal Opciones Comida -->	