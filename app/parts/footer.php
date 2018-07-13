<?php 
//Mensajes

switch ($_SESSION['mensaje'])  {
	//->Mensajes Estandar
	case "datos_vacios":
		echo modal_boton_enviar('mensajes_footer', 'Crear Alimento', '', 'Los campos estan en blanco', ''); 
		break;
	//Pagina configuracion	
	case "cambiar_textos":
		echo modal_boton_enviar('mensajes_footer', 'Configuración de Textos', '', 'Los cambios fueron realizados con éxito', ''); 
		break;
	case "datos_clinica":
		echo modal_boton_enviar('mensajes_footer', 'Configuración', '', 'Los cambios fueron realizados con éxito', ''); 
		break;	
	case "datos_clinica_error_imagen":
		echo modal_boton_enviar('mensajes_footer', 'Configuración', '', 'Error al subir la imagen', ''); 
		break;	
	case "m1":
		echo modal_boton_enviar('mensajes_footer', 'Contraseña', '', 'Los campos estan en blanco', ''); 
		break;
	case "m2":
		echo modal_boton_enviar('mensajes_footer', 'Contraseña', '', 'Las contraseñas no coinciden', ''); 
		break;
	case "m3":
		echo modal_boton_enviar('mensajes_footer', 'Contraseña', '', 'La contraseña no es correcta', ''); 
		break;		
	case "m4":
		echo modal_boton_enviar('mensajes_footer', 'Contraseña', '', 'La contraseña fue cambiada con éxito', ''); 
		break;
	case "recuperar_recetas":
		echo modal_boton_enviar('mensajes_footer', 'Recuperar Recetas', '', 'Las recetas fueron recuperadas con éxito', ''); 
		break;	
	case "recuperar_alimentos":
		echo modal_boton_enviar('mensajes_footer', 'Recuperar Alimentos', '', 'Los alimentos fueron recuperados con éxito', ''); 
		break;		
	case "eliminar_recetas_propias":
		echo modal_boton_enviar('mensajes_footer', 'Eliminar Recetas', '', 'Las recetas fueron eliminadas con éxito', ''); 
		break;	
	case "eliminar_alimentos_propias":
		echo modal_boton_enviar('mensajes_footer', 'Eliminar Alimentos', '', 'Los alimentos fueron eliminadas con éxito', ''); 
		break;	
	//Ticket
	case "t1":
		echo modal_boton_enviar('mensajes_footer', 'Soporte', '', 'La descripción esta vacía', ''); 
		break;
	//Clientes
	case "nuevo_cliente_creado":
		echo modal_boton_enviar('mensajes_footer', 'Cliente', '', 'El nuevo cliente fue registrado con éxito', ''); 
		break;
	case "datos_vacios_cliente":
		echo modal_boton_enviar('mensajes_footer', 'Cliente', '', 'Los campos estan en blanco', ''); 
		break;	
	case "cliente_actualizado":
		echo modal_boton_enviar('mensajes_footer', 'Actualizar Cliente', '', 'Los datos del cliente fueron actualizados con éxito', ''); 
		break;	
	case "historial_peso_eliminado":
		echo modal_boton_enviar('mensajes_footer', 'Cliente', '', 'Los registros de peso fueron eliminados con éxito', ''); 
		break;	
	case "historial_peso_no_seleccionado":
		echo modal_boton_enviar('mensajes_footer', 'Cliente', '', 'No selecciono ningún peso a eliminar', ''); 
		break;
	case "mediciones_eliminadas":
		echo modal_boton_enviar('mensajes_footer', 'Cliente', '', 'Las mediciones fueron eliminadas con éxito', ''); 
		break;	
	case "mediciones_no_seleccionadas":
		echo modal_boton_enviar('mensajes_footer', 'Cliente', '', 'No selecciono ninguna medición a eliminar', ''); 
		break;
	case "desactivar_clientes":
		echo modal_boton_enviar('mensajes_footer', 'Desactivar Clientes', '', 'Los clientes fueron desactivados con éxito', ''); 
		break;
	case "reactivar_clientes":
		echo modal_boton_enviar('mensajes_footer', 'Reactivar Clientes', '', 'Los clientes fueron reactivados con éxito', ''); 
		break;	
	case "eliminar_clientes":
		echo modal_boton_enviar('mensajes_footer', 'Eliminar Clientes', '', 'Los clientes fueron eliminados con éxito', ''); 
		break;	
	//Alimentos
	case "alimento_de_otro_usuario":
		echo modal_boton_enviar('mensajes_footer', 'Error en el Alimento', '', 'No tienes acceso para ver este alimento', ''); 
		break;	
	case "alimento_creado":
		echo modal_boton_enviar('mensajes_footer', 'Crear Alimento', '', 'El nuevo alimento fue creado con éxito', ''); 
		break;
	case "actualizar_alimento":
		echo modal_boton_enviar('mensajes_footer', 'Alimento Actualizado', '', 'Los cambios fueron realizados con éxito', ''); 
		break;
	case "desactivar_alimentos":
		echo modal_boton_enviar('mensajes_footer', 'Desactivar Alimentos', '', 'Los alimentos fueron desactivados con éxito', ''); 
		break;
	case "duplicar_alimento":
		echo modal_boton_enviar('mensajes_footer', 'Duplicar alimento', '', 'El alimento fue duplicado con éxito', ''); 
		break;	
	case "duplicar_alimentos":
		echo modal_boton_enviar('mensajes_footer', 'Duplicar alimentos', '', 'Los alimentos fueron duplicados con éxito', ''); 
		break;
	case "reactivar_alimentos":
		echo modal_boton_enviar('mensajes_footer', 'Reactivar alimentos', '', 'Los alimentos fueron reactivados con éxito', ''); 
		break;	
	case "eliminar_alimentos":
		echo modal_boton_enviar('mensajes_footer', 'Eliminar alimentos', '', 'Los alimentos fueron eliminados con éxito', ''); 
		break;	
	//Recetas
	case "receta_creada":
		echo modal_boton_enviar('mensajes_footer', 'Crear Receta', '', 'La receta fue creada con éxito', ''); 
		break;
	case "recetas_desactivadas":
		echo modal_boton_enviar('mensajes_footer', 'Desactivar Recetas', '', 'Las recetas fueron desactivadas con éxito', ''); 
		break;
	case "duplicar_recetas":
		echo modal_boton_enviar('mensajes_footer', 'Duplicar Recetas', '', 'Las recetas fueron duplicadas con éxito', ''); 
		break;	
	case "editar_receta":
		echo modal_boton_enviar('mensajes_footer', 'Editar Receta', '', 'Las receta fue editada con éxito', ''); 
		break;	
	case "reactivar_recetas":
		echo modal_boton_enviar('mensajes_footer', 'Reactivar Recetas', '', 'Las recetas fueron reactivadas con éxito', ''); 
		break;	
	case "eliminar_recetas":
		echo modal_boton_enviar('mensajes_footer', 'Eliminar Recetas', '', 'Las recetas fueron eliminadas con éxito', ''); 
		break;			
	case "receta_de_otro_usuario":
		echo modal_boton_enviar('mensajes_footer', 'Error en Receta', '', 'No tiene acceso para ver esta receta', ''); 
		break;
	case "receta_editada":
		echo modal_boton_enviar('mensajes_footer', 'Editar Receta', '', 'La receta fue editada con éxito', ''); 
		break;	
	case "receta_duplicada":
		echo modal_boton_enviar('mensajes_footer', 'Duplicar Receta', '', 'Las receta fuere duplicada con éxito', ''); 
		break;		
	//Usuarios	
	case "usuario_actualizado":
		echo modal_boton_enviar('mensajes_footer', 'Actualizar Usuario', '', 'El usuario fue actualizado con éxito', ''); 
		break;
	case "usuario_error":
		echo modal_boton_enviar('mensajes_footer', 'Actualizar Usuario', '', 'Error al momento de actulizar el usuario', ''); 
		break;
	case "cambiar_contrasena":
		echo modal_boton_enviar('mensajes_footer', 'Actualizar Contraseña', '', 'La contraseña fue cambiada con éxito', ''); 
		break;	
	case "las_contrasenas_no_coinciden":
		echo modal_boton_enviar('mensajes_footer', 'Actualizar Contraseña', '', 'Las contraseñas no coinciden', ''); 
		break;
	case "la_contrasena_actual_es_incorrecta":
		echo modal_boton_enviar('mensajes_footer', 'Actualizar Contraseña', '', 'La contraseña actual es incorrecta', ''); 
		break;			
	case "usuario_duplicado":
		echo modal_boton_enviar('mensajes_footer', 'Crear Usuario', '', 'El usuario se encuentra duplicado', ''); 
		break;	
	case "usuario_nuevo_creado":
		echo modal_boton_enviar('mensajes_footer', 'Crear Usuario', '', 'El usuario fue creado con éxito', ''); 
		break;		
	//Agenda	
	case "nueva_citas":
		echo modal_boton_enviar('mensajes_footer', 'Nuevas Citas', '', 'El registro se realizó con éxito', ''); 
		break;
	case "cita_modificada":
		echo modal_boton_enviar('mensajes_footer', 'Cita Modificada', '', 'La cita fue modificada con éxito', ''); 
		break;	
	case "desactivar_citas":
		echo modal_boton_enviar('mensajes_footer', 'Desactivar Citas', '', 'Las citas fueron desactivadas con éxito', ''); 
		break;
	case "modificar_cita":
		echo modal_boton_enviar('mensajes_footer', 'Modificar Cita', '', 'La cita fue modificada con éxito', ''); 
		break;	
	case "cita_eliminada":
		echo modal_boton_enviar('mensajes_footer', 'Eliminar Citas', '', 'Las citas fueron eliminadas con éxito', ''); 
		break;	
	case "reactivar_citas":
		echo modal_boton_enviar('mensajes_footer', 'Reactivar Citas', '', 'Las citas fueron reactivadas con éxito', ''); 
		break;	
	case "seleccionar_cliente":
		echo modal_boton_enviar('mensajes_footer', 'Error', '', 'Debe seleccionar un cliente para agregar la cita', ''); 
		break;
	case "seleccionar_cliente_desactivar":
		echo modal_boton_enviar('mensajes_footer', 'Error', '', 'Debe seleccionar un cliente para desactivar la cita', ''); 
		break;	
	//Reglas
	case "nueva_regla":
		echo modal_boton_enviar('mensajes_footer', 'Nuevas Regla', '', 'La nueva regla fue creada con éxito', ''); 
		break;
	case "desactivar_reglas":
		echo modal_boton_enviar('mensajes_footer', 'Desactivar Reglas', '', 'Las reglas fueron desactivadas con éxito', ''); 
		break;	
	case "reactivar_reglas":
		echo modal_boton_enviar('mensajes_footer', 'Reactivar Reglas', '', 'Las reglas fueron reactivadas con éxito', ''); 
		break;
	case "reactivar_reglas_problema":
		echo modal_boton_enviar('mensajes_footer', 'Reactivar Reglas', '', 'Las reglas seleccionadas  fueron reactivadas con éxito, a excepción de ('.$_SESSION['todos_supergrupo'] .') que ya se encontraban activas.', ''); 
		break;	
	case "eliminar_reglas":
		echo modal_boton_enviar('mensajes_footer', 'Eliminar Reglas', '', 'Las reglas fueron eliminadas con éxito', ''); 
		break;	
	case "reactivar_reglas_no_hacer_nada":
		echo modal_boton_enviar('mensajes_footer', 'Reactivar Reglas', '', 'Las reglas seleccionadas no han sido reactivadas porque ha seleccionado el mismo grupo en más de una ocasión. Por favor, revise la selección', ''); 
		break;		
	//Dieta
	case "sin_postre":
		echo modal_boton_enviar('mensajes_footer', 'Sin Postre', '', 'No tiene postres activos ó los que tiene activos no se los puede comer este cliente', ''); 
		break;	
	//Plantillas
	case "seleccionar_plantilla":
		echo modal_boton_enviar('mensajes_footer', 'Plantillas sin seleccionar', '', 'Debe seleccionar una plantilla para desactivar', ''); 
		break;	
	case "seleccionar_plantilla":
		echo modal_boton_enviar('mensajes_footer', 'Plantillas sin seleccionar', '', 'Debe seleccionar una plantilla para desactivar', ''); 
		break;
	case "plantilla_desactivada":
		echo modal_boton_enviar('mensajes_footer', 'Plantillas Desactivadas', '', 'Las plantillas fueron desactivadas con éxito', ''); 
		break;
	case "reactivar_plantilla":
		echo modal_boton_enviar('mensajes_footer', 'Reactivar Plantillas', '', 'Las plantillas fueron reactivadas con éxito', ''); 
		break;
	case "eliminar_plantilla":
		echo modal_boton_enviar('mensajes_footer', 'Eliminar Plantillas', '', 'Las plantillas fueron eliminadas con éxito', ''); 
		break;	
	//SUPER GRUPOS
	case "supergrupo_desactivado":
		echo modal_boton_enviar('mensajes_footer', 'Desactivar Super Grupo', '', 'El super grupo fue desactivado con éxito', ''); 
		break;		
	case "supergrupo_desactivados":
		echo modal_boton_enviar('mensajes_footer', 'Desactivar Super Grupo', '', 'Los super grupos fueron desactivados con éxito', ''); 
		break;	
	case "supergrupo_activados":
		echo modal_boton_enviar('mensajes_footer', 'Activar Super Grupo', '', 'Los super grupos fueron activados con éxito', ''); 
		break;	
	case "supergrupo_activo":
		echo modal_boton_enviar('mensajes_footer', 'Activar Super Grupo', '', 'El super grupos fue activado con éxito', ''); 
		break;	
	//->Configuracion
	case "imagen_subir_imagen":
		echo modal_boton_enviar('mensajes_footer', 'Configuración', '', $_SESSION['img_error_text'], ''); 
		break;	
	case "imagen_subir_imagen_tipo_archivo":
		echo modal_boton_enviar('mensajes_footer', 'Configuración', 'Tu archivo tiene que ser JPG o GIF. Otros archivos no son permitidos', ''); 
		break;	
	//->Dieta Cliente
	case "error_eliminar_dieta":
		echo modal_boton_enviar('mensajes_footer', 'Dieta Cliente', 'Error al eliminar la dieta del cliente', ''); 
		break;	
	case "eliminar_dieta":
		echo modal_boton_enviar('mensajes_footer', 'Dieta Cliente', 'La dieta del cliente fue eliminada con éxito', ''); 
		break;	
		
}
$_SESSION['img_error_text'] = '';
$_SESSION['mensaje'] = ''; 
$_SESSION['todos_supergrupo'] = '';


?>
<div id="subir-top" class="flecha-top">
		<a href="#wrapper"><i class="fa fa-arrow-circle-up" aria-hidden="true"></i></a>
		<div class="flecha-top-fondo"></div>
</div>
<div class="pull-right">
	Ultima actualización: <strong>17-08-2017</strong>
</div>
<div>
	<strong>Todos los derechos reservados.</strong> Act. septiembre &copy; 2016-<?php echo date('Y'); ?>
</div>