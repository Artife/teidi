<script>
/*
 *
 *   i-Diet
 *   version 2.0
 *
 */

$(document).ready(function () {
	//Mostrar los mensajes del footer en todas las paginas
	$('#mensajes_footer').modal('show');
	
	//->Pagina de dieta
	if ($("body.ver-dieta-cliente").length) {
		
		
	}	
	
	if($("body.dieta-calendario").length) {	
		
		//->Slider Calendario
		cargar_slider_calendario();
		
		//->Cargar triangulo
		cargar_estadisticas();		
		
		//->funciones
		function cargar_slider_calendario(){
			// $("#contenedor_slider").load("<?php echo $url_app; ?>parts/dieta/slider-calendario.php");	
			$("#dieta_calendario_ext").load("parts/dieta/slider-calendario.php", function(responseTxt, statusTxt, xhr){
				if(statusTxt == "success"){
					// alert("External content loaded successfully!");
				}	
				if(statusTxt == "error"){
					alert("Error: " + xhr.status + ": " + xhr.statusText);
				}	
			});	
					 
		}
		
		function cargar_estadisticas(){
			$("#contenedor_triangulo").load("parts/dieta/estadisticas/estadisticas.php");						
		}
		
	}
	
	//->Pagina asignar ingestas
	if ($("body.editar-ingestas").length) {		
		
		//Listado de recetas con ingestas
		var table_buscar =  $('#example').DataTable( {			
			"ordering": true,
			"info":     false,						
			<?php if (!empty($idiet_status_tabla) || $idiet_status_tabla == "0") {?>
			"iDisplayLength":	<?php echo $tabla_lista; ?>,
			<?php }else{ ?>
			"iDisplayLength":	3000,
			"paging": 		false
			<?php } ?>	
		});
		
		table_buscar.columns( [ 11 ] ).visible( false, false );  
		 
		var columna;
		var fila;
		var columna;
		var tipo_ingesta;
		var clase_css;
		var id_receta;
		var class_tipo;
		
		//Al hacer click en el recuadro
		$('td').click(function() {
			columna = $(this).index();				
			$tr = $(this).closest('tr');
			fila = $tr.index()+1;		
			clase_css = $(this).attr('class');		
			id_receta = $(this).attr('code');		
			// console.log(columna);
			// console.log(id_receta);
			
			if(columna == 1) {
				tipo_ingesta = 'ingesta_7';
				class_tipo = 'class_desayuno';
				evento(tipo_ingesta,clase_css, class_tipo);
			}
			if(columna == 2) {
				tipo_ingesta = 'ingesta_8';
				class_tipo = 'class_media_manana';
				evento(tipo_ingesta,clase_css, class_tipo);
			}
			if(columna == 3) {
				tipo_ingesta = 'ingesta_9';
				class_tipo = 'class_primer_plato_comida';
				evento(tipo_ingesta,clase_css, class_tipo);
			}
			if(columna == 4) {
				tipo_ingesta = 'ingesta_19';
				class_tipo = 'class_plato_principal_comida';
				evento(tipo_ingesta,clase_css, class_tipo);
			}
			if(columna == 5) {
				tipo_ingesta = 'ingesta_21';
				class_tipo = 'class_postre';
				evento(tipo_ingesta,clase_css, class_tipo);
			}
			if(columna == 6) {
				tipo_ingesta = 'ingesta_10';
				class_tipo = 'class_merienda';
				evento(tipo_ingesta,clase_css, class_tipo);
			}
			if(columna == 7) {
				tipo_ingesta = 'ingesta_11';
				class_tipo = 'class_primer_plato_cena';
				evento(tipo_ingesta,clase_css, class_tipo);
			}
			if(columna == 8) {
				tipo_ingesta = 'ingesta_20';
				class_tipo = 'class_plato_principal_cena';
				evento(tipo_ingesta,clase_css, class_tipo);
			}
			if(columna == 9) {
				tipo_ingesta = 'ingesta_12';
				class_tipo = 'class_recena';
				evento(tipo_ingesta,clase_css, class_tipo);
			}
			if(columna == 10) {
				tipo_ingesta = 'ingesta_18';
				class_tipo = 'class_otros';
				evento(tipo_ingesta,clase_css, class_tipo);
			}			
			
			
			//Luego que tenemos todas las variables las enviamos via POST al update
			$.ajax({
				type:'POST',
				url:'<?php echo $url_app; ?>parts/editar-ingestas-eventos.php',
				data:'tipo_ingesta='+tipo_ingesta+'&id_receta='+id_receta+'&class_tipo='+class_tipo+'&clase_css='+clase_css,
				success:function(data){
					console.log(data);
					// if(data == 'ok'){						
					// }else{
						// alert('Error al asignar ingestas');
					// }
				} 
			}); 
			
		});
		
		
		//->funciones
		function evento(tipo_ingesta,clase_css, class_tipo){
			if(clase_css == ''){
				//Agregamos la ingesta				
				$('#example tbody tr:nth-of-type('+fila+') td:nth-of-type('+(columna+1)+')').addClass(class_tipo);						
			}else{
				//Desactivamos la ingesta				
				$('#example tbody tr:nth-of-type('+fila+') td:nth-of-type('+(columna+1)+')').removeClass(class_tipo);						
			}
		}
				
		//Ocultar y mostrar buscador avanzado
		var busqueda_avanzada = 'ocultar';		
		$('#boton_busqueda_avanzada').on("click", function () {
			if(busqueda_avanzada == 'ocultar'){			
				// $('#buscador_avanzado').css('display', 'visible');	
				$('#buscador_avanzado').css('visibility', 'visible');
				$('#buscador_avanzado').css('height', 'auto');	
				$('#buscador_avanzado').css('position', 'static');		
				busqueda_avanzada = 'mostrar';
			}else{			
				// $('#buscador_avanzado').css('display', 'hidden');
				$('#buscador_avanzado').css('visibility', 'hidden');	
				$('#buscador_avanzado').css('height', '0px');	
				$('#buscador_avanzado').css('position', 'absolute');	
				busqueda_avanzada = 'ocultar';
			}
		});
		
		//Filto de nombre
		$('#nombre_receta').on( 'keyup', function () {				
			table_buscar
				.columns(0)
				.search(this.value)
				.draw();
		});
		
		//Filtro de ingestas
		$('#filtro_ingesta').on( 'keyup change', function () {
			var cur_value = $('option:selected',this).text();
			if(cur_value == 'Todos'){
				cur_value = '';
			}
				table_buscar
					.columns(11)
					.search(cur_value)
					.draw();
		});
		
		//Select chocen
		var config = {
			'.chosen-select'           : {},
			'.chosen-select-deselect'  : {allow_single_deselect:true},
			'.chosen-select-no-single' : {disable_search_threshold:10},
			'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
			'.chosen-select-width'     : {width:"95%"}
			}
		for (var selector in config) {
			$(selector).chosen(config[selector]);
		}	
		
	}
	//->Fin editar ingetas --
	
	//Obtener numero
	function obtener_numero_string(string) {
		  var tmp = string.split("");
		  var map = tmp.map(function(current) {
			if (!isNaN(parseInt(current))) {
			  return current;
			}
		  });

		  var numbers = map.filter(function(value) {
			return value != undefined;
		  });

		  return numbers.join("");
	}
});


