<!-- Modal PDF -->
<div id="modal_pdf" class="modal fade" role="dialog" style="overflow:hidden;">
<form id="formuario_pdf_avanzado" action="<?php echo $url_app; ?>dieta-avanzada-pdf/" target="_blank" method="post">
  <div class="modal-dialog modal-lg"> 
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			<h4 class="modal-title" id="myModalLabel">Opciones impresión</h4>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-10">
				<h1>Opciones de impresión:</h1>
				<br><br>
				<h3><a style="color:#772e71;" href="<?php echo $url_app; ?>dieta-pdf/<?php echo $id_cliente; ?>" target="_blank">&squf; <strong>Estándar</strong> (Estado del paciente, Dieta con recetas, Tabla resumen y Lista de la compra)</a></h3>
				<br><br>
				<h3><a style="color:#772e71;" id="mostrar_pdf_avanzado" href="#">&squf; <strong>Avanzada:</strong></a></h3>						
			</div>	
		</div>
		<br>
		<div class="row pdf_opciones_avanzadas">
			<div class="col-md-3"></div>
			<div class="col-md-9"><i style="color: #81d742; "class="fa fa-plus-square-o pdf_botones"></i><strong>Añadir </strong> (selección múltiple)</div>	
			<br><br>
		</div>	  
		<div class="row pdf_opciones_avanzadas">
			<div class="col-md-3"></div>
			<div class="col-md-3"> 
				<div class="checkbox checkbox-success">					
				<input id="pdf_introduccion"  name="pdf_introduccion"  type="checkbox"  value="1">
				<label for="pdf_introduccion">
					Introducción
				</label>
				</div>
			</div>
			<div class="col-md-3"> 
				<div class="checkbox checkbox-success">	
				<input id="pdf_equivalencia_medidas_caceras"  name="pdf_equivalencia_medidas_caceras"  type="checkbox" value="1">
				<label for="pdf_equivalencia_medidas_caceras">
					Equivalencia medidas caseras
				</label>
				</div>
			</div>
			<div class="col-md-3"> 
				<div class="checkbox checkbox-success">	
				<input id="pdf_mediciones"  name="pdf_mediciones"  type="checkbox" value="1">
				<label for="pdf_mediciones">
					Mediciones
				</label>
				</div>
			</div>
			<div class="col-md-1"></div>
		</div>
		<div class="row pdf_opciones_avanzadas">
			<br>
			<div class="col-md-3"></div>
			<div class="col-md-9"><i style="color: red;" class="fa fa-minus-square-o pdf_botones"></i><strong>Suprimir</strong> (desmarcar para suprimir del informe)</div>	
			<br><br>	
		</div>				
		<div class="row pdf_opciones_avanzadas">
			<div class="col-md-3"></div>
			<div class="col-md-3"> 
				<div class="checkbox checkbox-success">	
				<input id="pdf_recetas"  name="pdf_recetas"  type="checkbox" value="1" checked="checked">
				<label for="pdf_recetas">
					Recetas
				</label>
				</div>
			</div>
			<div class="col-md-3"> 
				<div class="checkbox checkbox-success">	
				<input id="pdf_lista_de_compra"  name="pdf_lista_de_compra"  type="checkbox" value="1" checked="checked">
				<label for="pdf_lista_de_compra">
					Lista de compra
				</label>
				</div>
			</div>
			<div class="col-md-3"></div>
			<div class="col-md-1"></div>	
		</div>
		<div class="row pdf_opciones_avanzadas">
			<br><br><br><br>
			<div class="col-md-2"></div>
			<div class="col-md-8 text-center"> 
				<a id="generar_pdf_avanzado" class="btn btn-primary">Mostrar PDF</a>
			</div>					
			<div class="col-md-2"></div>	
		</div>	
		<input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">
		
		<br><br><br>
		<div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
		</div>    
	</div>
	</div>
	</form>
  </div>		
</div>
<!-- Fin Modal Buscar Receta -->