//->Luego de la carga
if($("body.dieta-calendario").length) {	
	var columna;
	var fila;
	var clase_css;
	var id_receta;
	var semana;
	var dia;
	var tipo_comida;
	var kcal;
	var gramos;
	var bloqueo_desbloqueo;
	var loading = '<div class="ibox-content"><div class="row"><div class="col-lg-12 text-center"><div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div></div></div>';
	
	$(function() {
	  $('.semana_1').addClass("block_td");	
	});
	
	//Al hacer click en el recuadro
	$('body.dieta-calendario').on('click','td',function(){
		columna 	= $(this).index();				
		$tr			= $(this).closest('tr');
		fila		= $tr.index()+1;				
		id_receta	= $(this).attr('code');		
		kcal		= $(this).attr('kcal');		
		gramos		= $(this).attr('gramos');		
		semana		= $(this).attr('class').split(' ')[0];
		dia			= $(this).attr('class').split(' ')[1];
		tipo_comida	= $(this).attr('class').split(' ')[2];				
		bloqueo_desbloqueo	= $(this).attr('class').split(' ')[3];
		desbloquer_botones(bloqueo_desbloqueo);
	});
	
	
	//->Acciones de las recetas (copiar, pegar, ver, etc etc)
	//->Copiar	
	$('body.dieta-calendario').on('click','#btn_copiar',function(){	
		cargar_triangulo_var();
		$('#listado_opciones').modal('toggle'); 
		$('#div_pegar').css('display', 'block'); 		
		$("#dieta_calendario_ext").load("parts/dieta/slider-calendario.php?accion=copiar&id_receta="+id_receta+"&fila="+fila+"&columna="+columna+"&semana="+semana+"&dia="+dia+"&tipo_comida="+tipo_comida+"&kcal="+kcal+"&gramos="+gramos);		
	});		
	
	//->Pegar	
	$('body.dieta-calendario').on('click','#btn_pegar',function(){	
		$('#listado_opciones').modal('toggle'); 
		$('#div_pegar').css('display', 'none');  		
		$("#dieta_calendario_ext").load("parts/dieta/slider-calendario.php?accion=pegar&id_receta="+id_receta+"&fila="+fila+"&columna="+columna+"&semana="+semana+"&dia="+dia+"&tipo_comida="+tipo_comida+"&kcal="+kcal+"&gramos="+gramos);
		desactivar_impresion_y_pdf();
	});	
	
	//->Aplicar a toda la dieta	
	$('body.dieta-calendario').on('click','#btn_aplicar_toda_dieta',function(){		
		$('#listado_opciones').modal('toggle'); 
		$("#dieta_calendario_ext").load("parts/dieta/slider-calendario.php?accion=aplicar_toda_dieta&id_receta="+id_receta+"&fila="+fila+"&columna="+columna+"&semana="+semana+"&dia="+dia+"&tipo_comida="+tipo_comida+"&kcal="+kcal+"&gramos="+gramos);			
		desactivar_impresion_y_pdf();
	});	
	
	//->Bloquear y Desbloquear	
	$('body.dieta-calendario').on('click','#btn_bloquear_desbloquear',function(){			
		$('#listado_opciones').modal('toggle'); 
		$("#dieta_calendario_ext").load("parts/dieta/slider-calendario.php?accion=bloquear_desbloquear&id_receta="+id_receta+"&fila="+fila+"&columna="+columna+"&semana="+semana+"&dia="+dia+"&tipo_comida="+tipo_comida+"&kcal="+kcal+"&gramos="+gramos+"&bloqueo_desbloqueo="+bloqueo_desbloqueo);			
	});
	
	//->Ver informacion del plato
	$('body.dieta-calendario').on('click','#btn_ver_informacion',function(){		
		var url_ver_receta = "parts/ver-receta-vista.php";    			
		$('#listado_opciones').modal('toggle'); 
		$('#modal_ver_plato').modal('toggle');	
		$.ajax({                        
			type: "POST",                 
			url: url_ver_receta,                    
			data:'id_receta='+id_receta+'&gramos='+gramos,					
			success: function(data){
				$('#mostrar_receta_vista').html(data);    						
			}
			
		});			
	});	
	
	//->Buscar receta equivalente	
	$('body.dieta-calendario').on('click','#btn_buscar_plato_equi',function(){	
		var url_ver_receta = "parts/buscar-receta-equivalente.php";    			
		$('#listado_opciones').modal('toggle'); 
		$('#modal_buscar_receta').modal('toggle');	
		$.ajax({                        
			type: "POST",                 
			url: url_ver_receta,                    
			data:'id_receta='+id_receta+'&tipo_comida='+tipo_comida,		
			success: function(data){
				$('#mostrar_receta_equivalente').html(data);	
				$(".chosen-select").chosen(); 		
			}
			
		});	
		// desactivar_impresion_y_pdf();	
	});
	
	//sub Buscar receta equivalente	
	$('body.dieta-calendario').on('click','#cambiar_nuueva_receta_id',function(){	
		var nueva_id_receta = $('#nueva_receta_a_cambiar option:selected').val();
		$('#modal_buscar_receta').modal('toggle');			
		$("#dieta_calendario_ext").load("parts/dieta/slider-calendario.php?accion=cambiar_receta&id_receta="+id_receta+"&fila="+fila+"&columna="+columna+"&semana="+semana+"&dia="+dia+"&tipo_comida="+tipo_comida+"&kcal="+kcal+"&gramos="+gramos+"&nueva_id_receta="+nueva_id_receta);			
	});
	
	//-> Marcar como libre
	$('body.dieta-calendario').on('click','#btn_marcar_libre',function(){		
		$('#listado_opciones').modal('toggle'); 		
		$("#dieta_calendario_ext").load("parts/dieta/slider-calendario.php?accion=marcar_libre&id_receta="+id_receta+"&fila="+fila+"&columna="+columna+"&semana="+semana+"&dia="+dia+"&tipo_comida="+tipo_comida+"&kcal="+kcal+"&gramos="+gramos);			
	});
	
	//-> Modificar peso comida	
	$('body.dieta-calendario').on('click','#btn_modificar_peso',function(){	
		$('#div_modificar_peso_input').css('display', 'block');  								
	});	
	
	$('body.dieta-calendario').on('click','#link_modificar_peso',function(){	
		var nuevo_valor_peso = $('#nuevo_peso_input').val();  
		$('#listado_opciones').modal('toggle'); 				
		$('#div_modificar_peso_input').css('display', 'none'); 		
		$("#dieta_calendario_ext").load("parts/dieta/slider-calendario.php?accion=modificar_peso_comida&id_receta="+id_receta+"&fila="+fila+"&columna="+columna+"&semana="+semana+"&dia="+dia+"&tipo_comida="+tipo_comida+"&kcal="+kcal+"&gramos="+gramos+"&nuevo_valor_peso="+nuevo_valor_peso);			
		$("#nuevo_peso_input").val("");
	});
	
	//->Botones top	
	//->Recargar pagina
	$('body.dieta-calendario').on('click','#vinculo_actualizar_dieta',function(){		
		location.reload();
	});
	
	//-> Guardar plantilla	
	$('body.dieta-calendario').on('click','#vinculo_guardar_dieta',function(){		
		var dieta_plantilla = $("#contenedor_slider").html();					
		var url_guardar_dieta = "parts/guadar-dieta.php"; 
		$('#respuesta').html(loading);	
		activar_impresion_y_pdf();
		$.ajax({                        
			type: "POST",                 
			url: url_guardar_dieta,                    
			data:'dieta_plantilla='+dieta_plantilla,
			success: function(data){
				$('#respuesta').html(data);    					
			}			
		});		
	});
	
	//->Modal guardar plantilla 
	$('body.dieta-calendario').on('click','#vinculo_guardar_plantilla_dieta',function(){			
		$("#mensaje_guardar_plantilla").hide();
		$('#modal_guardar_plantilla').modal('toggle'); 		
	});	
	
	//->Guardar plantilla 	
	$('body.dieta-calendario').on('click','#guardar_plantilla_dieta_temporal',function(){			
		var dieta_plantilla = $("#contenedor_slider").html();	
		var nombre_plantilla_text = $("#p_nombre").val();	
		var nombre_plantilla = $("#p_nombre").val().length;			
		if(nombre_plantilla == 0 || nombre_plantilla == ''){
			$("#mensaje_guardar_plantilla" ).html("El nombre de la plantilla esta vacio");
			$("#mensaje_guardar_plantilla").show();	
		}
		if(nombre_plantilla >= 1 && nombre_plantilla <= 5){
			$("#mensaje_guardar_plantilla" ).html("El nombre de la plantilla es muy corto");				
			$("#mensaje_guardar_plantilla").show();	
		}
		if(nombre_plantilla >= 6){
		//Si todo esta bien guardamos la plantilla
			var url_guardar_plantilla = "parts/guadar-plantilla.php";
			$('#respuesta').html(loading);  
			$('#modal_guardar_plantilla').modal('toggle');				
			$.ajax({                        
				type: "POST",                 
				url: url_guardar_plantilla,                    
				data: 'dieta_plantilla='+dieta_plantilla+'&nombre_plantilla='+nombre_plantilla_text,
				success: function(data){
					$('#respuesta').html(data); 
					$("#mensaje_guardar_plantilla").html(data);
											
				}
				
			}); 
			//Luego limpiamos el nombre
			$("#p_nombre").val("");
		}	
		
	});
	
	//->PDF Modal para opciones	
	$('body.dieta-calendario').on('click','#vinculo_imprimir_dieta',function(){			
		if($("#vinculo_imprimir_dieta").css("cursor") == "pointer"){
			$('#modal_pdf').modal('toggle'); 	
		}			
	});

	//-> Otras opciones del PDF
	//-> Mostar las opciones del pdf avanzado
	$('#mostrar_pdf_avanzado').click(function() {						
		if($(".pdf_opciones_avanzadas").css("display") == "block"){
			$('.pdf_opciones_avanzadas').css('display', 'none'); 
		}else{
			$('.pdf_opciones_avanzadas').css('display', 'block'); 
		}	
	});
	
	//-> Otras opciones correo
	//-> Mostar las opciones del pdf avanzado
	$('#mostrar_pdf_avanzado_2').click(function() {						
		if($(".pdf_opciones_avanzadas_2").css("display") == "block"){
			$('.pdf_opciones_avanzadas_2').css('display', 'none'); 
		}else{
			$('.pdf_opciones_avanzadas_2').css('display', 'block'); 
		}	
	});	
	
	
	//->Botones Footer
	$('div#open_estadisticas').click(function() {						
		// window.location = ("estadisticas",'_blank');
		console.log("ok");
	});		
		
		
	//->Todas las funciones
	//-> Desactivar el boton de impresion y pdf
	function desactivar_impresion_y_pdf(){
		$('#vinculo_imprimir_dieta').css('cursor', 'default');  	
		$('#vinculo_imprimir_dieta').css('opacity', '0.5');  	
		$('#vinculo_imprimir_dieta').css('text-decoration:', 'none'); 
		$('#vinculo_enviar_correo').css('cursor', 'default');  	
		$('#vinculo_enviar_correo').css('opacity', '0.5');  	
		$('#vinculo_enviar_correo').css('text-decoration:', 'none'); 			
	}
	
	function activar_impresion_y_pdf(){
		$('#vinculo_imprimir_dieta').css('cursor', 'pointer');  	
		$('#vinculo_imprimir_dieta').css('opacity', '1');  	
		$('#vinculo_imprimir_dieta').css('text-decoration', 'solid'); 		    
		$('#vinculo_enviar_correo').css('cursor', 'pointer');  	
		$('#vinculo_enviar_correo').css('opacity', '1');  		
		$('#vinculo_enviar_correo').css('text-decoration', 'solid'); 	
	}
			
	function cargar_estadisticas_nuevas(){
		$("#contenedor_triangulo").load("parts/dieta/estadisticas/estadisticas.php");						
	}
	
	function desbloquer_botones(bloqueo_desbloqueo){		
		if(bloqueo_desbloqueo == 'block_td'){
			$('#btn_copiar').prop('disabled', true); 
			$('#btn_pegar').prop('disabled', true);  
			$('#btn_buscar_plato_equi').prop('disabled', true); 
			$('#btn_marcar_libre').prop('disabled', true); 
			$('#btn_modificar_peso').prop('disabled', true); 
		}else{
			$('#btn_copiar').prop('disabled', false);  
			$('#btn_pegar').prop('disabled', false); 
			$('#btn_buscar_plato_equi').prop('disabled', false); 
			$('#btn_marcar_libre').prop('disabled', false); 
			$('#btn_modificar_peso').prop('disabled', false); 
		}	
	}	
		
}
</script>	


